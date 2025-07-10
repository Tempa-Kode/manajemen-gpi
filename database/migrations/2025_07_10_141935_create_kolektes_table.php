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
        Schema::create('kolekte', function (Blueprint $table) {
            $table->id();
            $table->decimal('pembangunan_gereja', 15, 2)->default(0);
            $table->decimal('persembahan_pelayanan_pengerja', 15, 2)->default(0);
            $table->decimal('persembahan_pelayanan_sosial_gereja', 15, 2)->default(0);
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kolekte');
    }
};
