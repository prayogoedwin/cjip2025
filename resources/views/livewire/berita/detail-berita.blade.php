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
                                <div class="flex justify-end items-center gap-x-1.5">

                                    <div class="block h-3 border-e border-gray-300 mx-3 dark:border-gray-600"></div>
                                    <div class="hs-dropdown relative inline-flex">
                                        <button type="button" id="blog-article-share-dropdown"
                                            class="hs-dropdown-toggle flex items-center gap-x-2 text-sm text-gray-500 hover:text-gray-800 dark:text-gray-400 dark:hover:text-gray-200 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600">
                                            <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M4 12v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8" />
                                                <polyline points="16 6 12 2 8 6" />
                                                <line x1="12" x2="12" y1="2" y2="15" />
                                            </svg>
                                            Share
                                        </button>
                                        <div class="hs-dropdown-menu w-56 transition-[opacity,margin] duration hs-dropdown-open:opacity-100 opacity-0 hidden mb-1 z-10 bg-gray-900 shadow-md rounded-xl p-2 dark:bg-black"
                                            aria-labelledby="blog-article-share-dropdown">
                                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-gray-400"
                                                href="#">
                                                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                    <path
                                                        d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                                    <path
                                                        d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                                                </svg>
                                                Copy link
                                            </a>
                                            <div class="border-t border-gray-600 my-2"></div>
                                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-gray-400"
                                                href="#">
                                                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z" />
                                                </svg>
                                                Share on Twitter
                                            </a>
                                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-gray-400"
                                                href="#">
                                                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                                                </svg>
                                                Share on Facebook
                                            </a>
                                            <a class="flex items-center gap-x-3.5 py-2 px-3 rounded-lg text-sm text-gray-400 hover:bg-white/10 focus:outline-none focus:ring-2 focus:ring-gray-400"
                                                href="#">
                                                <svg class="flex-shrink-0 w-4 h-4" xmlns="http://www.w3.org/2000/svg"
                                                    width="16" height="16" fill="currentColor"
                                                    viewBox="0 0 16 16">
                                                    <path
                                                        d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                                                </svg>
                                                Share on LinkedIn
                                            </a>
                                        </div>
                                    </div>
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
                                            src="{{ asset('storage/' . $berita->image[0]) }}"
                                            alt="Image Description">
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
