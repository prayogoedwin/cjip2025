<div>
    <!-- Start Hero -->
    <section class="relative table w-full py-6 lg:py-8">
        <div class="container relative">
            <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
                <div class="md:col-span-6">
                    <div class="md:me-6 text-lg text-justify">
                        <h4 class="font-bold lg:leading-normal text-start leading-normal text-4xl lg:text-5xl mb-5">
                            @if ($locale == 'id')
                                {{ $profil->sdm_title }}
                            @else
                                {{ $profil->sdm_title_en }}
                            @endif
                        </h4>
                        <p class="text-slate-400 text-lg max-w-xl">
                            @if ($locale == 'id')
                                {!! $profil->sdm_desc !!}
                            @else
                                {!! $profil->sdm_desc_en !!}
                            @endif
                        </p>
                    </div>
                </div><!--end col-->

                <div class="md:col-span-6">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <div class="col-span-5">
                            <div class="grid grid-cols-1 gap-4">
                                <img src="assets/images/digital/02.jpg" class="shadow rounded-lg" alt="">

                                <div class="ms-auto">
                                    <div class="w-28 h-28 bg-indigo-600/10 rounded-lg"></div>
                                </div>
                            </div>
                        </div>

                        <div class="col-span-7">
                            <div class="grid grid-cols-1 gap-4">
                                <img src="assets/images/digital/01.jpg" class="shadow rounded-lg" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Start Section-->
    <section class="relative md:py-8 py-6">
        <div class="container relative md:mt-6 mt-4">
            <div class="grid md:grid-cols-12 grid-cols-1 items-center gap-[30px]">
                <div class="md:col-span-6">
                    <div class="lg:me-8">
                        <img src="assets/images/shape-image.png" alt="">
                    </div>
                </div>

                <div class="md:col-span-6">
                    <div class="lg:ms-5 text-lg text-justify">
                        <h3 class="font-bold lg:leading-normal leading-normal text-4xl lg:text-5xl mb-5">
                            @if ($locale == 'id')
                                {{ $profil->biaya_title }}
                            @else
                                {{ $profil->biaya_title_en }}
                            @endif
                        </h3>

                        <p class="text-slate-400 max-w-xl mb-6">
                            @if ($locale == 'id')
                                {!! $profil->biaya_desc !!}
                            @else
                                {!! $profil->biaya_desc_en !!}
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div><!--end container-->

        <div class="container mt-2">
            <nav class="relative z-0 flex border rounded-xl overflow-hidden dark:border-gray-700" aria-label="Tabs"
                role="tablist">
                <button type="button"
                    class="hs-tab-active:border-b-green-500 hs-tab-active:text-gray-900 dark:hs-tab-active:text-white dark:hs-tab-active:border-b-green-500 relative min-w-0 flex-1 bg-white first:border-s-0 border-s border-b-2 py-4 px-4 text-gray-500 hover:text-gray-700 text-lg font-medium text-center overflow-hidden hover:bg-gray-50 focus:z-10 focus:outline-none focus:text-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-l-gray-700 dark:border-b-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-400 active"
                    id="bar-with-underline-item-1" data-hs-tab="#bar-with-underline-1"
                    aria-controls="bar-with-underline-1" role="tab">
                    {{ __('profil.listrik_title', [], $locale) }}
                </button>
                <button type="button"
                    class="hs-tab-active:border-b-green-600 hs-tab-active:text-gray-900 dark:hs-tab-active:text-white dark:hs-tab-active:border-b-green-500 relative min-w-0 flex-1 bg-white first:border-s-0 border-s border-b-2 py-4 px-4 text-gray-500 hover:text-gray-700 text-lg font-medium text-center overflow-hidden hover:bg-gray-50 focus:z-10 focus:outline-none focus:text-green-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-gray-800 dark:border-l-gray-700 dark:border-b-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-400"
                    id="bar-with-underline-item-2" data-hs-tab="#bar-with-underline-2"
                    aria-controls="bar-with-underline-2" role="tab">
                    {{ __('profil.water_title', [], $locale) }}
                    (IDR/m3)
                </button>
            </nav>

            <div class="mt-3">
                <div id="bar-with-underline-1" role="tabpanel" aria-labelledby="bar-with-underline-item-1">
                    <p class="text-gray-500 dark:text-gray-400">
                        @livewire('profil.table.listrik')
                    </p>
                </div>
                <div id="bar-with-underline-2" class="hidden" role="tabpanel"
                    aria-labelledby="bar-with-underline-item-2">
                    <p class="text-gray-500 dark:text-gray-400">
                        @livewire('profil.table.air')

                    </p>
                </div>
            </div>
        </div>
    </section><!--end section-->

    @livewire('profil.profil-kabkota')
    <!-- End Section-->
</div>
