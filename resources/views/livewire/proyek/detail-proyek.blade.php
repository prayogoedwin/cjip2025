@section('meta_investasi')
    <title>
        {{ $proyek->getTranslations('nama', [$locale]) ? $proyek->getTranslations('nama', [$locale])[$locale] : $proyek->nama }}
        - Central
        Java Investment Platform</title>

    <link rel="canonical" href="https://cjip.jatengprov.go.id/peluang-investasi/{{ $proyek->id }}" />
    <meta name="robots" content="index, follow" />

    <meta property="og:locale" content="en_US">
    <meta property="og:type" content="website">
    <meta property="og:title"
        content="{{ $proyek->getTranslations('nama', [$locale]) ? $proyek->getTranslations('nama', [$locale])[$locale] : $proyek->nama }}">
    <meta name="description"
        content=" {{ \Illuminate\Support\Str::limit(strip_tags($proyek->getTranslations('latar_belakang', [$locale]) ? $proyek->getTranslations('latar_belakang', [$locale])[$locale] : $proyek->latar_belakang), 100, ' ...') }}">
    <meta property="og:url" content="https://cjip.jatengprov.go.id/peluang-investasi/{{ $proyek->id }}">
    <meta property="og:site_name" content="Central Java Investment Platform">
    <meta property="og:image" content="https://cjip.jatengprov.go.id/storage/{{ $proyek->foto[0] }}">
    <meta property="og:width" content="512">
    <meta property="og:height" content="512">
    <meta property="article:publisher" content="https://www.facebook.com/dpmptspjateng">
    <meta property='article:published_time' content='{{ $proyek->created_at }}' />
    <meta name="twitter:card" content="summary">
    <meta name="twitter:image" content="http://cjip.jatengprov.go.id/storage/{{ $proyek->foto[0] }}">
    <meta name="twitter:site" content="@investCJ">
