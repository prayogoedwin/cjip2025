<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Investasi\ProyekInvestasi;
use Illuminate\Http\Request;

class ProyekInvestasiController extends Controller
{
    public function index()
    {
        $result = ProyekInvestasi::with('sektor')->get();

        return response()->json($result);
    }
}
