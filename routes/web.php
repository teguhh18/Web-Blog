<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\PasswordResetController;

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
Route::get('/register',[LoginController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register/store',[LoginController::class, 'registerStore'])->name('register.store')->middleware('guest');

Route::get('/login-user',[LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login-user',[LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout',[LoginController::class, 'logout'])->name('logout');

Route::get('/profile/{id}',[AdminController::class, 'adminProfile'])->name('admin.profile')->middleware('auth_admin');

Route::put('/profile/update/{id}',[AdminController::class, 'updateProfile'])->name('admin.profile.update')->middleware('auth_admin');

Route::put('/password/update/{id}',[AdminController::class, 'updatePassword'])->name('admin.password.update')->middleware('auth_admin');


Route::get('/admin/home',[AdminController::class, 'index'])->middleware('auth_admin')->name('admin.home');

Route::resource('/admin/kategori', KategoriController::class)->middleware('auth_admin')->names('admin.kategori');

Route::get('/admin/berita/ai', [BeritaController::class, 'berita_ai'])->middleware('auth_admin')->name('admin.ai');
Route::get('/admin/berita/ai/generate', [BeritaController::class, 'berita_ai_generate'])->middleware('auth_admin')->name('admin.ai.generate');
Route::resource('/admin/berita', BeritaController::class)->middleware('auth_admin')->names('admin.berita');
Route::resource('/admin/user', UserController::class)->middleware('auth_admin')->names('admin.user');




// USER
Route::get('/',[HomeController::class, 'index'])->name('user.home');
Route::get('/about',[HomeController::class, 'about'])->name('user.about');
Route::get('/contact',[HomeController::class, 'contact'])->name('user.contact');

Route::get('/berita',[HomeController::class, 'berita'])->name('user.berita');
Route::get('/bacaBerita/{slug}',[HomeController::class, 'beritaBaca'])->name('user.berita.baca');

Route::get('/kategori',[HomeController::class, 'listKategori'])->name('user.kategori');
Route::get('/berita/kategori/{slug}',[HomeController::class, 'beritaByKategori'])->name('user.berita.kategori');

Route::post('/comment/{slug}', [CommentController::class, 'store'])->name('user.comment.store')->middleware('auth');

Route::get('/userProfile/{id}', [LoginController::class, 'userProfile'])->name('user.profile')->middleware('auth');

Route::put('/userProfile/update/{id}',[LoginController::class, 'updateProfile'])->name('user.profile.update')->middleware('auth');
Route::put('/userPassword/update/{id}',[LoginController::class, 'updatePassword'])->name('user.password.update')->middleware('auth');



// RESET PASSWORD
Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.forgot');
Route::post('/forgot-password', [PasswordResetController::class, 'sendOTP'])->name('password.email');

Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');



