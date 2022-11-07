<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;
use App\Models\Product;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use PharIo\Manifest\AuthorCollectionIterator;
use SebastianBergmann\CodeUnit\FunctionUnit;

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

///login , register
Route::middleware(['admin_auth','user_auth'])->group(function(){
    Route::redirect('/','loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');
});

Route::middleware([
    'auth'])->group(function () {
    //Dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');

    ///Admin
    Route::middleware('admin_auth')->group(function(){
        //category
        Route::prefix('category')->group(function(){
            //R
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            //C
            Route::get('create',[CategoryController::class,'createPage'])->name('category#createPage');
            Route::post('create',[CategoryController::class,'create'])->name('category#create');
            //D
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');
            //U
            Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category#editPage');
            Route::post('update/{id}',[CategoryController::class,'update'])->name('category#update');
        });

        //admin account
        Route::prefix('admin')->group(function(){
            //Password change
            Route::get('passwordChangePage',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('passwordChangePage',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //account profile detail
            Route::get('details',[AdminController::class,'details'])->name('admin#details');
            //edit
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            //update
            Route::post('update/{id}',[AdminController::class,'update'])->name('admin#update');

            //admin list
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
            Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete');

            //admin change role
            Route::get('changeRole/{id}',[AdminController::class,'changeRole'])->name('admin#changeRole');
            Route::get('change/role',[AdminController::class,'adminChangeRole'])->name('admin#adminChangeRole');

        });

        //products
        Route::prefix('products')->group(function(){
            Route::get('list',[ProductController::class,'list'])->name('product#list');
            //C
            Route::get('create',[ProductController::class,'createPage'])->name('product#createPage');
            Route::post('create',[ProductController::class,'create'])->name('product#create');
            //D
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('product#delete');
            //U
            Route::get('edit/{id}',[ProductController::class,'edit'])->name('product#edit');
            Route::get('update/{id}',[ProductController::class,'updatePage'])->name('product#updatePage');
            Route::post('update/{id}',[ProductController::class,'update'])->name('product#update');
        });

        //orders
        Route::prefix('order')->group(function(){
            Route::get('list',[OrderController::class,'orderList'])->name('admin#orderList');
            Route::get('change/status',[OrderController::class,'changeStatus'])->name('admin#changeStatus');
            Route::get('ajax/change/status',[OrderController::class,'ajaxChangeStatus'])->name('admin#ajaxChangeStatus');
            Route::get('listInfo/{orderCode}',[OrderController::class,'listInfo'])->name('admin#listInfo');
        });

        //userList
        Route::prefix('user')->group(function(){
            Route::get('list',[AdminController::class,'userList'])->name('admin#userList');
            Route::get('change/role',[AdminController::class,'userChangeRole'])->name('admin#userChangeRole');
            Route::get('delete/{id}',[AdminController::class,'deleteUser'])->name('admin#deleteUser');
        });

        //user response
        Route::prefix('response')->group(function(){
            Route::get('message',[ContactController::class,'message'])->name('response#message');
            Route::get('delete/{id}',[ContactController::class,'deleteMessage'])->name('response#deleteMessage');
            Route::get('messageDetail/{id}',[ContactController::class,'messageDetail'])->name('response#messageDetail');
        });
   });


    //User
    //home page
    Route::group(['prefix'=>'user','middleware'=>'user_auth'],function(){
        Route::get('home',[UserController::class,'home'])->name('user#home');
        Route::get('filter/{id}',[UserController::class,'filter'])->name('user#filter');
        Route::get('history',[UserController::class,'history'])->name('user#history');

        //Pizza Info
        Route::prefix('pizza')->group(function(){
            Route::get('details/{id}',[UserController::class,'pizzaDetails'])->name('user#pizzaDetails');
        });

        //User password
        Route::prefix('password')->group(function(){
            Route::get('change',[UserController::class,'changePasswordPage'])->name('user#changePasswordPage');
            Route::post('change',[UserController::class,'changePassword'])->name('user#changePassword');
        });

        //User Account info
        Route::prefix('account')->group(function(){
            Route::get('change',[UserController::class,'accountChangePage'])->name('user#accountChangePage');
            Route::post('change/{id}',[UserController::class,'accountChange'])->name('user#accountChange');
        });

        //Cart Info
        Route::prefix('cart')->group(function(){
            Route::get('list',[UserController::class,'cartList'])->name('user#cartList');
            Route::get('clear/item/{id}',[UserController::class,'clearItem'])->name('user#clearItem');
        });

        //User Contact
        Route::prefix('contact')->group(function(){
            Route::get('form',[ContactController::class,'contactPage'])->name('user#contactPage');
            Route::post('create',[ContactController::class,'createContact'])->name('user#createContact');
        });

        //ajax
        Route::prefix('ajax')->group(function(){
            Route::get('pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#pizzaList');
            Route::get('addToCart',[AjaxController::class,'addToCart'])->name('ajax#addToCart');
            Route::get('order',[AjaxController::class,'order'])->name('ajax#order');
            Route::get('clear/cart',[AjaxController::class,'clearCart'])->name('ajax#clearCart');
            Route::get('increase/viewCount',[AjaxController::class,'increaseViewCount'])->name('ajax#increaseViewCount');

        });
    });
});






///User
