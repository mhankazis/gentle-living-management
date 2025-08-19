<!-- Login Page -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-md mx-auto">
            <div class="shadow-2xl border-0 bg-white/90 backdrop-blur-sm rounded-2xl">
                <div class="text-center px-8 pt-8">
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-2">Masuk</h1>
                    <p class="text-gray-600 mb-4">Masuk ke akun Gentle Living Anda</p>
                </div>
                <div class="px-8 pb-8">
                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 text-green-600 text-sm font-semibold">{{ session('status') }}</div>
                    @endif
                    
                    @if ($errors->any())
                        <div class="mb-4 text-red-600 text-sm font-semibold">
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    @endif
                    
                    <form method="POST" action="{{ route('login') }}" class="space-y-4" x-data="{ show: false }">
                        @csrf
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-medium">Email</label>
                            <input id="email" name="email" type="email" 
                                   class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500" 
                                   placeholder="nama@email.com" 
                                   value="{{ old('email') }}" 
                                   required autofocus autocomplete="username">
                        </div>
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-medium">Password</label>
                            <div class="relative">
                                <input :type="show ? 'text' : 'password'" 
                                       id="password" 
                                       name="password" 
                                       class="w-full rounded border-gray-300 focus:ring-blue-500 focus:border-blue-500 pr-10" 
                                       placeholder="Masukkan password" 
                                       required autocomplete="current-password">
                                <button type="button" @click="show = !show" class="absolute right-0 top-0 h-full px-3 py-2 text-gray-500 hover:text-blue-600 focus:outline-none">
                                    <template x-if="show">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <path d="M17.94 17.94A10.06 10.06 0 0 1 12 19c-5.52 0-10-4.48-10-10 0-2.21.72-4.25 1.94-5.94M1 1l22 22"/>
                                            <path d="M9.53 9.53A3.5 3.5 0 0 0 12 15.5c.96 0 1.84-.38 2.47-1"/>
                                        </svg>
                                    </template>
                                    <template x-if="!show">
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                            <circle cx="12" cy="12" r="10"/>
                                            <circle cx="12" cy="12" r="3"/>
                                        </svg>
                                    </template>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Remember Me -->
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" 
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:ring-blue-500" 
                                   name="remember">
                            <label for="remember_me" class="ms-2 text-sm text-gray-600">
                                Ingat saya
                            </label>
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-semibold rounded-lg py-2 transition">
                            Masuk
                        </button>
                    </form>
                    
                    <div class="mt-6 text-center space-y-2">
                        @if (Route::has('password.request'))
                            <div>
                                <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                                    Lupa password?
                                </a>
                            </div>
                        @endif
                        <p class="text-sm text-gray-600">
                            Belum punya akun?
                            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">Daftar di sini</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
</div>
@endsection
