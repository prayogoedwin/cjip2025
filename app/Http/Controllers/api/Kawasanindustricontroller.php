<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Livewire\KI\KawasanIndustri as KIKawasanIndustri;
use App\Models\Cjibf\CountInterest;
use Illuminate\Http\Request;
use App\Models\Investasi\KawasanIndustri;
use Illuminate\Support\Facades\Auth;

class Kawasanindustricontroller extends Controller
{
    public function ki(){
        $kawasan = KawasanIndustri::paginate(5);
        // $cart = CountInterest::where('user_id', Auth()->user()->id)->where('model', 'App/Models/Investasi/KawasanIndustri')->pluck('proyek_id')->toArray();
        foreach($kawasan as $data){
            $data->foto = url('storage/'.str_replace('\\', '/', $data->foto));
            // $data->lokasi = $data->getCoordinates();
            $data->profil = json_decode($data->profil);
            $data->produk = json_decode($data->produk);
            $data->infrastruktur_industri = json_decode($data->infrastruktur_industri);
            $data->infrastruktur_penunjang = json_decode($data->infrastruktur_penunjang);
            $data->infrastruktur_dasar = json_decode($data->infrastruktur_dasar);
            $data->tenant = json_decode($data->tenant);
            $str = 'AB';
            foreach($data->tenant as $tnn){
                $tnn->nama = $str++;
            }
            // foreach($data->lokasi as $loc){
            //     $ok = [
            //         'lat' => $loc['lat'],
            //         'lng' => $loc['lng']
            //     ];
            //     $data->lokasi = $ok;
            // }
            // if(in_array($data->id, $cart)){
            //     $data->love = true;
            // }
            // else{
            //     $data->love = false;
            // }
        }
        return response()->json($kawasan, 200);
    }

    public function ki2(){
        $kawasan = KawasanIndustri::paginate(5);
        foreach($kawasan as $data){
            $data->foto = url('storage/'.str_replace('\\', '/', $data->foto));
            // $data->lokasi = $data->getCoordinates();
            $data->lokasi = json_decode($data->lokasi);
            $data->profil = json_decode($data->profil);
            $data->produk = json_decode($data->produk);
            $data->infrastruktur_industri = json_decode($data->infrastruktur_industri);
            $data->infrastruktur_penunjang = json_decode($data->infrastruktur_penunjang);
            $data->infrastruktur_dasar = json_decode($data->infrastruktur_dasar);
            $data->tenant = json_decode($data->tenant);
            $str = 'AB';
            foreach($data->tenant as $tnn){
                $tnn->nama = $str++;
            }
            // foreach($data->lokasi as $loc){
            //     $ok = [
            //         'lat' => $loc['lat'],
            //         'lng' => $loc['lng']
            //     ];
            //     $data->lokasi = $ok;
            // }
        }
        return response()->json($kawasan, 200);
    }

    // public function addtocart(Request $request){
    //     $ki = KawasanIndustri::where('id', $request->id)->first();
    //     $interest = new CountInterest();
    //     $interest->model = 'App/Models/Investasi/KawasanIndustri';
    //     $interest->proyek_id = $request->id;
    //     $interest->user_id = Auth()->user()->id;
    //     $interest->group = 'Kawasan Industri';
    //     $interest->kab_kota_id = $ki->user_id;
    //     $interest->save();

    //     return response()->json([
    //         'success' => true,
    //         'message' => 'Proyek berhasil ditambahkan'
    //     ], 200);
    // }

    // public function remove(Request $request)
    // {
    //     // $interest = CountInterest::findOrFail($productId);
    //     $interest = CountInterest::where(["user_id" => Auth()->user()->id, "model"=>'App/Models/Investasi/KawasanIndustri', 'proyek_id'=>$request->id])->first();
    //     // dd($interest);
    //     if($interest){
    //         $interest->delete();
    //         // Cart::remove($interest->id);
    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Proyek berhasil dihapus'
    //         ], 200);
    //     }
    //     else{
    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Proyek gagal dihapus'
    //         ], 400);
    //     }
    // }

