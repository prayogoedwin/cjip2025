<?php

namespace App\Filament\Resources\Cjip\LoiResource\Pages;

use App\Filament\Resources\Cjip\LoiResource;
use Filament\Actions;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditLoi extends EditRecord
{
    protected static string $resource = LoiResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
    protected function afterSave(): void
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
        ;
        $record->update();
        //dd($slug);

        $fileSpt = Storage::put($filename, $content);
    }
}
