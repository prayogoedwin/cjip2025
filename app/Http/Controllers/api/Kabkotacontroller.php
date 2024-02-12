<?php

namespace App\Http\Controllers\api;
use App\Models\Investasi\Proyek;

use App\Http\Controllers\Controller;
use App\Models\General\Kabkota;
use App\Models\Investasi\ProyekInvestasi;
use App\Models\Profile\ProfileKabkota;
use Illuminate\Http\Request;

class Kabkotacontroller extends Controller
{
    public function detailkabkota(Request $request){
        $detail = ProfileKabkota::where('kab_kota_id', $request->id)->first();
        $detail->infrasturktur = json_decode($detail->infrasturktur);
        if(isset($detail->infrasturktur->infrastruktur[0])){
            if($detail->infrasturktur->infrastruktur[0]==null){
                $arr = ["Data Kosong"];
                $infrastruktur = [
                    'infrastruktur' => $arr
                ];
                $detail->infrasturktur = $infrastruktur;
            }
        }
        else{
                $arr = ["Data Kosong"];
                $infrastruktur = [
                    'infrastruktur' => $arr
                ];
                $detail->infrasturktur = $infrastruktur;
        }
        $proyek = ProyekInvestasi::where('status', 1)->with('sektor')->where('kab_kota_id', $request->id)->get();
        foreach($proyek as $data){
            // $data->location = $data->getCoordinates();
            // foreach($data->location as $loc){
            //     $ok = [
            //         'lat' => $loc['lat'],
            //         'lng' => $loc['lng']
            //     ];
            //     $data->location = $ok;
            // }
            $data->file_keuangan = json_decode($data->file_keuangan);
            $data->foto = json_decode($data->foto);
            if($data->foto!=null){
                $arrfoto = [];
                foreach($data->foto as $img){
                    $tmp = url('storage/'.str_replace('\\', '/', $img));
                    array_push($arrfoto, $tmp);
                }
                $data->foto = $arrfoto;
            }
            $data->nama_kota = $data->kabkota->nama;
        }
        return response()->json([
            'detail' => $detail,
            'proyek' => $proyek
        ], 200);
    }

    public function getkota(){
        $kota = Kabkota::all();
        $city = [];
        foreach($kota as $data){
            $arr = [
                'id' => $data->id,
                'name' => $data->nama
            ];
            array_push($city, $arr);
        }
        return response()->json($city, 200);
    }

}
