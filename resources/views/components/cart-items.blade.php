<!-- Cart Items Section -->
<div x-data="cartComponent()" @cart-updated.window="loadCartItems()">
    <h2 class="text-xl font-bold text-gray-800 mb-6">Produk dalam Keranjang</h2>
    
    <!-- Loading State -->
    <div x-show="loading" class="text-center py-8">
        <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-emerald-500 mx-auto"></div>
        <p class="text-gray-600 mt-2">Memuat keranjang...</p>
    </div>
    
    <!-- Cart Items -->
    <div x-show="!loading">
        <template x-for="item in cartItems" :key="item.cart_id">
            <div class="border border-gray-200 rounded-lg p-4 mb-4 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center space-x-4">
                    <!-- Product Image -->
                    <div class="w-20 h-20 bg-gradient-to-br from-emerald-200 to-teal-300 rounded-lg flex-shrink-0 flex items-center justify-center">
                        <img x-show="item.master_item && item.master_item.image" 
                             :src="item.master_item ? '/images/' + item.master_item.image : ''" 
                             :alt="item.item_name"
                             class="w-full h-full object-cover rounded-lg"
                             @error="$el.style.display = 'none'; $el.nextElementSibling.style.display = 'flex'">
                        <svg class="h-8 w-8 text-emerald-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                        </svg>
                    </div>
                    
                    <!-- Product Info -->
                    <div class="flex-1">
                        <h3 class="font-semibold text-gray-800 mb-1" x-text="item.item_name"></h3>
                        <p class="text-gray-600 text-sm">Harga: Rp <span x-text="formatPrice(item.item_price)"></span></p>
                        <p class="text-gray-500 text-xs" x-show="item.master_item && item.master_item.stock">
                            Stok tersedia: <span x-text="item.master_item.stock"></span>
                        </p>
                    </div>
                    
                    <!-- Quantity Controls -->
                    <div class="flex items-center space-x-3">
                        <button @click="updateQuantity(item.cart_id, item.quantity - 1)" 
                                :disabled="item.quantity <= 1 || updating"
                                :class="item.quantity <= 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                                class="w-8 h-8 rounded-lg border border-gray-300 flex items-center justify-center text-gray-600 transition-colors duration-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </button>
                        <span class="w-12 text-center font-medium" x-text="item.quantity"></span>
                        <button @click="updateQuantity(item.cart_id, item.quantity + 1)" 
                                :disabled="(item.master_item && item.quantity >= item.master_item.stock) || updating"
                                :class="(item.master_item && item.quantity >= item.master_item.stock) ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-50'"
                                class="w-8 h-8 rounded-lg border border-gray-300 flex items-center justify-center text-gray-600 transition-colors duration-300">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19"/>
                                <line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                        </button>
                    </div>
                    
                    <!-- Price and Remove -->
                    <div class="text-right">
                        <p class="font-bold text-gray-800 mb-2">Rp <span x-text="formatPrice(item.subtotal)"></span></p>
                        <button @click="removeItem(item.cart_id)" 
                                :disabled="updating"
                                class="text-red-600 hover:text-red-800 hover:bg-red-50 rounded-lg p-2 transition-colors duration-300 disabled:opacity-50">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <polyline points="3 6 5 6 21 6"/>
                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/>
                                <line x1="10" y1="11" x2="10" y2="17"/>
                                <line x1="14" y1="11" x2="14" y2="17"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </template>
        
        <!-- Empty State -->
        <div x-show="cartItems.length === 0" class="text-center py-16">
            <div class="mx-auto h-24 w-24 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mb-4">
                <svg class="h-12 w-12 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="9" cy="21" r="1"/>
                    <circle cx="20" cy="21" r="1"/>
                    <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61l1.38-7.39H6"/>
                </svg>
            </div>
            <h3 class="text-lg font-semibold text-gray-900 mb-2">Keranjang Anda Kosong</h3>
            <p class="text-gray-600 mb-6">Belum ada produk dalam keranjang. Mulai berbelanja sekarang!</p>
            <a href="{{ route('products.index') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-lg font-medium hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 shadow-md hover:shadow-lg">
                Mulai Belanja
            </a>
        </div>
    </div>
    
    <!-- Notification -->
    <div x-show="notification.show" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform translate-y-2"
         class="fixed top-4 right-4 z-50 max-w-sm">
        <div :class="notification.type === 'success' ? 'bg-green-500' : 'bg-red-500'" 
             class="text-white px-4 py-3 rounded-lg shadow-lg flex items-center">
            <svg x-show="notification.type === 'success'" class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <svg x-show="notification.type === 'error'" class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
            <span x-text="notification.message"></span>
        </div>
    </div>
