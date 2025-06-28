<div>
    <section class="relative md:py-18 py-15 mt-10">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] mt-5">
                @isset($faqs)
                    @foreach ($faqs as $key => $faq)
                        <div class="lg:col-span-12 md:col-span-12">
                            <div id="#{{ $loop->iteration }}">
                                <h5 class="text-2xl font-semibold">
                                    {{ \App\Models\Cjip\JenisFaq::find($key)->getTranslations('nama', [$locale]) ? \App\Models\Cjip\JenisFaq::find($key)->getTranslations('nama', [$locale])[$locale] : \App\Models\General\JenisFaq::find($key)->nama }}
                                </h5>
                                <div id="accordion-collapseone" data-accordion="collapse" class="mt-6">
                                    @foreach ($faq as $fa)
                                        <div
                                            class="relative shadow dark:shadow-gray-700 rounded-md overflow-hidden mt-4 hover:shadow-md">
                                            <h2 class="text-base font-semibold" id="accordion-collapse-heading-2">
                                                <button type="button"
                                                    class="flex justify-between items-center p-5 w-full font-medium text-left"
                                                    data-accordion-target="#ac{{ $fa->id }}" aria-expanded="false"
                                                    aria-controls="ac{{ $fa->id }}">
                                                    <span class="active:text-green-600 hover:text-green-600 text-black dark:text-white">{{ $fa->getTranslations('question', [$locale]) ? $fa->getTranslations('question', [$locale])[$locale] : $fa->question }}</span>
                                                    <svg data-accordion-icon class="w-4 h-4 shrink-0" fill="currentColor"
                                                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd"
                                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                            clip-rule="evenodd"></path>
                                                    </svg>
                                                </button>
                                            </h2>
                                            <div id="ac{{ $fa->id }}" class="hidden"
                                                aria-labelledby="#ac{{ $fa->id }}">
                                                <div class="p-5 text-justify">
                                                    <p class="text-slate-400 dark:text-gray-400 text-justify">
                                                        {!! $fa->getTranslations('answer', [$locale]) ? $fa->getTranslations('answer', [$locale])[$locale] : $fa->answer !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
            <!--end grid-->
        </div>
        <!--end container-->


        <div class="container py-16 ">
            <div class="grid grid-cols-1 text-center">
                <div class="mt-10 max-w-2xl text-center mx-auto">
                    <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-gray-200">
                        {{ __('panduan.policy', [], $locale) }}</h3>
                    </h1>
                </div>
            </div>
            <!--end grid-->

            @isset($privacies)
                <div class="grid md:grid-cols-2 grid-cols-1 mt-8 gap-[30px]">
                    @foreach ($privacies as $privacy)
                        <div class="flex">
                            <i data-feather="check-circle" class=" text-primary-600 mr-3"></i>
                            <div class="flex-1">
                                <h5 class="mb-2 text-xl font-semibold">{!! $privacy->getTranslations('category', [$locale])
                                    ? $privacy->getTranslations('category', [$locale])[$locale]
                                    : $privacy->category !!}</p>
                                </h5>
                                <p class="text-slate-800 text-justify dark:text-white">{!! $privacy->getTranslations('policy', [$locale])
                                    ? $privacy->getTranslations('policy', [$locale])[$locale]
                                    : $privacy->policy !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endisset
            <!--end grid-->
        </div>
        <!--end container-->
    </section>


    <!-- Counter Start -->
    <section class="relative md:py-8 py-8"
        style="background: url('https://www.dualmonitorbackgrounds.com/albums/abstract/softshading.jpg') center;">
        <p class= "text-center mb-5 mt-6 text-primary-600 font-semibold text-xl italic text-white">
            {{ __('panduan.form_of_service', [], $locale) }}</p>
        <div class="z-50 flex mx-auto justify-center">

            <div class="grid md:grid-cols-4 sm:grid-cols-2 grid-cols-1">
                @if ($locale == 'id')
                    @foreach ($pelayanan->services as $service)
                        <div class="text-center px-10 mt-2">
                            <h6 class="text-white text-sm mb-0">{{ $service['name'] }}</h6>
                            <h2 class="mb-0 text-white text-md mt-2 font-bold text-primary-600">{{ $service['no_hp'] }}
                            </h2>
                        </div>
                    @endforeach
                @else
                    @foreach ($pelayanan->services_en as $service)
                        <div class="text-center px-10 mt-3">
                            <h6 class="text-white text-sm mb-0">{{ $service['name'] }}</h6>
                            <h2 class="mb-0 text-white text-md mt-2 font-bold text-primary-600">{{ $service['no_hp'] }}
                            </h2>
                        </div>
                    @endforeach
                @endif
            </div>
            <!--end grid-->
        </div>
        <!--end container-->
    </section>
</div>
