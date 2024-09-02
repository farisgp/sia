<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuruPromotion extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'id_guru', 'status', 'tahun_pemberhentian'];

    public function guru()
    {
        return $this->belongsTo(Kelola::class, 'id_guru');
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
