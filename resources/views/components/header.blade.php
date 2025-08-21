@php
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

// Get actual cart count based on user authentication
if (Auth::guard('master_users')->check()) {
    $user = Auth::guard('master_users')->user();
    $sessionId = 'user_' . $user->user_id;
} else {
    $sessionId = session()->getId();
}
$cartItemsCount = Cart::getTotalItems($sessionId);
@endphp
<!-- Header ala EliteShop sebagai komponen Blade -->
<header class="bg-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <a href="/" class="flex items-center space-x-2">
                <img src="{{ asset('images/logo-gentle-living.png') }}" alt="Gentle Living" class="h-10 w-auto max-w-[150px]">
                <div class="text-xl font-bold text-gray-800 hidden">
                    <span class="text-emerald-600">Gentle</span> <span class="text-blue-600">Living</span>
                </div>
            </a>
            <nav class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Beranda</a>
                <a href="/products" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Produk</a>
                <a href="/history" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Riwayat</a>
                <a href="/about" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Tentang</a>
            </nav>
            <div class="flex items-center space-x-4">
                <div class="hidden md:flex items-center space-x-2">
                    <input type="search" placeholder="Search products..." class="w-64 border rounded px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <button class="p-2 text-gray-500 hover:text-blue-600">
                        <!-- Search Icon -->
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </button>
                </div>
                @auth('master_users')
                <div x-data="{ open: false }" class="relative">
                    <button @click="open = !open" class="flex items-center space-x-2 px-3 py-2 rounded hover:bg-gray-100">
                        <svg class="h-5 w-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0 1 13 0"/></svg>
                        <div class="hidden md:block text-left">
                            <div class="text-sm font-medium">{{ auth('master_users')->user()->name }}</div>
                            <div class="text-xs text-gray-500">{{ ucfirst(auth('master_users')->user()->role) }}</div>
                        </div>
                    </button>
                    <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-56 bg-white border shadow-lg rounded z-50">
                        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><path d="M9 9h6v6H9z"/></svg>
                            <span>Dashboard</span>
                        </a>
                        @if(auth('master_users')->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100 text-blue-600">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                            <span>Admin Panel</span>
                        </a>
                        @endif
                        <a href="{{ route('profile') }}" class="flex items-center space-x-2 px-4 py-2 hover:bg-gray-100">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0 1 13 0"/></svg>
                            <span>Profil Saya</span>
                        </a>
                        <div class="border-t my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center space-x-2 px-4 py-2 w-full text-left text-red-600 hover:bg-gray-100">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                                <span>Logout</span>
                            </button>
                        </form>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}">
                    <button class="flex items-center px-3 py-2 rounded hover:bg-gray-100">
                        <svg class="h-5 w-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="7" r="4"/><path d="M5.5 21a7.5 7.5 0 0 1 13 0"/></svg>
                        <span class="hidden md:block ml-2">Login</span>
                    </button>
                </a>
                @endauth('master_users')
                <a href="/cart">
                    <button class="relative px-3 py-2 rounded hover:bg-gray-100">
                        <svg class="h-5 w-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61l1.38-7.39H6"/></svg>
                        @if ($cartItemsCount > 0)
                        <span data-cart-count class="absolute -top-2 -right-2 h-5 w-5 flex items-center justify-center p-0 text-xs bg-red-600 text-white rounded-full">{{ $cartItemsCount }}</span>
                        @else
                        <span data-cart-count class="absolute -top-2 -right-2 h-5 w-5 flex items-center justify-center p-0 text-xs bg-red-600 text-white rounded-full hidden"></span>
                        @endif
                    </button>
                </a>
                <button class="md:hidden px-3 py-2 rounded hover:bg-gray-100" x-data="{ open: false }" @click="open = !open">
                    <svg class="h-5 w-5 text-gray-700" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div class="md:hidden hidden py-4 border-t" x-ref="mobileMenu">
            <nav class="flex flex-col space-y-2">
                <a href="/" class="text-gray-700 hover:text-blue-600 transition-colors py-2">Home</a>
                <a href="/products" class="text-gray-700 hover:text-blue-600 transition-colors py-2">Products</a>
                <a href="/history" class="text-gray-700 hover:text-blue-600 transition-colors py-2">Riwayat</a>
                <a href="/about" class="text-gray-700 hover:text-blue-600 transition-colors py-2">About</a>
            </nav>
        </div>
    </div>
</header>

<!-- Cart Counter Script -->
<script>
// Global cart counter management
window.CartCounter = {
    // Update cart count in header
    updateCount: function(count) {
        const cartBadge = document.querySelector('[data-cart-count]');
        if (cartBadge) {
            if (count > 0) {
                cartBadge.textContent = count;
                cartBadge.classList.remove('hidden');
            } else {
                cartBadge.classList.add('hidden');
            }
        }
    },

    // Fetch current cart count from server
    refreshCount: function() {
        fetch('/cart/count', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content'),
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            this.updateCount(data.count || 0);
        })
        .catch(error => {
            console.error('Error fetching cart count:', error);
        });
    },

    // Initialize cart counter on page load
    init: function() {
        // Refresh count when page loads
        this.refreshCount();
        
        // Listen for custom cart update events
        document.addEventListener('cartUpdated', (event) => {
            if (event.detail && event.detail.count !== undefined) {
                this.updateCount(event.detail.count);
            } else {
                this.refreshCount();
            }
        });
    }
};

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.CartCounter.init();
});

// Helper function to trigger cart update event
window.triggerCartUpdate = function(count = null) {
    const event = new CustomEvent('cartUpdated', {
        detail: { count: count }
    });
    document.dispatchEvent(event);
};
</script>
