<div>
    <div
        class="relative overflow-hidden before:absolute before:top-0 before:start-1/2 before:bg-[url('https://preline.co/assets/svg/examples/polygon-bg-element.svg')] before:bg-no-repeat before:bg-top before:bg-cover before:w-full before:h-full before:-z-[50] before:transform before:-translate-x-1/2 dark:before:bg-[url('https://preline.co/assets/svg/examples-dark/polygon-bg-element.svg')]">
        <div class="max-w-[85rem] mx-auto px-4 sm:px-6 lg:px-8 pt-24 pb-10">
            <!-- Announcement Banner -->
            <div class="flex justify-center">
            </div>
            <!-- Title -->
            <div class="mt-10 max-w-2xl text-center mx-auto">
                <h1 class="block font-bold text-gray-800 text-4xl md:text-5xl lg:text-6xl dark:text-gray-200">
                    {{ __('navbar.bkk', [], $locale) }}</h3>
                </h1>
                <h2><b>{{ $namaKota }}</b></h2>
            </div>

            {{-- <div class="mt-2 max-w-3xl text-center mx-auto">
                <p class="text-lg text-gray-600 dark:text-gray-400">{{ __('berita.deskripsi', [], $locale) }}</p>
            </div> --}}
        </div>
    </div>

   <div>
    <section class="relative md:py-18 py-15 mt-10">
        <div class="container">
            <div class="grid md:grid-cols-12 grid-cols-1 gap-[30px] mt-5">
                <div class="md:col-span-12">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-2 px-4 border-b">Nama Sekolah</th>
                                    <th class="py-2 px-4 border-b">Nama BKK</th>
                                    <th class="py-2 px-4 border-b">Email</th>
                                    <th class="py-2 px-4 border-b">Contact Person</th>
                                    <th class="py-2 px-4 border-b">Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bkkData as $bkk)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b">{{ $bkk->nama_sekolah }}</td>
                                        <td class="py-2 px-4 border-b">{{ $bkk->nama_bkk }}</td>
                                        <td class="py-2 px-4 border-b">{{ $bkk->email }}</td>
                                        <td class="py-2 px-4 border-b">{{ $bkk->contact_person }}</td>
                                        <td class="py-2 px-4 border-b">{{ $bkk->alamat }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="py-4 text-center">Tidak ada data BKK ditemukan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--end grid-->
        </div>
        <!--end container-->
    </section>
</div>
</div>
