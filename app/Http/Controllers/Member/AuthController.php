<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;

class AuthController extends Controller
{
    public function showLogin() {
        return view('member.auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('member')->attempt($credentials)) {
            return redirect()->route('member.dashboard');
        }

        return back()->withErrors(['email' => 'Email atau password salah']);
    }

    public function showRegister() {
        return view('member.auth.register');
    }

    public function register(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:members',
            'password' => 'required|min:6|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);
        $member = Member::create($data);

        Auth::guard('member')->login($member);

        return redirect()->route('member.dashboard');
    }

    public function logout() {
        Auth::guard('member')->logout();
        return redirect()->route('member.login');
    }
}
