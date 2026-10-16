<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('เพิ่มข้อมูลห้องพักใหม่') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('rooms.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">หมายเลขห้อง</label>
                            <input type="text" name="room_number" value="{{ old('room_number') }}" required class="mt-1 w-full rounded-md border-gray-300">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">ชั้น</label>
                            <input type="number" name="floor" value="{{ old('floor', 1) }}" required class="mt-1 w-full rounded-md border-gray-300">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">ประเภทห้องพัก</label>
                            <select name="room_type" class="mt-1 w-full rounded-md border-gray-300">
                                <option value="Standard Air">Standard Air (ห้องแอร์)</option>
                                <option value="Standard Fan">Standard Fan (ห้องพัดลม)</option>
                                <option value="Deluxe Air">Deluxe Air (ห้องแอร์พิเศษ)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">ค่าเช่ารายเดือน (บาท)</label>
                            <input type="number" step="0.01" name="monthly_rent" value="{{ old('monthly_rent') }}" required class="mt-1 w-full rounded-md border-gray-300">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">เงินประกัน (บาท)</label>
                            <input type="number" step="0.01" name="deposit_amount" value="{{ old('deposit_amount') }}" class="mt-1 w-full rounded-md border-gray-300">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">สถานะห้องพัก</label>
                            <select name="status" class="mt-1 w-full rounded-md border-gray-300">
                                <option value="vacant">ว่าง</option>
                                <option value="occupied">มีผู้เช่า</option>
                                <option value="maintenance">ปิดปรับปรุง</option>
                            </select>
                        </div>
                    </div>

                    <div class="border-t pt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">สิ่งอำนวยความสะดวก</label>
                        <div class="grid grid-cols-2 gap-2">
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="has_air_conditioner" value="1" class="rounded border-gray-300 text-indigo-600">
                                <span class="ms-2 text-sm text-gray-600">เครื่องปรับอากาศ</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="has_water_heater" value="1" class="rounded border-gray-300 text-indigo-600">
                                <span class="ms-2 text-sm text-gray-600">เครื่องทำน้ำอุ่น</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="has_refrigerator" value="1" class="rounded border-gray-300 text-indigo-600">
                                <span class="ms-2 text-sm text-gray-600">ตู้เย็น</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="checkbox" name="has_bed_furniture" value="1" class="rounded border-gray-300 text-indigo-600">
                                <span class="ms-2 text-sm text-gray-600">เตียง/เฟอร์นิเจอร์</span>
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">หมายเหตุ</label>
                        <textarea name="notes" rows="3" class="mt-1 w-full rounded-md border-gray-300">{{ old('notes') }}</textarea>
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('rooms.index') }}" class="px-4 py-2 border rounded-md text-gray-600">ยกเลิก</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">บันทึกห้องพัก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>