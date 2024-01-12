<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfilController extends Controller
{
    public function index()
    {
        $user = Auth::user(); // Mendapatkan user yang sedang login
        return view('profil.index', compact('user'));
    }
}
