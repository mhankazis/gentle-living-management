@php
$selectedCategory = request('category', 'all');
$sortBy = request('sort', 'name');

// Get dynamic categories from database
$dbCategories = \App\Models\MasterCategory::withCount('items')->get();
$totalProducts = \App\Models\MasterItem::where('stock', '>', 0)->count();

// Build categories array with database data
$categories = [
    ['id' => 'all', 'name' => 'Semua Produk', 'count' => $totalProducts],
];

foreach ($dbCategories as $category) {
    $categories[] = [
        'id' => $category->category_id,
        'name' => $category->category_name,
        'count' => $category->items_count
    ];
}

$sortOptions = [
    ['id' => 'name', 'name' => 'Nama (A-Z)'],
    ['id' => 'price_low', 'name' => 'Harga: Rendah ke Tinggi'],
    ['id' => 'price_high', 'name' => 'Harga: Tinggi ke Rendah'],
    ['id' => 'newest', 'name' => 'Terbaru'],
    ['id' => 'oldest', 'name' => 'Terlama'],
];
$ratings = [5, 4, 3, 2, 1];
@endphp
<div class="space-y-6">
    <div class="border-0 bg-white/80 backdrop-blur-sm rounded-2xl shadow">
        <div class="px-6 pt-6 pb-2 font-semibold text-lg">Kategori</div>
        <div class="px-6 pb-6 space-y-2">
            @foreach ($categories as $cat)
            <a href="?category={{ $cat['id'] }}&sort={{ $sortBy }}" class="block w-full">
                <button type="button" class="w-full flex items-center justify-between rounded-lg px-3 py-2 text-left font-medium transition
                    {{ $selectedCategory === (string)$cat['id'] ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow' : 'hover:bg-gray-100 text-gray-800' }}">
                    <span>{{ $cat['name'] }}</span>
                    <span class="ml-2 inline-block {{ $selectedCategory === (string)$cat['id'] ? 'bg-white/20 border-white/30 text-white' : 'bg-blue-50 border-blue-200 text-blue-600' }} text-xs font-semibold px-2 py-0.5 rounded-full border">{{ $cat['count'] }}</span>
                </button>
            </a>
            @endforeach
        </div>
    </div>
    <div class="border-0 bg-white/80 backdrop-blur-sm rounded-2xl shadow">
        <div class="px-6 pt-6 pb-2 font-semibold text-lg">Urutkan</div>
        <div class="px-6 pb-6 space-y-2">
            @foreach ($sortOptions as $opt)
            <a href="?category={{ $selectedCategory }}&sort={{ $opt['id'] }}" class="block w-full">
                <button type="button" class="w-full text-left rounded-lg px-3 py-2 font-medium transition
                    {{ $sortBy === $opt['id'] ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow' : 'hover:bg-gray-100 text-gray-800' }}">
                    {{ $opt['name'] }}
                </button>
            </a>
            @endforeach
        </div>
    </div>
    <div class="border-0 bg-white/80 backdrop-blur-sm rounded-2xl shadow">
        <div class="px-6 pt-6 pb-2 font-semibold text-lg">Rentang Harga</div>
        <div class="px-6 pb-6">
            @php
                $priceRange = \App\Models\MasterItem::selectRaw('MIN(sell_price) as min_price, MAX(sell_price) as max_price')->first();
                $minPrice = $priceRange->min_price ?? 0;
                $maxPrice = $priceRange->max_price ?? 1000000;
            @endphp
            <div class="w-full h-2 bg-blue-100 rounded-full mb-4 relative">
                <div class="absolute left-1/6 w-2/3 h-2 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full"></div>
                <div class="absolute left-1/6 -top-1.5 w-4 h-4 bg-blue-500 rounded-full border-2 border-white shadow"></div>
                <div class="absolute right-1/6 -top-1.5 w-4 h-4 bg-purple-500 rounded-full border-2 border-white shadow"></div>
            </div>
            <div class="flex justify-between text-sm text-gray-600">
                <span>Rp {{ number_format($minPrice, 0, ',', '.') }}</span>
                <span>Rp {{ number_format($maxPrice, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
    <div class="border-0 bg-white/80 backdrop-blur-sm rounded-2xl shadow">
        <div class="px-6 pt-6 pb-2 font-semibold text-lg">Rating Pelanggan</div>
        <div class="px-6 pb-6 space-y-2">
            @foreach ($ratings as $rating)
            <button type="button" class="w-full flex items-center space-x-2 rounded-lg px-3 py-2 hover:bg-gray-100 text-gray-800">
                <span class="flex items-center">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="h-4 w-4 {{ $i <= $rating ? 'fill-yellow-400 text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20"><polygon points="9.9,1.1 7.6,6.6 1.6,7.6 6,11.7 4.9,17.6 9.9,14.6 14.9,17.6 13.8,11.7 18.2,7.6 12.2,6.6 "/></svg>
                    @endfor
                </span>
                <span class="text-sm text-gray-600">& ke atas</span>
            </button>
            @endforeach
        </div>
    </div>
</div>
