<?php

namespace App\Filament\Clusters\Cjip\Resources\SliderResource\Pages;

use App\Filament\Clusters\Cjip\Resources\SliderResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;

class EditSlider extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = SliderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
