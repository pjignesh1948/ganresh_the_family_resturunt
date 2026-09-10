<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FounderController;
use App\Http\Controllers\Admin\GalleryCategoryController;
use App\Http\Controllers\Admin\GalleryImageController;
use App\Http\Controllers\Admin\HomeSliderController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SopController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\TeamMemberController;
use App\Http\Controllers\Admin\VegetableController;
use App\Http\Controllers\Admin\VegetableFlyerController;
use App\Http\Controllers\Admin\VegetableSaleController;
use App\Http\Controllers\Admin\VideoCategoryController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Front\FrontController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontController::class, 'home'])->name('front.home');
Route::get('/about-us', [FrontController::class, 'about'])->name('front.about');
Route::get('/our-team', [FrontController::class, 'team'])->name('front.team');
Route::get('/online-order', [FrontController::class, 'order'])->name('front.order');
Route::post('/online-order', [FrontController::class, 'placeOrder'])->name('front.order.store');
Route::get('/online-order/success/{orderNo}', [FrontController::class, 'orderSuccess'])->name('front.order.success');
Route::get('/portfolio', [FrontController::class, 'portfolio'])->name('front.portfolio');
Route::get('/gallery', [FrontController::class, 'gallery'])->name('front.gallery');
Route::get('/videos', [FrontController::class, 'videos'])->name('front.videos');
Route::get('/vegetable-calculator', [FrontController::class, 'vegetables'])->name('front.vegetables');
Route::post('/vegetable-calculator/calculate', [FrontController::class, 'calculateVegetable'])->name('front.vegetables.calculate');
Route::post('/vegetable-calculator/save', [FrontController::class, 'saveVegetableSales'])->name('front.vegetables.save');
Route::get('/contact-us', [FrontController::class, 'contact'])->name('front.contact');
Route::post('/contact-us', [FrontController::class, 'sendContact'])->name('front.contact.store');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::middleware('admin.auth')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('menu-categories', MenuCategoryController::class);
        Route::resource('menu-items', MenuItemController::class);
        Route::resource('orders', OrderController::class)->only(['index', 'show']);
        Route::get('orders-poll/new', [OrderController::class, 'pollNew'])->name('orders.poll');
        Route::patch('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
        Route::resource('vegetables', VegetableController::class);
        Route::get('vegetables-daily-flyer', [VegetableFlyerController::class, 'show'])->name('vegetables.flyer');
        Route::get('vegetable-sales', [VegetableSaleController::class, 'index'])->name('vegetable-sales.index');
        Route::resource('staff', StaffController::class);
        Route::resource('team-members', TeamMemberController::class)->except(['show']);
        Route::resource('founders', FounderController::class)->except(['show']);
        Route::get('salaries', [SalaryController::class, 'index'])->name('salaries.index');
        Route::post('salaries', [SalaryController::class, 'store'])->name('salaries.store');
        Route::resource('home-sliders', HomeSliderController::class)->except(['show']);
        Route::resource('promotions', PromotionController::class)->except(['show']);
        Route::resource('gallery-categories', GalleryCategoryController::class);
        Route::resource('gallery-images', GalleryImageController::class);
        Route::resource('video-categories', VideoCategoryController::class);
        Route::resource('videos', VideoController::class);
        Route::resource('portfolios', PortfolioController::class);
        Route::resource('sops', SopController::class);
        Route::get('settings', [SettingController::class, 'edit'])->name('settings.edit');
        Route::put('settings', [SettingController::class, 'update'])->name('settings.update');
        Route::get('pages/home', [PageController::class, 'editHome'])->name('pages.home.edit');
        Route::put('pages/home', [PageController::class, 'updateHome'])->name('pages.home.update');
        Route::get('pages/about', [PageController::class, 'editAbout'])->name('pages.about.edit');
        Route::put('pages/about', [PageController::class, 'updateAbout'])->name('pages.about.update');
        Route::resource('contact-messages', ContactMessageController::class)->only(['index', 'show', 'destroy']);
    });
});
