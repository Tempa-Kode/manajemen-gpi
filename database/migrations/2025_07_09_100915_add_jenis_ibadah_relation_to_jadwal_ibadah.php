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
        Schema::table('jadwal_ibadah', function (Blueprint $table) {
            // Tambah kolom jenis_ibadah_id sebagai foreign key
            $table->unsignedBigInteger('jenis_ibadah_id')->nullable()->after('id');
            $table->foreign('jenis_ibadah_id')->references('id')->on('jenis_ibadah')->onDelete('set null');

            // Buat kolom jenis_ibadah lama menjadi nullable untuk sementara
            $table->string('jenis_ibadah', 30)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_ibadah', function (Blueprint $table) {
            $table->dropForeign(['jenis_ibadah_id']);
            $table->dropColumn('jenis_ibadah_id');
            $table->string('jenis_ibadah', 30)->nullable(false)->change();
        });
    }
};
