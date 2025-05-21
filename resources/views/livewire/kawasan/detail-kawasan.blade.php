@section('meta_kawasan')
    <title>
        {{ $kawasan->getTranslations('nama', [$locale]) ? $kawasan->getTranslations('nama', [$locale])[$locale] : $kawasan->nama }}
        - Central
        Java Investment Platform</title>

    <link rel="canonical" href="https://cjip.jatengprov.go.id/detail-kawasan-industri/{{ $kawasan->id }}" />
    <meta name="robots" content="index, follow" />

    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title"
        content="{{ $kawasan->getTranslations('nama', [$locale]) ? $kawasan->getTranslations('nama', [$locale])[$locale] : $kawasan->nama }}">
    <meta name="description"
        content=" {{ \Illuminate\Support\Str::limit(strip_tags($kawasan->getTranslations('kawasan', [$locale]) ? $kawasan->getTranslations('kawasan', [$locale])[$locale] : $kawasan->kawasan), 100, ' ...') }}">
    <meta property="og:url" content="https://cjip.jatengprov.go.id/detail-kawasan-industri/{{ $kawasan->id }}">
    <meta property="og:site_name" content="Central Java Investment Platform">
    <meta property="og:image" content="https://cjip.jatengprov.go.id/storage/{{ $kawasan->foto[0] }}">
    <meta property="og:width" content="512">
    <meta property="og:height" content="512">
    <meta property="article:publisher" content="https://www.facebook.com/dpmptspjateng">
    <meta property='article:published_time' content='{{ $kawasan->created_at }}' />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:image" content="http://cjip.jatengprov.go.id/storage/{{ $kawasan->foto[0] }}">
    <meta name="twitter:site" content="@investCJ">
