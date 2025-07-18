<div>
    <!-- Start Section-->
    <section class="relative md:py-10 py-10 bg-gray-50 dark:bg-slate-800">
        <div class="container relative">
            <div class="grid grid-cols-1 relative">
                <div class="tiny-five-item">
                    @foreach ($partners as $partner)
                        <div class="tiny-slide">
                            <a href="{{ $partner->url }}">
                                <div
                                    class="px-3 py-10 rounded-md shadow dark:shadow-gray-800 group text-center bg-white dark:bg-slate-900 hover:bg-indigo-600/5 dark:hover:bg-indigo-600/5 duration-500 m-2">
                                    <img src="{{ asset('storage/' . $partner->logo) }}" target="_blank"
                                        class="h-16 bg-cover flex align-middle justify-center items-center mx-auto"
                                        alt="">
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- End Section-->

    <section class="relative table w-full md:py-16 py-16 lg:py-16 bg-no-repeat bg-center bg-cover jarallax"
        data-jarallax data-speed="0.5" style="background: url('{{ asset('images/banner.jpg') }}') center">
        <div class="absolute inset-0 bg-slate-900/70"></div>
        <div class="container relative">
            <div class="grid grid-cols-1 pb-2 text-center">
                <h3 class="md:text-3xl text-2xl text-white font-medium">
                    {{ __('start investing in central java', [], $locale) }}</h3>
                <div class="relative mt-8">
                    <a href="{{ route('peluang_investasi') }}"
                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-green-600 hover:bg-yellow-500 border-green-600 hover:border-yellow-500 text-white rounded-md">{{ __('start investing', [], $locale) }}</a>
                </div>
            </div>
        </div>
    </section>
</div>
