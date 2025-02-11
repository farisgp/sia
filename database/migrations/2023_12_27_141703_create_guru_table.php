<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('guru', function (Blueprint $table) {
            $table->id();
            $table->char('nip', 16) -> unique();
            $table->string('nama_guru', 100);
            $table->string('role', 15);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->foreignId('id_mapel')->constrained('mata_pelajaran'); 
            $table->foreignId('id_kelas')->constrained('kelas');
            $table->string('alamat');
            $table->string('kontak', 25);
            $table->foreignId('id_agama')->constrained('agama');
            $table->enum('jenis_guru', ['Guru Kelas', 'Kepala Sekolah', 'Guru Mata Pelajaran']);
            $table->foreignId('user_id')->constrained('user');
            $table->string('foto', 50);
            $table->tinyInteger('status')->default(0);
            $table->string('jabatan', 10);
            $table->string('tahun_pemberhentian', 25);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guru');
    }
};
