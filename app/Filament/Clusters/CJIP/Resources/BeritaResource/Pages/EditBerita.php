<?php

namespace App\Filament\Clusters\CJIP\Resources\BeritaResource\Pages;

use App\Filament\Clusters\CJIP\Resources\BeritaResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;

class EditBerita extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = BeritaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
