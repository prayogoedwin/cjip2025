<?php

namespace App\Livewire\Frontend;

use App\Models\Cjip\Kabkota;
use App\Models\Cjip\ProyekInvestasi;
use Illuminate\Support\Str;
use Livewire\Component;

class ThankYou extends Component
{
    /**
     * The processed data grouped into sections.
     *
     * @var array
     */
    public array $displaySections = [];

    /**
     * The user's signature data URL.
     *
     * @var string|null
     */
    public ?string $signature = null;

    /**
     * Mount the component and process the data from the session.
     */
    public function mount()
    {
        $loiData = session('loi_data');

        if (!$loiData) {
            return;
        }

        if (isset($loiData['signature'])) {
            $this->signature = $loiData['signature'];
        }

        $this->displaySections = $this->processDataIntoSections($loiData);
    }

    /**
     * Process raw form data into structured sections for display.
     *
     * @param array $data
     * @return array
     */
    private function processDataIntoSections(array $data): array
    {
        $sections = [
            'Contact Details' => [],
            'Company Details' => [],
            'Investment Details' => [],
            'Workforce Plan' => [],
            'Project Timeline' => [],
        ];

        $map = [
            'Contact Details' => ['name', 'jabatan', 'no_hp', 'email'],
            'Company Details' => ['nama_perusahaan', 'jenis_usaha', 'alamat_perusahaan', 'negara_asal', 'induk_perusahaan'],
            'Investment Details' => ['interest_invesment', 'proyek_id', 'sektor', 'rencana_bidang_usaha', 'status_investasi', 'prefensi_lokasi', 'local_plan', 'nilai_investasi', 'nilai_investasi_rupiah'],
            'Workforce Plan' => ['local_worker_plan', 'local_worker_exis', 'foreign_worker_plan', 'foreign_worker_exis'],
            'Project Timeline' => ['deskripsi_proyek', 'jadwal_proyek'],
        ];

        foreach ($map as $sectionTitle => $keys) {
            foreach ($keys as $key) {
                if (!isset($data[$key]) || is_null($data[$key]) || $data[$key] === '') {
                    continue;
                }

                $value = $data[$key];
                $label = Str::of($key)->replace('_', ' ')->title();

                // Translate specific keys to their readable values.
                switch ($key) {
                    case 'proyek_id':
                        $label = 'Project Interest';
                        $proyek = ProyekInvestasi::find($value);
                        $value = $proyek ? $proyek->nama : 'N/A';
                        break;
                    case 'prefensi_lokasi':
                        $label = 'Location Preference';
                        $kabkota = Kabkota::find($value);
                        $value = $kabkota ? $kabkota->nama : 'N/A';
                        break;
                    case 'status_investasi':
                        $label = 'Investment Status';
                        $value = ($value == 0) ? 'New (Greenfield)' : 'Expansion (Brownfield)';
                        break;
                    case 'local_plan':
                        $label = 'Currency';
                        $value = ($value == 0) ? 'USD' : 'Rupiah';
                        break;
                    case 'interest_invesment':
                        $label = 'Interest in Central Java Project';
                        $value = $value ? 'Yes' : 'No';
                        break;
                    case 'nilai_investasi':
                        $label = 'Investment Value (USD)';
                        $value = 'USD ' . number_format((float)$value, 2, '.', ',');
                        break;
                    case 'nilai_investasi_rupiah':
                        $label = 'Investment Value (Rupiah)';
                        $value = 'Rp. ' . number_format((float)$value, 0, ',', '.');
                        break;
                }

                if (is_bool($value)) {
                    $value = $value ? 'Yes' : 'No';
                }

                $sections[$sectionTitle][(string)$label] = $value;
            }
        }

        // Filter out empty sections
        return array_filter($sections);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.frontend.thank-you')
            ->layout('components.layouts.master');
    }
}
