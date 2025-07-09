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
        Schema::create('jenis_ibadah', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_ibadah', 100)->unique()->comment('Jenis ibadah seperti Kebaktian Umum, Doa Syafaat, dll.');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_ibadah');
    }
};
