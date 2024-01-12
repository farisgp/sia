<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EditController extends Controller
{
    public function editSiswa($id) {
        // Logika untuk mengambil dan menampilkan data siswa berdasarkan ID
        // ...
    
        return view('edit.siswa', ['data' => $data]);
    }
    
    public function editGuru($id) {
        // Logika untuk mengambil dan menampilkan data guru berdasarkan ID
        // ...
    
        return view('edit.guru', ['data' => $data]);
    }
    
}
