<!-- Cart Summary Section -->
<div x-data="cartSummary()" @cart-updated.window="updateSummary($event.detail)">
    <div class="bg-white/80 backdrop-blur-sm border border-gray-200 rounded-lg p-6 shadow-md">
        <h2 class="text-xl font-bold text-gray-800 mb-6">Ringkasan Pesanan</h2>
        
        <!-- Loading State -->
        <div x-show="loading" class="text-center py-8">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-emerald-500 mx-auto"></div>
            <p class="text-gray-600 text-sm mt-2">Menghitung total...</p>
        </div>
        
        <!-- Content -->
        <div x-show="!loading">
            <!-- Order Items -->
            <div class="space-y-3 mb-6" x-show="cartItems.length > 0">
                <template x-for="item in cartItems" :key="item.cart_id">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-gray-600">
                            <span x-text="item.item_name"></span> x<span x-text="item.quantity"></span>
                        </span>
                        <span class="font-medium text-gray-800">Rp <span x-text="formatPrice(item.subtotal)"></span></span>
                    </div>
                </template>
            </div>
            
            <!-- Empty State -->
            <div x-show="cartItems.length === 0" class="text-center py-8">
                <p class="text-gray-500">Belum ada item di keranjang</p>
            </div>
            
            <!-- Summary Calculations -->
            <div x-show="cartItems.length > 0" class="border-t border-gray-200 pt-4 space-y-3">
                <div class="flex justify-between text-gray-600">
                    <span>Subtotal</span>
                    <span>Rp <span x-text="formatPrice(subtotal)"></span></span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>PPN (11%)</span>
                    <span>Rp <span x-text="formatPrice(tax)"></span></span>
                </div>
                <div class="flex justify-between text-gray-600">
                    <span>Ongkos Kirim</span>
                    <span>Rp <span x-text="formatPrice(shipping)"></span></span>
                </div>
                <div class="border-t border-gray-200 pt-3 flex justify-between items-center">
                    <span class="text-lg font-bold text-gray-800">Total</span>
                    <span class="text-xl font-bold text-emerald-600">Rp <span x-text="formatPrice(total)"></span></span>
                </div>
            </div>
            
            <!-- Promo Code Section -->
            <div x-show="cartItems.length > 0" class="mt-6 p-4 bg-gray-50 rounded-lg">
                <label for="promo-code" class="block text-sm font-medium text-gray-700 mb-2">Kode Promo</label>
                <div class="flex space-x-2">
                    <input 
                        type="text" 
                        id="promo-code" 
                        x-model="promoCode"
                        placeholder="Masukkan kode promo"
                        class="flex-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-sm"
                    >
                    <button 
                        type="button" 
                        @click="applyPromo()"
                        :disabled="!promoCode || applyingPromo"
                        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-colors duration-300 text-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <span x-show="!applyingPromo">Terapkan</span>
                        <span x-show="applyingPromo">...</span>
                    </button>
                </div>
                <div x-show="promoMessage" x-text="promoMessage" :class="promoSuccess ? 'text-green-600' : 'text-red-600'" class="text-xs mt-1"></div>
            </div>
            
            <!-- Checkout Button -->
            <div x-show="cartItems.length > 0" class="mt-6">
                <a href="{{ route('checkout.index') }}" 
                   class="w-full block text-center bg-gradient-to-r from-emerald-500 to-teal-500 text-white py-3 px-6 rounded-lg font-semibold hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 shadow-md hover:shadow-lg">
                    Lanjutkan ke Checkout
                </a>
            </div>
            
            <!-- Continue Shopping -->
            <div class="mt-4">
                <a href="{{ route('products.index') }}" 
                   class="w-full block text-center bg-white border border-gray-300 text-gray-700 py-3 px-6 rounded-lg font-medium hover:bg-gray-50 transition-colors duration-300">
                    Lanjutkan Belanja
                </a>
            </div>
            
            <!-- Security Note -->
            <div class="mt-6 flex items-center justify-center text-xs text-gray-500">
                <svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Transaksi Aman & Terlindungi
            </div>
        </div>
    </div>
</div>

<script>
function cartSummary() {
    return {
        cartItems: @json($cartItems ?? []),
        loading: false,
        promoCode: '',
        promoMessage: '',
        promoSuccess: false,
        applyingPromo: false,
        shipping: 25000, // Flat shipping rate
        
        get subtotal() {
            return this.cartItems.reduce((sum, item) => sum + parseFloat(item.subtotal || 0), 0);
        },
        
        get tax() {
            return this.subtotal * 0.11; // 11% VAT
        },
        
        get total() {
            return this.subtotal + this.tax + this.shipping;
        },
        
        updateSummary(data) {
            if (data && data.items) {
                this.cartItems = data.items;
            } else {
                // Reload cart items
                this.loadCartItems();
            }
        },
        
        async loadCartItems() {
            this.loading = true;
            
            try {
                const response = await fetch('/cart/items', {
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                const data = await response.json();
                
                if (data.success) {
                    this.cartItems = data.items || [];
                }
            } catch (error) {
                console.error('Error loading cart items:', error);
            } finally {
                this.loading = false;
            }
        },
        
        async applyPromo() {
            if (!this.promoCode) return;
            
            this.applyingPromo = true;
            this.promoMessage = '';
            
            try {
                const response = await fetch('/cart/apply-promo', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ promo_code: this.promoCode })
                });
                
                const data = await response.json();
                
                if (data.success) {
                    this.promoMessage = data.message || 'Kode promo berhasil diterapkan!';
                    this.promoSuccess = true;
                    // Update calculations with promo discount
                    if (data.discount) {
                        // Apply discount logic here
                    }
                } else {
                    this.promoMessage = data.message || 'Kode promo tidak valid';
                    this.promoSuccess = false;
                }
            } catch (error) {
                this.promoMessage = 'Terjadi kesalahan saat menerapkan kode promo';
                this.promoSuccess = false;
            } finally {
                this.applyingPromo = false;
            }
        },
        
        formatPrice(price) {
            return new Intl.NumberFormat('id-ID').format(price);
        }
    }
}
</script>
