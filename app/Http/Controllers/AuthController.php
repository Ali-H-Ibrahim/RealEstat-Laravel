<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use GeneralTrait;



    public function register(Request $request) {


        $validator = Validator::make($request->all(), [

            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
            'phone' => 'required|string'

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //create User
        $user = User::create([
            'name' =>$request->name,
            'email' =>$request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);

        $data = $request->input();

        //generate token
        $token=Auth::guard('api')->attempt(['email' => $data['email'], 'password' => $data['password']]);




        $response = [
            'user' => $user,
            'token' => $token
        ];

        if ($user)
           return $this->returnData($response,"register successfully.");
        else
            return  $this->returnError("register  failed.");

    }


    // login
    public function login(Request $request) {


        $validator = Validator::make($request->all(), [

            'email' => 'required|string',
            'password' => 'required|string'

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $data = $request->input();

        $token=Auth::guard('api')->attempt(['email' => $data['email'], 'password' => $data['password']]);
//        $token=Auth::guard('api')->attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 1]);


        if(!$token)
            return $this->returnError("login failed.");

        // get User
        $user = Auth::guard('api')->user();

        $response = [
            'user' => $user,
            'token' => $token
        ];

        if ($user)
            return $this->returnData($response,"login successfully.");
        else
            return $this->returnError("login failed.");

    }

    public function logout(Request $request) {

        $token=$request->user_token;
        if($token){
         JWTAuth::setToken($token)->invalidate();
         return  $this->returnSuccess('logout successfully');
        }
        else
        return $this->returnError('invalid token ');
    }



    public function user_update(Request $request)
    {
        $user_id = Auth::guard('api')->id();

        $user=User::find($user_id);

        //validate info
        $validator = Validator::make($request->all(), [

            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string',
            'phone' => 'required|string'

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        $user->update([

            'name' =>$request->name,
            'email' =>$request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
        ]);


        $response = [
            'user' => $user,
        ];

        if ($user)
            return $this->returnData($response,"update successfully.");
        else
            return  $this->returnError("update  failed.");

    }


    public function get_profiles_user(Request $request)
    {

        $user = Auth::guard('api')->user();
        $response = [
            'user' => $user,
        ];

        if ($user)
            return $this->returnData($response,"get profiles user successfully.");
        else
            return  $this->returnError("get profiles user  failed.");

    }



    public function get_all_users(Request $request)
    {
        $users = User::get();
        $response = [
            'users' => $users,
        ];

        if ($users)
            return $this->returnData($response,"get all users successfully.");
        else
            return  $this->returnError("get all users  failed.");
    }




}
