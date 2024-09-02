<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;
class MataPelajaran extends Model
{
    use HasFactory;
    protected $table = 'mata_pelajaran';
    protected $fillable = ['id','id_mapel','nama_mapel'];

    public function guru() 
    {
        return $this->belongsTo(Guru::class, 'id_guru');
    }
    public function siswa() 
    {
        return $this->belongsTo(Kelas::class);
    }
    public function nilai() 
    {
        return $this->hasMany(Nilai::class, 'id', 'id_mapel');
    }
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}


