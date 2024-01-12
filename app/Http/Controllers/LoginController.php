<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Lakukan validasi dan autentikasi pengguna
        $credentials = $request->only('username', 'password');
        if (auth()->attempt($credentials)) {
            auth()->user()->load('guru');
            // Redirect atau tindakan lainnya setelah login
        }
        if (auth()->attempt($credentials)) {
            // Jika autentikasi berhasil, redirect ke halaman yang sesuai
            return redirect()->intended('/dashboard');
        } else {
            // Jika autentikasi gagal, kembalikan ke halaman login dengan pesan error
            return back()->withErrors(['username' => 'username atau password salah']);
        }
    }
    public function showLoginForm()
    {
        return view('auth.login');
    }
}
