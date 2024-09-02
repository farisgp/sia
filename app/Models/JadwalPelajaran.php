<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalPelajaran extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pelajaran';
    protected $fillable = ['id','id_kelas', 'id_mata_pelajaran', 'id_guru'];

    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function mata_pelajaran() 
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mata_pelajaran');
    }

}
