<?php

namespace App\Filament\Clusters\Cjip\Resources\ProyekInvestasiResource\Pages;

use App\Filament\Clusters\Cjip\Resources\ProyekInvestasiResource;
use App\Filament\Widgets\ProyekInvestasi\StatsProyekInvestasi;
use App\Models\Cjip\ProyekInvestasi;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListProyekInvestasis extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = ProyekInvestasiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            StatsProyekInvestasi::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->modifyQueryUsing(function (Builder $query) {
                    if (Auth::user()->hasRole('admin_cjip')) {
                        $query->where('kab_kota_id', Auth::user()->kabkota->id);
                    }
                })
                ->icon('heroicon-m-list-bullet'),

            '1' => Tab::make('Published')
                ->modifyQueryUsing(function (Builder $query) {
                    if (Auth::user()->hasRole('admin_cjip')) {
                        $query->where('kab_kota_id', Auth::user()->kabkota->id);
                    }
                    $query->where('status', true);
                })
                ->icon('heroicon-m-check-circle'),

            '0' => Tab::make('Unpublished')
                ->modifyQueryUsing(function (Builder $query) {
                    if (Auth::user()->hasRole('admin_cjip')) {
                        $query->where('kab_kota_id', Auth::user()->kabkota->id);
                    }
                    $query->where('status', false);
                })
                ->icon('heroicon-m-x-circle'),

            null => Tab::make('Review')
                ->modifyQueryUsing(function (Builder $query) {
                    if (Auth::user()->hasRole('admin_cjip')) {
                        $query->where('kab_kota_id', Auth::user()->kabkota->id);
                    }
                    $query->whereNull('status');
                })
                ->icon('heroicon-m-pencil-square'),
        ];
    }
}
