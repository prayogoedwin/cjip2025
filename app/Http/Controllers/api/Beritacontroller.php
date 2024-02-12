<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\General\Berita;
use Illuminate\Http\Request;

class Beritacontroller extends Controller
{
    public function berita()
    {
        $berita = Berita::orderBy('id', 'DESC')->paginate(5);
        foreach ($berita as $data) {
            $data->image = url('storage/' . str_replace('\\', '/', $data->image));
            $data->body = str_replace("\n", "", $data->body);
        }
        return response()->json($berita, 200);
    }

    // ----------------------------------------------EN------------------------------------------------

    // public function enberita()
    // {
    //     $berita = Berita::orderBy('created_at', 'desc')->paginate(5);
    //     foreach ($berita as $data) {
    //         /* dump([
    //             'id_berita' => $data->id,
    //             'trans' => $data->translations
    //         ]);*/
    //         $data->image = url('storage/' . str_replace('\\', '/', $data->image));
    //         $data->body = str_replace("\n", "", $data->getTranslatedAttribute('body', 'en'));
    //         $data->title = $data->getTranslatedAttribute('title', 'en');
    //         //dd(isset($data->translations));

    //         $data->meta_description = $data->translations[4]->value;
    //     }
    //     //die();
    //     return response()->json($berita, 200);
    // }
}
