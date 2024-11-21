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
                                </div>
                            </div>
                        </div>
                    </div>
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

            <div
                class="absolute gap-3 bottom-0 left-0 right-0 justify-center mb-4 z-20 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 px-4 w-full max-w-5xl mx-auto">
                @auth
                    <a href="#"
                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">
                        Kepeminatan
                    </a>
                    <a href="#"
                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">
                        Kemitraan
                    </a>
                    <a href="#"
                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">
                        Permohonan Insentif
                    </a>
                @endauth
                @guest
                    <a href="{{ route('pengajuan.kepeminatan') }}"
                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">
                        Kepeminatan
                    </a>
                    <a href="#"
                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">
                        Kemitraan
                    </a>
                    <a href="#"
                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">
                        Permohonan Insentif
                    </a>
                @endguest
            </div>

        </div>
    </section>

    @livewire('beranda.pembuka')
    @livewire('beranda.grafik')
    @livewire('beranda.kawasan')
    @livewire('beranda.berita')
    @livewire('beranda.link')
</div>
