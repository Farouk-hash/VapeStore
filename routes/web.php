<?php

use App\Http\Controllers\dashboard\BillsController;
use App\Http\Controllers\dashboard\BrandsController;
use App\Http\Controllers\dashboard\CartridgesController;
use App\Http\Controllers\dashboard\CoilsController;
use App\Http\Controllers\dashboard\ComponentsController;
use App\Http\Controllers\dashboard\DevicesCategoriesController;
use App\Http\Controllers\dashboard\FlavoursController;
use App\Http\Controllers\dashboard\LiquidController;
use App\Http\Controllers\dashboard\TanksController;
use \App\Http\Controllers\dashboard\ProfileController;
use Illuminate\Support\Facades\Route;



Route::prefix('dashboard')->middleware(['auth:admin'])->group(function(){
    // Liquid Section 
    Route::resource('brands', BrandsController::class);
    Route::resource('categories', CartridgesController::class);
    Route::resource('components', ComponentsController::class);
    Route::resource('flavours', FlavoursController::class);
    Route::resource('liquid',LiquidController::class);

    // Atomizers Section
    Route::resource('tanks', TanksController::class);
    Route::resource('coils', CoilsController::class);
    Route::resource('cartridges', CartridgesController::class);

    // Employees , Customers ;
    // Route::resource('employee',EmployeeController::class);
    // Route::resource('customers',CustomersController::class);
    
    // BILLS-DETAILS ; 
    // Route::resource('bills',BillsController::class);
    Route::get('billls',[BillsController::class , 'index'])->name('bills.index');
    Route::get('bills/{bill_id}',[BillsController::class , 'show'])->name('bills.show');
    Route::put('bills/{bill_id}',[BillsController::class , 'edit'])->name('bills.edit'); // ADDING NOTES ; 

    // Devices Categories ; 
    Route::get('devices-categories/{categorySlug}', [DevicesCategoriesController::class, 'index'])
        ->name('devicesCategories.index');
    Route::get('devices-categories/{categorySlug?}/{brandId}/{deviceId?}',[DevicesCategoriesController::class ,'show_devices_categories'])
        ->name('devicesCategories.show');
    Route::post('devices-categories',[DevicesCategoriesController::class , 'store_device'])->name('devicesCategories.store');
    
    
    // Inventories [Liquids] ;
    Route::post('inventory/liquid/add/{brand_id}',[LiquidController::class ,'addInventory'])->name('liquid.addInventory');
    // Inventories [Liquids-Details(Strength , Flavors)]
    Route::post('inventory/brands/liquids/strength/add',[BrandsController::class , 'add_strength'])->name('brands.liquid-strength.add');
    Route::delete('inventory/brands/liquids/strength/delete/{liquid_strength_id}',[BrandsController::class , 'delete_strength'])->name('brands.liquid-strength.delete');
    Route::post('inventory/brands/liquids/add',[BrandsController::class , 'add_liquid'])->name('brands.liquid.add');
    Route::post('inventory/brands/liquids/falvors/add/{brand_id}',[BrandsController::class , 'add_flavour'])->name('brands.flavor.add');
    
    // Inventories [Devices-Categories(Pods , Kits , Disposable )];
    Route::post('inventory/devices-categories/add/{deviceId}',[DevicesCategoriesController::class , 'addInventory'])->name('devicesCategories.addInventory');
    
    // Inventories [Devices-Categories(Tanks , Cartridges , Coils )];
    Route::post('inventory/tanks/add/{tankId}',[TanksController::class , 'addInventory'])->name('tanks.addInventory');
    Route::post('inventory/coils/add/{coilId}',[CoilsController::class , 'addInventory'])->name('coils.addInventory');
    Route::post('inventory/cartridges/add/{cartridgeId}',[CartridgesController::class , 'addInventory'])->name('cartridges.addInventory');

});

// ADMIN , SALES [ONLY];
Route::prefix('dashboard')->middleware(['auth:admin,sales'])->group(function(){
    // Livewire Routes;
    Route::get('liquid-selector',fn()=> view('livewire.sales.main'))->name('livewire.liquid-selector');
    Route::get('reports',fn()=>view('livewire.reports.index'))->name('livewire.reports');
    Route::get('groups/{groupId?}',fn($groupId=null)=>view('livewire.group-inventories.index',['forceDetails'=>$groupId]))->name('livewire.group-inventories');
    
    Route::get('customers/{customerID?}',fn($customerID=null)=>view('livewire.customers.main',['forceDetails'=>$customerID]))->name('livewire.customers');
    Route::get('employee',fn()=>view('livewire.employee.index'))->name('livewire.employee');
    Route::get('profile',fn()=>view('livewire.profile.main'))->name('dashboard.profile');
    
    Route::get('liquidLivewire',fn()=>view('livewire.liquids-brands.main'))->name('livewire.liquids');
    Route::get('itemsDetails/{itemID}',fn($itemID)=>view('livewire.liquids-brands.items-details.main', ['itemID'=>$itemID]))->name('livewire.details');
    
    Route::get('devicesLivewire',fn()=>view('livewire.devices-brands.main',))->name('livewire.devices');
    Route::get('devicesItemsDetails/{itemID}/{slug?}',fn($itemID , $slug=null)=>view('livewire.devices-brands.items-details.main',['itemID'=>$itemID , 'slug'=>$slug]))->name('livewire.devices.itemsDetails');
    
    // // END OF LIVEWIRE-ROUTES ; 
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
