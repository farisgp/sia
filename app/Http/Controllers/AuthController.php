<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegisterForm()
    {
        $gurus = Guru::all();
        $siswas = Siswa::all();
        return view('auth.register', compact( 'gurus', 'siswas'));
    }
    
    public function logout()
    {
        Auth::logout();
        return redirect()->route('landingpage')->with('success', 'Logout Berhasil!');
    }
    public function register(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required|unique:users|max:15',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,siswa,guru',
            'id_guru'     => 'required_if:role,guru,siswa',
            'id_siswa'     => 'required_if:role,guru,siswa',
        ]);

        // Buat user baru
        $user = new User;
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role');

        if ($request->input('role') == 'guru') {
            $user->nama = $request->input('nama_guru');
        }elseif($request->input('role') == 'siswa'){
            $user->nama = $request->input('nama_siswa');
        }
    
        $user->save();
        $guru = new Guru([
            'id_guru' => $user->id,
            // tambahkan kolom lain sesuai kebutuhan
        ]);
    
        $user->guru()->save($guru);

        // Redirect ke halaman login atau sesuai kebutuhan
        return redirect('/kelola_user')->with('success', 'Registrasi berhasil!');
    }
}
