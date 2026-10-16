<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ระบบจัดการผู้เช่าและสัญญาเช่า (Tenants)') }}
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
                    <h3 class="text-lg font-bold">รายชื่อผู้เช่าทั้งหมด</h3>
                    <a href="{{ route('tenants.create') }}" class="text-white font-bold py-2 px-4 rounded shadow" style="background-color: #2563eb;">
                        + เพิ่มผู้เช่าใหม่
                    </a>
                </div>

                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ห้องพัก</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ชื่อ - นามสกุล</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">เบอร์โทรศัพท์</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ผู้ติดต่อฉุกเฉิน</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">สถานะผู้เช่า</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($tenants as $tenant)
                            <tr>
                                <td class="px-4 py-3 font-bold text-indigo-600">{{ $tenant->room->room_number ?? 'ไม่ได้ระบุ' }}</td>
                                <td class="px-4 py-3 font-medium">{{ $tenant->first_name }} {{ $tenant->last_name }}</td>
                                <td class="px-4 py-3">{{ $tenant->phone_number }}</td>
                                <td class="px-4 py-3 text-sm text-gray-600">{{ $tenant->emergency_contact_name }} ({{ $tenant->emergency_contact_phone }})</td>
                                <td class="px-4 py-3 text-center">
                                    <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ $tenant->tenant_status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center space-x-2">
                                        <a href="{{ route('tenants.show', $tenant) }}" class="inline-block font-medium text-xs px-3 py-1.5 rounded shadow-sm" style="background-color: #2563eb; color: #ffffff;">
                                            ดูสัญญา
                                        </a>
                                        <a href="{{ route('tenants.edit', $tenant) }}" class="inline-block font-medium text-xs px-3 py-1.5 rounded shadow-sm" style="background-color: #d97706; color: #ffffff;">
                                            แก้ไข
                                        </a>
                                        <form action="{{ route('tenants.destroy', $tenant) }}" method="POST" onsubmit="return confirm('ยืนยันลบผู้เช่าท่านนี้?');" class="inline-block">
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
                                <td colspan="6" class="text-center py-4 text-gray-500">ยังไม่มีข้อมูลผู้เช่า</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>