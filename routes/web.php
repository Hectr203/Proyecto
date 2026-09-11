<?php

use App\Livewire\Modules\Admin\Reports\DashboardReports;
use App\Livewire\Modules\Client\Catalog\Store;
use Illuminate\Support\Facades\Route;

Route::get('/', Store::class)->name('home');
Route::get('/tienda', Store::class)->name('store');
Route::get('/producto/{sku}', \App\Livewire\Modules\Client\Catalog\ProductDetail::class)->name('product.show');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/checkout', \App\Livewire\Modules\Client\Cart\Checkout::class)->name('checkout');
    Route::get('/checkout/success', \App\Livewire\Modules\Client\Cart\CheckoutSuccess::class)->name('checkout.success');
    
    Route::get('dashboard', Store::class)->name('dashboard');
    Route::view('profile', 'modules.Profile.pages.index')->name('profile');

    Route::middleware([\App\Core\Auth\Middleware\IsSuperAdmin::class])->group(function () {
        Route::get('/admin/products', \App\Livewire\Modules\Admin\Products\ProductManager::class)->name('admin.products');
        Route::get('/admin/categories', \App\Livewire\Modules\Admin\Categories\CategoryManager::class)->name('admin.categories');
        Route::get('/admin/reports', \App\Livewire\Modules\Admin\Reports\DashboardReports::class)->name('admin.reports');
    });
});

require __DIR__.'/auth.php';
