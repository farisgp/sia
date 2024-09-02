<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;
    protected $fillable = ['kelas_lama', 'kelas_baru', 'dari_tahun_ajaran', 'ke_tahun_ajaran', 'grad', 'id_siswa', 'status'];

    public function siswa()
    {
        return $this->belongsTo(Kelola::class, 'id_siswa');
    }

    public function kelas_lama()
    {
        return $this->belongsTo(Kelas::class, 'dari_kelas');
    }

    public function kelas_baru()
    {
        return $this->belongsTo(Kelas::class, 'ke_kelas');
    }
}
