<?php

namespace App\Filament\Clusters\Cjip\Resources\BeritaResource\Pages;

use App\Filament\Clusters\Cjip\Resources\BeritaResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;

class CreateBerita extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }
    protected static string $resource = BeritaResource::class;
}
