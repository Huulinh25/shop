<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UploadProfileController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BrandController;


use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\BlogMemberController;
use App\Http\Controllers\Frontend\LoginController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Frontend\LogoutController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\MyProductController;
use App\Http\Controllers\Frontend\DetailProductController;
use App\Http\Controllers\Frontend\CartController;
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
// MEMBER
Route::prefix('member')->name('member.')->group(function () {

    Route::get('/login', [LoginController::class, 'getLogin'])->name('getLogin'); // lấy form login
    Route::post('/login', [LoginController::class, 'postLogin'])->name('postLogin'); // post login

    Route::get('/register', [RegisterController::class, 'getRegister'])->name('getRegister'); //lấy form đ ký
    Route::post('/register', [RegisterController::class, 'postRegister'])->name('postRegister'); // post register

    Route::get('/logout', [LogoutController::class, 'index'])->name('logout');

    Route::get('/account/update',[ProfileController::class,'index'])->name('update'); //view form update profile
    Route::post('/account/update',[ProfileController::class,'updateProfile'])->name('update'); //post form update profile

    Route::get('/account/my-product',[MyProductController::class,'index'])->name('my-product'); //view form my product

    Route::get('/account/add-product',[MyProductController::class,'formProduct'])->name('getProduct'); //view form my product
    Route::post('/account/add-product',[MyProductController::class,'postProduct'])->name('postProduct'); //post form my product
    
    Route::get('/account/edit-product/{id}',[MyProductController::class,'getEditProduct'])->name('getEditProduct'); //view form my product
    Route::post('/account/edit-product/{id}',[MyProductController::class,'postEditProduct'])->name('postEditProduct'); //view form my product


    Route::get('/account/delete-product/{id}',[MyProductController::class,'deleteProduct'])->name('deleteProduct'); //view form my product

    Route::get('/account/detail-product/{id}', [DetailProductController::class, 'index'])->name('detailProduct'); // get page detail product
    
    Route::get('/account/cart', [CartController::class, 'index'])->name('cart'); // get page cart
    // Route::post('/account/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart'); 
});

Route::get('/home', [HomeController::class,'index'])->name('home'); //view index page

//Lấy blog đầu tiên khi user nhấn vào navbar
Route::get('blog/first', [BlogMemberController::class, 'showFirstBlog'])->name('firstBlog');

Route::get('/blog/list', [BlogMemberController::class, 'index'])->name('blog');   
Route::get('/blog/detail/{id}', [BlogMemberController::class, 'detailBlog'])->name('detailBlog');

//Rate Blog
Route::get('/blog/getRate/{idBlog}', [BlogMemberController::class, 'getRateBlog'])->name('getRateBlog');
Route::post('/blog/rate', [BlogMemberController::class, 'postRateBlog'])->name('postRateBlog');

Route::post('/blog/cmt', [BlogMemberController::class, 'postCmt'])->name('postCmt'); //Bình luận mới
// Route::get('/blog/cmt', [BlogMemberController::class,'postCmt'])->name('replyCmt'); //Trả lời bình luận



Auth::routes();


Route::get('/', function () {
    return view('home');
});

// ADMIN
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // PROFILE
    Route::get('/profile', [UploadProfileController::class, 'edit'])->name('profile');
    Route::post('/profile', [UploadProfileController::class, 'update'])->name('profile');

    //COUNTRY
    Route::prefix('country')->name('country.')->group(function () {
        Route::get('/', [CountryController::class, 'index'])->name('country');

        //test DATA
        Route::get('/getCountry', [CountryController::class, 'getCountry'])->name('getCountry');
        Route::get('/addCountry', [CountryController::class, 'addCountry'])->name('addCountry'); // form thêm
        Route::post('/addCountry', [CountryController::class, 'postCountry'])->name('postCountry'); // form thêm


        Route::get('/edit/{id}', [CountryController::class, 'getEditCountry'])->name('getEditCountry');
        Route::post('/edit/{id}', [CountryController::class, 'postEditCountry'])->name('postEditCountry');

        Route::get('/delete/{id}', [CountryController::class, 'deleteCountry'])->name('deleteCountry');
    });

    // //BLOG
    Route::prefix('blog')->name('blog.')->group(function () {
        Route::get('/', [BlogController::class, 'index'])->name('blog');
        // Route::get('/getBlog', [BlogController::class, 'getBlog'])->name('getBlog'); // test data Blog

        Route::get('/addBlog', [BlogController::class, 'addBlog'])->name('addBlog'); // form thêm Blog
        Route::post('/addBlog', [BlogController::class, 'postBlog'])->name('postBlog'); // form thêm Blog

        Route::get('/editBlog/{id}', [BlogController::class, 'getEditBlog'])->name('getEditBlog'); // form edit Blog
        Route::post('/editBlog/{id}', [BlogController::class, 'postEditBlog'])->name('postEditBlog');


        Route::get('/delete/{id}', [BlogController::class, 'deleteBlog'])->name('deleteBlog');
    });

    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/',[CategoryController::class,'index'])->name('category'); //get form Category

        Route::get('/addCategory',[CategoryController::class,'addCategory'])->name('addCategory'); //get form add Category
        Route::post('/postCategory',[CategoryController::class,'postCategory'])->name('postCategory'); //get form add Category

        Route::get('/editBlog/{id}', [CategoryController::class, 'getEditCategory'])->name('getEditCategory'); // form edit Blog
        Route::post('/editCategory/{id}', [CategoryController::class, 'postEditCategory'])->name('postEditCategory');
        
        Route::get('/delete/{id}', [CategoryController::class, 'deleteCategory'])->name('deleteCategory');
    });

    Route::prefix('brand')->name('brand.')->group(function () {
        Route::get('/',[BrandController::class,'index'])->name('brand'); //get form brand

        Route::get('/addBrand',[BrandController::class,'addBrand'])->name('addBrand'); //get form add Brand
        Route::post('/postBrand',[BrandController::class,'postBrand'])->name('postBrand'); //post Brand

        Route::get('/editBrand/{id}', [BrandController::class, 'getEditBrand'])->name('getEditBrand'); // form edit Brand

        Route::post('/editBrand/{id}', [BrandController::class, 'postEditBrand'])->name('postEditBrand');

        Route::get('/delete/{id}', [BrandController::class, 'deleteBrand'])->name('deleteBrand');

    });
});


