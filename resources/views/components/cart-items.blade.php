<!-- Cart Items Section (Blade, statis, versi rapi) -->
@php
$cartItems = [
  [
    'id' => 1,
    'name' => 'Gentle Oil Cough n Flu',
    'price' => 299,
    'quantity' => 1,
    'image' => 'bg-gradient-to-br from-slate-200 to-slate-300',
  ],
  [
    'id' => 2,
    'name' => 'Gentle Baby Deep Sleep',
    'price' => 249,
    'quantity' => 2,
    'image' => 'bg-gradient-to-br from-blue-200 to-blue-300',
  ],
  [
    'id' => 3,
    'name' => 'Gentle Baby Bye Bugs',
    'price' => 49,
    'quantity' => 1,
    'image' => 'bg-gradient-to-br from-amber-200 to-amber-300',
  ],
];
@endphp
<div>
  <h2 class="text-2xl font-bold text-gray-900 mb-6">Your Items</h2>
  <div class="flex flex-col gap-6">
    @forelse ($cartItems as $item)
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow p-6 flex items-center justify-between">
        <div class="flex items-center gap-4 min-w-0">
          <div class="w-20 h-20 {{ $item['image'] }} rounded-lg flex-shrink-0"></div>
          <div class="min-w-0">
            <h3 class="font-semibold text-lg text-gray-900 mb-1 truncate">{{ $item['name'] }}</h3>
            <p class="text-2xl font-bold text-gray-900">${{ $item['price'] }}</p>
          </div>
        </div>
        <div class="flex items-center space-x-2">
          <button class="border border-gray-300 rounded px-2 py-1 text-gray-700 disabled:opacity-50" disabled>
            <!-- Minus Icon -->
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </button>
          <input type="number" value="{{ $item['quantity'] }}" min="1" class="w-16 text-center border border-gray-300 rounded py-1" readonly />
          <button class="border border-gray-300 rounded px-2 py-1 text-gray-700">
            <!-- Plus Icon -->
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
          </button>
        </div>
        <div class="text-right min-w-[90px]">
          <p class="text-xl font-bold text-gray-900 mb-2">${{ $item['price'] * $item['quantity'] }}</p>
          <button class="text-red-500 hover:text-red-700 hover:bg-red-50 rounded-full p-2">
            <!-- Trash2 Icon -->
            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/><line x1="10" y1="11" x2="10" y2="17"/><line x1="14" y1="11" x2="14" y2="17"/></svg>
          </button>
        </div>
      </div>
    @empty
      <div class="bg-white/80 backdrop-blur-sm rounded-2xl shadow p-12 text-center">
        <p class="text-gray-500 text-lg">Your cart is empty</p>
        <a href="/products" class="inline-block mt-4 bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-lg font-semibold">Continue Shopping</a>
      </div>
    @endforelse
  </div>
</div>
