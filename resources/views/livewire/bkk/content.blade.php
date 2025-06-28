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
                                    <th class="py-2 px-4 border-b">Telepon</th>
                                    <th class="py-2 px-4 border-b">HP</th>
                                    <th class="py-2 px-4 border-b">Email</th>
                                    <th class="py-2 px-4 border-b">Website</th>
                                    <th class="py-2 px-4 border-b">Contact Person</th>
                                    <th class="py-2 px-4 border-b">Jabatan</th>
                                    <th class="py-2 px-4 border-b">Alamat</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bkkData as $bkk)
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-2 px-4 border-b">{{ $bkk->nama_sekolah }}</td>
                                        <td class="py-2 px-4 border-b">{{ $bkk->nama_bkk }}</td>
                                        <td class="py-2 px-4 border-b">{{ $bkk->telpon }}</td>
                                        <td class="py-2 px-4 border-b">{{ $bkk->hp }}</td>
                                        <td class="py-2 px-4 border-b">{{ $bkk->email }}</td>
                                        <td class="py-2 px-4 border-b">{{ $bkk->website }}</td>
                                        <td class="py-2 px-4 border-b">{{ $bkk->contact_person }}</td>
                                        <td class="py-2 px-4 border-b">{{ $bkk->jabatan }}</td>
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