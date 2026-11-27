@extends('layouts.app')

@section('title', 'Konsumen')

@section('content')
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

    <div x-data="{
        search: '',
        perPage: 10,
        currentPage: 1,
        users: {{ \Illuminate\Support\Js::from(method_exists($users, 'items') ? $users->items() : $users) }},
    
        get filteredUsers() {
            if (this.search.trim() === '') {
                return this.users;
            }
            const q = this.search.toLowerCase();
            return this.users.filter(u => {
                return (u.name && u.name.toLowerCase().includes(q)) ||
                    (u.email && u.email.toLowerCase().includes(q)) ||
                    (u.phone && u.phone.toLowerCase().includes(q));
            });
        },
    
        get totalPages() {
            return Math.ceil(this.filteredUsers.length / this.perPage) || 1;
        },
    
        get pagedUsers() {
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + parseInt(this.perPage);
            return this.filteredUsers.slice(start, end);
        },
    
        init() {
            this.$watch('search', () => this.currentPage = 1);
            this.$watch('perPage', () => this.currentPage = 1);
        }
    }" class="space-y-4">

        <div
            class="bg-white p-4 rounded-2xl border border-gray-100 shadow-xs flex flex-col md:flex-row items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-xs font-medium text-gray-500 w-full md:w-auto">
                <span>Tampilkan</span>
                <div class="relative">
                    <select x-model="perPage"
                        class="appearance-none bg-gray-50 border border-gray-200 text-gray-700 py-1.5 pl-3 pr-8 rounded-xl focus:outline-hidden focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all cursor-pointer">
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-chevron-down text-[10px]"></i>
                    </span>
                </div>
                <span>entri</span>
            </div>

            <div class="relative w-full md:w-72">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-gray-400">
                    <i class="fa-solid fa-magnifying-glass text-xs"></i>
                </span>
                <input x-model="search" type="text" placeholder="Cari nama, email, atau telepon..."
                    class="w-full bg-gray-50 border border-gray-200 text-xs pl-9 pr-4 py-2.5 rounded-xl focus:outline-hidden focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 text-gray-700 transition-all placeholder:text-gray-400" />
                <button x-show="search.length > 0" @click="search = ''"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-circle-xmark text-xs"></i>
                </button>
            </div>
        </div>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left text-gray-600 table-fixed sm:table-auto">
                    <thead class="text-xs text-gray-400 uppercase tracking-wider bg-gray-50/70 border-b border-gray-100">
                        <tr>
                            <th scope="col" class="px-6 py-4 font-bold w-1/3">Nama Lengkap</th>
                            <th scope="col" class="px-6 py-4 font-bold w-1/3">Alamat Email</th>
                            <th scope="col" class="px-6 py-4 font-bold w-1/4">No. Telepon</th>
                            <th scope="col" class="px-6 py-4 font-bold text-center w-28">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <template x-for="u in pagedUsers" :key="u.id">
                            <tr class="hover:bg-emerald-50/10 transition-colors">
                                <td class="px-6 py-4 font-semibold text-gray-900 truncate" x-text="u.name"></td>
                                <td class="px-6 py-4 text-gray-500 truncate" x-text="u.email"></td>
                                <td class="px-6 py-4 font-mono text-gray-600" x-text="u.phone ? u.phone : '-'"></td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center gap-2">
                                        <a :href="`{{ url('admin/users') }}/${u.id}/edit`"
                                            class="inline-flex items-center gap-1 bg-gray-50 hover:bg-emerald-50 text-gray-600 hover:text-emerald-700 font-bold px-2.5 py-1.5 rounded-xl text-xs border border-gray-200 hover:border-emerald-200 transition-all cursor-pointer">
                                            <i class="fa-regular fa-pen-to-square text-xs"></i> <span
                                                class="hidden sm:inline">Edit</span>
                                        </a>

                                        <form :action="`{{ url('admin/users') }}/${u.id}`" method="POST"
                                            @submit.prevent="$dispatch('open-confirm-modal', {
                                                form: $el,
                                                title: 'Nonaktifkan Konsumen?',
                                                message: `Akun konsumen '${u.name}' akan dinonaktifkan jika tidak memiliki pesanan yang sedang diproses.`
                                            })">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="inline-flex items-center gap-1 bg-red-50 hover:bg-red-100 text-red-500 hover:text-red-700 text-xs font-bold transition-all border border-red-200/50 px-2.5 py-1.5 rounded-xl cursor-pointer">
                                                <i class="fa-regular fa-trash-can text-xs"></i> <span
                                                    class="hidden sm:inline">Hapus</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        </template>

                        <tr x-show="filteredUsers.length === 0">
                            <td colspan="4" class="px-6 py-12 text-center text-gray-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-users-slash text-3xl text-gray-300"></i>
                                    <p class="text-sm">Tidak menemukan data konsumen yang cocok.</p>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div x-show="filteredUsers.length > 0"
            class="flex flex-col sm:flex-row items-center justify-between gap-4 pt-2 text-xs font-medium text-gray-500">
            <div>
                Menampilkan <span class="text-gray-800"
                    x-text="Math.min((currentPage - 1) * perPage + 1, filteredUsers.length)"></span>
                sampai <span class="text-gray-800" x-text="Math.min(currentPage * perPage, filteredUsers.length)"></span>
                dari <span class="text-gray-800" x-text="filteredUsers.length"></span> entri
            </div>

            <div class="inline-flex items-center gap-1 bg-white p-1 rounded-xl border border-gray-100 shadow-2xs">
                <button @click="currentPage = 1" :disabled="currentPage === 1"
                    class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-50 text-gray-600 disabled:opacity-40 disabled:hover:bg-transparent transition-colors cursor-pointer">
                    <i class="fa-solid fa-angles-left text-[10px]"></i>
                </button>
                <button @click="currentPage--" :disabled="currentPage === 1"
                    class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-50 text-gray-600 disabled:opacity-40 disabled:hover:bg-transparent transition-colors cursor-pointer">
                    <i class="fa-solid fa-chevron-left text-[10px]"></i>
                </button>

                <span class="px-3 text-gray-700">
                    Halaman <span class="font-bold text-emerald-700" x-text="currentPage"></span> dari <span
                        x-text="totalPages"></span>
                </span>

                <button @click="currentPage++" :disabled="currentPage === totalPages"
                    class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-50 text-gray-600 disabled:opacity-40 disabled:hover:bg-transparent transition-colors cursor-pointer">
                    <i class="fa-solid fa-chevron-right text-[10px]"></i>
                </button>
                <button @click="currentPage = totalPages" :disabled="currentPage === totalPages"
                    class="w-7 h-7 flex items-center justify-center rounded-lg hover:bg-gray-50 text-gray-600 disabled:opacity-40 disabled:hover:bg-transparent transition-colors cursor-pointer">
                    <i class="fa-solid fa-angles-right text-[10px]"></i>
                </button>
            </div>
        </div>
    </div>
@endsection
