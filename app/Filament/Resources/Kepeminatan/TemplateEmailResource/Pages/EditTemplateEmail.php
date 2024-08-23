<?php

namespace App\Filament\Resources\Kepeminatan\TemplateEmailResource\Pages;

use App\Filament\Resources\Kepeminatan\TemplateEmailResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTemplateEmail extends EditRecord
{
    protected static string $resource = TemplateEmailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
