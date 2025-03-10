<?php

namespace App\Livewire\Profil\Table;

use App\Models\Cjip\BiayaListrik;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;


class Listrik extends Component implements HasForms, HasTable
{

    use InteractsWithTable;
    use InteractsWithForms;
    public function table(Table $table): Table
    {
        return $table
            ->query(BiayaListrik::query())
            ->defaultPaginationPageOption(5)
            ->columns([
                TextColumn::make('no.')
                    ->rowIndex(),
                TextColumn::make('kode'),
                TextColumn::make('kapasitas'),
                TextColumn::make('tarif')->searchable(),
                TextColumn::make('tanggal'),
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
        return view('livewire.profil.table.listrik');
    }
}
