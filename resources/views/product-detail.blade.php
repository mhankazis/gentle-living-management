{{-- filepath: resources/views/product-detail.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50" 
    x-data="productDetail"
    x-init="init()"
>
    @include('components.header')
    
    <!-- Breadcrumb -->
    <div class="container mx-auto px-4 py-4">
        <nav class="text-sm">
            <ol class="flex items-center space-x-2 text-gray-500">
                <li><a href="/" class="hover:text-blue-600 transition-colors">Beranda</a></li>
                <li><span class="text-gray-400">/</span></li>
                <li><a href="{{ route('products.index') }}" class="hover:text-blue-600 transition-colors">Produk</a></li>
                <li><span class="text-gray-400">/</span></li>
                @if($product->category)
                <li><a href="{{ route('products.category', $product->category_id) }}" class="hover:text-blue-600 transition-colors">{{ $product->category->category_name }}</a></li>
                <li><span class="text-gray-400">/</span></li>
                @endif
                <li><span class="text-gray-900 font-medium">{{ $product->name_item }}</span></li>
            </ol>
        </nav>
    </div>
    
    <!-- Main Product Section -->
    <div class="container mx-auto px-4 pb-8">
        <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                <!-- Product Images -->
                <div class="space-y-4">
                    <!-- Main Image -->
                    <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 rounded-xl overflow-hidden relative group">
                        @if($product->image_url)
                            <img :src="productImages[selectedImageIndex]" 
                                 alt="{{ $product->name_item }}" 
                                 class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                        @else
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100">
                                <div class="text-center">
                                    <svg class="w-24 h-24 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <p class="text-gray-500 font-medium">{{ $product->name_item }}</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- Like Button -->
                        <button @click="isLiked = !isLiked" 
                                class="absolute top-4 right-4 w-10 h-10 rounded-full bg-white/80 backdrop-blur-sm shadow-lg flex items-center justify-center transition-all duration-200 hover:bg-white"
                                :class="isLiked ? 'text-red-500' : 'text-gray-400'">
                            <svg class="w-5 h-5" :fill="isLiked ? 'currentColor' : 'none'" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Thumbnail Images -->
                    <div class="flex gap-3 overflow-x-auto pb-2">
                        <template x-for="(image, index) in productImages.slice(0, 4)" :key="index">
                            <button @click="selectImage(index)" 
                                    class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden border-2 transition-all duration-200"
                                    :class="selectedImageIndex === index ? 'border-blue-500 ring-2 ring-blue-200' : 'border-gray-200 hover:border-gray-300'">
                                @if($product->image_url)
                                    <img :src="image" alt="Product thumbnail" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                @endif
                            </button>
                        </template>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="space-y-6">
                    <!-- Title & Category -->
                    <div>
                        @if($product->category)
                        <div class="flex items-center space-x-2 mb-2">
                            <span class="px-3 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                                {{ $product->category->category_name }}
                            </span>
                            <div class="flex items-center space-x-1">
                                @for($i = 1; $i <= 5; $i++)
                                <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                </svg>
                                @endfor
                                <span class="text-sm text-gray-500 ml-2">(4.8)</span>
                            </div>
                        </div>
                        @endif
                        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product->name_item }}</h1>
                    </div>

                    <!-- Price & Stock -->
                    <div class="flex items-center justify-between">
                        <div class="space-y-1">
                            <div class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                                Rp {{ number_format($product->sell_price, 0, ',', '.') }}
                            </div>
                            @if($product->stock <= 10 && $product->stock > 0)
                            <div class="text-sm text-amber-600 font-medium">⚠️ Stok hampir habis!</div>
                            @endif
                        </div>
                        <div class="text-right">
                            <div class="text-sm text-gray-500">Stok tersedia</div>
                            <div class="text-2xl font-bold {{ $product->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $product->stock > 0 ? $product->stock : 'Habis' }}
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="space-y-3">
                        <h3 class="text-lg font-semibold text-gray-900">Deskripsi Produk</h3>
                        <div class="prose prose-sm max-w-none">
                            <p class="text-gray-600 leading-relaxed">
                                {{ $product->description_item ?: 'Produk berkualitas tinggi untuk memenuhi kebutuhan Anda. Dibuat dengan bahan terbaik dan standar kualitas tinggi.' }}
                            </p>
                        </div>
                    </div>

                    <!-- Product Details -->
                    @if($product->ingredient_item || $product->contain_item || $product->netweight_item || $product->unit_item)
                    <div class="bg-gray-50 rounded-xl p-6 space-y-4">
                        <h3 class="text-lg font-semibold text-gray-900 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Detail Produk
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($product->ingredient_item)
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <span class="font-medium text-gray-900">Komposisi:</span>
                                    <p class="text-gray-600">{{ $product->ingredient_item }}</p>
                                </div>
                            </div>
                            @endif
                            @if($product->contain_item)
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <span class="font-medium text-gray-900">Isi:</span>
                                    <p class="text-gray-600">{{ $product->contain_item }}</p>
                                </div>
                            </div>
                            @endif
                            @if($product->netweight_item)
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-purple-500 rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <span class="font-medium text-gray-900">Berat:</span>
                                    <p class="text-gray-600">{{ $product->netweight_item }}</p>
                                </div>
                            </div>
                            @endif
                            @if($product->unit_item)
                            <div class="flex items-start space-x-3">
                                <div class="w-2 h-2 bg-orange-500 rounded-full mt-2 flex-shrink-0"></div>
                                <div>
                                    <span class="font-medium text-gray-900">Satuan:</span>
                                    <p class="text-gray-600">{{ $product->unit_item }}</p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Quantity & Add to Cart -->
                    <div class="space-y-4 pt-6 border-t border-gray-200">
                        <!-- Quantity Selector -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4">
                                <span class="font-medium text-gray-900">Kuantitas:</span>
                                <div class="flex items-center border border-gray-300 rounded-lg bg-white">
                                    <button type="button" 
                                            @click="quantity = Math.max(1, quantity - 1)" 
                                            class="w-10 h-10 flex items-center justify-center hover:bg-gray-50 transition-colors rounded-l-lg">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                        </svg>
                                    </button>
                                    <div class="w-16 h-10 flex items-center justify-center border-l border-r border-gray-300">
                                        <span class="font-medium" x-text="quantity"></span>
                                    </div>
                                    <button type="button" 
                                            @click="quantity = Math.min({{ $product->stock }}, quantity + 1)" 
                                            class="w-10 h-10 flex items-center justify-center hover:bg-gray-50 transition-colors rounded-r-lg"
                                            :disabled="quantity >= {{ $product->stock }}">
                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="text-sm text-gray-500">
                                Max: {{ $product->stock }} unit
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        @if($product->stock > 0)
                        <div class="flex space-x-3">
                            <button type="button"
                                    @click="addToCart"
                                    class="flex-1 flex items-center justify-center px-6 py-3 border-2 border-blue-600 text-blue-600 rounded-xl font-semibold hover:bg-blue-50 transition-all duration-200 transform hover:scale-105">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5-5M7 13l-2.5 5M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"/>
                                </svg>
                                Tambah ke Keranjang
                            </button>
                            <button type="button" 
                                    class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-3 rounded-xl font-semibold transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                Beli Sekarang
                            </button>
                        </div>
                        @else
                        <div class="bg-red-50 border border-red-200 rounded-xl p-4 text-center">
                            <p class="text-red-600 font-medium">⚠️ Produk sedang tidak tersedia</p>
                            <p class="text-red-500 text-sm mt-1">Stok akan segera diperbarui</p>
                        </div>
                        @endif

                        <!-- Additional Info -->
                        <div class="grid grid-cols-3 gap-4 pt-4 border-t border-gray-100 text-center">
                            <div class="flex flex-col items-center space-y-1">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-xs text-gray-600">Kualitas Terjamin</span>
                            </div>
                            <div class="flex flex-col items-center space-y-1">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                <span class="text-xs text-gray-600">Pengiriman Cepat</span>
                            </div>
                            <div class="flex flex-col items-center space-y-1">
                                <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                </svg>
                                <span class="text-xs text-gray-600">Garansi Puas</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Related Products Section -->
    @if($relatedProducts && $relatedProducts->count() > 0)
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Produk Terkait</h2>
            <p class="text-gray-600">Produk lain yang mungkin Anda sukai</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
            <div class="bg-white/80 backdrop-blur-sm rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 group">
                <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 rounded-t-xl overflow-hidden relative">
                    @if($relatedProduct->image_url)
                        <img src="{{ $relatedProduct->image_url }}" alt="{{ $relatedProduct->name_item }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-16 h-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    @endif
                    
                    <!-- Quick View Button -->
                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all duration-300 flex items-center justify-center">
                        <a href="{{ route('product.detail', $relatedProduct->item_id) }}" 
                           class="opacity-0 group-hover:opacity-100 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg font-medium text-gray-900 hover:bg-white transition-all duration-200">
                            Lihat Detail
                        </a>
                    </div>
                </div>
                
                <div class="p-4 space-y-3">
                    @if($relatedProduct->category)
                    <span class="inline-block px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">
                        {{ $relatedProduct->category->category_name }}
                    </span>
                    @endif
                    
                    <h3 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">
                        {{ $relatedProduct->name_item }}
                    </h3>
                    
                    <div class="flex items-center justify-between">
                        <div class="text-xl font-bold text-blue-600">
                            Rp {{ number_format($relatedProduct->sell_price, 0, ',', '.') }}
                        </div>
                        <div class="text-sm text-gray-500">
                            Stock: {{ $relatedProduct->stock }}
                        </div>
                    </div>
                    
                    <button class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white py-2 rounded-lg font-medium transition-all duration-200 transform hover:scale-105">
                        Tambah ke Keranjang
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    @include('components.footer')
</div>

