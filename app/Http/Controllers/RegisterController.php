<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showRegisterForm(){
        return view('register');
    }

    public function register(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string',
        ]);
    
        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'roles' => 'user', 
        ]);
    
        $user->save(); 

        return redirect('/login')->with('success', 'Registration successful');
    }
}
