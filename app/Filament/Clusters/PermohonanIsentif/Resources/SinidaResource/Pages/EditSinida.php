<?php

namespace App\Filament\Clusters\PermohonanIsentif\Resources\SinidaResource\Pages;

use App\Filament\Clusters\PermohonanIsentif\Resources\SinidaResource;
use App\Models\Sinida\TemplateEmail;
use App\Services\EmailConfigService;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class EditSinida extends EditRecord
{
    protected static string $resource = SinidaResource::class;

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $this->record->load('user');

        return array_merge($data, [
            'name' => $this->record->user->name,
            'nama_perusahaan' => $this->record->user ? $this->record->user->userperusahaan->nama_perusahaan : '',
            'telepon_perusahaan' => $this->record->user ? $this->record->user->userperusahaan->telepon_perusahaan : '',
            'alamat_perusahaan' => $this->record->user ? $this->record->user->userperusahaan->alamat_perusahaan : '',
            'nama_pimpinan' => $this->record->user ? $this->record->user->userperusahaan->nama_pimpinan : '',
            'telepon_pimpinan' => $this->record->user ? $this->record->user->userperusahaan->telepon_pimpinan : '',
            'alamat_pimpinan' => $this->record->user ? $this->record->user->userperusahaan->alamat_pimpinan : '',
            'jenis_usaha' => $this->record->user ? $this->record->user->userperusahaan->jenis_usaha : '',
            'nib' => $this->record->user ? $this->record->user->userperusahaan->nib : '',
        ]);
    }

    protected function handleRecordUpdate(Model $record, array $data): Model
    {
        $record->update($data);

        if ($record->user) {
            $record->user->userperusahaan->nama_perusahaan = $data['nama_perusahaan'] ? $data['nama_perusahaan'] : $record->user->userperusahaan->nama_perusahaan;
            $record->user->userperusahaan->telepon_perusahaan = $data['telepon_perusahaan'] ? $data['telepon_perusahaan'] : $record->user->userperusahaan->telepon_perusahaan;
            $record->user->userperusahaan->alamat_perusahaan = $data['alamat_perusahaan'] ? $data['alamat_perusahaan'] : $record->user->userperusahaan->alamat_perusahaan;
            $record->user->userperusahaan->nama_pimpinan = $data['nama_pimpinan'] ? $data['nama_pimpinan'] : $record->user->userperusahaan->nama_pimpinan;
            $record->user->userperusahaan->telepon_pimpinan = $data['telepon_pimpinan'] ? $data['telepon_pimpinan'] : $record->user->userperusahaan->telepon_pimpinan;
            $record->user->userperusahaan->alamat_pimpinan = $data['alamat_pimpinan'] ? $data['alamat_pimpinan'] : $record->user->userperusahaan->alamat_pimpinan;
            $record->user->userperusahaan->jenis_usaha = $data['jenis_usaha'] ? $data['jenis_usaha'] : $record->user->userperusahaan->jenis_usaha;
            $record->user->userperusahaan->nib = $data['nib'] ? $data['nib'] : $record->user->userperusahaan->nib;
            $record->user->userperusahaan->save();
        }

        if ($data['send_notification'] == true) {
            $emailConfigService = new EmailConfigService();
            $emailConfigService->applyEmailConfig('sinida');
            $templateEmail = TemplateEmail::where('id', $data['status_id'])->first();
            $subject = $templateEmail->subject;
            $message = [
                'name' => $this->record->user->name,
                'message' => $templateEmail->content
            ];
            $email = $this->record->user->email;
            Mail::send('emails.email', ['customMessage' => $message], function ($message) use ($email, $subject) {
                $message->to($email)
                    ->subject($subject);
            });
        }

        return $record;
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
