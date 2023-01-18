<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerLoginController;
use App\Http\Controllers\CustomerRegisterController;
use App\Http\Controllers\GithubController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\PasswordResetcontroller;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\CategoryController;
use App\Models\CustomerLogin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FacebookController;
use App\Http\Controllers\NavigationbarController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\App;
use App\Http\Middleware\CheckRoleMiddleware;
use App\Http\Middleware\CheckAuthenticationMiddleware;

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
// fronend
Route::get('/', [FrontendController::class, 'index'])->name('index');

// Route::get('/', function () {
//     return view('frontend.index');
// });
//user
Auth::routes();
Route::post('/add/role', [HomeController::class, 'role']);




Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/admin', [HomeController::class, 'admin'])->name('admin');

//navigation bar
Route::controller(NavigationbarController::class)->group(function(){
    Route::get('/logos', 'logos')->name('logos');
    Route::get('/menus', 'menus')->name('menus');
    Route::get('/submenus', 'submenus')->name('submenus');

});
//Category
Route::get('/category', [CategoryController::class,  'category'])->name('category');

Route::middleware(['checkrole'])->group(function () {
    Route::post('/category/insert', [CategoryController::class, 'insert'])->name('category_insert');
    Route::get('/category/delete/{category_id}', [CategoryController::class, 'delete'])->name('category_delete');
    Route::get('/category/edit/{category_id}', [CategoryController::class, 'edit'])->name('category_edit');
    Route::post('/category/update', [CategoryController::class, 'update'])->name('category_update');
    Route::get('/category/restore/{category_id}', [CategoryController::class, 'restore'])->name('category_restore');
    Route::get('/category/forcedelete/{trashed_category_id}', [CategoryController::class, 'force_delete'])->name('force_delete');
});



//subcategory
Route::get('/subcategory', [SubcategoryController::class, 'subcategory'])->name('sub_category');
Route::middleware(['checkrole'])->group(function () {
    Route::post('/subcategory/insert', [SubcategoryController::class, 'insert'])->name('sub_category_insert');
    Route::get('/subcategory/edit/{subcategory_id}', [SubcategoryController::class, 'edit'])->name('sub_category_edit');
    Route::get('/subcategory/delete/{subcategory_id}', [SubcategoryController::class, 'delete'])->name('sub_category_delete');
    Route::post('/subcategory/update', [SubcategoryController::class, 'update'])->name('sub_category_update');
    Route::get('/subcategory/restore/{subcategory_id}', [SubcategoryController::class, 'restore'])->name('sub_category_restore');
    Route::get('/subcategory/permanent_delete/{subcategory_id}', [SubcategoryController::class, 'sub_per_delete'])->name('sub_per_delete');
});


// Profile
Route::middleware(['checkrole'])->group(function () {
Route::get('/profile/edit', [ProfileController::class, 'profile_edit'])->name('profile_edit');
Route::post('/profile/update', [ProfileController::class, 'profile_update'])->name('profile_update');
});

//product

Route::get('/product_details/{sing_product_id}', [ProductController::class, 'product_details'])->name('product_details');


Route::post('/getsubcategory', [ProductController::class, 'getsubcategory']);
Route::post('/product/insert', [ProductController::class, 'product_insert'])->name('product.insert');
Route::get('edit/product/{product_id}', [ProductController::class, 'product_edit'])->name('product_edit');
Route::post('/getsize', [ProductController::class, 'getsize']);

