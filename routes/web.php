<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\StatisticController;
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
//frontend
Route::get('/',[\App\Http\Controllers\HomeController::class,'index']);
Route::post('/load-menu',[\App\Http\Controllers\HomeController::class,'load_menu']);
Route::get('home',[\App\Http\Controllers\HomeController::class,'index']);
Route::post('/Search',[\App\Http\Controllers\HomeController::class,'search']);

//product on category
Route::get('/category-product/{cate_id}',[\App\Http\Controllers\CategoryProductController::class,'show_cate_home']);
Route::get('/product-detail/{prod_id}',[\App\Http\Controllers\HomeController::class,'detail_product']);


//product on brand
Route::get('/BrandProduct/{brand_id}',[\App\Http\Controllers\BrandProduct::class,'show_brand_home']);

//backend
Route::get('/admin',[\App\Http\Controllers\AdminController::class,'index']);
Route::get('/admin/admin-dashboard',[\App\Http\Controllers\AdminController::class,'show_dashboard']);
Route::post('/admin/dashboard',[\App\Http\Controllers\AdminController::class,'dashboard']);
Route::get('/admin/logout',[\App\Http\Controllers\AdminController::class,'logout']);

//categogy product
Route::get('/admin/add-category',[\App\Http\Controllers\CategoryProductController::class,'Add_Category']);
Route::get('/admin/list-category',[\App\Http\Controllers\CategoryProductController::class,'List_Category']);
Route::get('/admin/edit-category/{category_id}',[\App\Http\Controllers\CategoryProductController::class,'Edit_Category']);
Route::get('/admin/delete-category/{category_id}',[\App\Http\Controllers\CategoryProductController::class,'Delete_Category']);

Route::get('/admin/list-category/active/{category_id}',[\App\Http\Controllers\CategoryProductController::class,'Active_Category']);
Route::get('/admin/list-category/unactive/{category_id}',[\App\Http\Controllers\CategoryProductController::class,'Unactive_Category']);

Route::post('/admin/add-category/Save',[\App\Http\Controllers\CategoryProductController::class,'Save_Category']);
Route::post('/admin/update-category/{category_id}',[\App\Http\Controllers\CategoryProductController::class,'Update_Category']);

//product
Route::get('/admin/add-product',[\App\Http\Controllers\ProductController::class,'Add_Product']);
Route::get('/admin/manage-product',[\App\Http\Controllers\ProductController::class,'List_Product']);
Route::get('/admin/edit-product/{product_id}',[\App\Http\Controllers\ProductController::class,'Edit_Product']);
Route::get('/admin/delete-product/{product_id}',[\App\Http\Controllers\ProductController::class,'Delete_Product']);

Route::get('/admin/manage-product/active/{product_id}',[\App\Http\Controllers\ProductController::class,'Active_Product']);
Route::get('/admin/manage-product/unactive/{product_id}',[\App\Http\Controllers\ProductController::class,'Unactive_Product']);

Route::post('/admin/add-product/Save',[\App\Http\Controllers\ProductController::class,'Save_Product']);
Route::post('/admin/update-product/{product_id}',[\App\Http\Controllers\ProductController::class,'Update_Product']);

Route::post('/admin/search-product',[\App\Http\Controllers\ProductController::class,'Search_Product']);

//brand
Route::get('/admin/add-brand',[\App\Http\Controllers\BrandProduct::class,'Add_Brand']);
Route::get('/admin/manage-brand',[\App\Http\Controllers\BrandProduct::class,'List_Brand']);
Route::get('/admin/edit-brand/{category_id}',[\App\Http\Controllers\BrandProduct::class,'Edit_Brand']);
Route::get('/admin/delete-brand/{brand_id}',[\App\Http\Controllers\BrandProduct::class,'Delete_Brand']);

Route::get('/admin/manage-brand/active/{brand_id}',[\App\Http\Controllers\BrandProduct::class,'Active_Brand']);
Route::get('/admin/manage-brand/unactive/{brand_id}',[\App\Http\Controllers\BrandProduct::class,'Unactive_Brand']);

Route::post('/admin/add-brand/Save',[\App\Http\Controllers\BrandProduct::class,'Save_Brand']);
Route::post('/admin/update-brand/{brand_id}',[\App\Http\Controllers\BrandProduct::class,'Update_Brand']);

//cart
Route::post('/save-cart',[\App\Http\Controllers\CartController::class,'save_cart']);
Route::get('/DeleteCart/{row_id}',[\App\Http\Controllers\CartController::class,'delete_cart']);
Route::post('/UpdateQuantity',[\App\Http\Controllers\CartController::class,'update_quantity']);
Route::get('/delete-item/{session_id}',[\App\Http\Controllers\CartController::class,'delete_item']);


Route::post('add-cart',[\App\Http\Controllers\CartController::class,'add_cart']);
Route::get('show-cart',[\App\Http\Controllers\CartController::class,'cart']);

