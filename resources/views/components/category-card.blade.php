<!-- Category Card -->
@php $color = $category['color'] ?? 'from-blue-500 to-indigo-500'; @endphp
<div class="group hover:shadow-2xl transition-all duration-300 cursor-pointer border-0 bg-white/90 backdrop-blur-sm hover:scale-105 overflow-hidden rounded-2xl">
    <div class="h-32 bg-gradient-to-r {{ $color }} relative">
        <div class="absolute inset-0 bg-black/20 group-hover:bg-black/10 transition-colors duration-300"></div>
        <div class="absolute bottom-4 left-4 right-4">
            <h3 class="text-2xl font-bold text-white mb-1">{{ $category['name'] }}</h3>
            <p class="text-white/90 text-sm">{{ $category['productCount'] }} products</p>
        </div>
    </div>
    <div class="p-6">
        <p class="text-gray-600 mb-4 leading-relaxed">{{ $category['description'] }}</p>
        <button type="button" class="w-full flex items-center justify-center gap-2 border border-gray-300 rounded-lg py-2 font-semibold text-gray-800 bg-white group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-purple-600 group-hover:text-white transition-all duration-300">
            Shop Now
            <svg class="ml-2 h-4 w-4 group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </button>
    </div>
</div>
