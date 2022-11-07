<?php

use App\Http\Controllers\API\RouteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//GET
// Route::get('product/list',[RouteController::class,'productList']);

Route::get('category/list',[RouteController::class,'categoryList']);

Route::get('data/list',[RouteController::class,'dataList']);


//POST METHOD
Route::post('create/category',[RouteController::class,'categoryCreate']);
Route::post('create/contact',[RouteController::class,'createContact']);

//DELETE
//with post method
Route::post('category/delete',[RouteController::class,'categoryDelete']);
Route::get('category/delete/{id}',
//with get method
[RouteController::class,'deleteCategory']);


// with post mehtod
Route::post('category/details',[RouteController::class,'categoryDetail']);
// with post mehtod
Route::get('category/list/{id}',[RouteController::class,'detailCategory']);


//Update can only use post method

Route::post('category/update',[RouteController::class,'categoryUpdate']);







/**
 *
 *prduct list
 *localhost:8000/api/product/list  (GET)
 *
 *category list
 *localhost:8000/api/category/list (GET)
 *
 * create category
 * localhost:8000/api/create/category (POST)
 *key=> name

 * delete category
 *
 *localhost:8000/api/category/delete (POST)
 *key=>category_id
 *
 *localhost:8000/api/category/delete/{id} (GET)
 *
 *
 * category list with one detail
 *localhost:8000/api/product/list/{id}  (GET)
 *
 * category update
 *localhost:8000/api/category/update  (POST)
 *key=> category_id, category_name
 *
 */



