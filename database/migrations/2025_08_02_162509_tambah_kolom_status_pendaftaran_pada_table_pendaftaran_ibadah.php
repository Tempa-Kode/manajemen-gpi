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
        Schema::table('pendaftaran_ibadah', function (Blueprint $table) {
            $table->enum('status', ['menunggu', 'konfirmasi', 'tolak'])
                ->default('menunggu')
                ->after('jadwal_ibadah_id')
                ->comment('Status pendaftaran ibadah: menunggu, konfirmasi, tolak');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pendaftaran_ibadah', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
