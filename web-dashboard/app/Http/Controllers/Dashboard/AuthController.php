<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if($user && Hash::check($request->password, $user->password))
        {
            Auth::login($user);

            return redirect()->route('dashboard');
            
        }

        return redirect()->route('login')->with('error', 'Invalid login credentials');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }
}
