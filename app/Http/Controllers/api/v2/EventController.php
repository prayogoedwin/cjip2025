<?php

namespace App\Http\Controllers\api\v2;

use App\Http\Controllers\Controller;
use App\Models\Cjip\Event;
use Illuminate\Http\Request;

class EventController extends Controller {
    public function index() {
        $result = Event::all();

        return response()->json($result);
    }
}
