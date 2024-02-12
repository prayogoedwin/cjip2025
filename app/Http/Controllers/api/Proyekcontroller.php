<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Investasi\Proyek;
use App\Models\CJIBF\CountInterest;
use App\Models\Investasi\ProyekInvestasi;
use Illuminate\Support\Facades\Lang;

class Proyekcontroller extends Controller
{
    public function proyek(Request $request){
        $proyek = ProyekInvestasi::where('market_id', $request->id)->with('sektor')->where('status', 1)->paginate(5)->appends(request()->query());
        foreach($proyek as $data){
        //     $data->location = $data->getCoordinates();
        //     foreach($data->location as $loc){
        //         $ok = [
        //             'lat' => $loc['lat'],
        //             'lng' => $loc['lng']
        //         ];
        //         $data->location = $ok;
        //     }
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
            $data->nama_kota = $data->kabKota->nama;
        }
        return response()->json($proyek, 200);
    }

    public function sektor(Request $request){
        $proyek = ProyekInvestasi::where('sektor_id', $request->id)->with('sektor')->where('status', 1)->paginate(5)->appends(request()->query());
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
        }
        return response()->json($proyek, 200);
    }

    public function allproyek(){
        $proyek = ProyekInvestasi::select('id', 'market_id')->where('status', 1)->get();
        foreach($proyek as $data){
            // $data->location = $data->getCoordinates();
            // foreach($data->location as $loc){
            //     $ok = [
            //         'lat' => $loc['lat'],
            //         'lng' => $loc['lng']
            //     ];
            //     $data->location = $ok;
            // }
            // $data->nama_kota = $data->kabKota->nama;
        }
        return response()->json($proyek, 200);
    }

    public function getbyid(Request $request){
        $proyek = ProyekInvestasi::where('id', $request->id)->with(['kabKota'=>function($q){
            $q->select('id', 'nama')->with('nama');
        }])->with('sektor')->first();
        // $proyek->location = $proyek->getCoordinates();
        // foreach($proyek->location as $loc){
        //     $ok = [
        //         'lat' => $loc['lat'],
        //         'lng' => $loc['lng']
        //     ];
        //     $proyek->location = $ok;
        // }
        $proyek->nama_kota = $proyek->kabKota->nama;
        $proyek->file_keuangan = json_decode($proyek->file_keuangan);
        $proyek->foto = json_decode($proyek->foto);
        if($proyek->foto!=null){
            $arrfoto = [];
            foreach($proyek->foto as $img){
                $tmp = url('storage/'.str_replace('\\', '/', $img));
                array_push($arrfoto, $tmp);
            }
            $proyek->foto = $arrfoto;
        }
        return response()->json($proyek, 200);
    }

    // public function proyekinterest(Request $request){
    //     if($request->kab_kota_id==0 && $request->sektor_id==0){
    //         $proyek = ProyekInvestasi::where('status', 1)->with('sektor')->where('market_id', 1)->paginate(5)->appends(request()->query());
    //     }
    //     elseif($request->kab_kota_id==0){
    //         $proyek = ProyekInvestasi::where('sektor_id', $request->sektor_id)
    //             ->where('status', 1)->with('sektor')
    //             ->paginate(5)->appends(request()->query());
    //     }
    //     elseif($request->sektor_id==0){
    //         $proyek = ProyekInvestasi::where('status', 1)->with('sektor')
    //             ->where('kab_kota_id', $request->kab_kota_id)
    //             ->paginate(5)->appends(request()->query());
    //     }
    //     else{
    //         $proyek = ProyekInvestasi::where('status', 1)->with('sektor')
    //         ->where('kab_kota_id', $request->kab_kota_id)
    //         ->where('sektor_id', $request->sektor_id)
    //         ->paginate(5)->appends(request()->query());
    //     }
    //     $cart = CountInterest::where('user_id', Auth()->user()->id)
    //     ->where('model', 'App/Models/Investasi/ProyekInvestasi')->pluck('proyek_id')->toArray();
    //     foreach($proyek as $data){
    //         // $data->location = $data->getCoordinates();
    //         // foreach($data->location as $loc){
    //         //     $ok = [
    //         //         'lat' => $loc['lat'],
    //         //         'lng' => $loc['lng']
    //         //     ];
    //         //     $data->location = $ok;
    //         // }
    //         $data->file_keuangan = json_decode($data->file_keuangan);
    //         $data->foto = json_decode($data->foto);
    //         $data->nama_kota = $data->kabKota->nama;
    //         if($data->foto!=null){
    //             $arrfoto = [];
    //             foreach($data->foto as $img){
    //                 $tmp = url('storage/'.str_replace('\\', '/', $img));
    //                 array_push($arrfoto, $tmp);
    //             }
    //             $data->foto = $arrfoto;
    //         }
    //         if(in_array($data->id, $cart)){
    //             $data->love = true;
    //         }
    //         else{
    //             $data->love = false;
    //         }
    //     }
    //     return response()->json($proyek, 200);
    // }

    // public function getproyek(){
    //     $proyek = ProyekInvestasi::with('sektor')->where('status', 1)->with(['kabKota'=>function($q){
    //         $q->select('id', 'nama')->with('nama');
    //     }])->paginate(5)->appends(request()->query());
    //     $cart = CountInterest::where('user_id', Auth()->user()->id)
    //     ->where('model', 'App/Models/Investasi/ProyekInvestasi')->pluck('proyek_id')->toArray();
    //     foreach($proyek as $data){
    //         // $data->location = $data->getCoordinates();
    //         // foreach($data->location as $loc){
    //         //     $ok = [
    //         //         'lat' => $loc['lat'],
    //         //         'lng' => $loc['lng']
    //         //     ];
    //         //     $data->location = $ok;
    //         // }
    //         $data->nama_kota = $data->kabKota->nama;
    //         $data->file_keuangan = json_decode($data->file_keuangan);
    //         $data->foto = json_decode($data->foto);
    //         if($data->foto!=null){
    //             $arrfoto = [];
    //             foreach($data->foto as $img){
    //                 $tmp = url('storage/'.str_replace('\\', '/', $img));
    //                 array_push($arrfoto, $tmp);
    //             }
    //             $data->fotos = $arrfoto;
    //         }
    //         if(in_array($data->id, $cart)){
    //             $data->love = true;
    //         }
    //         else{
    //             $data->love = false;
    //         }
    //     }
    //     return response()->json($proyek, 200);
    // }

    public function search(Request $request){
        $proyek = ProyekInvestasi::with('sektor')->where('market_id', $request->market)->where('status', 1)->with(['kabKota'=>function($q){
            $q->select('id', 'nama')->with('nama');
        }])
        ->where('nama', 'like', "%".$request->nama."%")->paginate(5)->appends(request()->query());
        foreach($proyek as $data){
            // $data->location = $data->getCoordinates();
            // foreach($data->location as $loc){
            //     $ok = [
            //         'lat' => $loc['lat'],
            //         'lng' => $loc['lng']
            //     ];
            //     $data->location = $ok;
            // }
            $data->nama_kota = $data->kabKota->nama;
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
        }
        return response()->json($proyek, 200);
    }

    public function searchsektor(Request $request){
        $proyek = ProyekInvestasi::with('sektor')->where('sektor_id', $request->sektor)->where('sektor_id', $request->sektor)->where('status', 1)->with(['kabKota'=>function($q){
            $q->select('id', 'nama')->with('nama');
        }])
        ->where('nama', 'like', "%".$request->nama."%")->paginate(5)->appends(request()->query());
        foreach($proyek as $data){
            // $data->location = $data->getCoordinates();
            // foreach($data->location as $loc){
            //     $ok = [
            //         'lat' => $loc['lat'],
            //         'lng' => $loc['lng']
            //     ];
            //     $data->location = $ok;
            // }
            $data->nama_kota = $data->kabKota->nama;
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
        }
        return response()->json($proyek, 200);
    }

    // -----------------------------------------EN-------------------------------------------------------------

    // public function enproyek(Request $request){
    //     $proyek = ProyekInvestasi::where('market_id', $request->id)->with('sektor')->with(['kabKota'=>function($q){
    //         $q->select('id', 'nama')->with('nama');
    //     }])->where('status', 1)->paginate(5)->appends(request()->query());
    //     foreach($proyek as $data){
    //         $data->location = $data->getCoordinates();
    //         foreach($data->location as $loc){
    //             $ok = [
    //                 'lat' => $loc['lat'],
    //                 'lng' => $loc['lng']
    //             ];
    //             $data->location = $ok;
    //         }
    //         $data->nama_kota = $data->kabKota->nama[0]->nama;
    //         $data->file_keuangan = json_decode($data->file_keuangan);
    //         $data->fotos = json_decode($data->fotos);
    //         if($data->fotos!=null){
    //             $arrfoto = [];
    //             foreach($data->fotos as $img){
    //                 $tmp = url('storage/'.str_replace('\\', '/', $img));
    //                 array_push($arrfoto, $tmp);
    //             }
    //             $data->fotos = $arrfoto;
    //         }

    //         // Translate
    //         $data->latar_belakang = $data->getTranslatedAttribute('latar_belakang', 'en');
    //         $data->lingkup_pekerjaan = $data->getTranslatedAttribute('lingkup_pekerjaan', 'en');
    //         $data->eksisting = $data->getTranslatedAttribute('eksisting', 'en');
    //         $data->status_kepemilikan = $data->getTranslatedAttribute('status_kepemilikan', 'en');
    //         $data->nilai_investasi = $data->getTranslatedAttribute('nilai_investasi', 'en');
    //         $data->skema_investasi = $data->getTranslatedAttribute('skema_investasi', 'en');
    //         $data->npv = $data->getTranslatedAttribute('npv', 'en');
    //         $data->playback_period = $data->getTranslatedAttribute('playback_period', 'en');
    //         $data->cp_nama = $data->getTranslatedAttribute('cp_nama', 'en');
    //         $data->cp_alamat = $data->getTranslatedAttribute('cp_alamat', 'en');
    //         $data->nama = $data->getTranslatedAttribute('nama', 'en');
    //         $data->ketersediaan_pasar = $data->getTranslatedAttribute('ketersediaan_pasar', 'en');
    //         $data->ketersediaan_sd = $data->getTranslatedAttribute('ketersediaan_sd', 'en');
    //         $data->desain_layout_project = $data->getTranslatedAttribute('desain_layout_project', 'en');
    //         $data->rincian_investasi = $data->getTranslatedAttribute('rincian_investasi', 'en');
    //     }
    //     return response()->json($proyek, 200);
    // }

    // public function enbysektor(Request $request){
    //     $proyek = ProyekInvestasi::where('sektor_id', $request->id)->with('sektor')->with(['kabKota'=>function($q){
    //         $q->select('id', 'nama')->with('nama');
    //     }])->where('status', 1)->paginate(5)->appends(request()->query());
    //     foreach($proyek as $data){
    //         $data->location = $data->getCoordinates();
    //         foreach($data->location as $loc){
    //             $ok = [
    //                 'lat' => $loc['lat'],
    //                 'lng' => $loc['lng']
    //             ];
    //             $data->location = $ok;
    //         }
    //         $data->nama_kota = $data->kabKota->nama[0]->nama;
    //         $data->file_keuangan = json_decode($data->file_keuangan);
    //         $data->fotos = json_decode($data->fotos);
    //         if($data->fotos!=null){
    //             $arrfoto = [];
    //             foreach($data->fotos as $img){
    //                 $tmp = url('storage/'.str_replace('\\', '/', $img));
    //                 array_push($arrfoto, $tmp);
    //             }
    //             $data->fotos = $arrfoto;
    //         }

    //         // Translate
    //         $data->latar_belakang = $data->getTranslatedAttribute('latar_belakang', 'en');
    //         $data->lingkup_pekerjaan = $data->getTranslatedAttribute('lingkup_pekerjaan', 'en');
    //         $data->eksisting = $data->getTranslatedAttribute('eksisting', 'en');
    //         $data->status_kepemilikan = $data->getTranslatedAttribute('status_kepemilikan', 'en');
    //         $data->nilai_investasi = $data->getTranslatedAttribute('nilai_investasi', 'en');
    //         $data->skema_investasi = $data->getTranslatedAttribute('skema_investasi', 'en');
    //         $data->npv = $data->getTranslatedAttribute('npv', 'en');
    //         $data->playback_period = $data->getTranslatedAttribute('playback_period', 'en');
    //         $data->cp_nama = $data->getTranslatedAttribute('cp_nama', 'en');
    //         $data->cp_alamat = $data->getTranslatedAttribute('cp_alamat', 'en');
    //         $data->nama = $data->getTranslatedAttribute('nama', 'en');
    //         $data->ketersediaan_pasar = $data->getTranslatedAttribute('ketersediaan_pasar', 'en');
    //         $data->ketersediaan_sd = $data->getTranslatedAttribute('ketersediaan_sd', 'en');
    //         $data->desain_layout_project = $data->getTranslatedAttribute('desain_layout_project', 'en');
    //         $data->rincian_investasi = $data->getTranslatedAttribute('rincian_investasi', 'en');
    //     }
    //     return response()->json($proyek, 200);
    // }

    // public function ensearch(Request $request){
    //     $proyek = ProyekInvestasi::with('sektor')->where('market_id', $request->market)->where('status', 1)->with(['kabKota'=>function($q){
    //         $q->select('id', 'nama')->with('nama');
    //     }])
    //     ->where('nama', 'like', "%".$request->nama."%")->paginate(5)->appends(request()->query());
    //     foreach($proyek as $data){
    //         $data->location = $data->getCoordinates();
    //         foreach($data->location as $loc){
    //             $ok = [
    //                 'lat' => $loc['lat'],
    //                 'lng' => $loc['lng']
    //             ];
    //             $data->location = $ok;
    //         }
    //         $data->nama_kota = $data->kabKota->nama[0]->nama;
    //         $data->file_keuangan = json_decode($data->file_keuangan);
    //         $data->fotos = json_decode($data->fotos);
    //         if($data->fotos!=null){
    //             $arrfoto = [];
    //             foreach($data->fotos as $img){
    //                 $tmp = url('storage/'.str_replace('\\', '/', $img));
    //                 array_push($arrfoto, $tmp);
    //             }
    //             $data->fotos = $arrfoto;
    //         }

    //         // Translate
    //         $data->latar_belakang = $data->getTranslatedAttribute('latar_belakang', 'en');
    //         $data->lingkup_pekerjaan = $data->getTranslatedAttribute('lingkup_pekerjaan', 'en');
    //         $data->eksisting = $data->getTranslatedAttribute('eksisting', 'en');
    //         $data->status_kepemilikan = $data->getTranslatedAttribute('status_kepemilikan', 'en');
    //         $data->nilai_investasi = $data->getTranslatedAttribute('nilai_investasi', 'en');
    //         $data->skema_investasi = $data->getTranslatedAttribute('skema_investasi', 'en');
    //         $data->npv = $data->getTranslatedAttribute('npv', 'en');
    //         $data->playback_period = $data->getTranslatedAttribute('playback_period', 'en');
    //         $data->cp_nama = $data->getTranslatedAttribute('cp_nama', 'en');
    //         $data->cp_alamat = $data->getTranslatedAttribute('cp_alamat', 'en');
    //         $data->nama = $data->getTranslatedAttribute('nama', 'en');
    //         $data->ketersediaan_pasar = $data->getTranslatedAttribute('ketersediaan_pasar', 'en');
    //         $data->ketersediaan_sd = $data->getTranslatedAttribute('ketersediaan_sd', 'en');
    //         $data->desain_layout_project = $data->getTranslatedAttribute('desain_layout_project', 'en');
    //         $data->rincian_investasi = $data->getTranslatedAttribute('rincian_investasi', 'en');
    //     }
    //     return response()->json($proyek, 200);
    // }

    // public function ensearchsektor(Request $request){
    //     $proyek = ProyekInvestasi::with('sektor')->where('sektor_id', $request->sektor)->where('sektor_id', $request->sektor)->where('status', 1)->with(['kabKota'=>function($q){
    //         $q->select('id', 'nama')->with('nama');
    //     }])
    //     ->where('nama', 'like', "%".$request->nama."%")->paginate(5)->appends(request()->query());
    //     foreach($proyek as $data){
    //         $data->location = $data->getCoordinates();
    //         foreach($data->location as $loc){
    //             $ok = [
    //                 'lat' => $loc['lat'],
    //                 'lng' => $loc['lng']
    //             ];
    //             $data->location = $ok;
    //         }
    //         $data->nama_kota = $data->kabKota->nama[0]->nama;
    //         $data->file_keuangan = json_decode($data->file_keuangan);
    //         $data->fotos = json_decode($data->fotos);
    //         if($data->fotos!=null){
    //             $arrfoto = [];
    //             foreach($data->fotos as $img){
    //                 $tmp = url('storage/'.str_replace('\\', '/', $img));
    //                 array_push($arrfoto, $tmp);
    //             }
    //             $data->fotos = $arrfoto;
    //         }

    //         // Translate
    //         $data->latar_belakang = $data->getTranslatedAttribute('latar_belakang', 'en');
    //         $data->lingkup_pekerjaan = $data->getTranslatedAttribute('lingkup_pekerjaan', 'en');
    //         $data->eksisting = $data->getTranslatedAttribute('eksisting', 'en');
    //         $data->status_kepemilikan = $data->getTranslatedAttribute('status_kepemilikan', 'en');
    //         $data->nilai_investasi = $data->getTranslatedAttribute('nilai_investasi', 'en');
    //         $data->skema_investasi = $data->getTranslatedAttribute('skema_investasi', 'en');
    //         $data->npv = $data->getTranslatedAttribute('npv', 'en');
    //         $data->playback_period = $data->getTranslatedAttribute('playback_period', 'en');
    //         $data->cp_nama = $data->getTranslatedAttribute('cp_nama', 'en');
    //         $data->cp_alamat = $data->getTranslatedAttribute('cp_alamat', 'en');
    //         $data->nama = $data->getTranslatedAttribute('nama', 'en');
    //         $data->ketersediaan_pasar = $data->getTranslatedAttribute('ketersediaan_pasar', 'en');
    //         $data->ketersediaan_sd = $data->getTranslatedAttribute('ketersediaan_sd', 'en');
    //         $data->desain_layout_project = $data->getTranslatedAttribute('desain_layout_project', 'en');
    //         $data->rincian_investasi = $data->getTranslatedAttribute('rincian_investasi', 'en');
    //     }
    //     return response()->json($proyek, 200);
    // }

    // public function engetproyek(){
    //     $proyek = ProyekInvestasi::with('sektor')->where('status', 1)->with(['kabKota'=>function($q){
    //         $q->select('id', 'nama')->with('nama');
    //     }])->paginate(5)->appends(request()->query());
    //     $cart = CountInterest::where('user_id', Auth()->user()->id)
    //     ->where('model', 'App/Models/Investasi/ProyekInvestasi')->pluck('proyek_id')->toArray();
    //     foreach($proyek as $data){
    //         $data->location = $data->getCoordinates();
    //         foreach($data->location as $loc){
    //             $ok = [
    //                 'lat' => $loc['lat'],
    //                 'lng' => $loc['lng']
    //             ];
    //             $data->location = $ok;
    //         }
    //         $data->nama_kota = $data->kabKota->nama[0]->nama;
    //         $data->file_keuangan = json_decode($data->file_keuangan);
    //         $data->fotos = json_decode($data->fotos);
    //         if($data->fotos!=null){
    //             $arrfoto = [];
    //             foreach($data->fotos as $img){
    //                 $tmp = url('storage/'.str_replace('\\', '/', $img));
    //                 array_push($arrfoto, $tmp);
    //             }
    //             $data->fotos = $arrfoto;
    //         }
    //         if(in_array($data->id, $cart)){
    //             $data->love = true;
    //         }
    //         else{
    //             $data->love = false;
    //         }

    //         // Translate
    //         $data->latar_belakang = $data->getTranslatedAttribute('latar_belakang', 'en');
    //         $data->lingkup_pekerjaan = $data->getTranslatedAttribute('lingkup_pekerjaan', 'en');
    //         $data->eksisting = $data->getTranslatedAttribute('eksisting', 'en');
    //         $data->status_kepemilikan = $data->getTranslatedAttribute('status_kepemilikan', 'en');
    //         $data->nilai_investasi = $data->getTranslatedAttribute('nilai_investasi', 'en');
    //         $data->skema_investasi = $data->getTranslatedAttribute('skema_investasi', 'en');
    //         $data->npv = $data->getTranslatedAttribute('npv', 'en');
    //         $data->playback_period = $data->getTranslatedAttribute('playback_period', 'en');
    //         $data->cp_nama = $data->getTranslatedAttribute('cp_nama', 'en');
    //         $data->cp_alamat = $data->getTranslatedAttribute('cp_alamat', 'en');
    //         $data->nama = $data->getTranslatedAttribute('nama', 'en');
    //         $data->ketersediaan_pasar = $data->getTranslatedAttribute('ketersediaan_pasar', 'en');
    //         $data->ketersediaan_sd = $data->getTranslatedAttribute('ketersediaan_sd', 'en');
    //         $data->desain_layout_project = $data->getTranslatedAttribute('desain_layout_project', 'en');
    //         $data->rincian_investasi = $data->getTranslatedAttribute('rincian_investasi', 'en');
    //     }
    //     return response()->json($proyek, 200);
    // }

    // public function enproyekinterest(Request $request){
    //     if($request->kab_kota_id==0 && $request->sektor_id==0){
    //         $proyek = ProyekInvestasi::where('status', 1)->with('sektor')->where('market_id', 1)->paginate(5)->appends(request()->query());
    //     }
    //     elseif($request->kab_kota_id==0){
    //         $proyek = ProyekInvestasi::where('sektor_id', $request->sektor_id)
    //             ->where('status', 1)->with('sektor')
    //             ->paginate(5)->appends(request()->query());
    //     }
    //     elseif($request->sektor_id==0){
    //         $proyek = ProyekInvestasi::where('status', 1)->with('sektor')
    //             ->where('kab_kota_id', $request->kab_kota_id)
    //             ->paginate(5)->appends(request()->query());
    //     }
    //     else{
    //         $proyek = ProyekInvestasi::where('status', 1)->with('sektor')
    //         ->where('kab_kota_id', $request->kab_kota_id)
    //         ->where('sektor_id', $request->sektor_id)
    //         ->paginate(5)->appends(request()->query());
    //     }
    //     $cart = CountInterest::where('user_id', Auth()->user()->id)
    //     ->where('model', 'App/Models/Investasi/ProyekInvestasi')->pluck('proyek_id')->toArray();
    //     foreach($proyek as $data){
    //         $data->location = $data->getCoordinates();
    //         foreach($data->location as $loc){
    //             $ok = [
    //                 'lat' => $loc['lat'],
    //                 'lng' => $loc['lng']
    //             ];
    //             $data->location = $ok;
    //         }
    //         $data->file_keuangan = json_decode($data->file_keuangan);
    //         $data->fotos = json_decode($data->fotos);
    //         $data->nama_kota = $data->kabKota->nama[0]->nama;
    //         if($data->fotos!=null){
    //             $arrfoto = [];
    //             foreach($data->fotos as $img){
    //                 $tmp = url('storage/'.str_replace('\\', '/', $img));
    //                 array_push($arrfoto, $tmp);
    //             }
    //             $data->fotos = $arrfoto;
    //         }
    //         if(in_array($data->id, $cart)){
    //             $data->love = true;
    //         }
    //         else{
    //             $data->love = false;
    //         }

    //         // Translate
    //         $data->latar_belakang = $data->getTranslatedAttribute('latar_belakang', 'en');
    //         $data->lingkup_pekerjaan = $data->getTranslatedAttribute('lingkup_pekerjaan', 'en');
    //         $data->eksisting = $data->getTranslatedAttribute('eksisting', 'en');
    //         $data->status_kepemilikan = $data->getTranslatedAttribute('status_kepemilikan', 'en');
    //         $data->nilai_investasi = $data->getTranslatedAttribute('nilai_investasi', 'en');
    //         $data->skema_investasi = $data->getTranslatedAttribute('skema_investasi', 'en');
    //         $data->npv = $data->getTranslatedAttribute('npv', 'en');
    //         $data->playback_period = $data->getTranslatedAttribute('playback_period', 'en');
    //         $data->cp_nama = $data->getTranslatedAttribute('cp_nama', 'en');
    //         $data->cp_alamat = $data->getTranslatedAttribute('cp_alamat', 'en');
    //         $data->nama = $data->getTranslatedAttribute('nama', 'en');
    //         $data->ketersediaan_pasar = $data->getTranslatedAttribute('ketersediaan_pasar', 'en');
    //         $data->ketersediaan_sd = $data->getTranslatedAttribute('ketersediaan_sd', 'en');
    //         $data->desain_layout_project = $data->getTranslatedAttribute('desain_layout_project', 'en');
    //         $data->rincian_investasi = $data->getTranslatedAttribute('rincian_investasi', 'en');
    //     }
    //     return response()->json($proyek, 200);
    // }
}
