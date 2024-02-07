<?php

namespace App\Filament\Resources\Pengguna\UserResource\Pages;

use App\Filament\Resources\Pengguna\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
}
