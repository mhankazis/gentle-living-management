<!-- Categories Section ala Shop by Category -->
@php
$categories = [
  [ 'name' => 'Fashion', 'icon' => 'shirt', 'color' => 'from-pink-500 to-rose-500', 'count' => '120+' ],
  [ 'name' => 'Watches', 'icon' => 'watch', 'color' => 'from-blue-500 to-indigo-500', 'count' => '85+' ],
  [ 'name' => 'Electronics', 'icon' => 'headphones', 'color' => 'from-purple-500 to-violet-500', 'count' => '200+' ],
  [ 'name' => 'Mobile', 'icon' => 'smartphone', 'color' => 'from-green-500 to-emerald-500', 'count' => '150+' ],
  [ 'name' => 'Automotive', 'icon' => 'car', 'color' => 'from-orange-500 to-red-500', 'count' => '95+' ],
  [ 'name' => 'Home & Garden', 'icon' => 'home', 'color' => 'from-teal-500 to-cyan-500', 'count' => '180+' ],
];
$icons = [
  'shirt' => '<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M16 3.13a4 4 0 0 0-8 0L2 6v2l4 2v9a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-9l4-2V6z"/></svg>',
  'watch' => '<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="7"/><path d="M12 9v3l2 2"/><path d="M16.51 7.49L17.5 4.5M7.49 7.49L6.5 4.5M16.51 16.51l.99 3M7.49 16.51l-.99 3"/></svg>',
  'headphones' => '<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><rect x="2" y="18" width="4" height="4" rx="1"/><rect x="18" y="18" width="4" height="4" rx="1"/></svg>',
  'smartphone' => '<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="5" y="2" width="14" height="20" rx="2"/><path d="M12 18h.01"/></svg>',
  'car' => '<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 13l1-2a2 2 0 0 1 2-1h12a2 2 0 0 1 2 1l1 2"/><rect x="5" y="6" width="14" height="7" rx="2"/><circle cx="7.5" cy="17.5" r="1.5"/><circle cx="16.5" cy="17.5" r="1.5"/></svg>',
  'home' => '<svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 9.5L12 4l9 5.5V20a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V9.5z"/><path d="M9 22V12h6v10"/></svg>',
];
@endphp
<section class="py-20 bg-white/50">
  <div class="container mx-auto px-4">
    <div class="text-center mb-16">
      <h2 class="text-4xl font-bold text-gray-900 mb-4">Shop by Category</h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        Jelajahi koleksi pilihan yang dirancang untuk gaya hidup Anda
      </p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
      @foreach ($categories as $category)
        <div class="group hover:shadow-xl transition-all duration-300 cursor-pointer border-0 bg-white/80 backdrop-blur-sm hover:scale-105 rounded-2xl">
          <div class="p-6 text-center">
            <div class="w-16 h-16 bg-gradient-to-r {{ $category['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:rotate-6 transition-transform duration-300">
              {!! $icons[$category['icon']] !!}
            </div>
            <h3 class="font-semibold text-gray-900 mb-1">{{ $category['name'] }}</h3>
            <p class="text-sm text-gray-500">{{ $category['count'] }} items</p>
          </div>
        </div>
      @endforeach
    </div>
    <div class="text-center mt-12">
      <button class="border border-gray-300 px-8 py-3 text-lg font-semibold rounded-lg bg-white hover:bg-gray-50 transition">
        View All Categories
      </button>
    </div>
  </div>
</section>
