<?php

namespace App\Http\Controllers\api\v2\EMakaryo;

use App\Http\Controllers\Controller;
use App\Models\SiRusa\Nib;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class PerusahaanController extends Controller
{

    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 50);
        $page = $request->input('page', 1);

        try {
            // Cache the response for 60 minutes
            $cacheKey = "nib_page_{$page}_per_page_{$perPage}";

            $nibList = Cache::remember($cacheKey, 60, function () use ($perPage) {
                return NIB::where('is_jateng', 1)
                    ->whereHas('proyeks') // Ensure only NIBs with related Proyek are retrieved
                    ->with(['proyeks' => function ($query) {
                        $query->select('id', 'nib_id', 'uraian_skala_usaha', 'nama_23_sektor', 'kab_kota_id', 'tki', 'tka')
                            ->with('kabkota:id,nama');
                    }])
                    ->select('id', 'nama_perusahaan', 'status_penanaman_modal', 'uraian_jenis_perusahaan', DB::raw('DATE(day_of_tanggal_terbit_oss) as tanggal_terbit_oss'), 'email')
                    ->get();
            });

            // Modify the response to calculate total_kebutuhan_tk and hide certain fields
            $nibList->transform(function ($nib) {
                $totalKebutuhanTk = $nib->proyeks->sum(function ($proyek) {
                    return $proyek->tki + $proyek->tka; // Calculate total TKI + TKA for each Proyek
                });

                return [
                    'nama_perusahaan' => $nib->nama_perusahaan,
                    'status_penanaman_modal' => $nib->status_penanaman_modal,
                    'uraian_jenis_perusahaan' => $nib->uraian_jenis_perusahaan,
                    'tanggal_terbit_oss' => $nib->tanggal_terbit_oss,
                    'email' => $nib->email,
                    'total_kebutuhan_tk' => $totalKebutuhanTk,
                    'proyeks' => $nib->proyeks->map(function ($proyek) {
                        return [
                            'uraian_skala_usaha' => $proyek->uraian_skala_usaha,
                            'nama_23_sektor' => $proyek->nama_23_sektor,
                            'kabkota' => $proyek->kabkota->nama,
                            'tki' => $proyek->tki,
                            'tka' => $proyek->tka,
                        ];
                    }),
                ];
            });

            // Sort the NIB list by total_kebutuhan_tk in descending order
            $sortedNibList = $nibList->sortByDesc('total_kebutuhan_tk')->values();

            // Paginate the sorted collection manually
            $paginated = $sortedNibList->forPage($page, $perPage);

            // Return the response
            return response()->json([
                'data' => $paginated,
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => $nibList->count(),
            ], 200);

        } catch (Exception $e) {
            // Error handling: return a proper error response if something goes wrong
            return response()->json([
                'error' => 'Failed to retrieve data',
                'message' => $e->getMessage()
            ], 500);
        }
    }

}
