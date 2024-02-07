<div>
    <section class="relative md:py-18 py-10">

        <div class="container py-5 lg:py-14">
            <div class="grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                <button
                    class="group py-2 flex flex-col @if ($acti == 1) bg-green-600  @else bg-white dark:bg-slate-800 @endif border shadow-sm rounded-xl hover:shadow-md transition dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    <div class="p-4 md:p-5">
                        <div id="tawar" class="flex justify-between items-center"
                            wire:click="updateMarket({{ 1 }})">
                            <div class="flex items-center">
                                <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                    src="{{ url('images/icon/ditawarkan.png') }}" alt="Image Description">
                                <div class="ms-3">
                                    <h3
                                        class="group-hover:text-yellow-500 font-semibold @if ($acti == 1) text-white @else text-green-600 @endif  dark:group-hover:text-gray-400 dark:text-gray-200">
                                        {{ __('proyek.tab_1', [], $locale) }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
                <button
                    class="group py-2 flex flex-col @if ($acti == 4) bg-green-600 @else bg-white dark:bg-slate-800 @endif border shadow-sm rounded-xl hover:shadow-md transition dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    <div class="p-4 md:p-5">
                        <div id="strategi" class="flex justify-between items-center"
                            wire:click="updateMarket({{ 4 }})">
                            <div class="flex items-center">
                                <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                    src="{{ url('images/icon/strategic.png') }}" alt="Image Description">
                                <div class="ms-3">
                                    <h3
                                        class="group-hover:text-yellow-500 font-semibold @if ($acti == 4) text-white @else text-green-600 @endif  dark:group-hover:text-gray-400 dark:text-gray-200">
                                        {{ __('proyek.tab_4', [], $locale) }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
                <button
                    class="group py-2 flex flex-col @if ($acti == 2) bg-green-600 @else bg-white dark:bg-slate-800 @endif border shadow-sm rounded-xl hover:shadow-md transition dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    <div class="p-4 md:p-5">
                        <div id="strategi" class="flex justify-between items-center"
                            wire:click="updateMarket({{ 2 }})">
                            <div class="flex items-center">
                                <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                    src="{{ url('images/icon/prospektif.png') }}" alt="Image Description">
                                <div class="ms-3">
                                    <h3
                                        class="group-hover:text-yellow-500 font-semibold @if ($acti == 2) text-white @else text-green-600 @endif  dark:group-hover:text-gray-400 dark:text-gray-200">
                                        {{ __('proyek.tab_2', [], $locale) }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
                <button
                    class="group py-2 flex flex-col @if ($acti == 3) bg-green-600 @else bg-white dark:bg-slate-800 @endif border shadow-sm rounded-xl hover:shadow-md transition dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                    <div class="p-4 md:p-5">
                        <div id="strategi" class="flex justify-between items-center"
                            wire:click="updateMarket({{ 3 }})">
                            <div class="flex items-center">
                                <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                    src="{{ url('images/icon/potensial.png') }}" alt="Image Description">
                                <div class="ms-3">
                                    <h3
                                        class="group-hover:text-yellow-500 font-semibold @if ($acti == 3) text-white @else text-green-600 @endif  dark:group-hover:text-gray-400 dark:text-gray-200">
                                        {{ __('proyek.tab_3', [], $locale) }}
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </button>
            </div>
        </div>



        {{-- search --}}
        {{-- <div class="lg:w-3/5 w-4/5 mx-auto p-4 mt-8 bg-white dark:bg-slate-800 rounded-lg flex justify-between items-center relative m-8 shadow-sm px-5 "
            style="height: 3.5rem;">
            <div class="pr-4 text-green-600">
                <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" viewBox="0 0 24 24" class="w-6 h-6">
                    <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
            <input type="text" name="search" id="search" placeholder="{{ __('proyek.search', [], $locale) }}"
                style="border: #1DB053;"
                class=" w-full outline-none focus:outline-hidden bg-white dark:bg-slate-800 text-lg" wire:model="query"
                wire:keydown.escape="reset" wire:keydown.tab="reset" wire:keydown.ArrowUp="decrementHighlight"
                wire:keydown.ArrowDown="incrementHighlight" />

            <div wire:loading class="fixed mx-auto h-screen w-screen z-50 justify-center items-center">
                <div class="animate-spin rounded-full h-5 w-5 border-t-2 border-b-2 text-center border-gray-900">
                </div>
            </div>
        </div> --}}
        {{-- end search --}}

        <div>
            @if (!empty($query))
                <div class="flex flex-col items-center mb-2">
                    <div class="lg:w-3/5 w-4/5 flex flex-col items-center h-64 mb-14">
                        <div class="w-full px-4 mt-0">
                            <div class="flex flex-col items-center relative">
                                <div
                                    class="absolute shadow bg-slate-100 dark:bg-slate-800 top-100 z-40 w-full lef-0 rounded max-h-select overflow-y-auto">
                                    <div class="flex flex-col w-full">
                                        @isset($searchs)
                                            @foreach ($searchs as $search)
                                                <a href="{{ route('detail_investasi', $search->id) }}"
                                                    class="cursor-pointer w-full rounded-lg hover:bg-green-600 hover:text-white">
                                                    <div class=" w-full items-center p-2 relative">
                                                        <div class="w-6 flex flex-col items-center pl-4">
                                                            {{-- <div
                                                                class="flex relative w-5 h-5 justify-center  m-1 mr-2 w-4 h-4 mt-1 rounded-full ">
                                                                <img class="rounded-full" alt="{{ $search->nama }}"
                                                                    src="">
                                                            </div> --}}
                                                        </div>
                                                        <div class="w-full items-center flex pl-4">
                                                            <div class="mx-2 -mt-1">
                                                                {{ \Illuminate\Support\Str::limit(strip_tags($search->getTranslations('nama', [$locale]) ? $search->getTranslations('nama', [$locale])[$locale] : $search->nama), 100, ' ...') }}
                                                                @isset($search->sektor_id)
                                                                    <div
                                                                        class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500">
                                                                        {{ $search->sektor->nama }}</div>
                                                                @endisset
                                                                <div
                                                                    class="text-xs truncate w-full normal-case font-normal -mt-1 text-gray-500">
                                                                    {{ $search->kabkota->nama }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                            {{ $searchs->links() }}
                                        @else
                                            <p>Tidak ditemukan !</p>
                                        @endisset
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        @isset($proyeks)
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
                                </div>
                            </div>
                            <div class="p-6">
                                <div class="block max-w-md mb-3">
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
                                </div>
                                <a href="{{ route('detail_investasi', $proyek->id) }}"
                                    class="hover:text-green-600 text-lg font-semibold">{{ \Illuminate\Support\Str::limit(strip_tags($proyek->getTranslations('nama', [$locale]) ? $proyek->getTranslations('nama', [$locale])[$locale] : $proyek->nama), 100, ' ...') }}</a>
                                <p class="text-slate-600 mt-2 text-justify">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($proyek->getTranslations('latar_belakang', [$locale]) ? $proyek->getTranslations('latar_belakang', [$locale])[$locale] : $proyek->latar_belakang), 200, ' ...') }}
                                </p>
                            </div>
                        </div><!--end content-->
                    @endforeach
                </div>
            </div>
            <div class="pagination py-5 container">
                <x-filament::pagination :paginator="$proyeks" />
            </div>
        @endisset
    </section>
</div>
