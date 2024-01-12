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
        Schema::create('siswa', function (Blueprint $table) {
            $table->id ();
            $table->char('nis', 10) -> unique();
            $table->char('nisn', 25) -> unique();
            $table->string('nama_siswa', 255);
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->date('tanggal_lahir');
            $table->unsignedBigInteger('id_kelas');
 
            $table->foreign('id_kelas')->references('id')->on('kelas');
            $table->string('alamat');
            $table->string('kontak_ortu', 25);
            $table->foreignId('id_agama')->constrained('agama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
