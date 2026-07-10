@extends('layouts.app')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Riwayat Broadcast Harga</h1>
            <p class="text-sm text-gray-500 mt-0.5">Daftar arsip penyesuaian nilai acuan komoditas gabah platform.</p>
        </div>
        <div>
            <a href="{{ route('admin.harga.create') }}"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2.5 rounded-xl text-xs transition-all shadow-md shadow-emerald-700/20 cursor-pointer">
                Buat Broadcast Baru <i class="fa-solid fa-plus text-[10px]"></i>
            </a>
        </div>
    </div>

    <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-gray-600">
                <thead class="text-xs text-gray-400 uppercase tracking-wider bg-gray-50/70 border-b border-gray-100">
                    <tr>
                        <th scope="col" class="px-6 py-3.5 font-bold">Tanggal</th>
                        <th scope="col" class="px-6 py-3.5 font-bold">Harga Acuan / KG</th>
                        <th scope="col" class="px-6 py-3.5 font-bold">Keterangan</th>
                        <th scope="col" class="px-6 py-3.5 font-bold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($broadcasts as $b)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') }}
                            </td>
                            <td class="px-6 py-4 font-bold text-emerald-600">
                                Rp {{ number_format($b->harga_gabah, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-gray-500 max-w-xs truncate">
                                {{ $b->keterangan ?? '-' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <form action="{{ route('admin.harga.destroy', $b->id) }}" method="POST"
                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data broadcast ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="inline-flex items-center gap-1 text-red-500 hover:text-red-700 text-xs font-bold transition-colors cursor-pointer bg-red-50 hover:bg-red-100 px-2.5 py-1.5 rounded-lg border border-red-200/50">
                                        <i class="fa-regular fa-trash-can text-xs"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-bullhorn text-3xl text-gray-300"></i>
                                    <p class="text-sm">Belum ada riwayat penyiaran harga.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        {{ $broadcasts->links() }}
    </div>
@endsection
