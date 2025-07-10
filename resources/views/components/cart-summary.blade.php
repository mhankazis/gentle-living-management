@php
$subtotal = 827;
$shipping = 0;
$tax = 82.70;
$total = $subtotal + $shipping + $tax;
@endphp
<div class="space-y-6">
  <div class="border-0 bg-white/80 backdrop-blur-sm rounded-2xl shadow">
    <div class="p-6 pb-0">
      <h2 class="text-xl font-bold mb-4">Order Summary</h2>
      <div class="space-y-4">
        <div class="flex justify-between">
          <span class="text-gray-600">Subtotal</span>
          <span class="font-semibold">${{ $subtotal }}</span>
        </div>
        <div class="flex justify-between items-center">
          <span class="text-gray-600">Shipping</span>
          <div class="flex items-center space-x-2">
            <span class="text-green-600 border border-green-200 rounded px-2 py-1 bg-green-50 text-xs font-semibold">FREE</span>
            <span class="line-through text-gray-400">${{ $shipping }}</span>
          </div>
        </div>
        <div class="flex justify-between">
          <span class="text-gray-600">Tax</span>
          <span class="font-semibold">${{ number_format($tax, 2) }}</span>
        </div>
        <div class="my-4 border-t border-gray-200"></div>
        <div class="flex justify-between text-xl font-bold">
          <span>Total</span>
          <span>${{ number_format($total, 2) }}</span>
        </div>
      </div>
    </div>
  </div>
  <div class="border-0 bg-white/80 backdrop-blur-sm rounded-2xl shadow">
    <div class="p-6">
      <h3 class="font-semibold text-lg mb-4">Promo Code</h3>
      <div class="flex space-x-2">
        <input placeholder="Enter code" class="border border-gray-300 rounded px-4 py-2 w-full" />
        <button class="border border-gray-300 rounded px-4 py-2 font-semibold bg-white hover:bg-gray-50 transition">Apply</button>
      </div>
    </div>
  </div>
  <button class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-6 rounded-lg flex items-center justify-center text-lg">
    <!-- CreditCard Icon -->
    <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
    Proceed to Checkout
  </button>
  <div class="space-y-3 text-sm text-gray-600">
    <div class="flex items-center space-x-2">
      <!-- Truck Icon -->
      <svg class="h-4 w-4 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="3" width="15" height="13" rx="2"/><path d="M16 8h3l4 4v4a2 2 0 0 1-2 2H17a2 2 0 0 1-2-2v-4a2 2 0 0 1 2-2z"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/></svg>
      <span>Free shipping on orders over $100</span>
    </div>
    <div class="flex items-center space-x-2">
      <!-- Shield Icon -->
      <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
      <span>Secure checkout with SSL encryption</span>
    </div>
    <div class="flex items-center space-x-2">
      <!-- CreditCard Icon -->
      <svg class="h-4 w-4 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="5" width="20" height="14" rx="2"/><line x1="2" y1="10" x2="22" y2="10"/></svg>
      <span>30-day money-back guarantee</span>
    </div>
  </div>
</div>
