<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Franchise;
use Illuminate\Support\Facades\Auth;

class FranchiseLoginController extends Controller
{
    // public function showLoginForm()
    // {
    //     return view('franchise.auth.login');
    // }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Franchise::where('email', $credentials['email'])->first();
        if($user){
            if($user->Status !== 'Active'){
                return back()->withErrors(['email' => 'Your pathlab is inactive. Please contact administration.']);
            }
        }

        if (Auth::guard('franchise')->attempt($credentials)) {
            return redirect()->route('franchise.dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }

    public function logout()
    {
        Auth::guard('franchise')->logout();
        return redirect()->route('franchise-login');
    }
}

