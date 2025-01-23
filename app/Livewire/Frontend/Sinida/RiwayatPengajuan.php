<?php

namespace App\Livewire\Frontend\Sinida;

use App\Models\Sinida\Sinida;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class RiwayatPengajuan extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public function table(Table $table): Table
    {
        return $table
            ->query(Sinida::query()->where('user_id', auth()->user()->id))
            ->columns([
                TextColumn::make('No.')->rowIndex(),
                TextColumn::make('user.name')->label('Nama Pemohon')->searchable(),
                TextColumn::make('status_template.subject')->wrap()->label('Status Pengajuan')->searchable()->color('primary'),
                TextColumn::make('updated_at')->wrap()->label('Tanggal Pengajuan')->date('d-m-Y')->sortable()
            ])
            ->filters([
                // ...
            ])
            ->actions([
                // ...
            ])
            ->bulkActions([
                // ...
            ]);
    }
    public function render()
    {
        return view('livewire.frontend.sinida.riwayat-pengajuan')->layout('components.layouts.master');
    }
}
