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
        // Update tabel sekolah_minggu
        Schema::table('sekolah_minggu', function (Blueprint $table) {
            $table->dropColumn(['jemaat_id', 'nama_anak']);
            $table->unsignedBigInteger('id_kk')->after('id');
            $table->string('nama')->after('id_kk');
            $table->date('tanggal_lahir')->after('nama');
            $table->enum('jenis_kelamin', ['L', 'P'])->after('tanggal_lahir');
            $table->string('kelas', 50)->nullable()->after('jenis_kelamin');
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif')->after('kelas');

            $table->foreign('id_kk')->references('id')->on('jemaat')->onDelete('cascade');
        });

        // Update tabel remaja
        Schema::table('remaja', function (Blueprint $table) {
            $table->dropColumn(['jemaat_id', 'nama_anak']);
            $table->unsignedBigInteger('id_kk')->after('id');
            $table->string('nama')->after('id_kk');
            $table->date('tanggal_lahir')->after('nama');
            $table->enum('jenis_kelamin', ['L', 'P'])->after('tanggal_lahir');
            $table->string('pendidikan', 100)->nullable()->after('jenis_kelamin');
            $table->string('pekerjaan', 100)->nullable()->after('pendidikan');
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif')->after('pekerjaan');

            $table->foreign('id_kk')->references('id')->on('jemaat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Rollback tabel sekolah_minggu
        Schema::table('sekolah_minggu', function (Blueprint $table) {
            $table->dropForeign(['id_kk']);
            $table->dropColumn(['id_kk', 'nama', 'tanggal_lahir', 'jenis_kelamin', 'kelas', 'status']);
            $table->unsignedBigInteger('jemaat_id')->after('id');
            $table->string('nama_anak')->after('jemaat_id');
        });

        // Rollback tabel remaja
        Schema::table('remaja', function (Blueprint $table) {
            $table->dropForeign(['id_kk']);
            $table->dropColumn(['id_kk', 'nama', 'tanggal_lahir', 'jenis_kelamin', 'pendidikan', 'pekerjaan', 'status']);
            $table->unsignedBigInteger('jemaat_id')->after('id');
            $table->string('nama_anak')->after('jemaat_id');
        });
    }
};
