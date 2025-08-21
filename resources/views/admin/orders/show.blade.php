@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')
    
    <div class="container mx-auto px-4 py-8">
        <!-- Admin Header Section -->
        <div class="mb-8">
            <div class="text-center">
                <h1 class="text-4xl font-bold text-gray-800 mb-2">Detail Pesanan #{{ $order->number ?? 'TS-' . $order->transaction_sales_id }}</h1>
                <p class="text-gray-600 text-lg">{{ $order->created_at->format('d F Y, H:i') }}</p>
                <div class="flex justify-center mt-4 space-x-4">
                    <span class="bg-blue-100 text-blue-800 px-4 py-2 rounded-full text-sm font-medium">Admin Panel</span>
                    <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                        <svg class="h-4 w-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Order Information -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Customer Information -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Informasi Customer</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->customer_email }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->customer_phone }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kota</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->city }} - {{ $order->postal_code }}</p>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Alamat Pengiriman</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->shipping_address }}</p>
                    </div>
                    @if($order->notes)
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Catatan Pesanan</label>
                        <p class="mt-1 text-sm text-gray-900">{{ $order->notes }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Produk yang Dipesan</h2>
                <div class="space-y-4">
                    @foreach($order->details as $item)
                    <div class="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-200 to-indigo-300 rounded-lg flex items-center justify-center flex-shrink-0">
                            <svg class="h-8 w-8 text-blue-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                            </svg>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-sm font-medium text-gray-900">{{ $item->item_name }}</h3>
                            <p class="text-sm text-gray-500">Rp {{ number_format($item->item_price, 0, ',', '.') }} × {{ $item->quantity }}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-sm font-medium text-gray-900">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Order Summary -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Subtotal</span>
                            <span class="text-gray-900">Rp {{ number_format($order->subtotal_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">Ongkos Kirim</span>
                            <span class="text-gray-900">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">PPN (11%)</span>
                            <span class="text-gray-900">Rp {{ number_format($order->tax_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-gray-200 pt-2">
                            <div class="flex justify-between">
                                <span class="text-base font-medium text-gray-900">Total</span>
                                <span class="text-base font-bold text-blue-600">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cancellation Request -->
            @if($order->order_status === 'cancellation_requested')
            <div class="bg-orange-50 border border-orange-200 rounded-lg p-6">
                <h2 class="text-lg font-semibold text-orange-900 mb-4">Permintaan Pembatalan</h2>
                <div class="space-y-2">
                    <div>
                        <label class="block text-sm font-medium text-orange-800">Alasan Pembatalan</label>
                        <p class="mt-1 text-sm text-orange-900">{{ $order->cancellation_reason }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-orange-800">Waktu Permintaan</label>
                        <p class="mt-1 text-sm text-orange-900">{{ $order->cancellation_requested_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
                
                <div class="mt-4 flex space-x-4">
                    <form action="{{ route('admin.orders.approve-cancellation', $order->transaction_sales_id) }}" method="POST" class="inline">
                        @csrf
                        <div class="mb-2">
                            <textarea name="admin_notes" placeholder="Catatan admin (opsional)" 
                                      class="w-full px-3 py-2 border border-orange-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500" rows="2"></textarea>
                        </div>
                        <button type="submit" onclick="return confirm('Yakin ingin menyetujui pembatalan pesanan ini?')"
                                class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                            Setujui Pembatalan
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.orders.reject-cancellation', $order->transaction_sales_id) }}" method="POST" class="inline">
                        @csrf
                        <div class="mb-2">
                            <textarea name="admin_notes" placeholder="Alasan penolakan (wajib)" required
                                      class="w-full px-3 py-2 border border-orange-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-orange-500" rows="2"></textarea>
                        </div>
                        <button type="submit" onclick="return confirm('Yakin ingin menolak pembatalan pesanan ini?')"
                                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            Tolak Pembatalan
                        </button>
                    </form>
                </div>
            </div>
            @endif
        </div>

        <!-- Order Management -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Current Status -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Status Pesanan</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Pesanan</label>
                        <div class="mt-1">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                @switch($order->order_status)
                                    @case('pending') bg-yellow-100 text-yellow-800 @break
                                    @case('confirmed') bg-blue-100 text-blue-800 @break
                                    @case('processing') bg-purple-100 text-purple-800 @break
                                    @case('shipped') bg-indigo-100 text-indigo-800 @break
                                    @case('delivered') bg-green-100 text-green-800 @break
                                    @case('cancelled') bg-red-100 text-red-800 @break
                                    @case('cancellation_requested') bg-orange-100 text-orange-800 @break
                                    @default bg-gray-100 text-gray-800
                                @endswitch
                            ">
                                @switch($order->order_status)
                                    @case('pending') Menunggu Konfirmasi @break
                                    @case('confirmed') Dikonfirmasi @break
                                    @case('processing') Sedang Diproses @break
                                    @case('shipped') Dikirim @break
                                    @case('delivered') Selesai @break
                                    @case('cancelled') Dibatalkan @break
                                    @case('cancellation_requested') Permintaan Pembatalan @break
                                    @default {{ ucfirst($order->order_status) }}
                                @endswitch
                            </span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status Pembayaran</label>
                        <div class="mt-1">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                @switch($order->payment_status)
                                    @case('pending') bg-yellow-100 text-yellow-800 @break
                                    @case('paid') bg-green-100 text-green-800 @break
                                    @case('failed') bg-red-100 text-red-800 @break
                                    @case('refunded') bg-gray-100 text-gray-800 @break
                                    @default bg-gray-100 text-gray-800
                                @endswitch
                            ">
                                @switch($order->payment_status)
                                    @case('pending') Belum Bayar @break
                                    @case('paid') Sudah Bayar @break
                                    @case('failed') Gagal @break
                                    @case('refunded') Dikembalikan @break
                                    @default {{ ucfirst($order->payment_status) }}
                                @endswitch
                            </span>
                        </div>
                        @if($order->payment_status === 'paid')
                        <p class="text-xs text-gray-500 mt-1">Dibayar: Rp {{ number_format($order->paid_amount, 0, ',', '.') }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Update Order Status -->
            @if($order->status !== 'cancelled')
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Update Status Pesanan</h2>
                <form action="{{ route('admin.orders.update-status', $order->transaction_sales_id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Baru</label>
                            <select name="status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Status</option>
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Menunggu</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Diproses</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Selesai</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin</label>
                            <textarea name="admin_notes" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Catatan untuk perubahan status (opsional)">{{ $order->admin_notes }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors">
                            Update Status
                        </button>
                    </div>
                </form>
            </div>
            @endif

            <!-- Update Payment Status -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Update Status Pembayaran</h2>
                <form action="{{ route('admin.orders.update-payment', $order->transaction_sales_id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Status Pembayaran</label>
                            <select name="payment_status" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Pilih Status</option>
                                <option value="unpaid" {{ $order->payment_status == 'unpaid' ? 'selected' : '' }}>Belum Bayar</option>
                                <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Sudah Bayar</option>
                                <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Gagal</option>
                                <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Dikembalikan</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Dibayar</label>
                            <input type="number" name="paid_amount" value="{{ $order->paid_amount }}" step="0.01" min="0"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                   placeholder="0">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Pembayaran</label>
                            <textarea name="payment_notes" rows="3" 
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                      placeholder="Catatan pembayaran (opsional)">{{ $order->payment_notes ?? '' }}</textarea>
                        </div>

                        <button type="submit" class="w-full bg-green-600 text-white py-2 px-4 rounded-lg hover:bg-green-700 transition-colors">
                            Update Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    @include('components.features')
    @include('components.footer')
</div>
@endsection