    // public function cart(){
    //     $cart = CountInterest::where('user_id', Auth()->user()->id)
    //     ->where('model', 'App/Models/Investasi/KawasanIndustri')->with(['proyekkI'=>function($q){
    //         $q->select('id', 'nama', 'foto');
    //     }])->get();
    //     foreach($cart as $data){
    //         $data->proyekkI->foto = url('storage/'.str_replace('\\', '/', $data->proyekkI->foto));
    //     }
    //     return response()->json($cart, 200);
    // }

    // public function destroy(Request $request){
    //     CountInterest::destroy($request->id);
    //     return response()->json([
    //         'status' => true,
    //         'message' => 'Cart proyek berhasil dihapus'
    //     ], 200);
    // }

    public function search(Request $request){
        $kawasan = KawasanIndustri::where('nama', 'like', "%".$request->nama."%")->paginate(5);
        foreach($kawasan as $data){
            $data->foto = url('storage/'.str_replace('\\', '/', $data->foto));
            // $data->lokasi = $data->getCoordinates();
            $data->profil = json_decode($data->profil);
            $data->produk = json_decode($data->produk);
            $data->infrastruktur_industri = json_decode($data->infrastruktur_industri);
            $data->infrastruktur_penunjang = json_decode($data->infrastruktur_penunjang);
            $data->infrastruktur_dasar = json_decode($data->infrastruktur_dasar);
            $data->tenant = json_decode($data->tenant);
            // foreach($data->lokasi as $loc){
            //     $ok = [
            //         'lat' => $loc['lat'],
            //         'lng' => $loc['lng']
            //     ];
            //     $data->lokasi = $ok;
            // }
        }
        return response()->json($kawasan, 200);
    }

    // ----------------------------------------EN-------------------------------------------------------------------

    // public function enki2(){
    //     $kawasan = KawasanIndustri::paginate(5);
    //     foreach($kawasan as $data){
    //         $data->foto = url('storage/'.str_replace('\\', '/', $data->foto));
    //         $data->lokasi = $data->getCoordinates();
    //         $data->profil = json_decode($data->profil);
    //         $data->produk = json_decode($data->produk);
    //         $data->infrastruktur_industri = json_decode($data->infrastruktur_industri);
    //         $data->infrastruktur_penunjang = json_decode($data->infrastruktur_penunjang);
    //         $data->infrastruktur_dasar = json_decode($data->infrastruktur_dasar);
    //         $data->tenant = json_decode($data->tenant);

    //         if(isset($data->translations[1]->value)){
    //             $kawasanEn = json_decode($data->translations[1]->value);
    //             $data->profil->perusahaan = $kawasanEn->perusahaan;
    //             $data->profil->kawasan_industri = $kawasanEn->kawasan_industri;
    //         }

    //         if(isset($data->translations[3])){
    //             $masterplanEn = json_decode($data->translations[3]);
    //             $data->masterplan = $masterplanEn->value;
    //         }

    //         if(isset($data->translations[4]->value)){
    //             $productEn = json_decode($data->translations[4]->value);
    //             $data->produk->lahan_siap_bangun = $productEn->lahan_siap_bangun;
    //             $data->produk->bangunan_pabrik_siap_pakai = $productEn->bangunan_pabrik_siap_pakai;
    //             $data->produk->produk_lainnya = $productEn->produk_lainnya;
    //         }

    //         if(isset($data->translations[5]->value)){
    //             $industriEn = json_decode($data->translations[5]->value);
    //             $data->infrastruktur_industri->jaringan_energi_kelistrikan = $industriEn->jaringan_energi_kelistrikan;
    //             $data->infrastruktur_industri->jaringan_telekomunikasi = $industriEn->jaringan_telekomunikasi;
    //             $data->infrastruktur_industri->jaringan_sda_pasokan_air_baku = $industriEn->jaringan_sda_pasokan_air_baku;
    //             $data->infrastruktur_industri->sanitasi = $industriEn->sanitasi;
    //             $data->infrastruktur_industri->jaringan_transportasi = $industriEn->jaringan_transportasi;
    //         }

