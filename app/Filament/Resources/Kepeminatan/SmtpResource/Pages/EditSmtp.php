<?php

namespace App\Filament\Resources\Kepeminatan\SmtpResource\Pages;

use App\Filament\Resources\Kepeminatan\SmtpResource;
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
