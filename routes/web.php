<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Models\Product;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::resource('products', ProductController::class);

Route::resource('sales', SaleController::class)->except([
    'create'
]);

Route::get('sale/create/{product}', [SaleController::class, 'showSaleCreateForm'])->name('sales.create');


Route::fallback(function () {
	$products = Product::with('sales')->latest()->paginate(5);
    
    return view('sales.index',compact('products'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
});
