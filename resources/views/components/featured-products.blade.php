<!-- Featured Products Section -->
@php
// Get real products from database - select top 6 featured products
$featuredProducts = \App\Models\MasterItem::with('category')
    ->orderBy('stock', 'desc')
    ->orderBy('sell_price', 'desc')
    ->take(6)
    ->get()
    ->map(function($product) {
        // Generate image code based on product name
        $productName = strtolower($product->name_item);
        $imageCode = 'placeholder';
        
        // Twin Pack products first (most specific)
        if (str_contains($productName, 'twin pack newborn') || str_contains($productName, 'newborn essential')) {
            $imageCode = 'TP-NB';
        } elseif (str_contains($productName, 'twin pack common cold') || str_contains($productName, 'common cold relief')) {
            $imageCode = 'TP-CC';
        } elseif (str_contains($productName, 'twin pack travel') || str_contains($productName, 'travel essential')) {
            $imageCode = 'TP-TV';
        } 
        // Single product patterns
        elseif (str_contains($productName, 'deep sleep') || str_contains($productName, 'sleep')) {
            $imageCode = 'DS-100-ml';
        } elseif (str_contains($productName, 'bye bugs') || str_contains($productName, 'bug')) {
            $imageCode = 'BB-100-ml';
        } elseif (str_contains($productName, 'ldr booster') || str_contains($productName, 'ldr')) {
            $imageCode = 'LDR-100-ml';
        } elseif (str_contains($productName, 'tummy calm') || str_contains($productName, 'calm')) {
            $imageCode = 'TC-100-ml';
        } elseif (str_contains($productName, 'cough') || str_contains($productName, 'flu')) {
            $imageCode = 'CNF-100-ml';
        } elseif (str_contains($productName, 'joy') || str_contains($productName, 'happiness')) {
            $imageCode = 'JOY-100-ml';
        } elseif (str_contains($productName, 'immune') || str_contains($productName, 'booster') || str_contains($productName, 'immboost')) {
            $imageCode = 'IB-100-ml';
        }
        
        $imagePath = $imageCode !== 'placeholder' ? "/images/{$imageCode}.jpg" : "/images/placeholder.jpg";
        
        // Determine badge and badge color
        $badge = '';
        $badgeColor = '';
        
        if (str_contains($productName, 'twin pack')) {
            $badge = 'Twin Pack';
            $badgeColor = 'bg-purple-500';
        } elseif ($product->stock <= 5) {
            $badge = 'Limited';
            $badgeColor = 'bg-red-500';
        } elseif ($product->sell_price >= 500000) {
            $badge = 'Premium';
            $badgeColor = 'bg-gold-500';
        } elseif (str_contains($productName, 'deep sleep')) {
            $badge = 'Best Seller';
            $badgeColor = 'bg-emerald-500';
        } elseif (str_contains($productName, 'immboost')) {
            $badge = 'Popular';
            $badgeColor = 'bg-blue-500';
        } else {
            $badge = 'Natural';
            $badgeColor = 'bg-green-500';
        }
        
        return [
            'id' => $product->item_id,
            'name' => $product->name_item,
            'price' => $product->sell_price / 1000, // Convert to thousands for display
            'originalPrice' => round(($product->sell_price * 1.2) / 1000), // Add 20% as original price
            'rating' => 4.8, // Default rating
            'reviews' => rand(50, 300), // Random review count
            'image' => $imagePath,
            'badge' => $badge,
            'badgeColor' => $badgeColor,
            'stock' => $product->stock,
            'category' => $product->category ? $product->category->category_name : 'General',
            'description' => $product->description_item,
        ];
    });
@endphp
<section class="py-20 bg-white">
  <div class="container mx-auto px-4">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold bg-gradient-to-r from-emerald-600 to-teal-600 bg-clip-text text-transparent mb-4">Produk Unggulan</h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        Produk perawatan alami terpilih yang dipercaya keluarga Indonesia
      </p>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
      @foreach($featuredProducts as $product)
        <a href="{{ route('product.detail', $product['id']) }}" class="block group">
          <div class="rounded-xl shadow-lg bg-white p-6 hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
            <!-- Product Image -->
            <div class="aspect-square bg-gradient-to-br from-gray-100 to-gray-200 rounded-lg mb-4 overflow-hidden relative group">
              <img src="{{ $product['image'] }}" 
                   alt="{{ $product['name'] }}" 
                   class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                   onerror="this.src='/images/placeholder.jpg'">
              
              <!-- Badge -->
              <div class="absolute top-3 left-3 {{ $product['badgeColor'] }} text-white px-3 py-1 rounded-full text-xs font-medium shadow-lg">
                {{ $product['badge'] }}
              </div>
              
              <!-- Stock indicator -->
              @if($product['stock'] <= 5)
              <div class="absolute top-3 right-3 bg-orange-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                {{ $product['stock'] }} left
              </div>
              @endif
            </div>
            
            <!-- Product Info -->
            <div class="space-y-3">
              <!-- Category -->
              <span class="text-xs text-blue-600 font-medium bg-blue-50 px-2 py-1 rounded-full">
                {{ $product['category'] }}
              </span>
              
              <!-- Product Name -->
              <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2">
                {{ $product['name'] }}
              </h3>
              
              <!-- Description -->
              <p class="text-sm text-gray-600 line-clamp-2">
                {{ Str::limit($product['description'], 80) }}
              </p>
              
              <!-- Rating -->
              <div class="flex items-center space-x-2">
                <div class="flex text-yellow-400">
                  @for($i = 1; $i <= 5; $i++)
                  <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                  </svg>
                  @endfor
                </div>
                <span class="text-sm text-gray-500">({{ $product['reviews'] }} ulasan)</span>
              </div>
              
              <!-- Price -->
              <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                  <span class="text-xl font-bold text-blue-600">Rp {{ number_format($product['price'], 0, ',', '.') }}K</span>
                  <span class="text-gray-400 line-through text-sm">Rp {{ number_format($product['originalPrice'], 0, ',', '.') }}K</span>
                </div>
                <span class="text-green-600 text-sm font-medium">
                  {{ round((($product['originalPrice'] - $product['price']) / $product['originalPrice']) * 100) }}% OFF
                </span>
              </div>
            </div>
            
            <!-- CTA Button -->
            <div class="mt-6">
              <span class="block w-full bg-gradient-to-r from-emerald-600 to-teal-600 text-white text-center rounded-lg py-3 px-4 font-semibold group-hover:from-emerald-700 group-hover:to-teal-700 transition-all duration-200 transform group-hover:scale-105">
                Lihat Detail
              </span>
            </div>
          </div>
        </a>
      @endforeach
    </div>
  </div>
</section>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Enhanced card hover effects */
.group:hover .transform {
    transform: translateY(-8px);
}

/* Gold badge color for premium products */
.bg-gold-500 {
    background: linear-gradient(135deg, #f59e0b, #d97706);
}
</style>
