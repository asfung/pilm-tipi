<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserAuthController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['login','register','refresh','logout']]);
    // }

    public function page(){
        return view('login-page-api');
    }

    public function register(Request $request){
        try{
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6',
            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = Auth::guard('api')->login($user);
            return response()->json([
                'status' => 'success',
                'message' => 'User created successfully',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                ]
            ]);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function login(Request $request)
    {
        try{
            $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);
            $credentials = $request->only('email', 'password');

            $token = Auth::guard('api')->attempt($credentials);
            if (!$token) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Unauthorized',
                ], 401);
            }

            $user = Auth::guard('api')->user();
            return response()->json([
                    'status' => 'success login',
                    'user' => $user,
                    'authorization' => [
                        'token' => $token,
                        'type' => 'Bearer',
                    ]
            ]);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

    public function logout()
    {
        try{
            Auth::guard('api')->logout();
            return response()->json([
                'status' => 'success',
                'message' => 'Successfully logged out',
            ]);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }


    // public function refresh()
    // {
    //     try{
    //         return response()->json([
    //             'status' => 'success',
    //             'user' => Auth::guard('api')->user(),
    //             'authorisation' => [
    //                 'token' => Auth::guard('api')->refresh(),
    //                 'type' => 'bearer',
    //             ]
    //         ]);
    //     }catch(\Exception $e){
    //         return response()->json($e->getMessage(), 500);
    //     }
    // }

    public function me()
    {
        try{
            $user = Auth::guard('api')->user();
            return response()->json([
                'status' => 'success',
                'user' => $user,
            ]);
        }catch(\Exception $e){
            return response()->json($e->getMessage(), 500);
        }
    }

}
