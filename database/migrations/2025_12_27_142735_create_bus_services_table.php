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
        Schema::create('bus_services', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // VIP CABIN, LUXURY BUS, LIMOUSINE BUS
            $table->string('type'); // vip_cabin, luxury_bus, limousine_bus
            $table->string('departure_time'); // 11AM, 7:30PM, 10:45AM, 3PM
            $table->text('pick_up_location'); // 162 Tran Quang Khai street, Alley Homestay
            $table->decimal('price', 10, 0); // 350000, 300000, 550000
            $table->boolean('is_recommended')->default(false);
            $table->string('starting_point')->nullable(); // HANOI (for outbound)
            $table->string('return_destination')->nullable(); // HA LONG (for return)
            $table->enum('direction', ['outbound', 'return'])->default('outbound');
            $table->string('image')->nullable();
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus_services');
    }
};
