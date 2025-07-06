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
use App\Models\Sidikaryo\SidikaryoPencaker;
use App\Models\Sidikaryo\SidikaryoPenempatan;

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
            // $response = Http::timeout(60)->get('https://example.com/api');
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


        // Untuk sidikaryo_penempatans
        $penempatans = SidikaryoPenempatan::whereIn('created_at', function($query) {
            $query->selectRaw('MAX(created_at)')
                ->from('sidikaryo_penempatans');
        })->get();

        $pencakers = DB::table('sidikaryo_pencakers')
            ->join('kabkotas', 'sidikaryo_pencakers.cjip_kota_id', '=', 'kabkotas.id')
            ->select(
                'sidikaryo_pencakers.*',
                'kabkotas.nama as nama_kabkota',
                'kabkotas.lat',
                'kabkotas.lng'
            )
            ->whereNotNull('kabkotas.lat')
            ->whereNotNull('kabkotas.lng')
            ->get();

        // $kelulusans = DB::table('sidikaryo_dapodiks')
        //     ->join('kabkotas', 'sidikaryo_dapodiks.cjip_kota_id', '=', 'kabkotas.id')
        //     ->select([
        //         'sidikaryo_dapodiks.cjip_kota_id',
        //         'kabkotas.nama as kab_kota',
        //         'sidikaryo_dapodiks.kode_kabkota',
        //         DB::raw('SUM(sidikaryo_dapodiks.jumlah_laki_laki) as total_laki'),
        //         DB::raw('SUM(sidikaryo_dapodiks.jumlah_perempuan) as total_perempuan'),
        //         DB::raw('SUM(sidikaryo_dapodiks.total_jumlah_potensi) as total_potensi'),
        //         'kabkotas.lat',
        //         'kabkotas.lng'
        //     ])
        //     ->whereNotNull('kabkotas.lat')
        //     ->whereNotNull('kabkotas.lng')
        //     ->groupBy('sidikaryo_dapodiks.cjip_kota_id', 'kabkotas.nama', 'kabkotas.lat', 'kabkotas.lng')
        //     ->orderBy('kabkotas.nama')
        //     ->get();

        $kelulusans = DB::table('sidikaryo_dapodiks')
            ->join('kabkotas', 'sidikaryo_dapodiks.cjip_kota_id', '=', 'kabkotas.id')
            ->leftJoin(DB::raw('(
                SELECT 
                    cjip_kota_id,
                    GROUP_CONCAT(jurusan ORDER BY jumlah DESC SEPARATOR ", ") as jurusan_terbanyak
                FROM (
                    SELECT 
                        cjip_kota_id,
                        jurusan,
                        COUNT(*) as jumlah,
                        ROW_NUMBER() OVER (PARTITION BY cjip_kota_id ORDER BY COUNT(*) DESC) as rank
                    FROM sidikaryo_dapodiks
                    WHERE jurusan IS NOT NULL
                    GROUP BY cjip_kota_id, jurusan
                ) ranked
                WHERE rank <= 5
                GROUP BY cjip_kota_id
            ) as jurusan_populer'), 'sidikaryo_dapodiks.cjip_kota_id', '=', 'jurusan_populer.cjip_kota_id')
            ->select([
                'sidikaryo_dapodiks.cjip_kota_id',
                'kabkotas.nama as kab_kota',
                'sidikaryo_dapodiks.kode_kabkota',
                DB::raw('SUM(sidikaryo_dapodiks.jumlah_laki_laki) as total_laki'),
                DB::raw('SUM(sidikaryo_dapodiks.jumlah_perempuan) as total_perempuan'),
                DB::raw('SUM(sidikaryo_dapodiks.total_jumlah_potensi) as total_potensi'),
                'kabkotas.lat',
                'kabkotas.lng',
                'jurusan_populer.jurusan_terbanyak'
            ])
            ->whereNotNull('kabkotas.lat')
            ->whereNotNull('kabkotas.lng')
            ->groupBy('sidikaryo_dapodiks.cjip_kota_id', 'kabkotas.nama', 'kabkotas.lat', 'kabkotas.lng', 'jurusan_populer.jurusan_terbanyak')
            ->orderBy('kabkotas.nama')
            ->get();
        

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

        $this->pencaker = $pencakers;
        $this->penempatan = $penempatans;

        $this->kelulusan = $kelulusans;
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
        $jembatans =  $this->jembatanProvinsi ?? [];
        $holtikultura = $this->holtikultura;
        $tanamanPangan = $this->tanamanPangan;
        $peternakan = $this->peternakan;
        $perkebunan = $this->perkebunan;
        $perikanan = $this->perikanan;

        $pencaker = $this->pencaker;
        $penempatan = $this->penempatan;
        $kelulusan = $this->kelulusan;

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
            'perikanans' => $perikanan,
            'pencakers' => $pencaker,
            'penempatans' => $penempatan,
            'kelulusans' => $kelulusan
        ]);
    }
}
