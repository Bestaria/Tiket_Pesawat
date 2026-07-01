<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('flight_id')->constrained()->onDelete('cascade');
            $table->string('seat_number'); // Contoh: A1, A2, B1, dll
            $table->string('class')->default('economy'); // economy, business, first
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};