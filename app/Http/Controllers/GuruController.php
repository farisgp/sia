<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Requests\GuruRequest;

use App\Models\Kelas;
use App\Models\Agama;
use App\Models\MataPelajaran;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\User;
use App\Models\KelolaUser;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function tampilkanSiswaGuru($idUser)
    // {
    //     $user = User::with('guru.kelas.siswa')->find($idUser);

    //     $siswaKelasGuru = $user->guru->kelas->siswa;

    //     return view('guru.daftar_siswa', compact('siswaKelasGuru'));
    // }
    public function index()
    {
        // $id_guru = Auth::id();
        // $nilai = Nilai::where('id_kelas', $id_kelas) ->where('id_guru', $id_guru) ->get();
        $guru = Guru::all();
        return view('kelola_guru.data_guru', compact('guru'));
    }
    public function showProfile()
    {
        $user = Auth::user();

        if ($user->role === 'guru') {
            $guru = Guru::where('user_id', $user->id)->first();

            return view('data_guru.profile', compact('guru'));
        }

        // Handle jika bukan akun guru
        return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
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
        return view('kelola_guru.form');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function profile_guru(){
        return view('kelola_guru.biodata_guru');
    }
    public function store(Request $request)
    {
        $request->validate(
            [
            'nip' => 'required|unique:guru|min:8',
            'nama_guru' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'id_mapel' => 'required|integer',
            'id_kelas' => 'required|integer',
            'alamat' => 'required|max:255',
            'kontak' => 'nullable',
            'id_agama' => 'required|integer',
            'pendidikan' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            ],
        // custom pesan errornya
            [
            'nama_guru.required' => 'Nama Wajib Diisi',
            'nama_guru.min' => 'Nama Wajib Diisi Minimal 3 Karakter',
            'nip.required' => 'NIP Wajib Diisi',
            'nip.min' => 'NIP Minimal 8 karakter',
            'nip.unique' => 'NIP Sudah Ada (Terduplikasi)',
            'jenis_kelamin.required' => 'Nama Wajib Diisi',
            'id_mapel.required' => 'Wajib Mengisi Mata Pelajaran Yang Diampu',
            'id_mapel.integer' => 'Wajib Mengisi Mata Pelajaran Yang Diampu Pada Bagian Pengampu (Guru Mata Pelajaran)',
            'id_kelas.required' => 'Wajib Mengisi Kelas Yang Diampu',
            'id_kelas.integer' => 'Wajib Mengisi Kelas Yang Diampu Pada Bagian Pengampu (Guru Kelas)',
            'alamat.required' => 'Alamat Wajib Diisi',
            'alamat.max' => 'Alamat Maksimal 255 Karakter',
            'id_agama.required' => 'Agama Wajib Diisi',
            'id_agama.integer' => 'Agama Wajib Diisi',
            'pendidikan.required' => 'Pendidikan Wajib Diisi',
            'jabatan.required' => 'Jabatan Wajib Diisi',

            ]
        );
        if(!empty($request->foto)){
            $fileName = 'foto-'.$request->nip.'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('admin/img'),$fileName);
        }
        else{
            $fileName = '';
        }

        DB::table('guru')->insert(
            [
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_mapel' => $request->id_mapel,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'id_agama' => $request->id_agama,
                'pendidikan' => $request->pendidikan,
                'jabatan' => $request->jabatan,
                'user_id' => $request->id,
                'foto'=>$fileName,
                'created_at' => now(),
            ]
        );
        // $user = Auth::user();

        // if ($user->role === 'guru') {
        //     $guru = Guru::where('user_id', $user->id)->first();

        //     return view('data_guru.profile', compact('guru'));
        // }

        // Handle jika bukan akun guru
        // return redirect()->route('dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');

        return redirect('data_guru')
            ->with('success', 'Data Guru Berhasil Disimpan');
    }

    public function store2(Request $request)
    {
        $request->validate(
            [
            'nip' => 'required|unique:guru|min:8',
            'nama_guru' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'id_mapel' => 'nullable',
            'id_kelas' => 'nullable',
            'alamat' => 'required|max:255',
            'kontak' => 'nullable',
            'id_agama' => 'required|integer',
            'pendidikan' => 'required',
            'jabatan' => 'nullable',
            ],
        //custom pesan errornya
            [
            'nama_guru.required' => 'Nama Wajib Diisi',
            'nama_guru.min' => 'Nama Wajib Diisi Minimal 3 Karakter',
            'nip.required' => 'NIP Wajib Diisi',
            'nip.min' => 'NIP Minimal 8 karakter',
            'nip.unique' => 'NIP Sudah Ada (Terduplikasi)',
            'jenis_kelamin.required' => 'Nama Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi',
            'alamat.max' => 'Alamat Maksimal 255 Karakter',
            'id_agama.required' => 'Agama Wajib Diisi',
            'id_agama.integer' => 'Agama Wajib Diisi',
            'pendidikan.required' => 'Pendidikan Wajib Diisi',
            'jabatan.nullable' => 'Jabatan Wajib Diisi',

            ]
        );

        DB::table('guru')->insert(
            [
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
                'jenis_kelamin' => $request->jenis_kelamin,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'id_agama' => $request->id_agama,
                'pendidikan' => $request->pendidikan,
                'jabatan' => $request->jabatan,
                'user_id' => auth()->user()->id,
                'created_at' => now(),
            ]
        );

        return redirect('/data_guru')
            ->with('success', 'Data Guru Berhasil Disimpan');
    }
    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $row = Guru::find($id);
        return view('data_guru.detail', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $row = Guru::find($id);
        return view('kelola_guru.form_edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|min:8',
            'nama_guru' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'id_mapel' => 'required|integer',
            'id_kelas' => 'required|integer',
            'alamat' => 'required|max:255',
            'kontak' => 'nullable',
            'id_agama' => 'required|integer',
            'pendidikan' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        $foto = DB::table('guru')->select('foto')->where('id',$id)->get();
        foreach($foto as $f){
            $namaFileFotoLama = $f->foto;
        }
        //------------apakah user ingin ganti foto lama-----------
        if(!empty($request->foto)){
            //jika ada foto lama, hapus foto lamanya terlebih dahulu
            if(!empty($row->foto)) unlink('admin/img/'.$row->foto);
            //proses foto lama ganti foto baru
            $fileName = 'foto-'.$request->nip.'.'.$request->foto->extension();
            //$fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('admin/img'),$fileName);
        }
        //------------tidak berniat ganti ganti foto lama-----------
        else{
            $fileName = $namaFileFotoLama;
        }

        DB::table('guru')->where('id', $id)->update(
            [
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_mapel' => $request->id_mapel,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'id_agama' => $request->id_agama,
                'pendidikan' => $request->pendidikan,
                'jabatan' => $request->jabatan,
                'foto'=>$fileName,
                'updated_at' => now(),
            ]
        );

        return redirect('/data_guru')
            ->with('success', 'Data Guru Berhasil Diubah');
    }

    public function update2(Request $request)
    {
        $request->validate([
            'nip' => 'required|min:8',
            'nama_guru' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'id_mapel' => 'nullable',
            'id_kelas' => 'nullable',
            'alamat' => 'required|max:255',
            'kontak' => 'nullable',
            'id_agama' => 'required|integer',
            'pendidikan' => 'required',
            'jabatan' => 'nullable',
        ]);
    
        DB::table('guru')->where('id', $request->id)->update(
            [
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_mapel' => $request->id_mapel,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'kontak' => $request->kontak,
                'id_agama' => $request->id_agama,
                'pendidikan' => $request->pendidikan,
                'jabatan' => $request->jabatan,
                'updated_at' => now(),
            ]
        );
            return redirect()->route('info_guru')
            ->with('success', 'Data Customer Berhasil Diupdate');
        
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Guru::where('id', $id)->delete();
        return redirect('/data_guru')
            ->with('success', 'Data Guru Berhasil Dihapus');
    }
}
