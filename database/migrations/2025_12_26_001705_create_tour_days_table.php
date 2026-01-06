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
        Schema::create('tour_days', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');
            $table->integer('day_number'); // 1, 2, 3, 4
            $table->string('title'); // Ngày 1, Ngày 2, etc.
            $table->string('route')->nullable(); // Ha Giang-Quản Bạ-Yên Minh
            $table->time('breakfast_time')->nullable(); // 8:00
            $table->time('departure_time')->nullable(); // 9:00, 10:30
            $table->text('notes')->nullable(); // ăn sáng tại Alley Homestay và soạn đồ đạc
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_days');
    }
};
