<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Hashids\Hashids;
use App\Helpers\Qs;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Agama;
use App\Models\JadwalPelajaran;
use App\Models\KelolaUser;
use App\Models\Nilai;
use App\Http\Controllers\NilaiController;
use App\Repositories\SiswaRepo;
use App\Repositories\KelasRepo;
use DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;
Use Alert;


class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $kelas, $siswa;

    public function __construct(KelasRepo $kelas, SiswaRepo $siswa)
    {
        $this->siswa = $siswa;
        $this->kelas = $kelas;
    }
    
    public function index(Request $request)
    {
        $kelasId = $request->query('id_kelas');
        $kelas = Kelas::findOrFail($kelasId);
        $siswa = Siswa::where('id_kelas', $kelasId)->get();
        $siswa2 = Siswa::with('kelola')->get();
        // $siswas = Siswa::with('users')->get();

        return view('kelola_siswa.data_siswa', compact('siswa', 'kelas', 'siswa2'));
    }

    public function index_siswa(Request $request)
    {
        $kelasId = $request->query('id_kelas');
        $kelas = Kelas::findOrFail($kelasId);
        $siswa = Siswa::where('id_kelas', $kelasId)->get();
        $siswa2 = Siswa::with('kelola')->get();
        // $siswas = Siswa::with('users')->get();

        return view('kelola_siswa.guru_data_siswa', compact('siswa', 'kelas', 'siswa2'));
    }
    public function getSiswaByKelas($kelasId)
    {
        // Method ini akan mengambil daftar siswa berdasarkan kelas yang dipilih
        // Misalnya, jika Anda ingin mengambil siswa dari kelas dengan ID tertentu
        $siswa = Siswa::where('id_kelas', $kelasId)->get();

        // Kemudian kirimkan daftar siswa sebagai respons JSON
        return response()->json($siswa);
    }
    public function selector(Request $req)
    {
        return redirect()->route('siswa.promotion', [$req->kelas_lama, $req->kelas_baru]);
    }
    public function graduate_selector(Request $req)
    {
        return redirect()->route('siswa.graduate', [$req->kelas_lama]);
    }
    public function promotion($kelas_lama = NULL, $kelas_baru = NULL)
    {
        // $tahun_ajaran_list = [];
        $d['old_year'] = $old_yr = Qs::getSetting('tahun_ajaran');
        $d['kelas'] = $this->kelas->all();
        $d['selected'] = false;
        // Loop untuk menciptakan data tahun ajaran
        for ($y = date('Y'); $y <= date('Y', strtotime('+ 1 years')); $y++) {
            $tahun_ajaran = (++$y) . '-' . ++$y;
            $semester = 'Ganjil';
            $d['new_year'] = $semester.'-'.$tahun_ajaran;

        }
        
        // dd($d['kelas']);
        if($kelas_lama && $kelas_baru){
            $d['selected'] = true;
            $d['kelas_lama'] = $kelas_lama;
            $d['kelas_baru'] = $kelas_baru;
            $d['siswa'] = $sts = $this->siswa->getRecord(['id_kelas' => $kelas_lama, 'tahun_ajaran' => $d['old_year']])->get();

            if($sts->count() < 1){
                return redirect()->route('siswa.promotion')->with('error', 'Tidak Ada Data Siswa');
            }
        }

        return view('kelola_siswa.kenaikan.index', $d);
    }
    public function promote(Request $req, $kelas_lama, $kelas_baru)
    {
        $oy = Qs::getSetting('tahun_ajaran'); $d = [];
        for ($y = date('Y'); $y <= date('Y', strtotime('+ 1 years')); $y++) {
            $tahun_ajaran = (++$y).'-'.++$y;
            $semester = 'Ganjil';
            $ny = $semester.'-'.$tahun_ajaran;

        }
        $siswa = $this->siswa->getRecord(['id_kelas' => $kelas_lama, 'tahun_ajaran' => $oy ])->get()->sortBy('kelola.nama');

        if($siswa->count() < 1){
            return redirect()->route('siswa.promotion')->with('error', 'Tidak Ada Siswa');
        }

        foreach($siswa as $st){
            $p = 'p-'.$st->id;
            $p = $req->$p;
            if($p === 'P'){ // Promote
                $d['id_kelas'] = $kelas_baru;
                $d['tahun_ajaran'] = $ny;
            }
            if($p === 'D'){ // Don't Promote
                $d['id_kelas'] = $kelas_lama;
                $d['tahun_ajaran'] = $oy;
            }
            if($p === 'G'){ // Graduated
                $d['id_kelas'] = $kelas_lama;
                // $d['status'] = 1;
                $d['status'] = 1;
                $d['tahun_lulus'] = $oy;
            }

            $this->siswa->updateRecord($st->id, $d);

//            Insert New Promotion Data
            $promote['kelas_lama'] = $kelas_lama;
            $promote['grad'] = ($p === 'G') ? 1 : 0;
            $promote['kelas_baru'] = in_array($p, ['D', 'G']) ? $kelas_lama : $kelas_baru;
            $promote['id_siswa'] = $st->id;
            $promote['dari_tahun_ajaran'] = $oy;
            $promote['ke_tahun_ajaran'] = $ny;
            $promote['status'] = $p;

            $this->siswa->createPromotion($promote);
        }
        return redirect()->route('siswa.promotion')->with('success', 'Kenaikkan Siswa Berhasil Disimpan');
    }
    public function graduate($kelas_lama = NULL)
    {
        $d['old_year'] = $old_yr = Qs::getSetting('tahun_ajaran');
        $d['kelas'] = $this->kelas->all();
        $d['selected'] = false;
        // Loop untuk menciptakan data tahun ajaran
        for ($y = date('Y'); $y <= date('Y', strtotime('+ 1 years')); $y++) {
            $tahun_ajaran = (++$y) . '-' . ++$y;
            $semester = 'Ganjil';
            $d['new_year'] = $semester.'-'.$tahun_ajaran;
        }
        // dd($d['kelas']);
        if($kelas_lama){
            $d['selected'] = true;
            $d['kelas_lama'] = $kelas_lama;
            $d['siswa'] = $sts = $this->siswa->getRecord(['id_kelas' => $kelas_lama, 'tahun_ajaran' => $d['old_year']])->get();

            if($sts->count() < 1){
                return redirect()->route('siswa.graduate')->with('error', 'Tidak Ada Data Siswa');
            }
        }
        return view('kelola_siswa.kelulusan.index', $d);
    }
    public function siswa_graduated(Request $req, $kelas_lama)
    {
        $oy = Qs::getSetting('tahun_ajaran'); $d = [];
        for ($y = date('Y'); $y <= date('Y', strtotime('+ 1 years')); $y++) {
            $tahun_ajaran = (++$y).'-'.++$y;
            $semester = 'Ganjil';
            $ny = $semester.'-'.$tahun_ajaran;
        }
        $siswa = $this->siswa->getRecord(['id_kelas' => $kelas_lama, 'tahun_ajaran' => $oy ])->get()->sortBy('kelola.nama');

        if($siswa->count() < 1){
            return redirect()->route('siswa.graduate')->with('error', 'Tidak Ada Siswa');
        }
        foreach($siswa as $st){
            $p = 'p-'.$st->id;
            $p = $req->$p;
            if($p === 'G'){ // Graduated
                $d['id_kelas'] = $kelas_lama;
                // $d['status'] = 1;
                $d['status'] = 1;
                $d['tahun_lulus'] = $oy;
            }
            if($p === 'NG'){ // Not Graduated
                $d['id_kelas'] = $kelas_lama;
                // $d['status'] = 1;
                $d['status'] = 0;
            }
            $this->siswa->updateRecord($st->id, $d);
//            Insert New Promotion Data
            $promote['kelas_lama'] = $kelas_lama;
            $promote['grad'] = ($p === 'G') ? 1 : 0;
            $promote['kelas_baru'] = $kelas_lama;
            $promote['id_siswa'] = $st->id;
            $promote['dari_tahun_ajaran'] = $oy;
            $promote['ke_tahun_ajaran'] = $oy;
            $promote['status'] = $p;

            $this->siswa->createPromotion($promote);
        }
        return redirect()->route('siswa.graduate')->with('success', 'Kelulusan Siswa Berhasil Ditambahkan');
    }
    public function show_graduated()
    {
        $data['kelas'] = $this->kelas->all();
        $data['siswa'] = $this->siswa->allGradStudents();

        return view('kelola_siswa.kelulusan.graduate', $data);
    }
    public function kepsek_show_graduated()
    {
        $data['kelas'] = $this->kelas->all();
        $data['siswa'] = $this->siswa->allGradStudents();

        return view('kelola_siswa.kelulusan.kepsek_show_graduated', $data);
    }
    public function generatePDFKelulusanSiswa()
    {
        $data['kelas'] = $this->kelas->all();
        $data['siswa'] = $this->siswa->allGradStudents();
        $pdf = Pdf::loadView('kelola_siswa.kelulusan.download-pdf', $data);
        return $pdf->download('DaftarSiswaSDN02Sijeruk.pdf');
    }
    public function generatePDFSiswa()
    {
        $siswa = Siswa::with('kelas')->orderBy('id_kelas')->get();
        $pdf = Pdf::loadView('kelola_siswa.download-pdf', ['siswa' => $siswa])->setPaper('a4', 'landscape');
        return $pdf->download('DaftarSiswaSDN02Sijeruk.pdf');
    }
    public function generateExcelSiswa($id_siswa, $year)
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
            'username' => 'required',
            'password' => 'required',
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
            'username' => 'Username Wajib Diisi',
            'password' => 'Password Wajib Diisi',
        ]
        );
        if(!empty($request->foto)){
            $fileName = 'foto-'.$request->nis.'.'.$request->foto->extension();
            $fileName = $request->foto->getClientOriginalName();
            $request->foto->move(public_path('admin/img'),$fileName);
        }
        else{
            $fileName = '';
        }
        
        $user = new KelolaUser;
        $siswa = new Siswa;

        $user->nama = $request->nama_siswa; // Menggunakan nama siswa untuk kolom nama
        $user->username = $request->username;
        $user->password = bcrypt($request->password); // Enkripsi password jika diperlukan
        $user->role = 'siswa';
        $user->save();
        
        $siswa->nama_siswa = $request->nama_siswa;  
        $siswa->nis = $request->nis;
        $siswa->nisn = $request->nisn;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->tanggal_lahir = $request->tanggal_lahir;
        $siswa->id_kelas = $request->id_kelas;
        $siswa->alamat = $request->alamat;
        $siswa->kontak_ortu = $request->kontak_ortu;
        $siswa->id_agama = $request->id_agama;
        $siswa->user_id = $user->id;
        $siswa->foto=$fileName;
        $siswa->tahun_ajaran = Qs::getSetting('tahun_ajaran');
        $siswa->created_at = now();
        $siswa->save();

        $user->id_siswa = $siswa->id;
        $user->save();
        return redirect()->back()
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
        $row = Siswa::find($id);
        return view('kelola_siswa.detail', compact('row'));
    }
    public function detail($sr_id)
    {
        $date = date('dMY').'CJ';
        $hashids = new Hashids($date, 14);
        $sr_id = $hashids->decode($sr_id);
        // dd($sr_id);
        $data['sr'] = $this->siswa->getRecord(['id' => $sr_id])->first();

        return view('profil.profil_siswa', $data);
    }

    public function showJadwalSiswa($studentId)
    {
        $studentId = auth()->user()->id_siswa;
        $student = Siswa::findOrFail($studentId);
        $classId = $student->id_kelas;

        $row = JadwalPelajaran::where('id_kelas', $classId)->get();
        // dd($row);

        return view('jadwal.jadwal_siswa', compact('row'));;
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
            $fileName = 'foto-'.$request->nis.'.'.$request->foto->extension();
            $fileName = $request->foto->getClientOriginalName();
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

        return redirect()->back()
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
        // Siswa::where('id', $id)->delete();
        // return redirect()->back()
        //     ->with('success', 'Data Siswa Berhasil Dihapus');
        $siswa = Siswa::findOrFail($id);
        $user_id = $siswa->user_id; // Dapatkan ID user yang terkait dengan siswa

        $siswa->delete(); // Hapus entri siswa

        // Hapus juga entri user yang terkait
        KelolaUser::where('id', $user_id)->delete();

        return redirect()->back()->with('success', 'Data Siswa Berhasil Dihapus');
    }
}
