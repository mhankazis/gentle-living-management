{{-- filepath: resources/views/product-detail.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50" 
    x-data="{
        allProducts: [
            {
                id: 1,
                name: 'Gentle Baby Cough n Flu',
                price: 299,
                originalPrice: 399,
                rating: 4.8,
                reviews: 124,
                image: 'bg-gradient-to-br from-slate-200 to-slate-300',
                category: 'Minyak Bayi',
                badge: 'Best Seller',
                description: 'Minyak bayi yang menghilangkan pereda batuk dan flu pada anak bayi',
                features: ['Minyak Esensial', 'Aromaterapi', 'Relaksasi', 'Pereda batuk dan flu', 'Bebas Bahan Kimia'],
                inStock: true,
                stockCount: 15,
                variants: [
                    { name: 'Classic', image: 'bg-gradient-to-br from-slate-200 to-slate-300' },
                    { name: 'Eucalyptus', image: 'bg-gradient-to-br from-blue-200 to-blue-300' },
                    { name: 'Lavender', image: 'bg-gradient-to-br from-purple-200 to-purple-300' },
                    { name: 'Chamomile', image: 'bg-gradient-to-br from-green-200 to-green-300' }
                ]
            },
            {
                id: 2,
                name: 'Gentle Baby Deep Sleep',
                price: 249,
                originalPrice: 329,
                rating: 4.9,
                reviews: 89,
                image: 'bg-gradient-to-br from-blue-200 to-blue-300',
                category: 'Minyak Bayi',
                badge: 'New',
                description: 'Minyak bayi bagi bayi yang kesusahan untuk tidur',
                features: ['Minyak Esensial', 'Aromaterapi', 'Relaksasi', 'Tidur Nyenyak', 'Bebas Bahan Kimia'],
                inStock: true,
                stockCount: 8,
                variants: [
                    { name: 'Lavender', image: 'bg-gradient-to-br from-blue-200 to-blue-300' },
                    { name: 'Chamomile', image: 'bg-gradient-to-br from-indigo-200 to-indigo-300' },
                    { name: 'Vanilla', image: 'bg-gradient-to-br from-purple-200 to-purple-300' },
                    { name: 'Rose', image: 'bg-gradient-to-br from-pink-200 to-pink-300' }
                ]
            },
            {
                id: 3,
                name: 'Gentle Baby Bye Bugs',
                price: 49,
                originalPrice: 69,
                rating: 4.6,
                reviews: 156,
                image: 'bg-gradient-to-br from-green-200 to-green-300',
                category: 'Minyak Bayi',
                badge: 'Sale',
                description: 'Minyak bayi yang mengusir nyamuk dan serangga dengan aman.',
                features: ['Minyak Esensial', 'Aromaterapi', 'Relaksasi', 'Pengusir nyamuk dan serangga', 'Bebas Bahan Kimia'],
                inStock: true,
                stockCount: 25,
                variants: [
                    { name: 'Citronella', image: 'bg-gradient-to-br from-green-200 to-green-300' },
                    { name: 'Lemongrass', image: 'bg-gradient-to-br from-emerald-200 to-emerald-300' },
                    { name: 'Peppermint', image: 'bg-gradient-to-br from-teal-200 to-teal-300' },
                    { name: 'Tea Tree', image: 'bg-gradient-to-br from-cyan-200 to-cyan-300' }
                ]
            },
            {
                id: 4,
                name: 'Gentle Baby LDR Booster',
                price: 599,
                originalPrice: 749,
                rating: 4.9,
                reviews: 203,
                image: 'bg-gradient-to-br from-gray-200 to-gray-300',
                category: 'Minyak Bayi',
                badge: 'Pro',
                description: 'Minyak bayi dengan formula khusus untuk memperlancar ASI ibu hamil.',
                features: ['Minyak Esensial', 'Aromaterapi', 'Relaksasi', 'Pelancar asi', 'Bebas Bahan Kimia'],
                inStock: true,
                stockCount: 5,
                variants: [
                    { name: 'Original', image: 'bg-gradient-to-br from-gray-200 to-gray-300' },
                    { name: 'Fennel', image: 'bg-gradient-to-br from-orange-200 to-orange-300' },
                    { name: 'Ginger', image: 'bg-gradient-to-br from-red-200 to-red-300' },
                    { name: 'Turmeric', image: 'bg-gradient-to-br from-yellow-200 to-yellow-300' }
                ]
            },
            {
                id: 5,
                name: 'Gentle Baby Joy',
                price: 189,
                originalPrice: 249,
                rating: 4.6,
                reviews: 78,
                image: 'bg-gradient-to-br from-rose-200 to-rose-300',
                category: 'Minyak Bayi',
                badge: 'Trending',
                description: 'Minyak bayi dengan aroma menenangkan untuk membantu atasi bayi pegal.',
                features: ['Minyak Esensial', 'Aromaterapi', 'Relaksasi', 'Bebas Bahan Kimia'],
                inStock: true,
                stockCount: 12,
                variants: [
                    { name: 'Rose', image: 'bg-gradient-to-br from-rose-200 to-rose-300' },
                    { name: 'Jasmine', image: 'bg-gradient-to-br from-pink-200 to-pink-300' },
                    { name: 'Geranium', image: 'bg-gradient-to-br from-red-200 to-red-300' },
                    { name: 'Ylang Ylang', image: 'bg-gradient-to-br from-purple-200 to-purple-300' }
                ]
            },
            {
                id: 6,
                name: 'Gentle Baby Immboost',
                price: 89,
                originalPrice: 119,
                rating: 4.7,
                reviews: 92,
                image: 'bg-gradient-to-br from-yellow-200 to-yellow-300',
                category: 'Minyak Bayi',
                badge: 'Popular',
                description: 'Minyak bayi untuk meningkatkan daya tahan tubuh dan kesehatan si kec il.',
                features: ['Minyak Esensial', 'Aromaterapi', 'Relaksasi', 'Meningkatkan Daya Tahan Tubuh', 'Bebas Bahan Kimia'],
                inStock: true,
                stockCount: 18,
                variants: [
                    { name: 'Original', image: 'bg-gradient-to-br from-yellow-200 to-yellow-300' },
                    { name: 'Orange', image: 'bg-gradient-to-br from-orange-200 to-orange-300' },
                    { name: 'Lemon', image: 'bg-gradient-to-br from-lime-200 to-lime-300' },
                    { name: 'Grapefruit', image: 'bg-gradient-to-br from-pink-200 to-pink-300' }
                ]
            }
        ],
        product: null,
        selectedVariant: 0,
        currentImage: '',
        quantity: 1,
        isLiked: false,
        init() {
            const url = window.location.pathname;
            const id = parseInt(url.split('/').pop());
            this.product = this.allProducts.find(p => p.id === id);
            this.currentImage = this.product?.image || '';
        },
        selectVariant(index) {
            this.selectedVariant = index;
            this.currentImage = this.product.variants[index].image;
        },
        addToCart() {
            const variantName = this.product.variants[this.selectedVariant].name;
            alert(`${this.quantity} ${this.product.name} (${variantName}) added to your cart`);
        }
    }"
    x-init="init()"
>
    @include('components.header')
    <div class="container mx-auto px-4 py-8" x-show="product">
        <!-- Breadcrumb -->
        <nav class="mb-6">
            <ol class="flex items-center space-x-2 text-sm text-gray-500">
                <li><a href="/" class="hover:text-gray-700">Home</a></li>
                <li>/</li>
                <li><span x-text="product ? product.category : 'Kategori 1'"></span></li>
                <li>/</li>
                <li><span class="text-gray-900 font-medium" x-text="product ? product.name : 'Produk 1'"></span></li>
            </ol>
        </nav>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            {{-- Product Image --}}
            <div class="flex gap-4">
                <!-- Main Product Image -->
                <div class="flex-1">
                    <div :class="`aspect-square ${currentImage || product.image} rounded-lg relative overflow-hidden`">
                        <div class="w-full h-full flex items-center justify-center">
                            <svg class="w-20 h-20 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Product Variants Thumbnails - Right side vertical -->
                <div class="flex flex-col gap-3">
                    <template x-for="(variant, index) in product.variants" :key="index">
                        <div :class="`aspect-square w-20 h-20 rounded-lg border-2 cursor-pointer transition-all duration-200 ${selectedVariant === index ? 'border-blue-500 ring-1 ring-blue-300' : 'border-gray-200 hover:border-gray-300'}`" 
                             @click="selectVariant(index)"
                             :title="variant.name">
                            <div :class="`w-full h-full ${variant.image} rounded-lg flex items-center justify-center`">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        </div>
                    </template>
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
                    <span class="text-4xl font-bold text-teal-600" x-text="`Rp${product.price * 1000}`"></span>
                    <span class="text-2xl text-gray-500 line-through" x-text="`Rp${product.originalPrice * 1000}`"></span>
                </div>
                <p class="text-gray-600 text-lg leading-relaxed" x-text="product.description"></p>
                <!-- Varian Produk -->
                                <!-- Variant Selector -->
                <div>
                    <span class="font-semibold text-lg">Varian: <span class="text-blue-600" x-text="product.variants[selectedVariant].name"></span></span>
                    <div class="flex gap-2 mt-2 flex-wrap">
                        <template x-for="(variant, index) in product.variants" :key="index">
                            <button type="button" 
                                class="px-4 py-2 rounded-lg border bg-white font-medium hover:bg-gray-50 transition-all duration-200" 
                                :class="selectedVariant === index ? 'ring-2 ring-blue-500 border-blue-500 bg-blue-50 text-blue-700' : 'border-gray-300'" 
                                @click="selectVariant(index)"
                                x-text="variant.name">
                            </button>
                        </template>
                    </div>
                </div>
                <!-- Features -->
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
                <!-- Quantity, Stock, and Add to Cart -->
                <div class="space-y-4">
                    <div class="flex items-center space-x-6">
                        <div class="flex items-center space-x-3">
                            <span class="font-medium text-gray-700">Kuantitas</span>
                            <div class="flex items-center border border-gray-300 rounded-lg">
                                <button type="button" class="h-10 w-10 flex items-center justify-center hover:bg-gray-50 transition-colors" @click="quantity = Math.max(1, quantity - 1)">
                                    <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                </button>
                                <input type="text" :value="quantity" class="w-16 h-10 text-center border-0 focus:ring-0 font-medium" readonly>
                                <button type="button" class="h-10 w-10 flex items-center justify-center hover:bg-gray-50 transition-colors" @click="quantity = quantity + 1">
                                    <svg class="h-4 w-4 text-gray-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                                </button>
                            </div>
                        </div>
                        <div class="text-gray-600">
                            <span class="font-medium">Stok</span> <span x-text="product.stockCount" class="font-semibold"></span>
                        </div>
                    </div>
                    
                    <div class="flex space-x-3">
                        <button 
                            type="button"
                            @click="addToCart"
                            class="flex items-center justify-center px-6 py-3 border border-teal-500 text-teal-600 rounded-lg font-medium hover:bg-teal-50 transition-colors"
                        >
                            <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-2.5-5M7 13l-2.5 5M17 21a2 2 0 100-4 2 2 0 000 4zM9 21a2 2 0 100-4 2 2 0 000 4z"/>
                            </svg>
                            Masukkan Keranjang
                        </button>
                        <button 
                            type="button" 
                            class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white py-3 rounded-lg font-semibold transition-all duration-300 shadow-md hover:shadow-lg"
                        >
                            Beli Sekarang
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tentang Produk dengan fitur Load More -->
    <div class="container mx-auto px-4 py-8 mt-8 bg-white rounded-lg shadow" x-show="product"
        x-data="{
            fullText: `Gentle Baby Oil New Size LAUNCHING!!!<br>Gentle Baby Oil 10ml - Baby Essential Oil - Minyak Pijat Bayi Aromaterapi Minyak Urut Bayi - Baby Massage Oil<br>Gentle Baby Oil adalah Minyak Bayi Aromaterapi, kombinasi Essential Oil dan Sunflower Seed Oil untuk kesehatan ibu, bayi dan balita.<br><span class='text-green-600 font-semibold'>✔ Bahan Alami, AMAN untuk BAYI mulai usia 0-4th</span><br><span class='text-green-600 font-semibold'>✔ MINYAK PIJAT BAYI BALITA</span><br><span class='text-green-600 font-semibold'>✔ FREE kemasan bubble wrap+kartus</span><br><span class='text-green-600 font-semibold'>✔ FREE Konsultasi seputar kesehatan bayi/balita dan ibu menyusui</span><br><br><span class='font-semibold'>VARIAN TERSEDIA:</span><br>1. COUGH N FLU : Meredakan flu pada bayi balita<br>2. DEEP SLEEP : Meningkatkan kualitas tidur bayi balita<br>3. GIMME FOOD : Melancarkan pencernaan & Menambah nafsu makan si kecil<br>4. TUMMY CALMER : Meredakan masalah perut bayi balita (kolik, sembelit, kembung, dll)<br>5. JOY : Menenangkan dan mood si kecil<br>6. IMMBOOST : Meningkatkan daya tahan tubuh si kecil<br>7. MASSAGE BOOST : Bayi & Media pijat<br>8. LDR BOOSTER : Merilekskan & memperlancar produksi ASI (khusus ibu)<br>9. BITE BUDS : Melindungi kulit dr gigitan nyamuk & meredakan gatal akibat gigitan serangga<br><br>- USIA : 0 - 4 tahun<br>- KEMASAN: Pump bottle, botol kaca, dikemas dalam kardus<br>- MASA KADALUARSA: 12 Bulan<br><span class='font-semibold'>NOTE:</span><br>- Orderan sebelum pukul 14.00 akan dikirim pada hari yg sama<br>- Hari Minggu dan tanggal merah toko tutup dan tidak ada pengiriman<br>- Khusus pesanan yang menggunakan ekspedisi instan (gosend/grabexpress), jika masuk lebih dari pukul 14.00 maka akan dikirim di hari berikutnya.<br>No. UMOT (Kemenkes RI): 443/04/UMOT/35.07.103/2020<br>No CPOTB BPOM RI : B-ST.04.03.4318.07.21.02.904`,
            showAll: false,
            maxLength: 400,
        }"
    >
        <h2 class="text-xl font-bold text-gray-900 mb-4">Tentang Produk</h2>
        <div class="text-gray-700 space-y-2">
            <template x-if="!showAll">
                <div x-html="fullText.length > maxLength ? fullText.substring(0, maxLength) + '...' : fullText"></div>
            </template>
            <template x-if="showAll">
                <div x-html="fullText"></div>
            </template>
            <template x-if="fullText.length > maxLength">
                <button @click="showAll = !showAll" class="mt-2 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                    <span x-text="showAll ? 'Tampilkan Lebih Sedikit' : 'Lihat Selengkapnya'"></span>
                </button>
            </template>
        </div>
    </div>
    
    <!-- Penilaian Produk -->
    <div class="container mx-auto px-4 py-8 mt-8 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Penilaian Produk</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="border rounded-lg p-6 flex flex-col items-start">
                <span class="font-semibold mb-2">user01</span>
                <div class="flex mb-2">
                    <template x-for="i in 5">
                        <svg :key="i" class="h-5 w-5 text-yellow-400" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </template>
                </div>
                <p class="text-gray-700 text-sm">Suspendisse quis lacinia urna. Suspendisse potenti. Proin tristique augue risus, sed pharetra mi porta id. Integer venenatis ipsum nec lacus dictum.</p>
            </div>
            <div class="border rounded-lg p-6 flex flex-col items-start">
                <span class="font-semibold mb-2">user01</span>
                <div class="flex mb-2">
                    <template x-for="i in 5">
                        <svg :key="i" class="h-5 w-5 text-yellow-400" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </template>
                </div>
                <p class="text-gray-700 text-sm">Suspendisse quis lacinia urna. Suspendisse potenti. Proin tristique augue risus, sed pharetra mi porta id. Integer venenatis ipsum nec lacus dictum.</p>
            </div>
            <div class="border rounded-lg p-6 flex flex-col items-start">
                <span class="font-semibold mb-2">user01</span>
                <div class="flex mb-2">
                    <template x-for="i in 5">
                        <svg :key="i" class="h-5 w-5 text-yellow-400" fill="currentColor" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </template>
                </div>
                <p class="text-gray-700 text-sm">Suspendisse quis lacinia urna. Suspendisse potenti. Proin tristique augue risus, sed pharetra mi porta id. Integer venenatis ipsum nec lacus dictum.</p>
            </div>
        </div>
    </div>
    
    <!-- Kategori Serupa -->
    <div class="container mx-auto px-4 py-8 mt-8 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold text-gray-900 mb-4 text-center">Kategori Serupa</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <template x-for="item in allProducts.slice(0,4)">
                <div class="border rounded-lg p-4 flex flex-col items-center">
                    <div class="w-full aspect-[4/3] bg-gray-200 rounded mb-4"></div>
                    <div class="font-semibold mb-1" x-text="item.name"></div>
                    <div class="text-blue-700 font-bold mb-2" x-text="`Rp${(item.price * 1000).toLocaleString('id-ID')}`"></div>
                    <button class="w-full py-2 rounded bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold hover:from-blue-700 hover:to-purple-700">Lihat Produk</button>
                </div>
            </template>
        </div>
    </div>
    
    <!-- Produk Lainnya -->
    <div class="container mx-auto px-4 py-8 mt-8 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold text-gray-900 mb-4 text-center">Produk Lainnya</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
            <template x-for="item in allProducts.slice(2,6)">
                <div class="border rounded-lg p-4 flex flex-col items-center">
                    <div class="w-full aspect-[4/3] bg-gray-200 rounded mb-4"></div>
                    <div class="font-semibold mb-1" x-text="item.name"></div>
                    <div class="text-blue-700 font-bold mb-2" x-text="`Rp${(item.price * 1000).toLocaleString('id-ID')}`"></div>
                    <button class="w-full py-2 rounded bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold hover:from-blue-700 hover:to-purple-700">Lihat Produk</button>
                </div>
            </template>
        </div>
    </div>
    <div x-show="!product" class="container mx-auto px-4 py-16 text-center">
        <h1 class="text-2xl font-bold text-gray-900 mb-4">Product Not Found</h1>
        <a href="/products" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700">Back to Products</a>
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
    @include('components.footer')
</div>
@endsection