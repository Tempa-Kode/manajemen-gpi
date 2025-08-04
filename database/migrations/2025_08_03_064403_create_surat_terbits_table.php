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
        Schema::create('surat_terbit', function (Blueprint $table) {
            $table->id();
            $table->foreignId('template_id')->constrained('template_surat')->onDelete('cascade');
            $table->string('judul_surat');
            $table->string('path_output');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_terbit');
    }
};
