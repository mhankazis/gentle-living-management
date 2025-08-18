@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="orderTracker()">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Lacak Pesanan</h1>
        
        <!-- Order Info -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <p class="text-sm text-gray-600 mb-1">Nomor Pesanan</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Tanggal Pesanan</p>
                    <p class="text-lg font-semibold text-gray-800">{{ $order->created_at->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600 mb-1">Status</p>
                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                        @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                        @elseif($order->status == 'confirmed') bg-blue-100 text-blue-800
                        @elseif($order->status == 'processing') bg-indigo-100 text-indigo-800
                        @elseif($order->status == 'shipped') bg-purple-100 text-purple-800
                        @elseif($order->status == 'delivered') bg-green-100 text-green-800
                        @elseif($order->status == 'cancelled') bg-red-100 text-red-800
                        @endif">
                        {{ $order->status_label }}
                    </span>
                </div>
            </div>
        </div>
        
        <!-- Order Status Timeline -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Status Pengiriman</h2>
            
            <div class="relative">
                <div class="absolute left-4 top-0 bottom-0 w-0.5 bg-gray-200"></div>
                
                <!-- Pending -->
                <div class="relative flex items-center pb-8">
                    <div class="w-8 h-8 rounded-full border-2 border-yellow-500 bg-yellow-100 flex items-center justify-center z-10">
                        <svg class="w-4 h-4 text-yellow-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-medium text-gray-800">Pesanan Diterima</h3>
                        <p class="text-sm text-gray-600">{{ $order->created_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
                
                <!-- Confirmed -->
                <div class="relative flex items-center pb-8">
                    <div class="w-8 h-8 rounded-full border-2 
                        @if(in_array($order->status, ['confirmed', 'processing', 'shipped', 'delivered'])) border-blue-500 bg-blue-100 @else border-gray-300 bg-gray-100 @endif 
                        flex items-center justify-center z-10">
                        <svg class="w-4 h-4 @if(in_array($order->status, ['confirmed', 'processing', 'shipped', 'delivered'])) text-blue-600 @else text-gray-400 @endif" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-medium @if(in_array($order->status, ['confirmed', 'processing', 'shipped', 'delivered'])) text-gray-800 @else text-gray-400 @endif">
                            Pesanan Dikonfirmasi
                        </h3>
                        <p class="text-sm text-gray-600">Pesanan sedang diverifikasi</p>
                    </div>
                </div>
                
                <!-- Processing -->
                <div class="relative flex items-center pb-8">
                    <div class="w-8 h-8 rounded-full border-2 
                        @if(in_array($order->status, ['processing', 'shipped', 'delivered'])) border-indigo-500 bg-indigo-100 @else border-gray-300 bg-gray-100 @endif 
                        flex items-center justify-center z-10">
                        <svg class="w-4 h-4 @if(in_array($order->status, ['processing', 'shipped', 'delivered'])) text-indigo-600 @else text-gray-400 @endif" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-medium @if(in_array($order->status, ['processing', 'shipped', 'delivered'])) text-gray-800 @else text-gray-400 @endif">
                            Pesanan Diproses
                        </h3>
                        <p class="text-sm text-gray-600">Pesanan sedang disiapkan</p>
                    </div>
                </div>
                
                <!-- Shipped -->
                <div class="relative flex items-center pb-8">
                    <div class="w-8 h-8 rounded-full border-2 
                        @if(in_array($order->status, ['shipped', 'delivered'])) border-purple-500 bg-purple-100 @else border-gray-300 bg-gray-100 @endif 
                        flex items-center justify-center z-10">
                        <svg class="w-4 h-4 @if(in_array($order->status, ['shipped', 'delivered'])) text-purple-600 @else text-gray-400 @endif" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                            <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1V8a1 1 0 00-1-1h-3z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-medium @if(in_array($order->status, ['shipped', 'delivered'])) text-gray-800 @else text-gray-400 @endif">
                            Pesanan Dikirim
                        </h3>
                        <p class="text-sm text-gray-600">Pesanan dalam perjalanan</p>
                    </div>
                </div>
                
                <!-- Delivered -->
                <div class="relative flex items-center">
                    <div class="w-8 h-8 rounded-full border-2 
                        @if($order->status == 'delivered') border-green-500 bg-green-100 @else border-gray-300 bg-gray-100 @endif 
                        flex items-center justify-center z-10">
                        <svg class="w-4 h-4 @if($order->status == 'delivered') text-green-600 @else text-gray-400 @endif" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="font-medium @if($order->status == 'delivered') text-gray-800 @else text-gray-400 @endif">
                            Pesanan Diterima
                        </h3>
                        <p class="text-sm text-gray-600">Pesanan telah sampai</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Cancellation Section -->
        @if($order->canBeCancelled() && !$order->cancellation_reason)
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Batalkan Pesanan</h2>
            <p class="text-gray-600 mb-4">Jika Anda ingin membatalkan pesanan ini, silakan berikan alasan pembatalan.</p>
            
            <form @submit.prevent="submitCancellation()" x-show="!showCancellationForm" class="mb-4">
                <button type="button" @click="showCancellationForm = true" 
                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200">
                    Ajukan Pembatalan
                </button>
            </form>
            
            <form @submit.prevent="submitCancellation()" x-show="showCancellationForm">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alasan Pembatalan</label>
                    <textarea name="cancellation_reason" 
                              x-model="cancellationReason"
                              required
                              rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                              placeholder="Jelaskan alasan pembatalan pesanan..."></textarea>
                </div>
                
                <div class="flex space-x-3">
                    <button type="submit" 
                            :disabled="loading"
                            class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200 disabled:opacity-50">
                        <span x-show="!loading">Kirim Pembatalan</span>
                        <span x-show="loading">Memproses...</span>
                    </button>
                    <button type="button" @click="showCancellationForm = false" 
                            class="bg-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-400 transition duration-200">
                        Batal
                    </button>
                </div>
            </form>
        </div>
        @endif
        
        @if($order->cancellation_reason)
        <div class="bg-red-50 border border-red-200 rounded-lg p-6 mb-8">
            <h3 class="text-lg font-semibold text-red-800 mb-2">Permintaan Pembatalan</h3>
            <p class="text-red-700 mb-2"><strong>Alasan:</strong> {{ $order->cancellation_reason }}</p>
            @if($order->cancelled_at)
                <p class="text-red-700"><strong>Tanggal:</strong> {{ $order->cancelled_at->format('d F Y, H:i') }}</p>
            @endif
        </div>
        @endif
        
        <!-- Order Items -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Produk yang Dipesan</h2>
            
            <div class="space-y-4">
                @foreach($order->orderItems as $item)
                <div class="flex items-center space-x-4 py-4 border-b border-gray-200 last:border-b-0">
                    <img src="https://via.placeholder.com/80x80/f3f4f6/9ca3af?text={{ urlencode($item->item_name) }}" 
                         alt="{{ $item->item_name }}" 
                         class="w-16 h-16 object-cover rounded-lg">
                    
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
            
            <div class="border-t border-gray-200 pt-4 mt-4">
                <div class="flex justify-between items-center text-xl font-semibold text-gray-800">
                    <span>Total Pesanan</span>
                    <span>Rp {{ number_format($order->total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
        
        <!-- Shipping Address -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Alamat Pengiriman</h2>
            <div class="text-gray-700">
                <p class="font-medium">{{ $order->customer_name }}</p>
                <p>{{ $order->customer_phone }}</p>
                <p>{{ $order->customer_email }}</p>
                <p class="mt-2">{{ $order->shipping_address }}</p>
                <p>{{ $order->city }}, {{ $order->postal_code }}</p>
            </div>
        </div>
    </div>
</div>

<script>
function orderTracker() {
    return {
        showCancellationForm: false,
        cancellationReason: '',
        loading: false,
        
        submitCancellation() {
            if (!this.cancellationReason.trim()) {
                alert('Silakan masukkan alasan pembatalan');
                return;
            }
            
            this.loading = true;
            
            fetch(`/orders/{{ $order->order_id }}/cancel`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    cancellation_reason: this.cancellationReason
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert(data.message || 'Terjadi kesalahan');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim pembatalan');
            })
            .finally(() => {
                this.loading = false;
            });
        }
    }
}
</script>
@endsection
