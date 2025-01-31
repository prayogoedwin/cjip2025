<?php

namespace App\Filament\Resources\Pengguna\UserResource\Pages;

use App\Filament\Resources\Pengguna\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use STS\FilamentImpersonate\Pages\Actions\Impersonate;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Impersonate::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
