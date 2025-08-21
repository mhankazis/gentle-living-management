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
                <span class="text-gray-900 font-medium">Keranjang Belanja</span>
            </nav>
            
            <!-- Page Title -->
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">Keranjang Belanja</h1>
                    <p class="text-gray-600">Kelola produk yang akan Anda beli</p>
                </div>
                <div class="flex items-center space-x-2">
                    <svg class="h-8 w-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <circle cx="9" cy="21" r="1"/>
                        <circle cx="20" cy="21" r="1"/>
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61l1.38-7.39H6"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8" x-data="cartManager()">
        @if($cartItems->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-lg border border-gray-200 overflow-hidden">
                    <div class="p-6 border-b border-gray-200 bg-gray-50/50">
                        <h2 class="text-xl font-bold text-gray-800">Produk di Keranjang ({{ $itemCount }} item)</h2>
                    </div>
                    
                    <div class="divide-y divide-gray-200">
                        @foreach($cartItems as $item)
                        <div class="p-6 flex items-center space-x-4" x-data="{ quantity: {{ $item->quantity }} }">
                            <!-- Product Image -->
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-200 to-indigo-300 rounded-lg flex-shrink-0 flex items-center justify-center">
                                <svg class="h-8 w-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            </div>
                            
                            <!-- Product Info -->
                            <div class="flex-1 min-w-0">
                                <h3 class="text-lg font-semibold text-gray-800 truncate">{{ $item->item_name }}</h3>
                                <p class="text-gray-600">Rp {{ number_format($item->item_price, 0, ',', '.') }}</p>
                            </div>
                            
                            <!-- Quantity Controls -->
                            <div class="flex items-center space-x-3">
                                <button @click="updateQuantity({{ $item->cart_id }}, quantity - 1)" 
                                        :disabled="quantity <= 1 || updating"
                                        class="w-8 h-8 rounded-lg border border-blue-300 flex items-center justify-center text-blue-600 hover:bg-blue-50 transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                    </svg>
                                </button>
                                <span class="w-12 text-center font-medium text-gray-800" x-text="quantity"></span>
                                <button @click="updateQuantity({{ $item->cart_id }}, quantity + 1)"
                                        :disabled="updating"
                                        class="w-8 h-8 rounded-lg border border-blue-300 flex items-center justify-center text-blue-600 hover:bg-blue-50 transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <line x1="12" y1="5" x2="12" y2="19"/>
                                        <line x1="5" y1="12" x2="19" y2="12"/>
                                    </svg>
                                </button>
                            </div>
                            
                            <!-- Price and Remove -->
                            <div class="text-right">
                                <p class="text-lg font-bold text-gray-800 mb-2">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                                <button @click="removeItem({{ $item->cart_id }})" 
                                        :disabled="updating"
                                        class="text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg p-2 transition-colors duration-300 disabled:opacity-50 disabled:cursor-not-allowed">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                        <line x1="10" y1="11" x2="10" y2="17"/>
                                        <line x1="14" y1="11" x2="14" y2="17"/>
                                    </svg>
                                </button>
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
                    
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-600">
                            <span>Subtotal ({{ $itemCount }} item)</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Ongkos Kirim</span>
                            <span>Rp 10.000</span>
                        </div>
                        <div class="border-t border-gray-200 pt-3">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold text-gray-800">Total</span>
                                <span class="text-xl font-bold text-blue-600">Rp {{ number_format($total + 10000, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-3">
                        <a href="{{ route('orders.checkout') }}" 
                           class="w-full bg-gradient-to-r from-blue-500 to-blue-600 text-white py-3 px-6 rounded-lg font-semibold hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg text-center block">
                            Lanjut ke Checkout
                        </a>
                        
                        <button @click="clearCart()" 
                                class="w-full bg-white border border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-300">
                            Kosongkan Keranjang
                        </button>
                    </div>
                    
                    <!-- Continue Shopping -->
                    <div class="mt-4">
                        <a href="{{ route('products.index') }}" class="w-full block text-center text-blue-600 hover:text-blue-800 transition-colors duration-300 text-sm">
                            ← Lanjutkan Belanja
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @else
        <!-- Empty State -->
        <div class="text-center py-16">
            <div class="mx-auto h-24 w-24 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center mb-6">
                <svg class="h-12 w-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61l1.38-7.39H6"/>
                </svg>
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Keranjang Anda Kosong</h3>
            <p class="text-gray-600 mb-8">Belum ada produk yang ditambahkan ke keranjang. Mulai berbelanja sekarang!</p>
            <a href="{{ route('products.index') }}" 
               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg font-semibold hover:from-blue-600 hover:to-blue-700 transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Mulai Belanja
            </a>
        </div>
        @endif
    </div>
</div>

<script>
function cartManager() {
    return {
        updating: false,
        
        async updateQuantity(cartId, newQuantity) {
            if (newQuantity < 1 || this.updating) return;
            
            this.updating = true;
            
            try {
                const response = await fetch(`/cart/update/${cartId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ quantity: newQuantity })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Update cart counter
                    if (window.CartCounter && data.cart_count !== undefined) {
                        window.CartCounter.updateCount(data.cart_count);
                    }
                    location.reload();
                } else {
                    alert(data.message || 'Gagal memperbarui keranjang');
                }
            } catch (error) {
                console.error('Error updating quantity:', error);
                alert('Terjadi kesalahan saat memperbarui keranjang');
            } finally {
                this.updating = false;
            }
        },
        
        async removeItem(cartId) {
            if (!confirm('Hapus produk ini dari keranjang?')) return;
            
            if (this.updating) return;
            this.updating = true;
            
            try {
                const response = await fetch(`/cart/remove/${cartId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Update cart counter
                    if (window.CartCounter && data.cart_count !== undefined) {
                        window.CartCounter.updateCount(data.cart_count);
                    }
                    location.reload();
                } else {
                    alert(data.message || 'Gagal menghapus item');
                }
            } catch (error) {
                console.error('Error removing item:', error);
                alert('Terjadi kesalahan saat menghapus item');
            } finally {
                this.updating = false;
            }
        },
        
        async clearCart() {
            if (!confirm('Kosongkan semua produk di keranjang?')) return;
            
            if (this.updating) return;
            this.updating = true;
            
            try {
                const response = await fetch('/cart/clear', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Update cart counter to 0
                    if (window.CartCounter) {
                        window.CartCounter.updateCount(0);
                    }
                    location.reload();
                } else {
                    alert(data.message || 'Gagal mengosongkan keranjang');
                }
            } catch (error) {
                console.error('Error clearing cart:', error);
                alert('Terjadi kesalahan saat mengosongkan keranjang');
            } finally {
                this.updating = false;
            }
        }
    }
}
</script>

@include('components.features')
@include('components.footer')
</div>
@endsection
