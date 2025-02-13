<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SiswaResource;
use App\Models\KelolaUser;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SiswaController extends Controller
{
    public function index()
    {
            $siswa = Siswa::leftjoin('kelas', 'kelas.id', '=', 'siswa.id_kelas')
                ->leftjoin('agama', 'agama.id', '=', 'siswa.id_agama')
                ->leftjoin('users', 'users.id', '=', 'siswa.user_id')
                ->select('siswa.nis','siswa.nisn', 'siswa.nama_siswa', 'siswa.jenis_kelamin',
                'siswa.tanggal_lahir', 'kelas.tingkat_kelas as kelas', 'siswa.status', 'siswa.tahun_ajaran', 
                'siswa.tahun_lulus', 'agama.agama', 'siswa.alamat', 'siswa.kontak_ortu', 'users.username')
                ->get();
        // $siswa = siswa::all();
        return new SiswaResource(true, 'Data Siswa', $siswa);
    }
    public function show($id)
    {
        //menampilkan detail data seorang pegawai
        //$pegawai = Pegawai::find($id);
        $siswa = Siswa::leftjoin('kelas', 'kelas.id', '=', 'siswa.id_kelas')
                ->leftjoin('agama', 'agama.id', '=', 'siswa.id_agama')
                ->leftjoin('users', 'users.id', '=', 'siswa.user_id')
                ->select('siswa.nis','siswa.nisn', 'siswa.nama_siswa', 'siswa.jenis_kelamin',
                'siswa.tanggal_lahir', 'kelas.tingkat_kelas as kelas', 'siswa.status', 'siswa.tahun_ajaran', 
                'siswa.tahun_lulus', 'agama.agama', 'siswa.alamat', 'siswa.kontak_ortu', 'users.username')
                ->where('siswa.id', '=', $id) 
                ->first();
        if ($siswa) {
            return (new SiswaResource(true, 'Data Siswa Berhasil Ditampilkan', $siswa))
                ->response()
                ->setStatusCode(202); 
        } else {
            return (new SiswaResource(false, 'Data Siswa Tidak Ditemukan', $siswa))
                ->response()
                ->setStatusCode(404); 
        }
    }
    public function store(Request $request)
    {
        //proses input pegawai
        $validator = Validator::make($request->all(),[
            'nip' => 'nullable|unique:siswa|min:19|max:19',
            'nama_siswa' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'jenis_siswa' => 'required',
            'jabatan' => 'nullable',
            // 'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'username' => 'required',
            'password' => 'required',
            'id_kelas' => ($request->jenis_siswa === 'siswa Kelas' || $request->jenis_siswa === 'siswa Mata Pelajaran') ? 'required': 'nullable',
            'id_mapel' => ($request->jenis_siswa === 'siswa Mata Pelajaran') ? 'required|integer': 'nullable',
        ]);

        //cek error atau tidak inputan data
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        //proses menyimpan data yg diinput
        $user = new KelolaUser();
        $siswa = new siswa;
        $user->nama = $request->nama_siswa; // Menggunakan nama siswa untuk kolom nama
        $user->username = $request->username;
        $user->password = bcrypt($request->password); 
        $user->role = 'siswa';
        $user->save();
        
        $siswa->nip = $request->nip;
        $siswa->nama_siswa = $request->nama_siswa;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->jenis_siswa = $request->jenis_siswa;
        $siswa->id_kelas = $request->id_kelas;

        $siswa->id_mapel = $request->id_mapel;
        $siswa->jabatan = $request->jabatan;
        $siswa->user_id = $user->id;
        $siswa->created_at = now();
        $siswa->save();

        $user->id_siswa = $siswa->id;
        $user->save();

        return new siswaResource(true, 'Data siswa Berhasil diinput',$siswa);              
    }
    public function update(Request $request, $id)
    {
        //proses input pegawai
        $validator = Validator::make($request->all(),[
            'nis' => 'required|min:4',
            'nisn' => 'nullable|min:8',
            'nama_siswa' => 'required|max:45',
            'tanggal_lahir' => 'nullable',
            'id_kelas' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'nullable',
            'kontak_ortu' => 'nullable',
            'tahun_ajaran' => 'required',
            'id_agama' => 'required',
        ]);

        //cek error atau tidak inputan data
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        //proses menyimpan data yg diinput
        $siswa = Siswa::whereId($id)->update(
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
                'tahun_ajaran' => $request->tahun_ajaran,
                'updated_at' => now()
            ]
        );

        return new SiswaResource(true, 'Data Siswa Berhasil Diubah',$siswa);              
    }

    public function destroy($id){
        $siswa = Siswa::whereId($id)->first();
        $siswa->delete();

        return new SiswaResource(true, 'Data Siswa Berhasil Dihapus',$siswa);
    }
}
