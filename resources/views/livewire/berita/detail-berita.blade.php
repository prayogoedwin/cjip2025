<div>
    @section('meta_berita')
        <title>
            {{ $berita->getTranslations('title', [$locale]) ? $berita->getTranslations('title', [$locale])[$locale] : $berita->title }}
            - Central
            Java Investment Platform</title>

        <link rel="canonical"
            href="https://cjip.jatengprov.go.id/berita/{{ $berita->getTranslations('slug', [$locale])[$locale] }}" />
        <meta name="robots" content="index, follow" />
        <meta name='keywords'
            content='{{ $berita->getTranslations('meta_keyword', [$locale]) ? $berita->getTranslations('meta_keyword', [$locale])[$locale] : $berita->meta_keyword }}' />
        <meta name="description"
            content="{{ $berita->getTranslations('meta_description', [$locale]) ? $berita->getTranslations('meta_description', [$locale])[$locale] : $berita->meta_description }}">
        <meta property="og:locale" content="en_US">
        <meta property="og:type" content="website">
        <meta property="og:title"
            content="{{ $berita->getTranslations('seo_title', [$locale]) ? $berita->getTranslations('title', [$locale])[$locale] : $berita->title }}">
        <meta property="og:description"
            content="{{ $berita->getTranslations('meta_description', [$locale]) ? $berita->getTranslations('meta_description', [$locale])[$locale] : $berita->meta_description }}">
        <meta property="og:url"
            content="https://cjip.jatengprov.go.id/berita/{{ $berita->getTranslations('slug', [$locale])[$locale] }}">
        <meta property="og:site_name" content="Central Java Investment Platform">
        <meta property="og:image" content="https://cjip.jatengprov.go.id/storage/{{ $berita->image[0] }}">
        <meta property="og:width" content="512">
        <meta property="og:height" content="512">
        <meta property="article:publisher" content="https://www.facebook.com/dpmptspjateng">
        <meta property='article:published_time' content='{{ $berita->created_at }}' />
        <meta name="twitter:card" content="summary">
        <meta name="twitter:title"
            content="{{ $berita->getTranslations('seo_title', [$locale]) ? $berita->getTranslations('seo_title', [$locale])[$locale] : $berita->seo_title }}">
        <meta name="twitter:description"
            content="{{ $berita->getTranslations('meta_description', [$locale]) ? $berita->getTranslations('meta_description', [$locale])[$locale] : $berita->meta_description }}">
        <meta name="twitter:image" content="http://cjip.jatengprov.go.id/storage/{{ $berita->image[0] }}">
        <meta name="twitter:site" content="@investCJ">
    @stop

    <div
        class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[50] before:transform before:-translate-x-1/2 dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')]">
        <div class="container py-24">
            <div class="grid lg:grid-cols-3 gap-y-8 lg:gap-y-0 lg:gap-x-6">
                <div class="lg:col-span-2">
                    <div class="py-8 lg:pe-8">
                        <div class="space-y-5 lg:space-y-8">
                            <h2 class="text-3xl font-bold lg:text-5xl dark:text-white">
                                {{ $berita->getTranslations('title', [$locale]) ? $berita->getTranslations('title', [$locale])[$locale] : $berita->title }}
                            </h2>
                            <div class="flex items-center gap-x-5">
                                <p
                                    class="text-xs sm:text-sm text-gray-800 dark:text-gray-800 bg-slate-50 py-1 px-2 rounded-full">
                                    @if (!empty($berita->count))
                                        {{ $berita->count }}
                                    @else
                                        0
                                    @endif
                                    <span>{{ __('berita.viewed', [], $locale) }}</span>
                                </p>
                                <p
                                    class="text-xs sm:text-sm text-gray-800 dark:text-gray-800 bg-slate-50 py-1 px-2 rounded-full">
                                    {{ date('d M Y', strtotime($berita->created_at)) }}</p>
                            </div>
                            <figure>
                                <div class="tiny-single-item">
                                    @foreach ($berita->image as $foto)
                                        <div class="tiny-slide"><img src="{{ asset('storage/' . $foto) }}"
                                                class="w-full rounded-md " alt=""></div>
                                    @endforeach
                                </div>
                            </figure>
                            <p class="text-lg text-gray-800 dark:text-gray-200"> {!! $berita->getTranslations('body', [$locale])
                                ? $berita->getTranslations('body', [$locale])[$locale]
                                : $berita->body !!}</p>
                            </p>
                            <div class="grid lg:flex lg:justify-between lg:items-center gap-y-5 lg:gap-y-0">
                                <div class="group flex items-center gap-x-6">
                                    <p
                                        class="text-sm font-bold text-gray-800 group-hover:text-blue-600 dark:text-gray-200 dark:group-hover:text-blue-500">
                                        {{ $berita->getTranslations('meta_keyword', [$locale]) ? $berita->getTranslations('meta_keyword', [$locale])[$locale] : $berita->meta_keyword }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Content -->

                <!-- Sidebar -->
                <div
                    class="lg:col-span-1 lg:w-full lg:h-full lg:bg-gradient-to-r lg:from-gray-50 lg:via-transparent lg:to-transparent dark:from-slate-800">
                    <div class="sticky top-0 start-0 py-8 lg:ps-8">
                        <!-- Avatar Media -->
                        <div
                            class="group flex items-center gap-x-3 border-b border-gray-200 pb-8 mb-8 dark:border-gray-700">
                            <h3 class="text-lg font-semibold">{{ __('berita.detail_more', [], $locale) }}</h3>
                        </div>
                        <!-- End Avatar Media -->

                        <div class="space-y-6">
                            <!-- Media -->
                            @foreach ($beritas as $berita)
                                <a class="group flex items-center gap-x-6"
                                    href="{{ route('detail_berita', $berita->getTranslations('slug', [$locale])[$locale]) }}">
                                    <div class="grow">
                                        <span
                                            class="text-sm font-bold text-gray-800 group-hover:text-green-600 dark:text-gray-200 dark:group-hover:text-blue-500">
                                            {{ $berita->getTranslations('title', [$locale]) ? $berita->getTranslations('title', [$locale])[$locale] : $berita->title }}
                                        </span>
                                        <ul
                                            class="gap-3 pt-2 mb-2 pb-2 border-b border-gray-300 dark:border-gray-800 flex items-center list-none text-slate-400 text-sm">
                                            <li class="flex items-center me-4 gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 h-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                {{-- Publish : --}}
                                                <span
                                                    class="">{{ date('d M Y', strtotime($berita->created_at)) }}</span>
                                            </li>

                                            <li class="flex items-center me-4 gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-4 h-4">
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


                                    <div class="flex-shrink-0 relative rounded-lg overflow-hidden w-20 h-20">
                                        <img class="w-full h-full absolute top-0 start-0 object-cover rounded-lg"
                                            src="{{ asset('storage/' . $berita->image[0]) }}" alt="Image Description">
                                    </div>
                                </a>
                                <!-- End Media -->
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- End Sidebar -->
            </div>
        </div>
        <!-- End Blog Article -->
    </div>
</div>
