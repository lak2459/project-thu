<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('รายละเอียดใบแจ้งหนี้') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8" id="printable">
                <div class="text-center mb-8 border-b pb-4">
                    <h1 class="text-2xl font-bold">ใบแจ้งหนี้ / ใบเสร็จรับเงิน</h1>
                    <p class="text-gray-500">ประจำเดือน {{ $invoice->month_year }}</p>
                </div>

                <div class="flex justify-between mb-6">
                    <div>
                        <p class="font-bold">ห้องพักหมายเลข: <span class="text-indigo-600">{{ $invoice->room->room_number }}</span></p>
                        <p>ชื่อผู้เช่า: {{ $invoice->room->tenant_name ?? '-' }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm text-gray-500">วันที่ออกบิล: {{ $invoice->created_at->format('d/m/Y') }}</p>
                    </div>
                </div>

                <table class="w-full border-collapse border mb-6">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2 text-left">รายการ</th>
                            <th class="border p-2 text-center">มิเตอร์เดิม</th>
                            <th class="border p-2 text-center">มิเตอร์ใหม่</th>
                            <th class="border p-2 text-center">จำนวนหน่วย</th>
                            <th class="border p-2 text-right">ราคา/หน่วย</th>
                            <th class="border p-2 text-right">จำนวนเงิน (บาท)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="border p-2">ค่าเช่าห้องพัก</td>
                            <td class="border p-2 text-center">-</td>
                            <td class="border p-2 text-center">-</td>
                            <td class="border p-2 text-center">-</td>
                            <td class="border p-2 text-right">-</td>
                            <td class="border p-2 text-right">{{ number_format($invoice->room_rent, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="border p-2">ค่าไฟฟ้า</td>
                            <td class="border p-2 text-center">{{ $invoice->previous_electricity }}</td>
                            <td class="border p-2 text-center">{{ $invoice->current_electricity }}</td>
                            <td class="border p-2 text-center">{{ $invoice->current_electricity - $invoice->previous_electricity }}</td>
                            <td class="border p-2 text-right">{{ number_format($invoice->electricity_rate, 2) }}</td>
                            <td class="border p-2 text-right">{{ number_format($invoice->total_electricity, 2) }}</td>
                        </tr>
                        <tr>
                            <td class="border p-2">ค่าน้ำประปา</td>
                            <td class="border p-2 text-center">{{ $invoice->previous_water }}</td>
                            <td class="border p-2 text-center">{{ $invoice->current_water }}</td>
                            <td class="border p-2 text-center">{{ $invoice->current_water - $invoice->previous_water }}</td>
                            <td class="border p-2 text-right">{{ number_format($invoice->water_rate, 2) }}</td>
                            <td class="border p-2 text-right">{{ number_format($invoice->total_water, 2) }}</td>
                        </tr>
                        <tr class="font-bold bg-gray-50">
                            <td colspan="5" class="border p-2 text-right">รวมเงินทั้งสิ้น</td>
                            <td class="border p-2 text-right text-green-600">{{ number_format($invoice->total_amount, 2) }}</td>
                        </tr>
                    </tbody>
                </table>

                <div class="mt-8 flex justify-between items-center print:hidden">
                    <a href="{{ route('invoices.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded shadow hover:bg-gray-600">ย้อนกลับ</a>
                    <button onclick="window.print()" class="bg-blue-600 text-white px-6 py-2 rounded shadow hover:bg-blue-700">🖨️ พิมพ์ใบแจ้งหนี้</button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>