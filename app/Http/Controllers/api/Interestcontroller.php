<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CJIBF\CountInterest;
use App\Models\Investasi\Proyek;
use App\Facades\Cart;
use App\Models\Investasi\ProyekInvestasi;

class Interestcontroller extends Controller
{
    public function addtocart(Request $request)
    {
        $proyek = ProyekInvestasi::where('id', $request->id)->first();
        $interest = new CountInterest();
        $interest->model = 'App/Models/Investasi/ProyekInvestasi';
        $interest->proyek_id = $request->id;
        $interest->user_id = Auth()->user()->id;
        $interest->group = $proyek->kotas[0]->nama;
        $interest->kab_kota_id = $proyek->kab_kota_id;
        $interest->save();
        Cart::add($proyek);

        return response()->json([
            'success' => true,
            'message' => 'Proyek berhasil ditambahkan'
        ], 200);
    }

    public function remove(Request $request)
    {
        // $interest = CountInterest::findOrFail($productId);
        $interest = CountInterest::where(["user_id" => Auth()->user()->id, "model"=>'App/Models/Investasi/ProyekInvestasi', 'proyek_id'=>$request->id])->first();
        // dd($interest);
        if($interest){
            $interest->delete();
            Cart::remove($interest->id);
            return response()->json([
                'success' => true,
                'message' => 'Proyek berhasil dihapus'
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Proyek gagal dihapus'
            ], 400);
        }
    }

    public function interest(){
        $cart = CountInterest::where('user_id', Auth()->user()->id)->with(['proyek'=>function($q){
            $q->select('id', 'nama');
        }])->get();
        return $cart;
    }

    public function interest_proyek(){
        $cart = CountInterest::where('user_id', Auth()->user()->id)
        ->where('model', 'App/Models/Investasi/ProyekInvestasi')->with(['proyek'=>function($q){
            $q->select('id', 'nama', 'foto');
        }])->get();
        foreach($cart as $data){
            $data->fotos = json_decode($data->proyek->foto);
            if($data->fotos!=null){
                $arrfoto = [];
                foreach($data->fotos as $img){
                    $tmp = url('storage/'.str_replace('\\', '/', $img));
                    array_push($arrfoto, $tmp);
                }
                $data->fotos = $arrfoto;
            }
        }
        return response()->json($cart, 200);
    }

    public function destroy(Request $request){
        CountInterest::destroy($request->id);
        return response()->json([
            'status' => true,
            'message' => 'Cart proyek berhasil dihapus'
        ], 200);
    }

    // -------------------------------------------------EN--------------------------------------------------
}
