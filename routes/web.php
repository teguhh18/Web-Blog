<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

// ADMIN
Route::get('/login',[LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login',[LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout',[LoginController::class, 'logout'])->name('logout');

Route::get('/profile/{id}',[AdminController::class, 'adminProfile'])->name('admin.profile')->middleware('auth');

Route::put('/profile/update/{id}',[AdminController::class, 'updateProfile'])->name('admin.profile.update')->middleware('auth');
Route::put('/password/update/{id}',[AdminController::class, 'updatePassword'])->name('admin.password.update')->middleware('auth');


Route::get('/admin/home',[AdminController::class, 'index'])->name('admin.home');

Route::resource('/admin/kategori', KategoriController::class)->middleware('auth')->names('admin.kategori');

Route::resource('/admin/berita', BeritaController::class)->middleware('auth')->names('admin.berita');




// USER
Route::get('/home',[HomeController::class, 'index'])->name('user.home');
Route::get('/about',[HomeController::class, 'about'])->name('user.about');
Route::get('/contact',[HomeController::class, 'contact'])->name('user.contact');

Route::get('/berita',[HomeController::class, 'berita'])->name('user.berita');
Route::get('/bacaBerita/{slug}',[HomeController::class, 'beritaBaca'])->name('user.berita.baca');

Route::get('/kategori',[HomeController::class, 'listKategori'])->name('user.kategori');
Route::get('/berita/kategori/{slug}',[HomeController::class, 'beritaByKategori'])->name('user.berita.kategori');