<?php

namespace App\Livewire\Frontend\Sinida\Surat;

use Livewire\Component;

class PaktaIntegritas extends Component
{
    public $nama, $alamat_perusahaan, $telp_perusahaan, $nama_pimpinan, $alamat_pimpinan, $telp_pimpinan;

    public function mount()
    {
        $this->nama = request()->input('nama');
        $this->alamat_perusahaan = request()->input('alamat_perusahaan');
        $this->telp_perusahaan = request()->input('telp_perusahaan');
        $this->nama_pimpinan = request()->input('nama_pimpinan');
        $this->alamat_pimpinan = request()->input('alamat_pimpinan');
        $this->telp_pimpinan = request()->input('telp_pimpinan');
    }
    public function render()
    {
        return view('livewire.frontend.sinida.surat.pakta-integritas', [
            'nama' => $this->nama,
            'alamat_perusahaan' => $this->alamat_perusahaan,
            'telp_perusahaan' => $this->telp_perusahaan,
            'nama_pimpinan' => $this->nama_pimpinan,
            'alamat_pimpinan' => $this->alamat_pimpinan,
            'telp_pimpinan' => $this->telp_pimpinan
        ])->layout('components.layouts.surat');
    }
}
