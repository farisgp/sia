<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Http\Resources\GuruResource;
use App\Models\KelolaUser;
use DB;
use Illuminate\Support\Facades\Validator;

class GuruController extends Controller
{
    public function index()
    {
            $guru = Guru::leftjoin('mata_pelajaran', 'mata_pelajaran.id', '=', 'guru.id_mapel')
                ->leftjoin('kelas', 'kelas.id', '=', 'guru.id_kelas')
                ->leftjoin('agama', 'agama.id', '=', 'guru.id_agama')
                ->leftjoin('users', 'users.id', '=', 'guru.user_id')
                ->select('guru.nip', 'guru.nama_guru', 'guru.jenis_kelamin',
                'mata_pelajaran.nama_mapel as pengampu mapel', 'guru.id_kelas as pengampu kelas', 'agama.agama',
                'guru.alamat','guru.kontak', 'guru.jenis_guru', 'users.username' , 'guru.tahun_pemberhentian')
                ->get();
        // $guru = Guru::all();
        return new GuruResource(true, 'Data Guru', $guru);
    }
    public function show($id)
    {
        //menampilkan detail data seorang pegawai
        //$pegawai = Pegawai::find($id);
        $guru = Guru::leftjoin('mata_pelajaran', 'mata_pelajaran.id', '=', 'guru.id_mapel')
                ->leftjoin('kelas', 'kelas.id', '=', 'guru.id_kelas')
                ->leftjoin('agama', 'agama.id', '=', 'guru.id_agama')
                ->leftjoin('users', 'users.id', '=', 'guru.user_id')
                ->select('guru.nip', 'guru.nama_guru', 'guru.jenis_kelamin',
                'mata_pelajaran.nama_mapel as pengampu mapel', 'guru.id_kelas as pengampu kelas', 'agama.agama',
                'guru.alamat','guru.kontak', 'guru.jenis_guru', 'users.username' , 'guru.tahun_pemberhentian')
                ->where('guru.id', '=', $id) 
                ->first();
        if ($guru) {
            return (new GuruResource(true, 'Data Guru Berhasil Ditampilkan', $guru))
                ->response()
                ->setStatusCode(202); 
        } else {
            return (new GuruResource(false, 'Data Guru Tidak Ditemukan', $guru))
                ->response()
                ->setStatusCode(404); 
        }
    }
    public function store(Request $request)
    {
        //proses input pegawai
        $validator = Validator::make($request->all(),[
            'nip' => 'nullable|unique:guru|min:19|max:19',
            'nama_guru' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'jenis_guru' => 'required',
            'jabatan' => 'nullable',
            // 'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'username' => 'required',
            'password' => 'required',
            'id_kelas' => ($request->jenis_guru === 'Guru Kelas' || $request->jenis_guru === 'Guru Mata Pelajaran') ? 'required': 'nullable',
            'id_mapel' => ($request->jenis_guru === 'Guru Mata Pelajaran') ? 'required|integer': 'nullable',
        ]);

        //cek error atau tidak inputan data
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        //proses menyimpan data yg diinput
        $user = new KelolaUser;
        $guru = new Guru;
        $user->nama = $request->nama_guru; // Menggunakan nama guru untuk kolom nama
        $user->username = $request->username;
        $user->password = bcrypt($request->password); 
        $user->role = 'guru';
        $user->save();
        
        $guru->nip = $request->nip;
        $guru->nama_guru = $request->nama_guru;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->jenis_guru = $request->jenis_guru;
        $guru->id_kelas = $request->id_kelas;

        $guru->id_mapel = $request->id_mapel;
        $guru->jabatan = $request->jabatan;
        $guru->user_id = $user->id;
        $guru->created_at = now();
        $guru->save();

        $user->id_guru = $guru->id;
        $user->save();

        return new GuruResource(true, 'Data Guru Berhasil diinput',$guru);              
    }

    public function update(Request $request, $id)
    {
        //proses input pegawai
        $validator = Validator::make($request->all(),[
            'nip' => 'nullable|min:19|max:19',
            'nama_guru' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'jenis_guru' => 'required',
            'jabatan' => 'nullable',
            'id_kelas' => ($request->jenis_guru === 'Guru Kelas' || $request->jenis_guru === 'Guru Mata Pelajaran') ? 'required': 'nullable',
            'id_mapel' => ($request->jenis_guru === 'Guru Mata Pelajaran') ? 'required|integer': 'nullable',
        ]);

        //cek error atau tidak inputan data
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        //proses menyimpan data yg diinput
        $guru = Guru::whereId($id)->update(
            [
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_mapel' => $request->id_mapel,
                'id_kelas' => $request->id_kelas,
                'alamat' => $request->alamat,
                'jenis_guru' => $request->jenis_guru,
                'kontak' => $request->kontak,
                'jabatan' => $request->jabatan,
            ]
        );

        return new GuruResource(true, 'Data Guru Berhasil Diubah',$guru);              
    }

    public function destroy($id){
        $guru = Guru::whereId($id)->first();
        $guru->delete();

        return new GuruResource(true, 'Data Guru Berhasil Dihapus',$guru);
    }


}
