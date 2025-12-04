<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//use JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;


class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */


    public function handle(Request $request, Closure $next)
    {
        $message = '';

        try {
            //check token validations
            JWTAuth::parseToken()->authenticate();
            return $next($request);
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            //do whatever you want to do if the token is expired
            $message = 'token expired';
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            //do whatever you wanty to do if the token is invalid
            $message = 'invalid token';
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            //do whatever you wanty to do if the token is invalid
            $message = 'provide token';
        }
        return response()->json([
            'success' => false,
            'message' => $message
        ]);
    }
}
