<?php

namespace App\Livewire\Infografis;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;
use Asantibanez\LivewireCharts\Models\PieChartModel;

class Infografis extends Component
{
    public $locale;
    public $selectedMenu = 'tenaga_kerja';
    
    // We'll use simple arrays instead of chart models
    public $tenagaKerjaData = [];
    public $tenagaKerjaPendidikanData = [];
    public $tenagaKerjaPieData = [];
    public $tenagaKerjaKelaminPieData = [];
    public $bkkData = [];
    public $dapodikData = [];

    protected $listeners = [
        'languageChange' => 'changeLanguage',
        'languageChanged' => '$refresh',
    ];

    public function mount()
    {
        $this->loadCharts();
    }

    public function changeLanguage($lang)
    {
        $this->locale = $lang['lang'];
        Session::put('lang', $this->locale);
        $this->emit('languageChanged');
    }

    public function selectMenu($menu)
    {
        $this->selectedMenu = $menu;
        $this->dispatch('chartChanged');
    }

    public function loadCharts()
    {
        $this->loadTenagaKerjaChart();
        $this->loadTenagaKerjaPendidikanChart();
        $this->loadTenagaKerjaKelaminPieChart();
        $this->loadTenagaKerjaPieChart();
        $this->loadBkkChart();
        $this->loadDapodikChart();
       
    }

    public function loadTenagaKerjaChart()
    {
        $data = DB::table('sidikaryo_pencakers')
            ->join('kabkotas', 'sidikaryo_pencakers.cjip_kota_id', '=', 'kabkotas.id')
            ->select(
                'kabkotas.nama as kabkota',
                DB::raw('SUM(l) as laki_laki'),
                DB::raw('SUM(p) as perempuan'),
            
            )
            ->groupBy('kabkotas.nama')
            ->orderBy('kabkotas.nama')
            ->get();

        $this->tenagaKerjaData = [
            'title' => 'Ketersediaan Tenaga Kerja - Jenis Kelamin - Per Kabupaten Kota',
            'type' => 'column',
            'categories' => $data->pluck('kabkota')->toArray(),

            'series' => [
                [
                    'name' => 'Jumlah Tenaga Kerja Laki-laki',
                    'data' => $data->pluck('laki_laki')->map(function($item) {
                        return (int)$item;
                    })->toArray(),
                    'color' => '#FF7D7D' 
                ],
                 [
                    'name' => 'Jumlah Tenaga Kerja Perempuan',
                    'data' => $data->pluck('perempuan')->map(function($item) {
                        return (int)$item;
                    })->toArray(),
                    'color' => '#FFD166' 
                ]
            ]
        
        ];
    }

    public function loadTenagaKerjaPendidikanChart()
    {
        $data = DB::table('sidikaryo_pencakers')
            ->join('kabkotas', 'sidikaryo_pencakers.cjip_kota_id', '=', 'kabkotas.id')
            ->select(
                'kabkotas.nama as kabkota',
                DB::raw('SUM(lulusan_sma_smk) as sma_smk'),
                DB::raw('SUM(lulusan_dibawah_sma_smk) as dibawah_sma'),
                DB::raw('SUM(lulusan_sarjana_keatas) as sarjana')
            
            )
            ->groupBy('kabkotas.nama')
            ->orderBy('kabkotas.nama')
            ->get();

            $this->tenagaKerjaPendidikanData = [
                'title' => 'Ketersediaan Tenaga Kerja - Pendidikan - Per Kabupaten Kota',
                'type' => 'column',
                'categories' => $data->pluck('kabkota')->toArray(),
                'series' => [
                    [
                        'name' => 'SMA/SMK',
                        'data' => $data->pluck('sma_smk')->map(function($item) {
                            return (int)$item;
                        })->toArray(),
                        'color' => '#FF7D7D'  // Merah muda soft
                    ],
                    [
                        'name' => 'Dibawah SMA',
                        'data' => $data->pluck('dibawah_sma')->map(function($item) {
                            return (int)$item;
                        })->toArray(),
                        'color' => '#FFD166'  // Kuning mustard soft
                    ],
                    // [
                    //     'name' => 'Sarjana',
                    //     'data' => $data->pluck('sarjana')->map(function($item) {
                    //         return (int)$item;
                    //     })->toArray(),
                    //     'color' => '#83C5BE'  // Hijau mint soft
                    // ]
                ]
        ];
    }

    public function loadTenagaKerjaKelaminPieChart()
    {
        $pieData = DB::table('sidikaryo_pencakers')
            ->select(
                DB::raw('SUM(l) as laki_laki'),
                DB::raw('SUM(p) as perempuan'),
            )
            ->first();

        $total = $pieData->laki_laki + $pieData->perempuan;

        $this->tenagaKerjaKelaminPieData = [
            'title' => 'Keteresediaan Tenaga Kerja - Jenis Kelamin - Jawa Tengah',
            'type' => 'pie',
            'slices' => [
                [
                    'name' => 'Laki-laki',
                    'value' => (int)$pieData->laki_laki,
                    'percentage' => round(($pieData->laki_laki / $total) * 100, 1),
                    'color' => '#FF7D7D'
                ],
                [
                    'name' => 'Perempuan',
                    'value' => (int)$pieData->perempuan,
                    'percentage' => round(($pieData->perempuan / $total) * 100, 1),
                    'color' => '#FFD166'
                ]
            ]
        ];
    }

