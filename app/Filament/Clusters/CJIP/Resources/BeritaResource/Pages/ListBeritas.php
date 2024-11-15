<?php

namespace App\Filament\Clusters\CJIP\Resources\BeritaResource\Pages;

use App\Filament\Clusters\CJIP\Resources\BeritaResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

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
}
