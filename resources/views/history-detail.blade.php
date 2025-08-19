@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')

    <div class="container mx-auto px-4 py-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('history.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-emerald-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Riwayat
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Detail Transaksi</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Transaction Header -->
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ $transaction->transaction_code }}</h1>
                    <p class="text-gray-600">{{ $transaction->transaction_date->format('d M Y, H:i') }}</p>
                </div>
                
                @php
                    $statusColors = [
                        'pending' => 'bg-yellow-100 text-yellow-800',
                        'paid' => 'bg-green-100 text-green-800',
                        'cancelled' => 'bg-red-100 text-red-800',
                        'refunded' => 'bg-gray-100 text-gray-800'
                    ];
                    $statusTexts = [
                        'pending' => 'Pending',
                        'paid' => 'Lunas',
                        'cancelled' => 'Dibatalkan',
                        'refunded' => 'Refund'
                    ];
                @endphp
                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $statusColors[$transaction->status] ?? 'bg-gray-100 text-gray-800' }}">
                    {{ $statusTexts[$transaction->status] ?? ucfirst($transaction->status) }}
                </span>
            </div>

            <!-- Customer Info -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Pelanggan</h3>
                    <div class="space-y-2">
                        <p class="text-gray-600"><span class="font-medium">Nama:</span> {{ $transaction->user->name }}</p>
                        <p class="text-gray-600"><span class="font-medium">Email:</span> {{ $transaction->user->email }}</p>
                        <p class="text-gray-600"><span class="font-medium">No. HP:</span> {{ $transaction->user->no_hp ?? 'Tidak tersedia' }}</p>
                    </div>
                </div>
                
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Pembayaran</h3>
                    <div class="space-y-2">
                        <p class="text-gray-600"><span class="font-medium">Metode:</span> {{ ucfirst($transaction->payment_method ?? 'Belum dipilih') }}</p>
                        <p class="text-gray-600"><span class="font-medium">Total:</span> Rp {{ number_format($transaction->final_amount, 0, ',', '.') }}</p>
                        <p class="text-gray-600"><span class="font-medium">Status:</span> {{ $statusTexts[$transaction->status] ?? ucfirst($transaction->status) }}</p>
                    </div>
                </div>
            </div>

            @if($transaction->notes)
                <div class="p-4 bg-gray-50 rounded-lg">
                    <h4 class="font-medium text-gray-800 mb-2">Catatan:</h4>
                    <p class="text-gray-700">{{ $transaction->notes }}</p>
                </div>
            @endif
        </div>

        <!-- Products Detail -->
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Detail Produk</h2>
            
            <div class="space-y-4">
                @foreach($transaction->details as $detail)
                    <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg hover:bg-gray-50 transition-colors duration-300">
                        <!-- Product Image -->
                        <div class="w-20 h-20 bg-gradient-to-br from-emerald-200 to-teal-300 rounded-lg flex-shrink-0 flex items-center justify-center">
                            @if($detail->product && $detail->product->image)
                                <img src="{{ asset('images/' . $detail->product->image) }}" 
                                     alt="{{ $detail->product_name }}" 
                                     class="w-full h-full object-cover rounded-lg">
                            @else
                                <svg class="h-10 w-10 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            @endif
                        </div>
                        
                        <!-- Product Info -->
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $detail->product_name }}</h3>
                            <p class="text-gray-600 text-sm mb-1">Harga Satuan: Rp {{ number_format($detail->product_price, 0, ',', '.') }}</p>
                            <p class="text-gray-600 text-sm">Jumlah: {{ $detail->quantity }} item</p>
                            @if($detail->notes)
                                <p class="text-gray-500 text-sm mt-1">Catatan: {{ $detail->notes }}</p>
                            @endif
                        </div>
                        
                        <!-- Subtotal -->
                        <div class="text-right">
                            <p class="text-xl font-bold text-blue-600">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Transaction Summary -->
        <div class="bg-white rounded-lg shadow-lg border border-gray-200 p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6">Ringkasan Transaksi</h2>
            
            <div class="space-y-3">
                <div class="flex justify-between items-center">
                    <span class="text-gray-600">Subtotal</span>
                    <span class="font-medium">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                </div>
                
                @if($transaction->discount_amount > 0)
                    <div class="flex justify-between items-center text-green-600">
                        <span>Diskon</span>
                        <span class="font-medium">-Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }}</span>
                    </div>
                @endif
                
                @if($transaction->tax_amount > 0)
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Pajak</span>
                        <span class="font-medium">Rp {{ number_format($transaction->tax_amount, 0, ',', '.') }}</span>
                    </div>
                @endif
                
                <hr class="my-4">
                
                <div class="flex justify-between items-center text-xl font-bold">
                    <span class="text-gray-800">Total Pembayaran</span>
                    <span class="text-blue-600">Rp {{ number_format($transaction->final_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-center space-x-4">
            <a href="{{ route('history.index') }}" 
               class="px-6 py-3 bg-gray-500 text-white rounded-lg font-medium hover:bg-gray-600 transition-colors duration-300">
                Kembali ke Riwayat
            </a>
            
            @if($transaction->status == 'pending')
                <form action="{{ route('history.cancel', $transaction->id) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            onclick="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini?')"
                            class="px-6 py-3 bg-red-500 text-white rounded-lg font-medium hover:bg-red-600 transition-colors duration-300">
                        Batalkan Transaksi
                    </button>
                </form>
            @endif
            
            @if($transaction->status == 'paid')
                <button onclick="window.print()" 
                        class="px-6 py-3 bg-blue-500 text-white rounded-lg font-medium hover:bg-blue-600 transition-colors duration-300">
                    Cetak Invoice
                </button>
            @endif
        </div>
    </div>

    @include('components.features')
    @include('components.footer')
</div>

<script>
// Print styles for invoice
const printStyles = `
    @media print {
        body * { visibility: hidden; }
        .container, .container * { visibility: visible; }
        header, footer, nav, .no-print { display: none !important; }
        .container { position: static; }
    }
`;

document.head.insertAdjacentHTML('beforeend', `<style>${printStyles}</style>`);
</script>
@endsection
