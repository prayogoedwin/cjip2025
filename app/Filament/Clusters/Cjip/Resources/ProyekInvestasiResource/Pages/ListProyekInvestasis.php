<?php

namespace App\Filament\Clusters\Cjip\Resources\ProyekInvestasiResource\Pages;

use App\Filament\Clusters\Cjip\Resources\ProyekInvestasiResource;
use App\Models\Cjip\ProyekInvestasi;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

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
    // public function getTabs(): array
    // {
    //     return [
    //         'all' => Tab::make('Semua')
    //             ->badge(ProyekInvestasi::query()->count())
    //             ->icon('heroicon-m-list-bullet'),
    //         '1' => Tab::make('Published')
    //             ->badge(ProyekInvestasi::query()->where('status', 1)->count())
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('status', true))
    //             ->icon('heroicon-m-check-circle'),
    //         '0' => Tab::make('Unpublished')
    //             ->badge(ProyekInvestasi::query()->where('status', 0)->count())
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('status', false))
    //             ->icon('heroicon-m-x-circle'),
    //         null => Tab::make('Review')
    //             ->badge(ProyekInvestasi::query()->where('status', null)->count())
    //             ->modifyQueryUsing(fn(Builder $query) => $query->where('status', null))
    //             ->icon('heroicon-m-pencil-square'),
    //     ];
    // }
}
