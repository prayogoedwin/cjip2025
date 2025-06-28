<x-filament::page>
    <div class="space-y-6">
        {{-- <h2 class="text-xl font-bold">Rekap Data Dapodik</h2> --}}

        <div class="rounded-lg shadow ring-1 ring-black ring-opacity-5 max-w-none">
            <table class="w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-800">
                    <tr>
                        {{-- <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">CJIP Kota ID</th> --}}
                        <th class="px-4 py-2 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">Kab/Kota</th>
                        <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700 dark:text-gray-200">Total Laki-laki</th>
                        <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700 dark:text-gray-200">Total Perempuan</th>
                        <th class="px-4 py-2 text-right text-sm font-semibold text-gray-700 dark:text-gray-200">Total Potensi Lulusan</th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-100 dark:divide-gray-800">
                    @foreach ($this->rekapData as $item)
                        <tr>
                            {{-- <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-100">{{ $item['cjip_kota_id'] }}</td> --}}
                            <td class="px-4 py-2 text-sm text-gray-800 dark:text-gray-100">{{ $item['kab_kota'] }}</td>
                            <td class="px-4 py-2 text-sm text-right text-gray-800 dark:text-gray-100">{{ number_format($item['total_laki']) }}</td>
                            <td class="px-4 py-2 text-sm text-right text-gray-800 dark:text-gray-100">{{ number_format($item['total_perempuan']) }}</td>
                            <td class="px-4 py-2 text-sm text-right font-bold text-green-700 dark:text-green-400">{{ number_format($item['total_potensi']) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-filament::page>
