<?php

namespace App\Http\Controllers\api\v2\SatuData;

use App\Http\Controllers\Controller;
use App\Models\SiRusa\Rilis;
use App\Models\User;
use Exception;
use Filament\Notifications\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class RilisApiController extends Controller
{
    public function pmdnSektor(Request $request)
    {
        try {
            return $this->aggregateData($request, 'sektor', 'PMDN');
        } catch (Exception $e) {
            return $this->handleError($e, 'Failed to retrieve PMDN Sektor data');
        }
    }

    public function pmdnKabkota(Request $request)
    {
        try {
            return $this->aggregateData($request, 'kabkot', 'PMDN');
        } catch (Exception $e) {
            return $this->handleError($e, 'Failed to retrieve PMDN Kab/Kota data');
        }
    }

    public function pmaSektor(Request $request)
    {
        try {
            return $this->aggregateData($request, 'sektor', 'PMA', 'tambahan_investasi_dalam_us_ribu');
        } catch (Exception $e) {
            return $this->handleError($e, 'Failed to retrieve PMA Sektor data');
        }
    }

    public function pmaKabkota(Request $request)
    {
        try {
            return $this->aggregateData($request, 'kabkot', 'PMA', 'tambahan_investasi_dalam_us_ribu');
        } catch (Exception $e) {
            return $this->handleError($e, 'Failed to retrieve PMA Kab/Kota data');
        }
    }

    public function pmaNegara(Request $request)
    {
        try {
            return $this->aggregateData($request, 'negara', 'PMA', 'tambahan_investasi_dalam_us_ribu');
        } catch (Exception $e) {
            return $this->handleError($e, 'Failed to retrieve PMA Negara data');
        }
    }

    public function tenagaKerja(Request $request)
    {
        try {
            return Rilis::selectRaw('tahun, kabkot, SUM(tki + tka) as jumlah, status_pm')
                ->where('tahun', $request->input('tahun'))
                ->groupBy('tahun', 'kabkot', 'status_pm')
                ->get();
        } catch (Exception $e) {
            return $this->handleError($e, 'Failed to retrieve Tenaga Kerja data');
        }
    }

    protected function aggregateData(Request $request, $groupByField, $status, $investmentField = 'tambahan_investasi_dalam_rp_juta')
    {
        try {
            return Rilis::selectRaw(
                "tahun, $groupByField, SUM(proyek) as proyek, SUM($investmentField) as $investmentField, SUM(tki) as tki, SUM(tka) as tka"
            )
                ->where('tahun', $request->input('tahun'))
                ->where('status_pm', $status)
                ->groupBy('tahun', $groupByField)
                ->get();
        } catch (Exception $e) {
            throw new Exception('Data aggregation failed');
        }
    }

    protected function handleError(Exception $e, $customMessage)
    {
        // Log the error for debugging
        Log::error($customMessage . ': ' . $e->getMessage());

        // Return a JSON response with the error message and a 500 status code
        return response()->json([
            'error' => $customMessage,
            'message' => $e->getMessage(),
        ], 500);
    }
}