    //         if(isset($data->translations[6]->value)){
    //             $penunjangEn = json_decode($data->translations[6]->value);
    //             $data->infrastruktur_penunjang->perumahan = $penunjangEn->perumahan;
    //             $data->infrastruktur_penunjang->pendidikan_pelatihan = $penunjangEn->pendidikan_pelatihan;
    //             $data->infrastruktur_penunjang->penelitian_pengembangan = $penunjangEn->penelitian_pengembangan;
    //             $data->infrastruktur_penunjang->kesehatan = $penunjangEn->kesehatan;
    //             $data->infrastruktur_penunjang->pemadam_kebakaran = $penunjangEn->pemadam_kebakaran;
    //             $data->infrastruktur_penunjang->tempat_pembuangan_sampah = $penunjangEn->tempat_pembuangan_sampah;
    //         }

    //         if(isset($data->translations[7]->value)){
    //             $dasarEn = json_decode($data->translations[7]->value);
    //             $data->infrastruktur_dasar->instalasi_pengolahan_air_baku = $dasarEn->instalasi_pengolahan_air_baku;
    //             $data->infrastruktur_dasar->instalasi_pengolahan_air_limbah = $dasarEn->instalasi_pengolahan_air_limbah;
    //             $data->infrastruktur_dasar->saluran_drainase = $dasarEn->saluran_drainase;
    //             $data->infrastruktur_dasar->instalasi_penerangan_jalan = $dasarEn->instalasi_penerangan_jalan;
    //             $data->infrastruktur_dasar->jaringan_jalan = $dasarEn->jaringan_jalan;
    //         }

    //         if(isset($data->translations[8])){
    //             $lainEn = json_decode($data->translations[8]);
    //             $data->fasilitas_lain = $lainEn->value;
    //         }

    //         $data->nama = $data->getTranslatedAttribute('nama', 'en');

    //         $str = 'AB';
    //         foreach($data->tenant as $tnn){
    //             $tnn->nama = $str++;
    //         }
    //         foreach($data->lokasi as $loc){
    //             $ok = [
    //                 'lat' => $loc['lat'],
    //                 'lng' => $loc['lng']
    //             ];
    //             $data->lokasi = $ok;
    //         }
    //     }
    //     return response()->json($kawasan, 200);
    // }

    // public function ensearch(Request $request){
    //     $kawasan = KawasanIndustri::where('nama', 'like', "%".$request->nama."%")->paginate(5);
    //     foreach($kawasan as $data){
    //         $data->foto = url('storage/'.str_replace('\\', '/', $data->foto));
    //         $data->lokasi = $data->getCoordinates();
    //         $data->profil = json_decode($data->profil);
    //         $data->produk = json_decode($data->produk);
    //         $data->infrastruktur_industri = json_decode($data->infrastruktur_industri);
    //         $data->infrastruktur_penunjang = json_decode($data->infrastruktur_penunjang);
    //         $data->infrastruktur_dasar = json_decode($data->infrastruktur_dasar);
    //         $data->tenant = json_decode($data->tenant);

    //         if(isset($data->translations[1]->value)){
    //             $kawasanEn = json_decode($data->translations[1]->value);
    //             $data->profil->perusahaan = $kawasanEn->perusahaan;
    //             $data->profil->kawasan_industri = $kawasanEn->kawasan_industri;
    //         }

    //         if(isset($data->translations[3])){
    //             $masterplanEn = json_decode($data->translations[3]);
    //             $data->masterplan = $masterplanEn->value;
    //         }

    //         if(isset($data->translations[4]->value)){
    //             $productEn = json_decode($data->translations[4]->value);
    //             $data->produk->lahan_siap_bangun = $productEn->lahan_siap_bangun;
    //             $data->produk->bangunan_pabrik_siap_pakai = $productEn->bangunan_pabrik_siap_pakai;
    //             $data->produk->produk_lainnya = $productEn->produk_lainnya;
    //         }

