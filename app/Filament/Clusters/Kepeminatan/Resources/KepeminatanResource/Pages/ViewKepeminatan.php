<?php

namespace App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource\Pages;

use App\Filament\Clusters\Kepeminatan\Resources\KepeminatanResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewKepeminatan extends ViewRecord
{

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['name'] = $this->record->user->name;
        $data['jabatan'] = $this->record->user->jabatan;
        $data['email'] = $this->record->user->email;
        $data['no_hp'] = $this->record->user->no_hp;

        $data['nama_perusahaan'] = $this->record->user->userperusahaan->nama_perusahaan;
        $data['jenis_usaha'] = $this->record->user->userperusahaan->jenis_usaha;
        $data['alamat_perusahaan'] = $this->record->user->userperusahaan->alamat_perusahaan;
        $data['negara_asal'] = $this->record->user->userperusahaan->negara_asal;
        $data['induk_perusahaan'] = $this->record->user->userperusahaan->induk_perusahaan;

        return $data;
    }
    protected static string $resource = KepeminatanResource::class;
}
