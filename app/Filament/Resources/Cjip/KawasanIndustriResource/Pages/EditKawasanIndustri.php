<?php

namespace App\Filament\Resources\Cjip\KawasanIndustriResource\Pages;

use App\Filament\Resources\Cjip\KawasanIndustriResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;



class EditKawasanIndustri extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = KawasanIndustriResource::class;

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
    public static function getTranslatableLocales(): array
    {
        return ['id', 'en'];
    }
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (auth()->user()->hasRole('admin_ki')) {
            $data['status'] = null;
        }
        return $data;
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
            ->icon('heroicon-o-document-text')
            ->seconds(7)
            ->title('Saved By ' . $name)
            ->body('Kawasan Industri Edited Successfully.')
            ->sendToDatabase($recipient);
    }
}
