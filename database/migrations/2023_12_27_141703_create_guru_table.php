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
            $table->id ()->nullable();
            $table->char('nip', 10) -> unique();
            $table->string('nama_guru', 255);
            $table->string('role', 15);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->foreignId('id_mapel')->constrained('mata_pelajaran'); 
            $table->foreignId('id_kelas')->constrained('kelas');
            $table->string('alamat');
            $table->string('kontak', 25);
            $table->foreignId('id_agama')->constrained('agama');
            $table->string('pendidikan', 15);
            $table->string('jabatan', 10);
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
