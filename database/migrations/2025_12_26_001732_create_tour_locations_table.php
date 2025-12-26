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
        Schema::create('tour_locations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_day_id')->constrained()->onDelete('cascade');
            $table->string('name'); // Đèo Bắc Sum, Cổng trời, etc.
            $table->text('description')->nullable();
            $table->string('type')->nullable(); // location, meal, accommodation
            $table->time('arrival_time')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_locations');
    }
};
