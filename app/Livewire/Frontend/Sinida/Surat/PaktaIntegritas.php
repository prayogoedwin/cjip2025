<?php

namespace App\Livewire\Frontend\Sinida\Surat;

use Livewire\Component;

class PaktaIntegritas extends Component
{
    public $nama, $alamat_perusahaan, $telepon_perusahaan, $nama_pimpinan, $alamat_pimpinan, $telepon_pimpinan;

    public function mount()
    {
        $this->nama = request()->input('nama');
        $this->alamat_perusahaan = request()->input('alamat_perusahaan');
        $this->telepon_perusahaan = request()->input('telepon_perusahaan');
        $this->nama_pimpinan = request()->input('nama_pimpinan');
        $this->alamat_pimpinan = request()->input('alamat_pimpinan');
        $this->telepon_pimpinan = request()->input('telepon_pimpinan');
    }
    public function render()
    {
        return view('livewire.frontend.sinida.surat.pakta-integritas', [
            'nama' => $this->nama,
            'alamat_perusahaan' => $this->alamat_perusahaan,
            'telepon_perusahaan' => $this->telepon_perusahaan,
            'nama_pimpinan' => $this->nama_pimpinan,
            'alamat_pimpinan' => $this->alamat_pimpinan,
            'telepon_pimpinan' => $this->telepon_pimpinan
        ])->layout('components.layouts.surat');
    }
}
