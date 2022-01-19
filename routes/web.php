<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\ProductListController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DiscountTimeController;
use App\Http\Controllers\LookupController;
use App\Http\Controllers\OrderAcpController;
use App\Http\Controllers\OrderSerialController;
use App\Http\Controllers\PrintController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

Auth::routes(['verify' => true]);

Route::get('/product/{id}', [ProductDetailController::class, 'show']);

Route::get('/sale', [ProductListController::class, 'index']);

Route::get('/product/type/{id}', [ProductListController::class, 'show']);

Route::get('/cart/{id}', [CartController::class, 'index']);

Route::group(['middleware' => ['auth','admin']], function (){
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/{id}', [AdminController::class, 'show']);

    Route::post('/admin/{id}/create', [AdminController::class, 'store']);
});

Route::get('/lookup', function() {
    return view('shipping');
});

Route::get('/profile', function() {
    return view('profile');
});

/* Route::get('/cart', function() {
    return view('cart');
}); */

Route::get('users/{id}', function ($id) {

});

/* Route::resource('/admin/product', AdminProductController::class); */
/* Route::post('product',[AdminProductController::class,'store']); */
// product
Route::post('insert-product',[AdminProductController::class, 'create']);
Route::post('update-product/{id}',[AdminProductController::class, 'update']);
Route::get('delete-product/{id}',[AdminProductController::class, 'destroy']);

// employee
Route::post('insert-employee',[EmployeeController::class, 'create']);
Route::post('update-employee/{id}',[EmployeeController::class, 'update']);
Route::get('delete-employee/{id}',[EmployeeController::class, 'destroy']);
Route::get('/cart', [CartController::class, 'index']);

// profile update
Route::post('insert-profile/{id}',[UserController::class, 'update']);

// cart
Route::post('insert-cart',[CartController::class, 'create']);
Route::post('delete-cart/{id}',[CartController::class, 'destroy']);

// order
Route::post('insert-order',[OrderController::class, 'create']);

Route::post('/dis-order',[OrderController::class, 'update']);

Route::post('acp',[OrderAcpController::class, 'update']);

Route::post('/add-serial',[OrderSerialController::class, 'update']);

Route::get('order',[OrderController::class, 'index']);

// discount
Route::post('change-discount',[DiscountTimeController::class, 'update']);

// lookup
Route::post('/look',[LookupController::class, 'create']);


//user
Route::post('/delete-user',[UserController::class, 'destroy']);

//bill
Route::get('/print/{id}', [PrintController::class, 'show']);

Route::get('/home', [HomeController::class, 'index'])
->middleware(['auth:sanctum' , 'verified']);



// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');



// Gui mail xac nhan
Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');



Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'To Esdc store : Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
// end gui mail 




// Email da kich hoat
Route::get('/profile', function () {
    // Only verified users may access this route...
    return view('profile');
})->middleware('verified');




