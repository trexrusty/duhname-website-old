<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\SessionRequest;
class SessionController extends Controller
{
    public function loginview()
    {
        return view('auth.login');
    }

    public function login(SessionRequest $request)
    {
        $credential = $request->validated();

        if (!Auth::attempt($credential)) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        $request->session()->regenerate();
        return redirect()->route('home');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
