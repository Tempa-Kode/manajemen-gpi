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
        Schema::table('remaja', function (Blueprint $table) {
            $table->dropColumn(['tanggal_lahir', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('remaja', function (Blueprint $table) {
            $table->date('tanggal_lahir')->nullable();
            $table->enum('status', ['aktif', 'tidak_aktif'])->default('aktif');
        });
    }
};
