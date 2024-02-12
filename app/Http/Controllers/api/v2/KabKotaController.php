<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\General\Kabkota;
use Illuminate\Http\Request;

class KabKotaController extends Controller {
    public function index() {
        $result = Kabkota::all();

        return response()->json($result);
    }
}
