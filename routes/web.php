<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CompanyOrderController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImportController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManufactureController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrademarkController;
use App\Http\Controllers\UserController;
use App\Models\Coupon;
use Illuminate\Support\Facades\Route;

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
// Home Page
Route::group(['middleware' => 'customer'], function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/tim-kiem', [HomeController::class, 'search_product'])->name('search_product');
    Route::get('/danh-muc-san-pham/{id}', [HomeController::class, 'show_category'])->name('show-category');
    Route::get('/thuong-hieu/{id}', [HomeController::class, 'show_brand'])->name('show-brand');
    Route::get('/chi-tiet-san-pham/{id}', [ProductController::class, 'details_product'])->name('show-detail-product');

    // Cart Action
    Route::group(['middleware' => 'login'], function() {
        Route::post('/save-cart', [CartController::class, 'save-cart'])->name('save-cart');
        Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax'])->name('add_cart_ajax');
        Route::post('/update-cart', [CartController::class, 'update_cart'])->name('update_cart');
        Route::get('/gio-hang', [CartController::class, 'gio_hang'])->name('view-cart');
        Route::get('/delete-cart/{session_id}', [CartController::class, 'del_cart'])->name('del_cart');

        //Checkout
        Route::group(['prefix' => 'thanh-toan', 'as' => 'checkout.'], function() {
            Route::get('/', [CheckoutController::class, 'index'])->name('index');
            Route::post('/', [CheckoutController::class, 'save_checkout_customer'])->name('save_checkout');
            Route::post('/place-order', [CheckoutController::class, 'place_order'])->name('place_order');
            Route::get('/hinh-thuc-thanh-toan', [CheckoutController::class, 'payment'])->name('payment');
        });

        //Profile Customer
        Route::group(['prefix' => 'thong-tin-khach-hang', 'as' => 'customer.'], function() {
            Route::get('/', [CustomerController::class, 'show'])->name('index');
            Route::get('/thong-tin-don-hang/{orderId}', [CustomerController::class, 'view_order_user'])->name('view_order_user');
            Route::put('/', [CustomerController::class, 'update_customer'])->name('update_customer');
            // Route::post('/', [CheckoutController::class, 'save_checkout_customer'])->name('save_checkout');
            // Route::post('/place-order', [CheckoutController::class, 'place_order'])->name('place_order');
            // Route::get('/hinh-thuc-thanh-toan', [CheckoutController::class, 'payment'])->name('payment');
        });
        Route::post('/huy-don-hang', [OrderController::class, 'huy_don_hang'])->name('huy_don_hang');
    });
});

// Login Page
Route::get('/dang-nhap', [LoginController::class, 'getLogin'])->name('getLogin');
Route::post('/dang-nhap', [LoginController::class, 'postLogin'])->name('postLogin');
Route::get('/dang-xuat', [LoginController::class, 'getLogout'])->name('logout');
Route::get('/dang-ki-tai-khoan', [LoginController::class, 'getRegister'])->name('getRegister');
Route::post('/dang-ki-tai-khoan', [LoginController::class, 'postRegister'])->name('postRegister');

