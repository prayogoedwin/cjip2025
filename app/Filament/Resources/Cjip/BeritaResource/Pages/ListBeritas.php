<?php

namespace App\Filament\Resources\Cjip\BeritaResource\Pages;

use App\Filament\Resources\Cjip\BeritaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;


class ListBeritas extends ListRecords
{
    use ListRecords\Concerns\Translatable;
    protected static string $resource = BeritaResource::class;
    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
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
