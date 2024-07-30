<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterUserController extends Controller
{
    public function register()
    {
         
        return view( "auth.register");
    }
    public function store(Request $request)
    {
      $request->validate([
            'name'=>['required','string' ],
            'email'=>['required', 'email','unique:users'],
            'password'=>['required', 'confirmed',Password::defaults() ]
        ]);
        $user= User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
        ]);

        auth()->login($user);
        return redirect()->route("posts.index")->with('message','Registered Successfully');
    }
}
