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
        Schema::table('surat_terbit', function (Blueprint $table) {
            $table->foreignId('permohonan_id')
                ->nullable()
                ->after('id');
            $table->boolean('terbit')->default(true)->after('judul_surat');
            $table->foreign('permohonan_id')
                ->references('id')
                ->on('permohonan_surat')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('surat_terbit', function (Blueprint $table) {
            $table->dropForeign(['permohonan_id']);
            $table->dropColumn('permohonan_id');
            $table->dropColumn('terbit');
        });
    }
};
