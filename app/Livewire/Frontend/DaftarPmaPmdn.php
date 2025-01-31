<?php

namespace App\Livewire\Frontend;

use App\Models\SiRusa\Rilis;
use Filament\Widgets\Concerns\InteractsWithPageTable;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Livewire\Component;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class DaftarPmaPmdn extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $data, $status;

    public function mount($id, $status)
    {
        // dd($status);
        $this->data = $id;
        $this->status = $status;
    }

    protected function getTableQuery(): Builder
    {
        return $this->getTableQueryById($this->data, $this->status);
    }
    protected function getTableQueryById($id, $status): Builder
    {
        $data = Rilis::query()
            ->join('kabkotas', 'rilis.kab_kota_id', '=', 'kabkotas.id')
            ->select('kabkotas.nama', 'rilis.*')
            ->whereNotNull('rilis.kab_kota_id')
            ->whereNotNull('kabkotas.lat')
            ->whereNotNull('kabkotas.lng')
            ->where('rilis.status_pm', $status)
            ->where('rilis.kab_kota_id', $id);

        return $data;
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(
                $this->getTableQuery()
            )
            ->defaultPaginationPageOption(5)
            ->columns([
                TextColumn::make('nama_perusahaan')->wrap()->label('Nama Perusahaan')->searchable(),
                TextColumn::make('alamat')->wrap()->label('Alamat Perusahaan')->searchable(),
                TextColumn::make('status_pm')->wrap()->label('Status PM')->searchable(),
                TextColumn::make('kabkota.nama')->wrap()->label('Kabupaten Kota')->searchable(),
            ])
            ->headerActions([
                ExportAction::make()->exports([
                    ExcelExport::make('table')
                        ->fromTable()
                        ->withFilename(date('d-M-Y') . ' - Data Perusahaan')
                        ->withWriterType(\Maatwebsite\Excel\Excel::XLSX),
                ])
                    ->label('Export')
                    ->extraAttributes([
                        'class' => 'text-black',
                        'style' => 'font-weight: bold !important; background-color: #eab308',
                    ])
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }
    public function render()
    {
        return view('livewire.frontend.daftar-pma-pmdn')->layout('components.layouts.master');
    }
}