Route::group(['middleware' => 'admin', 'prefix' => 'admin', 'as' => 'admin.'], function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('index');
    Route::get('/filter-by-date', [AdminController::class, 'filter_by_date'])->name('filter-by-date');
    Route::get('/dashboard-filter', [AdminController::class, 'dashboard_filter'])->name('dashboard-filter');
    Route::get('/days-order', [AdminController::class, 'days_order'])->name('days-order');

    //Manufacture
    Route::get('/manufactures', [ManufactureController::class, 'index'])->name('manufacture.index');
    Route::get('/manufactures/create', [ManufactureController::class, 'create'])->name('manufacture.create');
    Route::post('/manufactures', [ManufactureController::class, 'store'])->name('manufacture.store');
    Route::get('/manufactures/{id}', [ManufactureController::class, 'show'])->name('manufacture.show');
    Route::put('/manufactures/{id}', [ManufactureController::class, 'update'])->name('manufacture.update');
    Route::delete('/manufactures/{id}', [ManufactureController::class, 'delete'])->name('manufacture.delete');

    //Category
    Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('category.show');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    //Product
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('product.show');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/{id}', [ProductController::class, 'delete'])->name('product.delete');

    //Trademark
    Route::get('/trademarks', [TrademarkController::class, 'index'])->name('trademark.index');
    Route::get('/trademarks/create', [TrademarkController::class, 'create'])->name('trademark.create');
    Route::post('/trademarks', [TrademarkController::class, 'store'])->name('trademark.store');
    Route::get('/trademarks/{id}', [TrademarkController::class, 'show'])->name('trademark.show');
    Route::put('/trademarks/{id}', [TrademarkController::class, 'update'])->name('trademark.update');
    Route::delete('/trademarks/{id}', [TrademarkController::class, 'delete'])->name('trademark.delete');

    //Customer
    Route::get('/customers', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customers', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customers/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::put('/customers/{id}', [CustomerController::class, 'update'])->name('customer.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'delete'])->name('customer.delete');

    //user
    Route::get('/users', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/users/{id}', [UserController::class, 'delete'])->name('user.delete');

    //Order
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/create', [OrderController::class, 'create'])->name('order.create');
    Route::post('/orders', [OrderController::class, 'store'])->name('order.store');
    Route::get('/orders/{orderId}', [OrderController::class, 'show'])->name('order.show');
    Route::put('/orders/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/orders/{id}', [OrderController::class, 'delete'])->name('order.delete');
    Route::post('/set-employee-order', [OrderController::class, 'set_employee_order'])->name('order.set-employee-order');
    Route::post('/update-order-status', [OrderController::class, 'update_order_status'])->name('order.update-order-status');

    //COrder
    Route::get('/company_orders', [CompanyOrderController::class, 'index'])->name('company_order.index');
    Route::get('/company_orders/create', [CompanyOrderController::class, 'create'])->name('company_order.create');
    Route::post('/company_orders', [CompanyOrderController::class, 'store'])->name('company_order.store');
    Route::get('/company_orders/{id}', [CompanyOrderController::class, 'show'])->name('company_order.show');
    Route::put('/company_orders/{id}', [CompanyOrderController::class, 'update'])->name('company_order.update');
    Route::delete('/company_orders/{id}', [CompanyOrderController::class, 'delete'])->name('company_order.delete');
    Route::post('/company_orders/add_detail/{id}', [CompanyOrderController::class, 'add_detail'])->name('company_order.add_detail');
    Route::get('/saveSession/company_orders', [CompanyOrderController::class, 'saveSession'])->name('company_order.saveSession');

    //Import
    Route::get('/imports', [ImportController::class, 'index'])->name('import.index');
    Route::get('/imports/create', [ImportController::class, 'create'])->name('import.create');
    Route::post('/imports', [ImportController::class, 'store'])->name('import.store');
    Route::get('/imports/{id}', [ImportController::class, 'show'])->name('import.show');
    Route::put('/imports/{id}', [ImportController::class, 'update'])->name('import.update');
    Route::delete('/imports/{id}', [ImportController::class, 'delete'])->name('import.delete');
    Route::post('/imports/add_detail/{id}', [ImportController::class, 'add_detail'])->name('import.add_detail');
    Route::get('/saveSession/imports', [ImportController::class, 'saveSession'])->name('import.saveSession');

    //Coupon
    Route::get('/coupons', [CouponController::class, 'index'])->name('coupon.index');
    Route::get('/coupons/create', [CouponController::class, 'create'])->name('coupon.create');
    // Route::post('/imports', [ImportController::class, 'store'])->name('import.store');
    Route::get('/coupons/{id}', [CouponController::class, 'show'])->name('coupon.show');
    // Route::put('/imports/{id}', [ImportController::class, 'update'])->coupon('import.update');
    // Route::delete('/imports/{id}', [ImportController::class, 'delete'])->name('import.delete');
    Route::post('/coupons/add_detail/{id}', [CouponController::class, 'add_detail'])->name('coupon.add_detail');
    Route::get('/saveSession/coupons', [CouponController::class, 'saveSession'])->name('coupon.saveSession');
});