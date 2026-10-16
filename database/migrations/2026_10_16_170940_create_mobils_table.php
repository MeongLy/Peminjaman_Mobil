<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('plat', 20)->unique();
            $table->string('merk', 50);
            $table->string('tipe', 100);
            $table->integer('tahun');
            $table->integer('kursi')->default(5);
            $table->enum('transmisi', ['Manual', 'Otomatis'])->default('Manual');
            $table->string('warna', 30);
            $table->string('bahan_bakar', 30)->default('Bensin');
            $table->enum('status', ['Tersedia', 'Digunakan', 'Perbaikan'])->default('Tersedia');
            $table->string('pemegang')->nullable();
            $table->enum('kondisi', ['Baik', 'Perlu Cek', 'Rusak'])->default('Baik');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};