</div>

<script>
function cartComponent() {
    return {
        cartItems: @json($cartItems ?? []),
        loading: false,
        updating: false,
        notification: {
            show: false,
            message: '',
            type: 'success'
        },
        
        init() {
            console.log('Cart component initialized');
            console.log('Cart items:', this.cartItems);
        },
        
        async updateQuantity(cartId, newQuantity) {
            console.log('Update quantity called:', cartId, newQuantity);
            
            if (newQuantity < 1 || this.updating) {
                console.log('Update quantity blocked:', { newQuantity, updating: this.updating });
                return;
            }
            
            this.updating = true;
            console.log('Starting update request...');
            
            try {
                const response = await fetch(`/cart/update/${cartId}`, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ quantity: newQuantity })
                });
                
                console.log('Update response status:', response.status);
                const data = await response.json();
                console.log('Update response data:', data);
                
                if (data.success) {
                    await this.loadCartItems();
                    this.showNotification('Keranjang berhasil diperbarui!', 'success');
                    
                    // Update cart counter
                    if (window.CartCounter && data.cart_count !== undefined) {
                        window.CartCounter.updateCount(data.cart_count);
                    }
                    
                    // Trigger cart summary update
                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: data }));
                } else {
                    this.showNotification(data.message || 'Gagal memperbarui keranjang', 'error');
                }
            } catch (error) {
                console.error('Update quantity error:', error);
                this.showNotification('Terjadi kesalahan saat memperbarui keranjang', 'error');
            } finally {
                this.updating = false;
            }
        },
        
        async removeItem(cartId) {
            console.log('Remove item called:', cartId);
            
            if (this.updating) {
                console.log('Remove blocked - already updating');
                return;
            }
            
            if (!confirm('Apakah Anda yakin ingin menghapus item ini dari keranjang?')) {
                console.log('Remove cancelled by user');
                return;
            }
            
            this.updating = true;
            console.log('Starting remove request...');
            
            try {
                const response = await fetch(`/cart/remove/${cartId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });
                
                console.log('Remove response status:', response.status);
                const data = await response.json();
                console.log('Remove response data:', data);
                
                if (data.success) {
                    await this.loadCartItems();
                    this.showNotification('Item berhasil dihapus dari keranjang!', 'success');
                    
                    // Update cart counter
                    if (window.CartCounter && data.cart_count !== undefined) {
                        window.CartCounter.updateCount(data.cart_count);
                    }
                    
                    // Trigger cart summary update
                    window.dispatchEvent(new CustomEvent('cart-updated', { detail: data }));
                } else {
                    this.showNotification(data.message || 'Gagal menghapus item', 'error');
                }
            } catch (error) {
                console.error('Remove item error:', error);
                this.showNotification('Terjadi kesalahan saat menghapus item', 'error');
            } finally {
                this.updating = false;
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
        
        formatPrice(price) {
            return new Intl.NumberFormat('id-ID').format(price);
        },
        
        showNotification(message, type = 'success') {
            this.notification.message = message;
            this.notification.type = type;
            this.notification.show = true;
            
            setTimeout(() => {
                this.notification.show = false;
            }, 3000);
        }
    }
}
</script>
