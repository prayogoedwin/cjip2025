<?php

namespace App\Filament\Clusters\Cjip\Resources\KawasanIndustriResource\Pages;

use App\Filament\Clusters\Cjip\Resources\KawasanIndustriResource;
use App\Models\Cjip\KawasanIndustri;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Components\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListKawasanIndustris extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = KawasanIndustriResource::class;

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
                ->badge(KawasanIndustri::query()->count())
                ->icon('heroicon-m-list-bullet'),
            '1' => Tab::make('Published')
                ->badge(KawasanIndustri::query()->where('status', 1)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', true))
                ->icon('heroicon-m-check-circle'),
            '0' => Tab::make('Unpublished')
                ->badge(KawasanIndustri::query()->where('status', 0)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', false))
                ->icon('heroicon-m-x-circle'),
            null => Tab::make('Review')
                ->badge(KawasanIndustri::query()->where('status', null)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', null))
                ->icon('heroicon-m-pencil-square'),
        ];
    }
}
