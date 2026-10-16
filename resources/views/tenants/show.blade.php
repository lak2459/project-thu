<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('รายละเอียดข้อมูลผู้เช่าและสัญญาเช่า') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center border-b pb-4 mb-6">
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $tenant->first_name }} {{ $tenant->last_name }}</h3>
                        <p class="text-sm text-indigo-600 font-semibold">ห้องพักหมายเลข: {{ $tenant->room->room_number ?? 'ไม่ได้ระบุ' }}</p>
                    </div>
                    <a href="{{ route('tenants.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded">ย้อนกลับ</a>
                </div>

                <div class="grid grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded border">
                        <h4 class="font-bold mb-3 text-indigo-800">ข้อมูลส่วนตัว</h4>
                        <p><strong>เลขบัตรประชาชน:</strong> {{ $tenant->id_card_number ?? '-' }}</p>
                        <p><strong>เบอร์โทรศัพท์:</strong> {{ $tenant->phone_number ?? '-' }}</p>
                        <p><strong>อีเมล:</strong> {{ $tenant->email ?? '-' }}</p>
                        <p><strong>ทะเบียนรถ:</strong> {{ $tenant->vehicle_registration_plate ?? '-' }}</p>
                    </div>

                    <div class="bg-gray-50 p-4 rounded border">
                        <h4 class="font-bold mb-3 text-indigo-800">ข้อมูลสัญญาเช่า & ผู้ติดต่อฉุกเฉิน</h4>
                        <p><strong>ผู้ติดต่อฉุกเฉิน:</strong> {{ $tenant->emergency_contact_name ?? '-' }} ({{ $tenant->emergency_relation ?? '-' }})</p>
                        <p><strong>เบอร์ติดต่อฉุกเฉิน:</strong> {{ $tenant->emergency_contact_phone ?? '-' }}</p>
                        <p><strong>วันที่เริ่มสัญญา:</strong> {{ $tenant->lease_start_date ?? '-' }}</p>
                        <p><strong>วันที่สิ้นสุดสัญญา:</strong> {{ $tenant->lease_end_date ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>