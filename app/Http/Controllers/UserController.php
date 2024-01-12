<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Guru; 
use App\Siswa; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function role(){
    //     $role = User::where('id',Auth::id())->first();
    //     if($role->role == 'admin'){
    //         return redirect()->route('admin.index');
    //     }
    //     else if($role->role == 'guru'){
    //         return redirect()->route('kelola_guru.data_guru');
    //     }
    // }
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6',
            'role' => 'required|in:guru,siswa',
        ]);

        $user = User::create([
            'username' => $request->input('username'),
            'password' => Hash::make($request->input('password')),
            'role' => $request->input('role'),
        ]);

        // Simpan data tambahan sesuai peran (role)
        if ($user->role === 'guru') {
            Guru::create([
                'user_id' => $user->id,
            ]);
        } elseif ($user->role === 'siswa') {
            Siswa::create([
                'user_id' => $user->id,
            ]);
        }

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan!');
    }

    // ...

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
