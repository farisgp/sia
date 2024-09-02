<?php

namespace App\Repositories;

use App\Models\ClassType;
use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Guru;
use App\Models\Section;
use App\Models\MataPelajaran;

class KelasRepo
{
    public function getNilai($data)
    {
        $query = Nilai::where($data);
        $sql = $query->toSql(); 
        return $query->get();
    }

    public function all()
    {
        return Kelas::orderBy('tingkat_kelas', 'asc')->get();
    }

    public function getMC($data)
    {
        return Kelas::where($data)->get();
    }

    /************* Class *******************/


    public function getAllClass()
    {
        return Kelas::orderBy('tingkat_kelas', 'asc')->with([ 'guru'])->get();
    }
    public function getClassesByIds($ids)
    {
        return Kelas::whereIn('id_kelas', $ids)->get();
    }

    /************* Subject *******************/


    public function findSubjectByClass( $order_by = 'nama_mapel')
    {
        return $this->getSubject([])->orderBy($order_by)->get();
    }

    public function findSubjectByTeacher($id_mapel, $order_by = 'nama_mapel')
    {
        return MataPelajaran::where('id', $id_mapel)->firstOrFail();
    }

    
    public function getSubject($data)
    {
        return MataPelajaran::where($data);
    }
    
    public function getAllSubjects()
    {
        return MataPelajaran::orderBy('nama_mapel', 'asc')->with(['guru'])->get();
    }

}