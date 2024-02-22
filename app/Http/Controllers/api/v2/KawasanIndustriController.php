<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Cjip\Kawasan;
use Illuminate\Http\Request;

class KawasanIndustriController extends Controller {
    public function index() {
        $result = Kawasan::all();

        return response()->json($result);
    }
}
