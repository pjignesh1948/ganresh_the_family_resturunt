<?php

namespace App\Support;

use Illuminate\Support\Str;

class FoodImageCatalog
{
    /** Real food photo URLs (Unsplash) mapped by menu category keywords. */
    private static array $categoryPhotos = [
        'paper dosa' => [
            'https://images.unsplash.com/photo-1630384060420-cbb99e5e6c2d?w=600&q=80',
            'https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=600&q=80',
        ],
        'masala dosa' => [
            'https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=600&q=80',
            'https://images.unsplash.com/photo-1668236541030-9a7e005a0857?w=600&q=80',
        ],
        'surati' => [
            'https://images.unsplash.com/photo-1668236541030-9a7e005a0857?w=600&q=80',
            'https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=600&q=80',
        ],
        'fancy dosa' => [
            'https://images.unsplash.com/photo-1596797038530-2c107229654b?w=600&q=80',
            'https://images.unsplash.com/photo-1630384060420-cbb99e5e6c2d?w=600&q=80',
        ],
        'jini roll' => [
            'https://images.unsplash.com/photo-1596797038530-2c107229654b?w=600&q=80',
        ],
        'uttapam' => [
            'https://images.unsplash.com/photo-1606491956689-2ea866858657?w=600&q=80',
        ],
        'kathiyawadi' => [
            'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=600&q=80',
            'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=600&q=80',
        ],
        'khichdi' => [
            'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=600&q=80',
        ],
        'rajasthani' => [
            'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=600&q=80',
        ],
        'starter' => [
            'https://images.unsplash.com/photo-1601050690597-df0568fa7098?w=600&q=80',
            'https://images.unsplash.com/photo-1567188042249-fb1444c3d48f?w=600&q=80',
        ],
        'paneer' => [
            'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=600&q=80',
            'https://images.unsplash.com/photo-1567188042249-fb1444c3d48f?w=600&q=80',
        ],
        'kofta' => [
            'https://images.unsplash.com/photo-1563379091339-03246963d4a9?w=600&q=80',
        ],
        'kaju' => [
            'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=600&q=80',
        ],
        'veg special' => [
            'https://images.unsplash.com/photo-1546069901-ba9599a7e63c?w=600&q=80',
            'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600&q=80',
        ],
        'dal' => [
            'https://images.unsplash.com/photo-1546833999-b9f581a1996d?w=600&q=80',
        ],
        'pulav' => [
            'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=600&q=80',
        ],
        'rice' => [
            'https://images.unsplash.com/photo-1585937421612-70a008356fbe?w=600&q=80',
        ],
        'biryani' => [
            'https://images.unsplash.com/photo-1563379091339-03246963d4a9?w=600&q=80',
        ],
        'pav bhaji' => [
            'https://images.unsplash.com/photo-1606491956689-2ea866858657?w=600&q=80',
        ],
        'beverage' => [
            'https://images.unsplash.com/photo-1546173159-315724a31696?w=600&q=80',
        ],
        'tandoor' => [
            'https://images.unsplash.com/photo-1601050690597-df0568fa7098?w=600&q=80',
        ],
        'bread' => [
            'https://images.unsplash.com/photo-1615197348585-4f3704b0a0?w=600&q=80',
            'https://images.unsplash.com/photo-1601050690597-df0568fa7098?w=600&q=80',
        ],
    ];

    private static array $galleryPhotos = [
        ['Restaurant Interior', 'Warm family dining at Gota', 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80'],
        ['Dosa Counter', 'Fresh crispy dosas', 'https://images.unsplash.com/photo-1630384060420-cbb99e5e6c2d?w=800&q=80'],
        ['Family Seating', 'Comfortable seating for families', 'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=800&q=80'],
        ['South Indian Thali', 'Traditional thali service', 'https://images.unsplash.com/photo-1589301760014-d929f3979dbc?w=800&q=80'],
        ['Paneer Special', 'Rich paneer gravies', 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?w=800&q=80'],
        ['Kathiyawadi Dish', 'Authentic Gujarati flavours', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=800&q=80'],
        ['Evening Ambience', 'Evening dining atmosphere', 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&q=80'],
        ['Fresh Vegetables', 'Farm fresh ingredients', 'https://images.unsplash.com/photo-1540420773420-3366772f4999?w=800&q=80'],
    ];

    public static function forCategory(string $categoryName): string
    {
        $photos = self::photosFor($categoryName);

        return $photos[0];
    }

    public static function forItem(string $itemName, string $categoryName): string
    {
        $photos = self::photosFor($categoryName);
        $index = abs(crc32($itemName)) % count($photos);

        return $photos[$index];
    }

    /** @return list<string> */
    public static function galleryPhotos(): array
    {
        return self::$galleryPhotos;
    }

    /** @return list<array{title: string, description: string, url: string}> */
    public static function portfolioItems(): array
    {
        return [
            ['Grand Opening Gota', 'Celebrating our launch on Jagatpur Road', 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&q=80'],
            ['Dosa Festival', 'Paper Dosa to Burj Khalifa Dosa', 'https://images.unsplash.com/photo-1630384060420-cbb99e5e6c2d?w=800&q=80'],
            ['Kathiyawadi Night', 'Varaliyu & Kaju Gathiya specials', 'https://images.unsplash.com/photo-1565557623262-b51c2513a641?w=800&q=80'],
            ['Family Celebrations', 'Birthdays & gatherings welcome', 'https://images.unsplash.com/photo-1552566626-52f8b828add9?w=800&q=80'],
        ];
    }

    /** @return list<array{name: string, title: string, bio: string, url: string}> */
    public static function founders(): array
    {
        return [
            [
                'name' => 'Ganesh Patel',
                'title' => 'Founder & Head Chef',
                'bio' => 'Started Ganesh The Family Restaurant with a vision to serve honest Gujarati and South Indian food. 25+ years in hospitality — Umbadiyu and Dosa specialist.',
                'url' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&q=80',
            ],
            [
                'name' => 'Priya Shah',
                'title' => 'Co-Founder & Operations',
                'bio' => 'Manages daily operations, quality control, and guest experience. Ensures every family feels at home at our Gota restaurant.',
                'url' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=400&q=80',
            ],
        ];
    }

    /** @return list<string> */
    private static function photosFor(string $categoryName): array
    {
        $lower = strtolower($categoryName);
        foreach (self::$categoryPhotos as $key => $photos) {
            if (str_contains($lower, $key)) {
                return $photos;
            }
        }

        return ['https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=600&q=80'];
    }
}