//checkout
Route::post('user-login',[\App\Http\Controllers\CheckoutController::class,'user_login']);
Route::get('/login-checkout',[\App\Http\Controllers\CheckoutController::class,'login_checkout']);
Route::get('/LogoutCheckout',[\App\Http\Controllers\CheckoutController::class,'logout_checkout']);
Route::post('/AddCustomer',[\App\Http\Controllers\CheckoutController::class,'add_customer']);
Route::get('/Checkout',[\App\Http\Controllers\CheckoutController::class,'checkout']);
Route::post('/SaveCheckOutCustomer',[\App\Http\Controllers\CheckoutController::class,'save_checkout_customer']);
Route::get('/Payment',[\App\Http\Controllers\CheckoutController::class,'payment']);
Route::post('/OrderPlace',[\App\Http\Controllers\CheckoutController::class,'order_place']);
Route::post('/SelectDelivery',[\App\Http\Controllers\CheckoutController::class,'select_delivery']);
Route::post('/charge-fee',[\App\Http\Controllers\CheckoutController::class,'charge_fee']);
Route::post('/Confirm',[\App\Http\Controllers\CheckoutController::class,'confirm']);
Route::get('/sign-up',[\App\Http\Controllers\CheckoutController::class,'sign_up']);

//coupon
Route::post('/CheckCoupon',[\App\Http\Controllers\CartController::class,'check_coupon']);
Route::get('/DeleteCoupon',[\App\Http\Controllers\CartController::class,'delete_couponn']);

//coupon admin
Route::get('/admin/AddCoupon',[\App\Http\Controllers\CartController::class,'add_coupon']);
Route::post('/admin/AddCoupon/Save',[\App\Http\Controllers\CartController::class,'save_coupon']);
Route::get('/admin/ListCoupon',[\App\Http\Controllers\CartController::class,'list_coupon']);
Route::get('/admin/DeleteCoupon/{coupon_id}',[\App\Http\Controllers\CartController::class,'delete_coupon']);


//orders
Route::get('/admin/Orders',[\App\Http\Controllers\OrderController::class,'manage_order']);
Route::get('/admin/ViewOrders/{order_code}',[\App\Http\Controllers\OrderController::class,'view_order']);
Route::get('/admin/delete-order/{order_id}',[\App\Http\Controllers\OrderController::class,'delete_order']);

Route::get('/admin/PrintOrders/{checkout_code}',[\App\Http\Controllers\OrderController::class,'print_order']);


Route::get('/admin/Orders/unconfirmed/{order_code}',[\App\Http\Controllers\OrderController::class,'unconfirmed']);
Route::get('/admin/Orders/confirm/{order_code}',[\App\Http\Controllers\OrderController::class,'confirm']);


//send mail
Route::get('/SendMail',[\App\Http\Controllers\HomeController::class,'send_mail']);

Route::post('/admin/SearchOrder',[\App\Http\Controllers\OrderController::class,'Search_Order']);

//delivery
Route::get('/admin/Delivery',[\App\Http\Controllers\DeliveryController::class,'delivery']);

Route::post('/admin/SelectDelivery',[\App\Http\Controllers\DeliveryController::class,'select_delivery']);
Route::post('/admin/AddDelivery',[\App\Http\Controllers\DeliveryController::class,'add_delivery']);
Route::post('/admin/SelectFee',[\App\Http\Controllers\DeliveryController::class,'select_fee']);
Route::post('/admin/UpdateDelivery',[\App\Http\Controllers\DeliveryController::class,'update_delivery']);

//comment

Route::post('/LoadComment',[\App\Http\Controllers\CommentController::class,'load_comment']);
Route::post('/SendComment',[\App\Http\Controllers\CommentController::class,'send_comment']);

Route::get('/admin/Comment',[\App\Http\Controllers\CommentController::class,'comment']);
Route::post('/admin/allow',[\App\Http\Controllers\CommentController::class,'allow']);
Route::post('/admin/reply',[\App\Http\Controllers\CommentController::class,'reply']);

//send mail
Route::get('/SendMail',[\App\Http\Controllers\HomeController::class,'send_mail']);

//login facebook
Route::get('/login-facebook',[\App\Http\Controllers\AdminController::class,'login_facebook']);
//Route::get('/admin/callback',[\App\Http\Controllers\AdminController::class,'callback_facebook']);

//login google
Route::get('/login-google',[\App\Http\Controllers\AdminController::class,'login_google']);
Route::get('/admin/callback',[\App\Http\Controllers\AdminController::class,'callback_google']);

//statistic

Route::get('/admin/Statistic',[\App\Http\Controllers\StatisticController::class,'statistic']);
Route::post('/admin/filter-by-date',[\App\Http\Controllers\StatisticController::class,'filter_day']);
Route::post('/admin/statistic-filter',[\App\Http\Controllers\StatisticController::class,'filter_statistic']);
Route::post('/admin/chart-30-day',[\App\Http\Controllers\StatisticController::class,'days_order']);
Route::post('/admin/export-excel',[\App\Http\Controllers\StatisticController::class,'export_excel']);

//user
Route::get('/admin/manage-user',[\App\Http\Controllers\UserController::class,'show_user']);
Route::get('/admin/delete-user/{user_id}',[\App\Http\Controllers\UserController::class,'delete_user']);

