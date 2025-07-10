<!-- Cart Page -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen flex flex-col bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')
    <div class="flex-1 w-full flex items-center justify-center">
        <div class="container mx-auto px-2 sm:px-4 py-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-10 sm:mb-12 text-center tracking-tight">Shopping Cart</h1>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 md:gap-8 items-start">
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 md:p-8">
                        @include('components.cart-items')
                    </div>
                </div>
                <div class="lg:col-span-1 mt-8 lg:mt-0">
                    <div class="bg-white rounded-2xl shadow-lg p-4 sm:p-6 md:p-8 sticky top-8">
                        @include('components.cart-summary')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-auto">
        @include('components.footer')
    </div>
</div>
@endsection
