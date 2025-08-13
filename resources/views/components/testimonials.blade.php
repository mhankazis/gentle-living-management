    <!-- Testimonials Section -->
<section class="py-20" style="background: linear-gradient(to right, #528B67, #614DAC);">
  <div class="container mx-auto px-4">
    <div class="text-center mb-16">
      <h2 class="text-5xl md:text-6xl font-bold text-white mb-6">Cerita para Ibu</h2>
      <p class="text-xl text-white/90 max-w-2xl mx-auto">Dengarkan pengalaman nyata dari para ibu yang telah mempercayai produk Gentle Living</p>
    </div>
    
    <!-- Testimonials Carousel -->
    <div x-data="{
      currentSlide: 0,
      testimonials: [
        {
          text: 'Hari ini Fathiyah masuk angin, muntah, dan mual. Trus inget punya Tummy Calmer. Langsung dioles-oles ke perut Alhamdulillah langsung terkentut-kentut dan lega katanya. Makasih Gentle Baby!',
          author: 'Mom Firda Amalia'
        },
        {
          text: 'Produk Gentle Baby benar-benar membantu anak saya tidur lebih nyenyak. Sekarang rutinitas malam jadi lebih tenang dan menyenangkan. Terima kasih Gentle Baby!',
          author: 'Mom Sarah Putri'
        },
        {
          text: 'Saya sangat senang dengan kualitas produk Gentle Baby. Anak saya yang biasanya rewel saat mandi, sekarang jadi lebih tenang dan rileks. Highly recommended!',
          author: 'Mom Diana Sari'
        },
        {
          text: 'Gentle Baby sudah menjadi andalan keluarga kami. Produknya aman, alami, dan benar-benar efektif untuk si kecil. Tidak akan ganti produk lain!',
          author: 'Mom Rina Fitri'
        },
        {
          text: 'Setelah pakai Gentle Baby, anak saya jadi lebih aktif dan ceria. Mood-nya juga lebih stabil. Terima kasih sudah menciptakan produk yang luar biasa!',
          author: 'Mom Lina Dewi'
        },
        {
          text: 'Gentle Baby memang gentle! Cocok banget untuk kulit sensitif anak saya. Sekarang tidak khawatir lagi dengan iritasi atau ruam. Love it!',
          author: 'Mom Anisa Rahman'
        }
      ],
      autoSlide: null,
      init() {
        this.startAutoSlide();
      },
      startAutoSlide() {
        this.autoSlide = setInterval(() => {
          this.nextSlide();
        }, 4000);
      },
      stopAutoSlide() {
        if (this.autoSlide) {
          clearInterval(this.autoSlide);
        }
      },
      nextSlide() {
        this.currentSlide = (this.currentSlide + 1) % Math.ceil(this.testimonials.length / 3);
      },
      prevSlide() {
        this.currentSlide = this.currentSlide === 0 ? Math.ceil(this.testimonials.length / 3) - 1 : this.currentSlide - 1;
      },
      goToSlide(index) {
        this.currentSlide = index;
        this.stopAutoSlide();
        this.startAutoSlide();
      }
    }" 
    @mouseenter="stopAutoSlide()" 
    @mouseleave="startAutoSlide()"
    class="relative max-w-6xl mx-auto">
    
      <!-- Navigation Arrows -->
      <button @click="prevSlide()" class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-6 z-10 bg-white/20 hover:bg-white/30 text-white p-4 rounded-full transition-all duration-300 backdrop-blur-sm shadow-lg">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
      </button>
      
      <button @click="nextSlide()" class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-6 z-10 bg-white/20 hover:bg-white/30 text-white p-4 rounded-full transition-all duration-300 backdrop-blur-sm shadow-lg">
        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
      </button>

      <!-- Testimonials Container -->
      <div class="overflow-hidden">
        <div class="flex transition-transform duration-500 ease-in-out" 
             :style="`transform: translateX(-${currentSlide * 100}%)`">
          
          <!-- Slide 1 -->
          <div class="w-full flex-shrink-0">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 px-6">
              <template x-for="(testimonial, index) in testimonials.slice(0, 3)" :key="index">
                <div class="bg-white rounded-xl p-8 shadow-xl transform hover:scale-105 transition-transform duration-300 min-h-[280px] flex flex-col">
                  <div class="flex items-start space-x-6 flex-1">
                    <div class="w-20 h-20 bg-gradient-to-r from-blue-400 to-purple-400 rounded-full flex-shrink-0 flex items-center justify-center shadow-lg">
                      <span class="text-white font-bold text-2xl" x-text="testimonial.author.split(' ')[1].charAt(0)"></span>
                    </div>
                    <div class="flex-1 flex flex-col justify-between h-full">
                      <p class="text-gray-700 mb-6 leading-relaxed text-base flex-1" x-text="testimonial.text"></p>
                      <h4 class="font-bold text-blue-600 text-lg" x-text="testimonial.author"></h4>
                    </div>
                  </div>
                </div>
              </template>
            </div>
          </div>

          <!-- Slide 2 -->
          <div class="w-full flex-shrink-0">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 px-6">
              <template x-for="(testimonial, index) in testimonials.slice(3, 6)" :key="index">
                <div class="bg-white rounded-xl p-8 shadow-xl transform hover:scale-105 transition-transform duration-300 min-h-[280px] flex flex-col">
                  <div class="flex items-start space-x-6 flex-1">
                    <div class="w-20 h-20 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex-shrink-0 flex items-center justify-center shadow-lg">
                      <span class="text-white font-bold text-2xl" x-text="testimonial.author.split(' ')[1].charAt(0)"></span>
                    </div>
                    <div class="flex-1 flex flex-col justify-between h-full">
                      <p class="text-gray-700 mb-6 leading-relaxed text-base flex-1" x-text="testimonial.text"></p>
                      <h4 class="font-bold text-blue-600 text-lg" x-text="testimonial.author"></h4>
                    </div>
                  </div>
                </div>
              </template>
            </div>
          </div>

        </div>
      </div>

      <!-- Navigation Dots -->
      <div class="flex justify-center mt-12 space-x-4">
        <template x-for="(slide, index) in Array(Math.ceil(testimonials.length / 3))" :key="index">
          <button 
            @click="goToSlide(index)"
            class="w-4 h-4 rounded-full transition-all duration-300"
            :class="currentSlide === index ? 'bg-white scale-125' : 'bg-white/50 hover:bg-white/70'">
          </button>
        </template>
      </div>

      <!-- Progress Bar -->
      <div class="mt-8 max-w-lg mx-auto">
        <div class="w-full bg-white/20 rounded-full h-2">
          <div class="bg-white h-2 rounded-full transition-all duration-4000 ease-linear" 
               :style="`width: ${((currentSlide + 1) / Math.ceil(testimonials.length / 3)) * 100}%`">
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