<!-- CSRF Token for AJAX requests -->
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection

<script>
// Alpine.js data for product detail
function productDetail() {
    return {
        selectedImage: '{{ asset("/images/" . $product->image) }}',
        quantity: 1,
        notification: {
            show: false,
            message: '',
            type: 'success'
        },
        
        // Select image function
        selectImage(imageUrl) {
            this.selectedImage = imageUrl;
        },
        
        // Add to cart function
        async addToCart() {
            try {
                const response = await fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        item_id: {{ $product->item_id }},
                        quantity: this.quantity
                    })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    this.showNotification('Produk berhasil ditambahkan ke keranjang!', 'success');
                    
                    // Update cart count using global cart counter
                    if (window.CartCounter && data.cart_count !== undefined) {
                        window.CartCounter.updateCount(data.cart_count);
                    } else if (window.triggerCartUpdate) {
                        window.triggerCartUpdate();
                    }
                } else {
                    this.showNotification(data.message || 'Gagal menambahkan ke keranjang', 'error');
                }
            } catch (error) {
                this.showNotification('Terjadi kesalahan saat menambahkan ke keranjang', 'error');
                console.error('Error:', error);
            }
        },
        
        // Show notification function
        showNotification(message, type = 'success') {
            this.notification.message = message;
            this.notification.type = type;
            this.notification.show = true;
            
            setTimeout(() => {
                this.notification.show = false;
            }, 3000);
        },
        
        // Increase quantity
        increaseQuantity() {
            this.quantity++;
        },
        
        // Decrease quantity
        decreaseQuantity() {
            if (this.quantity > 1) {
                this.quantity--;
            }
        }
    }
}
</script>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
