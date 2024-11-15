<?php

namespace App\Filament\Clusters\Kepeminatan\Resources\TemplateEmailResource\Pages;

use App\Filament\Clusters\Kepeminatan\Resources\TemplateEmailResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTemplateEmails extends ListRecords
{
    protected static string $resource = TemplateEmailResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
