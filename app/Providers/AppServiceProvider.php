<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Blade::directive('media', function ($expression) {
            return "<?php echo \\App\\Providers\\AppServiceProvider::mediaUrl($expression); ?>";
        });
    }

    public static function mediaUrl(?string $path): string
    {
        if (! $path) {
            return asset('images/logo-icon.png');
        }
        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return $path;
        }
        if (str_starts_with($path, 'images/') || str_starts_with($path, 'uploads/')) {
            return asset($path);
        }

        if (is_file(public_path('uploads/'.$path))) {
            return asset('uploads/'.$path);
        }

        return asset('storage/'.$path);
    }
}
