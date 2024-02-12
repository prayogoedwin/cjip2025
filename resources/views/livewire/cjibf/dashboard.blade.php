<div>
    <!-- Hero -->
    <div class="relative overflow-hidden mt-16">
        <div class="container mx-auto py-10">
            <div class="max-w-5xl text-center mx-auto mt-5">
                <h1 class="block text-4xl font-bold text-gray-800 sm:text-4xl md:text-5xl dark:text-white">
                    {{ $cjibf->site_title }}</span></h1>
                <p class="mt-3 text-2xl text-gray-800 dark:text-gray-400">{{ $cjibf->site_desc }}</p>
                <div class="mt-8 mb-5 grid-cols-1">
                    @foreach ($cjibf->button as $button)
                        @if ($button['btn_name'] != '')
                            <a href="{{ $button['btn_link'] }}" target="blank"
                                class="shadow-md py-2 px-3 bg-green-600 hover:bg-yellow-500 text-white  rounded-md mt-3 mr-2">{{ $button['btn_name'] }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="mt-10 relative container mx-auto">
                <div class="relative mx-auto">
                    <div class="tiny-one-item studio-img">
                        @foreach ($cjibf->image as $fotos)
                            @if ($fotos['image'] != '')
                                <div class="tiny-slide">
                                    <div class="">
                                        <img src="{{ asset('storage/' . $fotos['image']) }}"
                                            class="w-full rounded-lg object-cover bg-cover"
                                            style="background-size: cover" alt="">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                <div
                    class="absolute bottom-12 -start-20 -z-[1] w-48 h-48 bg-gradient-to-b from-orange-500 to-white p-px rounded-lg dark:to-slate-900">
                    <div class="bg-white w-48 h-48 rounded-lg dark:bg-slate-900"></div>
                </div>

                <div
                    class="absolute -top-12 -end-20 -z-[1] w-48 h-48 bg-gradient-to-t from-blue-600 to-cyan-400 p-px rounded-full">
                    <div class="bg-white w-48 h-48 rounded-full dark:bg-slate-900"></div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="container py-2">
            @livewire(\App\Livewire\Widgets\LoiSumNilai::class)

        </div>
        <div class="container mb-5 mt-5">
            @livewire(\App\Livewire\Widgets\LoiCountNilai::class)
        </div>
        <div class="container mb-5 mt-5">
            @livewire(\App\Filament\Widgets\LoiByKabKota::class)
        </div>
        <div class="container mb-5 mt-5">
            @livewire(\App\Filament\Widgets\LoiByKawasan::class)
        </div>
        <div class="container mb-5 mt-5">
            @livewire(\App\Filament\Widgets\LoiBySektor::class)
        </div>
        <div class="container mb-5 mt-5">
            @livewire(\App\Filament\Widgets\LoiByCountry::class)
        </div>
    </div>
    <!-- End Hero -->
</div>
