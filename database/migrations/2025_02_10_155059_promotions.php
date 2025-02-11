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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_siswa');
            $table->foreign('id_siswa')->references('id')->on('siswa');

            $table->unsignedBigInteger('kelas_lama');
            $table->foreign('kelas_lama')->references('id')->on('kelas');

            $table->unsignedBigInteger('kelas_baru');
            $table->foreign('kelas_baru')->references('id')->on('kelas');

            $table->tinyInteger('grad');
            $table->string('dari_tahun_ajaran');
            $table->string('ke_tahun_ajaran');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
