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
                                    <span>{{ $cat->name_category }}</span>
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
                            {{ $category->name_category }}
                        @else
                            Semua produk
                        @endif
                    </h1>
                    <p class="text-gray-600">Menampilkan {{ $products->count() }} dari {{ $products->total() }} produk</p>
                </div>

                <!-- Products Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @forelse($products as $product)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                            <!-- Product Image -->
                            <div class="aspect-square bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                                <svg class="w-16 h-16 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            
                            <!-- Product Info -->
                            <div class="p-4">
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                                    {{ $product->name_item }}
                                </h3>
                                
                                <div class="text-2xl font-bold text-blue-600 mb-4">
                                    Rp{{ number_format($product->sell_price, 0, ',', '.') }}
                                </div>
                                
                                <!-- Action Button -->
                                <a href="{{ route('product.detail', $product->item_id) }}" 
                                   class="w-full block bg-gradient-to-r from-blue-600 to-purple-600 text-white text-center py-3 px-4 rounded-lg font-medium hover:from-blue-700 hover:to-purple-700 transition-all duration-200">
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
                                    Belum ada produk di kategori {{ $category->name_category }}.
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
        
        <!-- Section 4 Kolom Info dengan Icon -->
        <div class="w-full bg-white border-t-4 border-blue-500 mt-12">
            <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6 py-8 px-4 text-center">
                <div class="flex flex-col items-center">
                    <span class="mb-2">
                        <!-- Shield Icon -->
                        <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="text-blue-600"><path d="M12 3l7 4v5c0 5.25-3.5 9.74-7 10-3.5-.26-7-4.75-7-10V7l7-4z"/></svg>
                    </span>
                    <span class="font-semibold">Percayakan pada EXPERT-nya!</span>
                    <span class="text-gray-600 text-sm">Dikembangkan oleh Dokter Anak, Dokter Kulit, dan Psikolog Anak</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="mb-2">
                        <!-- Truck Icon -->
                        <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="text-blue-600"><rect x="1" y="7" width="15" height="13" rx="2"/><path d="M16 10h4l3 5v5a2 2 0 01-2 2H19"/><circle cx="5.5" cy="20.5" r="1.5"/><circle cx="18.5" cy="20.5" r="1.5"/></svg>
                    </span>
                    <span class="font-semibold">Gratis Ongkir</span>
                    <span class="text-gray-600 text-sm">Pengiriman Ekspres Seluruh Indonesia*</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="mb-2">
                        <!-- Box Icon -->
                        <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="text-blue-600"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M3 7l9 6 9-6"/></svg>
                    </span>
                    <span class="font-semibold">Gratis Pengembalian</span>
                    <span class="text-gray-600 text-sm">Gratis Pengembalian Selama 7 Hari Kerja</span>
                </div>
                <div class="flex flex-col items-center">
                    <span class="mb-2">
                        <!-- Chat Icon -->
                        <svg width="36" height="36" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" class="text-blue-600"><path d="M21 15a2 2 0 01-2 2H7l-4 4V5a2 2 0 012-2h14a2 2 0 012 2z"/></svg>
                    </span>
                    <span class="font-semibold">Hubungi Kami</span>
                    <span class="text-gray-600 text-sm">Whatsapp +62 821-3716-1033</span>
                </div>
            </div>
        </div>
    </div>
    
    @include('components.footer')
</div>
@endsection
