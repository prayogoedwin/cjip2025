<?php

namespace App\Filament\Pages\SiMike;

use App\Filament\Widgets\SiMike\KbliChart;
use App\Models\Cjip\Kabkota;
use App\Models\Cjip\Sektor;
use App\Models\SiMike\Proyek;
use Carbon\Carbon;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Pages\Page;

class TopNilaiInvestasi extends Page
{

    protected static ?string $navigationGroup = 'Graph';
    protected static string $view = 'filament.pages.si-mike.top-nilai-investasi';

    //FILTERS
    public $tahun,
    $triwulan,
    $kabkota,
    $sektor,
    $kbli,
    $uraian_skala_usaha,
    $superadmin,
    $kecamatan_usaha;

    protected function getFormSchema(): array
    {
        return [
            Section::make()->schema([
                Grid::make([
                    'sm' => 1,
                    'xl' => 1,
                ])->schema([
                            Select::make('uraian_skala_usaha')
                                ->label('Skala Usaha')
                                ->options([
                                    'Usaha Mikro' => 'Usaha Mikro',
                                    'Usaha Kecil' => 'Usaha Kecil',
                                    'Usaha Menengah' => 'Usaha Menengah',
                                    'Usaha Besar' => 'Usaha Besar',
                                ])
                                ->default($this->uraian_skala_usaha = 'Usaha Mikro')
                                ->required()
                        ]),
                Grid::make([
                    'sm' => 2,
                    'xl' => 2,
                ])
                    ->schema([
                        Select::make('tahun')->default(Carbon::now()->year)
                            ->options(function () {
                                $years = range(Carbon::now()->year, Carbon::now()->subYear(5)->year);
                                //dd($years);
                                return array_combine(array_values($years), array_values($years));
                            })->default(Carbon::now(0)->year)->required(),

                        Select::make('triwulan')
                            ->options([
                                1 => 'I',
                                2 => 'II',
                                3 => 'III',
                                4 => 'IV',
                            ])
                            ->searchable()
                            ->default(function () {
                                $bulan_ini = Carbon::now()->month;
                                if ($bulan_ini <= 3) {
                                    return 1;
                                } elseif ($bulan_ini >= 3 && $bulan_ini <= 6) {
                                    return 2;
                                } elseif ($bulan_ini >= 6 && $bulan_ini <= 9) {
                                    return 3;
                                } elseif ($bulan_ini >= 9 && $bulan_ini <= 12) {
                                    return 4;
                                }

                                return null;
                            }),
                        Select::make('kabkota')->label('Kabupaten/Kota')
                            ->options(Kabkota::all()->pluck('nama', 'id'))
                            ->searchable()
                            ->visible(function () {
                                if (auth()->user()->hasRole('kabkota')) {
                                    return false;
                                }
                                return true;
                            }),
                        Select::make('kecamatan_usaha')->label('Kecamatan Usaha')
                            ->searchable()
                            ->options(function () {
                                $kec_usahas = Proyek::where('kab_kota_id', auth()->user()->kabkota->id)
                                    ->pluck('kecamatan_usaha')->toArray();
                                $kec_usaha = array_combine($kec_usahas, $kec_usahas);
                                return $kec_usaha;
                            })
                            ->visible(function () {
                                if (auth()->user()->hasRole('kabkota')) {
                                    return true;
                                }
                                return false;
                            }),
                        Select::make('sektor')->label('Kategori')
                            ->options(Sektor::groupBy('sektor')->pluck('sektor', 'id'))
                            ->searchable()
                    ])
            ])

        ];
    }
    public function submit()
    {
        // dd(range(Carbon::now()->year, Carbon::now()->subYear(5)->year));
        $this->tahun = $this->form->getState()['tahun'];
        $this->triwulan = $this->form->getState()['triwulan'];
        if (auth()->user()->hasRole('kabkota')) {
            $this->kabkota = auth()->user()->kabkota->id;
        } else {

            $this->kabkota = $this->form->getState()['kabkota'];
        }
        $this->sektor = $this->form->getState()['sektor'];
        $this->uraian_skala_usaha = $this->form->getState()['uraian_skala_usaha'];

        if (auth()->user()->hasRole('super_admin')) {
            $this->superadmin = auth()->user('super_admin');
        } else {
            $this->kecamatan_usaha = $this->form->getState()['kecamatan_usaha'];
        }

        //dd($this->uraian_skala_usaha);
        //\dd([is_null($this->triwulan), empty($this->triwulan)]);

        //\dd($this->triwulan);
        // $this->emit(
        //     'filterUpdated',
        //     ['tahun' => $this->tahun],
        //     ['triwulan' => $this->triwulan],
        //     ['kabkota' => $this->kabkota],
        //     ['sektor' => $this->sektor],
        //     ['uraian_skala_usaha' => $this->uraian_skala_usaha],
        //     ['kecamatan_usaha' => $this->kecamatan_usaha]

        // );
    }

    protected function getFooterWidgets(): array
    {
        return [
            // KbliChart::class,
            // SiMikeSektorChart::class
        ];
    }
}
