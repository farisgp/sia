<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pelajaran';

    protected $fillable = ['id', 'id_kelas', 'id_mata_pelajaran', 'id_guru',
                        'hari', 'jam_mulai', 'jam_selesai' ];
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id');
    }
    public function mata_pelajaran() 
    {
        return $this->belongsTo(MataPelajaran::class, 'id');
    }
}
