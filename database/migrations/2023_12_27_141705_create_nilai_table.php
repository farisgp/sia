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
        Schema::create('nilai', function (Blueprint $table) {
            $table->id();  
            $table->unsignedBigInteger('id_guru');
            $table->foreign('id_guru')->references('id')->on('guru');  

            $table->unsignedBigInteger('id_kelas');
            $table->foreign('id_kelas')->references('id')->on('kelas');  
            
            $table->unsignedBigInteger('id_siswa');
            $table->foreign('id_siswa')->references('id')->on('siswa'); 

            $table->unsignedBigInteger('id_mapel');
            $table->foreign('id_mapel')->references('id')->on('mata_pelajaran'); 
            $table->integer('lm1');            
            $table->integer('lm2');            
            $table->integer('lm3');            
            $table->integer('lm4');            
            $table->integer('lm5');            
            $table->integer('lm6');            
            $table->integer('rata_rata_lm');            
            $table->integer('tes');            
            $table->integer('non_tes');            
            $table->integer('rata_rata_sas');            
            $table->integer('nilai_akhir');            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilai');
    }
};
