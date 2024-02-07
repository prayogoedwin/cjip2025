<div>
    <section class="relative md:py-8 py-4">
        <div class="container relative">
            <div class="max-w-2xl text-center mb-5 lg:mb-14 mx-auto">
                <div
                    class="container py-3 flex items-center text-2xl font-bold md:text-4xl md:leading-tight text-gray-800 before:flex-[1_1_0%] before:border-t before:border-gray-200 before:me-6 after:flex-[1_1_0%] after:border-t after:border-gray-200 after:ms-6 dark:text-white dark:before:border-gray-600 dark:after:border-gray-600">
                    {{ __('navbar.news', [], $locale) }}</div>

            </div>
            <div class="grid grid-cols-1 gap-[30px] relative mt-4">
                <div class="tiny-three-item-icon">
                    @foreach ($beritas as $berita)
                        <div class="tiny-slide">
                            <div
                                class="group m-3 relative rounded-md shadow hover:shadow-lg dark:shadow-gray-800 duration-500 ease-in-out overflow-hidden">
                                <div class="relative overflow-hidden">
                                    <img src="{{ asset('storage/' . $berita->image[0]) }}"
                                        class="group-hover:scale-110 duration-500 ease-in-out" alt="">
                                    <div
                                        class="absolute inset-0 bg-slate-900/50 opacity-0 group-hover:opacity-100 duration-500 ease-in-out">
                                    </div>
                                </div>

                                <div class="content p-6 relative">
                                    <a href="#"
                                        class="text-lg font-medium block hover:text-green-600 duration-500 ease-in-out mt-2">{{ $berita->getTranslations('title', [$locale]) ? $berita->getTranslations('title', [$locale])[$locale] : $berita->title }}</a>
                                    <p class="text-slate-400 mt-3 mb-4 text-justify">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($berita->getTranslations('body', [$locale]) ? $berita->getTranslations('body', [$locale])[$locale] : $berita->body), 200, ' ...') }}
                                    </p>

                                    <ul
                                        class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center list-none text-slate-400">
                                        <li class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{-- Publish : --}}
                                            <span
                                                class="text-md text-gray-500">{{ date('d M Y', strtotime($berita->created_at)) }}</span>
                                        </li>

                                        <li class="flex items-center gap-1 ml-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{-- View : --}}
                                            <span class=" text-md text-gray-500">
                                                @if (!empty($berita->count))
                                                    {{ $berita->count }}
                                                @else
                                                    0
                                                @endif
                                            </span> {{ __('berita.viewed', [], $locale) }}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 text-center">
                    <a class="py-3 px-4 inline-flex items-center gap-x-1 dark:hover:text-yellow-500 hover:text-yellow-500 text-md font-medium rounded-full border border-gray-200 bg-white text-green-600 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-green-600 dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        href="{{ route('berita') }}">
                        {{ __('berita.detail_more', [], $locale) }}
                        <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
