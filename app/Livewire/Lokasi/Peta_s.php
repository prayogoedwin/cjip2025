<?php

namespace App\Livewire\Lokasi;

use Illuminate\Support\Facades\Redis;
use App\Models\Cjip\JenisPpp;
use App\Models\Cjip\KawasanIndustri;
use App\Models\Cjip\ProyekInvestasi;
use App\Services\BpsService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Arr;

class Peta extends Component
{
    public $location, $location1, $location2, $location3;
    public $proyeks = [], $proyeks1 = [], $proyeks2 = [], $proyeks3 = [];
    public $kawasans = [], $pma = [], $pmdn = [], $jembatanProvinsi = [];
    public $holtikultura = [], $tanamanPangan = [], $peternakan = [], $perkebunan = [], $perikanan = [];
    public $locale;
    
    protected $listeners = ['languageChange' => 'changeLanguage'];
    protected $cacheExpiration = 3600; // 1 hour in seconds
    protected $chunkSize = 500;

    public function changeLanguage($lang)
    {
        $this->locale = Arr::get($lang, 'lang', 'id');
    }

    public function mount()
    {
        $this->locale = $this->getLocale();
        $this->loadAllData();
    }

    protected function loadAllData(): void
    {
        $this->loadProyekData();
        $this->loadKawasanData();
        $this->loadPmData();
        $this->loadExternalData();
        $this->loadBpsData();
    }

    protected function loadProyekData(): void
    {
        $this->proyeks = $this->getCachedData('proyeks_1', fn() => $this->getProyekData(1));
        $this->proyeks1 = $this->getCachedData('proyeks_2', fn() => $this->getProyekData(2));
        $this->proyeks2 = $this->getCachedData('proyeks_3', fn() => $this->getProyekData(3));
        $this->proyeks3 = $this->getCachedData('proyeks_4', fn() => $this->getProyekData(4));
    }

    protected function loadKawasanData(): void
    {
        $this->kawasans = $this->getCachedData('kawasans', fn() => $this->getKawasanData());
    }

    protected function loadPmData(): void
    {
        $this->pma = $this->getCachedData('pma', fn() => $this->getPmData('PMA'));
        $this->pmdn = $this->getCachedData('pmdn', fn() => $this->getPmData('PMDN'));
    }

    protected function loadExternalData(): void
    {
        $this->jembatanProvinsi = $this->getCachedData(
            'jembatan_provinsi', 
            fn() => $this->getJembatanData()
        );
    }

    protected function loadBpsData(): void
    {
        $bps = new BpsService;
        
        $bpsDataMap = [
            'holtikultura' => ['55', false],
            'tanamanPangan' => ['53', true],
            'peternakan' => ['24', false],
            'perkebunan' => ['54', false],
            'perikanan' => ['56', false],
        ];

        foreach ($bpsDataMap as $property => [$kode, $isTanamanPangan]) {
            $this->{$property} = $this->getCachedBpsData(
                $property,
                $kode,
                $bps,
                $isTanamanPangan
            );
        }
    }

    protected function getCachedData(string $key, callable $callback): array
    {
        $cacheKey = $this->generateCacheKey($key);
        
        return Redis::get($cacheKey) 
            ? json_decode(Redis::get($cacheKey), true) 
            : $this->storeInCache($cacheKey, $callback());
    }

    protected function getCachedBpsData(
        string $key, 
        string $kode, 
        BpsService $bps,
        bool $isTanamanPangan = false
    ): ?array {
        $cacheKey = $this->generateCacheKey("{$key}_{$kode}");
        
        if (Redis::exists($cacheKey)) {
            return json_decode(Redis::get($cacheKey), true);
        }

        $kodeData = JenisPpp::where('kode', $kode)->value('kode_data');
        
        if (!$kodeData) {
            return null;
        }

        $data = $isTanamanPangan 
            ? $bps->getTanamanPangan($kodeData) 
            : $bps->getData($kodeData);

        return $this->storeInCache($cacheKey, $data);
    }

    protected function generateCacheKey(string $key): string
    {
        return "peta_{$key}_{$this->locale}";
    }

    protected function storeInCache(string $key, $data)
    {
        Redis::setex($key, $this->cacheExpiration, json_encode($data));
        return $data;
    }

    protected function getLocale(): string
    {
        return is_array($lang = Session::get('lang')) 
            ? Arr::first($lang) 
            : ($lang ?: 'id');
    }

    protected function getProyekData(int $marketId): array
    {
        $results = [];
        ProyekInvestasi::where('status', '1')
            ->where('market_id', $marketId)
            ->chunk($this->chunkSize, function ($proyeks) use (&$results) {
                array_push($results, ...$proyeks->all());
            });
        return $results;
    }

    protected function getKawasanData(): array
    {
        $results = [];
        KawasanIndustri::where('status', '1')
            ->chunk($this->chunkSize, function ($kawasans) use (&$results) {
                array_push($results, ...$kawasans->all());
            });
        return $results;
    }

    protected function getPmData(string $status): array
    {
        return DB::table('rilis')
            ->join('kabkotas', 'rilis.kab_kota_id', '=', 'kabkotas.id')
            ->select(
                'rilis.kab_kota_id', 
                'kabkotas.nama', 
                DB::raw('count(*) as total'), 
                'kabkotas.lat', 
                'kabkotas.lng'
            )
            ->whereNotNull(['rilis.kab_kota_id', 'kabkotas.lat', 'kabkotas.lng'])
            ->where('rilis.status_pm', $status)
            ->groupBy('kabkotas.id')
            ->get()
            ->toArray();
    }

    protected function getJembatanData(): array
    {
        try {
            $response = Http::timeout(60)->get('https://webgis.dpubinmarcipka.jatengprov.go.id/api/data/jembatanprovinsi');
            return $response->successful() 
                ? $response->json() 
                : ['error' => $response->status()];
        } catch (RequestException $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function render()
    {
        return view('livewire.lokasi.peta')->extends('components.layouts.peta', [
            'locations' => $this->proyeks,
            'locations1' => $this->proyeks1,
            'locations2' => $this->proyeks2,
            'locations3' => $this->proyeks3,
            'kawasans' => $this->kawasans,
            'pma' => $this->pma,
            'pmdn' => $this->pmdn,
            'jembatans' => $this->jembatanProvinsi,
            'holtikulturas' => $this->holtikultura,
            'tanamanPangans' => $this->tanamanPangan,
            'peternakans' => $this->peternakan,
            'perkebunans' => $this->perkebunan,
            'perikanans' => $this->perikanan
        ]);
    }
}