@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')
    
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-6">Dashboard</h1>
                
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-semibold text-blue-900 mb-2">Selamat datang, {{ auth()->user()->name }}!</h2>
                    <p class="text-blue-700">Anda berhasil login ke sistem Gentle Living Management.</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg p-6 text-white">
                        <h3 class="text-lg font-semibold mb-2">Produk</h3>
                        <p class="text-blue-100 mb-4">Lihat semua produk</p>
                        <a href="{{ route('products.index') }}" class="bg-white text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition">
                            Lihat Produk
                        </a>
                    </div>
                    
                    <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg p-6 text-white">
                        <h3 class="text-lg font-semibold mb-2">Keranjang</h3>
                        <p class="text-green-100 mb-4">Lihat keranjang belanja</p>
                        <a href="{{ route('cart.index') }}" class="bg-white text-green-600 px-4 py-2 rounded-lg font-medium hover:bg-green-50 transition">
                            Lihat Keranjang
                        </a>
                    </div>
                    
                    <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg p-6 text-white">
                        <h3 class="text-lg font-semibold mb-2">Profil</h3>
                        <p class="text-purple-100 mb-4">Kelola profil Anda</p>
                        <a href="{{ route('profile') }}" class="bg-white text-purple-600 px-4 py-2 rounded-lg font-medium hover:bg-purple-50 transition">
                            Lihat Profil
                        </a>
                    </div>
                </div>
                
                <div class="mt-8 p-6 bg-gray-50 rounded-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Akun</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Nama</label>
                            <p class="text-gray-900">{{ auth()->user()->name }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <p class="text-gray-900">{{ auth()->user()->email }}</p>
                        </div>
                        @if(auth()->user()->phone)
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Telepon</label>
                            <p class="text-gray-900">{{ auth()->user()->phone }}</p>
                        </div>
                        @endif
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bergabung Sejak</label>
                            <p class="text-gray-900">{{ auth()->user()->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    @include('components.footer')
</div>
@endsection
