<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airline_id')->constrained('airlines')->onDelete('cascade');
            $table->string('kode_penerbangan')->unique(); // Contoh: GA-101
            $table->string('kota_asal');
            $table->string('kota_tujuan');
            $table->date('tanggal_berangkat');
            $table->time('jam_berangkat');
            $table->time('jam_tiba');
            $table->decimal('harga', 12, 2);
            $table->integer('kuota')->default(100);
            $table->integer('sisa_kuota')->nullable();
            $table->enum('status', ['scheduled', 'delayed', 'cancelled', 'completed'])->default('scheduled');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};