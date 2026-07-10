<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HargaBroadcast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HargaBroadcastController extends Controller
{
    public function index()
    {
        $broadcasts = HargaBroadcast::with('creator')->latest()->paginate(10);
        return view('admin.harga.index', compact('broadcasts'));
    }

    public function create()
    {
        return view('admin.harga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'harga_gabah' => 'required|numeric|min:0',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        $validated['created_by'] = Auth::id();

        HargaBroadcast::create($validated);

        return redirect()->route('admin.harga.index')->with('success', 'Harga gabah berhasil dibroadcast');
    }

    public function destroy(HargaBroadcast $harga)
    {
        $harga->delete();
        return redirect()->route('admin.harga.index')->with('success', 'Broadcast berhasil dihapus');
    }
}