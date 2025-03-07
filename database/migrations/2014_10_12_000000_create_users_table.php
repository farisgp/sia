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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username');
            $table->string('password');
            $table->enum('role', ['admin', 'siswa', 'guru']);
            $table->tinyInteger('isactive')->default(1);

            $table->unsignedBigInteger('id_siswa');
            $table->foreign('id_siswa')->references('id')->on('siswa');

            $table->unsignedBigInteger('id_guru');
            $table->foreign('id_guru')->references('id')->on('guru');
            // $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
