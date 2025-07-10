<!-- Header ala EliteShop sebagai komponen Blade -->
<header class="bg-white shadow-lg sticky top-0 z-50">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between h-16">
            <a href="/" class="flex items-center space-x-2">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-600 to-purple-600 rounded-lg"></div>
                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                    Gentle Living
                </span>
            </a>
            <nav class="hidden md:flex items-center space-x-8">
                <a href="/" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Home</a>
                <a href="/products" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Products</a>
                <a href="/categories" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Categories</a>
                <a href="/about" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">About</a>
            </nav>
            <div class="flex items-center space-x-4">
                <div class="hidden md:flex items-center space-x-2">
                    <input type="search" placeholder="Search products..." class="w-64 border rounded px-3 py-1 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    <button class="p-2 text-gray-500 hover:text-blue-600">
                        <!-- Search Icon -->
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                    </button>
                </div>
                <button class="p-2 text-gray-500 hover:text-blue-600">
                    <!-- User Icon -->
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M6 20c0-2.21 3.58-4 6-4s6 1.79 6 4"/></svg>
                </button>
                <a href="/cart" class="relative">
                    <button class="p-2 text-gray-500 hover:text-blue-600">
                        <!-- Shopping Cart Icon -->
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full h-5 w-5 flex items-center justify-center text-xs">3</span>
                    </button>
                </a>
                <button class="p-2 text-gray-500 hover:text-blue-600 md:hidden" x-data="{ open: false }" @click="open = !open" x-on:click="$refs.mobileMenu.classList.toggle('hidden')">
                    <!-- Menu Icon -->
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="4" y1="6" x2="20" y2="6"/><line x1="4" y1="12" x2="20" y2="12"/><line x1="4" y1="18" x2="20" y2="18"/></svg>
                </button>
            </div>
        </div>
        <!-- Mobile Menu -->
        <div class="md:hidden hidden py-4 border-t" x-ref="mobileMenu">
            <nav class="flex flex-col space-y-2">
                <a href="/" class="text-gray-700 hover:text-blue-600 transition-colors py-2">Home</a>
                <a href="/products" class="text-gray-700 hover:text-blue-600 transition-colors py-2">Products</a>
                <a href="/categories" class="text-gray-700 hover:text-blue-600 transition-colors py-2">Categories</a>
                <a href="/about" class="text-gray-700 hover:text-blue-600 transition-colors py-2">About</a>
            </nav>
        </div>
    </div>
</header>
