<div>
    <!--Partner -->
    <section class="py-6 border-t border-gray-100 inset-0 bg-gray-500">
        <div class="relative container">
            <div class="grid md:grid-cols-6 grid-cols-2 justify-center gap-[30px] items-center">
                @foreach ($partners as $partner)
                    <a href="{{ $partner->url }}" target="_blank" class="mx-auto py-4">
                        <img src="{{ asset('storage/' . $partner->logo) }}" class="partner-logo h-10" alt="">
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <!--Partner -->

    <section class="relative table w-full md:py-16 py-16 lg:py-16 bg-no-repeat bg-center bg-cover jarallax" data-jarallax
        data-speed="0.5" style="background: url('{{ asset('images/banner.jpg') }}') center">
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

    <style>
        .partner-logo {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .partner-logo:hover {
            transform: translateY(-5px);
            /* Efek timbul */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            /* Efek bayangan */
        }
    </style>
</div>
