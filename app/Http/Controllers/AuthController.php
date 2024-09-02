<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use App\Models\User;
use App\Models\Siswa;
use App\Models\Guru;
use App\Repositories\UserRepo;
use App\Http\Requests\UserChangePass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $user;

    public function __construct(UserRepo $user)
    {
        $this->user = $user;
    }
    public function edit_profile()
    {
        $d['my'] = auth()->user();
        return view('kelola_user.change_pass', $d);
    }

    public function change_pass(UserChangePass $req)
    {
        $user_id = auth()->user()->id;
        // dd($user_id);
        $my_pass = auth()->user()->password;
        $old_pass = $req->current_password;
        $new_pass = $req->password;
        
        if(password_verify($old_pass, $my_pass)){
            $data['password'] = Hash::make($new_pass);
            $this->user->update($user_id, $data);
            return back()->with('success', 'Password Berhasil Diubah');
        }

        return back()->with('error', 'Gagal Mengubah Password');
    }
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
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required',
            'username' => 'required|unique:users|max:15',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,siswa,guru',
        ]);

        // Buat user baru
        $user = new User;
        $user->nama = $request->input('nama');
        $user->username = $request->input('username');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role');
        $user->save();

        // Redirect ke halaman login atau sesuai kebutuhan
        return redirect('/kelola_user')->with('success', 'Registrasi berhasil!');
    }
}
