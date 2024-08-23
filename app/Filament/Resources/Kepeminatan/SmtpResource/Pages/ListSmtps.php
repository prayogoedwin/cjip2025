<?php

namespace App\Filament\Resources\Kepeminatan\SmtpResource\Pages;

use App\Filament\Resources\Kepeminatan\SmtpResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSmtps extends ListRecords
{
    protected static string $resource = SmtpResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
