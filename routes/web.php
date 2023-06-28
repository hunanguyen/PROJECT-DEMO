
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//----
//admin
//url: /public/backend/login
Route::get('backend/login', function () {
    return view('admin.login.form_login');
});
Route::post('backend/login-post', function () {
   $email = Request::get("email");
   $password = Request::get("password");
 
   //kiểm tra đăng nhập
   if(Auth::attempt(["email"=>$email,"password"=>$password])){
        return redirect(url('backend'));
    }
    else
        return redirect(url('backend/login?notify=invalid'));
});
//url: /public/backend/logout
Route::get('backend/logout', function () {
    Auth::logout();
    return redirect(url('backend/login'));
});
Route::get('backend', function () {
    return view('admin.home.read');
})->middleware("check_login");

//----
//backend
Route::get('/', function () {
    //mã hoá password
    echo Hash::make("123456");
    return view('welcome');
});

use App\Http\Controllers\Admin\UsersController;
//read
Route::get('backend/users',[UsersController::class,'read']);
//creat
Route::get('backend/users/create',[UsersController::class,'create']);
//create post
Route::post('backend/users/create-post',[UsersController::class,'createPost']);
//update
Route::get('backend/users/update/{id}',[UsersController::class,'update']);
//update post
Route::post('backend/users/update-post/{id}',[UsersController::class,'updatePost']);
//delete
Route::get('backend/users/delete/{id}',[UsersController::class,'delete']);

//----------

use App\Http\Controllers\Admin\CategoriesController;
//read
Route::get('backend/categories',[CategoriesController::class,'read']);
//create
Route::get('backend/categories/create',[CategoriesController::class,'create']);
//create post
Route::post('backend/categories/create-post',[CategoriesController::class,'createPost']);
//update
Route::get('backend/categories/update/{id}',[CategoriesController::class,'update']);
//update post
Route::post('backend/categories/update-post/{id}',[CategoriesController::class,'updatePost']);
//delete
Route::get('backend/categories/delete/{id}',[CategoriesController::class,'delete']);

//---

use App\Http\Controllers\Admin\ProductsController;
//read
Route::get('backend/products',[ProductsController::class,'read']);
//create
Route::get('backend/products/create',[ProductsController::class,'create']);
//create post
Route::post('backend/products/create-post',[ProductsController::class,'createPost']);
//update
Route::get('backend/products/update/{id}',[ProductsController::class,'update']);
//update post
Route::post('backend/products/update-post/{id}',[ProductsController::class,'updatePost']);
//delete
Route::get('backend/products/delete/{id}',[ProductsController::class,'delete']);

//---

use App\Http\Controllers\Admin\NewsController;
//read
Route::get('backend/news',[NewsController::class,'read']);
//create
Route::get('backend/news/create',[NewsController::class,'create']);
//create post
Route::post('backend/news/create-post',[NewsController::class,'createPost']);
//update
Route::get('backend/news/update/{id}',[NewsController::class,'update']);
//update post
Route::post('backend/news/update-post/{id}',[NewsController::class,'updatePost']);
//delete
Route::get('backend/news/delete/{id}',[NewsController::class,'delete']);
//---
//frontend
// su dung HomeController
use \App\Http\Controllers\Frontend\HomeController;
Route::get("",[HomeController::class,'index']);
Route::get('/', function () {
    return view('frontend.home');
});



use \App\Http\Controllers\Frontend\ProductsController as ProductsFrontend;
Route::get('products/category/{category_id}',[ProductsFrontend::class,'category']);
Route::get('products/detail/{id}',[ProductsFrontend::class,'detail']);
//tìm kiếm
Route::get('products/search',[ProductsFrontend::class,'search']);
Route::get('products/searchPrice',[ProductsFrontend::class,'searchPrice']);
Route::get('products/ajax-search',[ProductsFrontend::class,'ajax']);
Route::post('products/rating',[ProductsFrontend::class,'rating'])->name('products.rating');


use \App\Http\Controllers\Frontend\CustomersController;
Route::get('customers/login',[CustomersController::class,'login']);
Route::post('customers/login-post',[CustomersController::class,'loginPost']);
Route::get('customers/register',[CustomersController::class,'register']);
Route::post('customers/register-post',[CustomersController::class,'registerPost']);
Route::get('customers/logout',[CustomersController::class,'logout']);


//cart
use \App\Http\Controllers\Frontend\CartController;
//danh sách giỏ hàng
Route::get('cart',[CartController::class,'index']);
//thêm sản phẩm vào giỏ hàng
Route::get('cart/buy/{id}',[CartController::class,'buy']);
// xáo sản phẩm khỏi giỏ hàng
Route::get('cart/remove/{id}',[CartController::class,'remove']);
//xoá toÀn bộ sp khỏi giỏ hàng
Route::get('cart/destroy',[CartController::class,'destroy']);
//cập nhhat số lượng trong giỏ hàng
Route::post('cart/update',[CartController::class,'update']);
//thanh toán đơn hàng
Route::get('cart/order',[CartController::class,'order']);

//--------------

use App\Http\Controllers\Admin\OrdersController;
//read
Route::get('backend/orders',[OrdersController::class,'read']);
//detail
Route::get('backend/orders/detail/{id}',[OrdersController::class,'detail']);
//update trạng thái giao hàng
Route::get('backend/orders/update/{id}',[OrdersController::class,'update']);

//---

//news
use \App\Http\Controllers\Frontend\NewsController as NewsFrontend;
Route::get('/news',[NewsFrontend::class,'getNews']);
Route::get('news/detail/{id}',[NewsFrontend::class,'newsDetail']);
//contact
Route::get('contact',function(){
    return view('frontend.contact');
});