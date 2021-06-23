<?php

namespace App\Http\Middleware;

use Closure;
use PHPUnit\Framework\Exception;
use Firebase\JWT\JWT;
use App\Models\User;

class AuthenticatorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {

            if (!$request->hasHeader('Authorization')) {
                throw new Exception();
            }
            $authorizationHeader = $request->header('Authorization');
            $token = str_replace('Bearer ','',$authorizationHeader);
            $autenticationData = JWT::decode($token,env('JWT_KEY'),['HS256']);
            
            $user = User::where('email', $autenticationData->email)->first();
    
            if (is_null($user)){
                throw new Exception();
            }
    
            return $next($request);

        } catch (\Exception $e) {
            return response()->json('Não autorizado',401);
        }        
    }
}
