<?php

namespace App\Http\Controllers\api\v2\SatuData;

use App\Http\Controllers\Controller;
use App\Models\Cjip\KawasanIndustri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KawasanIndustriApiController extends Controller
{
    public function index(Request $request)
    {
        try {
            $tahun_data = $request->input('tahun', 2023); // Default to 2023 if not provided

            // Fetch Kawasan Industri data where status is 1
            $kawasanIndustriData = KawasanIndustri::where('status', 1)
                ->get()
                ->map(function ($kawasan) {
                    // Extract kab_kota (city) from lokasi['label']['raw']['display_name']
                    $kabKota = '';
                    if (isset($kawasan->lokasi['raw']['display_name'])) {
                        $displayName = $kawasan->lokasi['raw']['display_name'];

                        // Split the display name into parts
                        $parts = explode(',', $displayName);

                        // Detect the city before "Jawa Tengah" or "Central Java"
                        foreach ($parts as $part) {
                            $part = trim($part); // Trim whitespace
                            if (strpos($part, 'Jawa Tengah') !== false || strpos($part, 'Central Java') !== false) {
                                break;
                            }
                            $kabKota = $part;
                        }
                    }

                    // Get the nama_kawasan in the preferred language
                    $namaKawasan = $kawasan->getTranslation('nama', app()->getLocale())
                        ?: $kawasan->getTranslation('nama', 'en'); // Fallback to English if not available

                    // Count the number of tenants
                    $jumlahTenant = is_array($kawasan->tenant) ? count($kawasan->tenant) : 0;

                    return [
                        'tahun_data' => $kawasan->tahun_data ?? 2023,
                        'kab_kota' => $kabKota,
                        'nama_kawasan' => $namaKawasan,
                        'jumlah_tenant' => $jumlahTenant,
                    ];
                });


            return response()->json($kawasanIndustriData, 200); // Return with HTTP 200 OK
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error fetching Kawasan Industri data: '.$e->getMessage());

            // Return a JSON response with an error message and HTTP 500 status
            return response()->json([
                'error' => 'Failed to fetch Kawasan Industri data',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
