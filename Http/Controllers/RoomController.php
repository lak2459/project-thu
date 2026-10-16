<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::latest()->get();
        return view('rooms.index', compact('rooms'));
    }

    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number',
            'monthly_rent' => 'required|numeric|min:0',
        ]);

        Room::create($request->all());

        return redirect()->route('rooms.index')->with('success', 'เพิ่มห้องพักใหม่เรียบร้อยแล้ว');
    }

    public function show(Room $room)
    {
        $room->load(['tenants', 'invoices']);
        return view('rooms.show', compact('room'));
    }

    public function edit(Room $room)
    {
        return view('rooms.edit', compact('room'));
    }

    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number' => 'required|unique:rooms,room_number,' . $room->id,
            'monthly_rent' => 'required|numeric|min:0',
        ]);

        $room->update($request->all());

        return redirect()->route('rooms.index')->with('success', 'อัปเดตข้อมูลห้องพักเรียบร้อยแล้ว');
    }

    public function destroy(Room $room)
    {
        $room->delete();
        return redirect()->route('rooms.index')->with('success', 'ลบห้องพักเรียบร้อยแล้ว');
    }
}