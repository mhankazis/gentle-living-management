<!-- Categories Page -->
@extends('layouts.app')

@section('content')
@php
$categories = [
    [
        'id' => 1,
        'name' => 'Fashion',
        'description' => 'Trendy clothing and accessories for all occasions',
        'image' => '/placeholder.svg',
        'productCount' => 120,
        'color' => 'from-pink-500 to-rose-500',
    ],
    [
        'id' => 2,
        'name' => 'Electronics',
        'description' => 'Latest gadgets and electronic devices',
        'image' => '/placeholder.svg',
        'productCount' => 200,
        'color' => 'from-blue-500 to-indigo-500',
    ],
    [
        'id' => 3,
        'name' => 'Home & Garden',
        'description' => 'Everything for your home and garden needs',
        'image' => '/placeholder.svg',
        'productCount' => 180,
        'color' => 'from-green-500 to-emerald-500',
    ],
    [
        'id' => 4,
        'name' => 'Sports & Fitness',
        'description' => 'Gear up for your active lifestyle',
        'image' => '/placeholder.svg',
        'productCount' => 95,
        'color' => 'from-orange-500 to-red-500',
    ],
    [
        'id' => 5,
        'name' => 'Beauty & Health',
        'description' => 'Skincare, makeup, and wellness products',
        'image' => '/placeholder.svg',
        'productCount' => 150,
        'color' => 'from-purple-500 to-violet-500',
    ],
    [
        'id' => 6,
        'name' => 'Automotive',
        'description' => 'Car accessories and maintenance products',
        'image' => '/placeholder.svg',
        'productCount' => 85,
        'color' => 'from-teal-500 to-cyan-500',
    ],
    [
        'id' => 7,
        'name' => 'Books & Media',
        'description' => 'Books, movies, music, and educational materials',
        'image' => '/placeholder.svg',
        'productCount' => 250,
        'color' => 'from-amber-500 to-yellow-500',
    ],
    [
        'id' => 8,
        'name' => 'Toys & Games',
        'description' => 'Fun and educational toys for all ages',
        'image' => '/placeholder.svg',
        'productCount' => 140,
        'color' => 'from-rose-500 to-pink-500',
    ],
];
@endphp
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')
    <div class="container mx-auto px-4 py-12">
        <div class="text-center mb-12">
            <h1 class="text-5xl font-bold text-gray-900 mb-4">Shop by Category</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Discover our wide range of products organized by category. Find exactly what you're looking for with ease.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @foreach ($categories as $category)
                @include('components.category-card', ['category' => $category])
            @endforeach
        </div>
    </div>
    @include('components.features')
    @include('components.footer')
</div>
@endsection
