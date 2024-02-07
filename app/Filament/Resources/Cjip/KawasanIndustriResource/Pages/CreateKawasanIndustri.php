<?php

namespace App\Filament\Resources\Cjip\KawasanIndustriResource\Pages;

use App\Filament\Resources\Cjip\KawasanIndustriResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class CreateKawasanIndustri extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;
    protected static string $resource = KawasanIndustriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
        ];
    }

    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    protected function getSavedNotification(): ?Notification
    {
        $name = Auth::user()->name;
        $recipient = auth()->user();
        return Notification::make()
            ->success()
            ->icon('heroicon-o-check-circle')
            ->seconds(7)
            ->title('Saved By ' . $name)
            ->body('Kawasan Industri Created Successfully.')
            ->sendToDatabase($recipient);
    }
}
