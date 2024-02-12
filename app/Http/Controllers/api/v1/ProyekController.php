<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Investasi\ProyekInvestasi;
use App\Proyek;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProyekController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $proyeks = ProyekInvestasi::where('status', 1)->with([
            'kabkota','sektor'
        ])->get();
        /*$proyeks->map(function($proyek){
            $proyek['location'] = $proyek->getCoordinates()[0];
            return $proyek;
        });*/
        return response()->json($proyeks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function show(ProyekInvestasi $proyek)
    {
        /*$proyek->location = $proyek->getCoordinates();*/
        return response()->json($proyek);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProyekInvestasi $proyek)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Proyek  $proyek
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProyekInvestasi $proyek)
    {
        //
    }

    public function byCjibfSector($id){
        $proyeks = ProyekInvestasi::with('marketplace','bySector','kabkota','byUser.namakota')
        ->where('status', 1)
        ->where('sektor_id',$id)
        ->paginate(6);
        $proyeks->map(function($proyek){
            $proyek['location'] = $proyek->getCoordinates();
            return $proyek;
        });
        return response()->json($proyeks);
    }

    public function readyToOffer(){
        $proyeks = ProyekInvestasi::with('marketplace','kabkota','byUser.namakota','bySector')
        ->whereHas('marketplace', function ($query) {
            $query->where('name', '=', 'Ready to Offer');
        })->where('status', 1)->paginate(5);
        $proyeks->map(function($proyek){
            $proyek['location'] = $proyek->getCoordinates();
            return $proyek;
        });
        return response()->json($proyeks);
    }

    public function prospectiveProject(){
        $proyeks = ProyekInvestasi::with('marketplace','kabkota','byUser.namakota','bySector')
        ->whereHas('marketplace', function ($query) {
            $query->where('name', '=', 'Prospective Project');
        })->where('status', 1)->paginate(5);
        $proyeks->map(function($proyek){
            $proyek['location'] = $proyek->getCoordinates();
            return $proyek;
        });
        return response()->json($proyeks);
    }

    public function potentialProject(){
        $proyeks = ProyekInvestasi::with('marketplace','kabkota','byUser.namakota','bySector')
        ->whereHas('marketplace', function ($query) {
            $query->where('name', '=', 'Potential Project');
        })->where('status', 1)->paginate(5);
        $proyeks->map(function($proyek){
            $proyek['location'] = $proyek->getCoordinates();
            return $proyek;
        });
        return response()->json($proyeks);
    }

    public function search($key){
        $proyeks = ProyekInvestasi::with('marketplace','kabkota','byUser.namakota','bySector')
        ->where('project_name','like','%'.$key.'%')
        ->orWhere('latar_belakang','like','%'.$key.'%')
        ->get();
        $proyeks->map(function($proyek){
            $proyek['location'] = $proyek->getCoordinates();
            return $proyek;
        });
        return response()->json($proyeks);
    }
}
