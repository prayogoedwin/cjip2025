<?php

namespace App\Filament\Resources\Cjip\KawasanIndustriResource\Pages;

use App\Filament\Resources\Cjip\KawasanIndustriResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;


class ListKawasanIndustris extends ListRecords
{

    use ListRecords\Concerns\Translatable;
    protected static string $resource = KawasanIndustriResource::class;

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
    protected function getTableQuery(): Builder
    {
        if (auth()->user()->hasRole('admin_ki')) {
            return parent::getTableQuery()->where('kawasan_id', auth()->user()->user_kawasan_id);
        }
        return parent::getTableQuery();
    }
}
