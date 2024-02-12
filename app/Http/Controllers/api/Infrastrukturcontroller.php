<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Investasi\InfrastrukturPendukung;
use Illuminate\Http\Request;

class Infrastrukturcontroller extends Controller
{
    public function getinfrastucture(){
        $infra = InfrastrukturPendukung::all();
        foreach($infra as $data){
            $data->gambar = url('storage/'.str_replace('\\', '/', $data->gambar));
            $data->icon = url('storage/'.str_replace('\\', '/', $data->icon));
        }
        return response()->json($infra, 200);
    }
}
