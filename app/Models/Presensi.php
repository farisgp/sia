<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presensi extends Model
{
    use HasFactory;
    protected $table = 'presensi';
    protected $fillable = ['id_kelas', 'id_siswa', 'tanggal_presensi', 'status_presensi', 'keterangan'];

    public function kelas() 
    {
        return $this->belongsTo(Kelas::class);
    }
    public function guru() 
    {
        return $this->belongsTo(Guru::class);
    }
    public function siswa() 
    {
        return $this->belongsTo(Siswa::class);
    }
}
