<!-- About Page -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')
    <!-- Hero Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-5xl font-bold mb-6">About EliteShop</h1>
            <p class="text-xl max-w-3xl mx-auto leading-relaxed">
                We're more than just an e-commerce platform. We're your trusted partner in 
                discovering quality products that enhance your lifestyle and bring joy to your everyday moments.
            </p>
        </div>
    </section>
    <!-- Story Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <span class="inline-block mb-4 bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">Our Story</span>
                    <h2 class="text-4xl font-bold text-gray-900 mb-6">
                        Building Tomorrow's Shopping Experience
                    </h2>
                    <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                        Founded in 2020, EliteShop emerged from a simple vision: to create an online 
                        shopping experience that combines convenience, quality, and exceptional service. 
                        What started as a small team's dream has grown into a platform trusted by millions.
                    </p>
                    <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                        We believe that shopping should be more than just a transaction. It should be 
                        an experience that delights, inspires, and connects people with products they love.
                    </p>
                    <button class="px-6 py-3 rounded-lg text-white font-semibold bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 transition">Join Our Journey</button>
                </div>
                <div class="bg-gradient-to-r from-blue-100 to-purple-100 rounded-2xl p-8 h-96 flex items-center justify-center">
                    <div class="text-center">
                        <div class="w-24 h-24 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full mx-auto mb-4 flex items-center justify-center">
                            <!-- Heart Icon -->
                            <svg class="h-12 w-12 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21C12 21 4 13.5 4 8.5C4 5.42 6.42 3 9.5 3C11.24 3 12.91 3.81 14 5.08C15.09 3.81 16.76 3 18.5 3C21.58 3 24 5.42 24 8.5C24 13.5 16 21 16 21H12Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <p class="text-lg font-semibold text-gray-700">Made with passion</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Features Section -->
    <section class="py-20 bg-white/50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose EliteShop?</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    We're committed to providing you with the best shopping experience possible
                </p>
            </div>
            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center hover:shadow-lg transition-shadow duration-300 bg-white rounded-2xl p-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <!-- Shield Icon -->
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 3L4 7v6c0 5.25 4.5 9.75 8 11 3.5-1.25 8-5.75 8-11V7l-8-4z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Secure Shopping</h3>
                    <p class="text-gray-600 leading-relaxed">Your data and transactions are protected with enterprise-level security</p>
                </div>
                <div class="text-center hover:shadow-lg transition-shadow duration-300 bg-white rounded-2xl p-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <!-- Truck Icon -->
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 17V5a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v12M16 17h2a2 2 0 0 0 2-2v-5a2 2 0 0 0-2-2h-2M8 21a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm12 0a2 2 0 1 1-4 0 2 2 0 0 1 4 0z"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Fast Delivery</h3>
                    <p class="text-gray-600 leading-relaxed">Free shipping on orders over $50 with express delivery options</p>
                </div>
                <div class="text-center hover:shadow-lg transition-shadow duration-300 bg-white rounded-2xl p-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <!-- Clock Icon -->
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">24/7 Support</h3>
                    <p class="text-gray-600 leading-relaxed">Round-the-clock customer service to help you anytime</p>
                </div>
                <div class="text-center hover:shadow-lg transition-shadow duration-300 bg-white rounded-2xl p-8">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <!-- Star Icon -->
                        <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20"><polygon points="9.9,1.1 7.6,6.6 1.6,7.6 6,11.7 4.9,17.6 9.9,14.6 14.9,17.6 13.8,11.7 18.2,7.6 12.2,6.6 "/></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-3">Quality Guarantee</h3>
                    <p class="text-gray-600 leading-relaxed">All products come with our satisfaction guarantee</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Stats Section -->
    <section class="py-20">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Our Impact</h2>
                <p class="text-xl text-gray-600">Numbers that tell our story</p>
            </div>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-8">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <!-- Users Icon -->
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">1M+</div>
                    <div class="text-gray-600 font-medium">Happy Customers</div>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <!-- Award Icon -->
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/></svg>
                    </div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">500K+</div>
                    <div class="text-gray-600 font-medium">Products Sold</div>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <!-- Globe Icon -->
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 0 20"/><path d="M12 2a15.3 15.3 0 0 0 0 20"/></svg>
                    </div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">50+</div>
                    <div class="text-gray-600 font-medium">Countries Served</div>
                </div>
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-r from-blue-600 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <!-- Heart Icon -->
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 21C12 21 4 13.5 4 8.5C4 5.42 6.42 3 9.5 3C11.24 3 12.91 3.81 14 5.08C15.09 3.81 16.76 3 18.5 3C21.58 3 24 5.42 24 8.5C24 13.5 16 21 16 21H12Z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </div>
                    <div class="text-4xl font-bold text-gray-900 mb-2">99%</div>
                    <div class="text-gray-600 font-medium">Satisfaction Rate</div>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-purple-600 text-white">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-6">Ready to Start Shopping?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto">
                Join millions of satisfied customers and discover your next favorite product today.
            </p>
            <button class="px-8 py-3 rounded-lg text-blue-600 font-semibold bg-white hover:bg-gray-100 transition text-lg">Start Shopping Now</button>
        </div>
    </section>
    @include('components.footer')
</div>
@endsection
