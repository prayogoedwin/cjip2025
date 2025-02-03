<?php

namespace App\Filament\Widgets\SiMike;

use App\Models\Simike\Report as SimikeReport;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Carbon\Carbon;
use Filament\Forms\Components\Select;
use Illuminate\Support\Facades\DB;
use Leandrocfe\FilamentApexCharts\Widgets\ApexChartWidget;

class Report extends ApexChartWidget
{
    use HasWidgetShield;

    protected int | string | array $columnSpan = 'full';

    /**
     * Chart Id
     *
     * @var string
     */
    protected static ?string $chartId = 'Report';

    /**
     * Widget Title
     *
     * @var string|null
     */
    protected static ?string $pollingInterval = null;
    protected static ?string $heading = 'Report';

    /**
     * Chart options (series, labels, types, size, animations...)
     * https://apexcharts.com/docs/options
     *
     * @return array
     */
    protected function getFormSchema(): array
    {
        return [

            Select::make('tahun')
                ->default(Carbon::now()->year)
                ->searchable()
                ->required()
                ->options(function () {
                    $currentYear = Carbon::now()->year;
                    $years = range($currentYear, $currentYear - 5);
                    return array_combine($years, $years);
                })

        ];
    }

    protected function getOptions(): array
    {
        // Ambil tahun yang dipilih dari form
        $tahun = $this->filterFormData['tahun'];

        // Ambil data laporan berdasarkan user_id, bulan, dan tahun yang dipilih
        $reports = SimikeReport::with('user')  // Memuat relasi user
            ->select('user_id', 'bulan')  // Mengambil user_id dan bulan
            ->where('tahun', $tahun)  // Filter berdasarkan tahun
            ->get();

        // Proses data untuk chart
        $userIds = $reports->pluck('user_id')->unique();  // Mengambil unique user_id
        $seriesData = [];
        $categories = [];

        foreach ($userIds as $userId) {
            // Mengambil nama pengguna dari relasi 'user'
            $user = $reports->firstWhere('user_id', $userId)?->user;  // Mengambil relasi user yang sesuai

            if ($user) {
                $userName = $user->name;  // Mengambil nama user jika ada
            } else {
                $userName = 'Unknown User';  // Jika tidak ada user terkait
            }

            // Menambahkan nama user ke kategori
            $categories[] = $userName;

            // Ambil data laporan berdasarkan user_id dan ambil bulan terbesar untuk user tersebut
            $userReports = $reports->where('user_id', $userId);
            $lastMonthReport = $userReports->max('bulan');  // Ambil bulan terbesar

            // Inisialisasi data untuk bulan terakhir yang diinputkan
            $userReportData = array_fill(0, 12, 0);  // Inisialisasi array dengan nilai 0 untuk setiap bulan

            if ($lastMonthReport) {
                // Menandakan bulan terakhir dengan nilai 1
                $userReportData[$lastMonthReport - 1] = 1;  // Indeks bulan dimulai dari 0, jadi kurangi 1
            }

            // Masukkan data laporan per pengguna
            $seriesData[] = [
                'name' => $userName,  // Menampilkan nama user di chart
                'data' => $userReportData,
            ];
        }

        return [
            'chart' => [
                'type' => 'bar',
                'height' => 800,
            ],
            'series' => $seriesData,
            'xaxis' => [
                'categories' => $categories,  // Kategori berdasarkan nama pengguna
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'yaxis' => [
                'labels' => [
                    'style' => [
                        'fontFamily' => 'inherit',
                    ],
                ],
            ],
            'colors' => ['#f59e0b'],
            'plotOptions' => [
                'bar' => [
                    'borderRadius' => 3,
                    'horizontal' => true,
                ],
            ],
        ];
    }
}
