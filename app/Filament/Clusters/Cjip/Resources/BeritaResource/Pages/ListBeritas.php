<?php

namespace App\Filament\Clusters\Cjip\Resources\BeritaResource\Pages;

use App\Filament\Clusters\Cjip\Resources\BeritaResource;
use App\Models\Cjip\Berita;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;
use Illuminate\Support\Facades\Auth;

class ListBeritas extends ListRecords
{

    use ListRecords\Concerns\Translatable;
    protected static string $resource = BeritaResource::class;
    protected function getTableQuery(): Builder
    {
        if (auth()->user()->hasRole('admin_cjip')) {
            return parent::getTableQuery()->where('kab_kota_id', auth()->user()->kabkota->id);
        }
        return parent::getTableQuery();
    }
    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'all' => Tab::make('Semua')
                ->badge(
                    Berita::query()
                        ->when(Auth::user()->hasRole('admin_cjip'), function ($query) {
                            $query->where('kab_kota_id', Auth::user()->kabkota->id);
                        })
                        ->count()
                )
                ->modifyQueryUsing(function (Builder $query) {
                    if (Auth::user()->hasRole('admin_cjip')) {
                        $query->where('kab_kota_id', Auth::user()->kabkota->id);
                    }
                })
                ->icon('heroicon-m-list-bullet'),

            '1' => Tab::make('Published')
                ->badge(
                    Berita::query()
                        ->when(Auth::user()->hasRole('admin_cjip'), function ($query) {
                            $query->where('kab_kota_id', Auth::user()->kabkota->id);
                        })
                        ->where('status', 1)
                        ->count()
                )
                ->modifyQueryUsing(function (Builder $query) {
                    if (Auth::user()->hasRole('admin_cjip')) {
                        $query->where('kab_kota_id', Auth::user()->kabkota->id);
                    }
                    $query->where('status', true);
                })
                ->icon('heroicon-m-check-circle'),

            '0' => Tab::make('Unpublished')
                ->badge(
                    Berita::query()
                        ->when(Auth::user()->hasRole('admin_cjip'), function ($query) {
                            $query->where('kab_kota_id', Auth::user()->kabkota->id);
                        })
                        ->where('status', 0)
                        ->count()
                )
                ->modifyQueryUsing(function (Builder $query) {
                    if (Auth::user()->hasRole('admin_cjip')) {
                        $query->where('kab_kota_id', Auth::user()->kabkota->id);
                    }
                    $query->where('status', false);
                })
                ->icon('heroicon-m-x-circle'),

            null => Tab::make('Review')
                ->badge(
                    Berita::query()
                        ->when(Auth::user()->hasRole('admin_cjip'), function ($query) {
                            $query->where('kab_kota_id', Auth::user()->kabkota->id);
                        })
                        ->whereNull('status')
                        ->count()
                )
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
