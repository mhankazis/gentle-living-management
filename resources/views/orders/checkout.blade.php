@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8" x-data="checkoutForm()">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Checkout</h1>
    
    <form @submit.prevent="submitOrder()" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        
        <!-- Shipping Information -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Informasi Pengiriman</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                        <input type="text" 
                               name="customer_name" 
                               x-model="form.customer_name"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                        <input type="email" 
                               name="customer_email" 
                               x-model="form.customer_email"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon *</label>
                        <input type="tel" 
                               name="customer_phone" 
                               x-model="form.customer_phone"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kota *</label>
                        <input type="text" 
                               name="city" 
                               x-model="form.city"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                        <textarea name="shipping_address" 
                                  x-model="form.shipping_address"
                                  required
                                  rows="3"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos *</label>
                        <input type="text" 
                               name="postal_code" 
                               x-model="form.postal_code"
                               required
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>
            </div>
            
            <!-- Order Items -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">Produk yang Dipesan</h2>
                
                <div class="space-y-4">
                    @foreach($cartItems as $item)
                    <div class="flex items-center space-x-4 py-4 border-b border-gray-200 last:border-b-0">
                        <img src="https://via.placeholder.com/80x80/f3f4f6/9ca3af?text={{ urlencode($item->item_name) }}" 
                             alt="{{ $item->item_name }}" 
                             class="w-16 h-16 object-cover rounded-lg">
                        
                        <div class="flex-1">
                            <h3 class="font-medium text-gray-800">{{ $item->item_name }}</h3>
                            <p class="text-gray-600">{{ $item->quantity }} x Rp {{ number_format($item->item_price, 0, ',', '.') }}</p>
                        </div>
                        
                        <div class="text-right">
                            <p class="font-semibold text-gray-800">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 sticky top-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-6">Ringkasan Pesanan</h3>
                
                <div class="space-y-4 mb-6">
                    <div class="flex justify-between text-gray-600">
                        <span>Subtotal</span>
                        <span>Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-gray-600">
                        <span>Ongkos Kirim</span>
                        <span>Rp {{ number_format($shippingCost, 0, ',', '.') }}</span>
                    </div>
                    <div class="border-t border-gray-200 pt-4">
                        <div class="flex justify-between text-xl font-semibold text-gray-800">
                            <span>Total</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                
                <button type="submit" 
                        :disabled="loading"
                        class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition duration-200 font-medium disabled:opacity-50 disabled:cursor-not-allowed">
                    <span x-show="!loading">Buat Pesanan</span>
                    <span x-show="loading" class="flex items-center justify-center">
                        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                </button>
                
                <div class="mt-4 text-sm text-gray-600">
                    <p>* Dengan melanjutkan, Anda menyetujui syarat dan ketentuan yang berlaku.</p>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function checkoutForm() {
    return {
        loading: false,
        form: {
            customer_name: '',
            customer_email: '',
            customer_phone: '',
            shipping_address: '',
            city: '',
            postal_code: ''
        },
        
        submitOrder() {
            this.loading = true;
            
            fetch('{{ route("orders.store") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(this.form)
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Network response was not ok');
            })
            .then(data => {
                // Redirect will be handled by controller
                window.location.href = data.redirect || '/';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat membuat pesanan');
            })
            .finally(() => {
                this.loading = false;
            });
        }
    }
}
</script>
@endsection
