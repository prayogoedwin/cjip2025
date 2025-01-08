<div>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin-left: 20px;
            margin-right: 20px;
            padding-right: 40px;
            font-size: 14px;
        }

        .header {
            display: flex;
            align-items: center;
            margin-left: 50px;
            margin-top: -30px;
            /* margin-bottom: 5px; */
        }

        .logo {
            flex: 0 0 20%;
            margin-top: 80px;
            text-align: center;
        }

        .logo img {
            max-width: 40%;
            height: auto;
        }

        .title {
            flex: 0 0 70%;
            text-align: left;
        }

        .title h1 {
            font-size: 50px;
            /* Adjust the font size as needed */

        }

        .subtitle {
            text-align: center;
            margin-bottom: 20px;
            margin-top: -80px;
        }

        .contact-details {
            margin-top: 20px;
        }

        .contact-details table tr th {
            background-color: grey !important;
            padding: 5px;
            margin: 0;
            font-weight: bold;
        }

        .contact-details table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px;
        }

        .contact-details td {
            padding: 5px;
            border: 1px solid #ddd;
        }

        .contact-details td:first-child {
            width: 40%;
            font-weight: bold;
        }

        .footer {
            margin-top: 20px;
            text-align: right;
            margin-right: 50px;
        }

        .footer .city-date {
            /* margin-bottom: 50px; */
            /* Center align the content within the city-date */
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            /* Align items to the right */
        }

        .footer .signature {
            margin-top: 5px;
            /* Adjust as needed */
            display: flex;
            flex-direction: column;
            align-items: center;
            /* Center align the signature */
        }

        .footer .signature img {
            /* margin-bottom: 5px; */
            /* Add space below the image */
        }

        .footer .signatureh3 {
            display: block;
            /* margin-top: 10px; */
            font-weight: bold;
            margin-right: 1px;
            text-align: center;
            /* Center the text under the signature */
        }
    </style>

    <div class="container">

        <div class="header">
            <div class="logo">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/bd/Coat_of_arms_of_Central_Java.svg/1200px-Coat_of_arms_of_Central_Java.svg.png"
                    alt="Logo" />
            </div>
            <div class="title">
                <h1 style="text-size:40px">LETTER OF INTENT</h1>
            </div>
        </div>

        <div class="subtitle">
            <h3>INVESTMENT ACCOUNT PROFILE</h3>
            <p style="margin-top:-20px;">Profil Minat Investasi</p>
        </div>

        <div class="contact-details">
            {{-- <p style="text-align:center">CONTACT DETAIL / DETAIL CONTACT</p> --}}
            <table>
                <tr>
                    <th colspan=2>CONTACT DETAIL / DETAIL CONTACT</th>
                </tr>
                <tr>
                    <td width="40%">Full Name</td>
                    <td>{{ $pengajuan->user->name }}</td>
                </tr>
                <tr>
                    <td width="40%">OB TITLE / Jabatan</td>
                    <td>{{ $pengajuan->user->jabatan }}</td>
                </tr>
                <tr>
                    <td width="40%">PHONE / MOBILE / Telepon</td>
                    <td>{{ $pengajuan->user->no_hp }}</td>
                </tr>
                <tr>
                    <td width="40%">EMAIL / Email</td>
                    <td>{{ $pengajuan->user->email }}</td>
                </tr>
                <tr>
                    <td width="40%">COMPANY NAME / Nama Perusahaan</td>
                    <td>{{ $perush->nama_perusahaan }}</td>
                </tr>
                <tr>
                    <td width="40%">EXISTING BUSINESS FIELD /
                        Bidang
                        Usaha
                        Saat Ini</td>
                    <td>{{ $perush->jenis_usaha }}</td>
                </tr>
                <tr>
                    <td width="40%">COMPANY ADDRESS / Alamat
                        Perusahaan</td>
                    <td>{{ $perush->alamat_perusahaan }}</td>
                </tr>
                <tr>
                    <td width="40%">COUNTRY ORIGIN / Negara Asal</td>
                    <td>{{ $perush->negara_asal }}</td>
                </tr>

                <tr>
                    <td width="40%">PARENT COMPANY (IF ANY) /
                        Induk
                        Perusahaan (Jika Ada)</td>
                    <td>{{ $perush->induk_perusahaan }}</td>

                </tr>


                <!-- Add more rows as needed -->
            </table>

            <table>
                <tr>
                    <th colspan=2>INVESMENT INTEREST / Kepemintan Investasi </th>
                </tr>
                <tr>
                    <td width="40%">INTENDED BUSINESS FIELD / Rencana Bidang Usaha</td>
                    <td> {{ $pengajuan->rencana_bidang_usaha }}</td>
                </tr>
                <tr>
                    <td width="40%">INVESMENT STATUS / status Investasi</td>

                    <td>
                        @if ($pengajuan->status_investasi == 1)
                            NEW (GREENFIELD) / Baru
                        @else
                            EXPANSION (BROWNFIELD) / Ekspansi
                        @endif
                    </td>
                </tr>
                <tr>
                    <td width="40%">PREFERED LOCATION / Prefensi Lokasi</td>
                    <td> {{ $pengajuan->prefensi_lokasi }}</td>
                </tr>
                <tr>
                    <td width="40%">CAPITAL AMOUNT / Nilai Investasi</td>
                    <td>

                        @if ($pengajuan->nilai_investasi != '')
                            US {{ number_format($pengajuan->nilai_investasi, 2, '.', ',') }}<br />
                        @endif
                        @if ($pengajuan->nilai_investasi_rupiah != '')
                            Rp. {{ number_format($pengajuan->nilai_investasi_rupiah, 0, ',', '.') }}
                        @endif
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td width="40%">NUMBER OF EMPLOYEES / Rencana Tenaga Kerja</td>
                    <td>
                        <table>
                            <tr>
                                <td style="font-weight: normal !important; font-size:12px" width="50%">
                                    <span style="text-align:center">Local Worker / TKI</span>
                                    <ul style="margin-left:-20px">
                                        <li>Plan/Rencana:
                                            {{ $pengajuan->local_worker_plan != '' ? $pengajuan->local_worker_plan : '0' }}
                                            People/Orang</li>
                                        <li>Existing/Eksisting:
                                            {{ $pengajuan->local_worker_plan != '' ? $pengajuan->local_worker_exis : '0' }}
                                            People/Orang</li>
                                    </ul>
                                </td>
                                <td style="font-weight: normal !important; font-size:12px" width="50%">
                                    <span style="text-align:center">Foreign Worker / TKA</span>
                                    <ul style="margin-left:-20px">
                                        <li>Plan/Rencana:
                                            {{ $pengajuan->foreign_worker_plan != '' ? $pengajuan->foreign_worker_plan : '0' }}
                                            People/Orang</li>
                                        <li>Existing/Eksisting:
                                            {{ $pengajuan->foreign_worker_exis != '' ? $pengajuan->foreign_worker_exis : '0' }}
                                            People/Orang</li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <!-- Add more rows as needed -->
            </table>

            <table>
                <tr>
                    <th colspan=2>DETAIL INFORMATION / INFORMASI DETAIL</th>
                </tr>
                <tr>
                    <td width="40%">PROJECT DESCRIPTION / Deskripsi Proyek</td>
                    <td> {{ $pengajuan->deskripsi_proyek }}</td>
                </tr>
                <tr>
                    <td width="40%">TIMLINE PROJECT / Jadwal Proyek</td>
                    <td> {{ \Carbon\Carbon::parse($pengajuan->jadwal_proyek)->translatedFormat('d F Y') }}</td>
                </tr>

                <!-- Add more rows as needed -->
            </table>

            <div class="footer">
                <div class="city-date" style="margin-top: 10px">
                    Semarang, .... {{ \Carbon\Carbon::parse($pengajuan->created_at)->translatedFormat(' F Y') }}
                    <img id="svgImage" class="signature relative" src="{{ $pengajuan->signature }}" />
                    <h3 class="signatureh3" style="margin-right: 10px;">( {{ $pengajuan->user->name }} )</h3>
                </div>
            </div>

            @push('js')
                <script>
                    function convertSVGToPNG(svgElement, callback) {
                        const svgData = svgElement.src.replace(/^data:image\/svg\+xml;base64,/, '');
                        const svgBlob = new Blob([atob(svgData)], {
                            type: 'image/svg+xml;charset=utf-8'
                        });
                        const reader = new FileReader();

                        reader.onload = function() {
                            const img = new Image();
                            img.src = reader.result;
                            img.onload = function() {
                                const canvas = document.createElement('canvas');
                                canvas.width = img.width;
                                canvas.height = img.height;
                                const ctx = canvas.getContext('2d');
                                ctx.drawImage(img, 0, 0);
                                const pngData = canvas.toDataURL('image/png');
                                callback(pngData);
                            };
                        };

                        reader.readAsDataURL(svgBlob);
                    }

                    window.onload = function() {
                        const svgImage = document.getElementById('svgImage');
                        const pngImage = document.getElementById('pngImage');

                        convertSVGToPNG(svgImage, function(pngData) {
                            pngImage.src = pngData;
                        });
                    };
                </script>
            @endpush

        </div>
    </div>
</div>
