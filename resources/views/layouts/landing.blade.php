<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Gabah - Penghubung Petani & Konsumen</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
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
                <a href="{{ route('login') }}"
                    class="bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-5 py-2.5 rounded-full transition-all shadow-lg shadow-emerald-900/30">
                    Masuk / Login
                </a>
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
                    <li><a href="{{ route('produk') }}" class="hover:text-emerald-400 transition-colors">Produk</a></li>
                    <li><a href="{{ route('tentang') }}" class="hover:text-emerald-400 transition-colors">Tentang
                            Kami</a></li>
                    <li><a href="{{ route('kontak') }}" class="hover:text-emerald-400 transition-colors">Kontak</a></li>
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
