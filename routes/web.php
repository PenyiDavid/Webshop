<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Models\Product_type;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/products', function () {
    $termekek = [['brand'=>'Adidas','size'=>39,'price'=>20000],["brand"=>"Nike",'size'=>42,'price'=>31000],["brand"=>"Victory",'size'=>44,'price'=>12000]];
    
    return view('products',['termekek' => $termekek]);
});*/
Route::get('/products/shoes', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/clothes', [ProductController::class, 'clothes_index'])->name('products.clothes_index');
Route::put('/products/update/{id}', [ProductController::class, 'update'])->name('update_stock');

Route::get('/new_product', function() {
    $types = Product_type::all();
    return view('products.new_product', ['types' => $types]);
    });
Route::post('/new_product', [ProductController::class, 'store']);

Route::get('/admin_termekek', [ProductController::class, 'adminIndex'])->name('admin_termekek');
Route::delete('/admin_termekek/delete/{id}', [ProductController::class, 'destroy'])->name('delete_product');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
