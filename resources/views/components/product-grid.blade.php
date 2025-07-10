@php
$allProducts = [
    [
        'id' => 1,
        'name' => 'Premium Wireless Headphones',
        'price' => 299,
        'originalPrice' => 399,
        'rating' => 4.8,
        'reviews' => 124,
        'image' => 'bg-gradient-to-br from-slate-200 to-slate-300',
        'category' => 'electronics',
        'badge' => 'Best Seller',
    ],
    [
        'id' => 2,
        'name' => 'Smart Fitness Watch',
        'price' => 249,
        'originalPrice' => 329,
        'rating' => 4.9,
        'reviews' => 89,
        'image' => 'bg-gradient-to-br from-blue-200 to-blue-300',
        'category' => 'electronics',
        'badge' => 'New',
    ],
    [
        'id' => 3,
        'name' => 'Designer Cotton T-Shirt',
        'price' => 49,
        'originalPrice' => 69,
        'rating' => 4.6,
        'reviews' => 156,
        'image' => 'bg-gradient-to-br from-green-200 to-green-300',
        'category' => 'fashion',
        'badge' => 'Sale',
    ],
    [
        'id' => 4,
        'name' => 'Professional Camera Lens',
        'price' => 599,
        'originalPrice' => 749,
        'rating' => 4.9,
        'reviews' => 203,
        'image' => 'bg-gradient-to-br from-gray-200 to-gray-300',
        'category' => 'electronics',
        'badge' => 'Pro',
    ],
    [
        'id' => 5,
        'name' => 'Luxury Sunglasses',
        'price' => 189,
        'originalPrice' => 249,
        'rating' => 4.6,
        'reviews' => 78,
        'image' => 'bg-gradient-to-br from-rose-200 to-rose-300',
        'category' => 'fashion',
        'badge' => 'Trending',
    ],
    [
        'id' => 6,
        'name' => 'Modern Table Lamp',
        'price' => 89,
        'originalPrice' => 119,
        'rating' => 4.7,
        'reviews' => 92,
        'image' => 'bg-gradient-to-br from-yellow-200 to-yellow-300',
        'category' => 'home',
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
        @foreach ($sorted as $product)
        <div class="group hover:shadow-xl transition-all duration-300 border-0 bg-white/80 backdrop-blur-sm overflow-hidden rounded-2xl flex flex-col">
            <div class="relative">
                <div class="aspect-square {{ $product['image'] }} relative overflow-hidden rounded-t-2xl">
                    <div class="absolute inset-0 bg-black/10 group-hover:bg-black/20 transition-colors duration-300"></div>
                    <span class="absolute top-4 left-4 bg-blue-500 text-white text-xs font-semibold px-3 py-1 rounded-full shadow">{{ $product['badge'] }}</span>
                    <div class="absolute top-4 right-4 flex flex-col space-y-2">
                        <button type="button" class="h-8 w-8 rounded-full bg-white/90 hover:bg-white transition-colors text-gray-600 flex items-center justify-center shadow">
                            <!-- Heart Icon -->
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21C12 21 4 13.5 4 8.5C4 5.42 6.42 3 9.5 3C11.24 3 12.91 3.81 14 5.08C15.09 3.81 16.76 3 18.5 3C21.58 3 24 5.42 24 8.5C24 13.5 16 21 16 21H12Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </button>
                        <button type="button" class="h-8 w-8 rounded-full bg-white/90 hover:bg-white transition-colors text-gray-600 flex items-center justify-center shadow">
                            <!-- Eye Icon -->
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12C1 12 5 5 12 5C19 5 23 12 23 12C23 12 19 19 12 19C5 19 1 12 1 12Z" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3"/></svg>
                        </button>
                    </div>
                </div>
            </div>
            <div class="p-6 flex-1 flex flex-col">
                <h3 class="font-semibold text-lg text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">{{ $product['name'] }}</h3>
                <div class="flex items-center space-x-2 mb-3">
                    <div class="flex items-center">
                        @for ($i = 1; $i <= 5; $i++)
                            <svg class="h-4 w-4 {{ $i <= floor($product['rating']) ? 'fill-yellow-400 text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><polygon points="9.9,1.1 7.6,6.6 1.6,7.6 6,11.7 4.9,17.6 9.9,14.6 14.9,17.6 13.8,11.7 18.2,7.6 12.2,6.6 "/></svg>
                        @endfor
                    </div>
                    <span class="text-sm text-gray-600">({{ $product['reviews'] }})</span>
                </div>
                <div class="flex items-center space-x-2 mb-4">
                    <span class="text-2xl font-bold text-gray-900">${{ $product['price'] }}</span>
                    <span class="text-lg text-gray-500 line-through">${{ $product['originalPrice'] }}</span>
                </div>
                <form class="mt-auto">
                    <button type="button" class="w-full flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-lg py-2 transition group">
                        <!-- Shopping Cart Icon -->
                        <svg class="mr-2 h-4 w-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61l1.38-7.39H6"/></svg>
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
