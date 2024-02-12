<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\SiRusa\Bap;
use App\Models\SiRusa\Rilis;
use Illuminate\Http\Request;

class RilisController extends Controller
{
    public function index()
    {
        $rilises = Rilis::all();

        return response()->json($rilises);
    }

    public function bapRilis()
    {
        $baps = Bap::with('proyek')->get();

        $rilisAfterBap = Rilis::whereIn('no_izin', $baps->pluck('nib')->toArray())
            ->whereIn('deskripsi_kbli', $baps->pluck('proyek.kbli')->toArray())
            ->get();
        /*dd([
            'bap' => $baps,
            'nib' => $baps->pluck('nib')->toArray(),
            'kbli' => $baps->pluck('proyek.kbli')->toArray(),
            'rilis after bap' => $rilisAfterBap
        ]);*/

        return response()->json($rilisAfterBap);
    }
}
