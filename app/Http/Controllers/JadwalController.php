<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\MataPelajaran;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use App\Models\Guru;
use DB;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $jadwal = Jadwal::all();
        return view('jadwal.jadwal', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        // $ar_gender = ["L","P"];
        // $ar_mapel = MataPelajaran::all();
        // $ar_agama = Agama::all();
        // $ar_kelas = Kelas::all();
        // return view('kelola_guru.form', compact('ar_gender', 'ar_mapel', 'ar_agama', 'ar_kelas'));
        return view('jadwal.form');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'id_mata_pelajaran' => 'required|integer',
                'id_kelas' => 'required|integer',
                'id_guru' => 'required|integer',
                'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
                'waktu' => 'required',
            ],
        //custom pesan errornya
            [
                'id_mata_pelajaran.integer' => 'Mata Pelajaran Wajib Diisi',
                'id_kelas.integer' => 'Kelas Wajib Diisi',
                'id_guru.integer' => 'Guru Wajib Diisi',
                'hari.in' => 'Hari harus dipilih dari opsi yang tersedia',
                'waktu.required' => 'Jam Mulai Wajib Diisi',

            ]
        );

        DB::table('jadwal_pelajaran')->insert(
            [
                'id_mata_pelajaran' => $request->id_mata_pelajaran,
                'id_kelas' => $request->id_kelas,
                'id_guru' => $request->id_guru,
                'hari' => $request->hari,
                'waktu' => $request->waktu,
                'created_at' => now(),
            ]
        );

        return redirect('/jadwal')
            ->with('success', 'Jadwal Pelajaran Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $guru_id = Guru::find($id);
        // return view('kelola_guru.detail_guru', compact('guru_id'));

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $row = Jadwal::find($id);
        return view('jadwal.form-edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'id_mata_pelajaran' => 'required|integer',
                'id_kelas' => 'required|integer',
                'id_guru' => 'required|integer',
                'hari' => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
                'waktu' => 'required',
            ],
        //custom pesan errornya
            [
                'id_mata_pelajaran.integer' => 'Mata Pelajaran Wajib Diisi',
                'id_kelas.integer' => 'Kelas Wajib Diisi',
                'id_guru.integer' => 'Guru Wajib Diisi',
                'hari.in' => 'Hari harus dipilih dari opsi yang tersedia',
                'waktu.required' => 'Jam Mulai Wajib Diisi',

            ]
        );

        DB::table('jadwal_pelajaran')->insert(
            [
                'id_mata_pelajaran' => $request->id_mata_pelajaran,
                'id_kelas' => $request->id_kelas,
                'id_guru' => $request->id_guru,
                'hari' => $request->hari,
                'waktu' => $request->waktu,
                'created_at' => now(),
            ]
        );

        return redirect('/jadwal')
            ->with('success', 'Jadwal Pelajaran Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Jadwal::where('id', $id)->delete();
        return redirect('/jadwal')
            ->with('success', 'Jadwal Pelajaran Berhasil Dihapus');
    }
}
