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
    
    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8">
        <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Shipping Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-lg border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Informasi Pengiriman</h2>
                        
                        <!-- Customer Info (Read-only) -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <input type="text" value="{{ $user->fullname }}" readonly 
                                       class="w-full px-3 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" value="{{ $user->email }}" readonly 
                                       class="w-full px-3 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-600">
                            </div>
                        </div>
                        
                        <!-- Phone Number -->
                        <div class="mb-6">
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon *</label>
                            <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                                   class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            @error('phone')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- Shipping Address -->
                        <div class="mb-6">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                            <textarea id="shipping_address" name="shipping_address" rows="3" required
                                      class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Masukkan alamat lengkap untuk pengiriman">{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <!-- City and Postal Code -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-2">Kota *</label>
                                <input type="text" id="city" name="city" value="{{ old('city') }}" required
                                       class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('city')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-2">Kode Pos *</label>
                                <input type="text" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required
                                       class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                @error('postal_code')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Notes -->
                        <div class="mb-6">
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Pesanan</label>
                            <textarea id="notes" name="notes" rows="2"
                                      class="w-full px-3 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Catatan tambahan untuk pesanan (opsional)">{{ old('notes') }}</textarea>
                        </div>
                    </div>

                    <!-- Order Items -->
                    <div class="mt-8 bg-white/90 backdrop-blur-sm rounded-lg shadow-lg border border-gray-200 p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Produk yang Dipesan</h2>
                        
                        <div class="space-y-4">
                            @foreach($cartItems as $item)
                            <div class="flex items-center space-x-4 py-4 border-b border-gray-200 last:border-b-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-200 to-indigo-300 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="h-8 w-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                                
                                <div class="flex-1">
                                    <h3 class="font-medium text-gray-800">{{ $item->item_name }}</h3>
                                    <p class="text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->item_price, 0, ',', '.') }}</p>
                                </div>
                                
                                <div class="text-right">
                                    <p class="font-semibold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-lg border border-gray-200 p-6 sticky top-8">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Ringkasan Pesanan</h3>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between text-gray-600">
                                <span>Subtotal</span>
                                <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>PPN (11%)</span>
                                <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-gray-600">
                                <span>Ongkos Kirim</span>
                                <span>Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t border-gray-200 pt-4">
                                <div class="flex justify-between items-center">
                                    <span class="text-lg font-bold text-gray-800">Total</span>
                                    <span class="text-xl font-bold text-blue-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-4 px-6 rounded-lg font-semibold hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg">
                            Buat Pesanan
                        </button>
                        
                        <!-- Back to Cart -->
                        <div class="mt-4">
                            <a href="{{ route('cart.index') }}" class="w-full block text-center text-gray-600 hover:text-emerald-600 transition-colors duration-300 text-sm">
                                ← Kembali ke Keranjang
                            </a>
                        </div>
                        
                        <!-- Security Note -->
                        <div class="mt-6 flex items-center justify-center text-xs text-gray-500">
                            <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                            Transaksi Aman & Terlindungi
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    
    @include('components.features')
    @include('components.footer')
</div>

@endsection