//Inventory
Route::middleware(['checkrole'])->group(function () {
Route::get('/add/product', [ProductController::class, 'index'])->name('add.product');
Route::get('/inventory/{invenotry_id}', [ProductController::class, 'inventory'])->name('inventory');
Route::post('/inventory/insert', [ProductController::class, 'inventory_insert'])->name('inventory_insert');
});
//Color And Size
Route::get('/color_size', [ProductController::class, 'color_size'])->name('color_size');
Route::middleware(['checkrole'])->group(function () {
    Route::post('/color_size/insert', [ProductController::class, 'color_size_insert'])->name('color_size_insert');
    Route::post('/size/insert', [ProductController::class, 'size_insert'])->name('size_insert');
});
//getcity
Route::post('/getcity', [CheckoutController::class, 'getcity']);
//order_success
Route::get('/order/success', [CheckoutController::class, 'order_success'])->name('order_success');
//getsizeId ajax
Route::post('/getsize_id', [ProductController::class, 'getsize_id'])->name('getsizeid');
//send sizeId ajax
Route::post('/sendsize_id', [ProductController::class, 'SendsizeId'])->name('SendSizeId');



//frontend Login & Register
Route::get('/customer_register', [CustomerRegisterController::class, 'customer_register'])->name('customer_register');
Route::post('/customer/register', [CustomerRegisterController::class, 'customerregister'])->name('customer.register');
Route::post('/customer/login', [CustomerLoginController::class, 'customerlogin'])->name('customerlogin');
//customer profile
Route::get('/customer/profile', [CustomerLoginController::class, 'customer_profile'])->name('customer_profile');
Route::post('/customer/update', [CustomerRegisterController::class, 'customer_update']);
Route::get('/customer/singout', [CustomerRegisterController::class, 'customer_singout'])->name('customer_singout');


// customer email verify
Route::get('/customer/email/verify/{verify_token}', [CustomerLoginController::class, 'email_verify']);
Route::get('/customer/email/verified', [CustomerLoginController::class, 'email_verified'])->name('email_verified');
// Route::get('/logout', [LoginController::class, 'logout'])


//password Reset
Route::controller(PasswordResetcontroller::class)->group(function(){
    Route::post('/forgot/send/email', 'forgot_send_email')->name('forgot.send.email');
    Route::get('/forgotpassword', 'forgotpassword')->name('forgotpassword');
    Route::get('/customer/password/reset/form/{reset_token}', 'CustomerResetForm')->name('customer.reset.form');
    Route::post('/customer/password/reset/update', 'CustomerResetUpdate')->name('customer.reset.update');
});

//Github
Route::get('/github/redirect', [GithubController::class, 'redirectToProvider']);
Route::get('/github/callback', [GithubController::class, 'redirectToWebsite']);
//Google
Route::get('/google/redirect', [GoogleController::class, 'redirectToProvider']);
Route::get('/google/callback', [GoogleController::class, 'redirectToWebsite']);
//Facebook
Route::get('/facebook/redirect', [FacebookController::class, 'redirectToProvider'])->name('facebook.redirect');
Route::get('/facebook/callback', [FacebookController::class, 'redirectToWebsite']);


//shop
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
//cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/update', [CartController::class, 'cart_update'])->name('cart_update');
Route::post('/cart/insert', [CartController::class, 'cart_insert'])->name('cart_insert');
Route::get('/cart/delete/{cart_id}', [CartController::class, 'cart_delete'])->name('cart_delete');
Route::get('/clear/cart', [CartController::class, 'clear_cart'])->name('clear_cart');

//wishlist
Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('wishlist');
Route::get('/wishlist/product_id', [WishlistController::class, 'wishlist_product_id'])->name('wishlist.product.id');



//coupon
Route::get('/cart/{usecoupon}', [CartController::class, 'cart']);
Route::get('/coupon', [CouponController::class, 'coupon'])->name('coupon');
Route::post('/coupon/insert', [CouponController::class, 'coupon_insert'])->name('coupon_insert');

//Review
Route::post('review/put', [ProductController::class, 'review_put'])->name('review.put')->middleware('checkloggedin');

//checkout
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
//order
Route::post('/order/insert', [CheckoutController::class, 'order_insert']);
//invoice
Route::get('/invoice/download/{order_id}', [CustomerLoginController::class, 'invoice_download'])->name('invoice.download');
Route::get('/invoice/view/{order_id}', [CustomerLoginController::class, 'invoice_view'])->name('invoice.view');




// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::post('/pay', [SslCommerzPaymentController::class, 'index']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END




