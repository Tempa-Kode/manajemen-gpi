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
        Schema::create('kolekte_umum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jadwal_ibadah_id')->nullable()->constrained('jadwal_ibadah')->cascadeOnDelete();
            $table->decimal('nominal', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kolekte_umum');
    }
};
