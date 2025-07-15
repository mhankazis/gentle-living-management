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
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @foreach($products as $product)
        <a href="{{ url('/products/' . $product['id']) }}" class="block group">
          <div class="rounded-xl shadow bg-white p-4 hover:shadow-2xl transition">
            <div class="aspect-square {{ $product['image'] }} rounded-lg mb-4"></div>
            <h3 class="text-lg font-bold mb-1 group-hover:text-blue-600 transition">{{ $product['name'] }}</h3>
            <div class="flex items-center space-x-2">
              <span class="text-xl font-bold">${{ $product['price'] }}</span>
              <span class="text-gray-400 line-through">${{ $product['originalPrice'] }}</span>
            </div>
            <span class="mt-4 inline-block bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center rounded-lg py-2 px-4 font-semibold group-hover:from-blue-700 group-hover:to-purple-700 transition">
              Lihat Detail
            </span>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>
