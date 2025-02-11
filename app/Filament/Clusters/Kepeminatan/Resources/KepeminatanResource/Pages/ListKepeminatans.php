<?php

namespace App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Pages;

use App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource;
use App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Widgets\QuickReportKepeminatan;
use App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Widgets\QuickReportKepeminatanByLokasi;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Model;

class ListKepeminatans extends ListRecords
{
    protected static string $resource = KepeminatanResource::class;
    protected int | string | array $columnSpan = 'full';

    protected function getHeaderActions(): array
    {
        return [
            Action::make('Tambah Kepeminatan')
                ->icon('heroicon-o-document-plus')
                ->tooltip('Tambah Kepeminatan')
                ->label('Tambah Kepeminatan')
                ->url(route('dashboard.kepeminatan'))
                ->color('primary'),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // QuickReportKepeminatanByLokasi::class,
            QuickReportKepeminatan::class,
        ];
    }
}
