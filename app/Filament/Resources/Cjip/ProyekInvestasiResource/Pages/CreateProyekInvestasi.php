<?php

namespace App\Filament\Resources\Cjip\ProyekInvestasiResource\Pages;

use App\Filament\Resources\Cjip\ProyekInvestasiResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;

class CreateProyekInvestasi extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

    protected static string $resource = ProyekInvestasiResource::class;

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

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return parent::mutateFormDataBeforeCreate($data);
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
            ->body('Proyek Investasi Created Successfully.')
            ->sendToDatabase($recipient);
    }
}
