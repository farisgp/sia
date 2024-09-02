<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Nilai;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;


class NilaiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    // public function collection()
    // {
        // $ar_nilai = DB::table('nilai')
        //     ->join('kelas', 'kelas.id', '=', 'nilai.id_kelas')
        //     ->join('siswa', 'siswa.id', '=', 'nilai.id_siswa')
        //     ->join('mata_pelajaran', 'mata_pelajaran.id', '=', 'nilai.id_mapel')
        //     ->select(
        //         'nilai.lm1',
        //         'nilai.lm2',
        //         'nilai.lm3',
        //         'nilai.lm4',
        //         'nilai.lm5',
        //         'nilai.lm6',
        //         'nilai.rata_rata_lm',
        //         'nilai.tes',
        //         'nilai.non_tes',
        //         'nilai.rata_rata_sas',
        //         'nilai.nilai_akhir',
        //         'kelas.tingkat_kelas AS kelas',
        //         'siswa.nama_siswa AS siswa',
        //         'mata_pelajaran.nama_mapel AS mata_pelajaran',
        //     )
        //     ->get();
        // return $ar_nilai;
    // }

    protected $nilai;
    // protected $mata_pelajaran;

    public function __construct(array $data)
    {
        $this->nilai = $data['nilai'];
        // $this->nilai = $data['mata_pelajaran'];
    }

    public function collection()
    {
        $no = 1;
        $rows = [];

        foreach ($this->nilai as $item) {
            $row = [
                'No' => $no++,
                'MATA PELAJARAN' => $item->mata_pelajaran->nama_mapel,
                'LM 1' => $item->lm1,
                'LM 2' => $item->lm2,
                'LM 3' => $item->lm3,
                'LM 4' => $item->lm4,
                'LM 5' => $item->lm5,
                'LM 6' => $item->lm6,
                'Rata Rata Sumatif Lingkup Materi' => ($item->lm1 + $item->lm2 + $item->lm3 + $item->lm4 + $item->lm5 + $item->lm6) / 6,
                'Tes' => $item->tes,
                'Non Tes' => $item->non_tes,
                'Rata Rata Sumatif Akhir Semester' => ($item->tes + $item->non_tes) / 2,
                'Nilai Akhir Semester (NA)' => (($item->lm1 + $item->lm2 + $item->lm3 + $item->lm4 + $item->lm5 + $item->lm6) / 6 + ($item->tes + $item->non_tes) / 2) / 2,
            ];

            // Add the row to the rows array
            $rows[] = $row;
        }

        return collect($rows);
    }


    public function headings(): array
    {
        return [
            'No', 'Mata Pelajaran', 'LM 1', 'LM 2', 'LM 3', 'LM 4', 'LM 5', 'LM 6',
            'Rata-Rata LM', 'Tes', 'Non Tes', 'Rata-Rata SAS', 'Nilai Akhir'
        ];
    }
}
