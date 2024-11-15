<?php

namespace App\Filament\Resources\Kemitraan\ProductResource\Pages;

use App\Filament\Resources\Kemitraan\ProductResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
