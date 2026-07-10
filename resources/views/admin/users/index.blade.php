@extends('layouts.app')

@section('content')
    <!-- Top Bar Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Daftar Akun Konsumen</h1>
            <p class="text-sm text-gray-500 mt-0.5">Kelola data informasi profil dan validasi akun konsumen pembeli gabah.
            </p>
        </div>
        <div>
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2.5 rounded-xl text-xs transition-all shadow-md shadow-emerald-700/20 cursor-pointer">
                Tambah Konsumen <i class="fa-solid fa-user-plus text-[10px]"></i>
            </a>
        </div>
    </div>

    <!-- Container Data Tabel -->
    <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-400 uppercase tracking-wider bg-gray-50/70 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 font-bold">Nama Lengkap</th>
                        <th scope="col" class="px-6 py-3.5 font-bold">Alamat Email</th>
                        <th scope="col" class="px-6 py-3.5 font-bold">No. Telepon</th>
                        <th scope="col" class="px-6 py-3.5 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($users as $u)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $u->name }}
                            </td>
                            <td class="px-6 py-4 text-gray-500">
                                {{ $u->email }}
                            </td>
                            <td class="px-6 py-4 font-mono text-gray-600">
                                {{ $u->phone ?? '-' }}
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.users.edit', $u->id) }}"
                                        class="inline-flex items-center gap-1 bg-gray-50 hover:bg-blue-50 text-gray-600 hover:text-blue-700 font-bold px-2.5 py-1.5 rounded-lg text-xs border border-gray-200 hover:border-blue-200 transition-all cursor-pointer">
                                        <i class="fa-regular fa-pen-to-square text-xs"></i> Edit
                                    </a>

                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus permanen akun konsumen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-700 text-xs font-bold transition-all border border-red-200/50 px-2.5 py-1.5 rounded-lg cursor-pointer">
                                            <i class="fa-regular fa-trash-can text-xs"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-users-slash text-3xl text-gray-300"></i>
                                    <p class="text-sm">Belum ada data akun konsumen terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection
