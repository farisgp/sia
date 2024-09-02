<?php

namespace App\Http\Controllers;

use App\Helpers\Qs;
use Hashids\Hashids;
use Illuminate\Http\Request;
use App\Http\Requests\NilaiSelector;
use App\Models\Siswa;
use App\Models\Guru;
use App\Models\Setting;
use App\Models\MataPelajaran;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Repositories\KelasRepo;
use App\Repositories\MapelRepo;
use App\Repositories\SiswaRepo;
use App\Repositories\NilaiRepo;
use Illuminate\Support\Facades\Auth;
use App\Exports\NilaiExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use DB;
use PDF;


class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $mata_pelajaran, $kelas, $year, $siswa, $nilai;

    public function __construct(KelasRepo $kelas, SiswaRepo $siswa, NilaiRepo $nilai)
    {
        $this->kelas =  $kelas;
        $this->siswa = $siswa;
        $this->nilai = $nilai;
        // $this->mata_pelajaran =  $mata_pelajaran;
        $this->year =  Qs::getSetting('tahun_ajaran');

       // $this->middleware('teamSAT', ['except' => ['show', 'year_selected', 'year_selector', 'print_view'] ]);
    }
    public function index()
    {
        // $d['exams'] = $this->exam->getExam(['year' => $this->year]);
        $d['kelas'] = $this->kelas->getAllClass();
        $d['mata_pelajaran'] = $this->kelas->getAllSubjects();
        $d['selected'] = false;

        return view('kelola_nilai.index', $d);
    }
    public function generatePDF($id_siswa, $year)
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
        $d['nilai'] = $this->nilai->getNilai($wh);
        $d['nilai_records'] = $exr = $this->nilai->getRecord($wh);
        // $d['exams'] = $this->exam->getExam(['year' => $year]);
        $d['sr'] = $sis = $this->siswa->getRecord(['user_id' => $id_siswa])->first();
        $d['kelas'] = $mc = $this->kelas->getMC(['id' => $exr->first()->id_kelas])->first();
        $d['mata_pelajaran'] = $this->kelas->getAllSubjects();
        // if (auth()->user()->guru->jenis_guru == 'Guru Mata Pelajaran') {
        //     $id_mapel = auth()->user()->guru->id_mapel;
        //     $mata_pelajaran = $this->kelas->findSubjectByTeacher($id_mapel);
        // }             
        $d['tahun_ajaran'] = $year;
        $d['id_siswa'] = $id_siswa;
        $nama_file = 'Rekap_Nilai_' . $sis->nama_siswa . '_' . $mc->tingkat_kelas . '_' . $year . '.pdf';
        $pdf = Pdf::loadView('kelola_nilai.download-pdf', $d);
        // dd($d);
        return $pdf->download($nama_file);
    }
    public function generateExcel($id_siswa, $year)
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
    
    public function tesPDF()
    {
        $nilai = Siswa::all();
        $pdf = Pdf::loadView('kelola_siswa.data_siswa', ['nilai' => $stakeholder]);
        return $pdf->download('data_stakeholder.pdf');
    }

    public function year_selector($id_siswa)
    {
       return $this->verifyStudentNilaiYear($id_siswa);
    }

    public function year_selected(Request $req, $id_siswa)
    {

        if(!$this->verifyStudentNilaiYear($id_siswa, $req->year)){
            return $this->noStudentRecord();
        }
        
        return redirect()->route('nilai.show', [$id_siswa, $req->year]);
        // dd($id_siswa);

    }
 
    public function show($id_siswa, $year)
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
        $d['nilai'] = $this->nilai->getNilai($wh);
        $d['nilai_records'] = $exr = $this->nilai->getRecord($wh);
        // $d['exams'] = $this->exam->getExam(['year' => $year]);
        $d['sr'] = $this->siswa->getRecord(['user_id' => $id_siswa])->first();
        $d['kelas'] = $mc = $this->kelas->getMC(['id' => $exr->first()->id_kelas])->first();
        $d['mata_pelajaran'] = $this->kelas->getAllSubjects();
        // if (auth()->user()->guru->jenis_guru == 'Guru Mata Pelajaran') {
        //     $id_mapel = auth()->user()->guru->id_mapel;
        //     $mata_pelajaran = $this->kelas->findSubjectByTeacher($id_mapel);
        // }             
        $d['tahun_ajaran'] = $year;
        $d['id_siswa'] = $id_siswa;
        // dd($d);
        return view('kelola_nilai.lembar_nilai', $d);
    }
    protected function verifyStudentNilaiYear($id_siswa, $year = null)
    {
        $date = date('dMY').'CJ';
        $hashids = new Hashids($date, 14);
        $id_siswa = $hashids->decode($id_siswa);
        // $id_siswa = implode("", $id_siswa_array);

        // dd($id_siswa);
        $years = $this->nilai->getNilaiYears($id_siswa);
        $student_exists = $this->siswa->exists($id_siswa);
        // dd($years);
        if(!$year){
            if($student_exists && $years->count() > 0)
            {
                $d = ['years' => $years, 'id_siswa' => Qs::hash($id_siswa)];
                return view('kelola_nilai.select_year', $d);
            }
            return $this->noStudentRecord();
        }

        return ($student_exists && $years->contains('tahun_ajaran', $year)) ? true : false;
    }
    public function selector(NilaiSelector $req)
    {
        $data = $req->only(['id_kelas', 'id_mapel']);
        $d = $req->only(['id_kelas']);
        $d['tahun_ajaran'] = $data['tahun_ajaran'] = $this->year;

        $siswa = $this->siswa->getRecord($d)->get();
        // if($siswa->count() < 1){
        //     return back()->with('eror', 'Tidak Ada Data Siswa');
        // }

        foreach ($siswa as $s){ 
            $data['id_siswa'] = $d2['id_siswa'] = $s->user_id;
            $this->nilai->createNilai($data);
            // $this->nilai->createRecord($d2);
        }
        // dd($d);
        return redirect()->route('nilai.manage', [$req->id_kelas, $req->id_mapel]);
    }
    public function manage($kelas_id, $mapel_id)
    {
        // dd($id_kelas, $id_mapel, $this->year);
        // Membuat array data pencarian
        $d = [
            'id_kelas' => $kelas_id,
            'id_mapel' => $mapel_id,
            'tahun_ajaran' => $this->year
        ];

        // Mendapatkan nilai berdasarkan data pencarian
        $d['nilai'] = $this->nilai->getNilai($d);

        // Mendapatkan nilai pertama dari data nilai
        $d['m'] = $d['nilai']->first();

        // Mendapatkan kelas berdasarkan id kelas yang dimiliki oleh guru
        $d['kelas'] = $this->kelas->getAllClass();

        // Mendapatkan semua mata pelajaran
        $d['mata_pelajaran'] = $this->kelas->getAllSubjects();

        // Menambahkan flag 'selected'
        $d['selected'] = true;
        // dd($d);
        // Mengirimkan data ke view
        return view('kelola_nilai.nilai-manage', $d);

    }
    protected function noStudentRecord(): RedirectResponse
    {
        // return redirect()->route('dashboard')->with('flash_danger', __('msg.srnf'));
        return back()->with('error', 'Tidak Ada Data Nilai Siswa');
    }
    public function getSiswaByKelas($kelas)
    {
        $siswa = Siswa::where('kelas', $kelas)->get();

        return response()->json($siswa);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return ;
    }

    public function store(Request $request)
    {
        return ;
    }   

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Request $request)
    // {
    //     return
    // }


    /**
     * Display the specified resource.
     */
    

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
    public function bulk_select(Request $req)
    {
        return redirect()->route('nilai.bulk', [$req->id_kelas]);
    }
    public function bulk($kelas_id = NULL)
    {
        $d['kelas'] = $this->kelas->all();
        $d['selected'] = false;

        if($kelas_id){
            $d['kelas'] = $this->kelas->getAllClass()->where('id_kelas', $kelas_id);
            $d['siswa'] = $st = $this->siswa->getRecord(['id_kelas' => $kelas_id])->get()->sortBy('kelola.nama');
            if($st->count() < 1){
                return redirect()->route('nilai.bulk')->with('eror', 'Data Siswa Tidak Ditemukan');
            }
            $d['selected'] = true;
            $d['id_kelas'] = $kelas_id;
        }
        // dd($d);

        return view('kelola_nilai.nilai_bulk', $d);
    }
    public function update(Request $req, $id_kelas, $id_mapel)
    {
        $p = ['id_kelas' => $id_kelas, 'id_mapel' => $id_mapel, 'tahun_ajaran' => $this->year];

        $d = $d3 = $all_st_ids = [];

        // $nilai = $this->nilai->find($id);
        $nilai = $this->nilai->getNilai($p);
        // $class_type = $this->my_class->findTypeByClass($class_id);

        $mks = $req->all();

        /** Test, Exam, Grade **/
        foreach($nilai->sortBy('kelola.nama') as $mk)
        {
             $all_st_ids[] = $mk->id_siswa;

            // Inisialisasi semua variabel menjadi null
            $lm1 = $lm2 = $lm3 = $lm4 = $lm5 = $lm6 = null;

            // Set nilai variabel hanya jika kunci ada dalam array $mks
            $lm1 = isset($mks['lm1_'.$mk->id]) ? $mks['lm1_'.$mk->id] : null;
            $lm2 = isset($mks['lm2_'.$mk->id]) ? $mks['lm2_'.$mk->id] : null;
            $lm3 = isset($mks['lm3_'.$mk->id]) ? $mks['lm3_'.$mk->id] : null;
            $lm4 = isset($mks['lm4_'.$mk->id]) ? $mks['lm4_'.$mk->id] : null;
            $lm5 = isset($mks['lm5_'.$mk->id]) ? $mks['lm5_'.$mk->id] : null;
            $lm6 = isset($mks['lm6_'.$mk->id]) ? $mks['lm6_'.$mk->id] : null;

            // Hitung rata-rata hanya untuk nilai yang ada
            $total_lm = 0;
            $count_lm = 0;

            // Total nilai hanya jika nilai tidak null
            if ($lm1 !== null) { $total_lm += $lm1; $count_lm++; }
            if ($lm2 !== null) { $total_lm += $lm2; $count_lm++; }
            if ($lm3 !== null) { $total_lm += $lm3; $count_lm++; }
            if ($lm4 !== null) { $total_lm += $lm4; $count_lm++; }
            if ($lm5 !== null) { $total_lm += $lm5; $count_lm++; }
            if ($lm6 !== null) { $total_lm += $lm6; $count_lm++; }

            // Hitung rata-rata hanya jika ada nilai yang tidak null
            $rata_lm = $count_lm > 0 ? $total_lm / $count_lm : null;

            // Ambil nilai tes dan non-tes, jika tidak ada, atur ke 0
            $tes = isset($mks['tes_'.$mk->id]) ? $mks['tes_'.$mk->id] : null;
            $nontes = isset($mks['non_tes_'.$mk->id]) ? $mks['non_tes_'.$mk->id] : null;

            // Hitung rata-rata nilai tes dan non-tes
            $rata_sas = ($tes + $nontes) / 2;

            // Hitung nilai akhir jika semua nilai valid
            $na = ($rata_lm !== null && $rata_sas !== null) ? ($rata_lm + $rata_sas) / 2 : null;

            // Lakukan pembaruan nilai
            $d = [
                'lm1' => $lm1,
                'lm2' => $lm2,
                'lm3' => $lm3,
                'lm4' => $lm4,
                'lm5' => $lm5,
                'lm6' => $lm6,
                'rata_lm' => $rata_lm,
                'tes' => $tes,
                'non_tes' => $nontes,
                'rata_sas' => $rata_sas,
                'na' => $na
            ];

            $this->nilai->updateNilai($mk->id, $d);
        }
        return back()->with('success', 'Nilai Siswa Berhasil Di Simpan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
