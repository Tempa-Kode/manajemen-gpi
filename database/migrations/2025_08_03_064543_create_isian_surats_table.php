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
        Schema::create('isian_surat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('surat_id')->constrained('surat_terbit')->onDelete('cascade');
            $table->string('nama_field');
            $table->text('isi_field');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isian_surat');
    }
};
