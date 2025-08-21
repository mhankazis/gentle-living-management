@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')
    
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Success Icon -->
            <div class="text-center mb-8">
                <div class="mx-auto h-24 w-24 bg-gradient-to-br from-green-100 to-emerald-100 rounded-full flex items-center justify-center mb-6">
                    <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Pesanan Berhasil Dibuat!</h1>
                <p class="text-gray-600">Terima kasih atas pesanan Anda. Kami akan segera memproses pesanan ini.</p>
            </div>

    <!-- Main Content -->
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Order Summary Card -->
        <div class="bg-white/80 backdrop-blur-sm border border-gray-200 rounded-lg shadow-md p-8 mb-8">
            <div class="text-center mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-2">Detail Pesanan</h2>
                <p class="text-gray-600">Pesanan Anda telah berhasil dibuat dan akan segera diproses</p>
            </div>

            <!-- Transaction Details -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nomor Transaksi</label>
                        <p class="text-lg font-bold text-emerald-600">{{ $transaction->transaction_number }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Tanggal Pesanan</label>
                        <p class="text-gray-800">{{ $transaction->created_at->format('d F Y, H:i') }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Status Pesanan</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $transaction->status_badge_color }}">
                            {{ $transaction->order_status_label }}
                        </span>
                    </div>
                </div>
                
                <div class="space-y-3">
                    <div>
                        <label class="text-sm font-medium text-gray-500">Nama Penerima</label>
                        <p class="text-gray-800">{{ $transaction->customer_name }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Telepon</label>
                        <p class="text-gray-800">{{ $transaction->customer_phone }}</p>
                    </div>
                    <div>
                        <label class="text-sm font-medium text-gray-500">Alamat Pengiriman</label>
                        <p class="text-gray-800">{{ $transaction->shipping_address }}, {{ $transaction->city }} {{ $transaction->postal_code }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Items -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Produk yang Dipesan</h3>
                <div class="space-y-3">
                    @foreach($transaction->details as $detail)
                        <div class="flex items-center justify-between py-3 border-b border-gray-100 last:border-b-0">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 bg-gradient-to-br from-emerald-200 to-teal-300 rounded-lg flex-shrink-0 flex items-center justify-center">
                                    <svg class="h-6 w-6 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-medium text-gray-800">{{ $detail->item_name }}</h4>
                                    <p class="text-sm text-gray-600">{{ $detail->quantity }} x Rp {{ number_format($detail->item_price, 0, ',', '.') }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-semibold text-gray-800">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Price Summary -->
            <div class="border-t border-gray-200 pt-6 mt-6">
                <div class="space-y-2 max-w-xs ml-auto">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($transaction->subtotal_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>PPN (11%)</span>
                        <span>Rp {{ number_format($transaction->tax_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Ongkos Kirim</span>
                        <span>Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-gray-300 pt-2 flex justify-between font-bold text-lg">
                        <span class="text-gray-800">Total</span>
                        <span class="text-emerald-600">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('history.show', $transaction->transaction_id) }}" 
               class="flex items-center justify-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg font-semibold hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 shadow-md hover:shadow-lg">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Lihat Detail Pesanan
            </a>
            
            <a href="{{ route('products.index') }}" 
               class="flex items-center justify-center px-6 py-3 bg-white border border-gray-300 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-300">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
                Lanjutkan Belanja
            </a>
        </div>

        <!-- Important Notes -->
        <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
            <h3 class="text-lg font-semibold text-blue-800 mb-3">Informasi Penting</h3>
            <ul class="space-y-2 text-blue-700">
                <li class="flex items-start">
                    <svg class="h-5 w-5 mr-2 mt-0.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Pesanan Anda akan dikonfirmasi dalam 1x24 jam
                </li>
                <li class="flex items-start">
                    <svg class="h-5 w-5 mr-2 mt-0.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Simpan nomor transaksi untuk melacak status pesanan Anda
                </li>
                <li class="flex items-start">
                    <svg class="h-5 w-5 mr-2 mt-0.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Anda dapat membatalkan pesanan sebelum status "Dikirim"
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
