<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ImageSyncService
{
    /** @var array<string, string> */
    private static array $urlCache = [];

    public static function syncUrl(?string $url, string $folder, ?string $basename = null): ?string
    {
        if (! $url) {
            return null;
        }

        if (str_starts_with($url, 'images/')) {
            return $url;
        }

        if (! str_starts_with($url, 'http')) {
            return $url;
        }

        if (isset(self::$urlCache[$url])) {
            return self::$urlCache[$url];
        }

        $hashBase = substr(md5($url), 0, 12);
        $slugBase = $basename ? Str::slug($basename) : 'image';
        $relative = "images/{$folder}/{$slugBase}.jpg";
        $hashRelative = "images/{$folder}/u-{$hashBase}.jpg";
        $full = public_path($relative);
        $hashFull = public_path($hashRelative);

        foreach ([$hashFull => $hashRelative, $full => $relative] as $path => $rel) {
            if (file_exists($path) && filesize($path) > 1024) {
                self::$urlCache[$url] = $rel;

                return $rel;
            }
        }

        if (! is_dir(dirname($hashFull))) {
            mkdir(dirname($hashFull), 0755, true);
        }

        try {
            $response = Http::timeout(30)
                ->withHeaders(['User-Agent' => 'GaneshRestaurant/1.0'])
                ->get($url);
            if ($response->successful() && strlen($response->body()) > 1024) {
                file_put_contents($hashFull, $response->body());
                self::$urlCache[$url] = $hashRelative;

                return $hashRelative;
            }
        } catch (\Throwable) {
        }

        return $url;
    }
}
