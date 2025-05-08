<?php

namespace App\Livewire\Frontend\Kepeminatan;

use App\Models\Kepeminatan\Kepeminatan;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class RiwayatPengajuan extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public $title = 'Riwayat Kepeminatan';

    public function table(Table $table): Table
    {
        return $table
            ->query(Kepeminatan::query()->where('user_id', auth()->user()->id))
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

    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }
    public function render()
    {
        $riwayat = Kepeminatan::where('user_id', Auth::user()->id)->get();
        return view('livewire.frontend.kepeminatan.riwayat-pengajuan', compact('riwayat'))->layout('components.layouts.master');
    }
}
