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
        Schema::create('jemaat', function (Blueprint $table) {
            $table->id();
            $table->integer('id_kk')->unique();
            $table->string('nama_keluarga');
            $table->string('ayah');
            $table->string('ibu');
            $table->text('alamat');
            $table->string('no_hp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jemaat');
    }
};
