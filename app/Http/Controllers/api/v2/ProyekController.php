<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\SiMike\Proyek;
use Illuminate\Http\Request;

class ProyekController extends Controller
{

    public function index()
    {

        $proyeks = Proyek::get();

        return response()->json($proyeks);

    }

    public function pengawasan(Request $request)
    {

        $proyeks = Proyek::whereHas('nibCheck')
            ->with(['nibCheck', 'kabkota'])
            ->whereNotNull('rilis')
            ->whereNot('uraian_skala_usaha', 'Usaha Mikro')
            ->orderByDesc('total_investasi')
            ->paginate(10);

        return response()->json($proyeks);

    }

    public function updateStatusFasilitasi(Request $request)
    {
        $proyeks = json_decode($request->proyek_id);

        Proyek::whereIn('id', $proyeks)->update([
            'is_terfasilitasi' => $request->is_terfasilitasi
        ]);

        return response()->json(['message' => 'Proyek status updated successfully']);
    }

    public function updateStatusPembinaan(Request $request)
    {
        $proyeks = json_decode($request->proyek_id);

        Proyek::whereIn('id', $proyeks)->update([
            'is_terbina' => $request->is_terbina
        ]);

        return response()->json(['message' => 'Proyek status updated successfully']);
    }


    public function wajibMitra(Request $request)
    {

        //dd(json_decode($request->kbli));
        $proyeks = Proyek::with(['nibCheck', 'kabkota', 'baps'])->whereIn('kbli', json_decode($request->kbli))
            ->whereNot('uraian_skala_usaha', 'Usaha Mikro')
            ->get();

        return response()->json($proyeks);
    }
}
