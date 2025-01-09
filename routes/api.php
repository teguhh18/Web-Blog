<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BeritaApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('/', function() {
//     return response()->json([
//         'status' => false,
//         'message' => 'Akses Tidak Diperbolehkan',
//     ], 401);
// })->name('login');

Route::post('/register', [AuthController::class, 'registerUser']);
Route::post('/login', [AuthController::class, 'loginUser']);
Route::get('/profile/{id}',[AuthController::class, 'userProfile'])->middleware('auth:sanctum');
Route::put('/userProfile/update/{id}',[AuthController::class, 'updateProfile'])->middleware('auth:sanctum');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/check-token', [AuthController::class, 'checkToken']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);


Route::get('/berita', [BeritaApiController::class, 'index']);
Route::get('/berita/{slug}', [BeritaApiController::class, 'show']);
Route::post('/berita/{slug}/comment', [BeritaApiController::class, 'comment'])->middleware('auth:sanctum');

Route::get('/kategori',[BeritaApiController::class, 'listKategori']);
Route::get('/berita/kategori/{slug}',[BeritaApiController::class, 'beritaByKategori']);