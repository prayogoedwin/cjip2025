<div>
    <div class="py-5 lg:w-3/5 w-4/5 mx-auto mt-10">

        <form class="flex max-w-full" wire:submit.prevent="cariKawasans">
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
                    placeholder="{{ __('kawasan.search', [], $locale) }} ..." required />
            </div>
        </form>
    </div>
    <section class="relative md:py-18 py-5">
        @isset($kawasans)
            @if ($kawasans->isEmpty())
                <div class="lg:mx-20 md:mx-8 py-5 mb-5 px-2 flex justify-center mx-auto">
                    <p class="text-gray-500">{{ __('kawasan.notfound', [], $locale) }}</p>
                </div>
            @else
                {{-- container card --}}
                <div class="lg:mx-20 md:mx-8 py-5 px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-[30px]">
                        @foreach ($kawasans as $kawasan)
                            <div class="blog relative rounded-md shadow-sm dark:shadow-gray-700 overflow-hidden">
                                <img src="{{ asset('storage/' . $kawasan->foto[0]) }}" alt="" class="object-cover"
                                    style="height: 230px; width: 100%;">

                                <div class="content p-6">
                                    <a href="{{ route('detail_kawasan', $kawasan->id) }}"
                                        class="title h5 text-xl font-semibold hover:text-primary-600 transition duration-500 text-justify">{{ \Illuminate\Support\Str::limit(strip_tags($kawasan->getTranslations('nama', [$locale]) ? $kawasan->getTranslations('nama', [$locale])[$locale] : $kawasan->nama), 100, ' ...') }}</a>

                                    <p class="text-gray-500 mt-3 text-justify">
                                        {!! Illuminate\Support\Str::limit(
                                            strip_tags(
                                                $kawasan->getTranslations('perusahaan', [$locale])
                                                    ? $kawasan->getTranslations('perusahaan', [$locale])[$locale]
                                                    : $kawasan->perusahaan,
                                            ),
                                            200,
                                            ' ...',
                                        ) !!}</p>

                                    <div class="mt-4">
                                        <a href="{{ route('detail_kawasan', $kawasan->id) }}"
                                            class="btn btn-link font-normal hover:text-primary-600 after:bg-primary-600 transition duration-500">{{ __('read more', [], $locale) }}
                                            <i class="uil uil-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!--blog end-->
                            <!--end grid-->
                        @endforeach
                    </div>
                    <!--end container-->
                    <div class="pagination lg:mx-20 md:mx-8 py-5 mb-10 px-8">
                        {{ $kawasans->links() }}
                    </div>
                </div>
            @endif
        @endisset
        <!--end container-->
    </section>
</div>
