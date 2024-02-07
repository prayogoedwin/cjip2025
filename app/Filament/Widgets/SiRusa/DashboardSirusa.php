<?php

namespace App\Filament\Widgets\SiRusa;

use App\Exports\SiRusa\Nib\AllNib;
use App\Exports\SiRusa\Nib\AllResiko;
use App\Exports\SiRusa\Nib\AllSkala;
use App\Filament\Resources\SiRusa\NibResource;
use App\Models\Cjip\Kabkota;
use App\Models\Cjip\Sektor;
use App\Models\SiMike\Proyek;
use App\Models\SiRusa\Nib;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\URL;

class DashboardSirusa extends Widget implements HasForms
{
    use HasWidgetShield;

    use InteractsWithForms;
    protected int|string|array $columnSpan = 'full';

    protected static ?string $pollingInterval = null;

    public $loading = false;

    public $start, $end;

    public $status_pm, $kabkota, $sektor, $day_of_tanggal_terbit_oss, $tanggal;

    public $tahun, $allNib, $allJateng, $nib_jateng, $nib_non_jateng, $nib_jateng_proyek_non_jateng,
    $jateng_br,
    $non_jateng_br, $colors;

    public $proyek_jateng, $proyek_non_jateng;

    public $resiko_nib_jateng = false,
    $resiko_nib_non_jateng = false;

    public $resikoJateng, $resikoNonJateng, $skalaNib, $skalaNibNJ;

    public static function canView(): bool
    {

        if (URL::current() == \url('/admin')) {
            return false;
        }
        return true;

        // if (auth()->user()->hasRole(['admin_cjip', 'admin_promosi', 'admin_ki', 'kabkota', 'sirusa'])) {
        //     return false;
        // }

        if (NibResource::getUrl('index')) {
            return true;
        } else {
            return false;
        }

    }

    protected function getFormSchema(): array
    {
        //dd(Carbon::now()->startOfYear()->format('d/m/Y'));

        return [
            Section::make()->label('Filter')->schema([
                Grid::make()->schema([
                    DatePicker::make('start')
                        ->label('Pediode Awal')
                        ->format('d/m/Y')
                        ->displayFormat('d/m/Y')
                        ->required(),
                    DatePicker::make('end')
                        ->label('Pediode Akhir')
                        ->format('d/m/Y')
                        ->displayFormat('d/m/Y')
                        ->required(),
                ])->columns(2),
                Grid::make()
                    ->schema([
                        Select::make('status_pm')
                            ->label('Status PM')
                            ->searchable()
                            ->options([
                                'PMA' => 'PMA',
                                'PMDN' => 'PMDN',
                            ]),
                        Select::make('kabkota')->label('Kabupaten/Kota')
                            ->options(Kabkota::all()->pluck('nama', 'id'))
                            ->searchable()
                            ->visible(function () {
                                if (auth()->user()->hasRole('kabkota')) {
                                    return false;
                                }
                                return true;
                            }),
                        Select::make('sektor')->label('Kategori')
                            ->options(Sektor::groupBy('sektor')->pluck('sektor', 'id'))
                            ->searchable()
                    ])->columns(3)
            ])
        ];
    }

