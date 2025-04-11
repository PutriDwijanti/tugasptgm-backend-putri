<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException; //JWTException untuk menangkap error saat proses autentikasi JWT.
use Tymon\JWTAuth\Facades\JWTAuth; //JWTAuth untuk proses autentikasi menggunakan JWT (login, verifikasi token, dll).

class AuthController extends Controller
{
    // Method login() ini menangani proses login dengan email dan password yang dikirim lewat request.
    public function login(Request $request){
        $userPassword = $request->only('email','password'); //Mengambil hanya data email dan password dari input yang dikirim.
        try{ // Mencoba untuk melakukan login menggunakan metode JWTAuth::attempt(). 
            if(! $token = JWTAuth::attempt($userPassword)):
                return response()->json(
                    [
                        'status'    => false,
                        'message'   => "Login gagal, user atau password salah!"
                    ],401
                );
            endif;

            $user = auth()->user();// Jika login berhasil, ambil data user yang sedang login (auth()->user()), dan lanjutkan dengan mengembalikan response sukses.

            /*
            Mengembalikan response JSON yang berisi:
            > status login,
            > pesan sukses,
            > data user,
            > dan token JWT untuk digunakan di request berikutnya (sebagai otorisasi).
            */
            
            return response()->json(
                [
                    'status'    => true,
                    'message'   => 'Login Berhasil',
                    'user'      => $user,
                    'token'     => $token
                ]);
        }catch(JWTException $e){ //Menangkap exception jika ada error saat membuat token JWT

        }
    }
}
