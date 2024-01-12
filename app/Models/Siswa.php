<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $fillable = ['id', 'nama', 'nis', 'nisn','foto', 'nama_siswa', 'jenis_kelamin',
                            'tanggal_lahir', 'id_kelas', 'alamat', 'kontak_ortu', 'id_agama'];

    public function presensi() 
    {
        return $this->hasMany(Presensi::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
    public function siswa() 
    {
        return $this->belongsTo(Siswa::class, 'id_kelas');
    }
    public function nilai() 
    {
        return $this->hasMany(Nilai::class, 'id', 'id_kelas');
    }
    public function mata_pelajaran() 
    {
        return $this->hasMany(MataPelajaran::class);
    }

    public function agama()
    {
        return $this->hasOne(Agama::class, 'id', 'id_agama');
    }
    public function users()
    {
        return $this->hasOne(User::class, 'id_siswa');
    }
    
    public function kelola()
    {
        return $this->hasOne(KelolaUser::class, 'id_siswa', 'id');
    }
}
