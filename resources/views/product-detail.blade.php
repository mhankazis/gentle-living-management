{{-- filepath: resources/views/product-detail.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50" 
    x-data="{
        allProducts: [
            {
                id: 1,
                name: 'Premium Wireless Headphones',
                price: 299,
                originalPrice: 399,
                rating: 4.8,
                reviews: 124,
                image: 'bg-gradient-to-br from-slate-200 to-slate-300',
                category: 'electronics',
                badge: 'Best Seller',
                description: 'Experience premium sound quality with these wireless headphones featuring active noise cancellation, 30-hour battery life, and premium materials.',
                features: ['Active Noise Cancellation', '30-hour Battery Life', 'Premium Materials', 'Bluetooth 5.0', 'Quick Charge'],
                inStock: true,
                stockCount: 15
            },
            {
                id: 2,
                name: 'Smart Fitness Watch',
                price: 249,
                originalPrice: 329,
                rating: 4.9,
                reviews: 89,
                image: 'bg-gradient-to-br from-blue-200 to-blue-300',
                category: 'electronics',
                badge: 'New',
                description: 'Track your fitness goals with this advanced smartwatch featuring heart rate monitoring, GPS, and 7-day battery life.',
                features: ['Heart Rate Monitor', 'GPS Tracking', '7-day Battery', 'Water Resistant', 'Sleep Tracking'],
                inStock: true,
                stockCount: 8
            },
            {
                id: 3,
                name: 'Designer Cotton T-Shirt',
                price: 49,
                originalPrice: 69,
                rating: 4.6,
                reviews: 156,
                image: 'bg-gradient-to-br from-green-200 to-green-300',
                category: 'fashion',
                badge: 'Sale',
                description: 'Premium cotton t-shirt with modern fit and sustainable materials. Perfect for casual wear.',
                features: ['100% Organic Cotton', 'Modern Fit', 'Sustainable Materials', 'Pre-shrunk', 'Machine Washable'],
                inStock: true,
                stockCount: 25
            },
            {
                id: 4,
                name: 'Professional Camera Lens',
                price: 599,
                originalPrice: 749,
                rating: 4.9,
                reviews: 203,
                image: 'bg-gradient-to-br from-gray-200 to-gray-300',
                category: 'electronics',
                badge: 'Pro',
                description: 'Professional grade camera lens with superior optics and weather sealing for photography enthusiasts.',
                features: ['Weather Sealed', 'Superior Optics', 'Image Stabilization', 'Fast Autofocus', 'Professional Grade'],
                inStock: true,
                stockCount: 5
            },
            {
                id: 5,
                name: 'Luxury Sunglasses',
                price: 189,
                originalPrice: 249,
                rating: 4.6,
                reviews: 78,
                image: 'bg-gradient-to-br from-rose-200 to-rose-300',
                category: 'fashion',
                badge: 'Trending',
                description: 'Designer sunglasses with UV protection and premium frame materials for style and comfort.',
                features: ['UV Protection', 'Premium Frame', 'Polarized Lenses', 'Designer Style', 'Comfortable Fit'],
                inStock: true,
                stockCount: 12
            },
            {
                id: 6,
                name: 'Modern Table Lamp',
                price: 89,
                originalPrice: 119,
                rating: 4.7,
                reviews: 92,
                image: 'bg-gradient-to-br from-yellow-200 to-yellow-300',
                category: 'home',
                badge: 'Popular',
                description: 'Modern LED table lamp with adjustable brightness and sleek design perfect for any room.',
                features: ['LED Technology', 'Adjustable Brightness', 'Modern Design', 'Energy Efficient', 'Touch Control'],
                inStock: true,
                stockCount: 18
            }
        ],
        product: null,
        quantity: 1,
        isLiked: false,
        init() {
            const url = window.location.pathname;
            const id = parseInt(url.split('/').pop());
            this.product = this.allProducts.find(p => p.id === id);
        },
        addToCart() {
            alert(`${this.quantity} ${this.product.name} added to your cart`);
        }
    }"
    x-init="init()"
>
    @include('components.header')
    <div class="container mx-auto px-4 py-8" x-show="product">
        <button 
            type="button"
            class="mb-6 text-blue-600 hover:underline font-medium"
            onclick="history.back()"
        >← Back</button>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Product Image --}}
            <div class="space-y-4">
                <div :class="`aspect-square ${product.image} rounded-lg relative overflow-hidden`">
                    <span class="absolute top-4 left-4 bg-blue-500 text-white text-xs px-3 py-1 rounded-full font-semibold" x-text="product.badge"></span>
                    <button
                        type="button"
                        class="absolute top-4 right-4 h-10 w-10 rounded-full bg-white/90 hover:bg-white transition-colors"
                        :class="isLiked ? 'text-red-500' : 'text-gray-600'"
                        @click="isLiked = !isLiked"
                    >
                        <svg x-show="!isLiked" class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21C12 21 4 13.5 4 8.5C4 5.42 6.42 3 9.5 3C11.24 3 12.91 4.1 13.44 5.68C13.97 4.1 15.64 3 17.38 3C20.46 3 22.88 5.42 22.88 8.5C22.88 13.5 15 21 15 21H12Z"/></svg>
                        <svg x-show="isLiked" class="h-5 w-5 fill-current" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21C12 21 4 13.5 4 8.5C4 5.42 6.42 3 9.5 3C11.24 3 12.91 4.1 13.44 5.68C13.97 4.1 15.64 3 17.38 3C20.46 3 22.88 5.42 22.88 8.5C22.88 13.5 15 21 15 21H12Z"/></svg>
                    </button>
                </div>
            </div>
            {{-- Product Info --}}
            <div class="space-y-6" x-show="product">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2" x-text="product.name"></h1>
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex items-center">
                            <template x-for="i in 5">
                                <svg :key="i" class="h-5 w-5" :class="i <= Math.floor(product.rating) ? 'fill-yellow-400 text-yellow-400' : 'text-gray-300'" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                            </template>
                        </div>
                        <span class="text-gray-600" x-text="`(${product.reviews} reviews)`"></span>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-4xl font-bold text-gray-900" x-text="`$${product.price}`"></span>
                    <span class="text-2xl text-gray-500 line-through" x-text="`$${product.originalPrice}`"></span>
                    <span class="text-green-600 border border-green-200 rounded-full px-3 py-1 text-sm font-semibold">Save $<span x-text="product.originalPrice - product.price"></span></span>
                </div>
                <p class="text-gray-600 text-lg leading-relaxed" x-text="product.description"></p>
                {{-- Features --}}
                <div>
                    <h3 class="font-semibold text-lg mb-3">Key Features</h3>
                    <ul class="space-y-2">
                        <template x-for="feature in product.features">
                            <li class="flex items-center space-x-2">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span class="text-gray-700" x-text="feature"></span>
                            </li>
                        </template>
                    </ul>
                </div>
                {{-- Quantity and Add to Cart --}}
                <div class="space-y-4">
                    <div class="flex items-center space-x-4">
                        <span class="font-medium">Quantity:</span>
                        <div class="flex items-center border rounded-lg">
                            <button type="button" class="h-10 w-10 flex items-center justify-center" @click="quantity = Math.max(1, quantity - 1)">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            </button>
                            <span class="px-4 py-2 font-medium" x-text="quantity"></span>
                            <button type="button" class="h-10 w-10 flex items-center justify-center" @click="quantity = quantity + 1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex space-x-4">
                        <button 
                            type="button"
                            @click="addToCart"
                            class="flex-1 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white h-12 rounded-lg font-semibold flex items-center justify-center"
                        >
                            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 002 1.61h9.72a2 2 0 002-1.61L23 6H6"/></svg>
                            Add to Cart
                        </button>
                        <button type="button" class="h-12 px-6 rounded-lg border border-gray-300 font-semibold bg-white">Buy Now</button>
                    </div>
                </div>
                {{-- Additional Info --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 pt-6 border-t">
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="3" width="22" height="13" rx="2" /><path d="M1 8h22" /></svg>
                        <span class="text-sm text-gray-600">Free Shipping</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 22s8-4.5 8-10V7a8 8 0 10-16 0v5c0 5.5 8 10 8 10z"/><circle cx="12" cy="11" r="3"/></svg>
                        <span class="text-sm text-gray-600">2 Year Warranty</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="h-5 w-5 text-purple-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polyline points="23 4 23 10 17 10"/><polyline points="1 20 1 14 7 14"/><path d="M3.51 9a9 9 0 0114.13-3.36L23 10M1 14l4.35-4.35"/></svg>
                        <span class="text-sm text-gray-600">30 Day Returns</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div x-show="!product" class="container mx-auto px-4 py-16 text-center">
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Product Not Found</h1>
        <a href="/products" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700">Back to Products</a>
    </div>
    @include('components.features')
    @include('components.footer')
</div>
@endsection