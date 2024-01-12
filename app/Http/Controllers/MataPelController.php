<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MataPelajaran;

class MataPelController extends Controller
{
    public function index()
    {
        $mapel = MataPelajaran::all();
        return view('kelola_nilai.mata_pelajaran', compact('mapel'));
    }
}
