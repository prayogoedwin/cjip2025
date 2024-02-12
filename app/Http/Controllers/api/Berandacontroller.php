<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\General\Berita;
use App\Models\Investasi\KawasanIndustri;
use Illuminate\Http\Request;


class Berandacontroller extends Controller
{
    public function berita(){
        $berita = Berita::offset(0)->limit(3)->orderBy('id', 'DESC')->get();
        foreach($berita as $data){
            $data->image = url('storage/'.str_replace('\\', '/', $data->image));
            $data->body = str_replace("\n", "", $data->body);
        }
        return response()->json($berita);
    }

    public function kawasan(){
        $kawasan = KawasanIndustri::inRandomOrder()->take(3)->get();
        // foreach($kawasan as $data){
        //     $data->foto = url('storage/'.str_replace('\\', '/', $data->foto));
        //     // $data->lokasi = $data->getCoordinates();
        //     $data->profil = json_decode($data->profil);
        //     $data->produk = json_decode($data->produk);
        //     $data->infrastruktur_industri = json_decode($data->infrastruktur_industri);
        //     $data->infrastruktur_penunjang = json_decode($data->infrastruktur_penunjang);
        //     $data->infrastruktur_dasar = json_decode($data->infrastruktur_dasar);
        //     $data->tenant = json_decode($data->tenant);
        //     $str = 'AB';
        //     foreach($data->tenant as $tnn){
        //         $tnn->nama = $str++;
        //     }
        //     // foreach($data->lokasi as $loc){
        //     //     $ok = [
        //     //         'lat' => $loc['lat'],
        //     //         'lng' => $loc['lng']
        //     //     ];
        //     //     $data->lokasi = $ok;
        //     // }
        // }
        return response()->json($kawasan);
    }

    // -------------------------------------------EN----------------------------------------------------------

    // public function enberita(){
    //     $berita = Berita::offset(0)->limit(4)->orderBy('id', 'DESC')->get();
    //     foreach($berita as $data){
    //         $data->image = url('storage/'.str_replace('\\', '/', $data->image));
    //         $data->body = str_replace("\n", "", $data->getTranslatedAttribute('body', 'en'));
    //         $data->title = $data->getTranslatedAttribute('title', 'en');
    //         $data->meta_description = $data->translations[4]->value;
    //     }
    //     return response()->json($berita, 200);
    // }

    // public function enkawasan(){
    //     $kawasan = KawasanIndustri::inRandomOrder()->take(3)->get();
    //     foreach($kawasan as $data){
    //         $data->foto = url('storage/'.str_replace('\\', '/', $data->foto));
    //         $data->lokasi = $data->getCoordinates();
    //         $data->profil = json_decode($data->profil);
    //         $data->produk = json_decode($data->produk);
    //         $data->infrastruktur_industri = json_decode($data->infrastruktur_industri);
    //         $data->infrastruktur_penunjang = json_decode($data->infrastruktur_penunjang);
    //         $data->infrastruktur_dasar = json_decode($data->infrastruktur_dasar);
    //         $data->tenant = json_decode($data->tenant);
    //         $str = 'AB';
    //         foreach($data->tenant as $tnn){
    //             $tnn->nama = $str++;
    //         }

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

    //         $str = 'AB';
    //         foreach($data->tenant as $tnn){
    //             $tnn->nama = $str++;
    //         }

    //         $data->nama_kawasan_industri = $data->getTranslatedAttribute('nama_kawasan_industri', 'en');

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
}
