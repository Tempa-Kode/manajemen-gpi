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
        Schema::table('warta_gereja', function (Blueprint $table) {
            $table->text('warta')->nullable()->after('tanggal');
        });

        if (Schema::hasTable('item_warta_gereja')) {
            Schema::dropIfExists('item_warta_gereja');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('warta_gereja', function (Blueprint $table) {
            $table->dropColumn('warta');
        });

        Schema::create('item_warta_gereja', function (Blueprint $table) {
            $table->id();
            $table->foreignId('warta_gereja_id')->constrained('warta_gereja')->onDelete('cascade');
            $table->string('nama_item_warta_gereja', 60);
            $table->text('deskripsi_item_warta');
            $table->timestamps();
        });
    }
};
