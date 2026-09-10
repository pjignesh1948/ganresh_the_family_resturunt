<?php

namespace App\Support;

use Illuminate\Support\Str;

class MenuFoodImageGenerator
{
    /** @var array<string, array{bg: string, accent: string, emoji: string}> */
    private static array $categoryStyles = [
        'paper dosa' => ['bg' => '#FFF3E0', 'accent' => '#E65100', 'emoji' => '🥞'],
        'masala dosa' => ['bg' => '#FFF8E1', 'accent' => '#F57F17', 'emoji' => '🫓'],
        'surati' => ['bg' => '#FFFDE7', 'accent' => '#F9A825', 'emoji' => '🌯'],
        'fancy dosa' => ['bg' => '#FBE9E7', 'accent' => '#D84315', 'emoji' => '🌮'],
        'jini roll' => ['bg' => '#FBE9E7', 'accent' => '#BF360C', 'emoji' => '🌯'],
        'uttapam' => ['bg' => '#EFEBE9', 'accent' => '#6D4C41', 'emoji' => '🍘'],
        'kathiyawadi' => ['bg' => '#E8F5E9', 'accent' => '#2E7D32', 'emoji' => '🥘'],
        'khichdi' => ['bg' => '#FFF9C4', 'accent' => '#F9A825', 'emoji' => '🍚'],
        'rajasthani' => ['bg' => '#FCE4EC', 'accent' => '#C62828', 'emoji' => '🫓'],
        'starter' => ['bg' => '#E3F2FD', 'accent' => '#1565C0', 'emoji' => '🍢'],
        'paneer' => ['bg' => '#FFF3E0', 'accent' => '#EF6C00', 'emoji' => '🧀'],
        'kofta' => ['bg' => '#F3E5F5', 'accent' => '#7B1FA2', 'emoji' => '🍡'],
        'kaju' => ['bg' => '#FFF8E1', 'accent' => '#FF8F00', 'emoji' => '🥜'],
        'veg special' => ['bg' => '#E8F5E9', 'accent' => '#388E3C', 'emoji' => '🥗'],
        'dal' => ['bg' => '#FFFDE7', 'accent' => '#FBC02D', 'emoji' => '🍲'],
        'pulav' => ['bg' => '#FFF3E0', 'accent' => '#EF6C00', 'emoji' => '🍛'],
        'rice' => ['bg' => '#FFFDE7', 'accent' => '#F9A825', 'emoji' => '🍚'],
        'biryani' => ['bg' => '#FFF3E0', 'accent' => '#E65100', 'emoji' => '🍛'],
        'pav bhaji' => ['bg' => '#FFEBEE', 'accent' => '#C62828', 'emoji' => '🍔'],
        'beverage' => ['bg' => '#E1F5FE', 'accent' => '#0277BD', 'emoji' => '🥤'],
        'tandoor' => ['bg' => '#EFEBE9', 'accent' => '#5D4037', 'emoji' => '🫓'],
        'bread' => ['bg' => '#FFF8E1', 'accent' => '#FF8F00', 'emoji' => '🍞'],
    ];

    /** @var list<array{keys: list<string>, emoji: string}> */
    private static array $itemEmojiRules = [
        [['garlic'], '🧄'],
        [['cheese', 'paneer'], '🧀'],
        [['tomato'], '🍅'],
        [['schezwan', 'chilli', 'chili', 'mirch'], '🌶️'],
        [['masala'], '🌶️'],
        [['onion'], '🧅'],
        [['corn', 'makai'], '🌽'],
        [['mushroom'], '🍄'],
        [['palak', 'spinach'], '🥬'],
        [['idli'], '🍚'],
        [['vada'], '🍩'],
        [['uttapam'], '🍘'],
        [['pav', 'bhaji'], '🍔'],
        [['biryani', 'pulav', 'rice'], '🍛'],
        [['khichdi', 'khichadi'], '🍚'],
        [['umbadiyu', 'umbadiya'], '🍠'],
        [['dosa', 'paper', 'plain', 'baby'], '🥞'],
        [['coffee', 'tea', 'lassi', 'juice'], '🥤'],
        [['soup'], '🍲'],
        [['kaju', 'cashew'], '🥜'],
        [['gathiya', 'farsan'], '🥨'],
        [['paratha', 'thepla', 'bhakri'], '🫓'],
        [['roll', 'jini'], '🌯'],
        [['manchurian'], '🥡'],
        [['sandwich'], '🥪'],
        [['ice', 'falooda'], '🍨'],
    ];

