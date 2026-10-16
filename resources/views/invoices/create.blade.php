<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ออกใบแจ้งหนี้ / ค่าน้ำ-ค่าไฟประจำเดือน') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('invoices.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <!-- ส่วนที่ 1: เลือกห้องพัก และ ประจำเดือน -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">เลือกห้องพัก (เฉพาะห้องที่มีผู้เช่า)</label>
                            <select name="room_id" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">-- เลือกห้องพัก --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ old('room_id') == $room->id ? 'selected' : '' }}>
                                        ห้อง {{ $room->room_number }} (ค่าเช่า ฿{{ number_format($room->monthly_rent, 2) }})
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">ประจำเดือน/ปี</label>
                            <input type="text" name="billing_month" value="{{ old('billing_month', date('m/Y')) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            @error('billing_month')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- ส่วนที่ 2: มิเตอร์ไฟฟ้า -->
                    <div class="pt-2">
                        <h3 class="font-bold text-md text-amber-600 border-b pb-2 mb-3 flex items-center gap-1">
                            ⚡ มิเตอร์ไฟฟ้า (หน่วยละ 7 บาท)
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">เลขมิเตอร์ครั้งก่อน</label>
                                <input type="number" step="0.01" name="electricity_previous_reading" value="{{ old('electricity_previous_reading', 100) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('electricity_previous_reading')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">เลขมิเตอร์ครั้งนี้</label>
                                <input type="number" step="0.01" name="electricity_current_reading" value="{{ old('electricity_current_reading', 150) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('electricity_current_reading')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ส่วนที่ 3: มิเตอร์น้ำประปา -->
                    <div class="pt-2">
                        <h3 class="font-bold text-md text-blue-600 border-b pb-2 mb-3 flex items-center gap-1">
                            💧 มิเตอร์น้ำประปา (หน่วยละ 18 บาท)
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">เลขมิเตอร์ครั้งก่อน</label>
                                <input type="number" step="0.01" name="water_previous_reading" value="{{ old('water_previous_reading', 50) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('water_previous_reading')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">เลขมิเตอร์ครั้งนี้</label>
                                <input type="number" step="0.01" name="water_current_reading" value="{{ old('water_current_reading', 60) }}" required class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                @error('water_current_reading')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ปุ่มดำเนินการ -->
                    <div class="flex justify-end gap-3 pt-6 border-t">
                        <a href="{{ route('invoices.index') }}" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 font-medium">
                            ยกเลิก
                        </a>
                        <button type="submit" class="px-5 py-2 text-white font-bold rounded-md shadow transition duration-150 ease-in-out" style="background-color: #2563eb;">
                            คำนวณและออกใบแจ้งหนี้
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>