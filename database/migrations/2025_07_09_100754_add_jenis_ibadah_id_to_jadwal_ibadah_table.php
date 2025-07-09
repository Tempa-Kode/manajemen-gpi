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
            $table->unsignedBigInteger('jenis_ibadah_id')->nullable()->after('id');
            $table->foreign('jenis_ibadah_id')->references('id')->on('jenis_ibadah')->onDelete('set null');
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
        });
    }
};