    //         if(isset($data->translations[5]->value)){
    //             $industriEn = json_decode($data->translations[5]->value);
    //             $data->infrastruktur_industri->jaringan_energi_kelistrikan = $industriEn->jaringan_energi_kelistrikan;
    //             $data->infrastruktur_industri->jaringan_telekomunikasi = $industriEn->jaringan_telekomunikasi;
    //             $data->infrastruktur_industri->jaringan_sda_pasokan_air_baku = $industriEn->jaringan_sda_pasokan_air_baku;
    //             $data->infrastruktur_industri->sanitasi = $industriEn->sanitasi;
    //             $data->infrastruktur_industri->jaringan_transportasi = $industriEn->jaringan_transportasi;
    //         }

    //         if(isset($data->translations[6]->value)){
    //             $penunjangEn = json_decode($data->translations[6]->value);
    //             $data->infrastruktur_penunjang->perumahan = $penunjangEn->perumahan;
    //             $data->infrastruktur_penunjang->pendidikan_pelatihan = $penunjangEn->pendidikan_pelatihan;
    //             $data->infrastruktur_penunjang->penelitian_pengembangan = $penunjangEn->penelitian_pengembangan;
    //             $data->infrastruktur_penunjang->kesehatan = $penunjangEn->kesehatan;
    //             $data->infrastruktur_penunjang->pemadam_kebakaran = $penunjangEn->pemadam_kebakaran;
    //             $data->infrastruktur_penunjang->tempat_pembuangan_sampah = $penunjangEn->tempat_pembuangan_sampah;
    //         }

    //         if(isset($data->translations[7]->value)){
    //             $dasarEn = json_decode($data->translations[7]->value);
    //             $data->infrastruktur_dasar->instalasi_pengolahan_air_baku = $dasarEn->instalasi_pengolahan_air_baku;
    //             $data->infrastruktur_dasar->instalasi_pengolahan_air_limbah = $dasarEn->instalasi_pengolahan_air_limbah;
    //             $data->infrastruktur_dasar->saluran_drainase = $dasarEn->saluran_drainase;
    //             $data->infrastruktur_dasar->instalasi_penerangan_jalan = $dasarEn->instalasi_penerangan_jalan;
    //             $data->infrastruktur_dasar->jaringan_jalan = $dasarEn->jaringan_jalan;
    //         }

    //         if(isset($data->translations[8])){
    //             $lainEn = json_decode($data->translations[8]);
    //             $data->fasilitas_lain = $lainEn->value;
    //         }

    //         $data->nama = $data->getTranslatedAttribute('nama', 'en');

    //         foreach($data->lokasi as $loc){
    //             $ok = [
    //                 'lat' => $loc['lat'],
    //                 'lng' => $loc['lng']
    //             ];
    //             $data->lokasi = $ok;
    //         }
    //     }
    //     return response()->json($kawasan, 200);
    // }

    // public function enki(){
    //     $kawasan = KawasanIndustri::paginate(5);
    //     $cart = CountInterest::where('user_id', Auth()->user()->id)->where('model', 'App/Models/Investasi/KawasanIndustri')->pluck('proyek_id')->toArray();
    //     foreach($kawasan as $data){
    //         $data->foto = url('storage/'.str_replace('\\', '/', $data->foto));
    //         $data->lokasi = $data->getCoordinates();
    //         $data->profil = json_decode($data->profil);
    //         $data->produk = json_decode($data->produk);
    //         $data->infrastruktur_industri = json_decode($data->infrastruktur_industri);
    //         $data->infrastruktur_penunjang = json_decode($data->infrastruktur_penunjang);
    //         $data->infrastruktur_dasar = json_decode($data->infrastruktur_dasar);
    //         $data->tenant = json_decode($data->tenant);

