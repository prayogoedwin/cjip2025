<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Cjip\Loi;
use Illuminate\Http\Request;

class LoiController extends Controller
{
    public function index()
    {

        $lois = Loi::get();

        return response()->json($lois);

    }
}
