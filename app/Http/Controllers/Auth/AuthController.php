<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Http\Request;

class AuthController
{
    public function register(RegisterRequest $request)
    {

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        Auth::login($user);

        return redirect()->route('posts.index')
            ->with("welcome", "Welcome, Thank you are finally registered");
    }
    public function login(LoginRequest $request)
    {
        // dd($request->email,$request->password,$request->remember);
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->route('posts.index')
            ->with("welcome", "Welcome back,Add more posts");
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('auth.login');
    }


}
