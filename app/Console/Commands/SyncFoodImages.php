<?php

namespace App\Console\Commands;

use App\Models\MenuCategory;
use App\Models\MenuItem;
use App\Models\Portfolio;
use App\Models\GalleryImage;
use App\Models\Vegetable;
use App\Services\ImageSyncService;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SyncFoodImages extends Command
{
    protected $signature = 'app:sync-food-images';

    protected $description = 'Download remote food images locally for menu, vegetables, gallery';

    public function handle(): int
    {
        $this->info('Syncing unique remote URLs...');
        $urls = MenuItem::query()->where('image', 'like', 'http%')->distinct()->pluck('image');
        foreach ($urls as $url) {
            ImageSyncService::syncUrl($url, 'food/items', 'shared');
        }

        $this->info('Syncing menu item images...');
        MenuItem::query()->whereNotNull('image')->each(function (MenuItem $item) {
            $local = ImageSyncService::syncUrl($item->image, 'food/items', Str::slug($item->name));
            if ($local && $local !== $item->image) {
                $item->update(['image' => $local]);
            }
        });

        MenuItem::query()->where('image', 'like', 'http%')->each(function (MenuItem $item) {
            $local = ImageSyncService::syncUrl($item->image, 'food/items', Str::slug($item->name));
            if ($local && ! str_starts_with($local, 'http')) {
                $item->update(['image' => $local]);

                return;
            }

            $slugPath = 'images/food/items/' . Str::slug($item->name) . '.jpg';
            if (file_exists(public_path($slugPath))) {
                $item->update(['image' => $slugPath]);

                return;
            }

            $categoryFallback = MenuItem::query()
                ->where('menu_category_id', $item->menu_category_id)
                ->where('image', 'like', 'images/%')
                ->value('image');

            if ($categoryFallback) {
                $item->update(['image' => $categoryFallback]);

                return;
            }

            $item->update(['image' => 'images/logo-icon.png']);
        });

        $this->info('Syncing category images...');
        MenuCategory::query()->whereNotNull('image')->each(function (MenuCategory $cat) {
            $local = ImageSyncService::syncUrl($cat->image, 'food/categories', Str::slug($cat->name));
            if ($local && $local !== $cat->image) {
                $cat->update(['image' => $local]);
            }
        });

        $this->info('Syncing vegetable images...');
        Vegetable::query()->whereNotNull('image')->each(function (Vegetable $veg) {
            $local = ImageSyncService::syncUrl($veg->image, 'food/vegetables', Str::slug($veg->name));
            if ($local && $local !== $veg->image) {
                $veg->update(['image' => $local]);
            }
        });

        $this->info('Done!');

        return self::SUCCESS;
    }
}
