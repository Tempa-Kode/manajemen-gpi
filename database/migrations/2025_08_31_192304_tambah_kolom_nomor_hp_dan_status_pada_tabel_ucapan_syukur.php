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
        Schema::table('ucapan_syukur', function (Blueprint $table) {
            $table->string('no_hp')->nullable()->after('nama');
            $table->enum('status', ['pending', 'terima', 'tolak'])->default('pending')->after('bukti_transfer');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ucapan_syukur', function (Blueprint $table) {
            $table->dropColumn(['no_hp', 'status']);
        });
    }
};
