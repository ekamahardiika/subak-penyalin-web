@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
    <div x-data="cartPage()" x-init="init()">

        <div class="mb-6">
            <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Belanja Gabah</p>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Daftar Produk</h1>
            <p class="text-sm text-gray-500 mt-1">Pilih produk yang ingin Anda pesan, atur jumlahnya, lalu lanjutkan ke
                pesanan.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            <div class="lg:col-span-2 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
                <template x-for="p in products" :key="p.id">
                    <div class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden group">
                        <a :href="`{{ url('konsumen/produk') }}/${p.id}`" class="block">
                            <div class="h-36 bg-gray-100 overflow-hidden">
                                <template x-if="p.gambar_url">
                                    <img :src="p.gambar_url" :alt="p.nama_produk"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </template>
                                <template x-if="!p.gambar_url">
                                    <div class="w-full h-full flex items-center justify-center text-gray-300">
                                        <i class="fa-solid fa-wheat-awn text-3xl"></i>
                                    </div>
                                </template>
                            </div>
                        </a>
                        <div class="p-4">
                            <a :href="`{{ url('konsumen/produk') }}/${p.id}`"
                                class="font-bold text-gray-900 text-sm hover:text-emerald-700 transition-colors line-clamp-1"
                                x-text="p.nama_produk"></a>
                            <p class="text-emerald-700 font-bold text-sm mt-1"
                                x-text="'Rp ' + formatRupiah(p.harga_jual) + ' / ' + p.satuan"></p>

                            <div class="mt-3">
                                <template x-if="p.stok_tersedia <= 0">
                                    <button disabled
                                        class="w-full bg-gray-100 text-gray-400 font-bold text-xs py-2 rounded-xl border border-gray-200 cursor-not-allowed">
                                        <i class="fa-solid fa-ban mr-1"></i> Stok Habis
                                    </button>
                                </template>

                                <template x-if="p.stok_tersedia > 0 && !cart[p.id]">
                                    <button @click="addToCart(p.id)"
                                        class="w-full bg-emerald-50 hover:bg-emerald-600 hover:text-white text-emerald-700 font-bold text-xs py-2 rounded-xl border border-emerald-200 transition-all cursor-pointer">
                                        <i class="fa-solid fa-cart-plus mr-1"></i> Tambah
                                    </button>
                                </template>

                                <template x-if="p.stok_tersedia > 0 && cart[p.id]">
                                    <div
                                        class="flex items-center justify-between bg-gray-50 rounded-xl border border-gray-200 p-1">
                                        <button @click="decrement(p.id)"
                                            class="w-7 h-7 rounded-lg bg-white border border-gray-200 text-gray-600 hover:text-red-600 hover:border-red-200 transition-colors cursor-pointer">
                                            <i class="fa-solid fa-minus text-[10px]"></i>
                                        </button>

                                        <span class="font-bold text-sm text-gray-800" x-text="cart[p.id]"></span>

                                        <button @click="increment(p.id)" :disabled="cart[p.id] >= p.stok_tersedia"
                                            :class="cart[p.id] >= p.stok_tersedia ? 'opacity-30 cursor-not-allowed' :
                                                'cursor-pointer'"
                                            class="w-7 h-7 rounded-lg bg-white border border-gray-200 text-gray-600 hover:text-emerald-600 hover:border-emerald-200 transition-colors">
                                            <i class="fa-solid fa-plus text-[10px]"></i>
                                        </button>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </template>

                <div x-show="products.length === 0" class="col-span-full text-center py-16 text-gray-400">
                    <i class="fa-solid fa-basket-shopping text-3xl text-gray-300"></i>
                    <p class="text-sm mt-2">Belum ada produk yang tersedia saat ini.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-100 shadow-xs sticky top-20">
                <div class="bg-emerald-950 text-white rounded-t-2xl px-5 py-4 flex items-center gap-2.5">
        
                    <h3 class="font-bold text-sm tracking-wide uppercase">Pesanan</h3>
                </div>

                <div class="p-5 space-y-3 max-h-80 overflow-y-auto">
                    <template x-for="item in cartItems" :key="item.id">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 rounded-lg bg-gray-100 overflow-hidden shrink-0">
                                <template x-if="item.gambar_url">
                                    <img :src="item.gambar_url" class="w-full h-full object-cover">
                                </template>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs font-bold text-gray-800 truncate" x-text="item.nama_produk"></p>
                                <p class="text-[11px] text-gray-400"
                                    x-text="item.qty + ' x Rp ' + formatRupiah(item.harga_jual)"></p>
                            </div>
                            <button @click="removeFromCart(item.id)"
                                class="text-gray-300 hover:text-red-500 transition-colors cursor-pointer">
                                <i class="fa-solid fa-xmark text-xs"></i>
                            </button>
                        </div>
                    </template>

                    <div x-show="cartItems.length === 0" class="text-center text-gray-400 text-xs py-6">
                        <i class="fa-solid fa-cart-shopping text-2xl text-gray-300"></i>
                        <p class="mt-2">Keranjang masih kosong.</p>
                    </div>
                </div>

                <div class="border-t border-gray-100 p-5 space-y-4">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-500">Total</span>
                        <span class="font-bold text-gray-900" x-text="'Rp ' + formatRupiah(cartTotal)"></span>
                    </div>
                    <a href="{{ route('konsumen.orders.create') }}"
                        :class="cartItems.length === 0 ? 'pointer-events-none opacity-40' : ''"
                        class="w-full flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 cursor-pointer">
                        Pesan Sekarang <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function cartPage() {
            return {
                products: @json($products),
                cart: {},

                init() {
                    try {
                        this.cart = JSON.parse(localStorage.getItem('cart_gabah')) || {};
                    } catch (e) {
                        this.cart = {};
                    }

                    Object.keys(this.cart).forEach(id => {
                        const p = this.products.find(p => p.id == id);
                        if (!p || p.stok_tersedia <= 0) {
                            delete this.cart[id];
                        } else if (this.cart[id] > p.stok_tersedia) {
                            this.cart[id] = p.stok_tersedia;
                        }
                    });

                    this.$watch('cart', (val) => localStorage.setItem('cart_gabah', JSON.stringify(val)));
                },

                addToCart(id) {
                    const p = this.products.find(p => p.id == id);
                    if (!p || p.stok_tersedia <= 0) return;

                    this.cart[id] = (this.cart[id] || 0) + 1;
                },

                increment(id) {
                    const p = this.products.find(p => p.id == id);
                    if (!p) return;

                    const current = this.cart[id] || 0;

                    if (current >= p.stok_tersedia) return;

                    this.cart[id] = current + 1;
                },

                decrement(id) {
                    if (!this.cart[id]) return;

                    this.cart[id] -= 1;

                    if (this.cart[id] <= 0) delete this.cart[id];
                },

                removeFromCart(id) {
                    delete this.cart[id];
                },

                get cartItems() {
                    return Object.keys(this.cart).map(id => {
                        const p = this.products.find(p => p.id == id);
                        return p ? {
                            ...p,
                            qty: this.cart[id]
                        } : null;
                    }).filter(Boolean);
                },

                get cartTotal() {
                    return this.cartItems.reduce((sum, item) => sum + (item.qty * item.harga_jual), 0);
                },

                formatRupiah(num) {
                    return new Intl.NumberFormat('id-ID').format(Math.round(num || 0));
                }
            }
        }
    </script>
@endsection
