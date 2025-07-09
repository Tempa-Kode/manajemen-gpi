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
            // Hapus kolom jenis_ibadah yang lama karena sekarang menggunakan jenis_ibadah_id
            $table->dropColumn('jenis_ibadah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_ibadah', function (Blueprint $table) {
            // Kembalikan kolom jenis_ibadah jika rollback
            $table->string('jenis_ibadah', 30)->nullable()->after('jenis_ibadah_id');
        });
    }
};
