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
        Schema::create('sekolah_minggu', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jemaat_id')
                ->constrained('jemaat')
                ->onDelete('cascade');
            $table->string('nama_anak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sekolah_minggu');
    }
};
