{{-- filepath: resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50" 
    x-data="{
        sortBy: '{{ request('sort', 'name') }}',
        minPrice: {{ request('min_price', $priceRange->min_price ?? 0) }},
        maxPrice: {{ request('max_price', $priceRange->max_price ?? 200000) }},
        selectedCategory: {{ isset($category) ? $category->category_id : 'null' }},
        
        formatPrice(price) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(price);
        },
        
        applyFilters() {
            const params = new URLSearchParams();
            
            if (this.sortBy) {
                params.set('sort', this.sortBy);
            }
            
            if (this.minPrice > {{ $priceRange->min_price ?? 0 }}) {
                params.set('min_price', this.minPrice);
            }
            
            if (this.maxPrice < {{ $priceRange->max_price ?? 200000 }}) {
                params.set('max_price', this.maxPrice);
            }
            
            let url = '{{ route('products.index') }}';
            if (this.selectedCategory && this.selectedCategory !== 'null') {
                url = '{{ url('/categories') }}/' + this.selectedCategory;
            }
            
            if (params.toString()) {
                url += '?' + params.toString();
            }
            
            window.location.href = url;
        }
    }" 
    x-init="
        $watch('sortBy', () => applyFilters());
        $watch('minPrice', () => {
            clearTimeout(window.priceFilterTimeout);
            window.priceFilterTimeout = setTimeout(() => applyFilters(), 1000);
        });
        $watch('maxPrice', () => {
            clearTimeout(window.priceFilterTimeout);
            window.priceFilterTimeout = setTimeout(() => applyFilters(), 1000);
        });
    ">
    @include('components.header')
    
    <div class="container mx-auto px-4 py-8">
        <div class="flex flex-col lg:flex-row gap-8">
            
            <!-- Sidebar Filter -->
            <div class="lg:w-1/4">
                <div class="bg-white rounded-lg shadow-lg p-6 sticky top-8">
                    
                    <!-- Kategori Filter -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Kategori</h3>
                        <div class="space-y-2">
                            <a href="{{ route('products.index') }}{{ request()->getQueryString() ? '?' . request()->getQueryString() : '' }}" 
                               class="flex items-center justify-between p-3 rounded-lg transition-all duration-200 {{ !isset($category) ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white' : 'hover:bg-gray-50' }}">
                                <span>Semua produk</span>
                                <span class="text-sm {{ !isset($category) ? 'text-white' : 'text-gray-500' }}">{{ $products->total() }}</span>
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('products.category', $cat->category_id) }}{{ request()->except('category') ? '?' . http_build_query(request()->except('category')) : '' }}" 
                                   class="flex items-center justify-between p-3 rounded-lg transition-all duration-200 {{ isset($category) && $category->category_id == $cat->category_id ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white' : 'hover:bg-gray-50' }}">
                                    <span>{{ $cat->category_name }}</span>
                                    <span class="text-sm {{ isset($category) && $category->category_id == $cat->category_id ? 'text-white' : 'text-gray-500' }}">{{ $cat->items->count() }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Urutkan Filter -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Urutkan</h3>
                        <div class="space-y-2">
                            <label class="flex items-center p-3 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="sort" value="name" x-model="sortBy" class="sr-only">
                                <div class="w-4 h-4 rounded-full border-2 border-blue-600 mr-3 flex items-center justify-center" :class="sortBy === 'name' ? 'bg-blue-600' : ''">
                                    <div class="w-2 h-2 rounded-full bg-white" x-show="sortBy === 'name'"></div>
                                </div>
                                <span>Nama (A-Z)</span>
                            </label>
                            <label class="flex items-center p-3 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="sort" value="price_low" x-model="sortBy" class="sr-only">
                                <div class="w-4 h-4 rounded-full border-2 border-blue-600 mr-3 flex items-center justify-center" :class="sortBy === 'price_low' ? 'bg-blue-600' : ''">
                                    <div class="w-2 h-2 rounded-full bg-white" x-show="sortBy === 'price_low'"></div>
                                </div>
                                <span>Harga: Rendah ke Tinggi</span>
                            </label>
                            <label class="flex items-center p-3 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="sort" value="price_high" x-model="sortBy" class="sr-only">
                                <div class="w-4 h-4 rounded-full border-2 border-blue-600 mr-3 flex items-center justify-center" :class="sortBy === 'price_high' ? 'bg-blue-600' : ''">
                                    <div class="w-2 h-2 rounded-full bg-white" x-show="sortBy === 'price_high'"></div>
                                </div>
                                <span>Harga: Tinggi ke Rendah</span>
                            </label>
                            <label class="flex items-center p-3 rounded-lg cursor-pointer hover:bg-gray-50 transition-colors">
                                <input type="radio" name="sort" value="rating" x-model="sortBy" class="sr-only">
                                <div class="w-4 h-4 rounded-full border-2 border-blue-600 mr-3 flex items-center justify-center" :class="sortBy === 'rating' ? 'bg-blue-600' : ''">
                                    <div class="w-2 h-2 rounded-full bg-white" x-show="sortBy === 'rating'"></div>
                                </div>
                                <span>Rating Tertinggi</span>
                            </label>
                        </div>
                    </div>

                    <!-- Range Harga -->
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Range Harga</h3>
                        <div class="space-y-4">
                            <div class="flex items-center gap-3">
                                <input type="number" x-model="minPrice" placeholder="MIN" min="0" max="{{ $priceRange->max_price ?? 200000 }}" class="flex-1 p-2 border border-gray-300 rounded-lg text-sm">
                                <span class="text-gray-500">—</span>
                                <input type="number" x-model="maxPrice" placeholder="MAX" min="0" max="{{ $priceRange->max_price ?? 200000 }}" class="flex-1 p-2 border border-gray-300 rounded-lg text-sm">
                            </div>
                            <div class="relative">
                                <div class="h-2 bg-gray-200 rounded-full">
                                    <div class="h-2 bg-gradient-to-r from-teal-400 to-blue-600 rounded-full" 
                                         :style="`width: ${((maxPrice - minPrice) / {{ $priceRange->max_price ?? 200000 }}) * 100}%`"></div>
                                </div>
                                <div class="flex justify-between text-sm text-gray-500 mt-2">
                                    <span>{{ number_format($priceRange->min_price ?? 0, 0, ',', '.') }}</span>
                                    <span>{{ number_format($priceRange->max_price ?? 200000, 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:w-3/4">
                <!-- Page Header -->
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">
                        @if(isset($category))
                            {{ $category->category_name }}
                        @else
                            Semua produk
                        @endif
                    </h1>
                    <p class="text-gray-600">Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk</p>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @forelse($products as $product)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group product-card"
                             x-data="{ 
                                selectedVariant: 0,
                                variants: [],
                                init() {
                                    this.generateVariants('{{ addslashes($product->name_item) }}');
                                },
                                generateVariants(productName) {
                                    const lowerName = productName.toLowerCase();
                                    let baseCode = 'placeholder';
                                    
                                    // Map product names to image codes
                                    if (lowerName.includes('deep sleep') || lowerName.includes('ds ')) {
                                        baseCode = 'DS';
                                    } else if (lowerName.includes('cough n flu') || lowerName.includes('cough') || lowerName.includes('cnf ')) {
                                        baseCode = 'CNF';
                                    } else if (lowerName.includes('joy') && !lowerName.includes('enjoy')) {
                                        baseCode = 'JOY';
                                    } else if (lowerName.includes('immboost') || lowerName.includes('imboost') || lowerName.includes('immunity') || lowerName.includes('ib ')) {
                                        baseCode = 'IB';
                                    } else if (lowerName.includes('bye bugs') || lowerName.includes('bb ')) {
                                        baseCode = 'BB';
                                    } else if (lowerName.includes('gimme food') || lowerName.includes('gf ')) {
                                        baseCode = 'GF';
                                    } else if (lowerName.includes('message your baby') || lowerName.includes('myb ')) {
                                        baseCode = 'MYB';
                                    } else if (lowerName.includes('ldr booster') || lowerName.includes('ldr ')) {
                                        baseCode = 'LDR';
                                    } else if (lowerName.includes('tummy calm') || lowerName.includes('tummy calmer') || lowerName.includes('tc ')) {
                                        baseCode = 'TC';
                                    } else if (lowerName.includes('twin pack newborn') || lowerName.includes('tp newborn') || lowerName.includes('tp-nb')) {
                                        baseCode = 'TP-NB';
                                    } else if (lowerName.includes('twin pack common cold') || lowerName.includes('tp common cold') || lowerName.includes('tp-cc')) {
                                        baseCode = 'TP-CC';
                                    } else if (lowerName.includes('twin pack travel') || lowerName.includes('tp travel') || lowerName.includes('tp-tv')) {
                                        baseCode = 'TP-TV';
                                    }
                                    
                                    if (baseCode !== 'placeholder' && !baseCode.includes('TP-')) {
                                        // Generate variants for different sizes
                                        this.variants = [
                                            { size: '10ml', image: `/images/${baseCode}-10-ml.jpg`, price: {{ $product->sell_price }} * 0.4 },
                                            { size: '30ml', image: `/images/${baseCode}-30-ml.jpg`, price: {{ $product->sell_price }} * 0.7 },
                                            { size: '100ml', image: `/images/${baseCode}-100-ml.jpg`, price: {{ $product->sell_price }} },
                                            { size: '250ml', image: `/images/${baseCode}-250-ml.jpg`, price: {{ $product->sell_price }} * 2.2 }
                                        ];
                                    } else {
                                        // For twin packs or other products without size variants
                                        this.variants = [
                                            { size: 'Standard', image: baseCode !== 'placeholder' ? `/images/${baseCode}.jpg` : '/images/placeholder.jpg', price: {{ $product->sell_price }} }
                                        ];
                                    }
                                }
                             }">
                            <!-- Product Image -->
                            <div class="aspect-square bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center relative overflow-hidden">
                                <!-- Product Image based on variant -->
                                <template x-if="variants.length > 0">
                                    <img :src="variants[selectedVariant]?.image || '/images/placeholder.jpg'" 
                                         :alt="'{{ $product->name_item }} ' + (variants[selectedVariant]?.size || '')" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </template>
                                
                                <!-- Fallback placeholder -->
                                <template x-if="variants.length === 0">
                                    <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                </template>
                                
                                <!-- Size indicator -->
                                <div class="absolute top-2 right-2 bg-white/90 backdrop-blur-sm px-2 py-1 rounded-md text-xs font-medium text-gray-900"
                                     x-show="variants.length > 0"
                                     x-text="variants[selectedVariant]?.size || 'Standard'">
                                </div>
                                
                                <!-- Thumbnail navigation for size variants -->
                                <div class="absolute bottom-2 left-2 right-2" x-show="variants.length > 1">
                                    <div class="flex justify-center space-x-1">
                                        <template x-for="(variant, index) in variants" :key="index">
                                            <button @click="selectedVariant = index"
                                                    class="w-6 h-6 rounded-sm overflow-hidden border transition-all duration-200 bg-white/80 backdrop-blur-sm"
                                                    :class="selectedVariant === index ? 'border-blue-500 ring-1 ring-blue-300' : 'border-white/50 hover:border-blue-300'">
                                                <img :src="variant.image" :alt="variant.size" class="w-full h-full object-cover">
                                            </button>
                                        </template>
                                    </div>
                                </div>
                                
                                <!-- Stock Badge -->
                                @if($product->stock <= 5 && $product->stock > 0)
                                <div class="absolute top-2 left-2 bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                    Stok Terbatas
                                </div>
                                @elseif($product->stock > 20)
                                <div class="absolute top-2 left-2 bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                    Stok Banyak
                                </div>
                                @elseif($product->stock == 0)
                                <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                    Habis
                                </div>
                                @endif
                            </div>
                            
                            <!-- Product Info -->
                            <div class="p-4">
                                @if($product->category)
                                <span class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full mb-2">
                                    {{ $product->category->category_name }}
                                </span>
                                @endif
                                
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                    {{ $product->name_item }}
                                </h3>
                                
                                <!-- Current variant size display -->
                                <div class="text-sm text-gray-600 mb-2" x-show="variants.length > 0">
                                    Ukuran: <span class="font-medium" x-text="variants[selectedVariant]?.size || 'Standard'"></span>
                                </div>
                                
                                <!-- Dynamic price based on selected variant -->
                                <div class="text-2xl font-bold text-blue-600 mb-2">
                                    <span x-show="variants.length > 0" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(variants[selectedVariant]?.price || {{ $product->sell_price }}))"></span>
                                    <span x-show="variants.length === 0">Rp{{ number_format($product->sell_price, 0, ',', '.') }}</span>
                                </div>
                                
                                <!-- Available sizes indicator -->
                                <div class="text-xs text-gray-500 mb-3" x-show="variants.length > 1">
                                    <span x-text="variants.length + ' ukuran tersedia'"></span>
                                </div>
                                
                                <!-- Stock Info -->
                                <div class="text-sm text-gray-600 mb-3">
                                    Stok: <span class="font-medium {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                        {{ $product->stock > 0 ? $product->stock . ' tersedia' : 'Habis' }}
                                    </span>
                                </div>
                                
                                <!-- Action Button -->
                                <a href="{{ route('product.detail', $product->item_id) }}" 
                                   class="w-full block bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center py-3 px-4 rounded-lg font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200 transform hover:scale-105">
                                    Lihat Produk
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada produk</h3>
                            <p class="text-gray-600">
                                @if(isset($category))
                                    Belum ada produk di kategori {{ $category->category_name }}.
                                @else
                                    Belum ada produk yang tersedia saat ini.
                                @endif
                            </p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($products->hasPages())
                    <div class="flex justify-center mb-8">
                        <div class="flex items-center gap-2">
                            @if (!$products->onFirstPage())
                                <a href="{{ $products->appends(request()->query())->previousPageUrl() }}" class="px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </a>
                            @endif
                            
                            @foreach ($products->appends(request()->query())->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if ($page == $products->currentPage())
                                    <span class="px-4 py-2 rounded-lg bg-blue-600 text-white font-medium">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-4 py-2 rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">{{ $page }}</a>
                                @endif
                            @endforeach
                            
                            @if ($products->hasMorePages())
                                <a href="{{ $products->appends(request()->query())->nextPageUrl() }}" class="px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
    
    @include('components.footer')
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-card {
    transition: all 0.3s ease-in-out;
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

/* Enhanced thumbnail styles */
.product-card .thumbnail-nav button {
    transition: all 0.2s ease-in-out;
    backdrop-filter: blur(8px);
}

.product-card .thumbnail-nav button:hover {
    transform: scale(1.1);
}

.product-card .thumbnail-nav button.active {
    transform: scale(1.05);
    box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5);
}

/* Loading state for images */
.image-loading {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
}

@keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
}

/* Smooth transitions for size changes */
.product-card img {
    transition: all 0.3s ease-in-out;
}

/* Enhanced hover effects */
.product-card:hover .size-indicator {
    transform: scale(1.05);
}

.size-indicator {
    transition: all 0.2s ease-in-out;
    backdrop-filter: blur(8px);
}

/* Price change animation */
.price-change {
    animation: priceChange 0.3s ease-in-out;
}

@keyframes priceChange {
    0% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.7; transform: scale(0.95); }
    100% { opacity: 1; transform: scale(1); }
}
</style>
@endsection
