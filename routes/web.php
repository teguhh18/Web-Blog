<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\TemplateImageController;
use App\Http\Controllers\Admin\ToolsController as AdminToolsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\Admin\RoleAIController;
use App\Http\Controllers\Admin\RoleController;

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

// AUTHENTICATION ROUTES
Route::middleware('guest')->group(function () {
    Route::get('/register', [LoginController::class, 'register'])->name('register');
    Route::post('/register/store', [LoginController::class, 'registerStore'])->name('register.store');

    Route::get('/login', [LoginController::class, 'login'])->name('login');

    Route::get('/forgot-password', [PasswordResetController::class, 'showForgotForm'])->name('password.forgot');
    Route::post('/forgot-password', [PasswordResetController::class, 'sendOTP'])->name('password.email');

    Route::get('reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
    Route::post('reset-password', [PasswordResetController::class, 'resetPassword'])->name('password.update');
});
Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');



// PANEL ADMIN
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/home', [AdminController::class, 'index'])->name('admin.home');

    // User Management with Permissions
    Route::resource('/user-management', UserManagementController::class)
        ->parameters(['user-management' => 'user'])
        ->names('admin.users');

    // Role Management
    Route::resource('/roles', RoleController::class)->names('admin.roles');

    // Permission Management
    Route::resource('/permissions', PermissionController::class)->names('admin.permissions');

    Route::get('/profile/picture/', [AdminController::class, 'modalProfilePicture'])->name('admin.profile.image');
    Route::post('/profile/picture/', [AdminController::class, 'ProfilePictureUpload'])->name('admin.profile.image.upload');
    Route::get('/profile/{id}', [AdminController::class, 'adminProfile'])->name('admin.profile');
    Route::put('/profile/update/{id}', [AdminController::class, 'updateProfile'])->name('admin.profile.update');
    Route::put('/password/update/{id}', [AdminController::class, 'updatePassword'])->name('admin.password.update');

    Route::resource('/kategori', KategoriController::class)->names('admin.kategori');
    Route::resource('/role-ai', RoleAIController::class)->names('admin.role-ai');
    Route::resource('/template-image', TemplateImageController::class)->names('admin.template-image');
    Route::resource('/tools', AdminToolsController::class)->names('admin.tools');

    Route::get('/berita/ai', [BeritaController::class, 'berita_ai'])->name('admin.ai');
    Route::get('/berita/ai/generate', [BeritaController::class, 'berita_ai_generate'])->name('admin.ai.generate');
    Route::post('/berita/ai/generate/image', [BeritaController::class, 'generate_image'])->name('admin.ai.generate.image');
    Route::resource('/berita', BeritaController::class)->names('admin.berita');
    Route::resource('/comment', AdminCommentController::class)->names('admin.comment');
});


// USER FRONT (BLOG)
Route::get('/', [HomeController::class, 'index'])->name('user.home');
Route::get('/about', [HomeController::class, 'about'])->name('user.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('user.contact');

Route::get('/berita', [HomeController::class, 'berita'])->name('user.berita');
Route::get('/bacaBerita/{slug}', [HomeController::class, 'beritaBaca'])->name('user.berita.baca');

Route::get('/kategori', [HomeController::class, 'listKategori'])->name('user.kategori');
Route::get('/berita/kategori/{slug}', [HomeController::class, 'beritaByKategori'])->name('user.berita.kategori');

Route::get('/search', [HomeController::class, 'search'])->name('user.berita.search');



Route::middleware('auth')->group(function () {
    // User Kirim Comment
    Route::post('/comment/{slug}', [CommentController::class, 'store'])->name('user.comment.store');

    // User Custom Profile & Password
    Route::get('/userProfile/{id}', [LoginController::class, 'userProfile'])->name('user.profile');
    Route::put('/user/profile/update/{id}', [LoginController::class, 'updateProfile'])->name('user.profile.update');
    Route::put('/user/profile/password/{id}', [LoginController::class, 'updatePassword'])->name('user.password.update');

    // User Tools Resource
    Route::resource('/user/tools', ToolsController::class)->names('user.tools');
    // TOOLS
    Route::post('user/image-to-pdf', [ToolsController::class, 'imageToPdf'])->name('user.tools.imageToPdf');
    Route::get('user/qrcode-generator', [ToolsController::class, 'qrcodeGenerator'])->name('user.tools.qrcode');
});


// AKSES FILE DI STORAGE TANPA STORAGE LINK
Route::get('/storage-file/{path}', [FileController::class, 'show'])->where('path', '.*')->name('storage.show');
