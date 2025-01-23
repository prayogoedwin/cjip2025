<div class="book">
    <div class="page" id="result">
        <center>
            <img src="{{ asset('images/logo-jateng.jpg') }}" alt="" width="120px">
            <h3>PEMERINTAH PROVINSI JAWA TENGAH</h3>
            <p style="font-size:20px">DINAS PENANAMAN MODAL DAN PELAYANAN TERPADU SATU PINTU <br>KEPUTUSAN KEPALA DINAS
                PENANAMAN MODAL DAN <br>PELAYANAN TERPADU SATU PINTU <br>PROVINSI JAWA TENGAH</p>
            <p>NOMOR …/… TAHUN 2024</p>
            <p>TENTANG</p>
            <p>PEMBERIAN INSENTIF DAN KEMUDAHAN PENANAMAN MODAL <br>
                KEPALA DINAS PENANAMAN MODAL DAN <br> PELAYANAN TERPADU SATU PINTU <br>PROVINSI JAWA TENGAH,
            </p>
        </center>
        <table>
            <tr>
                <td style="width: 150px; vertical-align: top;">Menimbang</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    <ol type="a" style="text-align: justify; margin: 0;">
                        <li style="margin: 0;">
                            bahwa berdasarkan permohonan a.n. Sdr./Sdri. {{ ucwords(strtolower($record->user->name)) }}.
                            untuk mendapatkan
                            insentif dan
                            kemudahan penanaman modal yang diterima tanggal {{ $record->menerima_diterima }}., dan
                            berdasarkan penilaian dan
                            kriteria tertentu, maka pemohon yang dimaksud diberikan insentif dan kemudahan penanaman
                            modal yang ditetapkan dengan Keputusan Gubernur Jawa Tengah;
                        </li>
                        <li style="margin: 0">
                            bahwa berdasarkan pertimbangan sebagaimana dimaksud huruf a, perlu menetapkan Keputusan
                            Gubernur Jawa Tengah tentang Pemberian Insentif dan Kemudahan Penanaman Modal.
                        </li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; vertical-align: top;">Mengingat</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    <ol type="1" style="text-align: justify; margin: 0;">
                        <li style="margin: 0;">
                            Peraturan Daerah Provinsi Jawa Tengah Nomor 12 Tahun 2022 tentang Penyelenggaraan
                            Penanaman Modal (Lembaran Daerah Provinsi Jawa Tengah Tahun 2022 Nomor 12);
                        </li>
                        <li style="margin: 0">
                            Peraturan Gubernur Jawa Tengah Nomor 36 Tahun 2023 tentang Petunjuk Pelaksanaan Peraturan
                            Daerah Provinsi Jawa Tengah Nomor 12 Tahun 2022 tentang Penyelenggaraan Penanaman Modal
                            (Lembaran Daerah Provinsi Jawa Tengah Tahun 2023 Nomor 36).
                        </li>
                    </ol>
                </td>
            </tr>
        </table>

        <center>
            <p style="margin-top: 10px; margin-bottom: 10px;">MEMUTUSKAN</p>
        </center>

        <table style="margin-bottom: 40px">
            <tr>
                <td style="width: 150px; vertical-align: top;">Menetapkan</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    Keputusan Gubernur Jawa Tengah tentang Pemberian Insentif dan Kemudahan Penanaman Modal kepada
                    {{ $record->user->name }}
                </td>
            </tr>
            <tr>
                <td style="width: 150px; vertical-align: top;">KESATU</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    Memberikan Insentif berupa {{ $record->kesatu_insentif }}. yakni sebesar:
                    {{ number_format($record->kesatu_sebesar) }}
                </td>
            </tr>
            <tr>
                <td style="width: 150px; vertical-align: top;">KEDUA</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    Memberikan Kemudahan Penanaman Modal kepada {{ $record->user->name }} yakni berupa : <br>
                    {{ $record->kedua }}
                </td>
            </tr>
            <tr>
                <td style="width: 150px; vertical-align: top;">KETIGA</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    Pemberian Insentif dan Kemudahan Penanaman Modal sebagaimana dimaksud dalam Diktum KESATU dan Diktum
                    KEDUA dilaksanakan oleh Perangkat Daerah : <br>
                    {{ $record->ketiga }}
                </td>
            </tr>
            <tr>
                <td style="width: 150px; vertical-align: top;">KEEMPAT</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    {{ $record->keempat }}
                </td>
            </tr>
            <tr>
                <td style="width: 150px; vertical-align: top;">KELIMA</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    Penerima sebagaimana dimaksud dalam Diktum KESATU wajib :
                    <ol type="a" style="text-align: justify; margin: 0;">
                        <li style="margin: 0">menyampaikan laporan kegiatan kepada Gubernur cq. Kepala Dinas Penanaman
                            Modal dan Pelayanan
                            Terpadu Satu Pintu Provinsi Jawa Tengah paling sedikit 1 (satu) kali dalam 1 (satu) tahun
                            terhitung sejak Keputusan Gubernur Jawa Tengah ini ditetapkan; dan</li>
                        <li>
                            laporan sebagaimana dimaksud pada huruf a paling sedikit memuat :
                            <ol type="1" style="text-align: justify; margin: 0;">
                                <li style="margin: 0">pemanfaatan Insentif dan Kemudahan yang diberikan;</li>
                                <li style="margin: 0">pemanfaatan Insentif dan Kemudahan yang diberikan;</li>
                                <li style="margin: 0">nilai investasi dan jumlah tenaga kerja lokal yang diserap serta
                                    jenis usaha yang
                                    dilaksanakan; dan</li>
                                <li style="margin: 0">perkembangan pelaksanaan investasi</li>
                            </ol>
                        </li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; vertical-align: top;">KEENAM</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    Selain kewajiban sebagaimana dimaksud dalam Diktum KELIMA, terhadap penerima berlaku ketentuan
                    sebagai berikut :
                    <ol type="1" style="text-align: justify; margin: 0;">
                        <li style="margin: 0">memanfaatkan Insentif dan/atau Kemudahan Penanaman Modal yang diberikan
                            sesuai dengan jangka waktu yang diberikan sebagaimana dimaksud dalam Diktum KEEMPAT; dan
                        </li>
                        <li style="margin: 0">memenuhi nilai investasi dan/atau jumlah tenaga kerja lokal yang
                            diserap dan/atau jenis usaha, sesuai dengan yang tercantum dalam permohonan Pemberian
                            Insentif dan Kemudahan Penanaman Modal.
                        </li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td style="width: 150px; vertical-align: top;">KETUJUH</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    Dalam hal penerima sebagaimana dimaksud dalam Diktum KESATU melanggar ketentuan sebagaimana dimaksud
                    dalam Diktum KELIMA dan Diktum KEENAM, yang bersangkutan dijatuhkan sanksi administrasi sesuai
                    ketentuan yang diatur dalam Peraturan Dinas ini.
                </td>
            </tr>
            <tr>
                <td style="width: 150px; vertical-align: top;">KEDELAPAN</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    Apabila sanksi administrasi dalam bentuk pembatalan Pemberian Insentif telah diberikan, maka
                    penerima insentif wajib mengembalikan Insentif dan menyetorkan ke kas daerah Pemerintah Provinsi
                    Jawa Tengah paling lambat 7 (tujuh) hari kerja setelah sanksi pembatalan pemberian Insentif
                    diberikan, sebesar yang telah ditetapkan oleh Tim.
                </td>
            </tr>
            <tr>
                <td style="width: 150px; vertical-align: top;">KESEMBILAN</td>
                <td style="vertical-align: top;">:</td>
                <td style="vertical-align: top;">
                    Keputusan Gubernur Jawa Tengah ini mulai berlaku pada tanggal ditetapkan.
                </td>
            </tr>
        </table>
        <div style="float:right">
            <div style="width: 295px;text-align: left;">
                <p>Ditetapkan di Semarang <br>Pada Tanggal.........................<?= date('Y') ?></p>
                <center>
                    <p>KEPALA DINAS PENANAMAN MODAL DAN <br>PELAYANAN TERPADU SATU PINTU <br>PROVINSI JAWA TENGAH,</p>

                    <p style="margin-top: 40px"><u>Nama</u> <br>
                        Pangkat/Gol.
                    </p>
                </center>
                <p>NIP............................................</p>
            </div>
        </div>
    </div>
</div>
