<div>
    <div class="container py-10 mt-10 lg:py-14 mx-auto">

        <div class="mb-10 mx-auto justify-center">
            <label for="hs-trailing-button-add-on-with-icon-and-button" class="sr-only">Label</label>
            <div class="relative flex rounded-lg shadow-sm">
                <input type="text" id="hs-trailing-button-add-on-with-icon-and-button"
                    name="hs-trailing-button-add-on-with-icon-and-button" placeholder="Search"
                    class="py-3 px-4 ps-11 block w-full border-gray-200 shadow-md rounded-s-lg dark:shadow-md ring-1 ring-gray-300 text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:ring-gray-600">
                <div class="absolute inset-y-0 start-0 flex items-center pointer-events-none z-20 ps-4">
                    <svg class="flex-shrink-0 size-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8" />
                        <path d="m21 21-4.3-4.3" />
                    </svg>
                </div>
                <button type="button"
                    class="py-3 px-4 inline-flex justify-center items-center dark:shadow-md gap-x-2 text-sm font-semibold rounded-e-md border border-transparent bg-green-600 text-white hover:bg-green-700 shadow-md disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">Search</button>
            </div>
        </div>
        <!-- Grid -->
        <div class="grid sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 sm:gap-6">
            <button
                class="group flex flex-col @if ($acti == 18) bg-green-600 @else bg-white dark:bg-slate-800 @endif border shadow-sm rounded-xl hover:shadow-md transition dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                wire:click="updateMarket({{ 18 }})">
                <div class="p-4 md:p-5">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                src="{{ url('images/icon/manufacture.png') }}" alt="Image Description">
                            <div class="ms-3">
                                <h3
                                    class="@if ($acti == 18) text-white @else text-green-600 @endif group-hover:text-yellow-500 font-semibold text-gray-800 dark:group-hover:text-yellow-500 dark:text-gray-200">
                                    Manufacture
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </button>
            <button
                class="group flex flex-col @if ($acti == 19) bg-green-600 @else bg-white dark:bg-slate-800 @endif border shadow-sm rounded-xl hover:shadow-md transition dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                wire:click="updateMarket({{ 19 }})">
                <div class="p-4 md:p-5">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                src="{{ url('images/icon/tourism.png') }}" alt="Image Description">
                            <div class="ms-3">
                                <h3
                                    class="@if ($acti == 19) text-white @else text-green-600 @endif group-hover:text-yellow-500 font-semibold text-gray-800 dark:group-hover:text-yellow-500 dark:text-gray-200">
                                    Tourism
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </button>
            <button
                class="group flex flex-col @if ($acti == 20) bg-green-600 @else bg-white dark:bg-slate-800 @endif border shadow-sm rounded-xl hover:shadow-md transition dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                wire:click="updateMarket({{ 20 }})">
                <div class="p-4 md:p-5">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                src="{{ url('images/icon/infrastructure.png') }}" alt="Image Description">
                            <div class="ms-3">
                                <h3
                                    class="@if ($acti == 20) text-white @else text-green-600 @endif group-hover:text-yellow-500 font-semibold text-gray-800 dark:group-hover:text-yellow-500 dark:text-gray-200">
                                    Infrastructure
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </button>
            <button
                class="group flex flex-col @if ($acti == 21) bg-green-600 @else bg-white dark:bg-slate-800 @endif border shadow-sm rounded-xl hover:shadow-md transition dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                wire:click="updateMarket({{ 21 }})">
                <div class="p-4 md:p-5">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                src="{{ url('images/icon/agriculture.png') }}" alt="Image Description">
                            <div class="ms-3">
                                <h3
                                    class="@if ($acti == 21) text-white @else text-green-600 @endif group-hover:text-yellow-500 font-semibold text-gray-800 dark:group-hover:text-yellow-500 dark:text-gray-200">
                                    Agriculture
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </button>
            <button
                class="group flex flex-col @if ($acti == 22) bg-green-600 @else bg-white dark:bg-slate-800 @endif border shadow-sm rounded-xl hover:shadow-md transition dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                wire:click="updateMarket({{ 22 }})">
                <div class="p-4 md:p-5">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                src="{{ url('images/icon/properti.png') }}" alt="Image Description">
                            <div class="ms-3">
                                <h3
                                    class="@if ($acti == 22) text-white @else text-green-600 @endif group-hover:text-yellow-500 font-semibold text-gray-800 dark:group-hover:text-yellow-500 dark:text-gray-200">
                                    Property
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </button>
            <button
                class="group flex flex-col @if ($acti == 23) bg-green-600 @else bg-white dark:bg-slate-800 @endif border shadow-sm rounded-xl hover:shadow-md transition dark:border-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                wire:click="updateMarket({{ 23 }})">
                <div class="p-4 md:p-5">
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <img class="h-[2.375rem] w-[2.375rem] rounded-full"
                                src="{{ url('images/icon/energy.png') }}" alt="Image Description">
                            <div class="ms-3">
                                <h3
                                    class="@if ($acti == 23) text-white @else text-green-600 @endif group-hover:text-yellow-500 font-semibold text-gray-800 dark:group-hover:text-yellow-500 dark:text-gray-200">
                                    Energy
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </button>
        </div>
        <!-- End Grid -->
    </div>

    <section class="relative md:py-18 py-5">
        @isset($proyeks)
            {{-- container card --}}
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
                                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">{{ __('proyek.button_1', [], $locale) }}</a>
                                    <a href="{{ route('profil_kabkota', $proyek->kab_kota_id) }}"
                                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">{{ __('proyek.button_2', [], $locale) }}</a>
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
                <div class="pagination py-5 container">
                    <x-filament::pagination :paginator="$proyeks" />
                </div>
            @endisset
        </div>
    </section>
</div>
