<?php

namespace App\Livewire\Frontend\Sinida;

use App\Models\Kepeminatan\Perusahaan;
use App\Models\Sinida\Sinida;
use App\Models\Sinida\TemplateEmail;
use App\Models\User;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Filament\Forms\Components\Html;
use Filament\Forms\Components\Placeholder;
use Filament\Forms\Components\Textarea;
use Illuminate\Support\HtmlString;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class Pengajuan extends Component implements HasForms
{
    use InteractsWithForms;

    public Perusahaan $perusahaan;
    public User $user;
    public $title = 'Form Permohonan Insentif';
    public $uploadSection = false;
    public $showBtn = false;

    public $nib,
        $nama_perusahaan,
        $alamat_perusahaan,
        $telp_perusahaan,
        $nama_pimpinan,
        $alamat_pimpinan,
        $negara_asal,
        $jenis_usaha,
        $induk_perusahaan,
        $telepon_perusahaan,
        $telepon_pimpinan,
        $telp_pimpinan;

    public $name,
        $email,
        $nip,
        $jabatan,
        $no_hp,
        $profile_photo_path;

    public $pakta_integritas,
        $tidak_menerima_intensif,
        $file_ktp,
        $file_permohonan_direktur;
    public function mount()
    {
        $this->form->fill([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
            'nip' => auth()->user()->nip,
            'jabatan' => auth()->user()->jabatan,
            'no_hp' => auth()->user()->no_hp,
            'profile_photo_path' => auth()->user()->profile_photo_path,

            'nama_perusahaan' => auth()->user()->userperusahaan->nama_perusahaan ?? '',
            'jenis_usaha' => auth()->user()->userperusahaan->jenis_usaha ?? '',
            'telepon_perusahaan' => auth()->user()->userperusahaan->telepon_perusahaan ?? '',
            'negara_asal' => auth()->user()->userperusahaan->negara_asal ?? '',
            'induk_perusahaan' => auth()->user()->userperusahaan->induk_perusahaan ?? '',
            'nama_pimpinan' => auth()->user()->userperusahaan->nama_pimpinan ?? '',
            'telepon_pimpinan' => auth()->user()->userperusahaan->telepon_pimpinan ?? '',
            'nib' => auth()->user()->userperusahaan->nib ?? '',
            'alamat_pimpinan' => auth()->user()->userperusahaan->alamat_pimpinan ?? '',
            'alamat_perusahaan' => auth()->user()->userperusahaan->alamat_perusahaan ?? '',
        ]);
    }

    protected function getFormSchema(): array
    {
        return [
            Section::make('Perusahaan')
                ->collapsible()
                ->schema([
                    Grid::make()->schema([
                        TextInput::make('nib')->required()->label('NIB')->minLength(13)
                            ->numeric()
                            ->maxLength(13),
                        TextInput::make('nama_perusahaan')->required()->label('Nama Perusahaan'),
                        TextInput::make('jenis_usaha')->required()->label('Jenis Usaha'),
                        TextInput::make('telepon_perusahaan')->required()->label('Telepon Perusahaan'),
                        TextInput::make('induk_perusahaan')->required()->label('Induk Perusahaan'),
                        TextInput::make('negara_asal')->required()->label('Negara Asal'),
                        Textarea::make('alamat_perusahaan')->required()->label('Alamat Perusahaan')->columnSpanFull(),
                    ])->columns(2),
                    TextInput::make('nama_pimpinan')->required()->label('Nama Pimpinan'),
                    TextInput::make('telepon_pimpinan')->required()->label('Telepon Pimpinan'),
                    Textarea::make('alamat_pimpinan')->required()->label('Alamat Pimpinan')->columnSpanFull(),
                ])->columns(2),

            Section::make('Upload Persyaratan')->schema([
                FileUpload::make('pakta_integritas')
                    ->required()
                    ->label('File Pakta Integritas')
                    ->hint('*file maksimal 1 MB, format .pdf')
                    ->maxSize(1024)
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend('Pakta Integritas-' . Auth::user()->name . '-'),
                    )
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('public')
                    ->directory('sinida/pakta_integritas'),

                Placeholder::make('')
                    ->extraAttributes(['class' => 'text-sm text-blue-600 underline hover:no-underline mb-2'])
                    ->content(function ($get) {
                        $namaPerusahaan = urlencode($get('nama_perusahaan'));
                        $alamatPerusahaan = urlencode($get('alamat_perusahaan'));
                        $telpPerusahaan = urlencode($get('telepon_perusahaan'));
                        $namaPimpinan = urlencode($get('nama_pimpinan'));
                        $alamatPimpinan = urlencode($get('alamat_pimpinan'));
                        $telpPimpinan = urlencode($get('telepon_pimpinan'));

                        $url = route('pakta-integritas') .
                            "?nama={$namaPerusahaan}" .
                            "&alamat_perusahaan={$alamatPerusahaan}" .
                            "&telepon_perusahaan={$telpPerusahaan}" .
                            "&nama_pimpinan={$namaPimpinan}" .
                            "&alamat_pimpinan={$alamatPimpinan}" .
                            "&telepon_pimpinan={$telpPimpinan}";

                        return new HtmlString('<a href="' . $url . '" target="_blank">Download template Pakta Integritas</a>');
                    }),

                FileUpload::make('file_ktp')
                    ->required()
                    ->label('File KTP')
                    ->hint('*file maksimal 1 MB, format .pdf')
                    ->maxSize(1024)
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend('File KTP-' . Auth::user()->name . '-'),
                    )
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('public')
                    ->directory('sinida/file_ktp'),
                FileUpload::make('file_permohonan_direktur')
                    ->required()
                    ->hint('*file maksimal 1 MB, format .pdf')
                    ->maxSize(1024)
                    ->label('File Permohonan Direktur')
                    ->getUploadedFileNameForStorageUsing(
                        fn(TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend('Permohonan Direktur-' . Auth::user()->name . '-'),
                    )
                    ->acceptedFileTypes(['application/pdf'])
                    ->disk('public')
                    ->directory('sinida/file_permohonan_direktur'),
            ])->columns(1),
        ];
    }

    public function store()
    {
        $user = auth()->user();
        $perusahaan = $user->userperusahaan;
        if ($perusahaan) {
            $perusahaan->update([
                'nama_perusahaan' => $this->nama_perusahaan,
                'nib' => $this->nib,
                'jenis_usaha' => $this->jenis_usaha,
                'telepon_perusahaan' => $this->telepon_perusahaan,
                'induk_perusahaan' => $this->induk_perusahaan,
                'negara_asal' => $this->negara_asal,
                'alamat_perusahaan' => $this->alamat_perusahaan,
                'nama_pimpinan' => $this->nama_pimpinan,
                'telepon_pimpinan' => $this->telepon_pimpinan,
                'alamat_pimpinan' => $this->alamat_pimpinan,
            ]);
        } else {
            $perusahaan = Perusahaan::create([
                'user_id' => $user->id,
                'nama_perusahaan' => $this->nama_perusahaan,
                'nib' => $this->nib,
                'jenis_usaha' => $this->jenis_usaha,
                'telepon_perusahaan' => $this->telepon_perusahaan,
                'induk_perusahaan' => $this->induk_perusahaan,
                'negara_asal' => $this->negara_asal,
                'alamat_perusahaan' => $this->alamat_perusahaan,
                'nama_pimpinan' => $this->nama_pimpinan,
                'telepon_pimpinan' => $this->telepon_pimpinan,
                'alamat_pimpinan' => $this->alamat_pimpinan,
            ]);
        }
        $status_id = TemplateEmail::where('modul', 'sinida')->where('status', 'menunggu')->first();

        Sinida::create([
            'user_id' => Auth::user()->id,
            'file_1' => $this->form->getState()['pakta_integritas'],
            'file_ktp' => $this->form->getState()['file_ktp'],
            'file_permohonan_direktur' => $this->form->getState()['file_permohonan_direktur'],
            'status_id' => $status_id->id
        ]);

        session()->flash('message', 'Data saved successfully!');
        return Redirect::to('dashboard/riwayat-sinida');
    }
    public function render()
    {
        return view('livewire.frontend.sinida.pengajuan')->layout('components.layouts.master');
    }
}
