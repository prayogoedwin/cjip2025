{{-- <div>
    <!-- Slider -->
    <div data-hs-carousel='{
    "loadingClasses": "opacity-0",
    "isAutoPlay": true
  }' class="relative">
        <div class="hs-carousel mt-20 relative overflow-hidden w-full min-h-screen object-cover bg-white">
            <div
                class="hs-carousel-body absolute top-0 bottom-0 start-0 flex flex-nowrap transition-transform duration-700 opacity-0">

                @foreach ($sliders as $slider)
                    <div class="hs-carousel-slide">
                        <div class="flex justify-center h-full bg-gray-300">
                            <img src="{{ asset('storage/' . $slider->foto) }}"
                                class="duration-1000 w-full min-h-screen object-cover" style="background-size: cover"
                                alt="">
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-blue-500"></div>
        </div>

        <button type="button"
            class="hs-carousel-prev hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 start-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/[.1]">
            <span class="text-2xl" aria-hidden="true">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
                </svg>
            </span>
            <span class="sr-only">Previous</span>
        </button>
        <button type="button"
            class="hs-carousel-next hs-carousel:disabled:opacity-50 disabled:pointer-events-none absolute inset-y-0 end-0 inline-flex justify-center items-center w-[46px] h-full text-gray-800 hover:bg-gray-800/[.1]">
            <span class="sr-only">Next</span>
            <span class="text-2xl" aria-hidden="true">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
                </svg>
            </span>
        </button>

        <div class="hs-carousel-pagination flex justify-center absolute bottom-3 start-0 end-0 space-x-2">
            @foreach ($sliders as $slider)
                <span
                    class="hs-carousel-active:bg-blue-700 hs-carousel-active:border-blue-700 w-3 h-3 border border-gray-400 rounded-full cursor-pointer"></span>
            @endforeach
        </div>
    </div>
    <!-- End Slider -->

    @livewire('beranda.berita')
</div> --}}
<div>

    <!-- Start Hero -->
    <section class="swiper-slider-hero relative block h-screen" id="home">
        <div class="swiper-container absolute end-0 top-0 w-full h-full">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide flex items-center overflow-hidden">
                        <div
                            class="slide-inner absolute end-0 top-0 w-full h-full slide-bg-image flex items-center bg-center;">
                            <img class="absolute bg-cover w-full h-full object-cover "
                                src="{{ asset('storage/' . $slider->foto) }}" style="background-size: cover"
                                alt="">
                            <div class="absolute inset-0 bg-gradient-to-b from-black/10 from-2%"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 from-10%"></div>
                            <div class="container top-1/4 relative mb-10">
                                <div class="grid grid-cols-1">
                                    <div class="float-start ">
                                        <h1
                                            class="font-semibold text-white lg:leading-normal leading-normal text-4xl lg:text-5xl mb-5">
                                            {{ $slider->getTranslations('title', [$locale]) ? $slider->getTranslations('title', [$locale])[$locale] : $slider->title }}
                                            <p class="text-white/70 text-lg max-w-3xl">
                                                {{ $slider->getTranslations('desc', [$locale]) ? $slider->getTranslations('desc', [$locale])[$locale] : $slider->desc }}
                                            </p>

                                            @foreach ($slider->button as $button)
                                                <div class="mt-6">
                                                    @if ($button['btn_name'] != '')
                                                        <a href="{{ $button['btn_link'] }}"
                                                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">{{ $button['btn_name'] }}</a>
                                                    @endif
                                                </div>
                                            @endforeach
                                    </div>
                                </div><!--end grid-->
                            </div><!--end container-->
                        </div><!-- end slide-inner -->
                    </div> <!-- end swiper-slide -->
                @endforeach
            </div>
            <!-- end swiper-wrapper -->

            <!-- swipper controls -->
            {{-- <div class="swiper-pagination"></div> --}}
            <div
                class="swiper-button-next bg-transparent w-[35px] h-[35px] leading-[35px] -mt-[30px] bg-none border border-solid border-white/50 text-white hover:bg-green-600 hover:border-green-600 rounded-full text-center">
            </div>
            <div
                class="swiper-button-prev bg-transparent w-[35px] h-[35px] leading-[35px] -mt-[30px] bg-none border border-solid border-white/50 text-white hover:bg-green-600 hover:border-green-600 rounded-full text-center">
            </div>
        </div>
    </section>


    @livewire('beranda.pembuka')
    @livewire('beranda.grafik')
    @livewire('beranda.kawasan')
    @livewire('beranda.berita')
    @livewire('beranda.link')
</div>
