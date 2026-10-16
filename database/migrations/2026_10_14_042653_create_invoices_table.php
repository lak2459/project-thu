<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('room_id')->constrained()->onDelete('cascade');
            $table->foreignId('tenant_id')->nullable()->constrained()->onDelete('set null');
            $table->string('billing_month'); // เช่น 10/2026
            
            // ค่าเช่าห้อง
            $table->decimal('room_rent_amount', 10, 2);
            
            // มิเตอร์ไฟฟ้า
            $table->decimal('electricity_previous_reading', 10, 2)->default(0);
            $table->decimal('electricity_current_reading', 10, 2)->default(0);
            $table->decimal('electricity_units_used', 10, 2)->default(0);
            $table->decimal('electricity_unit_rate', 10, 2)->default(7.00);
            $table->decimal('electricity_total_amount', 10, 2)->default(0);
            
            // มิเตอร์น้ำประปา
            $table->decimal('water_previous_reading', 10, 2)->default(0);
            $table->decimal('water_current_reading', 10, 2)->default(0);
            $table->decimal('water_units_used', 10, 2)->default(0);
            $table->decimal('water_unit_rate', 10, 2)->default(18.00);
            $table->decimal('water_total_amount', 10, 2)->default(0);
            
            // ยอดรวมและการชำระเงิน
            $table->decimal('grand_total_amount', 10, 2);
            $table->date('issue_date');
            $table->date('due_date');
            $table->enum('payment_status', ['unpaid', 'paid', 'overdue'])->default('unpaid');
            $table->timestamp('payment_date')->nullable();
            $table->string('payment_method')->nullable();
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};