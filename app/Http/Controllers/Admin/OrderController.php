<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('user', 'items.product');
        return view('admin.orders.show', compact('order'));
    }

    public function confirm(Order $order)
    {
        $order->update(['status' => 'dikonfirmasi']);
        return back()->with('success', 'Pesanan berhasil dikonfirmasi');
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,dikonfirmasi,diproses,selesai,dibatalkan',
        ]);

        $order->update($validated);

        return back()->with('success', 'Status pesanan berhasil diupdate');
    }
}