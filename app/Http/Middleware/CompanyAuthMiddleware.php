<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Exception;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class CompanyAuthMiddleware
{

    use GeneralTrait;

    public function handle($request, Closure $next)
    {

        try {
            if ($request->header('Authorization')) {
                if (Auth::guard('company')->check()) {
                    try {
                        JWTAuth::parseToken()->authenticate();
                    } catch (Exception $exception) {
                        if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                            return $this->apiResponse([], "Invalid Exception", 401);
                        } else if ($exception instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                            return $this->apiResponse([], "Expired Exception", 401);
                        } else {
                            return $this->apiResponse([], "Please login and return go to request", 401);
                        }
                    }
                    return $next($request);
                }
                return $this->apiResponse([], "Please login and return go to request , Invalid Token", 401);
            }
            return $this->apiResponse([], "Enter Token", 401);
        } catch (\Throwable $th) {
            return $this->apiResponse([], $th->getMessage(), 500);
        }
    }

}
