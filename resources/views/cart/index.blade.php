@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="cartManager()">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Keranjang Belanja</h1>
    
    @if($cartItems->count() > 0)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Cart Items -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Produk di Keranjang ({{ $itemCount }} item)</h2>
                </div>
                
                <div class="divide-y divide-gray-200">
                    @foreach($cartItems as $item)
                    <div class="p-6 flex items-center space-x-4" x-data="{ quantity: {{ $item->quantity }} }">
                        <div class="flex-shrink-0">
                            <img src="https://via.placeholder.com/100x100/f3f4f6/9ca3af?text={{ urlencode($item->item_name) }}" 
                                 alt="{{ $item->item_name }}" 
                                 class="w-20 h-20 object-cover rounded-lg">
                        </div>
                        
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-medium text-gray-800 truncate">{{ $item->item_name }}</h3>
                            <p class="text-gray-600">Rp {{ number_format($item->item_price, 0, ',', '.') }}</p>
                        </div>
                        
                        <div class="flex items-center space-x-2">
                            <button @click="updateQuantity({{ $item->cart_id }}, quantity - 1)" 
                                    :disabled="quantity <= 1"
                                    class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center hover:bg-gray-300 disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            
                            <span class="w-12 text-center font-medium" x-text="quantity"></span>
                            
                            <button @click="updateQuantity({{ $item->cart_id }}, quantity + 1)"
                                    class="w-8 h-8 rounded-full bg-gray-200 flex items-center justify-center hover:bg-gray-300">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="text-right">
                            <p class="text-lg font-semibold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            <button @click="removeItem({{ $item->cart_id }})" 
                                    class="text-red-600 hover:text-red-800 text-sm mt-1">
                                Hapus
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h3>
                
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
                        <div class="flex justify-between text-xl font-semibold text-gray-800">
                            <span>Total</span>
                            <span>Rp {{ number_format($total + 10000, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                
                <a href="{{ route('orders.checkout') }}" 
                   class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 text-center block font-medium">
                    Lanjut ke Checkout
                </a>
                
                <button @click="clearCart()" 
                        class="w-full mt-3 bg-gray-100 text-gray-700 py-2 px-4 rounded-lg hover:bg-gray-200 transition duration-200">
                    Kosongkan Keranjang
                </button>
            </div>
        </div>
    </div>
    @else
    <div class="text-center py-16">
        <div class="text-gray-400 mb-4">
            <svg class="w-24 h-24 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5 5M7 13l2.5 5m6.5-5L19 18M17 13v6a2 2 0 01-2 2H9a2 2 0 01-2-2v-6"></path>
            </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-800 mb-2">Keranjang Anda Kosong</h3>
        <p class="text-gray-600 mb-6">Belum ada produk yang ditambahkan ke keranjang</p>
        <a href="{{ route('products.index') }}" 
           class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200 inline-block">
            Mulai Belanja
        </a>
    </div>
    @endif
</div>

<script>
function cartManager() {
    return {
        updateQuantity(cartId, newQuantity) {
            if (newQuantity < 1) return;
            
            fetch(`/cart/${cartId}/update`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ quantity: newQuantity })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                }
            });
        },
        
        removeItem(cartId) {
            if (confirm('Hapus produk ini dari keranjang?')) {
                fetch(`/cart/${cartId}/remove`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        },
        
        clearCart() {
            if (confirm('Kosongkan semua produk di keranjang?')) {
                fetch('/cart/clear', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    }
                });
            }
        }
    }
}
</script>
@endsection
