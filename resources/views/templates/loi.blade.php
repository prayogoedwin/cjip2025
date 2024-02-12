<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'LOI') }}</title>

    <!-- Fonts -->


    <!-- Styles -->

    <style>
        @page :first{
            margin-bottom:0cm;
            margin-top:0cm;
            margin-right: 0cm;
            margin-left:0cm;
        }
        @page {
            margin-bottom:0cm;
            margin-top:0cm;
            margin-right: 0cm;
            margin-left:0cm;
        }
        body {
            margin-bottom: 0cm;
        }
        .footer {
            position: fixed;
            bottom: 0px;
            left: 0cm;
            right: 0cm;
            height: auto;

            /** Extra personal styles **/
            background-color: transparent;
            color: white;
            text-align: center;
        }

        @media print {
            .pagebreak { page-break-before: always; } /* page-break-after works, as well */
        }
    </style>
    <style>
        table {
            width:100%;
            border-collapse:collapse;
            padding:5px;
        }
        table th {
            border:1px solid #224527;
            padding:5px;
            background: #224527;
            color: #313030;
        }
        table td {
            text-align:center;
            padding:5px;
            background: #ffffff;
            color: #313030;
        }
        @font-face {
            font-family: "Futura Md BT Bold";
            src: url("https://db.onlinewebfonts.com/t/1ffbed7089a941aa728bb970f3ad49f6.eot");
            src: url("https://db.onlinewebfonts.com/t/1ffbed7089a941aa728bb970f3ad49f6.eot?#iefix")format("embedded-opentype"),
            url("https://db.onlinewebfonts.com/t/1ffbed7089a941aa728bb970f3ad49f6.woff2")format("woff2"),
            url("https://db.onlinewebfonts.com/t/1ffbed7089a941aa728bb970f3ad49f6.woff")format("woff"),
            url("https://db.onlinewebfonts.com/t/1ffbed7089a941aa728bb970f3ad49f6.ttf")format("truetype"),
            url("https://db.onlinewebfonts.com/t/1ffbed7089a941aa728bb970f3ad49f6.svg#Futura Md BT Bold")format("svg");
        }
        @font-face{
            font-family:"helvetica"; font-weight: bold;
            src:url("https://candyfonts.com/wp-data/2018/10/26/11538/HELR45W.ttf") format("woff"),
            url("https://candyfonts.com/wp-data/2018/10/26/11538/HELR45W.ttf") format("opentype"),
            url("https://candyfonts.com/wp-data/2018/10/26/11538/HELR45W.ttf") format("truetype");
        }
        input[type='checkbox'] {
            color: #224527;
            display: inline;
        }
        input[type='checkbox']:focus {
            border-color: #224527;
        }

    </style>



    <!-- Scripts -->{{--
    <script src="{{ mix('js/app.js') }}" defer></script>--}}
</head>
<body class="font-sans antialiased">
<div class="footer">
    <img style="margin-left: auto; margin-right: auto;text-align: center; width: 205mm;" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/templates/loi/footer.png'))) }}" alt="Footer CJIBF">
</div>


