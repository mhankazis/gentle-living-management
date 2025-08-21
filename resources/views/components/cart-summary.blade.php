<!-- Cart Summary Section -->
@php
$items = [
  ['name' => 'Gentle Oil Cough n Flu', 'price' => 299000, 'quantity' => 1],
  ['name' => 'Gentle Baby Deep Sleep', 'price' => 249000, 'quantity' => 2],
  ['name' => 'Gentle Baby Bye Bugs', 'price' => 149000, 'quantity' => 1],
];

$subtotal = array_sum(array_map(function($item) {
    return $item['price'] * $item['quantity'];
}, $items));

$tax = $subtotal * 0.11; // 11% PPN
$shipping = 25000; // Ongkir flat
$total = $subtotal + $tax + $shipping;
@endphp

<div class="bg-white/80 backdrop-blur-sm border border-gray-200 rounded-lg p-6 shadow-md">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Ringkasan Pesanan</h2>
    
    <!-- Order Items -->
    <div class="space-y-3 mb-6">
        @foreach ($items as $item)
            <div class="flex justify-between items-center text-sm">
                <span class="text-gray-600">{{ $item['name'] }} x{{ $item['quantity'] }}</span>
                <span class="font-medium text-gray-800">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
            </div>
        @endforeach
    </div>
    
    <!-- Summary Calculations -->
    <div class="border-t border-gray-200 pt-4 space-y-3">
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
            <span>Rp {{ number_format($shipping, 0, ',', '.') }}</span>
        </div>
        <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
            <span class="text-lg font-bold text-gray-800">Total</span>
            <span class="text-xl font-bold text-emerald-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
        </div>
    </div>
    
    <!-- Promo Code Section -->
    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
        <label for="promo-code" class="block text-sm font-medium text-gray-700 mb-2">Kode Promo</label>
        <div class="flex space-x-2">
            <input 
                type="text" 
                id="promo-code" 
                name="promo-code" 
                placeholder="Masukkan kode promo"
                class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm"
            >
            <button 
                type="button" 
                class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-300 text-sm font-medium"
            >
                Terapkan
            </button>
        </div>
    </div>
    
    <!-- Checkout Button -->
    <div class="mt-6">
        <button class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 text-white py-3 px-6 rounded-lg font-semibold hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 shadow-md hover:shadow-lg">
            Lanjutkan ke Checkout
        </button>
    </div>
    
    <!-- Continue Shopping -->
    <div class="mt-4">
        <a href="{{ route('products.index') }}" class="w-full block text-center bg-white border border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-300">
            Lanjutkan Belanja
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
