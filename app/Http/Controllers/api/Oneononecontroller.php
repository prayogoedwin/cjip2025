<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CJIBF\CountInterest;
use App\Models\CJIBF\JadwalVidcon;
use App\Models\CJIBF\OneOnOne;
use App\Models\CJIBF\Webinar;
use Illuminate\Support\Facades\Mail;
use App\Models\CJIBF\CountRegistration;
use App\Mail\RegisterCJIBF;

class Oneononecontroller extends Controller
{
    public function findproyek(){
        $o3m = OneOnOne::where('user_id', Auth()->user()->id)->get();
        $interested = CountInterest::where('user_id', Auth()->user()->id)->with(['proyek' => function($q){
            $q->select('id', 'project_name', 'sektor_id', 'market_id', 'fotos')->with('bySector');
        }])->get();
        $jadwals = JadwalVidcon::all();
        // return $jadwals;

        $o3mproyek = [];
        foreach($interested->where('model', 'App/Models/Investasi/Proyek')->groupBy(['group', 'kab_kota_id']) as $group => $interestss){
            $arr = [];
            $arr1 = [];
            $arr2 = [];
            foreach($interestss as $kabkota => $interests){
                foreach($interests as $interest){
                    // echo $interest;
                    array_push($arr, $interest);

                    foreach($jadwals->where('kab_kota_id', $kabkota)->groupBy('tanggal') as $tanggal => $jadwal){
                        if(isset($jadwal)){
                            // echo \Carbon\Carbon::parse($tanggal)->format('D, d-m-Y');
                            $tgl = \Carbon\Carbon::parse($tanggal)->format('D, d-m-Y');
                            array_push($arr1, $tgl);
                            foreach($jadwal as $jam){
                                // echo $jam;
                                $jam->pilihan = false;
                                array_push($arr2, $jam);
                            }
                        }
                    }
                }
            }

            $foto = json_decode($arr[0]->proyek->fotos);
            $tmp = [
                'foto' => url('storage/'.str_replace('\\', '/', $foto[0])),
                'proyek' => $arr[0]->proyek,
                'id_project' => $arr[0]->proyek->id,
                'kota' => $arr[0]->group,
                'tanggal' => $arr1[0],
                'jam' => $arr2
            ];
            // return $tmp;
            array_push($o3mproyek, $tmp);
        }
        return response()->json($o3mproyek, 200);
    }

    public function findkawasan(){
        $o3m = OneOnOne::where('user_id', Auth()->user()->id)->get();
        $interested = CountInterest::where('user_id', Auth()->user()->id)->with(['proyekKi' => function($q){
            $q->select('id', 'nama_kawasan_industri', 'foto');
        }])->get();
        $jadwals = JadwalVidcon::all();

        $o3mkawasan = [];
        foreach($interested->where('model', 'App/Models/KI/KawasanIndustri')->groupBy(['group', 'kab_kota_id']) as $group => $interest_kiss){
            $arr = [];
            $arr1 = [];
            $arr2 = [];
            foreach($interest_kiss as $kabkota => $interest_kis){
                foreach($interest_kis as $interest_ki){
                    array_push($arr, $interest_ki);
                    foreach($jadwals->where('kab_kota_id', $kabkota)->groupBy('tanggal') as $tanggal => $jadwal){
                        if(isset($jadwal)){
                            $tgl = \Carbon\Carbon::parse($tanggal)->format('D, d-m-Y');
                            array_push($arr1, $tgl);
                            foreach($jadwal as $jam){
                                $jam->pilihan = false;
                                array_push($arr2, $jam);
                            }
                        }
                    }
                }
            }
            // $foto = $arr[0]->proyek
            $tmp = [
                'foto' => url('storage/'.str_replace('\\', '/', $arr[0]->proyekKi->foto)),
                'nama_kawasan' => $arr[0]->proyekKi->nama_kawasan_industri,
                'id_project' => $arr[0]->proyekKi->id,
                'kota' => $arr[0]->group,
                'tanggal' => $arr1[0],
                'jam' => $arr2
            ];
            // return $tmp;
            array_push($o3mkawasan, $tmp);
        }
        return response()->json($o3mkawasan);
    }

    public function findother(Request $request){
        $o3m = OneOnOne::where('user_id', Auth()->user()->id)->get();
        $interested = CountInterest::where('user_id', Auth()->user()->id)->with(['manual' => function($q){
            $q->select('id', 'project');
        }])->get();
        $jadwals = JadwalVidcon::all();

        $o3mother = [];
        foreach($interested->where('model', 'App/Models/Investasi/ManualProjects')->groupBy(['group', 'kab_kota_id']) as $group => $interests){
            $arr = [];
            $arr1 = [];
            $arr2 = [];
            foreach($interests as $kabkota => $interests){
                foreach($interests as $interest){
                    array_push($arr, $interest);
                }
                foreach($jadwals->where('kab_kota_id', $kabkota)->groupBy('tanggal') as $tanggal => $jadwal){
                    if(isset($jadwal)){
                        $tgl = \Carbon\Carbon::parse($tanggal)->format('D, d-m-Y');
                        array_push($arr1, $tgl);
                        foreach($jadwal as $jam){
                            $jam->pilihan = false;
                            array_push($arr2, $jam);
                        }
                    }
                }
            }
            $tmp = [
                'nama' => $arr[0]->manual->project,
                'id_project' => $arr[0]->manual->id,
                'kota' => $arr[0]->group,
                'tanggal' => $arr1[0],
                'jam' => $arr2
            ];
            // return $tmp;
            array_push($o3mother, $tmp);
        }
        return response()->json($o3mother);
    }

    public function store(Request $request){
        $count = count(json_decode($request->description));
        if($count>0){
            $req = json_decode($request->description);
            foreach($req as $data){
                $meet = new OneOnOne();
                $meet->user_id = Auth()->user()->id;
                $meet->project_id = $data->project_id;
                $meet->kab_kota_id = $data->kab_kota_id;
                $meet->meeting_id = $data->meeting_id;
                $meet->save();

                $jadwal = JadwalVidcon::findOrFail($data->meeting_id);
                $jadwal->status = 1;
                $jadwal->update();
            }

            $user_id = Auth()->user()->id;
            $email = Auth()->user()->email;
            $o3m = OneOnOne::where('user_id', $user_id)->get();
            $webinar = Webinar::first();

            Mail::to($email)->send(new RegisterCJIBF($o3m, $webinar));

            $monitor = new CountRegistration();
            $monitor->user_id = Auth()->user()->id;
            if (!empty($o3m)){
                $monitor->is_o3m = 1;
            }
            $monitor->save();

            return response()->json([
                'success' => true,
                'message' => 'Registration Success'
            ], 200);
        }
        else{
            return response()->json([
                'success' => false,
                'message' => 'Data kosong'
            ], 400);
        }
    }

    public function get(){
        $o3m = Oneonone::where('user_id', Auth()->user()->id)->with('meeting')->with(['kota'=>function($q){
            $q->select('id')->with('namakota');
        }])->get();
        $arr = [];
        foreach($o3m as $data){
            if(isset($data->kota->namakota[0])){
                $kota = $data->kota->namakota[0]->nama;
            }
            else{
                $kota = "Industrial Area";
            }
            $tmp = [
                'kota' => $kota,
                'zoom_id' => $data->meeting->meeting_id,
                'passcode' => $data->meeting->passcode
            ];
            array_push($arr, $tmp);
        }
        return response()->json($arr, 200);
    }
}
