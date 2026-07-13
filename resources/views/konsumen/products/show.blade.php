@extends('layouts.app')

@section('content')
    <div x-data="productDetail()" x-init="init()">

        <a href="{{ route('konsumen.products.index') }}"
            class="inline-flex items-center gap-1.5 text-xs font-bold text-gray-500 hover:text-emerald-700 mb-4 transition-colors">
            <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Daftar Produk
        </a>

        <div class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden grid grid-cols-1 md:grid-cols-2">
            <div class="h-64 md:h-full bg-gray-100">
                @if ($product->gambar_url)
                    <img src="{{ $product->gambar_url }}" alt="{{ $product->nama_produk }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                        <i class="fa-solid fa-wheat-awn text-5xl"></i>
                    </div>
                @endif
            </div>

            <div class="p-6 md:p-8 flex flex-col">
                <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Produk</p>
                <h1 class="text-2xl font-bold text-gray-900 mt-1">{{ $product->nama_produk }}</h1>
                <p class="text-2xl font-bold text-emerald-700 mt-3">
                    Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                    <span class="text-sm font-medium text-gray-400">/ {{ $product->satuan }}</span>
                </p>

                <p class="text-sm text-gray-500 mt-4 leading-relaxed">
                    {{ $product->deskripsi ?? 'Tidak ada deskripsi untuk produk ini.' }}
                </p>

                <p class="text-xs text-gray-400 mt-4">
                    Stok tersedia:
                    <span class="font-bold text-gray-600">
                        {{ number_format($product->stok_tersedia, 0, ',', '.') }} {{ $product->satuan }}
                    </span>
                </p>

                <div class="mt-auto pt-6">
                    <template x-if="stokTersedia <= 0">
                        <button disabled
                            class="w-full bg-gray-100 text-gray-400 font-bold text-sm py-2.5 rounded-xl border border-gray-200 cursor-not-allowed flex items-center justify-center gap-2">
                            <i class="fa-solid fa-ban"></i> Stok Habis
                        </button>
                    </template>

                    <template x-if="stokTersedia > 0">
                        <div class="flex items-center gap-4">
                            <div class="flex items-center bg-gray-50 rounded-xl border border-gray-200 p-1">
                                <button @click="if (qty > 1) qty--" :disabled="qty <= 1"
                                    :class="qty <= 1 ? 'opacity-30 cursor-not-allowed' : 'cursor-pointer'"
                                    class="w-9 h-9 rounded-lg bg-white border border-gray-200 text-gray-600 hover:text-red-600 hover:border-red-200 transition-colors">
                                    <i class="fa-solid fa-minus text-xs"></i>
                                </button>

                                <span class="w-12 text-center font-bold text-gray-800" x-text="qty"></span>

                                <button @click="if (qty < stokTersedia) qty++" :disabled="qty >= stokTersedia"
                                    :class="qty >= stokTersedia ? 'opacity-30 cursor-not-allowed' : 'cursor-pointer'"
                                    class="w-9 h-9 rounded-lg bg-white border border-gray-200 text-gray-600 hover:text-emerald-700 hover:border-emerald-200 transition-colors">
                                    <i class="fa-solid fa-plus text-xs"></i>
                                </button>
                            </div>

                            <button @click="addToCart()"
                                class="flex-1 flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 cursor-pointer">
                                <i class="fa-solid fa-cart-plus"></i> Tambah ke Keranjang
                            </button>
                        </div>
                    </template>
                </div>

                <p x-show="added" x-transition class="text-xs font-bold text-emerald-600 mt-3">
                    <i class="fa-solid fa-circle-check"></i> Ditambahkan ke keranjang.
                </p>
            </div>
        </div>
    </div>

    <script>
        function productDetail() {
            return {
                qty: 1,
                added: false,
                cart: {},
                productId: {{ $product->id }},
                stokTersedia: {{ $product->stok_tersedia }},

                init() {
                    try {
                        this.cart = JSON.parse(localStorage.getItem('cart_gabah')) || {};
                    } catch (e) {
                        this.cart = {};
                    }

                    // Jika stok kosong, set qty ke 0
                    if (this.stokTersedia <= 0) {
                        this.qty = 0;
                    }
                },

                addToCart() {
                    if (this.stokTersedia <= 0) return;

                    // Mengambil jumlah yang saat ini sudah ada di keranjang (jika ada)
                    const currentCartQty = this.cart[this.productId] || 0;

                    // Total akumulasi setelah ditambah qty baru
                    let totalNewQty = currentCartQty + this.qty;

                    // Batasi total agar tidak melebihi stok yang tersedia
                    if (totalNewQty > this.stokTersedia) {
                        totalNewQty = this.stokTersedia;
                    }

                    this.cart[this.productId] = totalNewQty;
                    localStorage.setItem('cart_gabah', JSON.stringify(this.cart));

                    this.added = true;
                    setTimeout(() => this.added = false, 2500);
                }
            }
        }
    </script>
@endsection
