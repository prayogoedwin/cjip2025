<?php

namespace App\Filament\Clusters\Cjip\Resources\BeritaResource\Pages;

use App\Filament\Clusters\Cjip\Resources\BeritaResource;
use App\Models\Cjip\Berita;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Components\Tab;

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
                ->badge(Berita::query()->count())
                ->icon('heroicon-m-list-bullet'),
            '1' => Tab::make('Published')
                ->badge(Berita::query()->where('status', 1)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', true))
                ->icon('heroicon-m-check-circle'),
            '0' => Tab::make('Unpublished')
                ->badge(Berita::query()->where('status', 0)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', false))
                ->icon('heroicon-m-x-circle'),
            null => Tab::make('Review')
                ->badge(Berita::query()->where('status', null)->count())
                ->modifyQueryUsing(fn(Builder $query) => $query->where('status', null))
                ->icon('heroicon-m-pencil-square'),
        ];
    }
}
