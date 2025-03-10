<?php

namespace App\Livewire\Beranda\Table;

use App\Models\Cjip\Pendidikan as CjipPendidikan;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

use Livewire\Component;

class Pendidikan extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(CjipPendidikan::query())
            ->defaultPaginationPageOption(5)
            ->columns([
                TextColumn::make('no.')
                    ->rowIndex(),
                TextColumn::make('nama'),
                TextColumn::make('kabkota.nama')->searchable(),
                TextColumn::make('jenis_sekolah'),
            ])
            ->filters([
                // 
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
        return view('livewire.beranda.table.pendidikan');
    }
}
