<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\CJIBF\CountInterest;
use App\Models\Investasi\ManualProjects;

class Othercontroller extends Controller
{
    public function addtocart(Request $request){
        $manual = new ManualProjects();
        $manual->user_id = Auth()->user()->id;
        $manual->kab_kota_id = $request->kab;
        $manual->project = $request->proyek;
        $manual->save();
        $interest = new CountInterest();
        $interest->model = 'App/Models/Investasi/ManualProjects';
        $interest->proyek_id = $manual->id;
        $interest->user_id = Auth()->user()->id;
        $interest->group = 'Others';
        $interest->kab_kota_id = $manual->kab_kota_id;
        $interest->save();

        return response()->json([
            'success' => true,
            'message' => 'Other berhasil ditambahkan'
        ], 200);
    }

    public function cart(){
        $other =CountInterest::where('user_id', Auth()->user()->id)
        ->where('model', 'App/Models/Investasi/ManualProjects')->with(['manual'=>function($q){
            $q->select('id', 'kab_kota_id', 'project')->with(['kabkota' => function($k){
                $k->select('id')->with('namakota');
            }]);
        }])->get();
        $arr = [];
        foreach($other as $data){
            $tmp = [
                'id' => $data->id,
                'proyek' => $data->manual->project,
                'kota' => $data->manual->kabkota->namakota[0]->nama
            ];
            array_push($arr, $tmp);
        }
        return response()->json($arr, 200);
    }

    public function kabkota(){
        $kota = User::where('role_id', 3)->with('namakota')->get();
        foreach($kota as $data){
            $data->nama_kota = $data->namakota[0]->nama;
        }
        return response()->json($kota, 200);
    }

    public function destroy(Request $request){
        CountInterest::destroy($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Cart other berhasil dihapus'
        ], 200);
    }
}
