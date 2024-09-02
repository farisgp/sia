<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $fillable = ['id','tingkat_kelas', 'id_guru'];

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function nilai()
    {
        return $this->hasMany(Nilai::class, 'id', 'id_kelas');
    }

    public function presensi() 
    {
        return $this->hasMany(Presensi::class);
    }
}
