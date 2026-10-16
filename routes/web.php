<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TenantController;
use App\Models\Invoice;
use App\Models\Room;
use App\Models\Tenant;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $totalRooms = Room::count();
    $occupiedRooms = Room::where('status', 'occupied')->count();
    
    $totalInvoices = Invoice::count();
    $totalAmountPaid = Invoice::where('payment_status', 'paid')->sum('grand_total_amount');
    $totalAmountUnpaid = Invoice::where('payment_status', 'unpaid')->sum('grand_total_amount');
    
    $paidCount = Invoice::where('payment_status', 'paid')->count();
    $unpaidCount = Invoice::where('payment_status', 'unpaid')->count();

    $recentInvoices = Invoice::with(['room', 'tenant'])->latest()->take(5)->get();

    return view('dashboard', compact(
        'totalRooms',
        'occupiedRooms',
        'totalInvoices',
        'totalAmountPaid',
        'totalAmountUnpaid',
        'paidCount',
        'unpaidCount',
        'recentInvoices'
    ));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('rooms', RoomController::class);
    Route::resource('invoices', InvoiceController::class);
    Route::resource('tenants', TenantController::class);
    
    Route::patch('/invoices/{invoice}/mark-as-paid', [InvoiceController::class, 'markAsPaid'])->name('invoices.markAsPaid');
});

require __DIR__.'/auth.php';