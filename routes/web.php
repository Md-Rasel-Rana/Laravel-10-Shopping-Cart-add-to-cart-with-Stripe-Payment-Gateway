
<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\ProductsControlle;

//Route::get('/', function () {
//    return view('welcome');
//});
Route::post('/session', [StripeController::class, 'session'])->name('session');
Route::get('/success', [StripeController::class, 'success'])->name('success');
Route::get('/cancel', [StripeController::class, 'cancel'])->name('cancel');

Route::get('/', [ProductsControlle::class, 'index']);
Route::get('cart', [ProductsControlle::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [ProductsControlle::class, 'addToCart'])->name('add_to_cart');
Route::patch('update-cart', [ProductsControlle::class, 'update'])->name('update_cart');
Route::delete('remove-from-cart', [ProductsControlle::class, 'remove'])->name('remove_from_cart');