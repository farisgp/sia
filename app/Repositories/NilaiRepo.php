<?php

namespace App\Repositories;

use App\Models\Nilai;
use App\Models\ExamRecord;
use App\Models\Grade;
use App\Models\Kelas;
use App\Models\Mark;
use App\Models\Skill;

class NilaiRepo
{

    public function all()
    {
        return Nilai::orderBy('name', 'asc')->orderBy('year', 'desc')->get();
    }

    public function getExam($data)
    {
        return Nilai::where($data)->get();
    }

    public function find($id)
    {
        return Nilai::find($id);
    }

    public function create($data)
    {
        return Nilai::create($data);
    }

    public function createRecord($data)
    {
        return Nilai::firstOrCreate($data);
    }

    public function update($id, $data)
    {
        return Nilai::find($id)->update($data);
    }

    public function updateRecord($where, $data)
    {
        return Nilai::where($where)->update($data);
    }

    public function getRecord($data)
    {
        return Nilai::where($data)->get();
    }
    public function findRecord($id)
    {
        return NilaiRecord::find($id);
    }

    public function delete($id)
    {
        return Nilai::destroy($id);
    }

    /*********** Nilai ***************/

    public function createNilai($data)
    {
        return Nilai::firstOrCreate($data);
    }

    public function destroyNilai($id)
    {
        return Nilai::destroy($id);
    }

    public function getSubPos($st_id, $id_mapel, $id_kelas, $year)
    {
        $d = [ 'id_kelas' => $id_kelas, 'id_mapel' => $id_mapel, 'year' => $year];
        $tex = 'tex'.$id_mapel->term;

        $sub_mk = $this->getSubjectMark($id_mapel, $id_kelas, $st_id, $year);

        $sub_mks = Nilai::where($d)->whereNotNull($tex)->orderBy($tex, 'DESC')->select($tex)->get()->pluck($tex);
        return $sub_pos = $sub_mks->count() > 0 ? $sub_mks->search($sub_mk) + 1 : NULL;
    }
    public function getSubjectMark($id_mapel, $id_kelas, $st_id, $year)
    {
        $d = [ 'id_kelas' => $id_kelas, 'id_mapel' => $id_mapel, 'id_siswa' => $st_id, 'year' => $year ];
        $tex = 'tex'.$exam->term;

        return Nilai::where($d)->select($tex)->get()->first()->$tex;
    }
    public function updateNilai($id, $data)
    {
        return Nilai::find($id)->update($data);
    }

    public function getNilaiYears($id_siswa)
    {
        // return Nilai::where('id_siswa', $id_siswa)->get();
        return Nilai::where('id_siswa', $id_siswa)->select('tahun_ajaran')->distinct()->get();
    }

    public function getNilai($data)
    {
        return Nilai::where($data)->with('kelola')->get();

    }
    public function getKelas($data)
    {
        return Kelas::where($data)->with('siswa')->get();
    }

}
