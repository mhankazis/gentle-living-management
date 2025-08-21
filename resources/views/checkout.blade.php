{{-- filepath: resources/views/checkout.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')
    
    <!-- Page Header Section -->
    <div class="container mx-auto px-4 py-8">
        <div class="mb-8">
            <!-- Breadcrumb -->
            <nav class="text-sm text-gray-600 mb-4">
                <a href="{{ route('dashboard') }}" class="hover:text-blue-600 transition-colors duration-300">Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('cart.index') }}" class="hover:text-blue-600 transition-colors duration-300">Keranjang</a>
                <span class="mx-2">/</span>
                <span class="text-gray-900 font-medium">Checkout</span>
            </nav>
            
            <!-- Page Title -->
            <div class="text-center">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Checkout</h1>
                <p class="text-gray-600">Lengkapi informasi untuk menyelesaikan pesanan Anda</p>
            </div>
        </div>
    </div>
    
    <div class="container mx-auto px-4 py-8">
        <div class="grid lg:grid-cols-2 gap-8"
            x-data="{
                shipping: {
                    firstName: '', lastName: '', email: '', phone: '', address: '', city: '', state: '', zipCode: '', country: 'Indonesia'
                },
                payment: 'credit-card',
                isProcessing: false,
                cart: [
                    { id: 1, name: 'Gentle Oil Cough n Flu', price: 299, quantity: 1 },
                    { id: 2, name: 'Gentle Baby Deep Sleep', price: 249, quantity: 2 },
                    { id: 3, name: 'Gentle Baby Bye Bugs', price: 49, quantity: 1 }
                ],
                get subtotal() {
                    return this.cart.reduce((sum, i) => sum + i.price * i.quantity, 0)
                },
                get shippingCost() { return 15 },
                get tax() { return this.subtotal * 0.1 },
                get total() { return this.subtotal + this.shippingCost + this.tax },
                submit() {
                    this.isProcessing = true;
                    setTimeout(() => {
                        if (
                            !this.shipping.firstName || !this.shipping.lastName ||
                            !this.shipping.email || !this.shipping.address ||
                            !this.shipping.city || !this.shipping.zipCode
                        ) {
                            alert('Mohon lengkapi semua field yang diperlukan');
                            this.isProcessing = false;
                            return;
                        }
                        alert('Pesanan Berhasil!\nTerima kasih atas pesanan Anda.');
                        window.location.href = '/';
                    }, 1200);
                }
            }"
        >
            {{-- Form Checkout --}}
            <div class="space-y-6">
                <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-lg border border-gray-200">
                    <div class="px-8 pt-8">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5.121 17.804A13.937 13.937 0 0112 15c2.5 0 4.847.655 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"/><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="2" fill="none"/></svg>
                            <span class="font-semibold text-lg">Informasi Pengiriman</span>
                        </div>
                        <form @submit.prevent="submit" class="space-y-4">
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="firstName" class="font-medium">Nama Depan *</label>
                                    <input id="firstName" x-model="shipping.firstName" required class="form-input w-full rounded-lg border-gray-300" />
                                </div>
                                <div class="space-y-2">
                                    <label for="lastName" class="font-medium">Nama Belakang *</label>
                                    <input id="lastName" x-model="shipping.lastName" required class="form-input w-full rounded-lg border-gray-300" />
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="email" class="font-medium">Email *</label>
                                <div class="relative">
                                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 12H8m8 0a4 4 0 11-8 0 4 4 0 018 0z"/><rect width="20" height="20" x="2" y="2" rx="5" stroke="currentColor" stroke-width="2" fill="none"/></svg>
                                    <input id="email" type="email" x-model="shipping.email" required class="form-input w-full rounded-lg border-gray-300 pl-10" />
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="phone" class="font-medium">Nomor Telepon</label>
                                <div class="relative">
                                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92V19a2 2 0 01-2 2h-1a19.72 19.72 0 01-8.63-3.13A19.72 19.72 0 013 7V6a2 2 0 012-2h2.09a2 2 0 012 1.72l.18 1.09a2 2 0 01-.45 1.82l-.83.83a16 16 0 006.29 6.29l.83-.83a2 2 0 011.82-.45l1.09.18A2 2 0 0120 15.91V16a2 2 0 01-2 2h-.08"/></svg>
                                    <input id="phone" type="tel" x-model="shipping.phone" class="form-input w-full rounded-lg border-gray-300 pl-10" />
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="address" class="font-medium">Alamat *</label>
                                <div class="relative">
                                    <svg class="absolute left-3 top-3 h-4 w-4 text-gray-400" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/></svg>
                                    <input id="address" x-model="shipping.address" required class="form-input w-full rounded-lg border-gray-300 pl-10" />
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="city" class="font-medium">Kota *</label>
                                    <input id="city" x-model="shipping.city" required class="form-input w-full rounded-lg border-gray-300" />
                                </div>
                                <div class="space-y-2">
                                    <label for="zipCode" class="font-medium">Kode Pos *</label>
                                    <input id="zipCode" x-model="shipping.zipCode" required class="form-input w-full rounded-lg border-gray-300" />
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-lg border border-gray-200">
                    <div class="px-8 pt-8">
                        <div class="flex items-center space-x-2 mb-4">
                            <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2" /><path d="M2 10h20" /></svg>
                            <span class="font-semibold text-lg">Metode Pembayaran</span>
                        </div>
                        <div class="space-y-3">
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="payment" value="credit-card" x-model="payment" class="accent-blue-600" />
                                <span>Kartu Kredit/Debit</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="payment" value="bank-transfer" x-model="payment" class="accent-blue-600" />
                                <span>Transfer Bank</span>
                            </label>
                            <label class="flex items-center space-x-2 cursor-pointer">
                                <input type="radio" name="payment" value="cod" x-model="payment" class="accent-blue-600" />
                                <span>Bayar di Tempat (COD)</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            {{-- Ringkasan Pesanan --}}
            <div>
                <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-lg border border-gray-200">
                    <div class="px-8 pt-8 pb-8 space-y-4">
                        <div class="font-semibold text-lg mb-2">Ringkasan Pesanan</div>
                        <template x-for="item in cart" :key="item.id">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="font-medium" x-text="item.name"></p>
                                    <p class="text-sm text-gray-600">Qty: <span x-text="item.quantity"></span></p>
                                </div>
                                <p class="font-semibold">$<span x-text="item.price * item.quantity"></span></p>
                            </div>
                        </template>
                        <hr>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span>$<span x-text="subtotal"></span></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pengiriman</span>
                                <span>$<span x-text="shippingCost"></span></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pajak</span>
                                <span>$<span x-text="tax.toFixed(2)"></span></span>
                            </div>
                            <hr>
                            <div class="flex justify-between text-xl font-bold">
                                <span>Total</span>
                                <span>$<span x-text="total.toFixed(2)"></span></span>
                            </div>
                        </div>
                        <button
                            @click="submit"
                            :disabled="isProcessing"
                            class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white py-4 text-lg rounded-lg font-semibold transition disabled:opacity-60 mt-4"
                        >
                            <template x-if="isProcessing">Memproses...</template>
                            <template x-if="!isProcessing">
                                <span>
                                    <svg class="inline mr-2 h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2" /><path d="M2 10h20" /></svg>
                                    Selesaikan Pesanan
                                </span>
                            </template>
                        </button>
                        <div class="space-y-2 text-sm text-gray-600 mt-4">
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="3" width="22" height="13" rx="2" /><path d="M1 8h22" /></svg>
                                <span>Gratis ongkir untuk pesanan di atas $100</span>
                            </div>
                            <div class="flex items-center space-x-2">
                                <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2" /><path d="M2 10h20" /></svg>
                                <span>Pembayaran aman dengan enkripsi SSL</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.features')
    @include('components.footer')
</div>
@endsection