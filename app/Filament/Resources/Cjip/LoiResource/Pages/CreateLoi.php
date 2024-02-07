<?php

namespace App\Filament\Resources\Cjip\LoiResource\Pages;

use App\Filament\Resources\Cjip\LoiResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CreateLoi extends CreateRecord
{
    protected static string $resource = LoiResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::id();
        $data['user_lo'] = Auth::id();

        //dd($data);
        if ($data['mata_uang'] === '$') {
            $data['nilai_rp'] = null;
        }
        if ($data['mata_uang'] === 'Rp') {
            $data['nilai_usd'] = null;
        }
        //dd($data);
        return $data;
    }

    protected function afterCreate(): void
    {
        $record = $this->record;
        $loi = PDF::loadView('templates.loi', compact('record'))
            ->setOptions(['isRemoteEnabled' => true])
            ->setPaper('legal', 'portrait');

        $content = $loi->download()->getOriginalContent();

        $slug = str_replace(' ', '-', $record->nama_pengusaha);
        $slug = ucwords($slug);

        $filename = 'public/loi/ ' . $slug . '/' . $record->id . '/' . $record->lo->name . '.pdf';

        $record->doc_loi = str_replace('public', '/storage', $filename);
        $record->update();
        //dd($slug);

        $fileSpt = Storage::put($filename, $content);
    }
}
