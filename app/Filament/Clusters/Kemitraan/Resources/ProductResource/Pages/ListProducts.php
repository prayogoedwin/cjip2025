<?php

namespace App\Filament\Clusters\Kemitraan\Resources\ProductResource\Pages;

use App\Filament\Clusters\Kemitraan\Resources\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }
}
