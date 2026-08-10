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

    // app/Http/Controllers/Admin/HargaBroadcastController.php

    public function store(Request $request)
    {
        $validated = $request->validate([
            'harga_gabah' => 'required|numeric|min:0',
            'sumber' => 'required|in:hpp_pemerintah,harga_pasar,lainnya',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        $validated['created_by'] = Auth::id();

        HargaBroadcast::create($validated);

        return redirect()->route('admin.harga.index')->with('success', 'Harga acuan berhasil disiarkan');
    }

    public function update(Request $request, HargaBroadcast $harga)
    {
        $validated = $request->validate([
            'harga_gabah' => 'required|numeric|min:0',
            'sumber' => 'required|in:hpp_pemerintah,harga_pasar,lainnya',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        $harga->update($validated);

        return redirect()->route('admin.harga.index')->with('success', 'Harga acuan berhasil diperbarui');
    }

    public function edit(HargaBroadcast $harga)
    {
        return view('admin.harga.edit', compact('harga'));
    }

    public function destroy(HargaBroadcast $harga)
    {
        $harga->delete();

        return redirect()->route('admin.harga.index')->with('success', 'Broadcast berhasil dihapus');
    }
}
