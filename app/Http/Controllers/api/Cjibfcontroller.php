<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CJIBF\CjibfEvent;

class Cjibfcontroller extends Controller
{
    public function cjibf(){
        $now = date('Y');
        $cjibf = CjibfEvent::whereYear('tgl_buka', '=', $now)->first();

        $cjibf->maps = $cjibf->getCoordinates();

        return response()->json($cjibf, 200);
    }
}