    public function submit(): void
    {
        $this->loading = true;
        $this->resiko_nib_jateng = false;
        $this->resiko_nib_non_jateng = false;

        //dd($this->form->getState());

        $this->day_of_tanggal_terbit_oss = $this->start . ' - ' . $this->end;

        // $this->emit('filterTable', [
        //     'tanggal' => $this->day_of_tanggal_terbit_oss,
        //     'status_pm' => $this->status_pm,
        //     'kabkota' => $this->kabkota,
        //     'sektor' => $this->sektor
        // ]);
        //$this->day_of_tanggal_terbit_oss = $this->form->getState()['tanggal'];
        //dd($this->day_of_tanggal_terbit_oss);
        //dd($this->day_of_tanggal_terbit_oss);
        $order = [
            "Usaha Besar",
            "Usaha Menengah",
            "Usaha Kecil",
            "Usaha Mikro",
            "kosong",
        ];
        $this->colors = [
            'Usaha Besar' => 'danger',
            'Usaha Menengah' => 'warning',
            'Usaha Kecil' => 'success',
            'Usaha Mikro' => 'primary',
            'kosong' => 'gray',
        ];

        // Combine the queries using union
        $nib_jateng = Proyek::with('nibCheck')
            ->filterPerusahaan($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
            ->select('nib', 'uraian_skala_usaha', 'nib_id')
            ->get()
            ->groupBy(['uraian_skala_usaha', 'nib'])
            ->map(function ($group) {
                return $group->count();
            })
            ->sortKeys()
            ->toArray();

        //dd($nib_jateng);

        $this->proyek_jateng = Proyek::with('nibCheck')
            ->filterPerusahaan($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
            ->whereHas('nibCheck')
            ->count();

        $this->proyek_non_jateng = Proyek::filterPerusahaanNon($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
            ->whereDoesntHave('nibCheck')
            ->count();


        $nib_non_jateng = Proyek::whereDoesntHave('nibCheck')
            ->filterPerusahaanNon($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
            ->select('nib', 'uraian_skala_usaha', 'nib_id')
            ->get()
            ->groupBy(['uraian_skala_usaha', 'nib'])
            ->map(function ($group) {
                return $group->count();
            })
            ->sortKeys()
            ->toArray();

        // Modify the final structure
        $this->nib_jateng = collect($nib_jateng)
            ->mapWithKeys(function ($value, $key) {
                return [$key === '' ? 'kosong' : $key => $value];
            })
            ->toArray();

        $this->nib_jateng = collect($this->nib_jateng)
            ->sortBy(function ($value, $key) use ($order) {
                return array_search($key, $order, true) ?? count($order);
            })
            ->toArray();

        $this->nib_non_jateng = collect($nib_non_jateng)
            ->mapWithKeys(function ($value, $key) {
                return [$key === '' ? 'kosong' : $key => $value];
            })
            ->toArray();

        $this->nib_non_jateng = collect($this->nib_non_jateng)
            ->sortBy(function ($value, $key) use ($order) {
                return array_search($key, $order, true) ?? count($order);
            })
            ->toArray();

        $dates = explode(' - ', $this->day_of_tanggal_terbit_oss);
        $startDate = date('Y-m-d', strtotime(str_replace('/', '-', $dates[0])));
        $endDate = date('Y-m-d', strtotime(str_replace('/', '-', $dates[1])));

        $this->nib_jateng_proyek_non_jateng = Nib::whereDoesntHave('proyeks')->whereBetween('day_of_tanggal_terbit_oss', [$startDate, $endDate])->count();


        $this->loading = false;
    }

    public function findResikoJateng($skala)
    {

        $this->skalaNib = $skala;

        $defaultValues = [
            'Tinggi' => 0,
            'Menengah Tinggi' => 0,
            'Menengah Rendah' => 0,
            'Rendah' => 0,
            '' => 0,
        ];

        $this->resiko_nib_jateng = true;

        $this->resikoJateng = Proyek::with('nibCheck')
            ->filterPerusahaan($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
            ->where('uraian_skala_usaha', $skala)
            ->select('nib', 'uraian_risiko_proyek')
            ->get()
            ->groupBy(['uraian_risiko_proyek', 'nib'])
            ->map(function ($group) {
                return $group->count();
            })->toArray();



        foreach ($defaultValues as $key => $value) {
            if (!array_key_exists($key, $this->resikoJateng)) {
                $this->resikoJateng[$key] = $value;
            }
        }

        // DB::enableQueryLog();
        // $nib_jateng = Proyek::with('nibCheck')
        //     ->filterPerusahaan($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
        //     ->select('nib', 'uraian_skala_usaha', 'nib_id')
        //     ->get()
        //     ->groupBy(['uraian_skala_usaha', 'nib'])
        //     ->map(function ($group) {
        //         return $group->count();
        //     })
        //     ->sortKeys()
        //     ->toArray();
        // dd(DB::getQueryLog());



        // dd(
        //     [
        //         'filter' => [
        //             'day_of_tgl_terbit' => $this->day_of_tanggal_terbit_oss,
        //             'status_pm' => $this->status_pm,
        //             'kabkota' => $this->kabkota,
        //             'sektor' => $this->sektor,
        //             'skala' => $skala
        //         ],
        //         'nib' => $nib_jateng,
        //         'output' => $this->resikoJateng
        //     ]
        // );


        //dd($this->resikoJateng);
    }

    public function findResikoNonJateng($skala)
    {

        $this->skalaNibNJ = $skala;

        $defaultValues = [
            'Tinggi' => 0,
            'Menengah Tinggi' => 0,
            'Menengah Rendah' => 0,
            'Rendah' => 0,
            '' => 0,
        ];



        $this->resiko_nib_non_jateng = true;

        $this->resikoNonJateng = Proyek::filterPerusahaan($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
            ->where('uraian_skala_usaha', $skala)
            ->whereDoesntHave('nibCheck')
            ->select('nib', 'uraian_risiko_proyek')
            ->groupBy(['uraian_risiko_proyek', 'nib'])
            ->get()
            ->map(function ($group) {
                return $group->count();
            })->toArray();


        //dd($this->resikoJateng);

        foreach ($defaultValues as $key => $value) {
            if (!array_key_exists($key, $this->resikoNonJateng)) {
                $this->resikoNonJateng[$key] = $value;
            }
        }
        //dd($this->resikoJateng);
    }

    public function mount()
    {

        //dd($this->tableFilters);

        $this->start = Carbon::now()->startOfYear()->format('d/m/Y');
        $this->end = Carbon::now()->format('d/m/Y');

        $this->day_of_tanggal_terbit_oss = $this->start . ' - ' . $this->end;


        // $this->emit('filterTable', $this->day_of_tanggal_terbit_oss);

        $order = [
            "Usaha Besar",
            "Usaha Menengah",
            "Usaha Kecil",
            "Usaha Mikro",
            "kosong",
        ];

        $this->colors = [
            'Usaha Besar' => 'danger',
            'Usaha Menengah' => 'warning',
            'Usaha Kecil' => 'success',
            'Usaha Mikro' => 'primary',
            'kosong' => 'gray',
        ];

        // Combine the queries using union
        $nib_jateng = Proyek::with('nibCheck')
            ->filterPerusahaan($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
            ->select('nib', 'uraian_skala_usaha', 'nib_id')
            ->get()
            ->groupBy(['uraian_skala_usaha', 'nib'])
            ->map(function ($group) {
                return $group->count();
            })
            ->sortKeys()
            ->toArray();

        //dd($nib_jateng);


        $nib_non_jateng = Proyek::whereDoesntHave('nibCheck')
            ->filterPerusahaanNon($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
            ->select('nib', 'uraian_skala_usaha', 'nib_id')
            ->get()
            ->groupBy(['uraian_skala_usaha', 'nib'])
            ->map(function ($group) {
                return $group->count();
            })
            ->sortKeys()
            ->toArray();

        $this->proyek_jateng = Proyek::with('nibCheck')
            ->filterPerusahaan($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
            ->whereHas('nibCheck')
            ->count();

        $this->proyek_non_jateng = Proyek::filterPerusahaanNon($this->day_of_tanggal_terbit_oss, $this->status_pm, $this->kabkota, $this->sektor)
            ->whereDoesntHave('nibCheck')
            ->count();


        // Modify the final structure
        $this->nib_jateng = collect($nib_jateng)
            ->mapWithKeys(function ($value, $key) {
                return [$key === '' ? 'kosong' : $key => $value];
            })
            ->toArray();

        $this->nib_jateng = collect($this->nib_jateng)
            ->sortBy(function ($value, $key) use ($order) {
                return array_search($key, $order, true) ?? count($order);
            })
            ->toArray();

        $this->nib_non_jateng = collect($nib_non_jateng)
            ->mapWithKeys(function ($value, $key) {
                return [$key === '' ? 'kosong' : $key => $value];
            })
            ->toArray();

        $this->nib_non_jateng = collect($this->nib_non_jateng)
            ->sortBy(function ($value, $key) use ($order) {
                return array_search($key, $order, true) ?? count($order);
            })
            ->toArray();

        $dates = explode(' - ', $this->day_of_tanggal_terbit_oss);
        $startDate = date('Y-m-d', strtotime(str_replace('/', '-', $dates[0])));
        $endDate = date('Y-m-d', strtotime(str_replace('/', '-', $dates[1])));

        //dd($this->nib_jateng);

        $this->nib_jateng_proyek_non_jateng = Nib::whereDoesntHave('proyeks')->whereBetween('day_of_tanggal_terbit_oss', [$startDate, $endDate])->count();

        $this->loading = false;

        //dd($this->allNib);
    }


    public function downloadAll($status, $day_of_tanggal_terbit_oss, $status_pm, $kabkota, $sektor)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new AllNib($status, $day_of_tanggal_terbit_oss, $status_pm, $kabkota, $sektor), 'all.xlsx');
    }

    public function downloadSkala($status, $skala, $day_of_tanggal_terbit_oss)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new AllSkala($status, $skala, $day_of_tanggal_terbit_oss), 'by_skala.xlsx');
    }

    public function downloadResiko($status, $skala, $resiko, $tahun)
    {
        return \Maatwebsite\Excel\Facades\Excel::download(new AllResiko($status, $skala, $resiko, $tahun), 'by_resiko_in_skala.xlsx');
    }
    protected static string $view = 'filament.widgets.si-rusa.dashboard-sirusa';
}
