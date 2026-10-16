<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ระบบใบแจ้งหนี้ / ค่าน้ำ-ค่าไฟ (Invoices)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-bold">รายการใบแจ้งหนี้ทั้งหมด</h3>
                        <a href="{{ route('invoices.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded shadow">
                            + ออกใบแจ้งหนี้ใหม่
                        </a>
                    </div>

                    <table class="min-w-full divide-y divide-gray-200 border">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">เดือน/ปี</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ห้อง</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">ค่าเช่า</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">ค่าไฟ</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">ค่าน้ำ</th>
                                <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">ยอดรวมสุทธิ</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">สถานะ</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">จัดการ</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse ($invoices as $invoice)
                                <tr>
                                    <td class="px-4 py-4 whitespace-nowrap">{{ $invoice->month_year }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap font-bold text-indigo-600">{{ $invoice->room->room_number ?? '-' }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-right">{{ number_format($invoice->room_rent_charge, 2) }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-right">{{ number_format($invoice->total_electricity_charge, 2) }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-right">{{ number_format($invoice->total_water_charge, 2) }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-right font-bold text-green-600">{{ number_format($invoice->grand_total_amount, 2) }}</td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        @if($invoice->payment_status == 'paid')
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800 border border-green-300">
                                                ✓ ชำระแล้ว
                                            </span>
                                        @else
                                            <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800 border border-red-300">
                                                ยังไม่ชำระ
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            <a href="{{ route('invoices.show', $invoice) }}" class="bg-gray-800 text-white text-xs px-3 py-1.5 rounded hover:bg-gray-700">ดู/พิมพ์บิล</a>
                                            
                                            @if($invoice->payment_status == 'unpaid')
                                                <form action="{{ route('invoices.markAsPaid', $invoice) }}" method="POST" onsubmit="return confirm('ยืนยันการรับชำระเงินสำหรับใบแจ้งหนี้นี้?');">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" style="background-color: #16a34a; color: white;" class="text-xs px-3 py-1.5 rounded font-medium shadow">
                                                        $ แจ้งชำระเงิน
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-gray-500">ยังไม่มีข้อมูลใบแจ้งหนี้ในระบบ</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>