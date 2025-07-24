<?php

namespace App\Livewire\Cjibf;

use App\Models\Kepeminatan\Kepeminatan;
use Livewire\Component;

class RealCount extends Component
{
    public int $totalKepeminatan = 0;
    public string $totalInvestasiUsd = 'USD 0.00';
    public string $totalInvestasiIdr = 'Rp 0';

    public function mount()
    {
        $this->calculateStats();
    }

    /**
     * Calculates statistics and dispatches raw data to the frontend for animation.
     */
    public function calculateStats()
    {
        $kepeminatanToday = Kepeminatan::whereDate('created_at', today())->get();

        // Calculate raw numeric values
        $rawKepeminatan = $kepeminatanToday->count();
        $rawUsd = (float) $kepeminatanToday->sum('nilai_investasi');
        $rawIdr = (float) $kepeminatanToday->sum('nilai_investasi_rupiah');

        // Update public properties for initial display and for users with JS disabled
        $this->totalKepeminatan = $rawKepeminatan;
        $this->totalInvestasiUsd = 'USD ' . number_format($rawUsd, 2, ',', '.');
        $this->totalInvestasiIdr = 'Rp ' . number_format($rawIdr, 0, ',', '.');

        // Dispatch the raw numbers to the browser for the animation script to use
        $this->dispatch('stats-updated', [
            'kepeminatan' => $rawKepeminatan,
            'usd' => $rawUsd,
            'idr' => $rawIdr,
        ]);
    }

    public function render()
    {
        return view('livewire.cjibf.real-count')
            ->layout('components.layouts.master');
    }
}
