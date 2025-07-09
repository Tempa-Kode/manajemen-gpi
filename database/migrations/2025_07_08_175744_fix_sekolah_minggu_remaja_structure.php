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
        // Drop existing tables and recreate with correct structure
        Schema::dropIfExists('sekolah_minggu');
        Schema::dropIfExists('remaja');

        // Create sekolah_minggu table
        Schema::create('sekolah_minggu', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kk');
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('kelas', 50)->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('id_kk')->references('id')->on('jemaat')->onDelete('cascade');
        });

        // Create remaja table
        Schema::create('remaja', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kk');
            $table->string('nama');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('pendidikan', 100)->nullable();
            $table->string('pekerjaan', 100)->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
            $table->timestamps();

            $table->foreign('id_kk')->references('id')->on('jemaat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah_minggu');
        Schema::dropIfExists('remaja');
    }
};
