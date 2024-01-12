<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Agama;
use App\Models\Nilai;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
Use Alert;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = Siswa::all();
        return view('kelola_siswa.data_siswa', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kelola_siswa.form');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:siswa|min:4',
            'nisn' => 'required|unique:siswa|min:8',
            'nama_siswa' => 'required|max:45',
            'tanggal_lahir' => 'required',
            'id_kelas' => 'required|integer',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kontak_ortu' => 'nullable',
            'id_agama' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ],
        //custom pesan errornya
        [
            'nis.required' => 'NIS Wajib Diisi',
            'nis.unique' => 'NIS Sudah Ada (Terduplikasi)',
            'nis.min' => 'NIS Minimal 3 karakter',
            'nisn.required' => 'NIS Wajib Diisi',
            'nisn.unique' => 'NISN Sudah Ada (Terduplikasi)',
            'nisn.max' => 'NISN Maksimal 8 karakter',
            'nama_siswa.required' => 'Nama Wajib Diisi',
            'nama_siswa.max' => 'Nama Maksimal 45 Karakter',
            'tanggal_lahir.required' => 'Tanggal Lahir Wajib Diisi',
            'id_kelas.required' => 'Kelas Wajib Diisi',
            'id_kelas.integer' => 'Kelas Wajib Diisi Dengan Pilihan yang tersedia',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib Diisi',
            'alamat.required' => 'Alamat Wajib Diisi',
            'id_agama.required' => 'Agama Wajib Diisi Dengan PIlihan yang tersedia',


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

        DB::table('siswa')->insert(
            [
                'nama_siswa' => $request->nama_siswa,
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'kontak_ortu' => $request->kontak_ortu,
                'id_agama' => $request->id_agama,
                'user_id' => auth()->user()->id,
                'foto'=>$fileName,
                'created_at' => now(),
            ]
        );

        return redirect('/data_siswa')
            ->with('success', 'Data Siswa Berhasil Disimpan');
    }
    public function biodata(){
        $biodata = Siswa::where('user_id', Auth::id())->get();

            return view('kelola_siswa.profil_siswa', compact('biodata'));
    }
    
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $siswa_id = Siswa::find($id);
        return view('kelola_siswa.detail_siswa', compact('siswa_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $row = Siswa::find($id);
        return view('kelola_siswa.form_edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|min:4',
            'nisn' => 'required|min:8',
            'nama_siswa' => 'required|max:45',
            'tanggal_lahir' => 'required',
            'id_kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kontak_ortu' => 'nullable',
            'id_agama' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]
        );
        $foto = DB::table('siswa')->select('foto')->where('id',$id)->get();
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
        DB::table('siswa')->where('id', $id)->update(
            [
                'nama_siswa' => $request->nama_siswa,
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'kontak_ortu' => $request->kontak_ortu,
                'id_agama' => $request->id_agama,
                'foto'=>$fileName,
                'updated_at' => now()
            ]
        );

        return redirect('/data_siswa')
            ->with('success', 'Data Siswa Berhasil Diubah');
    }
    public function update2(Request $request)
    {
        $request->validate([
            'nis' => 'required|min:4',
            'nisn' => 'required|min:8',
            'nama_siswa' => 'required|max:45',
            'tanggal_lahir' => 'required',
            'id_kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'kontak_ortu' => 'nullable',
            'id_agama' => 'required',
        ]);
    
        DB::table('siswa')->where('id', $request->id)->update(
            [
                'nama_siswa' => $request->nama_siswa,
                'nis' => $request->nis,
                'nisn' => $request->nisn,
                'jenis_kelamin' => $request->jenis_kelamin,
                'tanggal_lahir' => $request->tanggal_lahir,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'kontak_ortu' => $request->kontak_ortu,
                'id_agama' => $request->id_agama,
                'updated_at' => now()
            ]
        );
            return redirect()->route('info_siswa')
            ->with('success', 'Data Customer Berhasil Diupdate');
        
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Siswa::where('id', $id)->delete();
        return redirect('data_siswa')
            ->with('success', 'Data Siswa Berhasil Dihapus');
    }
}
