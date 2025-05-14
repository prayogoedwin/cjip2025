<div>
    <div class="py-5 lg:w-3/5 w-4/5 mx-auto">
        <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 gap-[30px] mt-8">
            <div id="tawar"
                class=" dark:shadow-gray-700 hover:shadow-md dark:hover:shadow-gray-700 col-span-1 flex items-center justify-center px-2 py-4 rounded-xl @if ($acti == 1) bg-green-600 @else bg-white dark:bg-slate-800 @endif overflow-hidden shadow-sm cursor-pointer"
                wire:click="updateMarket({{ 1 }})">
                <div class="grid grid-cols-4 lg:grid-cols-7 gap-2 text-center">
                    <img src="{{ url('images/icon/ditawarkan.png') }}" class="ml-4 w-10 h-10 col-span-1"
                        alt="Siap Ditawarkan">
                    <div
                        class="col-span-3 lg:col-span-6 text-lg lg:text-xl pt-1 font-semibold @if ($acti == 1) text-white @else text-green-600 @endif">
                        {{ __('proyek.tab_1', [], $locale) }}</div>
                </div>
            </div>

            <div id="prospek"
                class=" dark:shadow-gray-700 hover:shadow-md dark:hover:shadow-gray-700 col-span-1 flex items-center justify-center px-2 py-4 rounded-xl @if ($acti == 2) bg-green-600 @else bg-white dark:bg-slate-800 @endif overflow-hidden shadow-sm cursor-pointer"
                wire:click="updateMarket({{ 2 }})">
                <div class="grid grid-cols-4 lg:grid-cols-7 gap-2 text-center">
                    <img src="{{ url('images/icon/prospektif.png') }}" class="ml-4 w-10 h-10 col-span-1"
                        alt="Siap Ditawarkan">
                    <div
                        class="col-span-3 lg:col-span-6 text-lg lg:text-xl pt-1 font-semibold @if ($acti == 2) text-white @else text-green-600 @endif">
                        {{ __('proyek.tab_2', [], $locale) }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="py-5 lg:w-3/5 w-4/5 mx-auto">
        <form class="flex max-w-full" wire:submit.prevent="cariProyeks">
            <label for="simple-search" class="sr-only">Search</label>
            <div class="relative w-full">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <!-- Search Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1 ml-1 text-gray-400" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M12.9 14.32a8 8 0 111.42-1.42l3.5 3.5a1 1 0 01-1.42 1.42l-3.5-3.5zM8 14a6 6 0 100-12 6 6 0 000 12z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
                <input type="text" id="simple-search" wire:model="search" autocomplete="off"
                    class="mt-1 block w-full pl-10 px-3 py-4 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-green-500 sm:text-sm lg:text-lg"
                    placeholder="{{ __('proyek.search', [], $locale) }} ..." required />
            </div>
        </form>
    </div>

    @isset($proyeks)
        @if ($proyeks->isEmpty())
            <div class="lg:mx-20 md:mx-8 py-5 mb-5 px-2 flex justify-center mx-auto">
                <p class="text-gray-500">{{ __('proyek.notfound', [], $locale) }}</p>
            </div>
        @else
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-[30px]">
                    @foreach ($proyeks as $proyek)
                        <div
                            class="group relative rounded hover:-mt-1 shadow hover:shadow-md dark:shadow-gray-800 overflow-hidden duration-300">
                            <div class="relative overflow-hidden">
                                <img src="{{ asset('storage/' . $proyek->foto[0]) }}" class="object-cover"
                                    style="height: 230px; width: 100%;" alt="">
                                <a href="#!"
                                    class="inline-flex items-center justify-center rounded-full absolute top-2">
                                    @isset($proyek->sektor_id)
                                        <div class="pl-3 pt-1 relative">
                                            <div class="text-base px-5 py-1 bg-green-600 rounded text-white font-normal">
                                                {{ $proyek->sektor->nama }}</div>
                                        </div>
                                    @endisset
                                </a>

                                <div
                                    class="absolute p-4 start-0 end-0 text-center bg-slate-900/80 -bottom-24 group-hover:bottom-0 duration-300">

                                    <a href="{{ route('detail_investasi', $proyek->id) }}"
                                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-green-700 text-white rounded-md">{{ __('proyek.button_1', [], $locale) }}</a>
                                    <a href="{{ route('profil_kabkota', $proyek->kab_kota_id) }}"
                                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-green-700 text-white rounded-md">{{ __('proyek.button_2', [], $locale) }}</a>
                                    {{-- <a href="{{ route('form_kajian_proyek') }}"
                                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-green-700 text-white rounded-md">
                                        {{ __('proyek.button_4', [], $locale) }}
                                    </a> --}}
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="block max-w-md mb-3 justify-between flex">
                                    <div class="flex">
                                        @if ($proyek->market->id == 1)
                                            <p class="text-base font-bold" style="color: #1DB053;">
                                                {{ __('proyek.tab_1', [], $locale) }}</p>
                                        @elseif($proyek->market->id == 2)
                                            <p class="text-base font-bold" style="color: #498DBF;">
                                                {{ __('proyek.tab_2', [], $locale) }}</p>
                                        @elseif($proyek->market->id == 3)
                                            <p class="text-base font-bold" style="color: #FE1010;">
                                                {{ __('proyek.tab_3', [], $locale) }}</p>
                                        @elseif($proyek->market->id == 4)
                                            <p class="text-base font-bold" style="color: #FF6C00;">
                                                {{ __('proyek.tab_4', [], $locale) }}</p>
                                        @endif
                                    </div>
                                    <p class="text-base px-5 py-1 bg-green-600 rounded text-white font-normal">
                                        {{ $proyek->kabkota->nama }}</p>
                                </div>
                                <a href="{{ route('detail_investasi', $proyek->id) }}"
                                    class="hover:text-green-600 text-lg font-semibold">{{ \Illuminate\Support\Str::limit(strip_tags($proyek->getTranslations('nama', [$locale]) ? $proyek->getTranslations('nama', [$locale])[$locale] : $proyek->nama), 100, ' ...') }}</a>
                                <p class="text-slate-600 mt-2 text-justify">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($proyek->getTranslations('latar_belakang', [$locale]) ? $proyek->getTranslations('latar_belakang', [$locale])[$locale] : $proyek->latar_belakang), 200, ' ...') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="pagination py-5 container">
                <x-filament::pagination :paginator="$proyeks" />
            </div>
        @endif
    @endisset
</div>