    public static function forItem(string $itemName, string $categoryName, bool $force = false): string
    {
        $slug = Str::slug($itemName);
        $relative = "images/food/items/{$slug}.svg";
        $full = public_path($relative);

        if (! $force && file_exists($full)) {
            return $relative;
        }

        if (! is_dir(dirname($full))) {
            mkdir(dirname($full), 0755, true);
        }

        $style = self::styleForCategory($categoryName);
        $style['emoji'] = self::emojiForItem($itemName, $style['emoji']);
        $style['accent'] = self::accentForItem($itemName, $style['accent']);

        $safeName = htmlspecialchars(self::shortName($itemName), ENT_XML1);
        $categoryHint = htmlspecialchars(Str::limit($categoryName, 32), ENT_XML1);
        $initial = htmlspecialchars(mb_strtoupper(mb_substr(trim($itemName), 0, 1)), ENT_XML1);

        $svg = <<<SVG
<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 200" width="320" height="200">
  <defs>
    <linearGradient id="g" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="{$style['bg']}"/>
      <stop offset="100%" stop-color="#ffffff"/>
    </linearGradient>
  </defs>
  <rect width="320" height="200" fill="url(#g)" rx="12"/>
  <circle cx="160" cy="70" r="48" fill="{$style['accent']}" opacity="0.12"/>
  <circle cx="248" cy="36" r="18" fill="{$style['accent']}" opacity="0.85"/>
  <text x="248" y="42" text-anchor="middle" font-family="Georgia,serif" font-size="16" fill="#fff" font-weight="bold">{$initial}</text>
  <text x="160" y="82" text-anchor="middle" font-size="44">{$style['emoji']}</text>
  <text x="160" y="128" text-anchor="middle" font-family="Georgia,serif" font-size="14" font-weight="bold" fill="#3E2723">{$safeName}</text>
  <text x="160" y="150" text-anchor="middle" font-family="Arial,sans-serif" font-size="10" fill="#795548">{$categoryHint}</text>
  <rect x="12" y="12" width="56" height="22" rx="11" fill="#43A047"/>
  <text x="40" y="27" text-anchor="middle" font-family="Arial,sans-serif" font-size="11" fill="#fff" font-weight="bold">VEG</text>
</svg>
SVG;

        file_put_contents($full, $svg);

        return $relative;
    }

    private static function emojiForItem(string $itemName, string $fallback): string
    {
        $lower = strtolower($itemName);
        foreach (self::$itemEmojiRules as [$keys, $emoji]) {
            foreach ($keys as $key) {
                if (str_contains($lower, $key)) {
                    return $emoji;
                }
            }
        }

        return $fallback;
    }

    private static function accentForItem(string $itemName, string $baseAccent): string
    {
        $hash = abs(crc32(strtolower($itemName)));
        $offsets = [0, 8, 16, -8, 12, -12];
        $offset = $offsets[$hash % count($offsets)];

        return self::shiftHexColor($baseAccent, $offset);
    }

    private static function shiftHexColor(string $hex, int $shift): string
    {
        $hex = ltrim($hex, '#');
        if (strlen($hex) !== 6) {
            return '#'.$hex;
        }

        $r = max(0, min(255, hexdec(substr($hex, 0, 2)) + $shift));
        $g = max(0, min(255, hexdec(substr($hex, 2, 2)) + $shift));
        $b = max(0, min(255, hexdec(substr($hex, 4, 2)) + $shift));

        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }

    private static function styleForCategory(string $category): array
    {
        $lower = strtolower($category);
        foreach (self::$categoryStyles as $key => $style) {
            if (str_contains($lower, $key)) {
                return $style;
            }
        }

        return ['bg' => '#FFEBEE', 'accent' => '#C62828', 'emoji' => '🍽️'];
    }

    private static function shortName(string $name): string
    {
        return Str::limit($name, 28, '…');
    }
}
