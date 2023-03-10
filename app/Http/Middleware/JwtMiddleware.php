<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class JwtMiddleware extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (Exception $e) {
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json([
                    'status' => 'failure',
                    'message' => 'JWT Token is Invalid!',
                    'data' => null
                ], Response::HTTP_FORBIDDEN);
            } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json([
                    'status' => 'failure',
                    'message' => 'JWT Token is Expired!',
                    'data' => null
                ], Response::HTTP_FORBIDDEN);
            } else {
                return response()->json([
                    'status' => 'failure',
                    'message' => 'JWT Token is not found!',
                    'data' => null
                ], Response::HTTP_FORBIDDEN);
            }
        }
 
        return $next($request);
    }
}
