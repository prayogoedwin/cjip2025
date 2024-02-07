<div>
    <!-- OPENING START -->
    <section class="relative md:py-8 py-5 mt-2">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
                <div class="md:col-span-5">
                    <div class="relative">
                        <img src="{{ asset('storage/' . $opening->opening_image) }}" class="mx-auto rounded-xl"
                            alt="">
                        <div class="absolute bottom-2/4 translate-y-2/4 right-0 left-0 text-center">
                        </div>
                    </div>
                </div>
                <!--end col-->

                <div class="md:col-span-7">
                    <div class="lg:ml-4">
                        <h4 class="mb-6 text-3xl lg:leading-normal leading-normal font-semibold">
                            @if ($locale == 'id')
                                {{ $opening->opening_title }}
                            @else
                                {{ $opening->opening_title_en }}
                            @endif

                            {{-- <div class="h-2 bg-yellow-500 w-4/12 mt-2"></div> --}}
                        </h4>
                        <div class="text-justify lg:text-xl">
                            <p class="text-slate-400 max-w-3xl text-justify">
                                @if ($locale == 'id')
                                    {!! $opening->opening_desc !!}
                                @else
                                    {!! $opening->opening_desc_en !!}
                                @endif
                            </p>
                        </div>

                        @if ($locale == 'id')
                            @foreach ($opening->opening_button as $button)
                                @if ($button['btn_name'] != '')
                                    <a href="{{ $button['btn_link'] }}"
                                        class="btn btn-primary rounded-md mt-8">{{ $button['btn_name'] }}<i
                                            class="mdi mdi-chevron-right align-middle"></i></a>
                                @endif
                            @endforeach
                        @else
                            @foreach ($opening->opening_button_en as $button)
                                @if ($button['btn_name_en'] != '')
                                    <a href="{{ $button['btn_link_en'] }}"
                                        class="btn btn-primary rounded-md mt-8">{{ $button['btn_name_en'] }}<i
                                            class="mdi mdi-chevron-right align-middle"></i></a>
                                @endif
                            @endforeach
                        @endif

                    </div>
                </div>
                <!--end col-->
            </div>
            <!--end grid-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- End Section-->

    <!-- Start Section-->
    <section class="relative md:py-2 py-2">
        <div class="container">
            <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-[30px]">
                @foreach ($infrastrukturs as $infrastruktur)
                    <div
                        class="p-6 shadow-xl shadow-gray-300 dark:shadow-gray-600 transition duration-500 rounded-2xl mt-4 text-center">
                        <div
                            class="w-20 h-20 bg-primary-600/5 text-primary-600 rounded-xl text-3xl flex align-middle justify-center items-center shadow-sm dark:shadow-gray-700 mx-auto">
                            <img src="{{ asset('storage/' . $infrastruktur->icon) }}" class="w-16">
                        </div>

                        <div class="content mt-5">
                            <a href="#"
                                class="title h5 text-lg font-medium text-green-600 hover:text-yellow-500">{{ $infrastruktur->getTranslations('nama', [$locale]) ? $infrastruktur->getTranslations('nama', [$locale])[$locale] : $infrastruktur->nama }}</a>
                            <p class="text-gray-500 mt-3">
                                {{ $infrastruktur->getTranslations('detail', [$locale]) ? $infrastruktur->getTranslations('detail', [$locale])[$locale] : $infrastruktur->detail }}
                            </p>

                            <div class="mt-5">
                                <a href="{{ asset('storage/' . $infrastruktur->gambar) }}"
                                    class="btn btn-link lightbox text-primary-600 text-green-600 hover:text-yellow-500 after:bg-primary-600 transition duration-500">{{ __('beranda.read_more', [], $locale) }}
                                    <i class="uil uil-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!--end grid-->
        </div>
        <!--end container-->
    </section>
    <!--end section-->
    <!-- End Section-->
</div>
