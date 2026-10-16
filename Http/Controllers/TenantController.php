<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Room;
use Illuminate\Http\Request;

class TenantController extends Controller
{
    public function index()
    {
        $tenants = Tenant::with('room')->latest()->get();
        return view('tenants.index', compact('tenants'));
    }

    public function create()
    {
        $rooms = Room::where('status', 'vacant')->get();
        return view('tenants.create', compact('rooms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'room_id' => 'required|exists:rooms,id',
        ]);

        Tenant::create($request->all());

        Room::where('id', $request->room_id)->update(['status' => 'occupied']);

        return redirect()->route('tenants.index')->with('success', 'บันทึกข้อมูลผู้เช่าและจัดสรรห้องพักเรียบร้อยแล้ว');
    }

    public function show(Tenant $tenant)
    {
        $tenant->load('room', 'invoices');
        return view('tenants.show', compact('tenant'));
    }

    public function edit(Tenant $tenant)
    {
        return view('tenants.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $tenant->update($request->all());

        return redirect()->route('tenants.index')->with('success', 'แก้ไขข้อมูลผู้เช่าเรียบร้อยแล้ว');
    }

    public function destroy(Tenant $tenant)
    {
        if ($tenant->room_id) {
            Room::where('id', $tenant->room_id)->update(['status' => 'vacant']);
        }
        $tenant->delete();

        return redirect()->route('tenants.index')->with('success', 'ลบข้อมูลผู้เช่าเรียบร้อยแล้ว');
    }
}