<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->id(); // 13
            $table->foreignId('room_id')->nullable()->constrained()->nullOnDelete(); // 14
            $table->string('first_name'); // 15
            $table->string('last_name'); // 16
            $table->string('id_card_number')->nullable(); // 17
            $table->string('phone_number')->nullable(); // 18
            $table->string('email')->nullable(); // 19
            $table->string('emergency_contact_name')->nullable(); // 20
            $table->string('emergency_contact_phone')->nullable(); // 21
            $table->string('emergency_relation')->nullable(); // 22
            $table->string('vehicle_registration_plate')->nullable(); // 23
            $table->date('lease_start_date')->nullable(); // 24
            $table->date('lease_end_date')->nullable(); // 25
            $table->string('contract_file_path')->nullable(); // 26
            $table->string('id_card_image_path')->nullable(); // 27
            $table->enum('tenant_status', ['active', 'notice', 'moved_out'])->default('active'); // 28
            $table->date('check_in_date')->nullable(); // 29
            $table->date('check_out_date')->nullable(); // 30
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};