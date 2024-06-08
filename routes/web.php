<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// home Page Load
// Route::get('/', function () {
//     return view('home');
// });

Route::get('/home', [HomeController::class, 'show'])->name("home");



// Post Controller
Route::get('/', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/edit/{id?}', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{post?}', [PostController::class, 'update'])->name('posts.update');
Route::post('/posts/delete', [PostController::class, 'destroy'])->name('posts.destroy');

// Post Load
Route::get("/api/posts", [HomeController::class,'load_data']);

// Category 
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id?}', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/category/{category?}', [CategoryController::class, 'update'])->name('category.update');
Route::post('/category/delete', [CategoryController::class, 'destroy'])->name('category.destroy');

// SubCategory 
Route::get('/subcategory/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
Route::post('/subcategory', [SubCategoryController::class, 'store'])->name('subcategory.store');
Route::get('/subcategory/edit/{id?}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
Route::put('/subcategory/{category?}', [SubCategoryController::class, 'update'])->name('subcategory.update');
Route::post('/subcategory/delete', [SubCategoryController::class, 'destroy'])->name('subcategory.destroy');
