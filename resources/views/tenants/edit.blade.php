<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('แก้ไขข้อมูลผู้เช่าและสัญญาเช่า') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('tenants.update', $tenant) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')
                    
                    <h3 class="font-bold text-md text-indigo-700 border-b pb-2">1. ข้อมูลส่วนตัวผู้เช่า</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ชื่อจริง</label>
                            <input type="text" name="first_name" value="{{ old('first_name', $tenant->first_name) }}" required class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">นามสกุล</label>
                            <input type="text" name="last_name" value="{{ old('last_name', $tenant->last_name) }}" required class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">เลขบัตรประชาชน</label>
                            <input type="text" name="id_card_number" value="{{ old('id_card_number', $tenant->id_card_number) }}" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">เบอร์โทรศัพท์</label>
                            <input type="text" name="phone_number" value="{{ old('phone_number', $tenant->phone_number) }}" required class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">อีเมล</label>
                            <input type="email" name="email" value="{{ old('email', $tenant->email) }}" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ทะเบียนยานพาหนะ</label>
                            <input type="text" name="vehicle_registration_plate" value="{{ old('vehicle_registration_plate', $tenant->vehicle_registration_plate) }}" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                    </div>

                    <h3 class="font-bold text-md text-indigo-700 border-b pb-2">2. ผู้ติดต่อฉุกเฉินและระยะเวลาสัญญา</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ชื่อผู้ติดต่อฉุกเฉิน</label>
                            <input type="text" name="emergency_contact_name" value="{{ old('emergency_contact_name', $tenant->emergency_contact_name) }}" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">เบอร์ติดต่อฉุกเฉิน</label>
                            <input type="text" name="emergency_contact_phone" value="{{ old('emergency_contact_phone', $tenant->emergency_contact_phone) }}" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ความสัมพันธ์</label>
                            <input type="text" name="emergency_relation" value="{{ old('emergency_relation', $tenant->emergency_relation) }}" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">วันเริ่มสัญญาเช่า</label>
                            <input type="date" name="lease_start_date" value="{{ old('lease_start_date', $tenant->lease_start_date) }}" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">วันสิ้นสุดสัญญาเช่า</label>
                            <input type="date" name="lease_end_date" value="{{ old('lease_end_date', $tenant->lease_end_date) }}" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">สถานะผู้เช่า</label>
                            <select name="tenant_status" class="mt-1 w-full rounded-md border-gray-300">
                                <option value="active" {{ $tenant->tenant_status == 'active' ? 'selected' : '' }}>Active (ปกติ)</option>
                                <option value="inactive" {{ $tenant->tenant_status == 'inactive' ? 'selected' : '' }}>Inactive (ย้ายออก)</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('tenants.index') }}" class="px-4 py-2 border rounded-md text-gray-600">ยกเลิก</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">บันทึกการแก้ไข</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>