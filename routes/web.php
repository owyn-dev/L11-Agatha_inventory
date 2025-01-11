<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Auth\Login::class)->name('auth.login');

Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');

Route::get('/priority-analysis', \App\Livewire\PriorityAnalysis::class)->name('priority-analysis');

Route::get('/product/index', \App\Livewire\ManageProduct\ProductIndex::class)->name('product.index');
Route::get('/product/show', \App\Livewire\ManageProduct\ProductShow::class)->name('product.show');
Route::get('/product/create', \App\Livewire\ManageProduct\ProductCreate::class)->name('product.create');
Route::get('/product/update', \App\Livewire\ManageProduct\ProductUpdate::class)->name('product.update');
Route::delete('/product/destroy', \App\Livewire\ManageProduct\ProductDestroy::class)->name('product.destroy');
Route::get('/product/barcode_scanner', \App\Livewire\ManageProduct\ProductBarcodeScanner::class)->name('product.barcode-scanner');

Route::get('/production/index', \App\Livewire\ManageProduction\ProductionIndex::class)->name('production.index');
Route::get('/production/show', \App\Livewire\ManageProduction\ProductionShow::class)->name('production.show');
Route::get('/production/update', \App\Livewire\ManageProduction\ProductionUpdate::class)->name('production.update');
Route::get('/production/request', \App\Livewire\ManageProduction\ProductionRequest::class)->name('production.request');
Route::get('/production/request/create', \App\Livewire\ManageProduction\ProductionRequestCreate::class)->name('production.request.create');
Route::get('/production/report', \App\Livewire\ManageProduction\ProductionReport::class)->name('production.report');

Route::get('/sales/index', \App\Livewire\ManageSales\SalesIndex::class)->name('sales.index');
Route::get('/sales/show', \App\Livewire\ManageSales\SalesShow::class)->name('sales.show');
Route::get('/sales/create', \App\Livewire\ManageSales\SalesCreate::class)->name('sales.create');
Route::get('/sales/report', \App\Livewire\ManageSales\SalesReport::class)->name('sales.report');

Route::get('/inventory/in/index', \App\Livewire\ManageInventory\InventoryIn\InventoryIndex::class)->name('inventory.in.index');
Route::get('/inventory/out/index', \App\Livewire\ManageInventory\InventoryOut\InventoryIndex::class)->name('inventory.out.index');
Route::get('/inventory/report', \App\Livewire\ManageInventory\InventoryReport::class)->name('inventory.report');

Route::get('/inventory/request', \App\Livewire\ManageInventory\InventoryRequest\InventoryRequest::class)->name('inventory.request.index');
Route::get('/inventory/request/show', \App\Livewire\ManageInventory\InventoryRequest\InventoryRequestShow::class)->name('inventory.request.show');
Route::get('/inventory/request/create', \App\Livewire\ManageInventory\InventoryRequest\InventoryRequestCreate::class)->name('inventory.request.create');
Route::get('/inventory/request/update', \App\Livewire\ManageInventory\InventoryRequest\InventoryRequestUpdate::class)->name('inventory.request.update');
Route::get('/inventory/request/update_status', \App\Livewire\ManageInventory\InventoryRequest\InventoryRequestUpdateStatus::class)->name('inventory.request.update-status');

Route::get('/user/index', \App\Livewire\ManageAccess\UserIndex::class)->name('manage-access.user.index');
Route::get('/user/show', \App\Livewire\ManageAccess\UserShow::class)->name('manage-access.user.show');
Route::get('/user/create', \App\Livewire\ManageAccess\UserCreate::class)->name('manage-access.user.create');
Route::get('/user/update', \App\Livewire\ManageAccess\UserUpdate::class)->name('manage-access.user.update');
Route::get('/user/my_profile', \App\Livewire\ManageAccess\UserProfileUpdate::class)->name('manage-access.user.my-profile.update');
Route::delete('/user/destroy', \App\Livewire\ManageAccess\UserDestroy::class)->name('manage-access.user.destroy');
