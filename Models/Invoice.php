<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $guarded = []; // อนุญาตให้บันทึกได้ทุกฟิลด์โดยไม่มีข้อจำกัด

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}