<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Room;
use App\Models\Tenant;
use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. สร้างผู้ใช้สำหรับล็อกอิน
        User::factory()->create([
            'name' => 'Admin Dormitory',
            'email' => 'admin@dorm.com',
            'password' => Hash::make('password'),
        ]);

        // 2. ข้อมูลห้องพัก (Rooms)
        $room101 = Room::create([
            'room_number' => '101',
            'floor' => 1,
            'room_type' => 'Standard Air',
            'monthly_rent' => 4500.00,
            'deposit_amount' => 9000.00,
            'status' => 'occupied',
            'has_air_conditioner' => true,
            'has_water_heater' => true,
            'has_refrigerator' => true,
            'has_bed_furniture' => true,
            'notes' => 'ห้องมุม ชั้น 1 อากาศถ่ายเทดี',
        ]);

        $room102 = Room::create([
            'room_number' => '102',
            'floor' => 1,
            'room_type' => 'Standard Fan',
            'monthly_rent' => 3500.00,
            'deposit_amount' => 7000.00,
            'status' => 'vacant',
            'has_air_conditioner' => false,
            'has_water_heater' => false,
            'has_refrigerator' => false,
            'has_bed_furniture' => true,
            'notes' => 'ห้องว่าง พร้อมเข้าอยู่',
        ]);

        // 3. ข้อมูลผู้เช่า (Tenants)
        $tenant1 = Tenant::create([
            'room_id' => $room101->id,
            'first_name' => 'สมชาย',
            'last_name' => 'ใจดี',
            'id_card_number' => '1100200300401',
            'phone_number' => '0812345678',
            'email' => 'somchai@email.com',
            'emergency_contact_name' => 'สมศรี ใจดี',
            'emergency_contact_phone' => '0898765432',
            'emergency_relation' => 'มารดา',
            'vehicle_registration_plate' => 'กข 1234 กทม',
            'lease_start_date' => '2026-01-01',
            'lease_end_date' => '2026-12-31',
            'tenant_status' => 'active',
            'check_in_date' => '2026-01-01',
        ]);

        // 4. ข้อมูลใบแจ้งหนี้ (Invoices)
        Invoice::create([
            'room_id' => $room101->id,
            'tenant_id' => $tenant1->id,
            'month_year' => '10/2026',
            'due_date' => '2026-10-05',
            'previous_electricity_meter' => 1200.00,
            'current_electricity_meter' => 1350.00,
            'electricity_units_used' => 150.00,
            'electricity_rate_per_unit' => 7.00,
            'total_electricity_charge' => 1050.00,
            'previous_water_meter' => 450.00,
            'current_water_meter' => 465.00,
            'water_units_used' => 15.00,
            'water_rate_per_unit' => 18.00,
            'total_water_charge' => 270.00,
            'room_rent_charge' => 4500.00,
            'common_fee_charge' => 300.00,
            'other_fees_charge' => 100.00,
            'grand_total_amount' => 6220.00,
            'payment_status' => 'unpaid',
        ]);
    }
}