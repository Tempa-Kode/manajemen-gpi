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
        Schema::create('item_warta_gereja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warta_gereja_id')
                ->constrained('warta_gereja')
                ->onDelete('cascade');
            $table->string('nama_item_warta_gereja', 60);
            $table->text('deskripsi_item_warta');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('item_warta_gereja');
    }
};
