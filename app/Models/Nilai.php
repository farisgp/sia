<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    protected $table = 'nilai';
    protected $fillable = ['id', 'id_guru', 'id_kelas', 'id_siswa', 'id_mapel', 'lm1',
    'lm2', 'lm3', 'lm4', 'lm5', 'lm6', 'rata_rata_lm', 'tes', 'non_tes', 'rata_rata_sas', 'nilai_akhir'];


    public function guru() 
    {
        return $this->belongsTo(Guru::class);
    }

    public function kelas() 
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mata_pelajaran() 
    {
        return $this->belongsTo(MataPelajaran::class, 'id_mapel');
    }

    public function siswa() 
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
