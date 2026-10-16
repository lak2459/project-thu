<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ระบบจัดการห้องพัก (Dormitory Management)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold">รายการห้องพักทั้งหมด</h3>
                    <a href="{{ route('rooms.create') }}" class="text-white font-bold py-2 px-4 rounded shadow" style="background-color: #2563eb;">
                        + เพิ่มข้อมูลห้องพักใหม่
                    </a>
                </div>

                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">หมายเลขห้อง</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ชั้น</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ประเภทห้อง</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">ค่าเช่า (บาท)</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">สถานะ</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($rooms as $room)
                            <tr>
                                <td class="px-4 py-3 font-bold text-indigo-600">{{ $room->room_number }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">ชั้น {{ $room->floor }}</td>
                                <td class="px-4 py-3 text-sm">{{ $room->room_type ?? 'Standard' }}</td>
                                <td class="px-4 py-3 text-right font-semibold">{{ number_format($room->monthly_rent, 2) }}</td>
                                <td class="px-4 py-3 text-center">
                                    @if($room->status == 'occupied')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">มีผู้เช่า</span>
                                    @elseif($room->status == 'vacant')
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">ว่าง</span>
                                    @else
                                        <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">ปิดปรับปรุง</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('rooms.edit', $room) }}" class="inline-block font-medium text-xs px-3 py-1.5 rounded shadow-sm" style="background-color: #d97706; color: #ffffff;">
                                            แก้ไข
                                        </a>
                                        <form action="{{ route('rooms.destroy', $room) }}" method="POST" onsubmit="return confirm('ยืนยันลบห้องพักนี้?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="font-medium text-xs px-3 py-1.5 rounded shadow-sm" style="background-color: #dc2626; color: #ffffff;">
                                                ลบ
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-gray-500">ยังไม่มีข้อมูลห้องพัก</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>