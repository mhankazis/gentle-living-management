<!-- Cart Page -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')
    
    <div class="container mx-auto px-4 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-800 mb-2">Keranjang Belanja</h1>
            <p class="text-gray-600">Kelola produk yang ingin Anda beli</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items Section -->
            <div class="lg:col-span-2">
                <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-lg border border-gray-200 p-6">
                    @include('components.cart-items')
                </div>
            </div>
            
            <!-- Cart Summary Section -->
            <div class="lg:col-span-1">
                <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-lg border border-gray-200 p-6 sticky top-8">
                    @include('components.cart-summary')
                </div>
            </div>
        </div>
    </div>

    @include('components.features')
    @include('components.footer')
</div>
@endsection
