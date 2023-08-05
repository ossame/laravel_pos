<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BillController;
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

//user relasted routes
Route::get('/', [UserController::class, 'ShowCorrectHomepage'])->name('login');
Route::get('/home' ,[ExampleController::class, 'homepage']);
Route::post('/register', [UserController::class,'register']);
Route::post('/login', [UserController::class,'login']);
Route::post('/logout', [UserController::class,'logout']);


//bil routes
Route::get('/invoice', [BillController::class,'invoice' ])->middleware('auth') ;
Route::post('/saveInvoice', [BillController::class,'saveInvoice' ])->middleware('auth');
Route::post('/saveProduct', [ProductController::class,'saveProduct' ])->middleware('auth');

Route::get('/viewInvoice/{invoice}', [ProductController::class, 'viewinvoice'])->name('invoice.view')->middleware('auth');

//delete
Route::get('/delete/{invoice}', [ProductController::class, 'delete'])->middleware('auth');

//search
Route::get('/search', [BillController::class, 'search']);

