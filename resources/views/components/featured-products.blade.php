<!-- Featured Products Section -->
@php
$products = [
  [
    'id' => 1,
    'name' => 'Gentle Oil Cough n Flu',
    'price' => 299,
    'originalPrice' => 399,
    'rating' => 4.9,
    'reviews' => 124,
    'image' => 'bg-gradient-to-br from-emerald-200 to-teal-300',
    'badge' => 'Best Seller',
    'badgeColor' => 'bg-emerald-500',
  ],
  [
    'id' => 2,
    'name' => 'Gentle Baby Deep Sleep',
    'price' => 249,
    'originalPrice' => 329,
    'rating' => 4.8,
    'reviews' => 89,
    'image' => 'bg-gradient-to-br from-amber-200 to-orange-300',
    'badge' => 'New',
    'badgeColor' => 'bg-blue-500',
  ],
  [
    'id' => 3,
    'name' => 'Gentle Baby Bye Bugs',
    'price' => 49,
    'originalPrice' => 69,
    'rating' => 4.6,
    'reviews' => 156,
    'image' => 'bg-gradient-to-br from-pink-200 to-rose-300',
    'badge' => 'Sale',
    'badgeColor' => 'bg-red-500',
  ],
  [
    'id' => 4,
    'name' => 'Gentle Baby LDR Booster',
    'price' => 599,
    'originalPrice' => 749,
    'rating' => 4.9,
    'reviews' => 203,
    'image' => 'bg-gradient-to-br from-blue-200 to-indigo-300',
    'badge' => 'Natural',
    'badgeColor' => 'bg-green-600',
  ],
  [
    'id' => 5,
    'name' => 'Gentle Baby Joy',
    'price' => 189,
    'originalPrice' => 249,
    'rating' => 4.6,
    'reviews' => 78,
    'image' => 'bg-gradient-to-br from-purple-200 to-violet-300',
    'badge' => 'Herbal',
    'badgeColor' => 'bg-purple-500',
  ],
  [
    'id' => 6,
    'name' => 'Gentle Baby Immboost',
    'price' => 89,
    'originalPrice' => 119,
    'rating' => 4.7,
    'reviews' => 92,
    'image' => 'bg-gradient-to-br from-teal-200 to-cyan-300',
    'badge' => 'Bundle',
    'badgeColor' => 'bg-teal-500',
  ],
];
@endphp
<section class="py-20 bg-white">
  <div class="container mx-auto px-4">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-4">Produk Unggulan</h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        Produk perawatan alami terpilih yang dipercaya keluarga Indonesia
      </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @foreach($products as $product)
        <a href="{{ url('/products/' . $product['id']) }}" class="block group">
          <div class="rounded-xl shadow bg-white p-4 hover:shadow-2xl transition">
            <div class="aspect-square {{ $product['image'] }} rounded-lg mb-4"></div>
            <h3 class="text-lg font-bold mb-1 group-hover:text-blue-600 transition">{{ $product['name'] }}</h3>
            <div class="flex items-center space-x-2">
              <span class="text-xl font-bold">Rp {{ number_format($product['price'], 0, ',', '.') }}K</span>
              <span class="text-gray-400 line-through">Rp {{ number_format($product['originalPrice'], 0, ',', '.') }}K</span>
            </div>
            <span class="mt-4 inline-block bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-center rounded-lg py-2 px-4 font-semibold group-hover:from-emerald-700 group-hover:to-teal-700 transition">
              Lihat Detail
            </span>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>
