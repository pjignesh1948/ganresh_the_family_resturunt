<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\NewOrderMail;
use App\Models\ContactMessage;
use App\Models\CustomerReview;
use App\Models\GalleryCategory;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\OrderActivityLog;
use App\Models\OrderItem;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\SiteSetting;
use App\Models\HomeSlider;
use App\Models\Promotion;
use App\Models\TeamMember;
use App\Models\Vegetable;
use App\Models\VegetableSale;
use App\Models\VideoCategory;
use Illuminate\Http\Request;
use App\Services\SmsService;
use Illuminate\Support\Facades\Mail;

class FrontController extends Controller
{
    public function home()
    {
        $page = Page::where('slug', 'home')->first();
        $featuredItems = MenuItem::where('is_available', true)
            ->whereNotNull('image')
            ->whereIn('name', [
                'Paper Dosa', 'Masala Dosa', 'Surati Mysore', 'Jini Roll',
                'Plain Uttapam', 'Varaliyu', 'Paneer Tikka Masala', 'Burj Khalifa Dosa',
            ])
            ->get()
            ->sortBy(fn ($item) => array_search($item->name, [
                'Paper Dosa', 'Masala Dosa', 'Surati Mysore', 'Jini Roll',
                'Plain Uttapam', 'Varaliyu', 'Paneer Tikka Masala', 'Burj Khalifa Dosa',
            ]));
        $portfolios = Portfolio::where('is_active', true)->orderBy('sort_order')->take(4)->get();
        $sliders = HomeSlider::where('is_active', true)->orderBy('sort_order')->get();
        $promotion = Promotion::where('is_active', true)->latest()->first();
        $reviews = CustomerReview::where('is_active', true)->where('is_featured', true)->orderBy('sort_order')->get();

        return view('front.home', compact('page', 'featuredItems', 'portfolios', 'sliders', 'promotion', 'reviews'));
    }

    public function about()
    {
        $page = Page::where('slug', 'about')->first();
        $founders = \App\Models\Founder::where('is_active', true)->orderBy('sort_order')->get();

        return view('front.about', compact('page', 'founders'));
    }

    public function order()
    {
        $categories = MenuCategory::where('is_active', true)
            ->with(['menuItems' => fn ($q) => $q->where('is_available', true)->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();

        $allItems = MenuItem::where('is_available', true)->with('menuCategory')->orderBy('name')->get();

        return view('front.order', compact('categories', 'allItems'));
    }

    public function orderSuccess(string $orderNo)
    {
        $order = Order::where('order_no', $orderNo)->with('orderItems')->firstOrFail();

        return view('front.order-success', compact('order'));
    }

    public function placeOrder(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required|string|max:120',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email',
            'address' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
            'items' => 'required|array|min:1',
            'items.*.menu_item_id' => 'required|exists:menu_items,id',
            'items.*.quantity' => 'required|integer|min:1|max:99',
        ]);

        $order = Order::create([
            'customer_name' => $data['customer_name'],
            'phone' => $data['phone'],
            'email' => $data['email'] ?? null,
            'address' => $data['address'] ?? null,
            'notes' => $data['notes'] ?? null,
            'status' => 'pending',
            'total_amount' => 0,
        ]);

        $total = 0;
        foreach ($data['items'] as $row) {
            $item = MenuItem::findOrFail($row['menu_item_id']);
            $line = $item->price * (int) $row['quantity'];
            OrderItem::create([
                'order_id' => $order->id,
                'menu_item_id' => $item->id,
                'item_name' => $item->name,
                'quantity' => $row['quantity'],
                'unit_price' => $item->price,
                'line_total' => $line,
            ]);
            $total += $line;
        }

        $order->update(['total_amount' => $total]);

        OrderActivityLog::record($order->id, 'created', 'pending', 'Order placed from website');

        $notifyEmail = SiteSetting::get('order_notify_email', config('mail.from.address'));
        $emailSent = false;
        if ($notifyEmail) {
            try {
                Mail::to($notifyEmail)->send(new NewOrderMail($order->load('orderItems')));
                $emailSent = true;
            } catch (\Throwable $e) {
            }
        }

        $smsSent = app(SmsService::class)->notifyNewOrder(
            $order->order_no,
            $order->customer_name,
            number_format($total, 2),
            $order->phone
        );

        return redirect()->route('front.order.success', $order->order_no)
            ->with('success', 'Order placed successfully!')
            ->with('order_notifications', [
                'email' => $emailSent,
                'sms_admin' => $smsSent['admin'] ?? false,
                'sms_customer' => $smsSent['customer'] ?? false,
                'sms_configured' => app(SmsService::class)->isEnabled(),
            ]);
    }

