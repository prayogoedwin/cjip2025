<?php

namespace App\Imports;

use App\Models\General\Kabkota;
use App\Models\General\Sektor;
use App\Models\SiMike\Dashboard;
use App\Models\SiMike\Nib;
use App\Models\SiMike\Proyek;
use App\Models\SiMike\RulesSimike;
use Carbon\Carbon;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SiMikeImportAdmin implements ToCollection, WithHeadingRow, WithChunkReading, ShouldQueue
{
    /**
     * @param Collection $collection
     * @param $row
     * @return NewSimike
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    private $kab_kota_id;
    private $tahun;
    private $triwulan;
    private $user_id;
    private $mulai;
    private $akhir;
    private $rules_id;
    public $rules, $dataToInsert, $dashboardToInsert = [], $kabkotas = [], $sektors = [];
    public $nilai_investasi,
        $nilai_investasi_pma,
        $nilai_investasi_pmdn,
        $jumlah_nib,
        $jumlah_proyek,
        $jumlah_tk,
        $jumlah_proyek_pma,
        $jumlah_proyek_pmdn,
        $sumber_data,
        $flag,
        $kabkotaId;

    public function __construct($tahun, $triwulan, $user_id, $mulai, $akhir, $rules_id)
    {
        $this->tahun = $tahun;
        $this->triwulan = $triwulan;
        $this->user_id = $user_id;
        $this->mulai = $mulai;
        $this->akhir = $akhir;
        $this->rules_id = $rules_id;
        //dd($bidang);
    }


    public function collection(Collection $rows)
    {
        // dd($rows);

        $user = [
            'user_id' => $this->user_id,
            'tahun' => $this->tahun,
            'triwulan' => $this->triwulan,
            'periode_start' => $this->mulai,
            'periode_end' => $this->akhir,
            'rules_id' => $this->rules_id,
        ];
        // dd($user);

        if ($user['rules_id']){
            $this->rules = RulesSimike::find($user['rules_id']);
        }
        else{
            $this->rules = RulesSimike::where('is_active', true)->first();
        }

        foreach ($rows as $key => $row) {
            //dd($rows);

            if (!$this->rules->is_active){
                switch ($row['kab_usaha']){
                    case 'Kota Pekalongan' :
                        $kab = 1;
                        break;
                    case 'Kota Semarang' :
                        $kab = 2;
                        break;
                    case 'Kota Salatiga' :
                        $kab = 3;
                        break;
                    case 'Kota Magelang' :
                        $kab = 4;
                        break;
                    case 'Kota Surakarta' :
                        $kab = 5;
                        break;
                    case 'Kota Tegal' :
                        $kab = 6;
                        break;
                    case 'Kab. Pekalongan' :
                        $kab = 7;
                        break;
                    case 'Kab. Jepara' :
                        $kab = 8;
                        break;
                    case 'Kab. Pati' :
                        $kab = 9;
                        break;
                    case 'Kab. Pemalang' :
                        $kab = 10;
                        break;
                    case 'Kab. Magelang':
                        $kab = 11;
                        break;
                    case 'Kab. Sukoharjo' :
                        $kab = 12;
                        break;
                    case 'Kab. Demak' :
                        $kab = 13;
                        break;
                    case 'Kab. Purbalingga' :
                        $kab = 14;
                        break;
                    case 'Kab. Batang' :
                        $kab = 15;
                        break;
                    case 'Kab. Rembang' :
                        $kab = 16;
                        break;
                    case 'Kab. Kebumen' :
                        $kab = 17;
                        break;
                    case 'Kab. Grobogan':
                        $kab = 18;
                        break;
                    case 'Kab. Sragen' :
                        $kab = 19;
                        break;
                    case 'Kab. Blora' :
                        $kab = 20;
                        break;
                    case 'Kab. Temanggung' :
                        $kab = 21;
                        break;
                    case 'Kab. Karanganyar' :
                        $kab = 22;
                        break;
                    case 'Kab. Wonogiri' :
                        $kab = 23;
                        break;
                    case 'Kab. Wonosobo' :
                        $kab = 24;
                        break;
                    case 'Kab. Kendal' :
                        $kab = 25;
                        break;
                    case 'Kab. Brebes' :
                        $kab = 26;
                        break;
                    case 'Kab. Banyumas' :
                        $kab = 27;
                        break;
                    case 'Kab. Banjarnegara' :
                        $kab = 28;
                        break;
                    case 'Kab. Kudus' :
                        $kab = 29;
                        break;
                    case 'Kab. Purworejo' :
                        $kab = 30;
                        break;
                    case 'Kab. Cilacap' :
                        $kab = 31;
                        break;
                    case 'Kab. Boyolali' :
                        $kab = 32;
                        break;
                    case 'Kab. Klaten' :
                        $kab = 33;
                        break;
                    case 'Kab. Tegal' :
                        $kab = 34;
                        break;
                    case 'Kab. Semarang' :
                        $kab = 35;
                        break;

                }
                $this->kabkotaId = $kab;
                $row['kab_kota_id'] = $kab;
                $row['nama_user'] = $row['nama_usaha'];
                $row['nama_perusahaan'] = $row['nama_usaha'];
                $row['nomor_telp'] = $row['telp'];
                $row['alamat'] = $row['alamat_usaha'];
                $row['tki'] = $row['tenaga_kerja'];
                $row['modal_kerja'] = $row['modal_usaha'];
                $row['jumlah_investasi'] = str_replace(',', '', $row['modal_usaha']);
                $row['id_proyek'] = $row['nib'].$row['kbli'];
                $row['uraian_status_penanaman_modal'] = 'PMDN';
            }
            else{
                switch ($row['kab_kota_usaha']){
                    case 'Kota Pekalongan' :
                        $kab = 1;
                        break;
                    case 'Kota Semarang' :
                        $kab = 2;
                        break;
                    case 'Kota Salatiga' :
                        $kab = 3;
                        break;
                    case 'Kota Magelang' :
                        $kab = 4;
                        break;
                    case 'Kota Surakarta' :
                        $kab = 5;
                        break;
                    case 'Kota Tegal' :
                        $kab = 6;
                        break;
                    case 'Kab. Pekalongan' :
                        $kab = 7;
                        break;
                    case 'Kab. Jepara' :
                        $kab = 8;
                        break;
                    case 'Kab. Pati' :
                        $kab = 9;
                        break;
                    case 'Kab. Pemalang' :
                        $kab = 10;
                        break;
                    case 'Kab. Magelang':
                        $kab = 11;
                        break;
                    case 'Kab. Sukoharjo' :
                        $kab = 12;
                        break;
                    case 'Kab. Demak' :
                        $kab = 13;
                        break;
                    case 'Kab. Purbalingga' :
                        $kab = 14;
                        break;
                    case 'Kab. Batang' :
                        $kab = 15;
                        break;
                    case 'Kab. Rembang' :
                        $kab = 16;
                        break;
                    case 'Kab. Kebumen' :
                        $kab = 17;
                        break;
                    case 'Kab. Grobogan':
                        $kab = 18;
                        break;
                    case 'Kab. Sragen' :
                        $kab = 19;
                        break;
                    case 'Kab. Blora' :
                        $kab = 20;
                        break;
                    case 'Kab. Temanggung' :
                        $kab = 21;
                        break;
                    case 'Kab. Karanganyar' :
                        $kab = 22;
                        break;
                    case 'Kab. Wonogiri' :
                        $kab = 23;
                        break;
                    case 'Kab. Wonosobo' :
                        $kab = 24;
                        break;
                    case 'Kab. Kendal' :
                        $kab = 25;
                        break;
                    case 'Kab. Brebes' :
                        $kab = 26;
                        break;
                    case 'Kab. Banyumas' :
                        $kab = 27;
                        break;
                    case 'Kab. Banjarnegara' :
                        $kab = 28;
                        break;
                    case 'Kab. Kudus' :
                        $kab = 29;
                        break;
                    case 'Kab. Purworejo' :
                        $kab = 30;
                        break;
                    case 'Kab. Cilacap' :
                        $kab = 31;
                        break;
                    case 'Kab. Boyolali' :
                        $kab = 32;
                        break;
                    case 'Kab. Klaten' :
                        $kab = 33;
                        break;
                    case 'Kab. Tegal' :
                        $kab = 34;
                        break;
                    case 'Kab. Semarang' :
                        $kab = 35;
                        break;

                }
                $row['kab_kota_id'] = $kab;
                $this->kabkotaId = $kab;
            }

            if ($row['nib'] == null or $row['nib'] == ''){
                $row['nib'] = Auth::id() . '.' . Carbon::now() . $key;
            }

            if ((int)$row['jumlah_investasi'] <= (int)$this->rules->rules[0]['max']) {
                $set = 'Micro';
            } elseif ((int)$row['jumlah_investasi'] >= (int)$this->rules->rules[1]['min'] && (int)$row['jumlah_investasi'] <= (int)$this->rules->rules[1]['max']) {
                $set = 'Kecil';
            } elseif ((int)$row['jumlah_investasi'] >= (int)$this->rules->rules[2]['min'] && (int)$row['jumlah_investasi'] <= (int)$this->rules->rules[2]['max']) {
                $set = 'Menengah';
            } elseif ((int)$row['jumlah_investasi'] > (int)$this->rules->rules[3]['min']) {
                $set = 'Besar';
            }

            $this->nilai_investasi = $row['jumlah_investasi'];
            $this->jumlah_tk = $row['tenaga_kerja'];


            if ($row['uraian_status_penanaman_modal'] == 'PMA'){
                $this->nilai_investasi_pma = $row['jumlah_investasi'];
                $this->nilai_investasi_pmdn = 0;
                $this->jumlah_proyek_pma = 1;
                $this->jumlah_proyek_pmdn = 0;
            }
            else{
                $this->nilai_investasi_pma = 0;
                $this->nilai_investasi_pmdn = $row['jumlah_investasi'];
                $this->jumlah_proyek_pma = 0;
                $this->jumlah_proyek_pmdn = 1;
            }
            //panggil fungsi nib() dengan parameter array $row

            //dd($row);


            $this->nib($row, $user);
        }


        $this->dashboardToInsert = [
            'tahun' => $this->tahun,
            'triwulan' => $this->triwulan,
            'kabkota' => json_encode($this->kabkotas, JSON_THROW_ON_ERROR),
            'sektor' => json_encode($this->sektors, JSON_THROW_ON_ERROR)
        ];


        Dashboard::create($this->dashboardToInsert);


    }


    //FUNGSI UNTUK SAVE / UPDATE NIB
    public function nib($row, $user)
    {
        // Check NIB on database
        //dd($row);
        $data = array_merge(
            $row->toArray(),
            $user
        );
        // dd($data);
        $cek_nib = Nib::where('nib', $row['nib'])->first();
        //dump($cek_nib);
        // If NIB found
        // Update NIB
        //dd($cek_nib);
        if (!$cek_nib) {
            //dump($cek_nib->nib == $row['nib']);

            $nib = Nib::create($data);
            $nib->save();
            //dd($nib);
            if ($nib->wasRecentlyCreated == true) {
                //panggil fungsi proyek() dengan parameter array $row
                $this->jumlah_nib = 1;
                $this->proyek($row, $nib, $user);
            }

        }
        if ($cek_nib) {
            $cek_nib->update($data);
            //panggil fungsi proyek() dengan parameter array $row
            $this->proyek($row, $cek_nib, $user);
            $this->jumlah_nib = 0;
        }
    }

    //FUNGSI UNTUK SAVE / UPDATE PROYEK
    public function proyek($row, $nib, $user)
    {

        //generate flag umk
        //dd($this->rules);
        if ((int)$row['jumlah_investasi'] <= (int)$this->rules->rules[0]['max']) {
            $set = 'Micro';
        } elseif ((int)$row['jumlah_investasi'] >= (int)$this->rules->rules[1]['min'] && (int)$row['jumlah_investasi'] <= (int)$this->rules->rules[1]['max']) {
            $set = 'Kecil';
        } elseif ((int)$row['jumlah_investasi'] >= (int)$this->rules->rules[2]['min'] && (int)$row['jumlah_investasi'] <= (int)$this->rules->rules[2]['max']) {
            $set = 'Menengah';
        } elseif ((int)$row['jumlah_investasi'] > (int)$this->rules->rules[3]['min']) {
            $set = 'Besar';
        }
        $this->flag = $set;
        //find sektor
        //dd($row['kbli']);
        $sektor = Sektor::where('kbli', $row['kbli'])->first();
        //dd($sektor);
        $data = array_merge(
            $row->toArray(),
            $user
        );


        // Check Proyek on database
        $cek_proyek = Proyek::where('nib_id', $nib->id)
            ->first();

        //dd($cek_proyek);
        // If Proyek found
        // Update Proyek & add same proyek with status is_tambahan = true
        if (!$cek_proyek) {
            // If Not Found
            // Save Proyek and assign NIB ID
            $merge_nib = array_merge($data, [
                'nib_id' => $nib->id,
                'flag' => $set,
                'sektor' => $sektor->sektor ?? null,
                'sektor_id' => $sektor->id ?? null
            ]);
            //dd($merge_nib);
            $proyek = Proyek::create($merge_nib);
            $proyek->save();



                //dd($kabkota);
            }

        //merge atau gabung proyek dengan array KEY "is_tambahan" dengan VALUE true

        $con = false; //psuedo variable untuk manampung kondisi tanggal
        if ($cek_proyek) {
            //cek tanggal upload. If tanggal upload tidak sama dengan sekarang
            if ($cek_proyek->id_proyek != $row['id_proyek'] && Carbon::parse($cek_proyek->created_at)->toDate() != Carbon::now()->toDate()) {
                $con = true;
                $proyek_additional = [
                    'is_tambahan' => $con,
                    'nib_id' => $nib->id,
                    'flag' => $set,
                    'sektor' => $sektor->sektor ?? null,
                    'sektor_id' => $sektor->id ?? null
                ];
                //dd($proyek_additional);
                //$proyek_additional = array_merge($row->toArray(),$data);
                $proyek = Proyek::create(array_merge($proyek_additional, $data));
                $proyek->save();
            }
        }

        if(empty($this->kabkotas[$this->flag])){
            $this->kabkotas = array_merge($this->kabkotas, [
                $this->flag => [
                    Kabkota::find($this->kabkotaId)->nama => [
                        'nilai_investasi' => $this->nilai_investasi,
                        'nilai_investasi_pma' => $this->nilai_investasi_pma,
                        'nilai_investasi_pmdn' => $this->nilai_investasi_pmdn,
                        'jumlah_nib' => $this->jumlah_nib,
                        'jumlah_proyek' => $this->jumlah_proyek,
                        'jumlah_tk' => $this->jumlah_tk,
                        'jumlah_proyek_pma' => $this->jumlah_proyek_pma,
                        'jumlah_proyek_pmdn' => $this->jumlah_proyek_pmdn,
                        'sumber_data' => $this->rules->nama,
                    ]
                ]
            ]);
            //dd($this->kabkotas);
        } else {
            if(empty($this->kabkotas[$this->flag][Kabkota::find($row['kab_kota_id'])->nama])){
                $this->kabkotas[$this->flag] = array_merge($this->kabkotas[$this->flag], [
                    Kabkota::find($this->kabkotaId)->nama => [
                        'nilai_investasi' => $this->nilai_investasi,
                        'nilai_investasi_pma' => $this->nilai_investasi_pma,
                        'nilai_investasi_pmdn' => $this->nilai_investasi_pmdn,
                        'jumlah_nib' => $this->jumlah_nib,
                        'jumlah_proyek' => $this->jumlah_proyek,
                        'jumlah_tk' => $this->jumlah_tk,
                        'jumlah_proyek_pma' => $this->jumlah_proyek_pma,
                        'jumlah_proyek_pmdn' => $this->jumlah_proyek_pmdn,
                        'sumber_data' => $this->rules->nama,
                    ]
                ]);
            }
            else{
                $this->kabkotas[$this->flag] = array_merge($this->kabkotas[$this->flag], [
                    Kabkota::find($this->kabkotaId)->nama => [
                        'nilai_investasi' => $this->kabkotas[$this->flag][Kabkota::find($row['kab_kota_id'])->nama]['nilai_investasi'] + $this->nilai_investasi,
                        'nilai_investasi_pma' => $this->kabkotas[$this->flag][Kabkota::find($row['kab_kota_id'])->nama]['nilai_investasi_pma'] + $this->nilai_investasi_pma,
                        'nilai_investasi_pmdn' => $this->kabkotas[$this->flag][Kabkota::find($row['kab_kota_id'])->nama]['nilai_investasi_pmdn'] + $this->nilai_investasi_pmdn,
                        'jumlah_nib' => $this->kabkotas[$this->flag][Kabkota::find($row['kab_kota_id'])->nama]['jumlah_nib'] + $this->jumlah_nib,
                        'jumlah_proyek' => $this->kabkotas[$this->flag][Kabkota::find($row['kab_kota_id'])->nama]['jumlah_proyek'] + $this->jumlah_proyek,
                        'jumlah_tk' => $this->kabkotas[$this->flag][Kabkota::find($row['kab_kota_id'])->nama]['jumlah_tk'] + $this->jumlah_tk,
                        'jumlah_proyek_pma' => $this->kabkotas[$this->flag][Kabkota::find($row['kab_kota_id'])->nama]['jumlah_proyek_pma'] + $this->jumlah_proyek_pma,
                        'jumlah_proyek_pmdn' => $this->kabkotas[$this->flag][Kabkota::find($row['kab_kota_id'])->nama]['jumlah_proyek_pmdn'] + $this->jumlah_proyek_pmdn,
                        'sumber_data' => $this->rules->nama,
                    ]
                ]);
            }

        }


        if(empty($this->sektors[$this->flag])){
            $this->sektors = [
                $this->flag => [
                    $sektor->sektor ?? '-' => [
                        'nilai_investasi' => $this->nilai_investasi,
                        'nilai_investasi_pma' => $this->nilai_investasi_pma,
                        'nilai_investasi_pmdn' => $this->nilai_investasi_pmdn,
                        'jumlah_nib' => $this->jumlah_nib,
                        'jumlah_proyek' => $this->jumlah_proyek,
                        'jumlah_tk' => $this->jumlah_tk,
                        'jumlah_proyek_pma' => $this->jumlah_proyek_pma,
                        'jumlah_proyek_pmdn' => $this->jumlah_proyek_pmdn,
                        'sumber_data' => $this->rules->nama,
                    ]
                ]
            ];
            //dd($this->kabkotas);
        } else {
            if(empty($this->sektors[$this->flag][Kabkota::find($row['kab_kota_id'])->nama])){
                $this->sektors[$this->flag] = array_merge($this->sektors[$this->flag], [
                    $sektor->sektor ?? '-' => [
                        'nilai_investasi' => $this->nilai_investasi,
                        'nilai_investasi_pma' => $this->nilai_investasi_pma,
                        'nilai_investasi_pmdn' => $this->nilai_investasi_pmdn,
                        'jumlah_nib' => $this->jumlah_nib,
                        'jumlah_proyek' => $this->jumlah_proyek,
                        'jumlah_tk' => $this->jumlah_tk,
                        'jumlah_proyek_pma' => $this->jumlah_proyek_pma,
                        'jumlah_proyek_pmdn' => $this->jumlah_proyek_pmdn,
                        'sumber_data' => $this->rules->nama,
                    ]
                ]);
            }
            else{
                $this->sektors[$this->flag] = array_merge($this->sektors[$this->flag], [
                    $sektor->sektor ?? '-' => [
                        'nilai_investasi' => $this->kabkotas[$this->flag][$sektor->sektor ?? '-']['nilai_investasi'] + $this->nilai_investasi,
                        'nilai_investasi_pma' => $this->kabkotas[$this->flag][$sektor->sektor ?? '-']['nilai_investasi_pma'] + $this->nilai_investasi_pma,
                        'nilai_investasi_pmdn' => $this->kabkotas[$this->flag][$sektor->sektor ?? '-']['nilai_investasi_pmdn'] + $this->nilai_investasi_pmdn,
                        'jumlah_nib' => $this->kabkotas[$this->flag][$sektor->sektor ?? '-']['jumlah_nib'] + $this->jumlah_nib,
                        'jumlah_proyek' => $this->kabkotas[$this->flag][$sektor->sektor ?? '-']['jumlah_proyek'] + $this->jumlah_proyek,
                        'jumlah_tk' => $this->kabkotas[$this->flag][$sektor->sektor ?? '-']['jumlah_tk'] + $this->jumlah_tk,
                        'jumlah_proyek_pma' => $this->kabkotas[$this->flag][$sektor->sektor ?? '-']['jumlah_proyek_pma'] + $this->jumlah_proyek_pma,
                        'jumlah_proyek_pmdn' => $this->kabkotas[$this->flag][$sektor->sektor ?? '-']['jumlah_proyek_pmdn'] + $this->jumlah_proyek_pmdn,
                        'sumber_data' => $this->rules->nama,
                    ]
                ]);
            }
            $this->sektors[$this->flag] = array_merge($this->sektors[$this->flag], [
                $sektor->sektor ?? '-' => [
                    'nilai_investasi' => $this->nilai_investasi,
                    'nilai_investasi_pma' => $this->nilai_investasi_pma,
                    'nilai_investasi_pmdn' => $this->nilai_investasi_pmdn,
                    'jumlah_nib' => $this->jumlah_nib,
                    'jumlah_proyek' => $this->jumlah_proyek,
                    'jumlah_tk' => $this->jumlah_tk,
                    'jumlah_proyek_pma' => $this->jumlah_proyek_pma,
                    'jumlah_proyek_pmdn' => $this->jumlah_proyek_pmdn,
                    'sumber_data' => $this->rules->nama,
                ]
            ]);
        }


    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
