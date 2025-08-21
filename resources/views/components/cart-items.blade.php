<!-- Cart Items Section -->
@php
$cartItems = [
  [
    'id' => 1,
    'name' => 'Gentle Oil Cough n Flu',
    'price' => 299000,
    'quantity' => 1,
    'image' => 'bg-gradient-to-br from-emerald-200 to-teal-300',
  ],
  [
    'id' => 2,
    'name' => 'Gentle Baby Deep Sleep',
    'price' => 249000,
    'quantity' => 2,
    'image' => 'bg-gradient-to-br from-blue-200 to-indigo-300',
  ],
  [
    'id' => 3,
    'name' => 'Gentle Baby Bye Bugs',
    'price' => 149000,
    'quantity' => 1,
    'image' => 'bg-gradient-to-br from-amber-200 to-orange-300',
  ],
];
@endphp

<div>
    <h2 class="text-xl font-bold text-gray-800 mb-6">Produk dalam Keranjang</h2>
    
    @forelse ($cartItems as $item)
        <div class="border border-gray-200 rounded-lg p-4 mb-4 hover:shadow-md transition-shadow duration-300">
            <div class="flex items-center space-x-4">
                <!-- Product Image -->
                <div class="w-20 h-20 {{ $item['image'] }} rounded-lg flex-shrink-0 flex items-center justify-center">
                    <svg class="h-8 w-8 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
                
                <!-- Product Info -->
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800 mb-1">{{ $item['name'] }}</h3>
                    <p class="text-gray-600 text-sm">Harga: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                </div>
                
                <!-- Quantity Controls -->
                <div class="flex items-center space-x-3">
                    <button class="w-8 h-8 rounded-lg border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors duration-300">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                    </button>
                    <span class="w-12 text-center font-medium">{{ $item['quantity'] }}</span>
                    <button class="w-8 h-8 rounded-lg border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-gray-50 transition-colors duration-300">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <line x1="12" y1="5" x2="12" y2="19"/>
                            <line x1="5" y1="12" x2="19" y2="12"/>
                        </svg>
                    </button>
                </div>
                
                <!-- Price and Remove -->
                <div class="text-right">
                    <p class="font-bold text-gray-800 mb-2">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                    <button class="text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg p-2 transition-colors duration-300">
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <polyline points="3 6 5 6 21 6"/>
                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                            <line x1="10" y1="11" x2="10" y2="17"/>
                            <line x1="14" y1="11" x2="14" y2="17"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="text-center py-16">
            <div class="mx-auto h-24 w-24 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mb-4">
                <svg class="h-12 w-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61l1.38-7.39H6"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Keranjang Anda Kosong</h3>
            <p class="text-gray-600 mb-6">Belum ada produk dalam keranjang. Mulai berbelanja sekarang!</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg font-medium hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 shadow-md hover:shadow-lg">
                Mulai Belanja
            </a>
        </div>
    @endforelse
</div>