@stop
<div>
    <!-- Hero -->
    <div
        class="py-16 relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[50] before:transform before:-translate-x-1/2 dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')]">
        <div class="container mx-auto py-10">
            <div class="max-w-2xl text-center mx-auto pt-5">
                <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl md:text-5xl dark:text-white">
                    {{ $proyek->getTranslations('nama', [$locale]) ? $proyek->getTranslations('nama', [$locale])[$locale] : $proyek->nama }}
                </h1>
                <h6 class="font-semibold text-md mt-3">
                    @if ($proyek->market->id == 1)
                        <p class="rounded-xl font-bold" style="color: #1DB053;">
                            {{ __('detailproyek.tab_1', [], $locale) }}</p>
                    @elseif($proyek->market->id == 2)
                        <p class="rounded-xl font-bold" style="color: #498DBF;">
                            {{ __('detailproyek.tab_2', [], $locale) }}</p>
                    @elseif($proyek->market->id == 3)
                        <p class="rounded-xl font-bold" style="color: #FE1010;">
                            {{ __('detailproyek.tab_3', [], $locale) }}</p>
                    @elseif($proyek->market->id == 4)
                        <p class="rounded-xl font-bold" style="color: #FF6C00;">
                            {{ __('proyek.tab_4', [], $locale) }}</p>
                    @endif
                </h6>
            </div>

            <div class="mt-10 relative max-w-5xl mx-auto">
                <div
                    class="w-full object-cover h-96 sm:h-[480px] bg-[url('https://images.unsplash.com/photo-1606868306217-dbf5046868d2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1981&q=80')] bg-no-repeat bg-center bg-cover rounded-xl">
                    <img src="{{ asset('storage/' . $proyek->foto[0]) }}"
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
            <div class="mt-5 container">
                <h5 class="text-lg font-semibold mb-2">{{ __('detailproyek.tabs_4', [], $locale) }} :</h5>
                <p class="text-lg text-gray-600 dark:text-gray-400">{!! $proyek->getTranslations('latar_belakang', [$locale])
                    ? $proyek->getTranslations('latar_belakang', [$locale])[$locale]
                    : $proyek->latar_belakang !!}</p>
            </div>
        </div>
        <div class="container">
            <nav class="flex space-x-2" aria-label="Tabs" role="tablist">
                <button type="button"
                    class="hs-tab-active:bg-green-600 ring-1 ring-green-600 hs-tab-active:text-white hs-tab-active:hover:text-white hs-tab-active:dark:text-white py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm font-medium text-gray-500 hover:text-yellow-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-yellow-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 active"
                    id="fill-and-justify-item-1" data-hs-tab="#fill-and-justify-1" aria-controls="fill-and-justify-1"
                    role="tab">
                    {{ __('detailproyek.tabs_1', [], $locale) }}
                </button>
                <button type="button"
                    class="hs-tab-active:bg-green-600 ring-1 ring-green-500 hs-tab-active:text-white hs-tab-active:hover:text-white hs-tab-active:dark:text-white py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm font-medium text-gray-500 hover:text-yellow-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-yellow-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    id="fill-and-justify-item-2" data-hs-tab="#fill-and-justify-2" aria-controls="fill-and-justify-2"
                    role="tab">
                    {{ __('detailproyek.tabs_2', [], $locale) }}
                </button>
                <button type="button"
                    class="hs-tab-active:bg-green-600 ring-1 ring-green-500 hs-tab-active:text-white hs-tab-active:hover:text-white hs-tab-active:dark:text-white py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm font-medium text-gray-500 hover:text-yellow-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-yellow-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    id="fill-and-justify-item-3" data-hs-tab="#fill-and-justify-3" aria-controls="fill-and-justify-3"
                    role="tab">
                    {{ __('detailproyek.tabs_3', [], $locale) }}
                </button>
                <button type="button"
                    class="hs-tab-active:bg-green-600 ring-1 ring-green-500 hs-tab-active:text-white hs-tab-active:hover:text-white hs-tab-active:dark:text-white py-3 px-4 text-center flex-auto inline-flex justify-center items-center gap-x-2 bg-transparent text-sm font-medium text-gray-500 hover:text-yellow-500 rounded-lg disabled:opacity-50 disabled:pointer-events-none dark:text-gray-400 dark:hover:text-yellow-500 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600"
                    id="fill-and-justify-item-4" data-hs-tab="#fill-and-justify-4" aria-controls="fill-and-justify-4"
                    role="tab">
                    {{ __('detailproyek.tabs_5', [], $locale) }}
                </button>
            </nav>

            <div class="mt-3">
                <div id="fill-and-justify-1" role="tabpanel" aria-labelledby="fill-and-justify-item-1">
                    <!-- List Group -->
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
                                                    {{ __('detailproyek.summary1', [], $locale) }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $proyek->getTranslations('nilai_investasi', [$locale]) ? $proyek->getTranslations('nilai_investasi', [$locale])[$locale] : $proyek->nilai_investasi }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ __('detailproyek.summary4', [], $locale) }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {!! $proyek->getTranslations('skema_investasi', [$locale])
                                                        ? $proyek->getTranslations('skema_investasi', [$locale])[$locale]
                                                        : $proyek->skema_investasi !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ __('detailproyek.tb_2', [], $locale) }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {!! $proyek->getTranslations('eksisting', [$locale])
                                                        ? $proyek->getTranslations('eksisting', [$locale])[$locale]
                                                        : $proyek->eksisting !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ __('detailproyek.tb_3', [], $locale) }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {!! $proyek->getTranslations('lingkup_pekerjaan', [$locale])
                                                        ? $proyek->getTranslations('lingkup_pekerjaan', [$locale])[$locale]
                                                        : $proyek->lingkup_pekerjaan !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ __('detailproyek.tb_5', [], $locale) }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {!! $proyek->getTranslations('ketersediaan_pasar', [$locale])
                                                        ? $proyek->getTranslations('ketersediaan_pasar', [$locale])[$locale]
                                                        : $proyek->ketersediaan_pasar !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ __('detailproyek.summary2', [], $locale) }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {!! $proyek->getTranslations('luas_lahan', [$locale])
                                                        ? $proyek->getTranslations('luas_lahan', [$locale])[$locale]
                                                        : $proyek->luas_lahan !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ __('detailproyek.summary6', [], $locale) }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {!! $proyek->getTranslations('sumber_air', [$locale])
                                                        ? $proyek->getTranslations('sumber_air', [$locale])[$locale]
                                                        : $proyek->sumber_air !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ __('detailproyek.summary7', [], $locale) }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {!! $proyek->getTranslations('kelistrikan', [$locale])
                                                        ? $proyek->getTranslations('kelistrikan', [$locale])[$locale]
                                                        : $proyek->kelistrikan !!}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ __('detailproyek.summary8', [], $locale) }}</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {!! $proyek->getTranslations('telekomunikasi', [$locale])
                                                        ? $proyek->getTranslations('telekomunikasi', [$locale])[$locale]
                                                        : $proyek->telekomunikasi !!}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End List Group -->
                </div>
                <div id="fill-and-justify-2" class="hidden" role="tabpanel"
                    aria-labelledby="fill-and-justify-item-2">
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
                                                    Npv</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $proyek->getTranslations('npv', [$locale]) ? $proyek->getTranslations('npv', [$locale])[$locale] : $proyek->npv }}
                                                </td>

                                            </tr>
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    Irr</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $proyek->irr }}</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    Bc Ratio</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $proyek->bc_ratio }}</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    Payback Period</td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                </td>
                                                <td
                                                    class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                    {{ $proyek->getTranslations('playback_period', [$locale]) ? $proyek->getTranslations('playback_period', [$locale])[$locale] : $proyek->playback_period }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="fill-and-justify-3" class="hidden" role="tabpanel"
                    aria-labelledby="fill-and-justify-item-3">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div
                                class="border rounded-lg shadow overflow-hidden dark:border-gray-700 dark:shadow-gray-900">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                {{ __('detailproyek.contact1', [], $locale) }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                {{ $proyek->cp_nama }}
                                            </td>

                                        </tr>
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                {{ __('detailproyek.contact2', [], $locale) }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                {{ $proyek->kabkota->nama }}</td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                {{ __('detailproyek.contact3', [], $locale) }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                {{ $proyek->cp_alamat }}</td>
                                        </tr>
                                        <tr>
                                            <td
                                                class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                {{ __('detailproyek.contact4', [], $locale) }}</td>
                                            <td
                                                class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-wrap text-sm text-gray-800 dark:text-gray-200">
                                                {{ $proyek->cp_hp }} /
                                                {{ $proyek->cp_email }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="fill-and-justify-4" class="hidden" role="tabpanel"
                    aria-labelledby="fill-and-justify-item-4">
                    <div class="relative">
                        <div id="grid" class="md:flex w-full justify-center mx-auto mt-4">
                            @foreach ($proyek->foto as $image)
                                <div class="lg:w-1/3 md:w-1/3 p-4 picture-item" data-groups='["branding"]'>
                                    <div
                                        class="group relative block overflow-hidden rounded-md duration-700 ease-in-out">
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
                </div>
            </div>
            {{-- Tombol Share --}}
            <div class="flex flex-wrap items-center gap-2 mt-3 justify-center sm:justify-end">
                {{-- Label --}}
                <div class="w-full sm:w-auto text-center sm:text-left font-semibold">
                    <i class="uil uil-share mr-1"></i>Share:
                </div>

                {{-- Copy URL --}}
                <button onclick="copyToClipboard('{{ route('detail_investasi', $proyek->id) }}')"
                    class="bg-gray-500 text-white px-3 py-1 rounded text-sm hover:bg-gray-600">
                    Copy URL
                </button>

                {{-- Facebook --}}
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('detail_investasi', $proyek->id)) }}"
                    target="_blank" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                    <i class="uil uil-facebook-f align-middle w-10"></i>
                    Facebook
                </a>

                {{-- Twitter --}}
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('detail_investasi', $proyek->id)) }}&text={{ urlencode($proyek->nama) }}"
                    target="_blank" class="bg-blue-400 text-white px-3 py-1 rounded text-sm hover:bg-blue-500">
                    <i class="uil uil-twitter"></i>
                    Twitter
                </a>

                {{-- WhatsApp --}}
                <a href="https://wa.me/?text={{ urlencode(route('detail_investasi', $proyek->id)) }}" target="_blank"
                    class="bg-green-500 text-white px-3 py-1 rounded text-sm hover:bg-green-600">
                    <i class="uil uil-whatsapp"></i>
                    WhatsApp
                </a>
            </div>

        </div>

    </div>
    <!-- End Hero -->
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
