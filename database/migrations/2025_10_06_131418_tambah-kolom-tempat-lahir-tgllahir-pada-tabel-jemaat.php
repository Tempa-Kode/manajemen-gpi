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
            $table->string('tempat_lahir_ayah', 100)->nullable()->after('ayah');
            $table->date('tgl_lahir_ayah')->nullable()->after('tempat_lahir_ayah');
            $table->string('tempat_lahir_ibu', 100)->nullable()->after('ibu');
            $table->date('tgl_lahir_ibu')->nullable()->after('tempat_lahir_ibu');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jemaat', function (Blueprint $table) {
            $table->dropColumn([
                'tempat_lahir_ayah',
                'tgl_lahir_ayah',
                'tempat_lahir_ibu',
                'tgl_lahir_ibu'
            ]);
        });
    }
};
