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
            $table->date('tgl_meninggal')->nullable()->after('pekerjaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('remaja', function (Blueprint $table) {
            $table->dropColumn('tgl_meninggal');
        });
    }
};
