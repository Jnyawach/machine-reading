<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class AuthController extends Controller
{
    //

    public function register(){
        return inertia::render('auth/register');
    }

    public function creatUser(Request $request){
     $validated=$request->validate([
         'name'=>['required', 'string', 'max:255'],
         'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
         'password' => ['required', 'string', 'min:8','confirmed'],
         'password_confirmation'=>['required']
     ]);

        $user=User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password']),
        ]);

    }
}
