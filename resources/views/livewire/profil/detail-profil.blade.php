<div>
    <div
        class="py-16 relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[50] before:transform before:-translate-x-1/2 dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')]">
        <div class="container mx-auto py-10">
            <div class="max-w-2xl text-center mx-auto pt-5">
                <h1 class="block text-3xl font-bold text-gray-800 sm:text-4xl md:text-5xl dark:text-white">
                    {{ $profil->getTranslations('profil', [$locale]) ? $profil->getTranslations('profil', [$locale])[$locale] : $profil->profil }}
                </h1>

            </div>

            <div class="mt-10 relative max-w-5xl mx-auto">
                <div
                    class="w-full object-cover h-96 sm:h-[480px] bg-[url('https://images.unsplash.com/photo-1606868306217-dbf5046868d2?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1981&q=80')] bg-no-repeat bg-center bg-cover rounded-xl">
                    <img src="{{ asset('storage/' . $profil->foto) }}"
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
                <p class="text-lg text-gray-600 dark:text-gray-400">{!! $profil->getTranslations('desc_profil', [$locale])
                    ? $profil->getTranslations('desc_profil', [$locale])[$locale]
                    : $profil->desc_profil !!}</p>
            </div>
        </div>
        <div class="container mb-10">
            <div class="flex flex-col">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="border rounded-lg shadow overflow-hidden dark:border-gray-700 dark:shadow-gray-900">
                            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                <ul style="list-style-type: disc">
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                        @isset($profil->luas)
                                            <tr class="py-1">
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200" width="40%">
                                                    <li class="font-semibold">
                                                        {{ __('detailprofil.large', [], $locale) }}</li>
                                                </td>
                                                <td class="">:</td>
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200 ">
                                                    {{ $profil->getTranslations('luas', [$locale]) ? $profil->getTranslations('luas', [$locale])[$locale] : $profil->luas }}
                                                </td>
                                            </tr>
                                        @endisset

                                        @isset($profil->jarak_ke_smg)
                                            <tr class="py-1">
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200 ">
                                                    <li class="font-semibold">
                                                        {{ __('detailprofil.distance', [], $locale) }}</li>
                                                </td>
                                                <td class="">:</td>
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $profil->getTranslations('jarak_ke_smg', [$locale]) ? $profil->getTranslations('jarak_ke_smg', [$locale])[$locale] : $profil->jarak_ke_smg }}
                                                </td>
                                            </tr>
                                        @endisset

                                        @isset($profil->rtrw)
                                            <tr class="py-1">
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    <li class="font-semibold">{{ __('detailprofil.rtrw', [], $locale) }}
                                                    </li>
                                                </td>
                                                <td class="">:</td>
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $profil->getTranslations('rtrw', [$locale]) ? $profil->getTranslations('rtrw', [$locale])[$locale] : $profil->rtrw }}
                                                </td>
                                            </tr>
                                        @endisset

                                        @isset($profil->pert_ekonomi)
                                            <tr class="py-1">
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    <li class="font-semibold">
                                                        {{ __('detailprofil.economic_growth', [], $locale) }}
                                                    </li>
                                                </td>
                                                <td class="">:</td>
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $profil->getTranslations('pert_ekonomi', [$locale]) ? $profil->getTranslations('pert_ekonomi', [$locale])[$locale] : $profil->pert_ekonomi }}
                                                </td>
                                            </tr>
                                        @endisset

                                        @isset($profil->inflasi)
                                            <tr class="py-1">
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    <li class="font-semibold">
                                                        {{ __('detailprofil.inflation_rate', [], $locale) }}
                                                    </li>
                                                </td>
                                                <td class="">:</td>
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $profil->getTranslations('inflasi', [$locale]) ? $profil->getTranslations('inflasi', [$locale])[$locale] : $profil->inflasi }}
                                                </td>
                                            </tr>
                                        @endisset

                                        @isset($profil->populasi)
                                            <tr class="py-1">
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    <li class="font-semibold">
                                                        {{ __('detailprofil.total_population', [], $locale) }}
                                                    </li>
                                                </td>
                                                <td class="">:</td>
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $profil->getTranslations('populasi', [$locale]) ? $profil->getTranslations('populasi', [$locale])[$locale] : $profil->populasi }}
                                                </td>
                                            </tr>
                                        @endisset

                                        @isset($profil->angk_kerja)
                                            <tr class="py-1">
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    <li class="font-semibold">
                                                        {{ __('detailprofil.work_rate', [], $locale) }}
                                                    </li>
                                                </td>
                                                <td class="">:</td>
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $profil->getTranslations('angk_kerja', [$locale]) ? $profil->getTranslations('angk_kerja', [$locale])[$locale] : $profil->angk_kerja }}
                                                </td>
                                            </tr>
                                        @endisset

                                        @isset($profil->umr)
                                            <tr class="py-1">
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    <li class="font-semibold">{{ __('detailprofil.umk', [], $locale) }}
                                                    </li>
                                                </td>
                                                <td class="">:</td>
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $profil->getTranslations('umr', [$locale]) ? $profil->getTranslations('umr', [$locale])[$locale] : $profil->umr }}
                                                </td>
                                            </tr>
                                        @endisset

                                        @isset($profil->komp_usia)
                                            <tr class="py-1">
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    <li class="font-semibold">
                                                        {{ __('detailprofil.age_composition', [], $locale) }}
                                                    </li>
                                                </td>
                                                <td class="">:</td>
                                                <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                    {{ $profil->getTranslations('komp_usia', [$locale]) ? $profil->getTranslations('komp_usia', [$locale])[$locale] : $profil->komp_usia }}
                                                </td>
                                            </tr>
                                        @endisset

                                        <tr class="py-1">
                                            <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                <li class="font-semibold">
                                                    {{ __('detailprofil.infrastructure', [], $locale) }}
                                                </li>
                                            </td>
                                            <td class="">:</td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                                {{-- @isset($profil->infrasturktur) --}}
                                                <ul style="list-style-type: circle;" class="ml-3">
                                                    @foreach ($profil->infrastruktur as $infrastrukturs)
                                                        <li class="text-gray-600">
                                                            {{ $infrastrukturs['infrastruktur'] }}</li>
                                                    @endforeach
                                                </ul>
                                                {{-- @endisset --}}
                                            </td>
                                        </tr>
                                    </tbody>
                                </ul>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @isset($proyeks)
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

                                    <a href="{{ route('detail_investasi', $proyek->id) }}"
                                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-green-700 text-white rounded-md">{{ __('proyek.button_1', [], $locale) }}</a>

                                </div>
                            </div>
                            <div class="p-6">
                                <div class="block max-w-md mb-3">
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
                                </div>
                                <a href="{{ route('detail_investasi', $proyek->id) }}"
                                    class="hover:text-green-600 text-lg font-semibold">{{ \Illuminate\Support\Str::limit(strip_tags($proyek->getTranslations('nama', [$locale]) ? $proyek->getTranslations('nama', [$locale])[$locale] : $proyek->nama), 100, ' ...') }}</a>
                                <p class="text-slate-400 mt-2 text-justify">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($proyek->getTranslations('latar_belakang', [$locale]) ? $proyek->getTranslations('latar_belakang', [$locale])[$locale] : $proyek->latar_belakang), 200, ' ...') }}
                                </p>
                            </div>
                        </div><!--end content-->
                    @endforeach
                </div>
            </div>
        @endisset
    </div>
</div>
