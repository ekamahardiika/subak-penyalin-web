<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Subak Penyalin') - Subak Penyalin</title>
    <link rel="icon" type="image/png" href="{{ asset('logo/Logo1.png') }}">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="icon" type="image/png" href="{{ asset('logo/Logo1.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* FIX: scroll halus saat pindah section via anchor navbar, bukan lompat instan */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gray-50 text-gray-800 font-sans antialiased" x-data="{
    activeSection: 'home',
    isTop: true,
    init() {
        const sections = ['home', 'tentang', 'produk', 'kontak'];
        window.addEventListener('scroll', () => {
            // Cek apakah posisi scroll masih di paling atas (Hero)
            this.isTop = window.scrollY < 50;

            let current = 'home';
            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el && window.scrollY >= (el.offsetTop - 120)) {
                    current = id;
                }
            });
            this.activeSection = current;
        });
    }
}">

    <header class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 py-4 border-b"
        :class="isTop ? 'bg-transparent border-transparent' : 'bg-green-950 border-white/5 shadow-md'">

        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">

            <a href="{{ route('home') }}#home" class="flex items-center gap-2.5">
                <img src="{{ asset('logo/Logo1.png') }}" alt="Subak Penyalin Logo" class="w-12 h-12 object-contain">
                <span class="text-xl font-black text-white tracking-wide uppercase">Subak Penyalin</span>
            </a>

            <nav class="hidden md:flex items-center gap-1 border px-2 py-1.5 rounded-full text-xs font-semibold transition-all duration-300"
                :class="isTop ? 'bg-black/20 border-white/10 text-gray-200' : 'bg-green-900/40 border-white/5 text-gray-300'">

                <a href="#home" @click="activeSection = 'home'"
                    :class="activeSection === 'home' ? 'bg-green-400 text-green-950 font-bold' :
                        'hover:text-white text-gray-300'"
                    class="px-4 py-2 rounded-full transition-all duration-300">Beranda</a>

                <a href="#tentang" @click="activeSection = 'tentang'"
                    :class="activeSection === 'tentang' ? 'bg-green-400 text-green-950 font-bold' :
                        'hover:text-white text-gray-300'"
                    class="px-4 py-2 rounded-full transition-all duration-300">Tentang Kami</a>

                <a href="#produk" @click="activeSection = 'produk'"
                    :class="activeSection === 'produk' ? 'bg-green-400 text-green-950 font-bold' :
                        'hover:text-white text-gray-300'"
                    class="px-4 py-2 rounded-full transition-all duration-300">Gabah</a>

                <a href="#kontak" @click="activeSection = 'kontak'"
                    :class="activeSection === 'kontak' ? 'bg-green-400 text-green-950 font-bold' :
                        'hover:text-white text-gray-300'"
                    class="px-4 py-2 rounded-full transition-all duration-300">Kontak</a>
            </nav>

            <div class="flex items-center">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open"
                            class="flex items-center gap-2 text-sm font-medium text-gray-200 hover:text-green-400 transition-colors focus:outline-none py-2 cursor-pointer">
                            <div
                                class="w-8 h-8 rounded-full bg-green-400 text-green-950 font-bold flex items-center justify-center border border-green-300 shadow-sm">
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
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-green-700 transition-colors">
                                    <i class="fa-solid fa-chart-pie text-gray-400 w-4"></i> Dashboard Admin
                                </a>
                            @elseif(Auth::user()->isPetani())
                                <a href="{{ route('petani.dashboard') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-green-700 transition-colors">
                                    <i class="fa-solid fa-chart-pie text-gray-400 w-4"></i> Dashboard Petani
                                </a>
                            @elseif(Auth::user()->isKonsumen())
                                <a href="{{ route('konsumen.dashboard') }}"
                                    class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-green-700 transition-colors">
                                    <i class="fa-solid fa-chart-pie text-gray-400 w-4"></i> Dashboard Saya
                                </a>
                            @endif

                            <a href="{{ route('profile.edit') }}"
                                class="flex items-center gap-2 px-4 py-2 text-sm text-gray-600 hover:bg-gray-50 hover:text-green-700 transition-colors">
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
                        class="bg-green-400 hover:bg-green-500 text-green-950 text-xs font-bold px-5 py-2.5 rounded-full transition-all flex items-center gap-3 group shadow-lg shadow-green-400/10">
                        Login
                        <span
                            class="w-5 h-5 bg-green-950 text-green-400 rounded-full flex items-center justify-center group-hover:translate-x-0.5 transition-transform">
                            <i class="fa-solid fa-arrow-right text-[9px]"></i>
                        </span>
                    </a>
                @endauth
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>

    <footer class="bg-green-950 text-gray-300 pt-20 pb-8">
        <div
            class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12 border-b border-green-900/60 pb-16 mb-8">
            <div class="md:col-span-2 space-y-4">
                <a href="{{ route('home') }}#home" class="flex items-center gap-2.5">
                    <img src="{{ asset('logo/Logo1.png') }}" alt="Subak Penyalin Logo"
                        class="w-12 h-12 object-contain">
                    <span class="text-xl font-black text-white tracking-wide uppercase">Subak Penyalin</span>
                </a>
                <p class="text-sm text-gray-400 max-w-xl leading-relaxed">
                    Platform digital transparan yang menjembatani hasil panen terbaik para petani lokal langsung ke
                    tangan konsumen demi kesejahteraan bersama.
                </p>
                <div class="flex gap-4 pt-2">
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-white/5 flex items-center justify-center hover:bg-green-400 hover:text-green-950 transition-all text-white text-sm"><i
                            class="fa-brands fa-facebook-f"></i></a>
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-white/5 flex items-center justify-center hover:bg-green-400 hover:text-green-950 transition-all text-white text-sm"><i
                            class="fa-brands fa-instagram"></i></a>
                    <a href="#"
                        class="w-9 h-9 rounded-full bg-white/5 flex items-center justify-center hover:bg-green-400 hover:text-green-950 transition-all text-white text-sm"><i
                            class="fa-brands fa-whatsapp"></i></a>
                </div>
            </div>
            <div>
                <h4 class="text-white font-bold mb-4 text-xs tracking-wider uppercase">Tautan Cepat</h4>
                <ul class="space-y-2.5 text-sm text-gray-400">
                    <li><a href="#home" class="hover:text-green-400 transition-colors">Beranda</a></li>
                    <li><a href="#produk" class="hover:text-green-400 transition-colors">Gabah</a></li>
                    <li><a href="#tentang" class="hover:text-green-400 transition-colors">Tentang Kami</a></li>
                    <li><a href="#kontak" class="hover:text-green-400 transition-colors">Kontak</a></li>
                </ul>
            </div>
        </div>
        <div
            class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center text-xs text-gray-500">
            <p>&copy; 2026 Sistem Gabah. Hak Cipta Dilindungi.</p>
            <div class="flex gap-6 mt-3 md:mt-0">
                <a href="#" class="hover:text-gray-400 transition-colors">Kebijakan Privasi</a>
                <a href="#" class="hover:text-gray-400 transition-colors">Syarat & Ketentuan</a>
            </div>
        </div>
    </footer>

</body>

</html>
