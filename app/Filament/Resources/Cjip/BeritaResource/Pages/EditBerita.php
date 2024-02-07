<?php

namespace App\Filament\Resources\Cjip\BeritaResource\Pages;

use App\Filament\Resources\Cjip\BeritaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBerita extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = BeritaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
