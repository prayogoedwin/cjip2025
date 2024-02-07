<div>
    <!-- Card Blog -->
    <div class="container px-4 py-8 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Title -->
        <div class="max-w-2xl mx-auto text-center mb-5 lg:mb-14">
            <div
                class="container py-3 flex items-center text-2xl font-bold md:text-4xl md:leading-tight text-gray-800 before:flex-[1_1_0%] before:border-t before:border-gray-200 before:me-6 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:before:border-gray-600 dark:after:border-gray-600">
                {{ __('navbar.kawasans', [], $locale) }}</div>
        </div>
        <!-- End Title -->

        <!-- Grid -->
        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($kawasan_industris as $ki)
                <!-- Card -->
                <a class="group flex flex-col h-full border border-gray-200 hover:border-transparent hover:shadow-lg transition-all duration-300 rounded-xl p-5 dark:border-gray-700 dark:hover:border-transparent dark:hover:shadow-black/[.4] dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    href="#">
                    <div class="aspect-w-16 aspect-h-11">
                        <img class="w-full h-44 object-cover rounded-xl" src="{{ asset('storage/' . $ki->foto[0]) }}"
                            alt="Image Description">
                    </div>
                    <div class="my-6">
                        <h3
                            class="text-xl font-semibold hover:text-green-600 text-gray-800 dark:text-gray-300 dark:group-hover:text-green-600">
                            {{ Illuminate\Support\Str::limit(strip_tags($ki->getTranslations('nama', [$locale]) ? $ki->getTranslations('nama', [$locale])[$locale] : $ki->nama), 50, '...') }}
                        </h3>
                        <p class="mt-5 text-gray-600 dark:text-gray-400">
                            {{ Illuminate\Support\Str::limit(strip_tags($ki->getTranslations('perusahaan', [$locale]) ? $ki->getTranslations('perusahaan', [$locale])[$locale] : $ki->perusahaan), 200, '...') }}
                        </p>
                    </div>
                </a>
                <!-- End Card -->
            @endforeach
        </div>
        <!-- End Grid -->

        <!-- Card -->
        <div class="mt-12 text-center">
            <a class="py-3 px-4 inline-flex items-center gap-x-1 text-md font-medium rounded-full hover:text-yellow-500 border border-gray-200 bg-white text-green-600 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-green-600 dark:hover:text-yellow-500 dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                href="{{ route('kawasan') }}">
                {{ __('beranda.other_industrial_area', [], $locale) }}
                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="m9 18 6-6-6-6" />
                </svg>
            </a>
        </div>
        <!-- End Card -->
    </div>
    <!-- End Card Blog -->
</div>
