<?php

namespace App\Filament\Resources\SiRusa\NibResource\Pages;

use App\Filament\Resources\SiRusa\NibResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNib extends EditRecord
{
    protected static string $resource = NibResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
