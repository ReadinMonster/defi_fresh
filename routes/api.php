<?php
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\EntryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Brand Routes-----------------------------------
Route::resource('brands', BrandController::class, [
  'only' => ['index', 'show']
]);

Route::resource('brand', BrandController::class, [
  'only' => ['destroy', 'store', 'update']
]);


//Category Routes-----------------------------------
Route::resource('categories', CategoryController::class, [
  'only' => ['index']
]);

Route::resource('category', CategoryController::class, [
  'only' => ['store']
]);


//Product Routes-----------------------------------
Route::resource('products', ProductController::class, [
  'only' => ['index', 'show']
]);

Route::resource('product', ProductController::class, [
  'only' => ['destroy', 'store', 'update']
]);


//Supplier Routes-----------------------------------
Route::resource('suppliers', SupplierController::class, [
  'only' => ['index', 'show']
]);

Route::resource('supplier', SupplierController::class, [
  'only' => ['destroy', 'store', 'update']
]);

//User Routes-----------------------------------
Route::resource('users', UserController::class, [
  'only' => ['index', 'show']
]);

Route::resource('user', UserController::class, [
  'only' => ['destroy', 'store', 'update']
]);
