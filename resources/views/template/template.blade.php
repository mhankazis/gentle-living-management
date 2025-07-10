
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BabyOilStore - Minyak Bayi Terbaik & Aman</title>
    <meta name="description" content="Toko online terpercaya untuk produk minyak bayi berkualitas premium dari brand terpercaya untuk memberikan perawatan terbaik bagi si kecil">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            DEFAULT: 'hsl(340, 82%, 52%)',
                            foreground: 'hsl(210, 40%, 98%)'
                        },
                        'baby-pink': {
                            50: '#fef7f7',
                            100: '#feeaea',
                            200: '#fdd8d8',
                            300: '#fab8b8',
                            400: '#f68c8c',
                            500: '#ee6b6b',
                            600: '#da4a4a',
                            700: '#b83838',
                            800: '#983333',
                            900: '#7e3030'
                        },
                        'baby-blue': {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e'
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.3s ease-out'
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0', transform: 'translateY(10px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' }
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
</head>
<body class="min-h-screen bg-white">
    <!-- Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <div class="text-2xl font-bold text-primary">
                        BabyOil<span class="text-baby-blue-500">Store</span>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <nav class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-700 hover:text-primary transition-colors">Beranda</a>
                    <a href="#products" class="text-gray-700 hover:text-primary transition-colors">Produk</a>
                    <a href="#about" class="text-gray-700 hover:text-primary transition-colors">Tentang</a>
                    <a href="#contact" class="text-gray-700 hover:text-primary transition-colors">Kontak</a>
                </nav>

                <!-- Search Bar -->
                <div class="hidden md:flex items-center flex-1 max-w-md mx-8">
                    <div class="relative w-full">
                        <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-4 w-4"></i>
                        <input
                            type="text"
                            placeholder="Cari produk minyak bayi..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent"
                        />
                    </div>
                </div>

                <!-- Right Icons -->
                <div class="flex items-center space-x-4">
                    <button class="hidden md:flex items-center justify-center p-2 text-gray-700 hover:text-primary">
                        <i data-lucide="user" class="h-5 w-5"></i>
                    </button>
                    <button class="hidden md:flex items-center justify-center p-2 text-gray-700 hover:text-primary">
                        <i data-lucide="heart" class="h-5 w-5"></i>
                    </button>
                    <button class="relative p-2 text-gray-700 hover:text-primary">
                        <i data-lucide="shopping-cart" class="h-5 w-5"></i>
                        <span class="absolute -top-2 -right-2 bg-primary text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            0
                        </span>
                    </button>

                    <!-- Mobile menu button -->
                    <button class="md:hidden p-2" onclick="toggleMobileMenu()">
                        <i data-lucide="menu" class="h-5 w-5" id="menu-icon"></i>
                        <i data-lucide="x" class="h-5 w-5 hidden" id="close-icon"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div class="md:hidden py-4 border-t hidden" id="mobile-menu">
                <div class="flex flex-col space-y-4">
                    <div class="relative">
                        <i data-lucide="search" class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400 h-4 w-4"></i>
                        <input
                            type="text"
                            placeholder="Cari produk..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-primary"
                        />
                    </div>
                    <a href="#" class="text-gray-700 hover:text-primary">Beranda</a>
                    <a href="#products" class="text-gray-700 hover:text-primary">Produk</a>
                    <a href="#about" class="text-gray-700 hover:text-primary">Tentang</a>
                    <a href="#contact" class="text-gray-700 hover:text-primary">Kontak</a>
                    <div class="flex space-x-4 pt-2">
                        <button class="flex items-center space-x-2 p-2 text-gray-700 hover:text-primary">
                            <i data-lucide="user" class="h-5 w-5"></i>
                            <span>Akun</span>
                        </button>
                        <button class="flex items-center space-x-2 p-2 text-gray-700 hover:text-primary">
                            <i data-lucide="heart" class="h-5 w-5"></i>
                            <span>Wishlist</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-baby-pink-50 to-baby-blue-50 py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8 animate-fade-in">
                    <div class="space-y-4">
                        <h1 class="text-4xl lg:text-6xl font-bold text-gray-900 leading-tight">
                            Minyak Bayi
                            <span class="text-primary block">Terbaik & Aman</span>
                        </h1>
                        <p class="text-lg text-gray-600 max-w-lg">
                            Koleksi lengkap minyak bayi premium yang aman, lembut, dan berkualitas tinggi 
                            untuk memberikan perawatan terbaik bagi si kecil.
                        </p>
                    </div>

                    <!-- Features -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div class="flex items-center space-x-2">
                            <i data-lucide="shield" class="h-5 w-5 text-baby-blue-500"></i>
                            <span class="text-sm text-gray-600">100% Aman</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i data-lucide="heart" class="h-5 w-5 text-primary"></i>
                            <span class="text-sm text-gray-600">Lembut di Kulit</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i data-lucide="star" class="h-5 w-5 text-yellow-500"></i>
                            <span class="text-sm text-gray-600">Kualitas Premium</span>
                        </div>
                    </div>

                    <!-- CTA Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <button class="group bg-primary text-white px-8 py-3 rounded-md hover:bg-primary/90 transition-colors">
                            Belanja Sekarang
                            <i data-lucide="arrow-right" class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform inline"></i>
                        </button>
                        <button class="border border-gray-300 px-8 py-3 rounded-md hover:bg-gray-50 transition-colors">
                            Lihat Katalog
                        </button>
                    </div>

                    <!-- Social Proof -->
                    <div class="flex items-center space-x-6 pt-4">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">10K+</div>
                            <div class="text-sm text-gray-600">Pelanggan Puas</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">50+</div>
                            <div class="text-sm text-gray-600">Produk Terpilih</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">4.9</div>
                            <div class="text-sm text-gray-600">Rating Bintang</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - Hero Image -->
                <div class="relative">
                    <div class="relative z-10">
                        <img
                            src="https://images.unsplash.com/photo-1618160702438-9b02ab6515c9?w=600&h=600&fit=crop"
                            alt="Produk Minyak Bayi"
                            class="rounded-2xl shadow-2xl w-full"
                        />
                    </div>
                    <!-- Decorative elements -->
                    <div class="absolute top-4 right-4 w-24 h-24 bg-baby-pink-200 rounded-full opacity-20 -z-10"></div>
                    <div class="absolute bottom-4 left-4 w-32 h-32 bg-baby-blue-200 rounded-full opacity-20 -z-10"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white" id="about">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">
                    Mengapa Memilih Kami?
                </h2>
                <p class="text-lg text-gray-600">
                    Komitmen kami untuk memberikan yang terbaik bagi bayi Anda
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center group">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-baby-pink-100 rounded-full mb-4 group-hover:bg-primary group-hover:text-white transition-colors">
                        <i data-lucide="shield" class="h-8 w-8 text-primary group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        Aman & Berkualitas
                    </h3>
                    <p class="text-gray-600">
                        Semua produk telah teruji klinis dan aman untuk kulit sensitif bayi
                    </p>
                </div>

                <div class="text-center group">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-baby-pink-100 rounded-full mb-4 group-hover:bg-primary group-hover:text-white transition-colors">
                        <i data-lucide="truck" class="h-8 w-8 text-primary group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        Pengiriman Cepat
                    </h3>
                    <p class="text-gray-600">
                        Gratis ongkos kirim untuk pembelian di atas Rp 100.000
                    </p>
                </div>

                <div class="text-center group">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-baby-pink-100 rounded-full mb-4 group-hover:bg-primary group-hover:text-white transition-colors">
                        <i data-lucide="award" class="h-8 w-8 text-primary group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        Produk Premium
                    </h3>
                    <p class="text-gray-600">
                        Hanya menjual produk dari brand terpercaya dan berkualitas tinggi
                    </p>
                </div>

                <div class="text-center group">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-baby-pink-100 rounded-full mb-4 group-hover:bg-primary group-hover:text-white transition-colors">
                        <i data-lucide="heart-handshake" class="h-8 w-8 text-primary group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">
                        Layanan Terpercaya
                    </h3>
                    <p class="text-gray-600">
                        Customer service 24/7 siap membantu Anda kapan saja
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Product Grid Section -->
    <section class="py-16 bg-gray-50" id="products">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                    Produk Minyak Bayi Terbaik
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Pilihan lengkap minyak bayi berkualitas premium dari brand terpercaya
                    untuk memberikan perawatan terbaik bagi si kecil
                </p>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Product 1 -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
                    <div class="relative overflow-hidden rounded-t-lg">
                        <img
                            src="https://images.unsplash.com/photo-1535268647677-300dbf3d78d1?w=300&h=300&fit=crop"
                            alt="Minyak Telon Bayi Premium"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                        />
                        
                        <!-- Badges -->
                        <div class="absolute top-2 left-2 flex flex-col gap-1">
                            <span class="bg-baby-blue-500 text-white text-xs px-2 py-1 rounded-full">
                                Baru
                            </span>
                            <span class="bg-primary text-white text-xs px-2 py-1 rounded-full">
                                Sale
                            </span>
                        </div>

                        <!-- Wishlist Button -->
                        <button class="absolute top-2 right-2 bg-white/80 hover:bg-white p-2 rounded-full">
                            <i data-lucide="heart" class="h-4 w-4"></i>
                        </button>
                    </div>

                    <div class="p-4 space-y-3">
                        <!-- Rating -->
                        <div class="flex items-center gap-1">
                            <div class="flex items-center">
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                            </div>
                            <span class="text-xs text-gray-500">(124)</span>
                        </div>

                        <!-- Product Name -->
                        <h3 class="font-semibold text-gray-900 line-clamp-2 min-h-[2.5rem]">
                            Minyak Telon Bayi Premium
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 line-clamp-2">
                            Minyak telon tradisional dengan formula alami untuk menghangatkan tubuh bayi
                        </p>

                        <!-- Price -->
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-bold text-primary">
                                Rp 45.000
                            </span>
                            <span class="text-sm text-gray-500 line-through">
                                Rp 60.000
                            </span>
                        </div>
                    </div>

                    <div class="p-4 pt-0">
                        <button class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-primary/90 transition-colors group">
                            <i data-lucide="shopping-cart" class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform inline"></i>
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
                    <div class="relative overflow-hidden rounded-t-lg">
                        <img
                            src="https://images.unsplash.com/photo-1721322800607-8c38375eef04?w=300&h=300&fit=crop"
                            alt="Baby Oil Chamomile Extract"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                        />
                        
                        <!-- Wishlist Button -->
                        <button class="absolute top-2 right-2 bg-white/80 hover:bg-white p-2 rounded-full">
                            <i data-lucide="heart" class="h-4 w-4"></i>
                        </button>
                    </div>

                    <div class="p-4 space-y-3">
                        <!-- Rating -->
                        <div class="flex items-center gap-1">
                            <div class="flex items-center">
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                            </div>
                            <span class="text-xs text-gray-500">(89)</span>
                        </div>

                        <!-- Product Name -->
                        <h3 class="font-semibold text-gray-900 line-clamp-2 min-h-[2.5rem]">
                            Baby Oil Chamomile Extract
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 line-clamp-2">
                            Minyak bayi dengan ekstrak chamomile untuk kulit sensitif dan mudah iritasi
                        </p>

                        <!-- Price -->
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-bold text-primary">
                                Rp 55.000
                            </span>
                        </div>
                    </div>

                    <div class="p-4 pt-0">
                        <button class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-primary/90 transition-colors group">
                            <i data-lucide="shopping-cart" class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform inline"></i>
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
                    <div class="relative overflow-hidden rounded-t-lg">
                        <img
                            src="https://images.unsplash.com/photo-1618160702438-9b02ab6515c9?w=300&h=300&fit=crop"
                            alt="Minyak Kemiri Bayi Organik"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                        />
                        
                        <!-- Badges -->
                        <div class="absolute top-2 left-2 flex flex-col gap-1">
                            <span class="bg-primary text-white text-xs px-2 py-1 rounded-full">
                                Sale
                            </span>
                        </div>

                        <!-- Wishlist Button -->
                        <button class="absolute top-2 right-2 bg-white/80 hover:bg-white p-2 rounded-full">
                            <i data-lucide="heart" class="h-4 w-4"></i>
                        </button>
                    </div>

                    <div class="p-4 space-y-3">
                        <!-- Rating -->
                        <div class="flex items-center gap-1">
                            <div class="flex items-center">
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-gray-300"></i>
                            </div>
                            <span class="text-xs text-gray-500">(156)</span>
                        </div>

                        <!-- Product Name -->
                        <h3 class="font-semibold text-gray-900 line-clamp-2 min-h-[2.5rem]">
                            Minyak Kemiri Bayi Organik
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 line-clamp-2">
                            Minyak kemiri murni untuk merawat dan menguatkan rambut bayi secara alami
                        </p>

                        <!-- Price -->
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-bold text-primary">
                                Rp 65.000
                            </span>
                            <span class="text-sm text-gray-500 line-through">
                                Rp 80.000
                            </span>
                        </div>
                    </div>

                    <div class="p-4 pt-0">
                        <button class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-primary/90 transition-colors group">
                            <i data-lucide="shopping-cart" class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform inline"></i>
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
                    <div class="relative overflow-hidden rounded-t-lg">
                        <img
                            src="https://images.unsplash.com/photo-1535268647677-300dbf3d78d1?w=300&h=300&fit=crop"
                            alt="Baby Massage Oil Lavender"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                        />
                        
                        <!-- Badges -->
                        <div class="absolute top-2 left-2 flex flex-col gap-1">
                            <span class="bg-baby-blue-500 text-white text-xs px-2 py-1 rounded-full">
                                Baru
                            </span>
                        </div>

                        <!-- Wishlist Button -->
                        <button class="absolute top-2 right-2 bg-white/80 hover:bg-white p-2 rounded-full">
                            <i data-lucide="heart" class="h-4 w-4"></i>
                        </button>
                    </div>

                    <div class="p-4 space-y-3">
                        <!-- Rating -->
                        <div class="flex items-center gap-1">
                            <div class="flex items-center">
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-gray-300"></i>
                            </div>
                            <span class="text-xs text-gray-500">(93)</span>
                        </div>

                        <!-- Product Name -->
                        <h3 class="font-semibold text-gray-900 line-clamp-2 min-h-[2.5rem]">
                            Baby Massage Oil Lavender
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 line-clamp-2">
                            Minyak pijat bayi dengan aroma lavender untuk relaksasi dan tidur nyenyak
                        </p>

                        <!-- Price -->
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-bold text-primary">
                                Rp 50.000
                            </span>
                        </div>
                    </div>

                    <div class="p-4 pt-0">
                        <button class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-primary/90 transition-colors group">
                            <i data-lucide="shopping-cart" class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform inline"></i>
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product 5 -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
                    <div class="relative overflow-hidden rounded-t-lg">
                        <img
                            src="https://images.unsplash.com/photo-1721322800607-8c38375eef04?w=300&h=300&fit=crop"
                            alt="Minyak Zaitun Bayi Extra Virgin"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                        />
                        
                        <!-- Wishlist Button -->
                        <button class="absolute top-2 right-2 bg-white/80 hover:bg-white p-2 rounded-full">
                            <i data-lucide="heart" class="h-4 w-4"></i>
                        </button>
                    </div>

                    <div class="p-4 space-y-3">
                        <!-- Rating -->
                        <div class="flex items-center gap-1">
                            <div class="flex items-center">
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                            </div>
                            <span class="text-xs text-gray-500">(201)</span>
                        </div>

                        <!-- Product Name -->
                        <h3 class="font-semibold text-gray-900 line-clamp-2 min-h-[2.5rem]">
                            Minyak Zaitun Bayi Extra Virgin
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 line-clamp-2">
                            Minyak zaitun extra virgin yang kaya nutrisi untuk melembabkan kulit bayi
                        </p>

                        <!-- Price -->
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-bold text-primary">
                                Rp 70.000
                            </span>
                        </div>
                    </div>

                    <div class="p-4 pt-0">
                        <button class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-primary/90 transition-colors group">
                            <i data-lucide="shopping-cart" class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform inline"></i>
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>

                <!-- Product 6 -->
                <div class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 hover:-translate-y-1 group">
                    <div class="relative overflow-hidden rounded-t-lg">
                        <img
                            src="https://images.unsplash.com/photo-1618160702438-9b02ab6515c9?w=300&h=300&fit=crop"
                            alt="Baby Oil Aloe Vera & Vitamin E"
                            class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                        />
                        
                        <!-- Badges -->
                        <div class="absolute top-2 left-2 flex flex-col gap-1">
                            <span class="bg-primary text-white text-xs px-2 py-1 rounded-full">
                                Sale
                            </span>
                        </div>

                        <!-- Wishlist Button -->
                        <button class="absolute top-2 right-2 bg-white/80 hover:bg-white p-2 rounded-full">
                            <i data-lucide="heart" class="h-4 w-4"></i>
                        </button>
                    </div>

                    <div class="p-4 space-y-3">
                        <!-- Rating -->
                        <div class="flex items-center gap-1">
                            <div class="flex items-center">
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-yellow-400 fill-current"></i>
                                <i data-lucide="star" class="h-3 w-3 text-gray-300"></i>
                            </div>
                            <span class="text-xs text-gray-500">(67)</span>
                        </div>

                        <!-- Product Name -->
                        <h3 class="font-semibold text-gray-900 line-clamp-2 min-h-[2.5rem]">
                            Baby Oil Aloe Vera & Vitamin E
                        </h3>

                        <!-- Description -->
                        <p class="text-sm text-gray-600 line-clamp-2">
                            Minyak bayi dengan aloe vera dan vitamin E untuk kulit lembut dan sehat
                        </p>

                        <!-- Price -->
                        <div class="flex items-center gap-2">
                            <span class="text-lg font-bold text-primary">
                                Rp 40.000
                            </span>
                            <span class="text-sm text-gray-500 line-through">
                                Rp 50.000
                            </span>
                        </div>
                    </div>

                    <div class="p-4 pt-0">
                        <button class="w-full bg-primary text-white py-2 px-4 rounded-md hover:bg-primary/90 transition-colors group">
                            <i data-lucide="shopping-cart" class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform inline"></i>
                            Tambah ke Keranjang
                        </button>
                    </div>
                </div>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-12">
                <button class="bg-primary text-white px-8 py-3 rounded-full hover:bg-primary/90 transition-colors">
                    Lihat Produk Lainnya
                </button>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white" id="contact">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="space-y-4">
                    <div class="text-2xl font-bold">
                        BabyOil<span class="text-primary">Store</span>
                    </div>
                    <p class="text-gray-400">
                        Toko online terpercaya untuk produk minyak bayi berkualitas premium. 
                        Memberikan perawatan terbaik untuk si kecil.
                    </p>
                    <div class="flex space-x-4">
                        <i data-lucide="facebook" class="h-5 w-5 text-gray-400 hover:text-white cursor-pointer"></i>
                        <i data-lucide="instagram" class="h-5 w-5 text-gray-400 hover:text-white cursor-pointer"></i>
                        <i data-lucide="twitter" class="h-5 w-5 text-gray-400 hover:text-white cursor-pointer"></i>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Beranda</a></li>
                        <li><a href="#products" class="text-gray-400 hover:text-white">Produk</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Blog</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white">Kontak</a></li>
                    </ul>
                </div>

                <!-- Categories -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Kategori Produk</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white">Minyak Telon</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Baby Oil</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Minyak Kemiri</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Minyak Pijat</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white">Minyak Zaitun</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div class="space-y-4">
                    <h3 class="text-lg font-semibold">Hubungi Kami</h3>
                    <div class="space-y-2">
                        <div class="flex items-center space-x-2">
                            <i data-lucide="phone" class="h-4 w-4 text-primary"></i>
                            <span class="text-gray-400">+62 812-3456-7890</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i data-lucide="mail" class="h-4 w-4 text-primary"></i>
                            <span class="text-gray-400">info@babyoilstore.com</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <i data-lucide="map-pin" class="h-4 w-4 text-primary"></i>
                            <span class="text-gray-400">Jakarta, Indonesia</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="border-t border-gray-800 mt-8 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        © 2024 BabyOilStore. Semua hak dilindungi.
                    </p>
                    <div class="flex space-x-6 mt-4 md:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white text-sm">Kebijakan Privasi</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm">Syarat & Ketentuan</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Mobile menu toggle
        function toggleMobileMenu() {
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');
            
            mobileMenu.classList.toggle('hidden');
            menuIcon.classList.toggle('hidden');
            closeIcon.classList.toggle('hidden');
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add to cart functionality (placeholder)
        document.querySelectorAll('button:contains("Tambah ke Keranjang")').forEach(button => {
            button.addEventListener('click', function() {
                alert('Produk ditambahkan ke keranjang!');
            });
        });
    </script>
</body>
</html>