@php
$allProducts = [
    [
        'id' => 1,
        'name' => 'Gentle Oil Cough n Flu',
        'price' => 299,
        'originalPrice' => 399,
        'rating' => 4.8,
        'reviews' => 124,
        'image' => 'bg-gradient-to-br from-slate-200 to-slate-300',
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
        'image' => 'bg-gradient-to-br from-blue-200 to-blue-300',
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
        'image' => 'bg-gradient-to-br from-green-200 to-green-300',
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
        'image' => 'bg-gradient-to-br from-gray-200 to-gray-300',
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
        'image' => 'bg-gradient-to-br from-rose-200 to-rose-300',
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
        'image' => 'bg-gradient-to-br from-yellow-200 to-yellow-300',
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
            <div class="rounded-xl shadow bg-white p-4">
                <a href="{{ url('/products/' . $product['id']) }}">
                    <div class="aspect-square {{ $product['image'] }} rounded-lg mb-4"></div>
                    <h3 class="text-lg font-bold mb-1 hover:text-blue-600 transition">{{ $product['name'] }}</h3>
                </a>
                <div class="flex items-center space-x-2">
                    <span class="text-xl font-bold">${{ $product['price'] }}</span>
                    <span class="text-gray-400 line-through">${{ $product['originalPrice'] }}</span>
                </div>
                <a href="{{ url('/products/' . $product['id']) }}" class="mt-4 block w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center rounded-lg py-2 font-semibold hover:from-blue-700 hover:to-purple-700 transition">
                    Lihat Detail
                </a>
            </div>
        @endforeach
    </div>
</div>
