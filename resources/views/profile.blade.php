<!-- Profile Page -->
@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50">
    @include('components.header')
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Profile Info -->
                <div class="lg:col-span-2">
                    <div class="shadow-2xl border-0 bg-white/90 backdrop-blur-sm rounded-2xl">
                        <div class="px-8 pt-8 flex items-center justify-between">
                            <div>
                                <h2 class="text-2xl font-bold text-gray-900 mb-1">Profil Saya</h2>
                                <p class="text-gray-600">Kelola informasi profil Anda</p>
                            </div>
                            <button x-data="{ edit: false }" x-on:click="edit = !edit" x-text="edit ? 'Simpan' : 'Edit Profil'" class="px-4 py-2 rounded-lg font-semibold bg-gradient-to-r from-blue-600 to-purple-600 text-white hover:from-blue-700 hover:to-purple-700 transition"></button>
                        </div>
                        <div class="px-8 pb-8 space-y-6" x-data="profileForm()">
                            <div class="flex items-center space-x-4">
                                <div class="h-20 w-20 rounded-full bg-gradient-to-r from-blue-600 to-purple-600 flex items-center justify-center text-white text-2xl font-bold">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                                </div>
                                <div>
                                    <h3 class="text-xl font-semibold text-gray-900">{{ auth()->user()->name }}</h3>
                                    <p class="text-gray-600">{{ auth()->user()->email }}</p>
                                    <span class="inline-block mt-1 bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">Member Premium</span>
                                </div>
                            </div>
                            <hr>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="space-y-2">
                                    <label for="name" class="flex items-center gap-2 text-sm font-medium">
                                        <!-- User Icon -->
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
                                        Nama Lengkap
                                    </label>
                                    <input id="name" x-model="form.name" :disabled="!edit" class="w-full rounded border-gray-300" />
                                </div>
                                <div class="space-y-2">
                                    <label for="email" class="flex items-center gap-2 text-sm font-medium">
                                        <!-- Mail Icon -->
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="M22 6 12 13 2 6"/></svg>
                                        Email
                                    </label>
                                    <input id="email" type="email" x-model="form.email" :disabled="!edit" class="w-full rounded border-gray-300" />
                                </div>
                                <div class="space-y-2">
                                    <label for="phone" class="flex items-center gap-2 text-sm font-medium">
                                        <!-- Phone Icon -->
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 16.92V19a2 2 0 0 1-2.18 2A19.72 19.72 0 0 1 3 5.18 2 2 0 0 1 5 3h2.09a2 2 0 0 1 2 1.72c.13 1.13.37 2.23.72 3.28a2 2 0 0 1-.45 2.11l-1.27 1.27a16 16 0 0 0 6.29 6.29l1.27-1.27a2 2 0 0 1 2.11-.45c1.05.35 2.15.59 3.28.72A2 2 0 0 1 21 16.91z"/></svg>
                                        Nomor Telepon
                                    </label>
                                    <input id="phone" x-model="form.phone" :disabled="!edit" class="w-full rounded border-gray-300" />
                                </div>
                                <div class="space-y-2">
                                    <label for="joinDate" class="flex items-center gap-2 text-sm font-medium">
                                        <!-- Calendar Icon -->
                                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>
                                        Bergabung Sejak
                                    </label>
                                    <input id="joinDate" x-model="form.joinDate" disabled class="w-full rounded border-gray-300" />
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label for="address" class="flex items-center gap-2 text-sm font-medium">
                                    <!-- MapPin Icon -->
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 6-9 13-9 13S3 16 3 10a9 9 0 1 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                    Alamat
                                </label>
                                <input id="address" x-model="form.address" :disabled="!edit" class="w-full rounded border-gray-300" />
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Recent Orders -->
                <div>
                    <div class="shadow-2xl border-0 bg-white/90 backdrop-blur-sm rounded-2xl">
                        <div class="px-8 pt-8">
                            <h3 class="flex items-center gap-2 text-lg font-bold text-gray-900 mb-4">
                                <!-- ShoppingBag Icon -->
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 2l1.5 4h9L18 2"/><rect x="3" y="6" width="18" height="16" rx="2"/><path d="M16 10a4 4 0 0 1-8 0"/></svg>
                                Pesanan Terbaru
                            </h3>
                        </div>
                        <div class="px-8 pb-8 space-y-4">
                            <div class="p-4 border rounded-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-semibold text-sm">ORD-001</p>
                                        <p class="text-xs text-gray-600">15 Des 2024</p>
                                    </div>
                                    <span class="inline-block bg-blue-100 text-blue-600 text-xs font-semibold px-3 py-1 rounded-full">Dikirim</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <p>3 item - Rp 1.250.000</p>
                                </div>
                            </div>
                            <div class="p-4 border rounded-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-semibold text-sm">ORD-002</p>
                                        <p class="text-xs text-gray-600">10 Des 2024</p>
                                    </div>
                                    <span class="inline-block bg-green-100 text-green-600 text-xs font-semibold px-3 py-1 rounded-full">Selesai</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <p>1 item - Rp 350.000</p>
                                </div>
                            </div>
                            <div class="p-4 border rounded-lg">
                                <div class="flex justify-between items-start mb-2">
                                    <div>
                                        <p class="font-semibold text-sm">ORD-003</p>
                                        <p class="text-xs text-gray-600">5 Des 2024</p>
                                    </div>
                                    <span class="inline-block bg-green-100 text-green-600 text-xs font-semibold px-3 py-1 rounded-full">Selesai</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    <p>2 item - Rp 750.000</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
</div>
<script>
function profileForm() {
    return {
        edit: false,
        form: {
            name: @json(auth()->user()->name),
            email: @json(auth()->user()->email),
            phone: @json(auth()->user()->phone ?? '+62 812 3456 7890'),
            address: 'Jl. Sudirman No. 123, Jakarta',
            joinDate: @json(auth()->user()->created_at->format('F Y')),
        },
    }
}
</script>
@endsection
