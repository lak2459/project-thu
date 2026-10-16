<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ลงทะเบียนผู้เช่าและทำสัญญาเช่าใหม่') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('tenants.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <h3 class="font-bold text-md text-indigo-700 border-b pb-2">1. ข้อมูลการจัดสรรห้องพัก</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">เลือกห้องพัก (เฉพาะห้องว่าง)</label>
                            <select name="room_id" required class="mt-1 w-full rounded-md border-gray-300">
                                <option value="">-- เลือกห้องพัก --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}">ห้อง {{ $room->room_number }} (ค่าเช่า ฿{{ number_format($room->monthly_rent, 2) }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">วันที่เข้าอยู่จริง</label>
                            <input type="date" name="check_in_date" value="{{ date('Y-m-d') }}" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                    </div>

                    <h3 class="font-bold text-md text-indigo-700 border-b pb-2">2. ข้อมูลส่วนตัวผู้เช่า</h3>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ชื่อจริง</label>
                            <input type="text" name="first_name" required class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">นามสกุล</label>
                            <input type="text" name="last_name" required class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">เลขบัตรประชาชน</label>
                            <input type="text" name="id_card_number" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">เบอร์โทรศัพท์</label>
                            <input type="text" name="phone_number" required class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">อีเมล</label>
                            <input type="email" name="email" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ทะเบียนยานพาหนะ</label>
                            <input type="text" name="vehicle_registration_plate" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                    </div>

                    <h3 class="font-bold text-md text-indigo-700 border-b pb-2">3. ผู้ติดต่อฉุกเฉินและระยะเวลาสัญญา</h3>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ชื่อผู้ติดต่อฉุกเฉิน</label>
                            <input type="text" name="emergency_contact_name" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">เบอร์ติดต่อฉุกเฉิน</label>
                            <input type="text" name="emergency_contact_phone" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">ความสัมพันธ์</label>
                            <input type="text" name="emergency_relation" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">วันเริ่มสัญญาเช่า</label>
                            <input type="date" name="lease_start_date" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">วันสิ้นสุดสัญญาเช่า</label>
                            <input type="date" name="lease_end_date" class="mt-1 w-full rounded-md border-gray-300">
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4">
                        <a href="{{ route('tenants.index') }}" class="px-4 py-2 border rounded-md text-gray-600">ยกเลิก</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">บันทึกข้อมูลผู้เช่า</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>