<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BlogsController;
use App\Http\Controllers\CarsController;
use App\Http\Controllers\GoogleController;





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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/login', function () {
    return view('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// });

//SignupController.
Route::post('/signup-user',[SignupController::class,'signup']);

//LoginController.
Route::post('/login-user',[LoginController::class,'login_user']);
//dashboard
Route::get('/dashboard', [DashboardController::class,'Dashboard']);
Route::get('delete_user/{id}', [DashboardController::class,'DeleteUser']);
Route::get('edit_user/{id}',[DashboardController::class,'EditUser']);
Route::post('update_user',[DashboardController::class,'Update']);
Route::get('logout',[DashboardController::class,'Logout_user']);



//blogs

Route::get('blogs',[BlogsController::class,'Index']);
Route::post('create-blogs',[BlogsController::class,'CreateBlog']);
Route::get('edit_blogs/{id}',[BlogsController::class,'EditBlog']);
Route::post('update_blogs',[BlogsController::class,'UpdateBlog']);
Route::get('delete_blog/{id}',[BlogsController::class,'DeleteBlog']);

//
Route::get('cars',[CarsController::class,'Cars']);
Route::post('cars_1',[CarsController::class,'ListCars']);
Route::get('edit_cars/{id}',[CarsController::class,'EditCars']);
Route::post('update_cars',[CarsController::class,'UpdateCars']);
Route::get('delete_cars/{id}',[CarsController::class,'DeleteCars']);


// google controller
Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/call-back', 'handleGoogleCallback');
});