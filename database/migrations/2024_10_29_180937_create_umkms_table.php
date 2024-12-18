<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pemilik_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('sku');
            $table->string('ktp');
            $table->string('kk');
            $table->string('foto_usaha');
            $table->integer('modal_awal');
            $table->foreignId('jenis_usaha_id')->constrained()->onDelete('cascade');
            $table->year('tahun_berdiri');
            $table->string('tenaga_kerja');
            $table->boolean('pembayaran_digital')->default(false);
            $table->string('long');
            $table->string('lat');
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
