<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Investasi\ProyekInvestasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use TCG\Voyager\Facades\Voyager;
use Cornford\Googlmapper\Facades\MapperFacade as Mapper;
use App\Proyek;

class ConsuloanController extends Controller
{
    //
    public function settings(){
        $settings= Voyager::model('Setting')->all();
        return response()->json($settings);
    }

    public function map(){
        $proyeks = ProyekInvestasi::where('status', 1)->get();

        foreach ($proyeks as $proyek){
            $images = json_decode($proyek->fotos);
        }

        Mapper::location('Central Java')->map(['zoom' => 8, 'center' => true, 'marker' => false, 'type' => 'ROAD']);

        foreach ($proyeks as $proyek){
            $images = json_decode($proyek->fotos);
            //dd($images[0]);
            //dd(json_encode($proyek->getCoordinates()));
            //dump($images);
            $array = $proyek->getCoordinates();
            //dd((float)$array[0]['lat']);

            if ($proyek->marketplace->name == 'Ready to Offer'){
                Mapper::informationWindow((float)$array[0]['lat'], (float)$array[0]['lng'], '<div id="iw-container">'.
                    '<div class="iw-title">'.$proyek->marketplace->name.'</div>'.
                    '<div class="iw-content">'.
                    '<div class="iw-subTitle">'.$proyek->translate('en')->project_name.'</div>' .
                    '<img src='.'"'.Voyager::image($images[0]).'"'.' alt='.'"'.$proyek->translate('en')->project_name.'"'.' height="115" width="83">' .
                    '<p>'.$proyek->translate('en')->latar_belakang.'</p>'.
                    '<div class="iw-subTitle"><a style="font-weight: 300;color: #c82333" href='.'"/home#/project/'.$proyek->id.'"'.'>Detail</a></div>' .
                    '</div>' .
                    '<div class="iw-bottom-gradient"></div>' .
                    '</div>',
                    ['icon' => 'http://cjip.jatengprov.go.id/storage/additional/ICON/readys.png']
                );
            }
            elseif ($proyek->marketplace->name == 'Prospective Project'){
                Mapper::informationWindow((float)$array[0]['lat'], (float)$array[0]['lng'], '<div id="iw-container">'.
                    '<div class="iw-title">'.$proyek->marketplace->name.'</div>'.
                    '<div class="iw-content">'.
                    '<div class="iw-subTitle">'.$proyek->translate('en')->project_name.'</div>' .
                    '<img src='.'"'.Voyager::image($images[0]).'"'.' alt='.'"'.$proyek->translate('en')->project_name.'"'.' height="115" width="83">' .
                    '<p>'.$proyek->translate('en')->latar_belakang.'</p>'.
                    '<div class="iw-subTitle"><a style="font-weight: 300;color: #c82333" href='.'"/home#/project/'.$proyek->id.'"'.'>Detail</a></div>' .
                    '</div>' .
                    '<div class="iw-bottom-gradient"></div>' .
                    '</div>',
                    ['icon' => 'http://cjip.jatengprov.go.id/storage/additional/ICON/prospectives.png']
                );
            }
            else{
                Mapper::informationWindow((float)$array[0]['lat'], (float)$array[0]['lng'], '<div id="iw-container">'.
                    '<div class="iw-title">'.$proyek->marketplace->name.'</div>'.
                    '<div class="iw-content">'.
                    '<div class="iw-subTitle">'.$proyek->translate('en')->project_name.'</div>' .
                    '<img src='.'"'.Voyager::image($images[0]).'"'.' alt='.'"'.$proyek->translate('en')->project_name.'"'.' height="115" width="83">' .
                    '<p>'.$proyek->translate('en')->latar_belakang.'</p>'.
                    '<div class="iw-subTitle"><a style="font-weight: 300;color: #c82333" href='.'"/home#/project/'. $proyek->id.'"'.'>Detail</a></div>' .
                    '</div>' .
                    '<div class="iw-bottom-gradient"></div>' .
                    '</div>',
                    ['icon' => 'http://cjip.jatengprov.go.id/storage/additional/ICON/potentials.png']
                );
            }


        }
        //die();

        //dd($array);
        $mapsKey = 'AIzaSyBGsawbqVs083lGEe8cilVz0FqO0rHt5ZE&amp';

        // return view('front-end.marketplace.bylocation', compact('array', 'mapsKey'));
        $render = Mapper::render();
        return response($render);
    }
}
