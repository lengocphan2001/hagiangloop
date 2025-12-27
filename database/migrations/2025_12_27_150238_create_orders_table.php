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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tour_id')->constrained()->onDelete('cascade');
            $table->string('customer_name');
            $table->string('customer_email');
            $table->string('customer_phone');
            $table->text('customer_address')->nullable();
            $table->date('tour_start_date');
            $table->integer('adults_count')->default(1);
            $table->integer('children_count')->default(0);
            $table->foreignId('outbound_bus_service_id')->nullable()->constrained('bus_services')->onDelete('set null');
            $table->foreignId('return_bus_service_id')->nullable()->constrained('bus_services')->onDelete('set null');
            $table->foreignId('gift_id')->nullable()->constrained()->onDelete('set null');
            $table->decimal('total_price', 12, 0);
            $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
