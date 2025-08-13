<!-- Riwayat Page -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')

    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Riwayat Pesanan</h1>
            <p class="text-gray-600">Kelola pesanan dan lacak status pengiriman Anda</p>
        </div>

    <!-- Filter Tabs -->
    <div class="mb-6">
        <div class="flex flex-wrap gap-2">
            <button class="px-4 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg font-medium shadow-md hover:shadow-lg transition-all duration-300">Semua</button>
            <button class="px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg font-medium hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 shadow-sm">Belum Bayar</button>
            <button class="px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg font-medium hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 shadow-sm">Sedang Diproses</button>
            <button class="px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg font-medium hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 shadow-sm">Dikirim</button>
            <button class="px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg font-medium hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 shadow-sm">Selesai</button>
            <button class="px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg font-medium hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 shadow-sm">Dibatalkan</button>
            <button class="px-4 py-2 bg-white border border-gray-200 text-gray-600 rounded-lg font-medium hover:bg-gray-50 hover:border-gray-300 transition-all duration-300 shadow-sm">Pengembalian Barang</button>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="mb-6">
        <div class="relative">
            <input type="text" placeholder="Kamu bisa cari berdasarkan nama produk atau nomor pesanan" 
                   class="w-full px-4 py-3 border border-gray-300 rounded-lg pl-10 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 shadow-sm">
            <svg class="absolute left-3 top-1/2 transform -translate-y-1/2 h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
    </div>

    <!-- Order History Card -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300 mb-6">
        <div class="p-6">
            <!-- Order Header -->
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <!-- Product Image -->
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-200 to-teal-300 rounded-lg flex-shrink-0 flex items-center justify-center">
                        <svg class="h-8 w-8 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Gentle Baby Joy</h3>
                        <p class="text-gray-600 text-sm mb-2">Variasi: Varian 1</p>
                        <p class="text-gray-600 text-sm">x1</p>
                    </div>
                </div>
                
                <!-- Price -->
                <div class="text-right">
                    <p class="text-lg font-semibold text-gray-800">$189</p>
                </div>
            </div>

            <!-- Order Status Info -->
            <div class="flex items-center text-sm text-emerald-600 mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
                <span>Pesanan telah tiba di alamat tujuan. Diterima oleh Yang Bersangkutan</span>
            </div>

            <!-- Order Total and Actions -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Total Pesanan:</span>
                    <span class="text-xl font-bold text-blue-600">$189</span>
                </div>
                
                <div class="flex space-x-3">
                    <button class="px-6 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg font-medium hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 shadow-md hover:shadow-lg">
                        Beli Lagi
                    </button>
                    <button class="px-6 py-2 border border-gray-300 text-gray-600 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-300">
                        Atur Pengembalian
                    </button>
                    <button class="px-6 py-2 border border-gray-300 text-gray-600 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-300">
                        Beri Penilaian
                    </button>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="mt-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                    Selesai
                </span>
            </div>
        </div>
    </div>

    <!-- Second Order Example -->
    <div class="bg-white rounded-lg border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300 mb-6">
        <div class="p-6">
            <!-- Order Header -->
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-4">
                    <!-- Product Image -->
                    <div class="w-20 h-20 bg-gradient-to-br from-amber-200 to-orange-300 rounded-lg flex-shrink-0 flex items-center justify-center">
                        <svg class="h-8 w-8 text-amber-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"/>
                        </svg>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="flex-1">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Gentle Baby Imboost</h3>
                        <p class="text-gray-600 text-sm mb-2">Variasi: Kemasan 100ml</p>
                        <p class="text-gray-600 text-sm">x2</p>
                    </div>
                </div>
                
                <!-- Price -->
                <div class="text-right">
                    <p class="text-lg font-semibold text-gray-800">$89</p>
                </div>
            </div>

            <!-- Order Status Info -->
            <div class="flex items-center text-sm text-blue-600 mb-4">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>Pesanan sedang dalam perjalanan ke alamat tujuan</span>
            </div>

            <!-- Order Total and Actions -->
            <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">Total Pesanan:</span>
                    <span class="text-xl font-bold text-blue-600">$89</span>
                </div>
                
                <div class="flex space-x-3">
                    <button class="px-6 py-2 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-lg font-medium hover:from-blue-600 hover:to-indigo-600 transition-all duration-300 shadow-md hover:shadow-lg">
                        Lacak Pesanan
                    </button>
                    <button class="px-6 py-2 border border-gray-300 text-gray-600 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-300">
                        Hubungi Penjual
                    </button>
                </div>
                </div>
            </div>

            <!-- Status Badge -->
            <div class="mt-4">
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                    Dikirim
                </span>
            </div>
        </div>
    </div>

    <!-- Empty State (Hidden by default) -->
    <div class="hidden text-center py-16">
        <div class="mx-auto h-24 w-24 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mb-4">
            <svg class="h-12 w-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum ada riwayat pesanan</h3>
        <p class="text-gray-600 mb-6">Anda belum memiliki pesanan apapun. Mulai berbelanja sekarang!</p>
        <a href="/products" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg font-medium hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 shadow-md hover:shadow-lg">
            Mulai Belanja
        </a>
    </div>

    </div>

    @include('components.features')
    @include('components.footer')
</div>
@endsection