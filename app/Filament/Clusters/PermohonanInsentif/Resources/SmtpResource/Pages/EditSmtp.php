<?php

namespace App\Filament\Clusters\PermohonanInsentif\Resources\SmtpResource\Pages;

use App\Filament\Clusters\PermohonanInsentif\Resources\SmtpResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSmtp extends EditRecord
{
    protected static string $resource = SmtpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
