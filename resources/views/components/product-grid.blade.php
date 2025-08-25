@php
$allProducts = [
    [
        'id' => 1,
        'name' => 'Gentle Oil Cough n Flu',
        'price' => 299,
        'originalPrice' => 399,
        'rating' => 4.8,
        'reviews' => 124,
        'image' => '/images/CNF-10-ml.jpg',
        'category' => 'Minyak Bayi',
        'badge' => 'Best Seller',
    ],
    [
        'id' => 2,
        'name' => 'Gentle Baby Deep Sleep',
        'price' => 249,
        'originalPrice' => 329,
        'rating' => 4.9,
        'reviews' => 89,
        'image' => '/images/DS-10-ml.jpg',
        'category' => 'Minyak Bayi',
        'badge' => 'New',
    ],
    [
        'id' => 3,
        'name' => 'Gentle Baby Bye Bugs',
        'price' => 49,
        'originalPrice' => 69,
        'rating' => 4.6,
        'reviews' => 156,
        'image' => '/images/BB-10-ml.jpg',
        'category' => 'Minyak Bayi',
        'badge' => 'Sale',
    ],
    [
        'id' => 4,
        'name' => 'Gentle Baby LDR Booster',
        'price' => 599,
        'originalPrice' => 749,
        'rating' => 4.9,
        'reviews' => 203,
        'image' => '/images/LDR-10-ml.jpg',
        'category' => 'Minyak Bayi',
        'badge' => 'Pro',
    ],
    [
        'id' => 5,
        'name' => 'Gentle Baby Joy',
        'price' => 189,
        'originalPrice' => 249,
        'rating' => 4.6,
        'reviews' => 78,
        'image' => '/images/JOY-10-ml.jpg',
        'category' => 'Minyak Bayi',
        'badge' => 'Trending',
    ],
    [
        'id' => 6,
        'name' => 'Gentle Baby Immboost',
        'price' => 89,
        'originalPrice' => 119,
        'rating' => 4.7,
        'reviews' => 92,
        'image' => '/images/IB-10-ml.jpg',
        'category' => 'Minyak Bayi',
        'badge' => 'Popular',
    ],
];
$selectedCategory = request('category', 'all');
$sortBy = request('sort', 'name');
$filtered = $selectedCategory === 'all' ? $allProducts : array_filter($allProducts, fn($p) => $p['category'] === $selectedCategory);
$sorted = $filtered;
if ($sortBy === 'price-low') {
    usort($sorted, fn($a, $b) => $a['price'] <=> $b['price']);
} elseif ($sortBy === 'price-high') {
    usort($sorted, fn($a, $b) => $b['price'] <=> $a['price']);
} elseif ($sortBy === 'rating') {
    usort($sorted, fn($a, $b) => $b['rating'] <=> $a['rating']);
} else {
    usort($sorted, fn($a, $b) => strcmp($a['name'], $b['name']));
}
@endphp
<div>
    <div class="flex justify-between items-center mb-8">
        <h2 class="text-2xl font-bold text-gray-900">
            {{ $selectedCategory === 'all' ? 'All Products' : ucfirst($selectedCategory) . ' Products' }}
        </h2>
        <p class="text-gray-600">{{ count($sorted) }} products found</p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($sorted as $product)
            <div class="rounded-xl shadow bg-white p-4 hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 group">
                <a href="{{ url('/products/' . $product['id']) }}">
                    <div class="aspect-square rounded-lg mb-4 overflow-hidden bg-gradient-to-br from-gray-100 to-gray-200 relative">
                        <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                        
                        @if($product['badge'])
                        <div class="absolute top-2 left-2 bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                            {{ $product['badge'] }}
                        </div>
                        @endif
                        
                        <!-- Thumbnail indicator untuk menunjukkan ada varian ukuran -->
                        <div class="absolute bottom-2 right-2 bg-white/90 backdrop-blur-sm rounded-full p-1">
                            <div class="flex space-x-1">
                                <div class="w-1.5 h-1.5 bg-blue-500 rounded-full"></div>
                                <div class="w-1.5 h-1.5 bg-blue-300 rounded-full"></div>
                                <div class="w-1.5 h-1.5 bg-blue-200 rounded-full"></div>
                            </div>
                        </div>
                    </div>
                    <h3 class="text-lg font-bold mb-1 hover:text-blue-600 transition line-clamp-2">{{ $product['name'] }}</h3>
                </a>
                <div class="flex items-center space-x-2 mb-2">
                    <span class="text-xl font-bold text-blue-600">Rp {{ number_format($product['price'] * 1000, 0, ',', '.') }}</span>
                    <span class="text-gray-400 line-through text-sm">Rp {{ number_format($product['originalPrice'] * 1000, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center space-x-1 mb-3">
                    @for($i = 1; $i <= 5; $i++)
                    <svg class="w-4 h-4 {{ $i <= $product['rating'] ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                    </svg>
                    @endfor
                    <span class="text-sm text-gray-500 ml-1">({{ $product['reviews'] }})</span>
                </div>
                <a href="{{ url('/products/' . $product['id']) }}" class="block w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center rounded-lg py-2 font-semibold hover:from-blue-700 hover:to-purple-700 transition transform hover:scale-105">
                    Lihat Detail
                </a>
            </div>
        @endforeach
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
