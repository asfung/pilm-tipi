<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{

    function index(){
        return view('login');
    }

    function login(Request $request){
        $request->validate(
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'isi email bang',
                'password.required' => 'jgn lupa password juga bang'
            ]
        );
        
        $infoLogin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infoLogin)){
            if(Auth::user()->role == 'user'){
                return redirect('/');
            }
        }else{
            return redirect('/login')->withErrors('email dan password salah !')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect('');
    }
}