    public function loadTenagaKerjaPieChart()
    {
        $pieData = DB::table('sidikaryo_pencakers')
            ->select(
                DB::raw('SUM(lulusan_sma_smk) as sma_smk'),
                DB::raw('SUM(lulusan_dibawah_sma_smk) as dibawah_sma'),
                DB::raw('SUM(lulusan_sarjana_keatas) as sarjana')
            )
            ->first();

        $total = $pieData->sma_smk + $pieData->dibawah_sma + $pieData->sarjana;

        $this->tenagaKerjaPieData = [
            'title' => 'Keteresediaan Tenaga Kerja - Penddidikan - Jawa Tengah',
            'type' => 'pie',
            'slices' => [
                [
                    'name' => 'SMA/SMK',
                    'value' => (int)$pieData->sma_smk,
                    'percentage' => round(($pieData->sma_smk / $total) * 100, 1),
                    'color' => '#FF7D7D'
                ],
                [
                    'name' => 'Dibawah SMA',
                    'value' => (int)$pieData->dibawah_sma,
                    'percentage' => round(($pieData->dibawah_sma / $total) * 100, 1),
                    'color' => '#FFD166'
                ],
                [
                    'name' => 'Sarjana',
                    'value' => (int)$pieData->sarjana,
                    'percentage' => round(($pieData->sarjana / $total) * 100, 1),
                    'color' => '#83C5BE'
                ]
            ]
        ];
    }

    public function loadBkkChart()
    {
        $data = DB::table('sidikaryo_bkks')
            ->join('kabkotas', 'sidikaryo_bkks.cjip_kota_id', '=', 'kabkotas.id')
            ->select(
                'kabkotas.nama as kabkota',
                DB::raw('COUNT(sidikaryo_bkks.id) as jumlah_bkk'),
            )
            ->groupBy('kabkotas.nama')
            ->orderBy('kabkotas.nama')
            ->get();

            $this->bkkData = [
                'title' => 'Jumlah BKK Per Kabupaten/Kota',
                'type' => 'bar',
                'categories' => $data->pluck('kabkota')->toArray(),
                'series' => [
                    [
                        'name' => 'Jumlah BKK',
                        'data' => $data->pluck('jumlah_bkk')->map(function($item) {
                            return (int)$item;
                        })->toArray(),
                        'color' => '#FF7D7D'  // Merah muda soft
                    ]
                ]
            ];
    }

    public function loadDapodikChart()
    {
        $data = DB::table('sidikaryo_dapodiks')
            ->join('kabkotas', 'sidikaryo_dapodiks.cjip_kota_id', '=', 'kabkotas.id')
            ->select(
                'kabkotas.nama as kabkota',
                DB::raw('SUM(kelulusan_laki) as laki_laki'),
                DB::raw('SUM(kelulusan_perempuan) as perempuan'),
            
            )
            ->groupBy('kabkotas.nama')
            ->orderBy('kabkotas.nama')
            ->get();

            $this->dapodikData = [
                'title' => 'Potensi Kelulusan - Jenis Kelamin - Per Kabupaten Kota',
                'type' => 'column',
                'categories' => $data->pluck('kabkota')->toArray(),
                'series' => [
                    [
                        'name' => 'Laki-laki',
                        'data' => $data->pluck('laki_laki')->map(function($item) {
                            return (int)$item;
                        })->toArray(),
                        'color' => '#FF7D7D'  // Merah muda soft
                    ],
                    [
                        'name' => 'Perempuan',
                        'data' => $data->pluck('perempuan')->map(function($item) {
                            return (int)$item;
                        })->toArray(),
                        'color' => '#FFD166'  // Kuning mustard soft
                    ],
                    // [
                    //     'name' => 'Sarjana',
                    //     'data' => $data->pluck('sarjana')->map(function($item) {
                    //         return (int)$item;
                    //     })->toArray(),
                    //     'color' => '#83C5BE'  // Hijau mint soft
                    // ]
                ]
        ];
    }

    public function DonutChart()
    {
        $data = [
            ['kabkota' => 'Kabupaten A', 'jumlah' => 120],
            ['kabkota' => 'Kabupaten B', 'jumlah' => 85],
            ['kabkota' => 'Kabupaten C', 'jumlah' => 65],
        ];

        $this->bkkData = [
            'title' => 'Bursa Kerja Khusus',
            'type' => 'pie',
            'slices' => array_map(function($item) {
                return [
                    'name' => $item['kabkota'],
                    'value' => $item['jumlah'],
                    'color' => '#'.dechex(rand(0x000000, 0xFFFFFF))
                ];
            }, $data)
        ];
    }

    public function render()
    {
        return view('livewire.infografis.infografis');
    }
}