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
        Schema::table('kolekte', function (Blueprint $table) {
            $table->unsignedBigInteger('jadwal_ibadah_id')->nullable()->after('id');
            $table->date('tanggal_ibadah')->nullable()->after('jadwal_ibadah_id');

            $table->foreign('jadwal_ibadah_id')->references('id')->on('jadwal_ibadah')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kolekte', function (Blueprint $table) {
            $table->dropForeign(['jadwal_ibadah_id']);
            $table->dropColumn(['jadwal_ibadah_id', 'tanggal_ibadah']);
        });
    }
};
