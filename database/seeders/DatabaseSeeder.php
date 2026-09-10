<?php

namespace Database\Seeders;

use App\Support\FoodImageCatalog;
use App\Support\MenuFoodImageGenerator;
use App\Models\CustomerReview;
use App\Models\Founder;
use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\HomeSlider;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\Promotion;
use App\Models\SiteSetting;
use App\Models\Staff;
use App\Models\TeamMember;
use App\Models\User;
use App\Models\Vegetable;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@ganeshtfr.com'],
            ['name' => 'Ganesh Admin', 'password' => Hash::make('admin123')]
        );

        SiteSetting::set('site_name', 'Ganesh The Family Restaurant');
        SiteSetting::set('tagline', 'Committed to Quality · Served with Love · Umbadiyu Specialist');
        SiteSetting::set('phone', '9276819283, 8200692794');
        SiteSetting::set('email', 'info@ganeshtfr.com');
        SiteSetting::set('address', 'In front of Rangoli, Beside Magnate Luxuria, Jagatpur Road, Gota, Ahmedabad - 382481');
        SiteSetting::set('opening_hours', 'Open Daily: 10:00 AM – 11:00 PM');
        SiteSetting::set('order_notify_email', 'info@ganeshtfr.com');
        SiteSetting::set('whatsapp_number', '919276819283');
        SiteSetting::set('instagram_url', 'https://instagram.com/ganesh_the_family_restaurant');

        Page::query()->updateOrCreate(['slug' => 'home'], [
            'title' => 'Welcome to Ganesh The Family Restaurant',
            'content' => '<p class="lead">Committed to quality, served with love. We are Ahmedabad\'s favourite destination for <strong>South Indian Dosa</strong>, <strong>Kathiyawadi specials</strong>, <strong>Umbadiyu</strong>, and authentic family dining.</p>
<p>From classic Paper Dosa to our famous <strong>Burj Khalifa Dosa</strong>, Rajasthani Daal-Bati, and Punjabi Paneer — every dish is prepared fresh with care.</p>
<ul><li>Umbadiyu Specialist</li><li>Dosa & Uttapam varieties</li><li>Kathiyawadi & Rajasthani cuisine</li><li>Online ordering available</li></ul>',
            'meta_title' => 'Ganesh The Family Restaurant | Gota Ahmedabad',
            'is_published' => true,
        ]);

        Page::query()->updateOrCreate(['slug' => 'about'], [
            'title' => 'About Ganesh The Family Restaurant',
            'content' => '<p>Ganesh The Family Restaurant is located on <strong>Jagatpur Road, Gota</strong> — in front of Rangoli, beside Magnate Luxuria. We welcome families, friends, and food lovers with warm hospitality and honest flavours.</p>
<p>Our menu celebrates Gujarat and India: crispy dosas, Surati Mysore specials, Kathiyawadi gathiya, original Rajasthani Daal-Bati, rich paneer gravies, and fresh tandoor breads.</p>
<p><strong>Contact:</strong> 9276819283 / 8200692794 · info@ganeshtfr.com</p>',
            'is_published' => true,
        ]);

        $this->seedMenu();
        $this->seedVegetables();
        $this->seedFounders();
        $this->seedStaff();
        $this->seedGallery();
        $this->seedPortfolio();
        $this->seedVideos();
        $this->seedTeam();
        $this->seedSliders();
        $this->seedPromotion();
        $this->seedCustomerReviews();
    }

    private function seedTeam(): void
    {
        $team = [
            ['Ganesh Patel', 'Owner & Head Chef', '25+ years serving authentic Gujarati & South Indian cuisine.', null, 1],
            ['Priya Shah', 'Restaurant Manager', 'Ensures every guest feels like family.', null, 2],
            ['Ravi Kumar', 'Head Cook — Dosa Section', 'Master of Paper Dosa & Fancy Dosa varieties.', null, 3],
            ['Meena Desai', 'Front Desk', 'Handles orders, reservations & customer care.', '8200692794', 4],
        ];
        foreach ($team as [$name, $role, $bio, $phone, $sort]) {
            TeamMember::query()->updateOrCreate(['name' => $name], [
                'role' => $role, 'bio' => $bio, 'phone' => $phone,
                'sort_order' => $sort, 'is_active' => true,
            ]);
        }
    }

    private function seedSliders(): void
    {
        $sliderImages = [
            ['Welcome to Ganesh', 'Umbadiyu Specialist · Family Dining in Gota', 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=1200&q=80', 1],
            ['South Indian Dosa', 'Paper Dosa · Masala Dosa · Burj Khalifa Dosa', 'https://images.unsplash.com/photo-1630384060420-cbb99e5e6c2d?w=1200&q=80', 2],
            ['Order Online', 'Fresh food delivered — call 9276819283', 'https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=1200&q=80', 3],
        ];
        foreach ($sliderImages as [$title, $subtitle, $img, $sort]) {
            HomeSlider::query()->updateOrCreate(['title' => $title], [
                'subtitle' => $subtitle,
                'image' => $img,
                'link' => null,
                'sort_order' => $sort,
                'is_active' => true,
            ]);
        }
    }

    private function seedPromotion(): void
    {
        Promotion::query()->updateOrCreate(['title' => 'Grand Opening Offer'], [
            'image' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=900&q=80',
            'link' => route('front.order'),
            'is_active' => true,
            'show_once' => true,
        ]);
    }

    private function seedMenu(): void
    {
        $menu = require database_path('data/menu.php');
        MenuCategory::whereNotIn('name', array_keys($menu))->each(function ($cat) {
            $cat->menuItems()->delete();
            $cat->delete();
        });

        $sort = 0;
        foreach ($menu as $categoryName => $items) {
            $sort++;
            $catImage = FoodImageCatalog::forCategory($categoryName);
            $category = MenuCategory::query()->updateOrCreate(
                ['name' => $categoryName],
                [
                    'description' => $categoryName . ' — Ganesh Restaurant',
                    'image' => $catImage,
                    'sort_order' => $sort,
                    'is_active' => true,
                ]
            );

            $itemSort = 0;
            foreach ($items as [$name, $price]) {
                $itemSort++;
                MenuItem::query()->updateOrCreate(
                    ['menu_category_id' => $category->id, 'name' => $name],
                    [
                        'price' => $price,
                        'image' => MenuFoodImageGenerator::forItem($name, $categoryName, true),
                        'description' => 'Freshly prepared · 100% vegetarian',
                        'is_veg' => true,
                        'is_available' => true,
                        'sort_order' => $itemSort,
                    ]
                );
            }
        }
    }

    private function seedVegetables(): void
    {
        $vegPhotos = [
            'Tomato' => 'https://images.unsplash.com/photo-1546095666-f2f7c7a82057?w=200&q=80',
            'Bottle Gourd' => 'https://images.unsplash.com/photo-1594282486552-05b4d8267489?w=200&q=80',
            'Cauliflower' => 'https://images.unsplash.com/photo-1610832958506-aa56368176?w=200&q=80',
            'Okra' => 'https://images.unsplash.com/photo-1607301401176-3c9a0a0a0a0a?w=200&q=80',
            'Green Chili' => 'https://images.unsplash.com/photo-1563565375-f3fdfdbefa83?w=200&q=80',
            'Carrot' => 'https://images.unsplash.com/photo-1598170845058-32b9d6d5ba37?w=200&q=80',
            'Lemon' => 'https://images.unsplash.com/photo-1546173159-315724a31696?w=200&q=80',
            'Cabbage' => 'https://images.unsplash.com/photo-1594282486552-05b4d8267489?w=200&q=80',
            'Capsicum' => 'https://images.unsplash.com/photo-1563565375-f3fdfdbefa83?w=200&q=80',
            'Spinach' => 'https://images.unsplash.com/photo-1576045057995-568f588f82fb?w=200&q=80',
            'Ginger' => 'https://images.unsplash.com/photo-1615485290382-441e4d046cb5?w=200&q=80',
            'Coriander Leaves' => 'https://images.unsplash.com/photo-1618375569902-5c3a8d140f27?w=200&q=80',
            'Mint' => 'https://images.unsplash.com/photo-1628556270448-4fef4f8f0707?w=200&q=80',
            'Brinjal' => 'https://images.unsplash.com/photo-1628773824103-0d99007fa703?w=200&q=80',
            'Onion' => 'https://images.unsplash.com/photo-1518977956812-cd3db2704828?w=200&q=80',
            'Potato' => 'https://images.unsplash.com/photo-1518977676601-b53f82aba655?w=200&q=80',
            'Green Peas' => 'https://images.unsplash.com/photo-1459411621453-7b03977f6332?w=200&q=80',
            'Garlic' => 'https://images.unsplash.com/photo-1607613009820-a38f7a8c8a8e?w=200&q=80',
            'Banana' => 'https://images.unsplash.com/photo-1571771894821-ce9b6c11fe08?w=200&q=80',
            'Pomegranate' => 'https://images.unsplash.com/photo-1615485925617-9c2f5a0a0a0a?w=200&q=80',
            'Apple' => 'https://images.unsplash.com/photo-1560806887-1e4cd0b27c6?w=200&q=80',
        ];

        $rows = require database_path('data/vegetables.php');
        foreach ($rows as $i => $row) {
            [$name, $hi, $gu, $desc, $descHi, $descGu, $retail, $vendor, $type] = array_pad($row, 9, 'vegetable');
            Vegetable::query()->updateOrCreate(['name' => $name], [
                'name_hi' => $hi,
                'name_gu' => $gu,
                'description' => $desc,
                'description_hi' => $descHi,
                'description_gu' => $descGu,
                'image' => $vegPhotos[$name] ?? $vegPhotos['Tomato'],
                'type' => $type,
                'retail_price_per_kg' => $retail,
                'vendor_price_per_kg' => $vendor,
                'is_active' => true,
                'sort_order' => $i + 1,
            ]);
        }
    }

    private function seedFounders(): void
    {
        foreach (FoodImageCatalog::founders() as $i => $f) {
            Founder::query()->updateOrCreate(['name' => $f['name']], [
                'title' => $f['title'],
                'bio' => $f['bio'],
                'photo' => $f['url'],
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }
    }

    private function seedStaff(): void
    {
        $staff = [
            ['Ravi Kumar', 'Head Cook', '9876543210', 'headcook@ganeshtfr.com', 18000],
            ['Meena Desai', 'Cashier', '8200692794', null, 12000],
            ['Suresh Mistry', 'Waiter', '9123456789', null, 10000],
        ];
        foreach ($staff as [$name, $role, $phone, $email, $salary]) {
            Staff::query()->updateOrCreate(['name' => $name], [
                'role' => $role,
                'phone' => $phone,
                'email' => $email,
                'monthly_salary' => $salary,
                'joining_date' => now()->subMonths(6),
                'is_active' => true,
            ]);
        }
    }

    private function seedGallery(): void
    {
        $restCat = GalleryCategory::query()->updateOrCreate(['name' => 'Restaurant'], ['sort_order' => 1, 'is_active' => true]);
        $foodCat = GalleryCategory::query()->updateOrCreate(['name' => 'Food & Dishes'], ['sort_order' => 2, 'is_active' => true]);

        foreach (FoodImageCatalog::galleryPhotos() as $i => [$title, $caption, $url]) {
            $cat = $i < 3 ? $restCat : $foodCat;
            GalleryImage::query()->updateOrCreate(
                ['gallery_category_id' => $cat->id, 'title' => $title],
                ['caption' => $caption, 'image' => $url, 'sort_order' => $i + 1, 'is_active' => true]
            );
        }
    }

    private function seedPortfolio(): void
    {
        foreach (FoodImageCatalog::portfolioItems() as $i => [$title, $desc, $url]) {
            Portfolio::query()->updateOrCreate(['title' => $title], [
                'description' => $desc,
                'image' => $url,
                'event_date' => now()->subMonths($i + 1),
                'sort_order' => $i + 1,
                'is_active' => true,
            ]);
        }
    }

    private function seedVideos(): void
    {
        $vc = VideoCategory::query()->updateOrCreate(['name' => 'Restaurant Videos'], ['sort_order' => 1, 'is_active' => true]);
        $videos = [
            ['Restaurant Tour', 'Take a look inside Ganesh The Family Restaurant', 'https://www.youtube.com/watch?v=9bZkp7q19f0'],
            ['Dosa Making', 'Watch our chefs prepare crispy dosas', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ'],
        ];
        foreach ($videos as $i => [$title, $desc, $url]) {
            Video::query()->updateOrCreate(['title' => $title], [
                'video_category_id' => $vc->id,
                'description' => $desc,
                'youtube_url' => $url,
                'is_active' => true,
                'sort_order' => $i + 1,
            ]);
        }
    }

    private function seedCustomerReviews(): void
    {
        $rows = require database_path('data/customer_reviews.php');
        foreach ($rows as $row) {
            CustomerReview::query()->updateOrCreate(
                ['reviewer_name' => $row['reviewer_name'], 'comment' => $row['comment']],
                array_merge($row, ['is_featured' => true, 'is_active' => true])
            );
        }
    }
}
