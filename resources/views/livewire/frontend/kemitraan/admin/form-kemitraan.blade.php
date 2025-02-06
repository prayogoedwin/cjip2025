<div class="book">
    <div class="page" id="result">
        <div class="header">
            <div class="flex-row">
                <img src="{{ asset('images/prov_jateng.png') }}" alt="Logo" class="logo"
                    style="width:130px; height:143px">
                <div class="desc">
                    <span style="font-size: 15px">
                        <strong>PEMERINTAH PROVINSI JAWA TENGAH</strong>
                    </span><br>
                    <span style="font-size: 20px">
                        <strong>DINAS PENANAMAN MODAL DAN PELAYANAN <br> TERPADU
                            SATU PINTU</strong>
                    </span><br>
                    <span>
                        Jalan Mgr. Sugiyopranoto No. 1 Semarang Kode Pos 50131
                    </span>
                    <br>
                    <span>
                        Telp. 024-3547091, 3547438, 3541487 Faks. 024-3549560
                    </span>
                    <br>
                    <span>
                        Website : https://web.dpmptsp.jatengprov.go.id/ Email : dpmptsp@jatengprov.go.id
                    </span>

                </div>
            </div>
        </div>
        <hr style="height: 5px; background-color:black; border:none">
        <center>
            <h4><u>SURAT PERNYATAAN KEPEMINATAN KEMITRAAN</u></h4>
        </center>
        @php
            $formatter = new IntlDateFormatter(
                'id_ID',
                IntlDateFormatter::LONG,
                IntlDateFormatter::NONE,
                'Asia/Jakarta',
                IntlDateFormatter::GREGORIAN,
                'MMMM',
            );
            $formattedDate = $formatter->format(new DateTime());
        @endphp
        <div class="content">
            <p>Pada tanggal <b>{{ date('d') }}</b> bulan <b>{{ $formattedDate }}</b> tahun
                <b>{{ date('Y') }}</b>, yang bertanda tangan
                dibawah ini :
            </p>
            <table>
                <tr>
                    <td>1.</td>
                    <td><b><u>PIHAK PERTAMA</u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nama</td>
                    <td>: {{ $record->userPeminat->name }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Jabatan</td>
                    <td>:
                        {{ $record->userPeminat->jabatan ?? '......................................................' }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nama Perusahaan</td>
                    <td>:
                        {{ $record->userPeminat->userperusahaan->nama_perusahaan ?? '......................................................' }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIB</td>
                    <td>:
                        {{ $record->product->user->userperusahaan->nama_perusahaan ?? '......................................................' }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Alamat Perusahaan</td>
                    <td>:
                        {{ $record->userPeminat->userperusahaan->alamat_perusahaan ?? '......................................................' }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Telp./Handphone</td>
                    <td>: {{ $record->userPeminat->no_hp ?? '......................................................' }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td style="width: 32%">Lokasi Proyek Bidang Usaha</td>
                    <td>:
                        {{ $record->userPeminat->userKepeminatan[0]->prefensi_lokasi ?? '......................................................' }}
                    </td>
                </tr>
            </table>
            <table>
                <tr>
                    <td>2.</td>
                    <td><b><u>PIHAK KEDUA</u></b></td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nama</td>
                    <td>: {{ $record->product->user->name }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Jabatan</td>
                    <td>:
                        {{ $record->product->user->jabatan ?? '......................................................' }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nama Perusahaan</td>
                    <td>:
                        {{ $record->product->user->userperusahaan->nama_perusahaan ?? '......................................................' }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>NIB</td>
                    <td>:
                        {{ $record->product->user->userperusahaan->nib ?? '......................................................' }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Alamat Perusahaan</td>
                    <td>:
                        {{ $record->product->user->userperusahaan->alamat_perusahaan ?? '......................................................' }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Telp./Handphone</td>
                    <td>:
                        {{ $record->product->user->no_hp ?? '......................................................' }}
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>Bidang Usaha</td>
                    <td>: ......................................................</td>
                </tr>
            </table>
            <p style="text-indent: 41px">Dalam pelaksanaan kegiatan Fasilitasi Temu Usaha yang difasilitasi Dinas
                Penanaman Modal dan Pelayanan
                Terpadu Satu Pintu (DPMPTSP) Provinsi Jawa Tengah, dengan ini kami <b>KEDUA BELAH PIHAK</b> menyatakan
                <b>BERMINAT</b>.
            </p>
            <ol>
                <li>Melakukan kerjasama kemitraan dalam bentuk :
                </li>
                <li>Rencana Nilai Pekerjaan : <b>Rp {{ number_format($record->rencana_nilai_pekerjaan) }}</b></li>
                <li>Melakukan pembicaraan lebih lanjut untuk memperoleh kesepakatan kerjasama dalam hal ketentuan dan
                    aturan yang akan dilaksanakan.</li>
            </ol>
            <p style="margin-bottom: 20%">Demikian Surat Pernyataan Kepeminatan Kemitraan ini dibuat untuk dipergunakan
                sebagaimana perlunya.</p>
            <br>
            <br>
            <p class="print-margin-top" style="margin-top: 50%; text-align:right">Semarang,
                {{ date('d') . ' ' . $formattedDate . ' ' . date('Y') }}</p>
        </div>
        <div class="footer">
            <div class="signature">
                <p>PIHAK PERTAMA</p>
                <br><br><br><br>
                <p><b>{{ $record->userPeminat->name }}</b></p>
            </div>
            <div class="signature">
                <p>PIHAK KEDUA</p>
                <br><br><br><br>
                <p><b>{{ $record->product->user->name }}</b></p>
            </div>
        </div>
        <div class="footer">
            <p>Mengetahui,</p>
            <p>KEPALA DINAS PENANAMAN MODAL DAN PELAYANAN <br>TERPADU SATU PINTU PROVINSI JAWA TENGAH</p>
            <br><br>
            <p><u>Ir. SAKINA ROSELLASARI, M.Si, M.Sc</u><br>
                Pembina Utama Madya<br>
                NIP. 19660821 199303 2 006</p>
        </div>
    </div>
</div>
