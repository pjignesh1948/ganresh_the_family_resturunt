<?php

namespace App\Console\Commands;

use App\Models\MenuItem;
use App\Support\MenuFoodImageGenerator;
use Illuminate\Console\Command;

class GenerateMenuImages extends Command
{
    protected $signature = 'app:generate-menu-images {--force : Regenerate all item images}';

    protected $description = 'Generate unique SVG food card image per menu item';

    public function handle(): int
    {
        $force = (bool) $this->option('force');
        $count = 0;

        MenuItem::query()->with('menuCategory')->each(function (MenuItem $item) use ($force, &$count) {
            $category = $item->menuCategory?->name ?? 'Menu';
            $path = MenuFoodImageGenerator::forItem($item->name, $category, $force);
            if ($item->image !== $path) {
                $item->update(['image' => $path]);
            }
            $count++;
        });

        $this->info("Generated unique images for {$count} menu items.");

        return self::SUCCESS;
    }
}
