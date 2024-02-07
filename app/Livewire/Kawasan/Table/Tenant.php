<?php

namespace App\Livewire\Kawasan\Table;

use App\Models\Cjip\Kawasan;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;


class Tenant extends Component implements HasForms, HasTable
{

    use InteractsWithTable;
    use InteractsWithForms;
    public function table(Table $table): Table
    {
        return $table
            ->query(Kawasan::query())
            ->defaultPaginationPageOption(5)
            ->columns([
                TextColumn::make('nama'),
                TextColumn::make('sektor'),
                TextColumn::make('negara')->searchable(),
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
        return view('livewire.kawasan.table.tenant');
    }
}
