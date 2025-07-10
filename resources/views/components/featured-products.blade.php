<!-- Featured Products Section -->
@php
$products = [
  [
    'id' => 1,
    'name' => 'Premium Wireless Headphones',
    'price' => 299,
    'originalPrice' => 399,
    'rating' => 4.8,
    'reviews' => 124,
    'image' => 'bg-gradient-to-br from-slate-200 to-slate-300',
    'badge' => 'Best Seller',
    'badgeColor' => 'bg-green-500',
  ],
  [
    'id' => 2,
    'name' => 'Smart Fitness Watch',
    'price' => 249,
    'originalPrice' => 329,
    'rating' => 4.9,
    'reviews' => 89,
    'image' => 'bg-gradient-to-br from-blue-200 to-blue-300',
    'badge' => 'New',
    'badgeColor' => 'bg-blue-500',
  ],
  [
    'id' => 3,
    'name' => 'Designer Leather Wallet',
    'price' => 79,
    'originalPrice' => 99,
    'rating' => 4.7,
    'reviews' => 56,
    'image' => 'bg-gradient-to-br from-amber-200 to-amber-300',
    'badge' => 'Sale',
    'badgeColor' => 'bg-red-500',
  ],
  [
    'id' => 4,
    'name' => 'Professional Camera Lens',
    'price' => 599,
    'originalPrice' => 749,
    'rating' => 4.9,
    'reviews' => 203,
    'image' => 'bg-gradient-to-br from-gray-200 to-gray-300',
    'badge' => 'Pro',
    'badgeColor' => 'bg-purple-500',
  ],
  [
    'id' => 5,
    'name' => 'Luxury Sunglasses',
    'price' => 189,
    'originalPrice' => 249,
    'rating' => 4.6,
    'reviews' => 78,
    'image' => 'bg-gradient-to-br from-rose-200 to-rose-300',
    'badge' => 'Trending',
    'badgeColor' => 'bg-pink-500',
  ],
  [
    'id' => 6,
    'name' => 'Gaming Mechanical Keyboard',
    'price' => 149,
    'originalPrice' => 199,
    'rating' => 4.8,
    'reviews' => 167,
    'image' => 'bg-gradient-to-br from-cyan-200 to-cyan-300',
    'badge' => 'Popular',
    'badgeColor' => 'bg-cyan-500',
  ],
];
@endphp
<section class="py-20 bg-white">
  <div class="container mx-auto px-4">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold text-gray-900 mb-4">Featured Products</h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        Produk pilihan premium yang mendefinisikan kualitas dan gaya
      </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
      @foreach ($products as $product)
      <div class="group hover:shadow-2xl transition-all duration-300 border-0 bg-white/80 backdrop-blur-sm overflow-hidden rounded-2xl">
        <div class="relative">
          <div class="aspect-square {{ $product['image'] }} relative overflow-hidden">
            <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-colors duration-300"></div>
            <span class="absolute top-4 left-4 {{ $product['badgeColor'] }} text-white text-xs font-semibold px-3 py-1 rounded-full">{{ $product['badge'] }}</span>
            <button class="absolute top-4 right-4 h-8 w-8 rounded-full bg-white/90 hover:bg-white transition-colors text-gray-600 hover:text-red-500 flex items-center justify-center">
              <!-- Heart Icon -->
              <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/></svg>
            </button>
          </div>
        </div>
        <div class="p-6">
          <h3 class="font-semibold text-lg text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
            {{ $product['name'] }}
          </h3>
          <div class="flex items-center space-x-2 mb-3">
            <div class="flex items-center">
              @for ($i = 0; $i < 5; $i++)
                <svg class="h-4 w-4 {{ $i < floor($product['rating']) ? 'fill-yellow-400 text-yellow-400' : 'text-gray-300' }}" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              @endfor
            </div>
            <span class="text-sm text-gray-600">({{ $product['reviews'] }})</span>
          </div>
          <div class="flex items-center space-x-2 mb-4">
            <span class="text-2xl font-bold text-gray-900">${{ $product['price'] }}</span>
            <span class="text-lg text-gray-500 line-through">${{ $product['originalPrice'] }}</span>
            <span class="text-green-600 text-xs font-semibold border border-green-200 rounded px-2 py-1 bg-green-50">Save ${{ $product['originalPrice'] - $product['price'] }}</span>
          </div>
          <button class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold py-3 rounded-lg flex items-center justify-center group">
            <svg class="mr-2 h-4 w-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
            Add to Cart
          </button>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
