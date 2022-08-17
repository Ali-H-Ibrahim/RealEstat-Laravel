<?php

namespace App\Http\Middleware;

use App\Traits\GeneralTrait;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Lcobucci\JWT\Claim\BasicTest;
use phpDocumentor\Reflection\Types\This;
use TheSeer\Tokenizer\TokenCollectionException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

class AssingnGuardToken extends BaseMiddleware
{
    use GeneralTrait;


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard=null)
    {
        if ($guard != null){

            auth()->shouldUse($guard);

            $token=$request->user_token;
            $request->headers->set('auth-token',(string)$token,true);
            $request->headers->set('Authorization','Bearer'.$token,true);

            try {
//                $user=$this->auth->authenticate($request);//check authenticated user
                $user=JWTAuth::parseToken()->authenticate();//check authenticated user

                if($user->role!=2&&$guard=='admin'){

                    return $this->returnError(' لا تملك صلاحيات الدخول');
                }

//                if($user->role!=1&&$guard=='api'){
//
//                    return $this->returnError('Unauthenticated user  role 2');
//
//                }

            }catch (TokenCollectionException $exception){

                return $this->returnError('Unauthenticated user');
            }
            catch (JWTException $exception){

                return $this->returnError('invalid token');
            }
            return $next($request);
    }

    }
}
