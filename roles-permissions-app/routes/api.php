<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserApiController;
use App\Http\Controllers\Api\ProductApiController;


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
Route::group([ 'middleware' => ['auth']], function () {

  
});
// Route::group('namespace'=>"App\Http\Controllers\Api\AuthController",function(){

// })
Route::post('login',[AuthController::class,'login'] );
Route::post('register', [AuthController::class,'register']);
//For Users
Route::get('users', [UserApiController::class,'getUsers']);
Route::delete('usersdelete/{id}', [UserApiController::class,'deleteUser']);
Route::post('/users', [UserApiController::class, 'createUser']); //Create
Route::put('useredit/{id}', [UserApiController::class,'editUser']); //Edit

//For Products
Route::get('products', [ProductApiController::class,'getProducts']); //Get
Route::delete('productdelete/{id}', [ProductApiController::class,'deleteProduct']); //Edit
Route::post('/products', [ProductApiController::class, 'createProduct']); //Create
Route::put('productedit/{id}', [ProductApiController::class,'editProduct']); //Edit


// Route::post('home', HomeController::class,'index');
// Route::post('login', 'Api\AuthController@login');
// Route::post('register', 'Api\AuthController@register');

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
