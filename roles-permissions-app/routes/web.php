<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PageController;

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
    Route::resource('pages', PageController::class);
});

// Route::get('/home', [App\Http\Controllers\PostController::class, 'index'])->name('home');
// Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
// Route::get('pages/create', [App\Http\Controllers\PageController::class, 'create']);
// Route::post('pages', [App\Http\Controllers\PageController::class, 'store']);
// Route::get('pages/{age}/edit', [App\Http\Controllers\PageController::class, 'edit']);
// Route::get('pages/{page}', [App\Http\Controllers\PageController::class, 'show']);
// Route::put('pages/{page}', [App\Http\Controllers\PageController::class, 'update']);
// Route::delete('pages/{page}', [App\Http\Controllers\PageController::class, 'destroy']);
// Route::get('pages/create', [App\Http\Controllers\PageController::class, 'index']);
// Route::get('pages/create', [App\Http\Controllers\PageController::class, 'create']);
// Route::post('pages', [App\Http\Controllers\PageController::class, 'store']);
// Route::get('pages/{page}/edit', [App\Http\Controllers\PageController::class, 'edit']);
// Route::get('pages/{page}', [App\Http\Controllers\PageController::class, 'show']);
// Route::put('pages/{page}', [App\Http\Controllers\PageController::class, 'update']);
// Route::delete('pages/{page}', [App\Http\Controllers\PageController::class, 'destroy']);