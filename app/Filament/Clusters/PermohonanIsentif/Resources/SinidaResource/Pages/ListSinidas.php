<?php

namespace App\Filament\Clusters\PermohonanIsentif\Resources\SinidaResource\Pages;

use App\Filament\Clusters\PermohonanIsentif\Resources\SinidaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSinidas extends ListRecords
{
    protected static string $resource = SinidaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
