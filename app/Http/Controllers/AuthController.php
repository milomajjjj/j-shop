<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    function loginPage(){
        return view('auth.login');
    }

    function registerPage(){
        return view('auth.register');
    }

    function register(Request $request){
       $fields = $request->validate([
        'name' => ['required','string','max:255'],
        'email' => ['required','email','unique:users','max:255'],
        'password' => ['required','string','confirmed','min:6'],
        'terms' => ['required']
       ]);
       $user = User::create($fields);
       Auth::login($user);
       return redirect()->route('home')
    ->with('success', 'Welcome ' . $user->name . ' 👋');
    }

    function logout(){
        Auth::logout();
        return redirect()->route('home')
    ->with('success', 'You have been logged out successfully.');
}

function login(Request $request){
    $fields = $request->validate([
        'email' => ['required','email'],
        'password' => ['required','string']
       ]);
       if(Auth::attempt($fields)){
        return redirect()->route('home')
    ->with('success', 'Welcome back ' . Auth::user()->name . ' 👋');
       }
       return back()->with('error', 'Invalid credentials.');
}
}