<div style="text-align: center;">
    <table style="width: 205mm;  border-collapse: collapse; margin-left: auto; margin-right: auto;" border="0">
        <tbody>
        <tr>
            <td style="text-align: center;">
                <img style="width: 205mm" src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('images/templates/loi/header2.png'))) }}" alt="CJIBF 2023 ">
            </td>
        </tr>
        <tr>
            <td style="text-align: center;font-family: 'Futura Md BT Bold'; font-size: 16pt;">
                INVESTMENT ACCOUNT PROFILE
            </td>
        </tr>
        <tr style="margin-top: 0">
            <td style="text-align: center;font-family: 'Futura Md BT Bold'; font-size: 10pt;">
                Profil Minat Investasi
            </td>
        </tr>

        </tbody>
    </table>

    <table style="width: 205mm;border:1px solid #224527;margin-left: auto;margin-right: auto">
        <thead>
        <tr>
            <th style="color: white;font-family: 'helvetica'; font-weight: bold;font-size: 9pt ;" colspan="3">CONTACT DETAIL/ DETAIL KONTAK</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                FULL NAME/
                <br>
                Nama Lengkap
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">{{$record->nama_pengusaha}}</td>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                JOB TITLE/
                <br>
                Jabatan
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">{{$record->jabatan_pengusaha}}</td>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                PHONE MOBILE/
                <br>
                Telepon
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">{{$record->phone}}</td>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                EMAIL/
                <br>
                Email
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">{{$record->email}}</td>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                COMPANY NAME/
                <br>
                Nama Perusahaan
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">{{$record->nama_perusahaan}}</td>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                EXISTING BUSINESS FIELD/
                <br>
                Bidang Usaha Saat Ini
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">{{$record->bidang_usaha}}</td>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                COMPANY ADDRESS/
                <br>
                Alamat Perusahaan
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">{{$record->alamat_perusahaan}}</td>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                COUNTRY ORIGIN/
                <br>
                Negara Asal
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">{{$record->asal_negara}}</td>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                PARENT COMPANY (IF ANY)/
                <br>
                Induk Perusahaan (Jika Ada)
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">{{$record->parent_company}}</td>
        </tr>
        <tr>
            <th style="color: white;font-family: 'helvetica'; font-weight: bold;font-size: 9pt ;" colspan="3">INVESTMENT INTEREST/ KEPEMINATAN INVESTASI</th>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                INTENDED BUSINESS FIELD/
                <br>
                Rencana Bidang Usaha
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">{{$record->rencana_bidang_usaha}}</td>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                INVESTMENT STATUS/
                <br>
                Status Investasi
            </td>
            <td style="text-align: left">
                <input type="checkbox" id="new" {{ $record->investment_status === 'new' ? 'checked' : '' }}>
                <label for="new"><span style="text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;">NEW (GREENFIELD)/ Baru </span></label>

            </td>
            <td style="text-align: left">
                <input type="checkbox" id="new" {{ $record->investment_status === 'expansion' ? 'checked' : '' }}>
                <label for="lawas"> <span style="text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;">EXPANSION (BROWNFIELD)/ Ekspansi </span></label>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                PREFERED LOCATION/
                <br>
                Preferensi Lokasi
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">
                @if($record->is_kawasan == false)
                    {{$record->kabKota->nama}}
                @else
                    {{$record->kawasan->nama}}
                @endif
            </td>
        </tr>
        <tr >
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                CAPITAL AMOUNT/
                <br>
                Nilai Investasi
            </td>
            <td style="text-align: left">
                <input type="checkbox" {{!empty($record->nilai_usd) ? 'checked' : ''}}> <span style="text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;">US $ {{!empty($record->nilai_usd) ? number_format($record->nilai_usd) : ''}}</span>
            </td>
            <td style="text-align: left">
                <input type="checkbox" {{!empty($record->nilai_rp) ? 'checked' : ''}}> <span style="text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;">Rp. {{!empty($record->nilai_rp) ? number_format($record->nilai_rp) : ''}}</span>
            </td>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                NUMBER OF EMPLOYEES/
                <br>
                Rencana Tenaga Kerja
            </td>
            <td style="border:1px solid #b3adad;">
                <span style="text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;">
                    <i>Local Worker</i>  / TKI
                </span>
                <br>
                <div style="text-align: left">
                    <input type="checkbox" {{!empty($record->rencana_tki) ? 'checked' : ''}}> <span style="text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;"><i>Plan</i>/ Rencana &emsp; &emsp; &emsp; &emsp;&nbsp;: {{!empty($record->rencana_tki) ? number_format($record->rencana_tki) : '0'}}  <i>People</i>/ Orang</span>
                    <br>
                    <input type="checkbox" {{!empty($record->eksisting_tki) ? 'checked' : '' }}> <span style="text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;"><i>Existing</i>/ Eksisting &nbsp;: {{!empty($record->eksisting_tki) ? number_format($record->eksisting_tki) : '0' }} <i>People</i>/ Orang</span>
                </div>
            </td>
            <td style="border:1px solid #b3adad;">
                <span style="text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;">
                    <i>Foreign Worker</i>  / TKA
                </span>
                <br>
                <div style="text-align: left">
                    <input type="checkbox" {{!empty($record->rencana_tka) ? 'checked' : ''}}> <span style="text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;"><i>Plan</i>/ Rencana &emsp; &emsp; &emsp; &emsp;&nbsp;: {{!empty($record->rencana_tka) ? number_format($record->rencana_tka) : '0'}}  <i>People</i>/ Orang</span>
                    <br>
                    <input type="checkbox" {{!empty($record->eksisting_tka) ? 'checked' : '' }}> <span style="text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;"><i>Existing</i>/ Eksisting &nbsp;: {{!empty($record->eksisting_tka) ? number_format($record->eksisting_tka) : '0' }} <i>People</i>/ Orang</span>
                </div>
            </td>
        </tr>
        <tr>
            <th style="color: white;font-family: 'helvetica'; font-weight: bold;font-size: 9pt ;" colspan="3">DETAIL INFORMATION/ DETAIL INFORMASI</th>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                PROJECT DESCRIPTION/
                <br>
                Deskripsi Proyek
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">{{$record->deskripsi_proyek}}</td>
        </tr>
        <tr>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;margin-left: 4px; width: 50mm">
                PROJECT TIMELINE/
                <br>
                Jadwal Proyek
            </td>
            <td style="border:1px solid #b3adad;text-align: left;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" colspan="2">{{$record->timeline_proyek}}</td>
        </tr>
        </tbody>
    </table>

    <br>
    <table style="width: 185mm; border-collapse: collapse; margin-left: auto; margin-right: auto;font-family: 'helvetica'; font-weight: bold; font-size: 8pt ;" border="0" >
        <tbody>
        <tr>
            <td style="text-align: center; width: 355px;">&nbsp;</td>
            <td style="width: 343px;"><span style="text-align: left; font-size: 12pt; font-family: arial, sans-serif;">Kab. Magelang, {{\Carbon\Carbon::parse($record->created_at)->locale('id')->format('j F Y')}}</span>
                <br />
                <br />
                <div style="text-align: center;" align="center">
                    <div style="font-family: 'helvetica', sans-serif; font-weight: bold; font-size: 10pt;" align="center">

                            We mentioned above,
                            <br />
                            kami tersebut diatas,
                            <br />
                            <br />
                            <br />
                            <br />




                        <br />
                        <u>
                            <span style="font-size: 10pt; font-family: 'helvetica';font-weight: bold;">{{$record->nama_pengusaha}}</span>
                        </u>
                    </div>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
</div>


</body>
</html>
