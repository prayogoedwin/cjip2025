<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class BpsService
{
    public function getData($kode_data)
    {
        $response = Http::timeout(60)->get("https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/3300/var/{$kode_data}/key/0e9edd42e8750976d85170947004f513/")->json();
        $data = $response['datacontent'];
        $vervar = $response['vervar'];
        $turvar = $response['turvar'];
        $tahun = $response['tahun'];
        $label = $response['var'][0]['label'];

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;

        $tahunArray = [];
        foreach ($tahun as $item) {
            $tahunArray[$item['val']] = $item['label'];
        }

        $vervarArray = [];
        foreach ($vervar as $item) {
            $vervarArray[$item['val']] = $item['label'];
        }

        $turvarArray = [];
        foreach ($turvar as $item) {
            $turvarArray[$item['val']] = $item['label'];
        }

        $hasil = [];
        // $labelBagian4 = '';
        $groupedData = [];
        foreach ($data as $key => $value) {
            $bagian1 = substr($key, 0, 1);
            $bagian3 = substr($key, 5, 4);
            $bagian4 = substr($key, 9, 3);

            $labelBagian1 = $vervarArray[$bagian1] ?? 'Unknown';
            $labelBagian3 = $turvarArray[$bagian3] ?? 'Unknown';
            $labelBagian4 = $tahunArray[$bagian4] ?? 'Unknown';

            if ($labelBagian4 == $currentYear || $labelBagian4 == $previousYear) {
                $kabupaten = DB::table('kabkotas')->where('nama', 'like', '%' . $labelBagian1 . '%')->select('lat', 'lng')->first();

                $key = $kabupaten->lat . ',' . $kabupaten->lng;
                if (!isset($groupedData[$key])) {
                    $groupedData[$key] = [
                        'kabupaten' => $labelBagian1,
                        // 'tahun' => $labelBagian4,
                        'lat' => $kabupaten->lat,
                        'lng' => $kabupaten->lng,
                        'satuan' => $response['var'][0]['unit'],
                        'komoditi' => []
                    ];
                }

                $groupedData[$key]['komoditi'][] = [
                    'nama' => $labelBagian3,
                    'value' => $value
                ];
            }
        }
        $hasil = [
            'label' => $label,
            'tahun' => $previousYear,
            'kode' => $kode_data,
            'data' => array_values($groupedData)
        ];
        return $hasil;
    }

    public function getTanamanPangan($kode_data)
    {
        $response = Http::timeout(60)->get("https://webapi.bps.go.id/v1/api/list/model/data/lang/ind/domain/3300/var/{$kode_data}/key/0e9edd42e8750976d85170947004f513/")->json();
        $data = $response['datacontent'];
        $vervar = $response['vervar'];
        $turvar = $response['turvar'];
        $tahun = $response['tahun'];
        $label = $response['var'][0]['label'];

        $currentYear = date('Y');
        $previousYear = $currentYear - 1;

        $tahunArray = [];
        foreach ($tahun as $item) {
            $tahunArray[$item['val']] = $item['label'];
        }

        $vervarArray = [];
        foreach ($vervar as $item) {
            $vervarArray[$item['val']] = $item['label'];
        }

        $turvarArray = [];
        foreach ($turvar as $item) {
            $turvarArray[$item['val']] = $item['label'];
        }

        $hasil = [];
        $groupedData = [];
        foreach ($data as $key => $value) {
            $bagian1 = substr($key, 0, 4);
            $bagian3 = substr($key, 7, 2);
            $bagian4 = substr($key, 9, 3);

            $labelBagian1 = $vervarArray[$bagian1] ?? 'Unknown';
            $labelBagian3 = $turvarArray[$bagian3] ?? 'Unknown';
            $labelBagian4 = $tahunArray[$bagian4] ?? 'Unknown';

            if ($labelBagian4 == $currentYear || $labelBagian4 == $previousYear) {
                $kabupaten = DB::table('kabkotas')->where('nama', 'like', '%' . $labelBagian1 . '%')->select('lat', 'lng')->first();

                $key = $kabupaten->lat . ',' . $kabupaten->lng;
                if (!isset($groupedData[$key])) {
                    $groupedData[$key] = [
                        'kabupaten' => $labelBagian1,
                        'lat' => $kabupaten->lat,
                        'lng' => $kabupaten->lng,
                        'satuan' => $response['var'][0]['unit'],
                        'komoditi' => []
                    ];
                }

                $groupedData[$key]['komoditi'][] = [
                    'nama' => $labelBagian3,
                    'value' => $value
                ];
            }
        }
        $hasil = [
            'label' => $label,
            'tahun' => $previousYear,
            'kode' => $kode_data,
            'data' => array_values($groupedData)
        ];
        // dd($hasil);
        return $hasil;
    }
}
