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

<body class="font-sans antialiased bg-gray-50 text-gray-800" x-data="{ sidebarOpen: false }">
    <div class="min-h-screen flex">

        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
            class="fixed inset-y-0 left-0 z-50 w-64 bg-emerald-950 text-emerald-100 flex flex-col transition-transform duration-300 md:translate-x-0 md:static md:h-screen shrink-0 border-r border-emerald-900 shadow-xl">
            <div class="h-16 flex items-center justify-between px-6 border-b border-emerald-900/60 bg-emerald-950">
                <div class="flex items-center gap-2">
                    <div class="bg-emerald-600 text-white p-1.5 rounded-lg shadow-md">
                        <i class="fa-solid fa-wheat-awn text-sm"></i>
                    </div>
                    <span class="text-lg font-bold text-white tracking-wide">Sistem<span
                            class="text-emerald-400">Gabah</span></span>
                </div>
                <button @click="sidebarOpen = false" class="md:hidden text-emerald-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">

                @if (Auth::user()->isAdmin())
                    [cite: 774]
                    <p class="text-[11px] font-bold tracking-wider text-emerald-500 uppercase px-3 mb-2">Panel Admin</p>

                    <a href="{{ route('admin.dashboard') }}" [cite: 24]
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/dashboard') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-chart-pie w-5 text-center text-emerald-400 group-hover:text-white transition-colors"></i>
                        Dashboard Admin
                    </a>

                    <a href="{{ route('admin.users.index') }}" [cite: 25, 289]
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/users*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-users w-5 text-center text-emerald-400 group-hover:text-white transition-colors"></i>
                        Kelola Konsumen
                    </a>

                    <a href="{{ route('admin.petani.index') }}" [cite: 26, 165]
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/petani*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-tractor w-5 text-center text-emerald-400 group-hover:text-white transition-colors"></i>
                        Kelola Petani
                    </a>

                    <a href="{{ route('admin.products.index') }}" [cite: 27, 225]
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/products*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-boxes-stacked w-5 text-center text-emerald-400 group-hover:text-white transition-colors"></i>
                        Kelola Produk
                    </a>

                    <a href="{{ route('admin.harga.index') }}" [cite: 28, 82]
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/harga*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-bullhorn w-5 text-center text-emerald-400 group-hover:text-white transition-colors"></i>
                        Broadcast Harga
                    </a>

                    <a href="{{ route('admin.orders.index') }}" [cite: 29, 133]
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/orders*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-receipt w-5 text-center text-emerald-400 group-hover:text-white transition-colors"></i>
                        Semua Pesanan
                    </a>

                    <a href="{{ route('admin.laporan.index') }}" [cite: 33, 119]
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('admin/laporan*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-file-invoice-dollar w-5 text-center text-emerald-400 group-hover:text-white transition-colors"></i>
                        Laporan Rekap
                    </a>
                @endif

                @if (Auth::user()->isPetani())
                    [cite: 778]
                    <p class="text-[11px] font-bold tracking-wider text-emerald-500 uppercase px-3 mb-2">Panel Petani
                    </p>

                    <a href="{{ route('petani.dashboard') }}" [cite: 37]
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('petani/dashboard') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-chart-pie w-5 text-center text-emerald-400 group-hover:text-white transition-colors"></i>
                        Dashboard Petani
                    </a>

                    <a href="{{ route('petani.stok.index') }}" [cite: 38, 475]
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('petani/stok*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-warehouse w-5 text-center text-emerald-400 group-hover:text-white transition-colors"></i>
                        Kelola Stok Saya
                    </a>
                @endif

                @if (Auth::user()->isKonsumen())
                    [cite: 782]
                    <p class="text-[11px] font-bold tracking-wider text-emerald-500 uppercase px-3 mb-2">Panel Konsumen
                    </p>

                    <a href="{{ route('konsumen.dashboard') }}" [cite: 44]
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('konsumen/dashboard') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-chart-pie w-5 text-center text-emerald-400 group-hover:text-white transition-colors"></i>
                        Dashboard
                    </a>

                    <a href="{{ route('konsumen.products.index') }}" [cite: 45, 440]
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('konsumen/produk*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-basket-shopping w-5 text-center text-emerald-400 group-hover:text-white transition-colors"></i>
                        Belanja Gabah
                    </a>

                    <a href="{{ route('konsumen.orders.index') }}" [cite: 47, 371]
                        class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium hover:bg-emerald-900 hover:text-white transition-all group {{ Request::is('konsumen/pesanan*') ? 'bg-emerald-600 text-white font-semibold' : '' }}">
                        <i
                            class="fa-solid fa-box w-5 text-center text-emerald-400 group-hover:text-white transition-colors"></i>
                        Pesanan Saya
                    </a>
                @endif

            </nav>

            <div class="p-4 border-t border-emerald-900/60 bg-emerald-950/40 text-xs text-emerald-500 text-center">
                &copy; 2026 Sistem Gabah V.1
            </div>
        </aside>

        <div x-show="sidebarOpen" @click="sidebarOpen = false"
            class="fixed inset-0 z-40 bg-black/40 md:hidden transition-opacity" x-transition></div>

        <div class="flex-1 flex flex-col min-w-0 max-h-screen overflow-y-auto">

            <header
                class="bg-white h-16 border-b border-gray-100 flex items-center justify-between px-6 sticky top-0 z-30 shadow-xs">
                <button @click="sidebarOpen = true" class="md:hidden text-gray-600 hover:text-emerald-600">
                    <i class="fa-solid fa-bars text-xl"></i>
                </button>

                <div class="hidden md:block">
                    <h2 class="text-sm font-semibold text-gray-500">Aplikasi Panel Pengguna</h2>
                </div>

                <div class="relative" x-data="{ open: false }">
                    <button @click="open = !open"
                        class="flex items-center gap-2 text-sm font-medium text-gray-700 hover:text-emerald-600 transition-colors focus:outline-none py-2">
                        <div
                            class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-700 font-bold flex items-center justify-center border border-emerald-200">
                            {{ \Illuminate\Support\Str::upper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                        </div>
                        <span
                            class="hidden sm:inline-block max-w-[120px] truncate">{{ Auth::user()->name ?? 'Pengguna' }}</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-gray-400 transition-transform"
                            :class="open ? 'rotate-180' : ''"></i>
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
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
                                class="w-full flex items-center gap-2 px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors font-medium text-left">
                                <i class="fa-solid fa-arrow-right-from-bracket text-red-400 w-4"></i> Keluar / Logout
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            @isset($header)
                <div class="bg-white border-b border-gray-100 py-4 px-6">
                    <div class="text-xl font-bold text-gray-800">
                        {{ $header }}
                    </div>
                </div>
            @endisset

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

            <main class="p-6 flex-1">
                @yield('content')
            </main>

        </div>
    </div>
</body>

</html>