    //         if(isset($data->translations[1]->value)){
    //             $kawasanEn = json_decode($data->translations[1]->value);
    //             $data->profil->perusahaan = $kawasanEn->perusahaan;
    //             $data->profil->kawasan_industri = $kawasanEn->kawasan_industri;
    //         }

    //         if(isset($data->translations[3])){
    //             $masterplanEn = json_decode($data->translations[3]);
    //             $data->masterplan = $masterplanEn->value;
    //         }

    //         if(isset($data->translations[4]->value)){
    //             $productEn = json_decode($data->translations[4]->value);
    //             $data->produk->lahan_siap_bangun = $productEn->lahan_siap_bangun;
    //             $data->produk->bangunan_pabrik_siap_pakai = $productEn->bangunan_pabrik_siap_pakai;
    //             $data->produk->produk_lainnya = $productEn->produk_lainnya;
    //         }

    //         if(isset($data->translations[5]->value)){
    //             $industriEn = json_decode($data->translations[5]->value);
    //             $data->infrastruktur_industri->jaringan_energi_kelistrikan = $industriEn->jaringan_energi_kelistrikan;
    //             $data->infrastruktur_industri->jaringan_telekomunikasi = $industriEn->jaringan_telekomunikasi;
    //             $data->infrastruktur_industri->jaringan_sda_pasokan_air_baku = $industriEn->jaringan_sda_pasokan_air_baku;
    //             $data->infrastruktur_industri->sanitasi = $industriEn->sanitasi;
    //             $data->infrastruktur_industri->jaringan_transportasi = $industriEn->jaringan_transportasi;
    //         }

    //         if(isset($data->translations[6]->value)){
    //             $penunjangEn = json_decode($data->translations[6]->value);
    //             $data->infrastruktur_penunjang->perumahan = $penunjangEn->perumahan;
    //             $data->infrastruktur_penunjang->pendidikan_pelatihan = $penunjangEn->pendidikan_pelatihan;
    //             $data->infrastruktur_penunjang->penelitian_pengembangan = $penunjangEn->penelitian_pengembangan;
    //             $data->infrastruktur_penunjang->kesehatan = $penunjangEn->kesehatan;
    //             $data->infrastruktur_penunjang->pemadam_kebakaran = $penunjangEn->pemadam_kebakaran;
    //             $data->infrastruktur_penunjang->tempat_pembuangan_sampah = $penunjangEn->tempat_pembuangan_sampah;
    //         }

    //         if(isset($data->translations[7]->value)){
    //             $dasarEn = json_decode($data->translations[7]->value);
    //             $data->infrastruktur_dasar->instalasi_pengolahan_air_baku = $dasarEn->instalasi_pengolahan_air_baku;
    //             $data->infrastruktur_dasar->instalasi_pengolahan_air_limbah = $dasarEn->instalasi_pengolahan_air_limbah;
    //             $data->infrastruktur_dasar->saluran_drainase = $dasarEn->saluran_drainase;
    //             $data->infrastruktur_dasar->instalasi_penerangan_jalan = $dasarEn->instalasi_penerangan_jalan;
    //             $data->infrastruktur_dasar->jaringan_jalan = $dasarEn->jaringan_jalan;
    //         }

    //         if(isset($data->translations[8])){
    //             $lainEn = json_decode($data->translations[8]);
    //             $data->fasilitas_lain = $lainEn->value;
    //         }

    //         $data->nama = $data->getTranslatedAttribute('nama', 'en');
    //         $str = 'A';
    //         foreach($data->tenant as $tnn){
    //             $tnn->nama = $str++;
    //         }
    //         foreach($data->lokasi as $loc){
    //             $ok = [
    //                 'lat' => $loc['lat'],
    //                 'lng' => $loc['lng']
    //             ];
    //             $data->lokasi = $ok;
    //         }
    //         if(in_array($data->id, $cart)){
    //             $data->love = true;
    //         }
    //         else{
    //             $data->love = false;
    //         }
    //     }
    //     return response()->json($kawasan, 200);
    // }
}
