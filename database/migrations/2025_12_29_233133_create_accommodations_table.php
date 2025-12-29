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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Dorm, Private room, Family room
            $table->text('description')->nullable();
            $table->decimal('price_per_night', 10, 0)->default(0); // 0 for free (Dorm), 375000, 550000
            $table->integer('capacity_min')->default(1); // 1-2pp, 3-4pp
            $table->integer('capacity_max')->default(2); // 1-2pp, 3-4pp
            $table->string('bed_type')->nullable(); // 1 king bed, 2 king beds
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};
