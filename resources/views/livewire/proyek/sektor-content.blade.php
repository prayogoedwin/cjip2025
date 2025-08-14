<div>
    <div class="container py-10 lg:py-14 mx-auto">
        <div class="py-5 lg:w-3/5 w-4/5 mx-auto">
            <form class="flex max-w-full" wire:submit.prevent="cariProyeks">
                <label for="simple-search" class="sr-only">Search</label>
                <div class="relative w-full">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <!-- Search Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mt-1 ml-1 text-gray-400"
                            viewBox="0 0 20 20" fill="currentColor">
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
            @if ($proyeks->isEmpty())
                <div class="lg:mx-20 md:mx-8 py-5 mb-5 px-2 flex justify-center mx-auto">
                    <p class="text-gray-500">{{ __('proyek.notfound', [], $locale) }}</p>
                </div>
            @else
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

                                        <a href="{{ route('detail_proyek_investasi', $proyek->getTranslation('slug', $locale) ?? $proyek->slug) }}"
                                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">{{ __('proyek.button_1', [], $locale) }}</a>
                                        <a href="{{ route('profil_kabkota', $proyek->kab_kota_id) }}"
                                            class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">{{ __('proyek.button_2', [], $locale) }}</a>
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
                                    <a href="{{ route('detail_proyek_investasi', $proyek->getTranslation('slug', $locale) ?? $proyek->slug) }}"
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
            @endif
        @endisset
    </section>
</div>

</div>
