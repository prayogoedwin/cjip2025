<?php

namespace App\Filament\Resources\Cjip\ProyekInvestasiResource\Pages;

use App\Filament\Resources\Cjip\ProyekInvestasiResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
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
    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    protected function getTableQuery(): Builder
    {
        if (auth()->user()->hasRole('admin_cjip')) {
            return parent::getTableQuery()->where('kab_kota_id', auth()->user()->kabkota->id);
        }
        return parent::getTableQuery();
    }
    protected function getTableFiltersFormColumns(): int
    {
        return 1;
    }
    protected function getTableFiltersFormWidth(): string
    {
        return 'xl';
    }
}
