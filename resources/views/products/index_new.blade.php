@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="{
    selectedCategory: '{{ request('category') }}',
    selectedSort: '{{ request('sort', 'newest') }}',
    minPrice: {{ request('min_price', $priceRange->min_price ?? 0) }},
    maxPrice: {{ request('max_price', $priceRange->max_price ?? 1000000) }},
    searchQuery: '{{ request('search') }}',
    
    submitFilter() {
        let params = new URLSearchParams();
        
        if (this.selectedCategory) params.set('category', this.selectedCategory);
        if (this.selectedSort) params.set('sort', this.selectedSort);
        if (this.minPrice > {{ $priceRange->min_price ?? 0 }}) params.set('min_price', this.minPrice);
        if (this.maxPrice < {{ $priceRange->max_price ?? 1000000 }}) params.set('max_price', this.maxPrice);
        if (this.searchQuery) params.set('search', this.searchQuery);
        
        window.location.href = '{{ route('products.index') }}?' + params.toString();
    },
    
    clearFilters() {
        this.selectedCategory = '';
        this.selectedSort = 'newest';
        this.minPrice = {{ $priceRange->min_price ?? 0 }};
        this.maxPrice = {{ $priceRange->max_price ?? 1000000 }};
        this.searchQuery = '';
        window.location.href = '{{ route('products.index') }}';
    },
    
    formatPrice(price) {
        return new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
            minimumFractionDigits: 0
        }).format(price);
    }
}">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar Filter -->
        <div class="lg:w-1/4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <!-- Search Bar -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Produk</label>
                    <div class="relative">
                        <input type="text" 
                               x-model="searchQuery"
                               @keyup.enter="submitFilter()"
                               placeholder="Cari produk..."
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button @click="submitFilter()" class="absolute right-2 top-2 text-gray-400 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Categories Filter -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Kategori</h3>
                    <div class="space-y-2">
                        <label class="flex items-center justify-between cursor-pointer">
                            <div class="flex items-center">
                                <input type="radio" x-model="selectedCategory" value="" @change="submitFilter()" class="mr-3 text-blue-600">
                                <span class="text-gray-700">Semua Kategori</span>
                            </div>
                            <span class="text-sm text-gray-500">({{ $products->total() }})</span>
                        </label>
                        @foreach($categories as $category)
                        <label class="flex items-center justify-between cursor-pointer">
                            <div class="flex items-center">
                                <input type="radio" x-model="selectedCategory" value="{{ $category->category_id }}" @change="submitFilter()" class="mr-3 text-blue-600">
                                <span class="text-gray-700">{{ $category->category_name }}</span>
                            </div>
                            <span class="text-sm text-gray-500">({{ $category->items_count }})</span>
                        </label>
                        @endforeach
                    </div>
                </div>
                
                <!-- Sort Filter -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Urutkan</h3>
                    <div class="space-y-2">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" x-model="selectedSort" value="newest" @change="submitFilter()" class="mr-3 text-blue-600">
                            <span class="text-gray-700">Terbaru</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" x-model="selectedSort" value="oldest" @change="submitFilter()" class="mr-3 text-blue-600">
                            <span class="text-gray-700">Terlama</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" x-model="selectedSort" value="name_asc" @change="submitFilter()" class="mr-3 text-blue-600">
                            <span class="text-gray-700">Nama A-Z</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" x-model="selectedSort" value="name_desc" @change="submitFilter()" class="mr-3 text-blue-600">
                            <span class="text-gray-700">Nama Z-A</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" x-model="selectedSort" value="price_asc" @change="submitFilter()" class="mr-3 text-blue-600">
                            <span class="text-gray-700">Harga Terendah</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" x-model="selectedSort" value="price_desc" @change="submitFilter()" class="mr-3 text-blue-600">
                            <span class="text-gray-700">Harga Tertinggi</span>
                        </label>
                    </div>
                </div>
                
                <!-- Price Range Filter -->
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Range Harga</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Harga Minimum</label>
                            <input type="range" 
                                   x-model="minPrice"
                                   min="{{ $priceRange->min_price ?? 0 }}" 
                                   max="{{ $priceRange->max_price ?? 1000000 }}"
                                   step="10000"
                                   @input="if(minPrice > maxPrice) maxPrice = minPrice"
                                   class="w-full">
                            <div class="text-xs text-gray-500 mt-1" x-text="formatPrice(minPrice)"></div>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-600 mb-1">Harga Maksimum</label>
                            <input type="range" 
                                   x-model="maxPrice"
                                   min="{{ $priceRange->min_price ?? 0 }}" 
                                   max="{{ $priceRange->max_price ?? 1000000 }}"
                                   step="10000"
                                   @input="if(maxPrice < minPrice) minPrice = maxPrice"
                                   class="w-full">
                            <div class="text-xs text-gray-500 mt-1" x-text="formatPrice(maxPrice)"></div>
                        </div>
                        <button @click="submitFilter()" 
                                class="w-full bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                            Terapkan Filter Harga
                        </button>
                    </div>
                </div>
                
                <!-- Clear Filters -->
                <button @click="clearFilters()" 
                        class="w-full bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition duration-200">
                    Hapus Semua Filter
                </button>
            </div>
        </div>
        
        <!-- Main Content -->
        <div class="lg:w-3/4">
            <!-- Filter Summary -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4 mb-6">
                <div class="flex flex-wrap items-center justify-between gap-4">
                    <div class="flex items-center gap-2">
                        <span class="text-gray-600">Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk</span>
                        @if(request()->hasAny(['category', 'sort', 'min_price', 'max_price', 'search']))
                            <span class="text-blue-600">dengan filter aktif</span>
                        @endif
                    </div>
                    @if(request()->hasAny(['category', 'sort', 'min_price', 'max_price', 'search']))
                    <button @click="clearFilters()" class="text-sm text-red-600 hover:text-red-800 underline">
                        Hapus Filter
                    </button>
                    @endif
                </div>
            </div>
            
            <!-- Products Grid -->
            @if($products->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                @foreach($products as $product)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition duration-300">
                    <div class="aspect-w-16 aspect-h-9 bg-gray-100">
                        <img src="https://via.placeholder.com/400x300/f3f4f6/9ca3af?text={{ urlencode($product->name_item) }}" 
                             alt="{{ $product->name_item }}" 
                             class="w-full h-48 object-cover">
                    </div>
                    <div class="p-4">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="text-lg font-semibold text-gray-800 line-clamp-2 flex-1">{{ $product->name_item }}</h3>
                            @if($product->stock <= 5)
                                <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full ml-2">
                                    Stok: {{ $product->stock }}
                                </span>
                            @endif
                        </div>
                        <p class="text-sm text-gray-600 mb-2">{{ $product->category->category_name }}</p>
                        <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ Str::limit($product->description_item, 80) }}</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-xl font-bold text-blue-600">
                                    Rp {{ number_format($product->sell_price, 0, ',', '.') }}
                                </p>
                                <p class="text-sm text-gray-500">{{ $product->netweight_item }}</p>
                            </div>
                            <a href="{{ route('product.show', $product->item_id) }}" 
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200 text-sm">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $products->appends(request()->query())->links() }}
            </div>
            @else
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 text-center">
                <div class="text-gray-400 mb-4">
                    <svg class="w-16 h-16 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2M4 13h2m13-8l-4 4m0 0l-4-4m4 4V3"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Tidak ada produk ditemukan</h3>
                <p class="text-gray-600 mb-4">Coba ubah filter atau kata kunci pencarian Anda</p>
                <button @click="clearFilters()" 
                        class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                    Reset Filter
                </button>
            </div>
            @endif
        </div>
    </div>
    
    <!-- Trust Indicators -->
    <div class="mt-16 bg-gray-50 py-12">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Kualitas Terjamin</h3>
                    <p class="text-sm text-gray-600">Produk berkualitas tinggi dengan standar terbaik</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Pengiriman Gratis</h3>
                    <p class="text-sm text-gray-600">Gratis ongkir untuk pembelian di atas Rp 200.000</p>
                </div>
                <div class="text-center">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Mudah Dikembalikan</h3>
                    <p class="text-sm text-gray-600">Garansi 30 hari uang kembali jika tidak puas</p>
                </div>
                <div class="text-center">
                    <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-2">Hubungi Kami</h3>
                    <p class="text-sm text-gray-600">Customer service siap membantu 24/7</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
