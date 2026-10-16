<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id(); // 1
            $table->string('room_number')->unique(); // 2
            $table->integer('floor')->default(1); // 3
            $table->string('room_type')->default('Standard'); // 4
            $table->decimal('monthly_rent', 8, 2)->default(0.00); // 5
            $table->decimal('deposit_amount', 8, 2)->default(0.00); // 6
            $table->enum('status', ['vacant', 'occupied', 'maintenance'])->default('vacant'); // 7
            $table->boolean('has_air_conditioner')->default(false); // 8
            $table->boolean('has_water_heater')->default(false); // 9
            $table->boolean('has_refrigerator')->default(false); // 10
            $table->boolean('has_bed_furniture')->default(true); // 11
            $table->text('notes')->nullable(); // 12
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};