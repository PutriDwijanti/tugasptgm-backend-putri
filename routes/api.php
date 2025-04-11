<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BukuController;
use App\Http\Middleware\JwtMiddleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');*/

//Grup rute buku dengan prefix '/buku' dan middleware JWT
Route::prefix('/buku')
->middleware([JwtMiddleware::class]) //Semua rute di bawah ini harus pakai token JWT
->group(function(){
    Route::get('/',[BukuController::class,'index'])->name('buku.index');
    Route::get('/detil/{id}',[BukuController::class,'show']);
    Route::post('/simpan',[BukuController::class,'store'])->name('buku.simpan');
    Route::put('/simpan/{id}',[BukuController::class,'update'])->name('buku.Rest.update');
    Route::delete('/hapus/{id}',[BukuController::class,'destroy']);
});

//// Grup rute autentikasi dengan prefix '/auth'
Route::prefix('/auth')->group(function(){
    //http://localhost:8000/api/auth/login method post
    //Endpoint login: http://localhost:8000/api/auth/login (method POST)
    Route::post('/login',[AuthController::class,'login'])->name('api.auth.login');
});

/**
 * note
 * Grup /buku dilindungi oleh JWT Middleware (hanya bisa diakses jika user login).
 * Grup /auth berfungsi untuk proses login dan generate JWT token.
 */