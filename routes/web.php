<?php
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('products', ProductController::class);
Route::get('/products/search-suggestions', [ProductController::class, 'searchSuggestions']);

Route::get('/products/suggestions', [ProductController::class, 'getSuggestions'])->name('product.suggestions');