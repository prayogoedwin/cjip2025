<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\General\Sektor;
use App\Models\Investasi\SektorCjibf;
use Illuminate\Http\Request;

class Sektorcontroller extends Controller
{
    public function getsektor(){
        $sektor = SektorCjibf::all();
        return response()->json($sektor, 200);
    }
}
