<?php

namespace App\Repositories;

use App\Helpers\Qs;
use App\Models\Dorm;
use App\Models\Promotion;
use App\Models\GuruPromotion;
use App\Models\Siswa;
use App\Models\Guru;

class SiswaRepo {

    public function getSiswa($data)
    {
        return Siswa::where($data)->get();

        // Siswa::where('user_id', $data['user_id']);
        // $sql = $query->toSql(); 
        // return $query->get();
    }
    public function getGuru($data)
    {
        return Guru::where($data)->get();

        // Siswa::where('user_id', $data['user_id']);
        // $sql = $query->toSql(); 
        // return $query->get();
    }

    public function activeStudents()
    {
        return Siswa::where(['status' => 0]);
    }
    public function activeGuru()
    {
        return Guru::where(['status' => 0]);
    }
    public function getAnotherRecordGuru()
    {
        return $this->activeGuru()->with('kelola');
    }
    public function retiredTeacher()
    {
        return Guru::where(['status' => 1])->orderByDesc('tahun_pemberhentian');
    }

    public function allRetiredTeacher()
    {
        return $this->retiredTeacher()->with(['kelola'])->get()->sortBy('kelola.nama');
    }
    public function gradStudents()
    {
        return Siswa::where(['status' => 1])->orderByDesc('tahun_lulus');
    }

    public function allGradStudents()
    {
        return $this->gradStudents()->with(['kelas', 'kelola'])->get()->sortBy('kelola.nama');
    }

    public function createRecord($data)
    {
        return Siswa::create($data);
    }

    public function updateRecord($id, array $data)
    {
        return Siswa::find($id)->update($data);
    }
    public function updateRecordGuru($id, array $data)
    {
        return Guru::find($id)->update($data);
    }

    public function update(array $where, array $data)
    {
        return Siswa::where($where)->update($data);
    }

    public function getRecord(array $data)
    {
        return $this->activeStudents()->where($data)->with('kelola');
    }
    public function getRecordGuru(array $data)
    {
        return Guru::where($data)->with('kelola');
    }
    // public function getAnotherRecordGuru()
    // {
    //     return Guru::with('kelola')->get();
    // }

    public function getRecordByUserIDs($ids)
    {
        return $this->activeStudents()->whereIn('user_id', $ids)->with('user');
    }

    public function findByUserId($st_id)
    {
        return $this->getRecord(['user_id' => $st_id]);
    }

    public function getAll()
    {
        return $this->activeStudents()->with('user');
    }

    public function getGradRecord($data=[])
    {
        return $this->gradStudents()->where($data)->with('user');
    }

    public function exists($id_siswa)
    {
        return $this->getRecord(['user_id' => $id_siswa])->exists();
    }

    /************* Promotions *************/
    public function createPromotion(array $data)
    {
        return Promotion::create($data);
    }
    public function createGuruPromotion(array $data)
    {
        return GuruPromotion::create($data);
    }

    public function findPromotion($id)
    {
        return Promotion::find($id);
    }

    public function deletePromotion($id)
    {
        return Promotion::destroy($id);
    }

    public function getPromotions(array $where)
    {
        return Promotion::where($where)->get();
    }

}
