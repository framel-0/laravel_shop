<?php

use App\Enums\AppUserAbility;
use App\Http\Controllers\Api\v1\CategoryController;
use App\Http\Controllers\Api\v1\HomeController;
use App\Http\Controllers\Api\v1\ItemController;
use App\Http\Controllers\Api\v1\LocationController;
use App\Http\Controllers\Api\v1\UnitOfMeasureController;
use App\Http\Controllers\Api\v1\UsersController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/', [HomeController::class, 'index']);

//Private Route
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::prefix('/users')->group(function () {
        Route::get('/', [UsersController::class, 'index'])->name('users.index')->middleware('sanctum.abilities:' . AppUserAbility::UserGet->value);
        // Route::post('/', [CategoryController::class, 'store'])->name('users.store')->middleware('sanctum.abilities:categories.create' . AppUserAbility::CategoryCreate->value);
        Route::get('/{user:id}', [UsersController::class, 'show'])->name('users.show')->middleware('sanctum.abilities:' . AppUserAbility::UserGet->value);
        Route::patch('/{user:id}', [UsersController::class, 'update'])->name('users.update')->middleware('sanctum.abilities:' . AppUserAbility::UserUpdate->value);
        Route::delete('/{user:id}', [UsersController::class, 'destroy'])->name('users.destroy')->middleware('sanctum.abilities:' . AppUserAbility::UserDelete->value);
    });

    Route::prefix('/categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('categories.index')->middleware('sanctum.abilities:' . AppUserAbility::CategoryGet->value);
        Route::post('/', [CategoryController::class, 'store'])->name('categories.store')->middleware('sanctum.abilities:' . AppUserAbility::CategoryCreate->value);
        Route::get('/{category:id}', [CategoryController::class, 'show'])->name('categories.show')->middleware('sanctum.abilities:' . AppUserAbility::CategoryGet->value);
        Route::patch('/{category:id}', [CategoryController::class, 'update'])->name('categories.update')->middleware('sanctum.abilities:' . AppUserAbility::CategoryUpdate->value);
        Route::delete('/{category:id}', [CategoryController::class, 'destroy'])->name('categories.destroy')->middleware('sanctum.abilities:' . AppUserAbility::CategoryDelete->value);
    });

    Route::prefix('/locations')->group(function () {
        Route::get('/', [LocationController::class, 'index'])->name('locations.index')->middleware('sanctum.abilities:' . AppUserAbility::LocationGet->value);
        Route::post('/', [LocationController::class, 'store'])->name('locations.store')->middleware('sanctum.abilities:' . AppUserAbility::LocationCreate->value);
        Route::get('/{location:id}', [LocationController::class, 'show'])->name('locations.show')->middleware('sanctum.abilities:' . AppUserAbility::LocationGet->value);
        Route::patch('/{location:id}', [LocationController::class, 'update'])->name('locations.update')->middleware('sanctum.abilities:' . AppUserAbility::LocationUpdate->value);
        Route::delete('/{location:id}', [LocationController::class, 'destroy'])->name('locations.destroy')->middleware('sanctum.abilities:' . AppUserAbility::LocationDelete->value);
    });

    Route::prefix('/unitofmeasures')->group(function () {
        Route::get('/', [UnitOfMeasureController::class, 'index'])->name('unitofmeasures.index')->middleware('sanctum.abilities:' . AppUserAbility::UnitOfMeasureGet->value);
        Route::post('/', [UnitOfMeasureController::class, 'store'])->name('unitofmeasures.store')->middleware('sanctum.abilities:' . AppUserAbility::UnitOfMeasureCreate->value);
        Route::get('/{unitOfMeasure:id}', [UnitOfMeasureController::class, 'show'])->name('unitofmeasures.show')->middleware('sanctum.abilities:' . AppUserAbility::UnitOfMeasureGet->value);
        Route::patch('/{unitOfMeasure:id}', [UnitOfMeasureController::class, 'update'])->name('unitofmeasures.update')->middleware('sanctum.abilities:' . AppUserAbility::UnitOfMeasureUpdate->value);
        Route::delete('/{unitOfMeasure:id}', [UnitOfMeasureController::class, 'destroy'])->name('unitofmeasures.destroy')->middleware('sanctum.abilities:' . AppUserAbility::UnitOfMeasureDelete->value);
    });

    Route::prefix('/items')->group(function () {
        Route::get('/', [ItemController::class, 'index'])->name('items.index')->middleware('sanctum.abilities:' . AppUserAbility::ItemGet->value);
        Route::post('/', [ItemController::class, 'store'])->name('items.store')->middleware('sanctum.abilities:' . AppUserAbility::ItemCreate->value);
        Route::get('/{item:id}', [ItemController::class, 'show'])->name('items.show')->middleware('sanctum.abilities:' . AppUserAbility::ItemGet->value);
        Route::patch('/{item:id}', [ItemController::class, 'update'])->name('items.update')->middleware('sanctum.abilities:' . AppUserAbility::ItemUpdate->value);
        Route::delete('/{item:id}', [ItemController::class, 'destroy'])->name('items.destroy')->middleware('sanctum.abilities:' . AppUserAbility::ItemDelete->value);
    });
});
