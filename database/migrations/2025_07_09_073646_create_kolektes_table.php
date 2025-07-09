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
        Schema::create('kolektes', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('jenis_ibadah', 100)->nullable(); // Minggu Pagi, Minggu Sore, dll

            // Kolekte rutin (3 kolekte wajib)
            $table->decimal('kolekte_umum', 15, 2)->default(0);
            $table->decimal('kolekte_pembangunan', 15, 2)->default(0);
            $table->decimal('kolekte_diakonia', 15, 2)->default(0);

            // Kolekte lainnya (opsional)
            $table->string('nama_kolekte_lain', 100)->nullable();
            $table->decimal('jumlah_kolekte_lain', 15, 2)->nullable();

            // Total kolekte
            $table->decimal('total_kolekte', 15, 2)->default(0);

            // Keterangan tambahan
            $table->text('keterangan')->nullable();

            // Pencatat
            $table->string('pencatat', 100)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kolektes');
    }
};
