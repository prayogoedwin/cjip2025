<div>
    <!-- Hero -->
    <div
        class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[50] before:transform before:-translate-x-1/2 dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')]">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
            <!-- Announcement Banner -->
            <div class="flex justify-center">

            </div>
            <!-- End Announcement Banner -->

            <!-- Title -->
            <div class="mt-10 max-w-2xl text-center mx-auto">
                <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-gray-200">
                    {{ __('berita.title', [], $locale) }}
                </h1>
            </div>
            <!-- End Title -->

            <div class="mt-2 max-w-3xl text-center mx-auto">
                <p class="text-lg text-gray-600 dark:text-gray-400">{{ __('berita.deskripsi', [], $locale) }}</p>
            </div>
        </div>
    </div>
    <!-- End Hero -->

    @livewire('berita.content')
</div>
