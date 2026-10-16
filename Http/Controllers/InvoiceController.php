<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Room;
use App\Models\Tenant;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['room', 'tenant'])->latest()->get();
        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $rooms = Room::where('status', 'occupied')->get();
        if ($rooms->isEmpty()) {
            $rooms = Room::all();
        }
        return view('invoices.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'billing_month' => 'required|string',
            'electricity_previous_reading' => 'required|numeric',
            'electricity_current_reading' => 'required|numeric|gte:electricity_previous_reading',
            'water_previous_reading' => 'required|numeric',
            'water_current_reading' => 'required|numeric|gte:water_previous_reading',
        ]);

        $room = Room::findOrFail($request->room_id);
        $tenant = Tenant::where('room_id', $room->id)->first();

        $elecUnits = $request->electricity_current_reading - $request->electricity_previous_reading;
        $waterUnits = $request->water_current_reading - $request->water_previous_reading;

        $elecRate = 7.00;
        $waterRate = 18.00;

        $elecAmount = $elecUnits * $elecRate;
        $waterAmount = $waterUnits * $waterRate;
        $rentAmount = $room->monthly_rent ?? 0;

        $grandTotal = $rentAmount + $elecAmount + $waterAmount;

        Invoice::create([
            'invoice_number' => 'INV-' . date('Ym') . '-' . rand(100, 999),
            'room_id' => $room->id,
            'tenant_id' => $tenant->id ?? null,
            'billing_month' => $request->billing_month,
            'room_rent_amount' => $rentAmount,
            'electricity_previous_reading' => $request->electricity_previous_reading,
            'electricity_current_reading' => $request->electricity_current_reading,
            'electricity_units_used' => $elecUnits,
            'electricity_unit_rate' => $elecRate,
            'electricity_total_amount' => $elecAmount,
            'water_previous_reading' => $request->water_previous_reading,
            'water_current_reading' => $request->water_current_reading,
            'water_units_used' => $waterUnits,
            'water_unit_rate' => $waterRate,
            'water_total_amount' => $waterAmount,
            'grand_total_amount' => $grandTotal,
            'issue_date' => date('Y-m-d'),
            'due_date' => date('Y-m-d', strtotime('+7 days')),
            'payment_status' => 'unpaid',
        ]);

        return redirect()->route('invoices.index')->with('success', 'ออกใบแจ้งหนี้เรียบร้อยแล้ว');
    }

    public function show(Invoice $invoice)
    {
        $invoice->load(['room', 'tenant']);
        return view('invoices.show', compact('invoice'));
    }

    public function markAsPaid(Invoice $invoice)
    {
        $invoice->update([
            'payment_status' => 'paid',
            'payment_date' => date('Y-m-d H:i:s'),
            'payment_method' => 'Bank Transfer',
        ]);

        return redirect()->back()->with('success', 'บันทึกรับชำระเงินเรียบร้อยแล้ว');
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()->route('invoices.index')->with('success', 'ลบใบแจ้งหนี้เรียบร้อยแล้ว');
    }
}