<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PetaniController extends Controller
{
    public function index()
    {
        $petani = User::where('role', 'petani')->latest()->paginate(10);
        return view('admin.petani.index', compact('petani'));
    }

    public function create()
    {
        return view('admin.petani.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'phone' => 'nullable|string|max:20',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone' => $validated['phone'] ?? null,
            'role' => 'petani',
        ]);

        return redirect()->route('admin.petani.index')->with('success', 'Petani berhasil ditambahkan');
    }

    public function edit(User $petani)
    {
        return view('admin.petani.edit', compact('petani'));
    }

    public function update(Request $request, User $petani)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $petani->id,
            'password' => 'nullable|min:6',
            'phone' => 'nullable|string|max:20',
        ]);

        $petani->name = $validated['name'];
        $petani->email = $validated['email'];
        $petani->phone = $validated['phone'] ?? null;

        if (!empty($validated['password'])) {
            $petani->password = Hash::make($validated['password']);
        }

        $petani->save();

        return redirect()->route('admin.petani.index')->with('success', 'Petani berhasil diupdate');
    }

    public function destroy(User $petani)
    {
        $petani->delete();
        return redirect()->route('admin.petani.index')->with('success', 'Petani berhasil dinonaktifkan');
    }
}