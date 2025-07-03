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
        Schema::create('jadwal_ibadah', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_ibadah', 30);
            $table->string('hari', 10);
            $table->date('tanggal');
            $table->time('jam');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_ibadah');
    }
};
