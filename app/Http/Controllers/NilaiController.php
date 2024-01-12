<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Nilai;
use Illuminate\Support\Facades\Auth;
use DB;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $row = MataPelajaran::find($id);
        $siswa = Siswa::all();
        
        return view('kelola_nilai.index', compact('row', 'siswa'));
    }

    public function getSiswaByKelas($kelas)
    {
        $siswa = Siswa::where('kelas', $kelas)->get();

        return response()->json($siswa);
    }
    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     $siswa = Siswa::all();
    //     $kelas = Kelas::all();
    //     $matapelajaran = MataPelajaran::all();

    //     return view('kelola_nilai.nilai', compact('siswa', 'kelas', 'matapelajaran'));
    // }
    public function create($id)
    {
        $siswa = Siswa::all();
        $kelas = Kelas::all();
        $nilai = Nilai::all();
        $row = MataPelajaran::find($id);
        // dd($row);
        return view('kelola_nilai.nilai', compact('siswa', 'kelas', 'nilai', 'row'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_siswa.*' => 'required|integer',
            'id_mapel.*' => 'required|integer',
            'nilai.*.lm1' => 'nullable|integer',
            'nilai.*.lm2' => 'nullable|integer',
            'nilai.*.lm3' => 'nullable|integer',
            'nilai.*.lm4' => 'nullable|integer',
            'nilai.*.lm5' => 'nullable|integer',
            'nilai.*.lm6' => 'nullable|integer',
            'nilai.*.rata_rata_lm' => 'nullable|integer',
            'nilai.*.tes' => 'nullable|integer',
            'nilai.*.non_tes' => 'nullable|integer',
            'nilai.*.rata_rata_sas' => 'nullable|integer',
            'nilai.*.nilai_akhir' => 'nullable|integer',
        ]);

        foreach ($data['id_siswa'] as $key => $idSiswa) {
            $idMapel = $request->input('id_mapel.' . $key);
            $nilaiData = [
                'id_siswa' => $idSiswa,
                'id_mapel' => $idMapel,
                'id_mapel' => $data['id_mapel'][$key] ?? null,
                'lm1' => $data['nilai'][$idSiswa]['lm1'] ?? null,
                'lm2' => $data['nilai'][$idSiswa]['lm2'] ?? null,
                'lm3' => $data['nilai'][$idSiswa]['lm3'] ?? null,
                'lm4' => $data['nilai'][$idSiswa]['lm4'] ?? null,
                'lm5' => $data['nilai'][$idSiswa]['lm5'] ?? null,
                'lm6' => $data['nilai'][$idSiswa]['lm6'] ?? null,
                'rata_rata_lm' => $data['nilai'][$idSiswa]['rata_rata_lm'] ?? null,
                'tes' => $data['nilai'][$idSiswa]['tes'] ?? null,
                'non_tes' => $data['nilai'][$idSiswa]['non_tes'] ?? null,
                'rata_rata_sas' => $data['nilai'][$idSiswa]['rata_rata_sas'] ?? null,
                'nilai_akhir' => $data['nilai'][$idSiswa]['nilai_akhir'] ?? null,
            ];
            // dd($nilaiData);
            Nilai::create($nilaiData);
        }

        return redirect()->route('mata-pelajaran.index')->with('success', 'Nilai berhasil disimpan');
    }

    
    // public function create()
    // {
    //     $siswa = Siswa::all();
    //     $guru = Guru::all();
    //     $matapelajaran = MataPelajaran::all();
    //     $kelas = Kelas::all();
    //     $nilai = Nilai::all();
    //     return view('kelola_nilai.nilai',  compact('siswa', 'guru', 'matapelajaran', 'kelas', 'nilai'));
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'id_kelas' => 'integer',
    //         'id_siswa' => 'integer',
    //         'id_mapel' => 'integer',
    //         'lm1' => 'nullable|integer',
    //         'lm2' => 'nullable|integer',
    //         'lm3' => 'nullable|integer',
    //         'lm4' => 'nullable|integer',
    //         'lm5' => 'nullable|integer',
    //         'lm6' => 'nullable|integer',
    //         'rata_rata_lm' => 'nullable|integer',
    //         'tes' => 'nullable|integer',
    //         'non_tes' => 'nullable|integer',
    //         'rata_rata_sas' => 'nullable|integer',
    //         'nilai_akhir' => 'nullable|integer',
    //     ]);
        
    //     DB::table('nilai')->insert([
    //         'id_kelas' => $request->id_kelas,
    //         'id_siswa' => $request->id_siswa,
    //         'id_mapel' => $request->id_mapel,
    //         'lm1' => $request->lm1,
    //         'lm2' => $request->lm2,
    //         'lm3' => $request->lm3,
    //         'lm4' => $request->lm4,
    //         'lm5' => $request->lm5,
    //         'lm6' => $request->lm6,
    //         'rata_rata_lm' => $request->rata_rata_lm,
    //         'tes' => $request->tes,
    //         'non_tes' => $request->non_tes,
    //         'rata_rata_sas' => $request->rata_rata_sas,
    //         'nilai_akhir' => $request->nilai_akhir,
    //         'created_at' => now(),
    //     ]);

    //     return redirect('/nilai')
    //         ->with('success', 'Nilai Berhasil Disimpan');
    // }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $row = MataPelajaran::find($id);
        $siswa = Siswa::all();
        $nilaiData = Nilai::where('id_mapel', $row->id)->get(); // Fetch nilai data for the given id_mapel
        return view('kelola_nilai.index', compact('row', 'siswa', 'nilaiData'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        return view('kelola_nilai.nilai');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'id_siswa.*' => 'required|integer',
            'id_mapel.*' => 'required|integer',
            'nilai.*.lm1' => 'nullable|integer',
            'nilai.*.lm2' => 'nullable|integer',
            'nilai.*.lm3' => 'nullable|integer',
            'nilai.*.lm4' => 'nullable|integer',
            'nilai.*.lm5' => 'nullable|integer',
            'nilai.*.lm6' => 'nullable|integer',
            'nilai.*.rata_rata_lm' => 'nullable|integer',
            'nilai.*.tes' => 'nullable|integer',
            'nilai.*.non_tes' => 'nullable|integer',
            'nilai.*.rata_rata_sas' => 'nullable|integer',
            'nilai.*.nilai_akhir' => 'nullable|integer',
        ]);

        foreach ($data['id_siswa'] as $key => $idSiswa) {
            $idMapel = $request->input('id_mapel.' . $key);
            $nilaiData = [
                'id_siswa' => $idSiswa,
                'id_mapel' => $idMapel,
                'id_mapel' => $data['id_mapel'][$key] ?? null,
                'lm1' => $data['nilai'][$idSiswa]['lm1'] ?? null,
                'lm2' => $data['nilai'][$idSiswa]['lm2'] ?? null,
                'lm3' => $data['nilai'][$idSiswa]['lm3'] ?? null,
                'lm4' => $data['nilai'][$idSiswa]['lm4'] ?? null,
                'lm5' => $data['nilai'][$idSiswa]['lm5'] ?? null,
                'lm6' => $data['nilai'][$idSiswa]['lm6'] ?? null,
                'rata_rata_lm' => $data['nilai'][$idSiswa]['rata_rata_lm'] ?? null,
                'tes' => $data['nilai'][$idSiswa]['tes'] ?? null,
                'non_tes' => $data['nilai'][$idSiswa]['non_tes'] ?? null,
                'rata_rata_sas' => $data['nilai'][$idSiswa]['rata_rata_sas'] ?? null,
                'nilai_akhir' => $data['nilai'][$idSiswa]['nilai_akhir'] ?? null,
            ];
            // dd($nilaiData);
            Nilai::create($nilaiData);
        }

        return redirect()->route('nilai.index')->with('success', 'Nilai berhasil disimpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
