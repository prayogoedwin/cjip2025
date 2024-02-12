<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\SiRusa\Bap;
use Illuminate\Http\Request;

class BapController extends Controller
{
    public function index()
    {

        $baps = Bap::get();

        return response()->json($baps);

    }
}