    public function portfolio()
    {
        $items = Portfolio::where('is_active', true)->orderBy('sort_order')->paginate(12);

        return view('front.portfolio', compact('items'));
    }

    public function gallery()
    {
        $categories = GalleryCategory::where('is_active', true)
            ->with(['galleryImages' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();

        return view('front.gallery', compact('categories'));
    }

    public function videos()
    {
        $categories = VideoCategory::where('is_active', true)
            ->with(['videos' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')])
            ->orderBy('sort_order')
            ->get();

        return view('front.videos', compact('categories'));
    }

    public function team()
    {
        $members = TeamMember::where('is_active', true)->orderBy('sort_order')->get();

        return view('front.team', compact('members'));
    }

    public function vegetables()
    {
        $vegetables = Vegetable::where('is_active', true)->orderBy('sort_order')->orderBy('name')->get();
        $weightPresets = [50, 100, 150, 200, 250, 300, 350, 400, 450, 500, 750, 1000];

        return view('front.vegetables', compact('vegetables', 'weightPresets'));
    }

    public function calculateVegetable(Request $request)
    {
        $data = $request->validate([
            'vegetable_id' => 'required|exists:vegetables,id',
            'grams' => 'required|numeric|min:1|max:50000',
            'price_type' => 'required|in:retail,vendor',
        ]);

        $vegetable = Vegetable::findOrFail($data['vegetable_id']);
        $price = $vegetable->priceForWeight((float) $data['grams'], $data['price_type']);

        return response()->json([
            'vegetable' => $vegetable->name,
            'grams' => (float) $data['grams'],
            'price_type' => $data['price_type'],
            'unit_price_per_kg' => $data['price_type'] === 'vendor'
                ? ($vegetable->vendor_price_per_kg ?? $vegetable->retail_price_per_kg)
                : $vegetable->retail_price_per_kg,
            'total_price' => round($price, 2),
            'formatted' => '₹' . number_format($price, 2),
        ]);
    }

    public function saveVegetableSales(Request $request)
    {
        $data = $request->validate([
            'items' => 'required|array|min:1',
            'items.*.vegetable_id' => 'required|exists:vegetables,id',
            'items.*.grams' => 'required|numeric|min:1',
            'items.*.price_type' => 'required|in:retail,vendor',
        ]);

        $grandTotal = 0;
        foreach ($data['items'] as $row) {
            $vegetable = Vegetable::findOrFail($row['vegetable_id']);
            $unit = $row['price_type'] === 'vendor'
                ? ($vegetable->vendor_price_per_kg ?? $vegetable->retail_price_per_kg)
                : $vegetable->retail_price_per_kg;
            $total = $vegetable->priceForWeight((float) $row['grams'], $row['price_type']);
            VegetableSale::create([
                'vegetable_id' => $vegetable->id,
                'grams' => $row['grams'],
                'price_type' => $row['price_type'],
                'unit_price_per_kg' => $unit,
                'total_price' => $total,
                'sold_date' => today(),
            ]);
            $grandTotal += $total;
        }

        return response()->json([
            'success' => true,
            'message' => 'Sale recorded successfully.',
            'grand_total' => round($grandTotal, 2),
            'formatted' => '₹' . number_format($grandTotal, 2),
        ]);
    }

    public function contact()
    {
        return view('front.contact');
    }

    public function sendContact(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'subject' => 'nullable|string|max:200',
            'message' => 'required|string|max:2000',
        ]);

        ContactMessage::create($data);

        return back()->with('success', 'Thank you! Your message has been sent.');
    }
}
