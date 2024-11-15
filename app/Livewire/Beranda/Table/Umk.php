<?php

namespace App\Livewire\Beranda\Table;

use App\Models\Cjip\UpahMinimum;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Contracts\View\View;

class Umk extends Component implements HasForms, HasTable
{

    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(UpahMinimum::query())
            ->defaultPaginationPageOption(5)
            ->columns([
                TextColumn::make('tahun'),
                TextColumn::make('sumber_data'),
                TextColumn::make('kabkota.nama')
                    ->label('Kabupaten/Kota')
                    ->searchable(),
                TextColumn::make('nilai_umr')
                ,
            ])->defaultSort('nilai_umr', 'desc')    
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
        return view('livewire.beranda.table.umk');
    }
}
