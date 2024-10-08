<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelolaUser extends Model
{
    use HasFactory;
    protected $table = 'users';

    protected $fillable = ['id', 'nama', 'username', 'password', 'role' , 'id_siswa', 'id_guru', 'isactive'];

    public function users()
    {
        return $this->hasMany(KelolaUser::class);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id');
    }
    // public function siswa()
    // {
    //     return $this->hasOne(Siswa::class, 'user_id');
    // }
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'id', 'user_id');
    }
    
}
