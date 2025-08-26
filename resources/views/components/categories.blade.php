<!-- Categories Section ala Shop by Category -->
@php
// Get dynamic categories from database
$dbCategories = \App\Models\MasterCategory::withCount('items')->get();

// Map database categories to display format
$categories = [];
$colorClasses = [
  'from-emerald-500 to-teal-500',
  'from-blue-500 to-indigo-500', 
  'from-purple-500 to-violet-500',
  'from-pink-500 to-rose-500',
  'from-orange-500 to-red-500',
  'from-teal-500 to-cyan-500',
  'from-amber-500 to-yellow-500',
  'from-green-500 to-emerald-500'
];

$iconMap = [
  'Minyak Bayi' => 'baby',
  'Aromaterapi' => 'flower', 
  'Kesehatan' => 'heart',
  'Perawatan Kulit' => 'oil',
  'Essential Oil' => 'oil',
  'Perawatan Bayi' => 'baby',
  'Minyak Alami' => 'oil',
  'Produk Anak' => 'child',
  'Bundle Hemat' => 'gift'
];

foreach ($dbCategories as $index => $category) {
  $icon = $iconMap[$category->category_name] ?? 'heart';
  $color = $colorClasses[$index % count($colorClasses)];
  $categories[] = [
    'id' => $category->category_id,
    'name' => $category->category_name,
    'icon' => $icon,
    'color' => $color,
    'count' => $category->items_count
  ];
}

$icons = [
  'baby' => '<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="8" r="4"/><path d="M8 14s2-2 4-2 4 2 4 2v6H8v-6z"/></svg>',
  'oil' => '<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2v20m-8-8a8 8 0 1 1 16 0"/></svg>',
  'child' => '<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="6" r="3"/><path d="M9 18v-3c0-1.1.9-2 2-2h2c1.1 0 2 .9 2 2v3"/></svg>',
  'flower' => '<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M12 2a3 3 0 0 0-3 3c0 1.5 1.5 3 3 3s3-1.5 3-3a3 3 0 0 0-3-3z"/><path d="M19 12a3 3 0 0 0-3-3c-1.5 0-3 1.5-3 3s1.5 3 3 3a3 3 0 0 0 3-3z"/><circle cx="12" cy="12" r="2"/></svg>',
  'heart' => '<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.29 1.51 4.04 3 5.5l7 7 7-7z"/></svg>',
  'gift' => '<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="8" width="18" height="4" rx="1"/><path d="M12 8v13"/><path d="M19 12v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-7"/><path d="M7.5 8a2.5 2.5 0 0 1 0-5C11 3 12 5 12 5s1-2 4.5-2a2.5 2.5 0 0 1 0 5"/></svg>',
];
@endphp
<section class="py-20 bg-gradient-to-br from-[#528B67] to-[#614DAC]">
  <div class="container mx-auto px-4">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold bg-gradient-to-r from-white to-gray-100 bg-clip-text text-transparent mb-4">Kategori Produk Kami</h2>
      <p class="text-xl text-gray-100 max-w-2xl mx-auto">
        Temukan produk perawatan alami terbaik untuk keluarga tercinta
      </p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
      @foreach ($categories as $category)
        <a href="{{ route('products.category', $category['id']) }}" class="group hover:shadow-2xl transition-all duration-300 cursor-pointer border-0 bg-white/95 backdrop-blur-sm hover:scale-105 rounded-2xl shadow-lg block">
          <div class="p-6 text-center">
            <div class="w-16 h-16 bg-gradient-to-r {{ $category['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:rotate-6 transition-transform duration-300 shadow-md">
              {!! $icons[$category['icon']] !!}
            </div>
            <h3 class="font-semibold text-gray-900 mb-1">{{ $category['name'] }}</h3>
            <p class="text-sm text-gray-600">{{ $category['count'] }} produk</p>
          </div>
        </a>
      @endforeach
    </div>
    <div class="text-center mt-12">
      <a href="{{ route('products.index') }}" class="border-2 border-white/30 px-8 py-3 text-lg font-semibold rounded-lg bg-white/20 backdrop-blur-sm text-white hover:bg-white/30 transition-all duration-300 inline-block">
        Lihat Semua Kategori
      </a>
    </div>
  </div>
</section>
