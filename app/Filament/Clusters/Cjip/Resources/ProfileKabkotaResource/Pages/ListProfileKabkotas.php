<?php

namespace App\Filament\Clusters\Cjip\Resources\ProfileKabkotaResource\Pages;

use App\Filament\Clusters\Cjip\Resources\ProfileKabkotaResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

class ListProfileKabkotas extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = ProfileKabkotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
    protected function getTableQuery(): Builder
    {
        if (auth()->user()->hasRole('admin_cjip')) {
            return parent::getTableQuery()->where('kab_kota_id', auth()->user()->kabkota->id);
        }
        return parent::getTableQuery();
    }
}
