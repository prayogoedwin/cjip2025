<?php

namespace App\Livewire\Frontend\Sinida;

use App\Models\Kepeminatan\Perusahaan;
use App\Models\Sinida\Sinida;
use App\Models\Sinida\TemplateEmail;
use App\Models\User;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;
use Livewire\WithFileUploads;

class SuratPengajuan extends Component
{
    use WithFileUploads;
    public $title = 'Form Permohonan Insentif';
    public $nib, $nama_perusahaan, $alamat_perusahaan, $telp_perusahaan, $nama_pimpinan, $alamat_pimpinan, $telp_pimpinan;
    public $uploadSection = false;
    public $showBtn = false;
    public $pakta_integritas, $tidak_menerima_intensif, $file_ktp, $file_permohonan_direktur;

    protected $rules = [
        'pakta_integritas' => 'required|mimes:pdf',
        // 'tidak_menerima_intensif' => 'required|mimes:pdf',
        'file_ktp' => 'required|mimes:pdf',
        'file_permohonan_direktur' => 'required|mimes:pdf',
    ];
    protected $messages = [
        'pakta_integritas.required' => 'File pakta integritas wajib diunggah.',
        'pakta_integritas.mimes' => 'File pakta integritas harus berupa file PDF.',
        // 'tidak_menerima_intensif.required' => 'File tidak menerima intensif wajib diunggah.',
        // 'tidak_menerima_intensif.mimes' => 'File tidak menerima intensif harus berupa file PDF.',
        'file_ktp.required' => 'File ktp wajib diunggah.',
        'file_ktp.mimes' => 'File ktp harus berupa file PDF.',
        'file_permohonan_direktur.required' => 'File permohonan direktur wajib diunggah.',
        'file_permohonan_direktur.mimes' => 'File permohonan direktur harus berupa file PDF.',
    ];

    public function mount()
    {
        $this->nama_perusahaan = Auth::user()->userperusahaan->nama_perusahaan ?? '';
        $this->alamat_perusahaan = Auth::user()->userperusahaan->alamat_perusahaan ?? '';
        $this->telp_perusahaan = Auth::user()->userperusahaan->telepon_perusahaan ?? '';
        $this->nama_pimpinan = Auth::user()->userperusahaan->nama_pimpinan ?? '';
        $this->telp_pimpinan = Auth::user()->userperusahaan->telepon_pimpinan ?? '';
        $this->alamat_pimpinan = Auth::user()->userperusahaan->alamat_pimpinan ?? '';
    }

    public function resetForm()
    {
        $this->nib = '';
        $this->nama_perusahaan = '';
        $this->alamat_perusahaan = '';
        $this->telp_perusahaan = '';
        $this->nama_pimpinan = '';
        $this->alamat_pimpinan = '';
        $this->telp_pimpinan = '';
        $this->pakta_integritas = '';
        // $this->tidak_menerima_intensif = '';
        $this->file_ktp = '';
        $this->file_permohonan_direktur = '';
        $this->uploadSection = false;
        $this->showBtn = false;
    }

    public function cariNib()
    {
        $this->showBtn = false;
        $nib = DB::table('nibs')->where('nib', $this->nib)->first();
        if ($nib) {
            $this->nama_perusahaan = $nib->nama_perusahaan;
            $this->alamat_perusahaan = $nib->alamat_perusahaan;
            $this->telp_perusahaan = $nib->nomor_telp;
            $this->showBtn = true;
        } else {
            session()->flash('message', 'Data Tidak Ditemukan, Silahkan Mengisi Manual');
        }
    }

    public function updateFill()
    {
        $data = Perusahaan::where('nama_perusahaan', $this->nama_perusahaan)
            ->where('user_id', Auth::user()->id)->first();
        // dd($data);
        if (!$data) {
            Perusahaan::create([
                'user_id' => Auth::user()->id,
                'nama_perusahaan' => $this->nama_perusahaan,
                'alamat_perusahaan' => $this->alamat_perusahaan,
                'telepon_perusahaan' => $this->telp_perusahaan,
                'nama_pimpinan' => $this->nama_pimpinan,
                'alamat_pimpinan' => $this->alamat_pimpinan,
                'telepon_pimpinan' => $this->telp_pimpinan,
            ]);
        } else {
            $data->update([
                'nama_perusahaan' => $this->nama_perusahaan,
                'alamat_perusahaan' => $this->alamat_perusahaan,
                'telepon_perusahaan' => $this->telp_perusahaan,
                'nama_pimpinan' => $this->nama_pimpinan,
                'alamat_pimpinan' => $this->alamat_pimpinan,
                'telepon_pimpinan' => $this->telp_pimpinan,
            ]);
        }
        $this->uploadSection = true;
        $this->showBtn = false;
    }

    public function store()
    {
        $this->validate();
        $name = explode(' ', Auth::user()->name);
        $modifiedName = implode('_', $name);

        // pakta integritas
        $filename = $modifiedName . uniqid() . '_sinida_pakta_integritas.' . $this->pakta_integritas->getClientOriginalExtension();
        $file_1 = $this->pakta_integritas->storeAs('sinida/pakta_integritas', $filename, 'public');

        // pernyataan tidak menerima intensif
        // $filename2 = $modifiedName . uniqid() . '_sinida_pernyataan_tidak_menerima_intensif.' . $this->tidak_menerima_intensif->getClientOriginalExtension();
        // $file_2 = $this->tidak_menerima_intensif->storeAs('sinida/tidak_menerima_intensif', $filename2, 'public');

        // file ktp
        $filename3 = $modifiedName . uniqid() . '_ktp.' . $this->file_ktp->getClientOriginalExtension();
        $file_3 = $this->file_ktp->storeAs('sinida/file_ktp', $filename3, 'public');

        // file permohonan
        $filename4 = $modifiedName . uniqid() . '_permohonan_direktur_ke_kepala_dpmptsp.' . $this->file_permohonan_direktur->getClientOriginalExtension();
        $file_4 = $this->file_permohonan_direktur->storeAs('sinida/permohonan_direktur_ke_kepala_dpmptsp', $filename4, 'public');

        // dd($filename2);
        $status_id = TemplateEmail::where('modul', 'sinida')->where('status', 'menunggu')->first();
        Sinida::create([
            'user_id' => Auth::user()->id,
            'file_1' => $file_1,
            // 'file_2' => $file_2,
            'file_ktp' => $file_3,
            'file_permohonan_direktur' => $file_4,
            'status_id' => $status_id->id
        ]);
        $this->resetForm();
        Notification::make()
            ->title('Pengajuan Sindia Oleh : ' . Auth::user()->name)
            ->body('Pengajuan SINIDA')
            ->success()
            ->sendToDatabase(User::whereNot('id', auth()->user()->id)->get());
        session()->flash('berhasil', 'Berhasil upload dokumen');
        return redirect()->route('dashboard.riwayat-sinida');
    }
    public function logout()
    {
        Auth::logout();

        return Redirect::to('/');
    }
    public function render()
    {
        return view('livewire.frontend.sinida.surat-pengajuan')->layout('components.layouts.master');
    }
}
