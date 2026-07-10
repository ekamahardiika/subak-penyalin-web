<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- Menggunakan Alpine.js x-init untuk membaca state dari localStorage agar tidak reset saat pindah menu -->

<body class="font-sans antialiased bg-gray-50 text-gray-800" x-data="{
    mobileOpen: false,
    desktopExpanded: localStorage.getItem('sidebarExpanded') !== 'false'
}" x-init="$watch('desktopExpanded', val => localStorage.setItem('sidebarExpanded', val))">

    <div class="min-h-screen flex">

        <!-- ASIDE SIDEBAR -->
        <aside
            :class="[
                mobileOpen ? 'translate-x-0' : '-translate-x-full',
                desktopExpanded ? 'md:w-64' : 'md:w-20'
            ]"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-emerald-950 text-emerald-100 flex flex-col transition-all duration-200 md:translate-x-0 md:static md:h-screen shrink-0 border-r border-emerald-900 shadow-xl">

            <!-- Header Sidebar (Logo & Brand) -->
            <div class="h-16 flex items-center border-b border-emerald-900/60 bg-emerald-950 overflow-hidden"
                :class="desktopExpanded ? 'justify-between px-4' : 'justify-center px-0'">

                <div class="flex items-center gap-2.5">
                    <div
                        class="bg-emerald-600 text-white p-1.5 rounded-xl shadow-md shrink-0 flex items-center justify-center w-9 h-9">
                        <i class="fa-solid fa-wheat-awn text-sm"></i>
                    </div>
                    <span x-show="desktopExpanded" class="text-lg font-bold text-white tracking-wide whitespace-nowrap">
                        Sistem<span class="text-emerald-400">Gabah</span>
                    </span>
                </div>

                <button @click="mobileOpen = false" class="md:hidden text-emerald-400 hover:text-white px-2">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <!-- Navigasi Menu Utama -->
            <nav class="flex-1 py-6 space-y-2 overflow-y-auto no-scrollbar" :class="desktopExpanded ? 'px-3' : 'px-2'">

                @if (Auth::user()->isAdmin())
                    <div class="mb-2" :class="desktopExpanded ? 'px-3' : 'px-0 flex justify-center'">
                        <p x-show="desktopExpanded"
                            class="text-[10px] font-bold tracking-wider text-emerald-500 uppercase">Panel Admin</p>
                        <hr x-show="!desktopExpanded" class="border-emerald-900 w-8 transition-all">
                    </div>

                    <!-- Menu Dashboard -->
                    <a href="{{ route('admin.dashboard') }}" title="Dashboard Admin"
                        :class="desktopExpanded ? 'px-3 justify-start gap-3' : 'px-0 justify-center'"
                        class="flex items-center h-10 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/dashboard') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-chart-pie w-5 text-center text-emerald-400 group-hover:text-white transition-colors shrink-0"></i>
                        <span x-show="desktopExpanded" class="whitespace-nowrap">Dashboard Admin</span>
                    </a>

                    <!-- Menu Kelola Konsumen -->
                    <a href="{{ route('admin.users.index') }}" title="Kelola Konsumen"
                        :class="desktopExpanded ? 'px-3 justify-start gap-3' : 'px-0 justify-center'"
                        class="flex items-center h-10 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/users*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-users w-5 text-center text-emerald-400 group-hover:text-white transition-colors shrink-0"></i>
                        <span x-show="desktopExpanded" class="whitespace-nowrap">Kelola Konsumen</span>
                    </a>

                    <!-- Menu Kelola Petani -->
                    <a href="{{ route('admin.petani.index') }}" title="Kelola Petani"
                        :class="desktopExpanded ? 'px-3 justify-start gap-3' : 'px-0 justify-center'"
                        class="flex items-center h-10 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/petani*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-tractor w-5 text-center text-emerald-400 group-hover:text-white transition-colors shrink-0"></i>
                        <span x-show="desktopExpanded" class="whitespace-nowrap">Kelola Petani</span>
                    </a>

                    <!-- Menu Kelola Produk -->
                    <a href="{{ route('admin.products.index') }}" title="Kelola Produk"
                        :class="desktopExpanded ? 'px-3 justify-start gap-3' : 'px-0 justify-center'"
                        class="flex items-center h-10 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/products*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-boxes-stacked w-5 text-center text-emerald-400 group-hover:text-white transition-colors shrink-0"></i>
                        <span x-show="desktopExpanded" class="whitespace-nowrap">Kelola Produk</span>
                    </a>

                    <!-- Menu Broadcast Harga -->
                    <a href="{{ route('admin.harga.index') }}" title="Broadcast Harga"
                        :class="desktopExpanded ? 'px-3 justify-start gap-3' : 'px-0 justify-center'"
                        class="flex items-center h-10 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/harga*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-bullhorn w-5 text-center text-emerald-400 group-hover:text-white transition-colors shrink-0"></i>
                        <span x-show="desktopExpanded" class="whitespace-nowrap">Broadcast Harga</span>
                    </a>

                    <!-- Menu Semua Pesanan -->
                    <a href="{{ route('admin.orders.index') }}" title="Semua Pesanan"
                        :class="desktopExpanded ? 'px-3 justify-start gap-3' : 'px-0 justify-center'"
                        class="flex items-center h-10 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/orders*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-receipt w-5 text-center text-emerald-400 group-hover:text-white transition-colors shrink-0"></i>
                        <span x-show="desktopExpanded" class="whitespace-nowrap">Semua Pesanan</span>
                    </a>

                    <!-- Menu Laporan Rekap -->
                    <a href="{{ route('admin.laporan.index') }}" title="Laporan Rekap"
                        :class="desktopExpanded ? 'px-3 justify-start gap-3' : 'px-0 justify-center'"
                        class="flex items-center h-10 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/laporan*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-file-invoice-dollar w-5 text-center text-emerald-400 group-hover:text-white transition-colors shrink-0"></i>
                        <span x-show="desktopExpanded" class="whitespace-nowrap">Laporan Rekap</span>
                    </a>
                @endif

                @if (Auth::user()->isPetani())
                    <div class="mb-2" :class="desktopExpanded ? 'px-3' : 'px-0 flex justify-center'">
                        <p x-show="desktopExpanded"
                            class="text-[10px] font-bold tracking-wider text-emerald-500 uppercase">Panel Petani</p>
                        <hr x-show="!desktopExpanded" class="border-emerald-900 w-8 transition-all">
                    </div>

                    <a href="{{ route('petani.dashboard') }}" title="Dashboard Petani"
                        :class="desktopExpanded ? 'px-3 justify-start gap-3' : 'px-0 justify-center'"
                        class="flex items-center h-10 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('petani/dashboard') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-chart-pie w-5 text-center text-emerald-400 group-hover:text-white transition-colors shrink-0"></i>
                        <span x-show="desktopExpanded" class="whitespace-nowrap">Dashboard Petani</span>
                    </a>

                    <a href="{{ route('petani.stok.index') }}" title="Kelola Stok Saya"
                        :class="desktopExpanded ? 'px-3 justify-start gap-3' : 'px-0 justify-center'"
                        class="flex items-center h-10 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('petani/stok*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-warehouse w-5 text-center text-emerald-400 group-hover:text-white transition-colors shrink-0"></i>
                        <span x-show="desktopExpanded" class="whitespace-nowrap">Kelola Stok Saya</span>
                    </a>
                @endif

                @if (Auth::user()->isKonsumen())
                    <div class="mb-2" :class="desktopExpanded ? 'px-3' : 'px-0 flex justify-center'">
                        <p x-show="desktopExpanded"
                            class="text-[10px] font-bold tracking-wider text-emerald-500 uppercase">Panel Konsumen</p>
                        <hr x-show="!desktopExpanded" class="border-emerald-900 w-8 transition-all">
                    </div>

                    <a href="{{ route('konsumen.dashboard') }}" title="Dashboard"
                        :class="desktopExpanded ? 'px-3 justify-start gap-3' : 'px-0 justify-center'"
                        class="flex items-center h-10 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('konsumen/dashboard') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-chart-pie w-5 text-center text-emerald-400 group-hover:text-white transition-colors shrink-0"></i>
                        <span x-show="desktopExpanded" class="whitespace-nowrap">Dashboard</span>
                    </a>

                    <a href="{{ route('konsumen.products.index') }}" title="Belanja Gabah"
                        :class="desktopExpanded ? 'px-3 justify-start gap-3' : 'px-0 justify-center'"
                        class="flex items-center h-10 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('konsumen/produk*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-basket-shopping w-5 text-center text-emerald-400 group-hover:text-white transition-colors shrink-0"></i>
                        <span x-show="desktopExpanded" class="whitespace-nowrap">Belanja Gabah</span>
                    </a>

                    <a href="{{ route('konsumen.orders.index') }}" title="Pesanan Saya"
                        :class="desktopExpanded ? 'px-3 justify-start gap-3' : 'px-0 justify-center'"
                        class="flex items-center h-10 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('konsumen/pesanan*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-box w-5 text-center text-emerald-400 group-hover:text-white transition-colors shrink-0"></i>
                        <span x-show="desktopExpanded" class="whitespace-nowrap">Pesanan Saya</span>
                    </a>
                @endif

            </nav>

            <!-- Footer Sidebar Copyright -->
            <div
                class="h-12 flex items-center justify-center border-t border-emerald-900/60 bg-emerald-950/40 text-xs text-emerald-500 overflow-hidden whitespace-nowrap px-2">
                <span x-show="desktopExpanded">&copy; 2026 Sistem Gabah V.1</span>
                <span x-show="!desktopExpanded" class="font-bold text-emerald-400">V.1</span>
            </div>
        </aside>

        <!-- Overlay Mobile -->
        <div x-show="mobileOpen" @click="mobileOpen = false"
            class="fixed inset-0 z-40 bg-black/40 md:hidden transition-opacity" x-transition></div>

        <!-- MAIN LAYOUT WRAPPER -->
        <div class="flex-1 flex flex-col min-w-0 max-h-screen overflow-y-auto">

            <!-- NAVBAR / HEADER -->
            <header
                class="bg-white h-16 border-b border-gray-100 flex items-center justify-between px-6 sticky top-0 z-30 shadow-xs">

                <div class="flex items-center gap-4">
                    <!-- Hamburger Mobile Trigger -->
                    <button @click="mobileOpen = true" class="md:hidden text-gray-600 hover:text-emerald-600">
                        <i class="fa-solid fa-bars text-xl"></i>
                    </button>

                    <!-- Minimize/Maximize Trigger Desktop -->
                    <button @click="desktopExpanded = !desktopExpanded"
                        class="hidden md:inline-flex text-gray-400 hover:text-emerald-600 w-9 h-9 items-center justify-center rounded-xl bg-gray-50 border border-gray-100 transition-colors cursor-pointer">
                        <i class="fa-solid text-sm" :class="desktopExpanded ? 'fa-outdent' : 'fa-indent'"></i>
                    </button>

                    <div class="hidden sm:block">
                        <h2 class="text-sm font-semibold text-gray-500">Aplikasi Panel Pengguna</h2>
                    </div>
                </div>

                <!-- Dropdown Profil -->
                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-emerald-600 transition-colors focus:outline-none py-2 cursor-pointer">
                        <div
                            class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center border border-emerald-200">
                            {{ \Illuminate\Support\Str::upper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <span
                            class="hidden sm:inline-block max-w-[120px] truncate">{{ Auth::user()->name ?? 'Pengguna' }}</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 transition-transform"
                            :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" @click.away="open = false"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95"
                        class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-1"
                        style="display: none;">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-xs text-gray-400">Masuk sebagai</p>
                            <p class="text-sm font-semibold text-gray-700 truncate">
                                {{ Auth::user()->email ?? 'user@gabah.com' }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}"
                            class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-colors">
                            <i class="fa-regular fa-user text-gray-400 w-4"></i> Profile Saya
                        </a>

                        <div class="border-t border-gray-100 my-1"></div>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium text-left cursor-pointer">
                                <i class="fa-solid fa-arrow-right-from-bracket text-red-400 w-4"></i> Keluar / Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Dynamic Header Slot -->
            @isset($header)
                <div class="bg-white border-b border-gray-100 py-4 px-6">
                    <div class="text-xl font-bold text-gray-800">
                        {{ $header }}
                    </div>
                </div>
            @endisset

            <!-- Flash Session Alerts -->
            <div class="px-6 mt-4">
                @if (session('success'))
                    <div
                        class="bg-emerald-50 border border-emerald-200 text-emerald-800 px-4 py-3 rounded-xl flex items-center gap-3 text-sm">
                        <i class="fa-solid fa-circle-check text-emerald-500 text-base"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif
                @if (session('error'))
                    <div
                        class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-xl flex items-center gap-3 text-sm">
                        <i class="fa-solid fa-circle-exclamation text-red-500 text-base"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                @endif
            </div>

            <!-- Main Yield Content -->
            <main class="p-6 flex-1">
                @yield('content')
            </main>

        </div>
    </div>
</body>

</html>
