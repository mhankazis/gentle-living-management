<!-- Carousel Banner Produk -->
<section class="relative">
  <div x-data="{
    currentSlide: 0,
    banners: [
      {
        title: 'CAROUSEL BANNER PRODUK',
        subtitle: 'Temukan Produk Terbaik untuk Si Kecil',
        image: '/images/banner1.jpg',
        cta: 'Belanja Sekarang',
        bgColor: 'from-blue-400 to-purple-500'
      },
      {
        title: 'GENTLE BABY PRODUCTS',
        subtitle: 'Perawatan Lembut untuk Buah Hati Anda',
        image: '/images/banner2.jpg',
        cta: 'Lihat Koleksi',
        bgColor: 'from-green-400 to-blue-500'
      },
      {
        title: 'PRODUK BERKUALITAS TINGGI',
        subtitle: 'Dikembangkan oleh Ahli untuk Si Kecil',
        image: '/images/banner3.jpg',
        cta: 'Pelajari Lebih Lanjut',
        bgColor: 'from-pink-400 to-purple-500'
      }
    ],
    autoSlide: null,
    init() {
      this.startAutoSlide();
    },
    startAutoSlide() {
      this.autoSlide = setInterval(() => {
        this.nextSlide();
      }, 5000);
    },
    stopAutoSlide() {
      if (this.autoSlide) {
        clearInterval(this.autoSlide);
      }
    },
    nextSlide() {
      this.currentSlide = (this.currentSlide + 1) % this.banners.length;
    },
    prevSlide() {
      this.currentSlide = this.currentSlide === 0 ? this.banners.length - 1 : this.currentSlide - 1;
    },
    goToSlide(index) {
      this.currentSlide = index;
      this.stopAutoSlide();
      this.startAutoSlide();
    }
  }" 
  @mouseenter="stopAutoSlide()" 
  @mouseleave="startAutoSlide()"
  class="relative h-96 md:h-[500px] overflow-hidden">

    <!-- Banner Slides -->
    <div class="relative h-full">
      <template x-for="(banner, index) in banners" :key="index">
        <div 
          class="absolute inset-0 w-full h-full transition-all duration-700 ease-in-out"
          :class="currentSlide === index ? 'opacity-100 translate-x-0' : 'opacity-0 translate-x-full'"
          x-show="currentSlide === index"
          x-transition:enter="transition ease-out duration-700"
          x-transition:enter-start="opacity-0 transform translate-x-full"
          x-transition:enter-end="opacity-100 transform translate-x-0"
          x-transition:leave="transition ease-in duration-300"
          x-transition:leave-start="opacity-100 transform translate-x-0"
          x-transition:leave-end="opacity-0 transform -translate-x-full">
          
          <!-- Background Gradient -->
          <div class="absolute inset-0 bg-gradient-to-r" :class="banner.bgColor"></div>
          
          <!-- Content -->
          <div class="relative h-full flex items-center justify-center">
            <div class="container mx-auto px-4">
              <div class="text-center text-white">
                <!-- Main Title -->
                <h1 class="text-4xl md:text-6xl lg:text-7xl font-bold mb-4 tracking-wider" 
                    x-text="banner.title"
                    x-transition:enter="transition ease-out duration-1000 delay-300"
                    x-transition:enter-start="opacity-0 transform translate-y-8"
                    x-transition:enter-end="opacity-100 transform translate-y-0">
                </h1>
                
                <!-- Subtitle -->
                <p class="text-lg md:text-xl lg:text-2xl mb-8 opacity-90 max-w-2xl mx-auto" 
                   x-text="banner.subtitle"
                   x-transition:enter="transition ease-out duration-1000 delay-500"
                   x-transition:enter-start="opacity-0 transform translate-y-8"
                   x-transition:enter-end="opacity-100 transform translate-y-0">
                </p>
                
                <!-- CTA Button -->
                <button class="bg-white text-gray-800 hover:bg-gray-100 px-8 py-4 rounded-lg font-bold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg"
                        x-text="banner.cta"
                        x-transition:enter="transition ease-out duration-1000 delay-700"
                        x-transition:enter-start="opacity-0 transform translate-y-8"
                        x-transition:enter-end="opacity-100 transform translate-y-0">
                </button>
              </div>
            </div>
          </div>
          
          <!-- Decorative Elements -->
          <div class="absolute top-20 left-10 w-20 h-20 bg-white/10 rounded-full animate-pulse"></div>
          <div class="absolute bottom-20 right-10 w-16 h-16 bg-white/10 rounded-full animate-pulse delay-1000"></div>
          <div class="absolute top-1/2 right-20 w-12 h-12 bg-white/10 rounded-full animate-pulse delay-500"></div>
        </div>
      </template>
    </div>

    <!-- Navigation Arrows -->
    <button @click="prevSlide()" 
            class="absolute left-4 top-1/2 transform -translate-y-1/2 z-20 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm group">
      <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
      </svg>
    </button>
    
    <button @click="nextSlide()" 
            class="absolute right-4 top-1/2 transform -translate-y-1/2 z-20 bg-white/20 hover:bg-white/30 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm group">
      <svg class="w-6 h-6 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
      </svg>
    </button>

    <!-- Navigation Dots -->
    <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-20 flex space-x-3">
      <template x-for="(banner, index) in banners" :key="index">
        <button 
          @click="goToSlide(index)"
          class="w-3 h-3 rounded-full transition-all duration-300 transform hover:scale-125"
          :class="currentSlide === index ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/70'">
        </button>
      </template>
    </div>

    <!-- Progress Bar -->
    <div class="absolute bottom-0 left-0 w-full h-1 bg-white/20">
      <div class="h-full bg-white transition-all duration-5000 ease-linear" 
           :style="`width: ${((currentSlide + 1) / banners.length) * 100}%`">
      </div>
    </div>

  </div>
</section>
