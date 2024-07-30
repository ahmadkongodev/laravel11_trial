<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function login()
    {
         
        return view("auth.login");
    }
    public function store(Request $request)
    {
         $request->validate([
            'email'=>['required', 'email'],
            'password'=>['required', ]
        ]);
        if (Auth::guard('web')->attempt(['email'=>$request->email, 'password'=> $request->password])) {
            return redirect()->intended(route('posts.index'))->with('message','Successfully Logged In');
        }
        else {
            return back()->withErrors([
                'email'=>'The provided credential do not match our records',
            ]);
        }  
    }
    public function logout(Request $request)
    {
         Auth::guard('web')->logout();
         $request->session()->invalidate();
         $request->session()->regenerate();
        return  to_route('posts.index');
    }

}
