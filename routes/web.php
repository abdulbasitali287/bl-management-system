<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ShipperController;
use App\Http\Controllers\ForwarderController;
use App\Http\Controllers\BillOfLadingController;
use App\Http\Controllers\ShippingLineController;
use App\Http\Controllers\RoleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('bank')->controller(BankController::class)->group(function(){
        Route::get('/','index')->name('bank.index');
        Route::get('create','create')->name('bank.create');
        Route::post('store','store')->name('bank.post.store');
        Route::get('edit/{id}','edit')->name('bank.edit');
        Route::put('update/{id}','update')->name('bank.update');
        Route::delete('trash/{id}','trash')->name('bank.trash');
        Route::get('trashed','bankTrash')->name('bank.bankTrash');
        Route::get('restore-trash/{id}','restoreTrash')->name('bank.restoreTrashed');
        Route::get('force-delete/{id}','forceDeleted')->name('bank.forceDeleted');
    });

    Route::prefix('forwarder')->controller(ForwarderController::class)->group(function(){
        Route::get('/','index')->name('forwarder.index');
        Route::get('create','create')->name('forwarder.create');
        Route::post('store','store')->name('forwarder.store');
        Route::get('edit/{id}','edit')->name('forwarder.edit');
        Route::put('update/{id}','update')->name('forwarder.update');
        Route::delete('trash/{id}','trash')->name('forwarder.trash');
        Route::get('trashed','trashed')->name('forwarder.trashed');
        Route::get('restore-trash/{id}','restoreTrash')->name('forwarder.restoreTrashed');
        Route::get('force-delete/{id}','forceDeleted')->name('forwarder.forceDeleted');
    });

    Route::prefix('agents')->controller(AgentController::class)->group(function(){
        Route::get('/','index')->name('agent.index');
        Route::get('create','create')->name('agent.create');
        Route::post('store','store')->name('agent.store');
        Route::get('edit/{id}','edit')->name('agent.edit');
        Route::put('update/{id}','update')->name('agent.update');
        Route::delete('trash/{id}','trash')->name('agent.trash');
        Route::get('trashed','trashed')->name('agent.trashed');
        Route::get('restore-trash/{id}','restoreTrash')->name('agent.restoreTrashed');
        Route::get('force-delete/{id}','forceDeleted')->name('agent.forceDeleted');
    });

    Route::prefix('roles')->controller(RoleController::class)->group(function(){
        Route::get('/','index')->name('roles.index');
        Route::get('create','create')->name('roles.create');
        Route::post('store','store')->name('roles.store');
        Route::get('edit/{id}','edit')->name('roles.edit');
        Route::put('update/{id}','update')->name('roles.update');
        Route::get('trash/{id}','trash')->name('roles.trash');
        Route::get('trashed','trashed')->name('roles.trashed');
        Route::get('restore-trash/{id}','restoreTrash')->name('roles.restoreTrashed');
        Route::get('force-delete/{id}','forceDeleted')->name('roles.forceDeleted');
        Route::delete('bulk-delete','bulkDelete')->name('roles.bulkDelete');
    });

    Route::prefix('shippers')->controller(ShipperController::class)->group(function(){
        Route::get('/','index')->name('shipper.index');
        Route::get('create','create')->name('shipper.create');
        Route::post('store','store')->name('shipper.store');
        Route::get('edit/{id}','edit')->name('shipper.edit');
        Route::put('update/{id}','update')->name('shipper.update');
        Route::delete('trash/{id}','trash')->name('shipper.trash');
        Route::get('trashed','trashed')->name('shipper.trashed');
        Route::get('restore-trash/{id}','restoreTrash')->name('shipper.restoreTrashed');
        Route::get('force-delete/{id}','forceDeleted')->name('shipper.forceDeleted');
    });

    Route::prefix('shipping-line')->controller(ShippingLineController::class)->group(function(){
        Route::get('/','index')->name('shipping-line.index');
        Route::get('create','create')->name('shipping-line.create');
        Route::post('store','store')->name('shipping-line.store');
        Route::get('edit/{id}','edit')->name('shipping-line.edit');
        Route::put('update/{id}','update')->name('shipping-line.update');
        Route::delete('trash/{id}','trash')->name('shipping-line.trash');
        Route::get('trashed','trashed')->name('shipping-line.trashed');
        Route::get('restore-trash/{id}','restoreTrash')->name('shipping-line.restoreTrashed');
        Route::get('force-delete/{id}','forceDeleted')->name('shipping-line.forceDeleted');
    });

    Route::prefix('bill-of-lading')->controller(BillOfLadingController::class)->group(function(){
        Route::get('/','index')->name('bill-of-lading.index');
        Route::get('create','create')->name('bill-of-lading.create');
        Route::post('store','store')->name('bill-of-lading.store');
        Route::get('edit/{id}','edit')->name('bill-of-lading.edit');
        Route::put('update/{id}','update')->name('bill-of-lading.update');
        Route::delete('trash/{id}','trash')->name('bill-of-lading.trash');
        Route::get('trashed','trashed')->name('bill-of-lading.trashed');
        Route::get('restore-trash/{id}','restoreTrash')->name('bill-of-lading.restoreTrashed');
        Route::get('force-delete/{id}','forceDeleted')->name('bill-of-lading.forceDeleted');
    });

});



require __DIR__.'/auth.php';
