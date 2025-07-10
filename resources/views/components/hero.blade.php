<!-- Hero Section ala Premium Shopping, disesuaikan untuk Gentle Living -->
<section class="relative overflow-hidden bg-white">
  <div class="container mx-auto px-4 py-20">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
      <div class="space-y-8">
        <div class="space-y-4">
          <div class="flex items-center space-x-2">
            <div class="flex items-center">
              @for ($i = 0; $i < 5; $i++)
                <!-- Star Icon -->
                <svg class="h-5 w-5 fill-yellow-400 text-yellow-400" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              @endfor
            </div>
            <span class="text-sm text-gray-600">Dipercaya 10.000+ pengguna</span>
          </div>
          <h1 class="text-5xl lg:text-7xl font-bold text-gray-900 leading-tight">
            Premium
            <span class="block bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
              Shopping
            </span>
            Experience
          </h1>
          <p class="text-xl text-gray-600 leading-relaxed max-w-lg">
            Temukan solusi premium untuk hidup dan bisnis modern. Kualitas dan mindfulness dalam setiap fitur.
          </p>
        </div>
        <div class="flex flex-col sm:flex-row gap-4">
          <a href="/products">
            <button class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white px-8 py-6 text-lg font-semibold rounded-lg flex items-center group transition">
              Mulai Belanja
              <!-- ArrowRight Icon -->
              <svg class="ml-2 h-5 w-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
          </a>
          <button class="border border-gray-300 px-8 py-6 text-lg font-semibold rounded-lg bg-white hover:bg-gray-50 transition">
            Lihat Koleksi
          </button>
        </div>
        <div class="flex items-center space-x-8 text-sm text-gray-600">
          <div class="flex items-center space-x-2">
            <div class="w-2 h-2 bg-green-500 rounded-full"></div>
            <span>Gratis Ongkir</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
            <span>30 Hari Retur</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-2 h-2 bg-purple-500 rounded-full"></div>
            <span>Kualitas Premium</span>
          </div>
        </div>
      </div>
      <div class="relative">
        <div class="aspect-square bg-gradient-to-br from-blue-100 to-purple-100 rounded-3xl overflow-hidden shadow-2xl relative">
          <div class="w-full h-full bg-gradient-to-br from-blue-400 to-purple-500 opacity-20 absolute inset-0"></div>
          <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white">
              <div class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                <!-- Star Icon -->
                <svg class="h-16 w-16 fill-yellow-400 text-yellow-400" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
              </div>
              <p class="text-lg font-semibold">Premium Products</p>
            </div>
          </div>
        </div>
        <div class="absolute -top-6 -right-6 w-24 h-24 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center shadow-lg">
          <span class="text-white font-bold text-sm">BARU</span>
        </div>
      </div>
    </div>
  </div>
</section>
