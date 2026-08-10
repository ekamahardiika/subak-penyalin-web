@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
    <div x-data="checkoutPage()" x-init="init()">

        <div class="mb-6">
            <p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">Pemesanan</p>
            <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Form Order</h1>
            <p class="text-sm text-gray-500 mt-1">Periksa kembali pesanan Anda dan lengkapi data pemesan sebelum
                konfirmasi.</p>
        </div>

        <form method="POST" action="{{ route('konsumen.orders.store') }}"
            @submit.prevent="$dispatch('open-confirm-modal', {
                form: $el,
                title: 'Konfirmasi Pesanan?',
                message: `Anda akan memesan ${cartItems.length} produk senilai Rp ${formatRupiah(cartTotal)}. Pesanan tidak dapat dibatalkan setelah dikonfirmasi.`,
                confirmLabel: 'Ya, Pesan Sekarang',
                cancelLabel: 'Periksa Lagi',
                type: 'primary'
            })"
            class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

            @csrf
            <input type="hidden" name="items" :value="JSON.stringify(cart)">

            <!-- RINGKASAN PESANAN -->
            <div class="lg:col-span-2 bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-sm text-gray-800">Ringkasan Pesanan</h3>
                </div>

                <div class="divide-y divide-gray-100">
                    <template x-for="item in cartItems" :key="item.id">
                        <div class="flex items-center gap-4 p-5">
                            <div class="w-14 h-14 rounded-xl bg-gray-100 overflow-hidden shrink-0">
                                <template x-if="item.gambar_url">
                                    <img :src="item.gambar_url" class="w-full h-full object-cover">
                                </template>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-bold text-gray-900 truncate" x-text="item.nama_produk"></p>
                                <p class="text-xs text-gray-400 mt-0.5"
                                    x-text="'Rp ' + formatRupiah(item.harga_jual) + ' / ' + item.satuan"></p>
                            </div>

                            <div class="flex items-center bg-gray-50 rounded-xl border border-gray-200 p-1">
                                <button type="button" @click="decrement(item.id)"
                                    class="w-7 h-7 rounded-lg bg-white border border-gray-200 text-gray-600 hover:text-red-600 hover:border-red-200 transition-colors cursor-pointer">
                                    <i class="fa-solid fa-minus text-[10px]"></i>
                                </button>
                                <span class="w-8 text-center text-sm font-bold text-gray-800" x-text="item.qty"></span>
                                <button type="button" @click="increment(item.id)"
                                    class="w-7 h-7 rounded-lg bg-white border border-gray-200 text-gray-600 hover:text-emerald-700 hover:border-emerald-200 transition-colors cursor-pointer">
                                    <i class="fa-solid fa-plus text-[10px]"></i>
                                </button>
                            </div>

                            <p class="w-28 text-right text-sm font-bold text-gray-900"
                                x-text="'Rp ' + formatRupiah(item.qty * item.harga_jual)"></p>

                            <button type="button" @click="removeFromCart(item.id)"
                                class="text-gray-300 hover:text-red-500 transition-colors cursor-pointer">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </div>
                    </template>

                    <div x-show="cartItems.length === 0" class="text-center text-gray-400 text-sm py-14">
                        <i class="fa-solid fa-cart-shopping text-3xl text-gray-300"></i>
                        <p class="mt-2">Keranjang masih kosong.</p>
                        <a href="{{ route('konsumen.products.index') }}"
                            class="text-emerald-700 font-bold text-xs mt-2 inline-block hover:underline">Kembali
                            belanja</a>
                    </div>
                </div>

                <div class="px-5 py-4 border-t border-gray-100 flex items-center justify-between">
                    <span class="text-sm font-medium text-gray-500">Total Belanja</span>
                    <span class="text-lg font-bold text-emerald-700" x-text="'Rp ' + formatRupiah(cartTotal)"></span>
                </div>
            </div>

            <!-- INFORMASI PEMESAN -->
            <div class="bg-white rounded-2xl border border-gray-100 shadow-xs overflow-hidden">
                <div class="bg-emerald-950 text-white px-5 py-4 flex items-center gap-2.5">
                    <span
                        class="w-6 h-6 rounded-full bg-emerald-600 flex items-center justify-center text-xs font-bold">1</span>
                    <h3 class="font-bold text-sm tracking-wide uppercase">Informasi Pemesan</h3>
                </div>

                <div class="p-5 space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1.5">Nama Lengkap *</label>
                        <input type="text" name="nama_pemesan" required
                            value="{{ old('nama_pemesan', $user->name ?? '') }}" placeholder="Nama Anda"
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm placeholder-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1.5">WhatsApp *</label>
                        <input type="text" name="whatsapp_pemesan" required
                            value="{{ old('whatsapp_pemesan', $user->phone ?? '') }}" placeholder="+62 812 ..."
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm placeholder-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all">
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1.5">Catatan (opsional)</label>
                        <textarea name="catatan" rows="3" placeholder="Catatan khusus..."
                            class="w-full bg-gray-50 border border-gray-200 rounded-xl px-4 py-2.5 text-sm placeholder-gray-400 focus:outline-none focus:bg-white focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition-all resize-none">{{ old('catatan') }}</textarea>
                    </div>
                </div>

                <div class="p-5 pt-0 flex gap-3">
                    <a href="{{ route('konsumen.products.index') }}"
                        class="flex-1 flex items-center justify-center bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold py-2.5 rounded-xl text-sm transition-all cursor-pointer">
                        Batal
                    </a>
                    <button type="submit" :disabled="cartItems.length === 0"
                        :class="cartItems.length === 0 ? 'opacity-40 pointer-events-none' : ''"
                        class="flex-1 flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-2.5 rounded-xl text-sm transition-all shadow-md shadow-emerald-700/20 cursor-pointer">
                        Pesan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function checkoutPage() {
            return {
                products: @json($products),
                cart: {},
                init() {
                    try {
                        this.cart = JSON.parse(localStorage.getItem('cart_gabah')) || {};
                    } catch (e) {
                        this.cart = {};
                    }
                    this.$watch('cart', (val) => localStorage.setItem('cart_gabah', JSON.stringify(val)));
                },
                increment(id) {
                    this.cart[id] = (this.cart[id] || 0) + 1;
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
