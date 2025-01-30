<?php

namespace App\Livewire\Lokasi;

use App\Models\Cjip\JenisPpp;
use App\Models\Cjip\KawasanIndustri;
use App\Models\Cjip\ProyekInvestasi;
use App\Services\BpsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Client\RequestException;

class Peta extends Component
{
    public $location, $location1, $location2, $location3, $proyeks, $proyeks1, $proyeks2, $proyeks3, $kawasans, $pma, $pmdn, $jembatanProvinsi,
        $holtikultura, $tanamanPangan, $peternakan, $perkebunan, $perikanan;
    public $locale;
    protected $listeners = ['languageChange' => 'changeLanguange'];

    public function changeLanguange($lang)
    {
        $this->locale = $lang['lang'];
    }
    public function mount()
    {
        $bps = new BpsService;
        if (Session::get('lang')) {
            // dd(Session::get('lang'));
            if (is_array(Session::get('lang'))) {
                $this->locale = Session::get('lang')[0];
            } else {
                $this->locale = Session::get('lang');
            }
            // dd($this->locale);
        } else {
            $this->locale = 'id';
        }

        $readytoover = ProyekInvestasi::all()->where('status', '1')->where('market_id', 1);
        $prospective = ProyekInvestasi::all()->where('status', '1')->where('market_id', 2);
        $potential = ProyekInvestasi::all()->where('status', '1')->where('market_id', 3);
        $strategi = ProyekInvestasi::all()->where('status', '1')->where('market_id', 4);
        $kawasan = KawasanIndustri::all()->where('status', '1');
        $pma = DB::table('rilis')
            ->join('kabkotas', 'rilis.kab_kota_id', '=', 'kabkotas.id')
            ->select('rilis.kab_kota_id', 'kabkotas.nama', DB::raw('count(*) as total'), 'kabkotas.lat', 'kabkotas.lng')
            ->whereNotNull('rilis.kab_kota_id')
            ->whereNotNull('kabkotas.lat')
            ->whereNotNull('kabkotas.lng')
            ->where('rilis.status_pm', 'PMA')
            ->groupBy('kabkotas.id')
            ->get();
        $pmdn = DB::table('rilis')
            ->join('kabkotas', 'rilis.kab_kota_id', '=', 'kabkotas.id')
            ->select('rilis.kab_kota_id', 'kabkotas.nama', DB::raw('count(*) as total'), 'kabkotas.lat', 'kabkotas.lng')
            ->whereNotNull('rilis.kab_kota_id')
            ->whereNotNull('kabkotas.lat')
            ->whereNotNull('kabkotas.lng')
            ->where('rilis.status_pm', 'PMDN')
            ->groupBy('kabkotas.id')
            ->get();
        try {
            $response = Http::timeout(60)->get('https://webgis.dpubinmarcipka.jatengprov.go.id/api/data/jembatanprovinsi');

            if ($response->successful()) {
                $jembatan = $response->json();
            } else {
                $errorCode = $response->status();
                return $errorCode;
            }
        } catch (RequestException $e) {
            $errorCode = $e->getCode();
            $errorMessage = $e->getMessage();
            return $errorMessage;
        }

        // holtikultura bps
        $kodeHoltikultura = JenisPpp::where('kode', '55')->select('kode_data')->first();
        $holtikultura = $bps->getData($kodeHoltikultura->kode_data);

        // tanaman pangan bps
        $kodeTanamanPangan = JenisPpp::where('kode', '53')->select('kode_data')->first();
        $tanamanPangan = $bps->getTanamanPangan($kodeTanamanPangan->kode_data);

        // peternakan bps
        $kodePeternakan = JenisPpp::where('kode', '24')->select('kode_data')->first();
        $peternakan = $bps->getData($kodePeternakan->kode_data);

        // perkebunan bps
        $kodePerkebunan = JenisPpp::where('kode', '54')->select('kode_data')->first();
        $perkebunan = $bps->getData($kodePerkebunan->kode_data);

        // perikanan bps
        $kodePerikanan = JenisPpp::where('kode', '56')->select('kode_data')->first();
        $perikanan = $bps->getData($kodePerikanan->kode_data);

        $this->proyeks = $readytoover;
        $this->proyeks1 = $prospective;
        $this->proyeks2 = $potential;
        $this->proyeks3 = $strategi;
        $this->kawasans = $kawasan;
        $this->pma = $pma;
        $this->pmdn = $pmdn;
        $this->jembatanProvinsi = $jembatan;
        $this->holtikultura = $holtikultura;
        $this->tanamanPangan = $tanamanPangan;
        $this->peternakan = $peternakan;
        $this->perkebunan = $perkebunan;
        $this->perikanan = $perikanan;
    }
    public function render()
    {
        $locations = $this->proyeks;
        $locations1 = $this->proyeks1;
        $locations2 = $this->proyeks2;
        $locations3 = $this->proyeks3;
        $kawasan = $this->kawasans;
        $pma = $this->pma;
        $pmdn = $this->pmdn;
        $jembatans = $this->jembatanProvinsi;
        $holtikultura = $this->holtikultura;
        $tanamanPangan = $this->tanamanPangan;
        $peternakan = $this->peternakan;
        $perkebunan = $this->perkebunan;
        $perikanan = $this->perikanan;

        return view('livewire.lokasi.peta')->extends('components.layouts.peta', [
            'locations' => $locations,
            'locations1' => $locations1,
            'locations2' => $locations2,
            'locations3' => $locations3,
            'kawasans' => $kawasan,
            'pma' => $pma,
            'pmdn' => $pmdn,
            'jembatans' => $jembatans,
            'holtikulturas' => $holtikultura,
            'tanamanPangans' => $tanamanPangan,
            'peternakans' => $peternakan,
            'perkebunans' => $perkebunan,
            'perikanans' => $perikanan
        ]);
    }
}
