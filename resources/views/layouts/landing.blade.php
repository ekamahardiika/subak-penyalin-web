<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Gabah - Penghubung Petani & Konsumen</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- Font Awesome untuk Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased">

    <!-- Header / Navbar -->
    <header class="absolute top-0 left-0 right-0 z-50 bg-transparent">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="bg-emerald-600 text-white p-2 rounded-lg shadow-md">
                    <i class="fa-solid fa-wheat-awn text-xl"></i>
                </div>
                <span class="text-xl font-bold text-white tracking-wide">Sistem<span
                        class="text-emerald-400">Gabah</span></span>
            </div>
            <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-gray-200">
                <a href="/" class="hover:text-emerald-400 transition-colors">Home</a>
                <a href="{{ route('produk') }}" class="hover:text-emerald-400 transition-colors">Katalog Produk</a>
                <a href="{{ route('tentang') }}" class="hover:text-emerald-400 transition-colors">Tentang Kami</a>
                <a href="{{ route('kontak') }}" class="hover:text-emerald-400 transition-colors">Kontak</a>
            </nav>
            <div>
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2 text-sm font-medium text-gray-200 hover:text-emerald-400 transition-colors focus:outline-none py-2 cursor-pointer">
                            <div
                                class="w-8 h-8 rounded-full bg-emerald-600 text-white font-bold flex items-center justify-center border border-emerald-500 shadow-sm">
                                {{ \Illuminate\Support\Str::upper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                            </div>
                            <span
                                class="hidden sm:inline-block max-w-[120px] truncate">{{ Auth::user()->name ?? 'Pengguna' }}</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-gray-300 transition-transform"
                                :class="open ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                            x-transition:enter-start="transform opacity-0 scale-95"
                            x-transition:enter-end="transform opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-75"
                            x-transition:leave-start="transform opacity-100 scale-100"
                            x-transition:leave-end="transform opacity-0 scale-95"
                            class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl border border-gray-100 py-1 z-50"
                            style="display: none;">

                            <div class="px-4 py-2 border-b border-gray-100">
                                <p class="text-xs text-gray-400">Masuk sebagai</p>
                                <p class="text-xs font-semibold text-gray-700 truncate">{{ Auth::user()->email }}</p>
                            </div>

                            @if (Auth::user()->isAdmin())
                                <a href="{{ route('admin.dashboard') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-colors">
                                    <i class="fa-solid fa-chart-pie text-gray-400 w-4"></i> Dashboard Admin
                                </a>
                            @elseif(Auth::user()->isPetani())
                                <a href="{{ route('petani.dashboard') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-colors">
                                    <i class="fa-solid fa-chart-pie text-gray-400 w-4"></i> Dashboard Petani
                                </a>
                            @elseif(Auth::user()->isKonsumen())
                                <a href="{{ route('konsumen.dashboard') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-colors">
                                    <i class="fa-solid fa-chart-pie text-gray-400 w-4"></i> Dashboard Saya
                                </a>
                            @endif

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
                @else
                    <a href="{{ route('login') }}"
                        class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-all shadow-lg shadow-emerald-900/30">
                        Masuk / Login
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-emerald-950 text-gray-300 pt-16 pb-8">
        <div
            class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-10 border-b border-emerald-900 pb-12 mb-8">
            <div class="md:col-span-2">
                <div class="flex items-center gap-2 mb-4">
                    <div class="bg-emerald-600 text-white p-2 rounded-lg">
                        <i class="fa-solid fa-wheat-awn text-lg"></i>
                    </div>
                    <span class="text-xl font-bold text-white">Sistem<span class="text-emerald-400">Gabah</span></span>
                </div>
                <p class="text-sm text-gray-400 max-w-sm leading-relaxed">
                    Platform digital transparan yang menjembatani hasil panen terbaik para petani lokal langsung ke
                    tangan konsumen demi kesejahteraan bersama.
                </p>
                <div class="flex gap-4 mt-6">
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-emerald-900/50 flex items-center justify-center hover:bg-emerald-600 transition-colors text-white text-sm"><i
                            class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-emerald-900/50 flex items-center justify-center hover:bg-emerald-600 transition-colors text-white text-sm"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-emerald-900/50 flex items-center justify-center hover:bg-emerald-600 transition-colors text-white text-sm"><i
                            class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm tracking-wider uppercase">Tautan Cepat</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/" class="hover:text-emerald-400 transition-colors">Beranda</a></li>
                    <li><a href="{{ route('produk') }}" class="hover:text-emerald-400 transition-colors">Produk</a>
                    </li>
                    <li><a href="{{ route('tentang') }}" class="hover:text-emerald-400 transition-colors">Tentang
                            Kami</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-emerald-400 transition-colors">Kontak</a>
                    </li>
                </ul>
            </div>
            <div>
                <h4 class="text-white font-semibold mb-4 text-sm tracking-wider uppercase">Newsletter</h4>
                <p class="text-sm text-gray-400 mb-3">Dapatkan info harga gabah terkini.</p>
                <div class="flex bg-emerald-900/40 rounded-lg p-1 border border-emerald-800">
                    <input type="email" placeholder="Email Anda"
                        class="bg-transparent px-3 py-2 text-sm w-full focus:outline-none text-white">
                    <button class="bg-emerald-600 text-white px-4 rounded-md hover:bg-emerald-500"><i
                            class="fa-solid fa-paper-plane"></i></button>
                </div>
            </div>
        </div>
        <div
            class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
            <p>&copy; 2026 Sistem Gabah. Hak Cipta Dilindungi.</p>
            <div class="flex gap-4 mt-2 md:mt-0">
                <a href="#" class="hover:underline">Kebijakan Privasi</a>
                <a href="#" class="hover:underline">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>

</body>

</html>
