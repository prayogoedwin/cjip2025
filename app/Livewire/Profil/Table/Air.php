<?php

namespace App\Livewire\Profil\Table;

use App\Models\Cjip\BiayaAir;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;

class Air extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(BiayaAir::query())
            ->defaultPaginationPageOption(5)
            ->columns([
                TextColumn::make('no.')
                    ->rowIndex(),
                TextColumn::make('kategoriair.user_category')->wrap()->label('Kategori')->searchable(),
                TextColumn::make('category')->wrap()->label('kategori')->searchable(),
                TextColumn::make('first')->wrap()->label('I (1 - 10 m3)')->searchable(),
                TextColumn::make('second')->wrap()->label('II ( 11 - 20 m3)')->searchable(),
                TextColumn::make('third')->wrap()->label('III (21 - 30 m3)')->searchable(),
                TextColumn::make('four')->wrap()->label('IV (> 31 m3)')->searchable(),
                TextColumn::make('tahun')->wrap()->label('Tahun')->searchable(),
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
        return view('livewire.profil.table.air');
    }
}