@stop
<div>
    <div
        class="py-16 relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[50] before:transform before:-translate-x-1/2 dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')]">
        <div class="container mx-auto py-10">
            <div class="container text-center mx-auto pt-5">
                <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl md:text-5xl dark:text-white">
                    {{ $kawasan->getTranslations('nama', [$locale]) ? $kawasan->getTranslations('nama', [$locale])[$locale] : $kawasan->nama }}
                </h1>
            </div>

            <div class="mt-10 relative max-w-5xl mx-auto">
                <div
                    class="w-full object-cover h-96 sm:h-[480px] bg-[url('https://images.unsplash.com/photo-1606868306217-dbf5046868d2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1981&q=80')] bg-no-repeat bg-center bg-cover rounded-xl">
                    <img src="{{ asset('storage/' . $kawasan->foto[0]) }}"
                        class=" shadow-md rounded-lg w-full object-cover h-96 sm:h-[480px]" alt="">

                </div>
                <div
                    class="absolute bottom-12 -start-20 -z-[1] w-48 h-48 bg-gradient-to-b from-orange-500 to-white p-px rounded-lg dark:to-slate-900">
                    <div class="bg-white w-48 h-48 rounded-lg dark:bg-slate-900"></div>
                </div>
                <div
                    class="absolute -top-12 -end-20 -z-[1] w-48 h-48 bg-gradient-to-t from-blue-600 to-cyan-400 p-px rounded-full">
                    <div class="bg-white w-48 h-48 rounded-full dark:bg-slate-900"></div>
                </div>
            </div>
            <div class="mt-5">
                <h5 class="text-lg font-semibold mb-2">{{ __('kawasan.detail_profil_1', [], $locale) }} :</h5>
                <p class="text-lg text-gray-600 dark:text-gray-400">{!! $kawasan->getTranslations('kawasan', [$locale])
                    ? $kawasan->getTranslations('kawasan', [$locale])[$locale]
                    : $kawasan->kawasan !!}</p>
                <h5 class="text-lg font-semibold mb-2 mt-3">{{ __('kawasan.tab_1', [], $locale) }} :</h5>
                <p class="text-lg text-gray-600 dark:text-gray-400"> {!! $kawasan->getTranslations('perusahaan', [$locale])
                    ? $kawasan->getTranslations('perusahaan', [$locale])[$locale]
                    : $kawasan->perusahaan !!}</p>
            </div>
        </div>
        <div class="container">
            <nav class="flex  space-x-2 grid sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-5 gap-3" aria-label="Tabs"
                role="tablist">
                <button type="button"
                    class="hs-tab-active:bg-green-600 ring-1 ring-green-600 hs-tab-active:text-white hs-tab-active:hover:text-white hs-tab-active:dark:text-white py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm font-medium text-gray-500 hover:text-yellow-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-yellow-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 active"
                    id="fill-and-justify-item-1" data-hs-tab="#fill-and-justify-1" aria-controls="fill-and-justify-1"
                    role="tab">
                    {{ __('kawasan.tab_6', [], $locale) }}
                </button>
                <button type="button"
                    class="hs-tab-active:bg-green-600 ring-1 ring-green-500 hs-tab-active:text-white hs-tab-active:hover:text-white hs-tab-active:dark:text-white py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm font-medium text-gray-500 hover:text-yellow-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-yellow-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    id="fill-and-justify-item-2" data-hs-tab="#fill-and-justify-2" aria-controls="fill-and-justify-2"
                    role="tab">
                    {{ __('kawasan.tab_10', [], $locale) }}
                </button>
                <button type="button"
                    class="hs-tab-active:bg-green-600 ring-1 ring-green-500 hs-tab-active:text-white hs-tab-active:hover:text-white hs-tab-active:dark:text-white py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm font-medium text-gray-500 hover:text-yellow-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-yellow-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    id="fill-and-justify-item-3" data-hs-tab="#fill-and-justify-3" aria-controls="fill-and-justify-3"
                    role="tab">
                    {{ __('detailproyek.tabs_5', [], $locale) }}
                </button>
                <button type="button"
                    class="hs-tab-active:bg-green-600 ring-1 ring-green-500 hs-tab-active:text-white hs-tab-active:hover:text-white hs-tab-active:dark:text-white py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm font-medium text-gray-500 hover:text-yellow-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-yellow-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    id="fill-and-justify-item-4" data-hs-tab="#fill-and-justify-4" aria-controls="fill-and-justify-4"
                    role="tab">
                    Video
                </button>
                @if ($kawasan->url_website != '')
                    <a href="{{ $kawasan->url_website }}" type="button" target="blank"
                        class="hs-tab-active:bg-green-600 ring-1 ring-green-500 hs-tab-active:text-white hs-tab-active:hover:text-white hs-tab-active:dark:text-white py-3 px-2 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm font-medium text-gray-500 hover:text-yellow-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-yellow-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                        role="tab">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 21a9.004 9.004 0 0 0 8.716-6.747M12 21a9.004 9.004 0 0 1-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 0 1 7.843 4.582M12 3a8.997 8.997 0 0 0-7.843 4.582m15.686 0A11.953 11.953 0 0 1 12 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0 1 21 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0 1 12 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 0 1 3 12c0-1.605.42-3.113 1.157-4.418" />
                        </svg>
                        Website
                    </a>
                @endif
            </nav>

            <div class="mt-3">
                <div id="fill-and-justify-1" role="tabpanel" aria-labelledby="fill-and-justify-item-1">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div
                                    class="border rounded-lg shadow overflow-hidden dark:border-gray-700 dark:shadow-gray-900">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ __('kawasan.detail_industri_6', [], $locale) }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {!! $kawasan->getTranslations('jaringan_sda', [$locale])
                                                        ? $kawasan->getTranslations('jaringan_sda', [$locale])[$locale]
                                                        : $kawasan->jaringan_sda !!}</td>

                                            </tr>

                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ __('kawasan.detail_industri_7', [], $locale) }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {!! $kawasan->getTranslations('jaringan_energi_listrik', [$locale])
                                                        ? $kawasan->getTranslations('jaringan_energi_listrik', [$locale])[$locale]
                                                        : $kawasan->jaringan_energi_listrik !!}</td>
                                            </tr>

                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ __('kawasan.detail_industri_8', [], $locale) }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {!! $kawasan->getTranslations('jaringan_telekomunikasi', [$locale])
                                                        ? $kawasan->getTranslations('jaringan_telekomunikasi', [$locale])[$locale]
                                                        : $kawasan->jaringan_telekomunikasi !!}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="fill-and-justify-2" class="hidden" role="tabpanel"
                    aria-labelledby="fill-and-justify-item-2">
                    <div class="flex flex-col">
                        <div class="-m-1.5 overflow-x-auto">
                            <div class="p-1.5 min-w-full inline-block align-middle">
                                <div
                                    class="border rounded-lg shadow overflow-hidden dark:border-gray-700 dark:shadow-gray-900">
                                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                        <thead class="bg-gray-50 dark:bg-gray-700">
                                            <tr>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                                    {{ __('kawasan.detail_tenant_1', [], $locale) }}</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                                    {{ __('kawasan.detail_tenant_3', [], $locale) }}</th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase dark:text-gray-400">
                                                    {{ __('kawasan.detail_tenant_4', [], $locale) }}</th>

                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @isset($data)
                                                @foreach ($data as $tenant)
                                                    <tr>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                            {{ $tenant['nama'] }}</td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                            {{ $tenant['sektor'] }}</td>
                                                        <td
                                                            class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                                            {{ $tenant['negara'] }}</td>

                                                    </tr>
                                                @endforeach
                                            @endisset
                                            {{-- <x-filament::pagination :paginator="$data" /> --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="fill-and-justify-3" class="hidden" role="tabpanel"
                    aria-labelledby="fill-and-justify-item-3">
                    <div id="grid" class="md:flex w-full justify-center mx-auto mt-4">
                        @foreach ($kawasan->foto as $image)
                            <div class="lg:w-1/3 md:w-1/3 p-4 picture-item" data-groups='["branding"]'>
                                <div class="group relative block overflow-hidden rounded-md duration-700 ease-in-out">
                                    <div class="relative bg-green-600 overflow-hidden rounded-md">
                                        <a href="{{ asset('storage/' . $image) }}"
                                            class="lightbox duration-700 ease-in-out group-hover:p-[10px]"
                                            title="">
                                            <img src="{{ asset('storage/' . $image) }}" class="rounded-md"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="fill-and-justify-4" class="hidden" role="tabpanel"
                    aria-labelledby="fill-and-justify-item-4">
                    <div id="grid" class="md:flex w-full justify-center mx-auto mt-4">
                        <div class="flex justify-center rounded-lg shadow-lg"
                            style="overflow:hidden;position: relative;">
                            <iframe frameborder="0" scrolling="no" marginheight="0" marginwidth="0"width="1920"
                                height="600" type="text/html" src="{{ $kawasan->url_video }}"></iframe>
                            <div
                                style="position: absolute;bottom: 10px;left: 0;right: 0;margin-left: auto;margin-right: auto;color: #000;text-align: center;">
                                <div style="overflow: auto; position: absolute; height: 0pt; width: 0pt;">
                                    Generated by <a href="https://www.embedista.com/embed-youtube-video">Embed
                                        Youtube Video</a> online</div>
                            </div>
                            <style>
                                .newst {
                                    position: relative;
                                    text-align: right;
                                    height: 420px;
                                    width: 520px;
                                }

                                #gmap_canvas img {
                                    max-width: none !important;
                                    background: none !important
                                }
                            </style>
                        </div><br />
                        <div class="absolute bottom-2/4 translate-y-2/4 start-0 end-0 text-center">
                        </div>
                    </div>
                </div>
            </div>
       
        {{-- Tombol Share --}}
            <div class="flex flex-wrap items-center gap-2 mt-3 justify-center sm:justify-end">
                {{-- Label --}}
                <div class="w-full sm:w-auto text-center sm:text-left font-semibold">
                    <i class="uil uil-share mr-1"></i>Share:
                </div>

                {{-- Copy URL --}}
                <button onclick="copyToClipboard('{{ route('detail_kawasan', $kawasan->id) }}')"
                    class="bg-gray-500 text-white px-3 py-1 rounded text-sm hover:bg-gray-600">
                    <i class="uil uil-copy"></i>
                    Copy URL
                </button>

                {{-- Facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('detail_kawasan', $kawasan->id)) }}"
                    target="_blank" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                    <i class="uil uil-facebook-f align-middle w-10"></i>
                    Facebook
                </a>

                {{-- Twitter --}}
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('detail_kawasan', $kawasan->id)) }}&text={{ urlencode($kawasan->nama) }}"
                    target="_blank" class="bg-blue-400 text-white px-3 py-1 rounded text-sm hover:bg-blue-500">
                    <i class="uil uil-twitter"></i>
                    Twitter
                </a>

                {{-- WhatsApp --}}
                <a href="https://wa.me/?text={{ urlencode(route('detail_kawasan', $kawasan->id)) }}" target="_blank"
                    class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600">
                    <i class="uil uil-whatsapp"></i>
                    WhatsApp
                </a>
            </div>
             </div>
        </div>
    </div>
    <script>
        function copyToClipboard(text) {
            navigator.clipboard.writeText(text).then(function() {
                alert('URL berhasil disalin ke clipboard!');
            }, function(err) {
                alert('Gagal menyalin URL');
            });
        }
    </script>
</div>
