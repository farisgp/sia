<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $fillable = ['id', 'nip', 'nama_guru', 'foto','role', 'jenis_kelamin', 'id_mapel', 'id_kelas', 'jenis_guru',
                            'alamat', 'kontak', 'id_agama', 'user_id', 'pendidikan', 'status', 'tahun_pemberhentian', 'jabatan'];
                            
    // public function getIdKelasAttribute()
    // {
    //     $data_guru = json_decode($this->attributes['data_guru']);

    //     return isset($data_guru->id_kelas) ? $data_guru->id_kelas : null;
    // }
    public function mata_pelajaran()
    {
        return $this->hasOne(MataPelajaran::class, 'id', 'id_mapel');
    }
    public function jadwal()
    {
        return $this->hasMany(JadwalPelajaran::class, 'id');
    }
    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }
    // public function kelas_many() 
    // {
    //     return $this->hasMany(Kelas::class);
    // }

    public function nilai() 
    {
        return $this->hasMany(Nilai::class);
    }
    public function presensi() 
    {
        return $this->hasMany(Presensi::class);
    }
    public function siswa() 
    {
        return $this->hasMany(Siswa::class);
    }

    public function agama()
    {
        return $this->hasOne(Agama::class, 'id', 'id_agama');
    }
    public function users()
    {
        return $this->hasOne(User::class,'id_guru');
    }
    
    public function kelola()
    {
        return $this->hasOne(KelolaUser::class, 'id_guru', 'id');
    }
    // public function role()
    // {
    //     return $this->morphTo();
    // }
    
    // public function kelas()
    // {
    //     if ($this->role === 'guru kelas') {
    //         return $this->hasOne(Kelas::class, 'id_guru');
    //     } elseif ($this->role === 'guru mapel') {
    //         return $this->hasMany(Kelas::class, 'id_guru');
    //     }
    // }
}
