<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('ภาพรวมระบบและการเงิน (Dashboard)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="text-sm font-medium text-gray-500">ชำระแล้วทั้งหมด</div>
                    <div class="text-2xl font-bold text-green-600 mt-2">
                        ฿{{ number_format($totalAmountPaid, 2) }}
                    </div>
                    <div class="text-xs text-gray-400 mt-1">จำนวน {{ $paidCount }} รายการ</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-red-500">
                    <div class="text-sm font-medium text-gray-500">ค้างชำระทั้งหมด</div>
                    <div class="text-2xl font-bold text-red-600 mt-2">
                        ฿{{ number_format($totalAmountUnpaid, 2) }}
                    </div>
                    <div class="text-xs text-gray-400 mt-1">จำนวน {{ $unpaidCount }} รายการ</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="text-sm font-medium text-gray-500">สถานะห้องพัก</div>
                    <div class="text-2xl font-bold text-blue-600 mt-2">
                        {{ $occupiedRooms }} / {{ $totalRooms }}
                    </div>
                    <div class="text-xs text-gray-400 mt-1">ห้องที่มีผู้เช่าอยู่ขณะนี้</div>
                </div>

                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-indigo-500">
                    <div class="text-sm font-medium text-gray-500">ใบแจ้งหนี้ทั้งหมด</div>
                    <div class="text-2xl font-bold text-indigo-600 mt-2">
                        {{ $totalInvoices }} ฉบับ
                    </div>
                    <div class="text-xs text-gray-400 mt-1">ออกในระบบแล้ว</div>
                </div>

            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-bold text-gray-800">รายการใบแจ้งหนี้ล่าสุด</h3>
                    <div class="flex gap-2">
                        <a href="{{ route('invoices.create') }}" style="background-color: #2563eb; color: white;" class="px-4 py-2 text-sm font-semibold rounded shadow hover:bg-blue-700">
                            + ออกใบแจ้งหนี้
                        </a>
                        <a href="{{ route('invoices.index') }}" class="px-4 py-2 text-sm font-semibold border border-gray-300 rounded hover:bg-gray-50">
                            ดูทั้งหมด
                        </a>
                    </div>
                </div>

                <table class="min-w-full divide-y divide-gray-200 border">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">เดือน/ปี</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ห้อง</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">ยอดรวมสุทธิ</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">สถานะ</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">จัดการ</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($recentInvoices as $invoice)
                            <tr>
                                <td class="px-4 py-3 text-sm">{{ $invoice->month_year }}</td>
                                <td class="px-4 py-3 text-sm font-bold text-indigo-600">{{ $invoice->room->room_number ?? '-' }}</td>
                                <td class="px-4 py-3 text-sm text-right font-bold text-green-600">{{ number_format($invoice->grand_total_amount, 2) }}</td>
                                <td class="px-4 py-3 text-sm text-center">
                                    @if($invoice->payment_status == 'paid')
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            ✓ ชำระแล้ว
                                        </span>
                                    @else
                                        <span class="px-2.5 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            ยังไม่ชำระ
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-center">
                                    <a href="{{ route('invoices.show', $invoice) }}" class="text-xs text-blue-600 hover:underline">ดูรายละเอียด</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-gray-500">ยังไม่มีข้อมูลรายการล่าสุด</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>