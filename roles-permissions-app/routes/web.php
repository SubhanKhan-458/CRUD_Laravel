<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
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
Route::get('/', function () {
    return view('welcome');
});
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
  
Route::group(['middleware' => ['auth']], function() {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);
    Route::resource('products', ProductController::class);
    Route::resource('page', ProductController::class);
});

// Route::get('page/create', [App\Http\Controllers\PageController::class, 'create']);
// Route::post('page', [App\Http\Controllers\PageController::class, 'store']);
// Route::get('page/{page}/edit', [App\Http\Controllers\PageController::class, 'edit']);
// Route::get('page/{page}', [App\Http\Controllers\PageController::class, 'show']);
// Route::put('page/{page}', [App\Http\Controllers\PageController::class, 'update']);
// Route::delete('page/{page}', [App\Http\Controllers\PageController::class, 'destroy']);