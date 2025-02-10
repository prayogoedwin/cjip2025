<?php

namespace App\Filament\Clusters\Cjip\Resources\ProyekInvestasiResource\Pages;

use App\Filament\Clusters\Cjip\Resources\ProyekInvestasiResource;
use Filament\Actions;
use Filament\Actions\LocaleSwitcher;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class EditProyekInvestasi extends EditRecord
{
    use EditRecord\Concerns\Translatable;
    protected static string $resource = ProyekInvestasiResource::class;

    public static function getTranslatableLocales(): array
    {
        return ['en', 'id'];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (auth()->user()->hasRole('admin_cjip')) {
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
        $user = Auth::user();

        // Periksa apakah pengguna memiliki peran 'admin_cjip'
        if ($user && $user->hasRole('admin_cjip')) {
            return Notification::make()
                ->success()
                ->icon('heroicon-o-document-text')
                ->seconds(7)
                ->title('Saved By ' . $user->name)
                ->body('Proyek Investasi Edited Successfully, Selanjutnya akan direview oleh Admin')
                ->sendToDatabase($user);
        }

        // Jika pengguna tidak memiliki peran 'admin_cjip', tidak mengembalikan notifikasi
        return null;
    }

    protected function getHeaderActions(): array
    {
        return [
            LocaleSwitcher::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
