<?php

namespace App\Livewire\Bkk\Table;

use App\Models\Sidikaryo\SidikaryoBkk;
use Livewire\Component;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

class Bkk extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public $kabkota;

    public function mount($kabkota = null)
    {
        $this->kabkota = $kabkota;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                $query = SidikaryoBkk::query();
                
                if ($this->kabkota) {
                    $query->where('id_kota', $this->kabkota);
                }
                
                return $query;
            })
            ->defaultPaginationPageOption(5)
            ->columns([
                TextColumn::make('no.')
                    ->rowIndex(),
                TextColumn::make('nama_sekolah')->label('Nama Sekolah')->searchable(),
                TextColumn::make('nama_bkk')->label('Nama BKK')->searchable(),
                TextColumn::make('email')->label('Email')
                    ->searchable()
                    ->url(fn ($record) => !empty($record->email) ? "mailto:{$record->email}" : null)
                    ->icon('heroicon-o-envelope')
                    ->iconPosition('after'),
                TextColumn::make('hp')->label('HP')
                    ->formatStateUsing(function ($state) {
                        // Jika mengandung nomor telepon (10-12 digit)
                        if (preg_match('/\d{10,12}/', $state, $matches)) {
                            $number = $matches[0];
                            $whatsappNumber = preg_replace('/^0/', '62', $number);
                            return '
                                <div class="flex items-center gap-2">
                                    <a href="https://wa.me/'.$whatsappNumber.'" target="_blank" class="text-green-600 hover:text-green-800">
                                        '.$state.'
                                    </a>
                                    <a href="https://wa.me/'.$whatsappNumber.'" target="_blank" class="text-green-600 hover:text-green-800">
                                        <x-heroicon-o-chat-bubble-bottom-center-text class="w-5 h-5" />
                                    </a>
                                </div>
                            ';
                        }else{
                            return '-';
                        }
                        // Jika bukan nomor telepon, tampilkan teks biasa
                       
                    })
                    ->html()
                    ->searchable(),
                TextColumn::make('contact_person')->label('Contact Person')
                    ->formatStateUsing(function ($state) {
                        // Jika mengandung nomor telepon (10-12 digit)
                       if (preg_match('/\d{10,12}/', $state, $matches)) {
                            $number = $matches[0];
                            $phoneNumber = preg_replace('/^0/', '62', $number);
                            return '
                                <div class="flex items-center gap-2">
                                    <a href="tel:'.$phoneNumber.'" class="text-blue-600 hover:text-blue-800">
                                        '.$state.'
                                    </a>
                                    <a href="tel:'.$phoneNumber.'" class="text-blue-600 hover:text-blue-800">
                                        <x-heroicon-o-phone class="w-5 h-5" />
                                    </a>
                                </div>
                            ';
                        }
                        // Jika bukan nomor telepon, tampilkan teks biasa
                        return $state;
                    })
                    ->html()
                    ->searchable(),
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
        return view('livewire.bkk.table.bkk');
    }
}