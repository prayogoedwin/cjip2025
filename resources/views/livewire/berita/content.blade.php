<div class="">
    <section id="featured" class="mx-3 md:mx-8">
        <div class="grid md:grid-cols-5 grid-rows-3 md:grid-rows-2 gap-8 container my-16">
            <div class="row-span-1 md:row-span-2 md:col-span-3 ">
                <a href="{{ route('detail_berita', $tagline[0]->getTranslations('slug', [$locale])[$locale]) }}">
                    <div style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url({{ asset('storage/' . $tagline[0]->image[0]) }}); background-size: cover;"
                        class="rounded-2xl h-full bg-cover bg-no-repeat object-cover bg-gradient-to-t">
                        <div class=" pt-72">
                            <div class="pt-5 mb-2 px-5 text-bold text-xl text-white font-bold hover:text-yellow-500">
                                {{ $tagline[0]->getTranslations('title', [$locale])[$locale] ? $tagline[0]->getTranslations('title', [$locale])[$locale] : $tagline[0]->title }}
                            </div>
                            <div class="pb-5 pl-5 text-bold text-md md:text-xl text-white font-light">
                                <ul
                                    class="gap-3 mb-2 pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center list-none text-slate-400 text-sm">
                                    <li class="flex items-center me-4 gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{-- Publish : --}}
                                        <span
                                            class="text-white">{{ date('d M Y', strtotime($tagline[0]->created_at)) }}</span>
                                    </li>

                                    <li class="flex items-center me-4 gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{-- View : --}}
                                        <span class="text-white">
                                            @if (!empty($tagline[0]->count))
                                                {{ $tagline[0]->count }}
                                            @else
                                                0
                                            @endif
                                        </span> <span class="text-white">{{ __('berita.viewed', [], $locale) }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="row-span-1 md:col-span-2">
                <a href="{{ route('detail_berita', $tagline[1]->getTranslations('slug', [$locale])[$locale]) }}">
                    @if (Storage::disk('public')->exists($tagline[1]->image[0]))
                        <div style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url({{ asset('storage/' . $tagline[1]->image[0]) }}); background-size: cover;"
                            class="rounded-2xl h-full bg-cover bg-no-repeat object-cover">
                        @else
                            <div style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url({{ url('images/default.png') }}); background-size: cover;"
                                class="rounded-2xl h-full bg-cover bg-no-repeat object-cover">
                    @endif
                    <div class="">
                        <div class="pt-5 mb-2 px-5 text-bold text-xl text-white font-bold hover:text-yellow-500">
                            {{ $tagline[1]->getTranslations('title', [$locale])[$locale] ? $tagline[1]->getTranslations('title', [$locale])[$locale] : $tagline[1]->title }}
                        </div>
                        {{-- <div class="pb-5 px-5 text-bold text-md text-white font-light">
                            Publish : {{ date('d M Y', strtotime($tagline[1]->created_at)) }}</div> --}}
                        <div class="pb-5 pl-5 text-bold text-md md:text-xl text-white font-light">
                            <ul
                                class="gap-3 mb-2 pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center list-none text-slate-400 text-sm">
                                <li class="flex items-center me-4 gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{-- Publish : --}}
                                    <span
                                        class="text-white">{{ date('d M Y', strtotime($tagline[1]->created_at)) }}</span>
                                </li>

                                <li class="flex items-center me-4 gap-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{-- View : --}}
                                    <span class="text-white">
                                        @if (!empty($tagline[1]->count))
                                            {{ $tagline[1]->count }}
                                        @else
                                            0
                                        @endif
                                    </span> <span class="text-white">{{ __('berita.viewed', [], $locale) }}</span>
                                </li>
                            </ul>
                            <ul class=""></ul>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <div class="row-span-1 md:col-span-2">
            <a href="{{ route('detail_berita', $tagline[2]->getTranslations('slug', [$locale])[$locale]) }}">
                @if (Storage::disk('public')->exists($tagline[2]->image[0]))
                    <div style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url({{ asset('storage/' . $tagline[2]->image[0]) }}); background-size: cover;"
                        class="rounded-2xl h-full bg-cover bg-no-repeat">
                    @else
                        <div style="background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),  url({{ url('images/default.png') }}); background-size: cover;"
                            class="rounded-2xl h-full bg-cover bg-no-repeat">
                @endif
                <div class="">
                    <div class="pt-5 mb-2 pl-5 text-bold text-xl text-white font-bold hover:text-yellow-500">
                        {{-- {{ $tagline[2]->title }} --}}
                        {{ $tagline[2]->getTranslations('title', [$locale])[$locale] ? $tagline[2]->getTranslations('title', [$locale])[$locale] : $tagline[2]->title }}
                    </div>
                    {{-- <div class="pb-5 pl-5 text-bold text-md text-white font-light">
                        Publish : {{ date('d M Y', strtotime($tagline[2]->created_at)) }}</div> --}}
                    <div class="pb-5 pl-5 text-bold text-md md:text-xl text-white font-light">
                        <ul
                            class="gap-3 mb-2 pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center list-none text-slate-400 text-sm">
                            <li class="flex items-center me-4 gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{-- Publish : --}}
                                <span class="text-white">{{ date('d M Y', strtotime($tagline[2]->created_at)) }}</span>
                            </li>

                            <li class="flex items-center me-4 gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-white">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{-- View : --}}
                                <span class="text-white">
                                    @if (!empty($tagline[2]->count))
                                        {{ $tagline[2]->count }}
                                    @else
                                        0
                                    @endif
                                </span> <span class="text-white">{{ __('berita.viewed', [], $locale) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </a>
        </div>
    </section>

    <div class="container">
        <div class="">
            <span class="font-bold text-4xl">{{ __('berita.content', [], $locale) }}</span>
            <div class="h-2 bg-yellow-500 w-full mx-auto mt-2"></div>
        </div>
    </div>

    <section class="relative md:py-18 py-10">
        @isset($beritas)
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-[30px]">
                    @foreach ($beritas as $berita)
                        <div class="blog relative rounded-md shadow-sm dark:shadow-gray-700 overflow-hidden">
                            <img src="{{ asset('storage/' . $berita->image[0]) }}" class="object-cover" alt=""
                                style="height: 230px; width: 100%;">

                            <div class="content p-6">
                                <div class="">
                                    <ul
                                        class="gap-3 mb-2 pb-2 border-b border-gray-300 dark:border-gray-800 flex items-center list-none text-slate-400 text-sm">
                                        {{-- <li class="flex items-center me-4 gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                            </svg>
                                            <span
                                                class="">Oleh Admin</span>
                                        </li> --}}
                                        <li class="flex items-center me-4 gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            {{-- Publish : --}}
                                            <span
                                                class="">{{ date('d M Y', strtotime($berita->created_at)) }}</span>
                                        </li>

                                        <li class="flex items-center me-4 gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{-- View : --}}
                                            <span class="">
                                                @if (!empty($berita->count))
                                                    {{ $berita->count }}
                                                @else
                                                    0
                                                @endif
                                            </span> {{ __('berita.viewed', [], $locale) }}
                                        </li>
                                    </ul>
                                </div>
                                <a href="{{ route('detail_berita', $berita->getTranslations('slug', [$locale])[$locale]) }}"
                                    class="title h5 text-xl font-semibold hover:text-green-600 transition duration-500 text-justify">{{ $berita->getTranslations('title', [$locale])[$locale] ? $berita->getTranslations('title', [$locale])[$locale] : $berita->title }}</a>
                                <p class="text-gray-500 mt-3 text-justify">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($berita->getTranslations('body', [$locale])[$locale] ? $berita->getTranslations('body', [$locale])[$locale] : $berita->body), 200, ' ...') }}
                                </p>

                                <div class="mt-4">
                                    <div class="flex flex-wrap pt-5">
                                        {{-- <div class="w-full md:w-1/3 text-sm font-medium text-gray-500">
                                            Publish : {{ date('d M Y', strtotime($berita->created_at)) }}
                                        </div> --}}
                                    </div>
                                    <a href="{{ route('detail_berita', $berita->getTranslations('slug', [$locale])[$locale]) }}"
                                        class="btn btn-link font-normal hover:text-green-600 after:bg-primary-600 transition duration-500">{{ __('beranda.read_more', [], $locale) }}<i
                                            class="uil uil-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="pagination py-5 container">
                <x-filament::pagination :paginator="$beritas" />
            </div>
        @endisset
    </section>

</div>
