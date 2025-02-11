<?php

namespace App\Filament\Clusters\Kepeminatan\Pages\Kepeminatan;

use App\Filament\Clusters\Kepeminatan;
use App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Widgets\QuickReportKepeminatan;
use App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Widgets\QuickReportKepeminatanByLokasi;
use App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Widgets\QuickReportKepeminatanBySector;
use Filament\Pages\Page;

class QuickReport extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-chart-pie';

    protected static string $view = 'filament.clusters.kepeminatan.pages.kepeminatan.quick-report';

    protected static ?int $navigationSort = 2;

    protected static ?string $cluster = Kepeminatan::class;

    protected function getFooterWidgets(): array
    {
        return [
            QuickReportKepeminatan::class,
            QuickReportKepeminatanByLokasi::class,
            QuickReportKepeminatanBySector::class
        ];
    }
}
