<?php

namespace App\Filament\Widgets\ProyekInvestasi;

use App\Livewire\Cjibf\Proyek;
use App\Models\Cjip\ProyekInvestasi;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class StatsProyekInvestasi extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('', ProyekInvestasi::query()
                ->when(Auth::user()->hasRole('admin_cjip'), function ($query) {
                    $query->where('kab_kota_id', Auth::user()->kabkota->id);
                })
                ->count())
                ->description('Semua')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('secondary'),
            Stat::make('', ProyekInvestasi::query()->where('status', 1)
                ->when(Auth::user()->hasRole('admin_cjip'), function ($query) {
                    $query->where('kab_kota_id', Auth::user()->kabkota->id);
                })
                ->count())
                ->description('Published')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
            Stat::make('', ProyekInvestasi::query()->where('status', 0)
                ->when(Auth::user()->hasRole('admin_cjip'), function ($query) {
                    $query->where('kab_kota_id', Auth::user()->kabkota->id);
                })
                ->count())
                ->description('Unpublished')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('danger'),
            Stat::make('', ProyekInvestasi::query()->where('status', null)
                ->when(Auth::user()->hasRole('admin_cjip'), function ($query) {
                    $query->where('kab_kota_id', Auth::user()->kabkota->id);
                })
                ->count())
                ->description('Review')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('warning'),
        ];
    }
}
