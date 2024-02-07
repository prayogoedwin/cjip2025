<div>
    <section class="relative md:py-18 py-10 mt-3">
        @isset($kawasans)
            {{-- container card --}}
            <div class="container">
                <div class="grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 gap-[30px]">
                    @foreach ($kawasans as $kawasan)
                        <div class="blog relative rounded-md shadow-sm dark:shadow-gray-700 overflow-hidden">
                            <img src="{{ asset('storage/' . $kawasan->foto[0]) }}" alt="" class="object-cover"
                                style="height: 230px; width: 100%;">

                            <div class="content p-6">
                                <a href="{{ route('detail_kawasan', $kawasan->id) }}"
                                    class="title hover:text-green-600 h5 text-xl font-semibold hover:text-primary-600 transition duration-500 text-justify">{{ \Illuminate\Support\Str::limit(strip_tags($kawasan->getTranslations('nama', [$locale]) ? $kawasan->getTranslations('nama', [$locale])[$locale] : $kawasan->nama), 100, ' ...') }}</a>

                                <p class="text-gray-500 mt-3 text-justify">
                                    {!! Illuminate\Support\Str::limit(
                                        strip_tags(
                                            $kawasan->getTranslations('perusahaan', [$locale])
                                                ? $kawasan->getTranslations('perusahaan', [$locale])[$locale]
                                                : $kawasan->perusahaan,
                                        ),
                                        200,
                                        ' ...',
                                    ) !!}</p>

                                <div class="mt-4">
                                    <a href="{{ route('detail_kawasan', $kawasan->id) }}"
                                        class="btn btn-link hover:text-green-500 font-normal hover:text-primary-600 after:bg-primary-600 transition duration-500">{{ __('read more', [], $locale) }}
                                        <i class="uil uil-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!--blog end-->
                        <!--end grid-->
                    @endforeach
                </div>
                <div class="pagination py-5 container">
                    <x-filament::pagination :paginator="$kawasans" />
                </div>
            </div>
        @endisset
        <!--end container-->
    </section>
</div>
