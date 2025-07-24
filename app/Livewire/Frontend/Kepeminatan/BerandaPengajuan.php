<?php

namespace App\Livewire\Frontend\Kepeminatan;

use App\Models\Cjip\Kabkota;
use App\Models\Cjip\ProyekInvestasi;
use App\Models\Kepeminatan\Kepeminatan;
use App\Models\Kepeminatan\Perusahaan;
use App\Models\Kepeminatan\TemplateEmail;
use App\Models\User;
use Closure;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Fieldset;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Livewire\Component;
use Coolsam\SignaturePad\Forms\Components\Fields\SignaturePad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class BerandaPengajuan extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];
    public $loading = false;
    public $kabkota;
    public $locale;
    public $selectedProyek;
    public $is_invesment;
    public $proyek;


    public function mount(): void
    {
        // The mount method is generally fine, but ensure session data is trusted.
        $this->form->fill();
        try {
            $this->kabkota = Kabkota::pluck('nama', 'id')->toArray();
            $this->locale = Session::get('lang', 'id');


            if (Session::has('id_proyek')) {

                $this->is_invesment = true;
                $this->proyek = ProyekInvestasi::where('status', 1)->pluck('nama', 'id')->toArray();
                // Pre-populate the form state
                $this->form->fill([
                    'proyek_id' => $this->selectedProyek,
                    'interest_invesment' => true,
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error during BerandaPengajuan mount: ' . $e->getMessage());
            session()->flash('error', 'An error occurred while initializing the form. Please try again later.');
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Detail Kontak/Contact Detail')
                    ->collapsible()
                    ->schema([
                        TextInput::make('name')
                            ->inlineLabel()
                            ->label('Nama Lengkap/Full Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('jabatan')
                            ->inlineLabel()
                            ->label('Jabatan/Job Title')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('no_hp')
                            ->inlineLabel()
                            ->label('No. Telpon/Phone Number')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        TextInput::make('email')
                            ->inlineLabel()
                            ->email()
                            ->label('Alamat Email/Email Address')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('nama_perusahaan')
                            ->inlineLabel()
                            ->label('Nama Perusahaan/Company Name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('jenis_usaha')
                            ->inlineLabel()
                            ->label('Bidang Usaha Saat ini/Business Field')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('alamat_perusahaan')
                            ->inlineLabel()
                            ->label('Alamat Perusahaan/Company Address')
                            ->required()
                            ->maxLength(1000),
                        Select::make('negara_asal')
                            ->inlineLabel()
                            ->label('Negara Asal/Country of Origin')
                            ->options(config('countries.list'))
                            ->searchable()
                            ->required(),
                        TextInput::make('induk_perusahaan')
                            ->inlineLabel()
                            ->label('Induk Perusahaan/Parent Company')
                            ->maxLength(255),
                    ]),
                Section::make('INVESTMENT INTEREST / Kepemintan Investasi')
                    ->collapsible()
                    ->schema([
                        Toggle::make('interest_invesment')
                            ->label('Apakah Kepeminatan dengan Proyek Jawa Tengah/What is the Interest in Central Java Project?')
                            ->inlineLabel()
                            ->reactive(),
                        Select::make('proyek_id')
                            ->searchable()
                            ->inlineLabel()
                            ->label('Proyek Investasi/Project Interest')
                            ->options(ProyekInvestasi::where('status', 1)->pluck('nama', 'id')->all())
                            ->afterStateUpdated(function ($state, Set $set) {
                                if ($proyek = ProyekInvestasi::find($state)) {
                                    $set('sektor', $proyek->sektor->nama);
                                    $set('rencana_bidang_usaha', $proyek->sektor->nama);
                                    $set('prefensi_lokasi', $proyek->kab_kota_id);
                                }
                            })
                            ->visible(fn(Get $get) => $get('interest_invesment'))
                            ->reactive(),
                        Select::make('sektor')
                            ->inlineLabel()
                            ->label('Sektor Investasi/Sector')
                            // The 'required' rule is now conditional
                            ->required(fn (Get $get): bool => !$get('interest_invesment'))
                            ->searchable()
                            ->options(['Industri' => 'Industri', 'Infrastruktur' => 'Infrastruktur', 'Pertanian' => 'Pertanian', 'Pariwisata' => 'Pariwisata', 'Properti' => 'Properti', 'Energi' => 'Energi', 'Jasa' => 'Jasa', 'Lainnya' => 'Lainnya'])
                            ->visible(fn(Get $get): bool => !$get('interest_invesment')),
                        TextInput::make('rencana_bidang_usaha')
                            ->required()
                            ->maxLength(255)
                            ->inlineLabel(),
                        Radio::make('status_investasi')
                            ->label('Investment Status')
                            ->inlineLabel()
                            ->options([
                                0 => 'NEW (GREENFIELD) / BARU',
                                1 => 'EXPANSION (BROWNFIELD) / EXPANSI',
                            ])->required(),
                        Select::make('prefensi_lokasi')
                            ->label('Prefensi Lokasi/Location Preference')
                            ->options(Kabkota::all()->pluck('nama', 'id')->all())
                            ->searchable()
                            ->inlineLabel(),
                        Radio::make('local_plan')
                            ->label('Mata Uang/Currency')
                            ->required()
                            ->options([0 => 'USD', 1 => 'Rupiah'])
                            ->reactive()
                            ->inline(),
                        TextInput::make('nilai_investasi')
                            ->label('Nilai Investasi Dalam USD')
                            ->visible(fn(Get $get): bool => $get('local_plan') == '0')
                            ->required(fn(Get $get): bool => $get('local_plan') == '0')
                            ->numeric()
                            ->inlineLabel()
                            ->prefix('USD '),
                        TextInput::make('nilai_investasi_rupiah')
                            ->label('Nilai Investasi Dalam Rupiah')
                            ->visible(fn(Get $get): bool => $get('local_plan') == '1')
                            ->required(fn(Get $get): bool => $get('local_plan') == '1')
                            ->prefix('Rp. ')
                            ->numeric()
                            ->inlineLabel(),
                        Fieldset::make('Local Worker/ TKI')
                            ->inlineLabel()
                            ->schema([
                                TextInput::make('local_worker_plan')->required()->numeric()->label('Plan/ Rencana')->default(0)->suffix('People/ Orang'),
                                TextInput::make('local_worker_exis')->required()->numeric()->label('Existing/ Eksisting')->default(0)->suffix('People/ Orang'),
                            ])->columns(1),
                        Fieldset::make('Foreign Worker/ TKA')
                            ->inlineLabel()
                            ->schema([
                                TextInput::make('foreign_worker_plan')->required()->numeric()->label('Plan/ Rencana')->default(0)->suffix('People/ Orang'),
                                TextInput::make('foreign_worker_exis')->required()->numeric()->label('Existing/ Eksisting')->default(0)->suffix('People/ Orang'),
                            ])->columns(1)
                    ]),
                Section::make('Jadwal Proyek/ Timeline Project')
                    ->collapsible()
                    ->schema([
                        Textarea::make('deskripsi_proyek')->required()->label('Deskripsi Proyek/ Project Description')->maxLength(65535),
                        DatePicker::make('jadwal_proyek')->required()->label('Tanggal Proyek/ Project Date'),
                        SignaturePad::make('signature')->label('Tanda Tangan/ Signature')->hideDownloadButtons()->required(),
                    ])
            ])->statePath('data');
    }

    public function create()
    {
        $this->loading = true;
        // First, get the validated state from the form.
        $data = $this->form->getState();

        try {
            // Find necessary related models first to fail early.
            $status = TemplateEmail::where('modul', 'kepeminatan')->where('status', 'menunggu')->firstOrFail();
            $role = Role::where('name', 'perusahaan')->firstOrFail();

            // Use a database transaction to ensure all data is saved or none is.
            DB::transaction(function () use ($data, $role, $status) {
                $pass = Str::random(8);
                $user = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    // Set password to null. The user will set it via a secure link.
                    'password' => Hash::make($pass),
                    'jabatan' => $data['jabatan'],
                    'no_hp' => $data['no_hp']
                ]);
                $user->syncRoles($role->id);

                Perusahaan::create([
                    'user_id' => $user->id,
                    'nama_perusahaan' => $data['nama_perusahaan'],
                    'jenis_usaha' => $data['jenis_usaha'],
                    'alamat_perusahaan' => $data['alamat_perusahaan'],
                    'negara_asal' => $data['negara_asal'],
                    'induk_perusahaan' => $data['induk_perusahaan']
                ]);

                Kepeminatan::create([
                    'user_id' => $user->id,
                    'status_id' => $status->id,
                    'rencana_bidang_usaha' => $data['rencana_bidang_usaha'],
                    'status_investasi' => $data['status_investasi'],
                    'prefensi_lokasi' => $data['prefensi_lokasi'],
                    'local_worker_plan' => $data['local_worker_plan'],
                    'local_worker_exis' => $data['local_worker_exis'],
                    'foreign_worker_plan' => $data['foreign_worker_plan'],
                    'foreign_worker_exis' => $data['foreign_worker_exis'],
                    'nilai_investasi' => $data['nilai_investasi'] ?? null,
                    'nilai_investasi_rupiah' => $data['nilai_investasi_rupiah'] ?? null,
                    'local_plan' => $data['local_plan'],
                    'deskripsi_proyek' => $data['deskripsi_proyek'],
                    'jadwal_proyek' => $data['jadwal_proyek'],
                    'interest_invesment' => $data['interest_invesment'],
                    $data['proyek_id'] ?? null,
                    'sektor' => $data['sektor'] ?? null,
                    'signature' => $data['signature'],
                ]);

                // **SECURE PASSWORD FLOW**
                // Instead of emailing a password, send a link to set one up.
                // 1. Generate a password reset token.
                // $token = Password::broker()->createToken($user);
                // 2. Create a setup link.
                // $link = route('password.reset', ['token' => $token, 'email' => $user->email]);
                // 3. Send the link using a Mailable.
                // Mail::to($user->email)->send(new \App\Mail\SetupAccountMail($link));
            });

            Session::forget('id_proyek');
            session()->flash('loi_data', $data);
            return redirect()->route('success.kepeminatan')->with('success', 'Your submission was successful!');

        } catch (\Throwable $e) {
            // Log the detailed error for developers.
            Log::error('Error during form submission: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);
            // Show a generic, safe error message to the user.
            session()->flash('error', 'An unexpected error occurred while submitting your form. Our team has been notified. Please try again later.');
            $this->loading = false;
        }
    }

    public function render()
    {
        return view('livewire.frontend.kepeminatan.beranda-pengajuan')->layout('components.layouts.master');
    }
}
