<div>
    <!-- Card Section -->
    <div class="container px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
        <!-- Grid -->
        @isset($kabkota)
            <div class="grid sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-6">
                <!-- Card -->
                @foreach ($kabkota as $item)
                    <a class="flex flex-col group bg-white border shadow-sm rounded-xl overflow-hidden hover:shadow-lg transition dark:bg-slate-900 dark:border-gray-700 dark:shadow-slate-700/[.7]"
                        href="{{ route('profil_kabkota', $item->kab_kota_id) }}">
                        <div class="relative pt-[50%] sm:pt-[60%] lg:pt-[80%] rounded-t-xl overflow-hidden">
                            <img class="w-full h-full absolute top-0 start-0 object-cover group-hover:scale-105 transition-transform duration-500 ease-in-out rounded-t-xl"
                                src="{{ asset('storage/' . $item->foto) }}" alt="Image Description">
                        </div>
                        <div class="p-4 md:p-5">
                            <h3 class="text-lg font-bold text-gray-800 dark:text-white">
                                {{ $item->kabkota->nama }}
                            </h3>
                            <p class="mt-1 text-gray-500 dark:text-gray-400 text-justify">
                                {{ \Illuminate\Support\Str::limit(strip_tags($item->getTranslations('desc_profil', [$locale])[$locale] ? $item->getTranslations('desc_profil', [$locale])[$locale] : $item->desc_profil), 100, ' ...') }}
                            </p>
                        </div>
                    </a>
                @endforeach
                <!-- End Grid -->
            </div>
        @endisset
        <div class="pagination py-5 container">
            <x-filament::pagination :paginator="$kabkota" />
        </div>
        <!-- End Card Section -->
    </div>
