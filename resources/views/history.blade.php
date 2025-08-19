<!-- Riwayat Page -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')

    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Riwayat Transaksi</h1>
            <p class="text-gray-600">Kelola transaksi dan lacak status pembayaran Anda</p>
        </div>

        <!-- Filter Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <form method="GET" action="{{ route('history.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <!-- Status Filter -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Lunas</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        <option value="refunded" {{ request('status') == 'refunded' ? 'selected' : '' }}>Refund</option>
                    </select>
                </div>

                <!-- Date From -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                    <input type="date" name="date_from" value="{{ request('date_from') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <!-- Date To -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                    <input type="date" name="date_to" value="{{ request('date_to') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
                </div>

                <!-- Submit Button -->
                <div class="flex items-end">
                    <button type="submit" class="w-full px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg font-medium hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 shadow-md hover:shadow-lg">
                        Filter
                    </button>
                </div>
            </form>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Transaction List -->
        @if($transactions->count() > 0)
            @foreach($transactions as $transaction)
                <div class="bg-white rounded-lg border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300 mb-6">
                    <div class="p-6">
                        <!-- Transaction Header -->
                        <div class="flex items-start justify-between mb-4 pb-4 border-b border-gray-200">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-1">{{ $transaction->transaction_code }}</h3>
                                <p class="text-gray-600 text-sm">{{ $transaction->transaction_date->format('d M Y, H:i') }}</p>
                                <p class="text-gray-600 text-sm">Metode Pembayaran: {{ ucfirst($transaction->payment_method ?? 'Belum dipilih') }}</p>
                            </div>
                            
                            <!-- Status Badge -->
                            <div>
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
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $statusColors[$transaction->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusTexts[$transaction->status] ?? ucfirst($transaction->status) }}
                                </span>
                            </div>
                        </div>

                        <!-- Transaction Details -->
                        <div class="space-y-3 mb-4">
                            @foreach($transaction->details as $detail)
                                <div class="flex items-center space-x-4">
                                    <!-- Product Image -->
                                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-200 to-teal-300 rounded-lg flex-shrink-0 flex items-center justify-center">
                                        @if($detail->product && $detail->product->image)
                                            <img src="{{ asset('images/' . $detail->product->image) }}" 
                                                 alt="{{ $detail->product_name }}" 
                                                 class="w-full h-full object-cover rounded-lg">
                                        @else
                                            <svg class="h-8 w-8 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                            </svg>
                                        @endif
                                    </div>
                                    
                                    <!-- Product Info -->
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800">{{ $detail->product_name }}</h4>
                                        <p class="text-gray-600 text-sm">Harga: Rp {{ number_format($detail->product_price, 0, ',', '.') }}</p>
                                        <p class="text-gray-600 text-sm">Qty: {{ $detail->quantity }}</p>
                                    </div>
                                    
                                    <!-- Subtotal -->
                                    <div class="text-right">
                                        <p class="font-semibold text-gray-800">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Transaction Summary -->
                        <div class="border-t border-gray-200 pt-4">
                            <div class="flex items-center justify-between mb-2">
                                <div class="space-y-1">
                                    @if($transaction->discount_amount > 0)
                                        <p class="text-gray-600 text-sm">Subtotal: Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                                        <p class="text-gray-600 text-sm">Diskon: -Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }}</p>
                                    @endif
                                    @if($transaction->tax_amount > 0)
                                        <p class="text-gray-600 text-sm">Pajak: Rp {{ number_format($transaction->tax_amount, 0, ',', '.') }}</p>
                                    @endif
                                    <p class="text-lg font-bold text-blue-600">Total: Rp {{ number_format($transaction->final_amount, 0, ',', '.') }}</p>
                                </div>
                                
                                <div class="flex space-x-3">
                                    <a href="{{ route('history.show', $transaction->id) }}" 
                                       class="px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-lg font-medium hover:from-blue-600 hover:to-indigo-600 transition-all duration-300 shadow-md hover:shadow-lg">
                                        Detail
                                    </a>
                                    
                                    @if($transaction->status == 'pending')
                                        <form action="{{ route('history.cancel', $transaction->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    onclick="return confirm('Apakah Anda yakin ingin membatalkan transaksi ini?')"
                                                    class="px-4 py-2 border border-red-300 text-red-600 rounded-lg font-medium hover:bg-red-50 transition-colors duration-300">
                                                Batalkan
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                            
                            @if($transaction->notes)
                                <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                                    <p class="text-gray-700 text-sm"><strong>Catatan:</strong> {{ $transaction->notes }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div class="mt-8">
                {{ $transactions->appends(request()->query())->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="mx-auto h-24 w-24 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="h-12 w-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada riwayat transaksi</h3>
                <p class="text-gray-600 mb-6">Anda belum memiliki transaksi apapun. Mulai berbelanja sekarang!</p>
                <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg font-medium hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 shadow-md hover:shadow-lg">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>

    @include('components.features')
    @include('components.footer')
</div>
@endsection