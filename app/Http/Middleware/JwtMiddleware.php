<?php

namespace App\Http\Middleware;

use Closure; //digunakan untuk meneruskan request ke proses selanjutnya.
use Illuminate\Http\Request; //mewakili request HTTP yang masuk.
use Symfony\Component\HttpFoundation\Response; //untuk membentuk response HTTP
use Tymon\JWTAuth\Exceptions\JWTException; //untuk menangani kesalahan saat parsing atau autentikasi token.
use Tymon\JWTAuth\Facades\JWTAuth; //package JWT untuk autentikasi berbasis token.

class JwtMiddleware
{

    /**
     * Fungsi untuk menangani request yang masuk dan memeriksa token JWT.
     * Hanya akan melanjutkan ke proses berikutnya jika token valid.
     */

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try{ //Coba parsing token dari request (biasanya di header Authorization) dan autentikasi token tersebut.
            $user = JWTAuth::parseToken()->authenticate();
        }catch(JWTException $e){ //Tangkap error jika token tidak valid atau tidak bisa diparsing.
            return response()->json(
            [
                'status'    => false,
                'message'   => 'Token tidak valid'
            ],401);
        }
        return $next($request);
    }
}
