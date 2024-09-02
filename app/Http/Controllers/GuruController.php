<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use Hashids\Hashids;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use App\Http\Requests\GuruRequest;
use App\Repositories\SiswaRepo;
use App\Models\Kelas;
use App\Models\Agama;
use App\Models\Siswa;
use App\Models\MataPelajaran;
use App\Models\JadwalPelajaran;
use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\User;
use App\Models\KelolaUser;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

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
    protected $guru;

    public function __construct(SiswaRepo $siswa)
    {
        $this->guru = $siswa;

       // $this->middleware('teamSAT', ['except' => ['show', 'year_selected', 'year_selector', 'print_view'] ]);
    }
    public function index()
    {
        // $id_guru = Auth::id();
        // $nilai = Nilai::where('id_kelas', $id_kelas) ->where('id_guru', $id_guru) ->get();
        $ar_kelas = Kelas::all();
        $ar_mapel = MataPelajaran::all();    
        $guru = Guru::where(['status' => 0])->orderBy('id', 'ASC')->get();

        return view('kelola_guru.data_guru', compact('guru', 'ar_kelas', 'ar_mapel'));
    }
    public function index_guru()
    {
        // $id_guru = Auth::id();
        // $nilai = Nilai::where('id_kelas', $id_kelas) ->where('id_guru', $id_guru) ->get();
        $ar_kelas = Kelas::all();
        $ar_mapel = MataPelajaran::all();    
        $guru = Guru::orderBy('id', 'DESC')->get();
        return view('kelola_guru.kepsek_data_guru', compact('guru', 'ar_kelas', 'ar_mapel'));
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
    public function tugas_guru()
    {
        $d['guru'] = $sts = $this->guru->getAnotherRecordGuru()->get();
        return view('kelola_guru.tugas_guru', $d);
    }
    public function tugas_guru_selector()
    {
        return redirect()->route('guru.tugas_guru');
    }
    public function lihat_guru_keluar()
    {
        $data['guru'] = $this->guru->allRetiredTeacher();

        return view('kelola_guru.lihat_guru_keluar', $data);
    }
    public function tugas_guru_promote(Request $req)
    {
        $oy = Qs::getSetting('tahun_ajaran'); $d = [];
        for ($y = date('Y'); $y <= date('Y', strtotime('+ 1 years')); $y++) {
            $tahun_ajaran = (++$y).'-'.++$y;
            $semester = 'Ganjil';
            $ny = $semester.'-'.$tahun_ajaran;
        }
        $guru = $this->guru->getAnotherRecordGuru()->get()->sortBy('kelola.nama');

        if($guru->count() < 1){
            return redirect()->route('guru.tugas_guru')->with('error', 'Tidak Ada Siswa');
        }
        foreach($guru as $st){
            $p = 'p-'.$st->id;
            $p = $req->$p;
            if($p === 'DB'){ // Retaired
                // $d['status'] = 1;
                // $d['id_kelas'] = [];
                // $d['id_mapel'] = null;
                $d['status'] = 1;
                $d['tahun_pemberhentian'] = $oy;
            }
            if($p === 'B'){ // Not Retaired
                $d['status'] = 0;
            }
            $this->guru->updateRecordGuru($st->id, $d);
//            Insert New Promotion Data
            $promote['id_guru'] = $st->id;
            $promote['tahun_pemberhentian'] = $oy;
            $promote['status'] = $p;

            $this->guru->createGuruPromotion($promote);
        }
        return redirect()->route('guru.tugas_guru')->with('success', 'Tugas Guru Berhasil Diperbarui');
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
    public function jadwalPelajaran(Guru $guru)
    {
        // Ambil id_kelas dari guru
        $id_kelas_guru = $guru->id_kelas;

        // Ambil jadwal pelajaran sesuai dengan id_kelas guru
        $jadwal_pelajaran = \App\Models\JadwalPelajaran::where('id_kelas', $id_kelas_guru)->get();

        return view('guru.jadwal_pelajaran', compact('jadwal_pelajaran'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
            'nip' => 'nullable|unique:guru|min:19|max:19',
            'nama_guru' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'jenis_guru' => 'required',
            'jabatan' => 'nullable',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
            'username' => 'required',
            'password' => 'required',
            'id_kelas' => ($request->jenis_guru === 'Guru Kelas' || $request->jenis_guru === 'Guru Mata Pelajaran') ? 'required|array': 'nullable',
            'id_mapel' => ($request->jenis_guru === 'Guru Mata Pelajaran') ? 'required|integer': 'nullable',
            ],
            [
            'nama_guru.required' => 'Nama Wajib Diisi',
            'nama_guru.min' => 'Nama Wajib Diisi Minimal 3 Karakter',
            'nip.required' => 'NIP Wajib Diisi',
            'nip.min' => 'NIP Minimal 19 karakter',
            'nip.max' => 'NIP Maximal 19 karakter',
            'nip.unique' => 'NIP Sudah Ada (Terduplikasi)',
            'jenis_kelamin.required' => 'Jenis Kelamin Wajib Diisi',
            'id_kelas.required' => 'Wajib Mengisi Kelas Yang Diampu',
            'id_mapel.integer' => 'Wajib Mengisi Mata Pelajaran Yang Diampu',
            'jenis_guru.required' => 'Wajib Mengisi Jenis Guru',
            'jabatan.required' => 'Wajib Mengisi Pangkat/Gol. Ruang',
            'username' => 'Username Wajib Diisi',
            'password' => 'Password Wajib Diisi',
            ]
        );
        if(!empty($request->foto)){
            $fileName = 'foto-'.$request->nip.'.'.$request->foto->extension();
            $fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('admin/img'),$fileName);
        }
        else{
            $fileName = '';
        }

        $user = new KelolaUser;
        $guru = new Guru;

        $user->nama = $request->nama_guru; // Menggunakan nama guru untuk kolom nama
        $user->username = $request->username;
        $user->password = bcrypt($request->password); 
        $user->role = 'guru';
        $user->save();

        $guru->nama_guru = $request->nama_guru;  
        $guru->nip = $request->nip;
        $guru->jenis_kelamin = $request->jenis_kelamin;
        $guru->jenis_guru = $request->jenis_guru;

        $idKelasArray = $request->id_kelas ? array_map('intval', $request->id_kelas) : [];
        $idKelasString = json_encode($idKelasArray);
        $guru->id_kelas = $idKelasString;

        $guru->id_mapel = $request->id_mapel;
        $guru->alamat = $request->alamat;
        $guru->kontak = $request->kontak;
        $guru->jabatan = $request->jabatan;
        $guru->user_id = $user->id;
        $guru->foto=$fileName;
        $guru->created_at = now();
        $guru->save();

        $user->id_guru = $guru->id;
        $user->save();
        return redirect()->back()
            ->with('success', 'Data Guru Berhasil Disimpan');
    }
    // public function getKelas(Request $request){

    // }
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
        return view('kelola_guru.detail', compact('row'));
    }
    public function detail($sr_id)
    {
        $date = date('dMY').'CJ';
        $hashids = new Hashids($date, 14);
        $sr_id = $hashids->decode($sr_id);
        // dd($sr_id);
        $data['guru'] = $this->guru->getRecordGuru(['id' => $sr_id])->first();

        return view('profil.profil_guru', $data);
    }
    public function generatePDFGuru()
    {

        $guru = Guru::all();
        $pdf = Pdf::loadView('kelola_guru.download-pdf', ['guru' => $guru])->setPaper('a4', 'landscape');
        return $pdf->download('DaftarGuruSDN02Sijeruk.pdf');
    }
    public function generateExcelGuru($id_siswa, $year)
    {

        if(!$this->verifyStudentNilaiYear($id_siswa, $year)){
            return $this->noStudentRecord();
        }
        $date = date('dMY').'CJ';
        $hashids = new Hashids($date, 14);
        $id_siswa = $hashids->decode($id_siswa);
        // dd($id_siswa);

        $wh = ['id_siswa' => $id_siswa, 'tahun_ajaran' => $year ];
        // dd($wh);
        $nilai = $this->nilai->getNilai($wh);
        $d['nilai_records'] = $exr = $this->nilai->getRecord($wh);
        // $d['exams'] = $this->exam->getExam(['year' => $year]);
        $d['sr'] = $sis = $this->siswa->getRecord(['user_id' => $id_siswa])->first();
        $d['kelas'] = $mc = $this->kelas->getMC(['id' => $exr->first()->id_kelas])->first();
        $d['mata_pelajaran'] = $this->kelas->getAllSubjects();            
        $d['tahun_ajaran'] = $year;
        $d['id_siswa'] = $id_siswa;
        $data = [
            'mata_pelajaran' => $d['mata_pelajaran']->pluck('id')->toArray(),
            'id_siswa' => $id_siswa,
            'tahun_ajaran' => $year,
            'nilai' => $d['nilai_records'],
            'id_kelas' => $d['kelas']->id,
        ];
        $nama_file = 'Rekap_Nilai_' . $sis->nama_siswa . '_' . $mc->tingkat_kelas . '_' . $year . '.xlsx';
        
        return Excel::download(new NilaiExport($data), $nama_file);
    }
    public function showJadwalGuru($guruId)
    {
        $guruId = auth()->user()->id_guru;
        $guru = Guru::findOrFail($guruId);
        $classId = json_decode($guru->id_kelas);

        if ($guru->jenis_guru === 'Guru Mata Pelajaran') {
            $idMapel = $guru->id_mapel;

            $row = JadwalPelajaran::where('id_mata_pelajaran', $idMapel)->get();
        } else {
            $row = JadwalPelajaran::whereIn('id_kelas', $classId)->get();
        }

        // dd($row);

        return view('jadwal.jadwal_siswa', compact('row'));;
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
            'nip' => 'nullable|min:8',
            'nama_guru' => 'required|min:3',
            'jenis_kelamin' => 'required',
            'id_kelas' => ($request->jenis_guru === 'Guru Kelas' || $request->jenis_guru === 'Guru Mata Pelajaran') ? 'required|array': 'nullable',
            'id_mapel' => ($request->jenis_guru === 'Guru Mata Pelajaran') ? 'required|integer': 'nullable',
            'alamat' => 'nullable|max:255',
            'kontak' => 'nullable',
            'jabatan' => 'nullable',
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
            $fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('admin/img'),$fileName);
        }
        //------------tidak berniat ganti ganti foto lama-----------
        else{
            $fileName = $namaFileFotoLama;
        }

        // $guru = new Guru;

        // $guru->nama_guru = $request->nama_guru;  
        // $guru->nip = $request->nip;
        // $guru->jenis_kelamin = $request->jenis_kelamin;
        // $guru->jenis_guru = $request->jenis_guru;

        // $idKelasArray = $request->id_kelas ? array_map('intval', $request->id_kelas) : [];
        // $idKelasString = json_encode($idKelasArray);
        // $guru->id_kelas = $idKelasString;

        // $guru->id_mapel = $request->id_mapel;
        // $guru->kontak = $request->kontak;
        // $guru->jabatan = $request->jabatan;
        // $guru->foto=$fileName;
        // $guru->created_at = now();
        // $guru->save();

        // $user->id_guru = $guru->id;
        // $user->save();
        $idKelasArray = $request->id_kelas ? array_map('intval', $request->id_kelas) : [];
        $idKelasString = json_encode($idKelasArray);

        DB::table('guru')->where('id', $id)->update(
            [
                'nip' => $request->nip,
                'nama_guru' => $request->nama_guru,
                'jenis_kelamin' => $request->jenis_kelamin,
                'id_mapel' => $request->id_mapel,
                'id_kelas' => $idKelasString,
                'alamat' => $request->alamat,
                'jenis_guru' => $request->jenis_guru,
                'kontak' => $request->kontak,
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
