{{-- filepath: resources/views/products/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50" 
    x-data="{
        sortBy: 'name',
        minPrice: 0,
        maxPrice: 200000,
        selectedCategory: {{ isset($category) ? $category->category_id : 'null' }},
        
        formatPrice(price) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                minimumFractionDigits: 0
            }).format(price);
        }
    }">
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
                            <a href="{{ route('products.index') }}" 
                               class="flex items-center justify-between p-3 rounded-lg transition-all duration-200 {{ !isset($category) ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white' : 'hover:bg-gray-50' }}">
                                <span>Semua produk</span>
                                <span class="text-sm {{ !isset($category) ? 'text-white' : 'text-gray-500' }}">{{ $products->total() }}</span>
                            </a>
                            @foreach($categories as $cat)
                                <a href="{{ route('products.category', $cat->category_id) }}" 
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
                                <input type="number" x-model="minPrice" placeholder="MIN" class="flex-1 p-2 border border-gray-300 rounded-lg text-sm">
                                <span class="text-gray-500">—</span>
                                <input type="number" x-model="maxPrice" placeholder="MAX" class="flex-1 p-2 border border-gray-300 rounded-lg text-sm">
                            </div>
                            <div class="relative">
                                <div class="h-2 bg-gray-200 rounded-full">
                                    <div class="h-2 bg-gradient-to-r from-teal-400 to-blue-600 rounded-full" style="width: 70%"></div>
                                </div>
                                <div class="flex justify-between text-sm text-gray-500 mt-2">
                                    <span>0</span>
                                    <span>200.000</span>
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
                                <a href="{{ $products->previousPageUrl() }}" class="px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                </a>
                            @endif
                            
                            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                                @if ($page == $products->currentPage())
                                    <span class="px-4 py-2 rounded-lg bg-blue-600 text-white font-medium">{{ $page }}</span>
                                @else
                                    <a href="{{ $url }}" class="px-4 py-2 rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">{{ $page }}</a>
                                @endif
                            @endforeach
                            
                            @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}" class="px-3 py-2 rounded-lg bg-white border border-gray-300 text-gray-700 hover:bg-gray-50">
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
        
        <!-- Trust Indicators -->
        <div class="bg-white rounded-lg shadow-lg p-8 mt-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Percayakan pada EXPERT-nya! -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Percayakan pada EXPERT-nya!</h3>
                    <p class="text-sm text-gray-600">Dikembangkan oleh Dokter Anak, Dokter Kulit, dan Psikolog Anak</p>
                </div>
                
                <!-- Gratis Ongkir -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Gratis Ongkir</h3>
                    <p class="text-sm text-gray-600">Pengiriman Express Seluruh Indonesia*</p>
                </div>
                
                <!-- Gratis Pengembalian -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Gratis Pengembalian</h3>
                    <p class="text-sm text-gray-600">Gratis Pengembalian Selama 7 Hari Kerja</p>
                </div>
                
                <!-- Hubungi Kami -->
                <div class="text-center">
                    <div class="w-16 h-16 mx-auto mb-4 bg-orange-100 rounded-full flex items-center justify-center">
                        <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Hubungi Kami</h3>
                    <p class="text-sm text-gray-600">Whatsapp +62 821-3716-1033</p>
                </div>
            </div>
        </div>
    </div>
    
    @include('components.footer')
</div>
@endsection
