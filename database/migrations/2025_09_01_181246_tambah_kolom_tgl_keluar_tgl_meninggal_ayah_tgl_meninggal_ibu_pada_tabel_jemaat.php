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
        Schema::table('jemaat', function (Blueprint $table) {
            $table->date('tgl_keluar')->nullable()->after('tanggal_pendaftaran');
            $table->date('tgl_meninggal_ayah')->nullable()->after('tgl_keluar');
            $table->date('tgl_meninggal_ibu')->nullable()->after('tgl_meninggal_ayah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jemaat', function (Blueprint $table) {
            $table->dropColumn('tgl_keluar');
            $table->dropColumn('tgl_meninggal_ayah');
            $table->dropColumn('tgl_meninggal_ibu');
        });
    }
};
