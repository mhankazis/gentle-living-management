@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto text-center">
        <div class="bg-green-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <h1 class="text-3xl font-bold text-gray-800 mb-4">Pesanan Berhasil Dibuat!</h1>
        <p class="text-gray-600 mb-8">Terima kasih atas pesanan Anda. Kami akan segera memproses pesanan ini.</p>
        
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-8 text-left">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Detail Pesanan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-600">Nomor Pesanan</p>
                    <p class="font-semibold text-gray-800">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Tanggal Pesanan</p>
                    <p class="font-semibold text-gray-800">{{ $order->created_at->format('d F Y, H:i') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Status</p>
                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                        {{ $order->status_label }}
                    </span>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total</p>
                    <p class="font-semibold text-gray-800">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-4">
                <h3 class="font-semibold text-gray-800 mb-3">Produk yang Dipesan</h3>
                <div class="space-y-2">
                    @foreach($order->orderItems as $item)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-700">{{ $item->item_name }} ({{ $item->quantity }}x)</span>
                        <span class="font-medium text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <div class="border-t border-gray-200 pt-4 mt-4">
                <h3 class="font-semibold text-gray-800 mb-2">Alamat Pengiriman</h3>
                <div class="text-gray-700">
                    <p class="font-medium">{{ $order->customer_name }}</p>
                    <p>{{ $order->customer_phone }}</p>
                    <p>{{ $order->shipping_address }}</p>
                    <p>{{ $order->city }}, {{ $order->postal_code }}</p>
                </div>
            </div>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('orders.track', $order->order_number) }}" 
               class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition duration-200">
                Lacak Pesanan
            </a>
            <a href="{{ route('products.index') }}" 
               class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-200 transition duration-200">
                Lanjut Belanja
            </a>
        </div>
        
        <div class="mt-8 p-4 bg-blue-50 rounded-lg">
            <p class="text-sm text-blue-800">
                <strong>Informasi:</strong> Simpan nomor pesanan <strong>{{ $order->order_number }}</strong> untuk melacak status pengiriman Anda.
            </p>
        </div>
    </div>
</div>
@endsection
