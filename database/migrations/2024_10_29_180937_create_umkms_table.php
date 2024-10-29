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
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->string('nib');
            $table->string('sku');
            $table->string('ktp');
            $table->string('kk');
            $table->string('foto_usaha');
            $table->integer('modal_awal');
            $table->foreignId('jenis_usaha_id')->constrained()->onDelete('cascade');
            $table->year('tahun_berdiri');
            $table->string('no_hp');
            $table->string('tenaga_kerja');
            $table->string('pembayaran_digital');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
