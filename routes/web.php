<?php

use App\Http\Controllers\debugController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::middleware('guest')->group(function () {
    Route::get('/', \App\Livewire\Auth\Login::class)->name('login'); // Done
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

    Route::get('/priority-analysis', \App\Livewire\PriorityAnalysis::class)->name('priority-analysis'); // Done

    Route::get('/product/index', \App\Livewire\ManageProduct\ProductIndex::class)->name('product.index'); // Done
    Route::get('/product/{product}/show', \App\Livewire\ManageProduct\ProductShow::class)->name('product.show'); // Done
    Route::get('/product/create', \App\Livewire\ManageProduct\ProductCreate::class)->name('product.create'); // Done
    Route::get('/product/{product}/update', \App\Livewire\ManageProduct\ProductUpdate::class)->name('product.update'); // Done
    Route::get('/product/barcode_scanner', \App\Livewire\ManageProduct\ProductBarcodeScanner::class)->name('product.barcode-scanner'); // Done

    Route::get('/production/index', \App\Livewire\ManageProduction\ProductionIndex::class)->name('production.index'); // Done
    Route::get('/production/{production}/show', \App\Livewire\ManageProduction\ProductionShow::class)->name('production.show'); // Done
    Route::get('/production/{production}/update', \App\Livewire\ManageProduction\ProductionUpdate::class)->name('production.update'); // Done
    Route::get('/production/request', \App\Livewire\ManageProduction\ProductionRequest::class)->name('production.request'); // Done
    Route::get('/production/request/{production}/create', \App\Livewire\ManageProduction\ProductionRequestCreate::class)->name('production.request.create'); // Done
    Route::get('/production/report', \App\Livewire\ManageProduction\ProductionReport::class)->name('production.report'); // Done

    Route::get('/sales/index', \App\Livewire\ManageSales\SalesIndex::class)->name('sales.index'); // Done
    Route::get('/sales/{sales}/show', \App\Livewire\ManageSales\SalesShow::class)->name('sales.show'); // Done
    Route::get('/sales/create', \App\Livewire\ManageSales\SalesCreate::class)->name('sales.create'); // Done
    Route::get('/sales/report', \App\Livewire\ManageSales\SalesReport::class)->name('sales.report'); // Done

    Route::get('/inventory/in/index', \App\Livewire\ManageInventory\InventoryIn\InventoryIndex::class)->name('inventory.in.index'); // Done
    Route::get('/inventory/out/index', \App\Livewire\ManageInventory\InventoryOut\InventoryIndex::class)->name('inventory.out.index'); // Done
    Route::get('/inventory/report', \App\Livewire\ManageInventory\InventoryReport::class)->name('inventory.report'); // Done

    Route::get('/inventory/request', \App\Livewire\ManageInventory\InventoryRequest\InventoryRequest::class)->name('inventory.request.index'); // done
    Route::get('/inventory/request/{production}/show', \App\Livewire\ManageInventory\InventoryRequest\InventoryRequestShow::class)->name('inventory.request.show'); // Done
    Route::get('/inventory/request/create', \App\Livewire\ManageInventory\InventoryRequest\InventoryRequestCreate::class)->name('inventory.request.create'); // Done
    Route::get('/inventory/request/{production}/update', \App\Livewire\ManageInventory\InventoryRequest\InventoryRequestUpdate::class)->name('inventory.request.update'); // Done
    Route::get('/inventory/request/{production}/update_status', \App\Livewire\ManageInventory\InventoryRequest\InventoryRequestUpdateStatus::class)->name('inventory.request.update-status'); // Done

    Route::get('/user/index', \App\Livewire\ManageAccess\UserIndex::class)->name('manage-access.user.index'); // Done
    Route::get('/user/{user}/show', \App\Livewire\ManageAccess\UserShow::class)->name('manage-access.user.show'); // Done
    Route::get('/user/create', \App\Livewire\ManageAccess\UserCreate::class)->name('manage-access.user.create'); // Done
    Route::get('/user/{user}/update', \App\Livewire\ManageAccess\UserUpdate::class)->name('manage-access.user.update'); // Done
    Route::get('/user/{user}/my_profile', \App\Livewire\ManageAccess\UserProfileUpdate::class)->name('manage-access.user.my-profile.update'); // Done

    Route::get('logout', function () {
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();

        flash()->success('See You Next Time');

        return redirect()->route('login');
    })->name('logout');
});

Route::get('/debug', [debugController::class, 'index']);
Route::get('/debug/sale', [debugController::class, 'testing_sale']);
