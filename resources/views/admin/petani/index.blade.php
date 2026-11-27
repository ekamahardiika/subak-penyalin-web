@extends('layouts.app')

@section('title', 'Petani')

@section('content')
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4 mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Daftar Akun Petani</h1>
            <p class="text-sm text-gray-500 mt-0.5">Kelola seluruh hak akses dan data profil mitra petani terdaftar.</p>
        </div>
        <div>
            <a href="{{ route('admin.petani.create') }}"
                class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2.5 rounded-xl text-xs transition-all shadow-md shadow-emerald-700/20 cursor-pointer">
                Tambah Petani Baru <i class="fa-solid fa-user-plus text-[10px]"></i>
            </a>
        </div>
    </div>

    <div x-data="{
        search: '',
        perPage: 10,
        currentPage: 1,
        petaniList: {{ \Illuminate\Support\Js::from(method_exists($petani, 'items') ? $petani->items() : $petani) }},
        get filteredPetani() {
            if (this.search.trim() === '') return this.petaniList;
            const q = this.search.toLowerCase();
            return this.petaniList.filter(p => {
                const name = p.name ? p.name.toLowerCase() : '';
                const email = p.email ? p.email.toLowerCase() : '';
                const phone = p.phone ? p.phone.toLowerCase() : '';
                return name.includes(q) || email.includes(q) || phone.includes(q);
            });
        },
        get totalPages() {
            return Math.ceil(this.filteredPetani.length / this.perPage) || 1;
        },
        get pagedPetani() {
            const start = (this.currentPage - 1) * this.perPage;
            return this.filteredPetani.slice(start, start + parseInt(this.perPage));
        }
    }" x-init="$watch('search', () => currentPage = 1);
    $watch('perPage', () => currentPage = 1);" class="space-y-4">

        <div
            class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-white p-4 rounded-xl border border-gray-100 shadow-xs">
            <div class="flex items-center gap-2 text-xs font-medium text-gray-500 w-full sm:w-auto">
                <span>Tampilkan</span>
                <div class="relative">
                    <select x-model="perPage"
                        class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-1.5 pl-3 pr-8 rounded-xl focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all cursor-pointer">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </span>
                </div>
                <span>data</span>
            </div>

            <div class="relative w-full sm:w-72">
                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </span>
                <input type="text" x-model="search" placeholder="Cari nama, email, nomor HP..."
                    class="block w-full pl-10 pr-4 py-2 bg-gray-50 border border-gray-200 rounded-xl text-xs placeholder-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
            </div>
        </div>

        <div class="bg-white rounded-xl border border-gray-100 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600">
                    <thead class="text-xs text-gray-400 uppercase tracking-wider bg-gray-50/70 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-3.5 font-bold">Nama Lengkap</th>
                            <th scope="col" class="px-6 py-3.5 font-bold">Alamat Email</th>
                            <th scope="col" class="px-6 py-3.5 font-bold">No. HP / WA</th>
                            <th scope="col" class="px-6 py-3.5 font-bold text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <template x-for="p in pagedPetani" :key="p.id">
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <td class="px-6 py-4 font-semibold text-gray-900" x-text="p.name"></td>
                                <td class="px-6 py-4 text-gray-500" x-text="p.email"></td>
                                <td class="px-6 py-4 font-mono text-gray-600" x-text="p.phone || '-'"></td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a :href="`{{ route('admin.petani.index') }}/${p.id}/edit`"
                                            class="inline-flex items-center gap-1 bg-gray-50 hover:bg-blue-50 text-gray-600 hover:text-blue-700 font-bold px-2.5 py-1.5 rounded-lg text-xs border border-gray-200 hover:border-blue-200 transition-all cursor-pointer">
                                            <i class="fa-regular fa-pen-to-square text-xs"></i> Edit
                                        </a>

                                        <form :action="`{{ route('admin.petani.index') }}/${p.id}`" method="POST"
                                            @submit.prevent="$dispatch('open-confirm-modal', {
                                                form: $el,
                                                title: 'Nonaktifkan Akun Petani?',
                                                message: `Akun petani '${p.name}' akan dinonaktifkan jika tidak memiliki sisa stok aktif.`
                                            })">
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
                        </template>

                        <tr x-show="filteredPetani.length === 0">
                            <td colspan="4" class="px-6 py-10 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-users-slash text-3xl text-gray-300"></i>
                                    <p class="text-sm">Data mitra petani tidak ditemukan atau belum terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="filteredPetani.length > 0"
            class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2 text-xs font-medium text-gray-500">
            <div>
                Menampilkan <span class="text-gray-800"
                    x-text="Math.min((currentPage - 1) * perPage + 1, filteredPetani.length)"></span>
                sampai <span class="text-gray-800" x-text="Math.min(currentPage * perPage, filteredPetani.length)"></span>
                dari <span class="text-gray-800" x-text="filteredPetani.length"></span> data
            </div>

            <div class="flex items-center gap-1">
                <button @click="currentPage = 1" :disabled="currentPage === 1"
                    class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600 disabled:opacity-40 disabled:hover:bg-transparent transition-colors cursor-pointer">
                    <i class="fa-solid fa-angles-left text-[10px]"></i>
                </button>
                <button @click="currentPage--" :disabled="currentPage === 1"
                    class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600 disabled:opacity-40 disabled:hover:bg-transparent transition-colors cursor-pointer">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                </button>

                <span class="px-3 py-1 bg-gray-50 border border-gray-200 text-gray-700 rounded-lg font-bold">
                    Halaman <span x-text="currentPage"></span> dari <span x-text="totalPages"></span>
                </span>

                <button @click="currentPage++" :disabled="currentPage === totalPages"
                    class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600 disabled:opacity-40 disabled:hover:bg-transparent transition-colors cursor-pointer">
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </button>
                <button @click="currentPage = totalPages" :disabled="currentPage === totalPages"
                    class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-100 text-gray-600 disabled:opacity-40 disabled:hover:bg-transparent transition-colors cursor-pointer">
                    <i class="fa-solid fa-angles-right text-[10px]"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
