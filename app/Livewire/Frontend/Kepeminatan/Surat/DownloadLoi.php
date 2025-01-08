<?php

namespace App\Livewire\Frontend\Kepeminatan\Surat;

use App\Models\Kepeminatan\Kepeminatan;
use App\Models\Kepeminatan\Perusahaan;
use Livewire\Component;

class DownloadLoi extends Component
{
    public $pengajuan;
    public $user;
    public $perush;
    public function mount($id)
    {
        // Fetch the 'pengajuan' data along with the associated 'user'
        $this->pengajuan = Kepeminatan::with('user')->findOrFail($id);

        // dd($this->pengajuan);

        // Now, fetch the 'perush' (company) data based on the 'user_id' from the 'pengajuan'
        $this->perush = Perusahaan::where('user_id', $this->pengajuan->user_id)->first();

        // dd($this->perush);

        // dd($this->pengajuan[0]['user']);
    }
    public function render()
    {
        return view('livewire.frontend.kepeminatan.surat.download-loi', [
            'pengajuan' => $this->pengajuan,
            'perush' => $this->perush,
        ])->layout('components.layouts.surat');
    }
}
