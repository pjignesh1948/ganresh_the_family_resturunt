<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\GalleryImage;
use App\Models\HomeSlider;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Order;
use App\Models\Portfolio;
use App\Models\Promotion;
use App\Models\Sop;
use App\Models\Staff;
use App\Models\TeamMember;
use App\Models\Vegetable;
use App\Models\VegetableSale;
use App\Models\Video;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'orders_total' => Order::count(),
            'orders_pending' => Order::where('status', 'pending')->count(),
            'menu_categories' => MenuCategory::count(),
            'menu_items' => MenuItem::count(),
            'vegetables' => Vegetable::where('is_active', true)->count(),
            'veg_sales_today' => VegetableSale::whereDate('sold_date', today())->sum('total_price'),
            'staff' => Staff::where('is_active', true)->count(),
            'team' => TeamMember::where('is_active', true)->count(),
            'sliders' => HomeSlider::where('is_active', true)->count(),
            'promotions' => Promotion::where('is_active', true)->count(),
            'gallery' => GalleryImage::where('is_active', true)->count(),
            'videos' => Video::where('is_active', true)->count(),
            'portfolios' => Portfolio::where('is_active', true)->count(),
            'sops' => Sop::where('is_active', true)->count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
        ];

        $modules = [
            ['icon' => 'bi-folder2-open', 'label' => 'Menu Categories', 'count' => $stats['menu_categories'], 'route' => 'admin.menu-categories.index', 'color' => '#6366f1'],
            ['icon' => 'bi-cup-hot-fill', 'label' => 'Menu Items', 'count' => $stats['menu_items'], 'route' => 'admin.menu-items.index', 'color' => '#f59e0b'],
            ['icon' => 'bi-bag-check-fill', 'label' => 'Orders', 'count' => $stats['orders_total'], 'route' => 'admin.orders.index', 'color' => '#10b981'],
            ['icon' => 'bi-flower1', 'label' => 'Vegetables', 'count' => $stats['vegetables'], 'route' => 'admin.vegetables.index', 'color' => '#22c55e'],
            ['icon' => 'bi-cart-check', 'label' => 'Veg Sales Today', 'count' => '₹'.number_format($stats['veg_sales_today'],0), 'route' => 'admin.vegetable-sales.index', 'color' => '#14b8a6'],
            ['icon' => 'bi-people-fill', 'label' => 'Staff', 'count' => $stats['staff'], 'route' => 'admin.staff.index', 'color' => '#8b5cf6'],
            ['icon' => 'bi-person-badge', 'label' => 'Our Team', 'count' => $stats['team'], 'route' => 'admin.team-members.index', 'color' => '#ec4899'],
            ['icon' => 'bi-images', 'label' => 'Home Sliders', 'count' => $stats['sliders'], 'route' => 'admin.home-sliders.index', 'color' => '#3b82f6'],
            ['icon' => 'bi-megaphone-fill', 'label' => 'Promotions', 'count' => $stats['promotions'], 'route' => 'admin.promotions.index', 'color' => '#ef4444'],
            ['icon' => 'bi-image', 'label' => 'Gallery', 'count' => $stats['gallery'], 'route' => 'admin.gallery-images.index', 'color' => '#06b6d4'],
            ['icon' => 'bi-play-btn-fill', 'label' => 'Videos', 'count' => $stats['videos'], 'route' => 'admin.videos.index', 'color' => '#a855f7'],
            ['icon' => 'bi-briefcase-fill', 'label' => 'Portfolio', 'count' => $stats['portfolios'], 'route' => 'admin.portfolios.index', 'color' => '#64748b'],
            ['icon' => 'bi-journal-text', 'label' => 'SOPs', 'count' => $stats['sops'], 'route' => 'admin.sops.index', 'color' => '#78716c'],
            ['icon' => 'bi-envelope-fill', 'label' => 'Messages', 'count' => $stats['unread_messages'], 'route' => 'admin.contact-messages.index', 'color' => '#f97316'],
            ['icon' => 'bi-gear-fill', 'label' => 'Settings', 'count' => '—', 'route' => 'admin.settings.edit', 'color' => '#94a3b8'],
        ];

        $recentOrders = Order::latest()->limit(8)->get();

        return view('admin.dashboard', compact('stats', 'modules', 'recentOrders'));
    }
}
