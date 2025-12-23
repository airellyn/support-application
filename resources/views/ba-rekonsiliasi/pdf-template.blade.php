<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Berita Acara Rekonsiliasi</title>
    <style>
        @page {
            margin: 1.5cm;
            size: A4;
        }
        
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 11pt;
            line-height: 1.4;
            margin: 0;
            padding: 0;
            text-align: justify;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20pt;
        }
        
        .header h1 {
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 3pt;
        }
        
        .header h2 {
            font-size: 11pt;
            font-weight: normal;
            margin: 1pt 0;
        }

        .nomor-pihak {
            margin-bottom: 12pt;
        }
        
        .horizontal-line {
            border-bottom: 2px solid #000;
            margin: 15pt 0;
            width: 100%;
        }
        
        .content {
            text-align: justify;
        }
        
        .paragraph {
            margin-bottom: 8pt;
            text-indent: 1cm;
        }
        
        .no-indent {
            text-indent: 0;
        }
        
        /* TABEL UTAMA - 3 KOLOM */
        .main-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10pt 0;
            font-size: 10pt;
        }
        
        .main-table, .main-table th, .main-table td {
            border: 1px solid black;
        }
        
        .main-table th, .main-table td {
            padding: 5pt;
            vertical-align: top;
        }
        
        .main-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
        }
        
        /* TABEL DALAM TABEL - SKEMA KOMERSIAL */
        .commercial-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 8pt;
        }
        
        .commercial-table, .commercial-table th, .commercial-table td {
            border: 1px solid black;
        }
        
        .commercial-table th, .commercial-table td {
            padding: 3pt 2pt;
            text-align: center;
        }
        
        .commercial-table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        
        /* TABEL GABUNGAN DESKRIPSI DAN NILAI */
        .combined-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 9pt;
            margin: 10pt 0;
        }
        
        .combined-table, .combined-table th, .combined-table td {
            border: 1px solid black;
        }
        
        .combined-table th {
            background-color: #f0f0f0;
            font-weight: bold;
            text-align: center;
            padding: 6pt;
        }
        
        .combined-table td {
            padding: 6pt;
            vertical-align: top;
        }
        
        .keterangan {
            font-style: italic;
            font-size: 8pt;
            color: #555;
            margin-top: 3px;
            display: block;
        }
        
        .nilai-keterangan {
            font-style: italic;
            font-size: 8pt;
            color: #555;
            margin-left: 5px;
        }
        
        .deskripsi-content {
            margin-bottom: 3px;
            font-weight: normal;
        }
        
        /* TABEL LAMPIRAN */
        .lampiran-table {
            width: 100%;
            border-collapse: collapse;
            margin: 10pt 0;
            font-size: 9pt;
        }
        
        .lampiran-table, .lampiran-table th, .lampiran-table td {
            border: 1px solid black;
        }
        
        .lampiran-table th, .lampiran-table td {
            padding: 4pt;
            text-align: center;
        }
        
        .lampiran-table th {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        
        .text-center { text-align: center; }
        .text-left { text-align: left; }
        .text-right { text-align: right; }
        .bold { font-weight: bold; }
        .underline { text-decoration: underline; }
        .vertical-middle { vertical-align: middle; }
        
        /* PAGE BREAK */
        .page-break {
            page-break-before: always;
        }
        
        /* LAMPIRAN HEADER TANPA GARIS */
        .lampiran-header {
            text-align: center;
            margin-bottom: 20pt;
            padding-bottom: 10pt;
        }
        
        .lampiran-title {
            font-size: 14pt;
            font-weight: bold;
            margin-bottom: 5pt;
        }
        
        .lampiran-subtitle {
            font-size: 12pt;
            margin-bottom: 3pt;
        }
        
        /* AREA TANDA TANGAN YANG DIPERBESAR TAPI PROPORSIONAL */
        .signature-area {
            margin-top: 30pt;
            padding-top: 15pt;
        }
        
        .signature-box-1 {
            text-align: center;
            width: 50%;
            padding: 0 10pt;
        }

        .signature-box-2 {
            text-align: center;
            width: 50%;
            padding: 0 20pt;
        }
        
        .signature-line {
            margin-top: 50pt;
            border-bottom: 1px solid black;
            width: 220pt;
            display: inline-block;
        }
        
        .signature-name {
            margin-top: 6pt;
            font-weight: bold;
        }
        
        .signature-position-1{
            margin-top: 4pt;
            font-size: 10pt;
        }

        .signature-position-2{
            margin-top: 4pt;
            font-size: 10pt;
        }
        
        /* TEKS PENUTUP YANG LEBIH RAPI */
        .closing-paragraph {
            margin-bottom: 15pt;
            text-indent: 1cm;
            line-height: 1.4;
        }
        
        /* SECTION BREAK UNTUK LAMPIRAN */
        .section-break {
            page-break-before: always;
            break-before: page;
        }
        
        /* STYLE DARI KODINGAN PERTAMA YANG PERLU DIPERTAHANKAN */
        .ml-8 {
            margin-left: 0.8cm;
        }
        
        .mt-5 {
            margin-top: 5pt;
        }
        
        .mt-10 {
            margin-top: 10pt;
        }
        
        .mb-5 {
            margin-bottom: 5pt;
        }
        
        /* COLUMN WIDTHS */
        .col-no {
            width: 5%;
            text-align: center;
        }
        
        .col-ketentuan {
            width: 15%;
        }
        
        .col-deskripsi {
            width: 80%;
        }
    </style>
</head>
<body>
    <!-- Halaman: Berita Acara Rekonsiliasi -->
    <div class="header">
        <h1>BERITA ACARA REKONSILIASI ANTARA</h1>
        <h2>PT INDONESIA COMNETS PLUS DAN</h2>
        <h2>PT ANTA EXPRESS TOUR & TRAVEL SERVICE PERIHAL</h2>
        <h2>LAYANAN CO-TRAVEL MILIK PT PELAYARAN BAHTERA ADHIGUNA (BAG)</h2>
        <h2>PERIODE JULI 2025</h2>
    </div>

    <div class="nomor-pihak">
        <div><strong>Nomor PIHAK PERTAMA</strong>: 32970.BA/STI.01.02/IC010201/2025</div>
        <div><strong>Nomor PIHAK KEDUA</strong>: </div>
    </div>

    <!-- GARIS HORIZONTAL DI BAWAH NOMOR PIHAK KEDUA -->
    <div class="horizontal-line"></div>

    <div class="content">
        <p class="paragraph">
            Berita Acara Rekonsiliasi ini (selanjutnya disebut "BAR") dibuat pada hari 
            <span class="bold">Kamis</span> tanggal 
            <span class="bold">Tujuh</span> bulan 
            <span class="bold">Agustus</span> tahun 
            <span class="bold">Dua Ribu Dua Puluh Lima</span> 
            (07-08-2025) di Jakarta, oleh dan antara:
        </p>

        <p class="no-indent bold">I. PT INDONESIA COMNETS PLUS (untuk selanjutnya disebut sebagai "PIHAK PERTAMA")</p>
        
        <div class="ml-8">
            <div>Diwakili oleh &nbsp;&nbsp;&nbsp;&nbsp;: Arif Bijak Bestari</div>
            <div>Jabatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Vice President Pelayanan Aplikasi</div>
            <div>Alamat Kantor &nbsp;&nbsp;: Jalan K. H. Abdul Rochim No. 1 Kuningan Barat, Mampang, Jakarta Selatan 12710</div>
        </div>

        <p class="no-indent bold mt-10">II. PT ANTA EXPRESS TOUR & TRAVEL SERVICE (untuk selanjutnya disebut "PIHAK KEDUA")</p>
        
        <div class="ml-8">
            <div>Diwakili oleh &nbsp;&nbsp;&nbsp;&nbsp;: Purnama Dewi</div>
            <div>Jabatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;: Manager finance</div>
            <div>Alamat Kantor &nbsp;&nbsp;: Jl. Batu Tulis Raya no 38 Jakarta Pusat 10120</div>
        </div>

        <p class="paragraph bold">
            PIHAK PERTAMA dan PIHAK KEDUA untuk selanjutnya secara masing-masing disebut sebagai "PIHAK" dan secara bersama-sama disebut "PARA PIHAK".
        </p>

        <p class="paragraph no-indent">Berdasarkan pertimbangan-pertimbangan di bawah :</p>
        
        <ol style="list-style-type: lower-alpha; margin-left: 1.5cm; padding-left: 0; font-size: 11pt;">
            <li style="margin-bottom: 5pt;">
                Bahwa PARA PIHAK telah menandatangani Perjanjian Kerja Sama dengan Nomor 
                <span class="bold">PIHAK PERTAMA: 0558.Pj/HKM.02.01/IC010204/2025</span> Nomor 
                <span class="bold">PIHAK KEDUA: AE-079-LGL/IV/25</span> tertanggal 15 April 2025 
                tentang Perjanjian Kerjasama Penyediaan Layanan Manajemen Transportasi ("Perjanjian").
            </li>
            <li style="margin-bottom: 5pt;">
                Bahwa PARA PIHAK telah menandatangani Berita Acara Kesepakatan dengan Nomor 
                <span class="bold">PIHAK PERTAMA: 22583.ba/HKM.02.01/ICO10204/2025</span> Nomor 
                <span class="bold">PIHAK KEDUA: AE-109-LGL/V/25</span> tertanggal 28 Mei 2025 
                tentang Layanan Co-Travel Milik PT Pelayaran Bahtera Adhiguna (BAG) ("Berita Acara Kesepakatan")
            </li>
        </ol>

        <p class="paragraph">Berdasarkan hal-hal tersebut di atas, PARA PIHAK telah menyepakati hal-hal sebagai berikut:</p>

        <div class="section-break"></div>

        <!-- TABEL UTAMA - 3 KOLOM -->
        <table class="main-table">
            <tr>
                <th class="col-no">No</th>
                <th class="col-ketentuan">Ketentuan</th>
                <th class="col-deskripsi">Deskripsi</th>
            </tr>
            
            <!-- ROW 1: PERIODE -->
            <tr>
                <td class="col-no text-center vertical-middle">1</td>
                <td class="col-ketentuan vertical-middle">Periode</td>
                <td class="col-deskripsi vertical-middle">1 Juli 2025 – 31 Juli 2025</td>
            </tr>
            
            <!-- ROW 2: SKEMA KOMERSIAL -->
            <tr>
                <td class="col-no text-center vertical-middle" rowspan="9">2</td>
                <td class="col-ketentuan vertical-middle" rowspan="9">Skema Komersial</td>
                <td class="col-deskripsi" style="padding: 0;">
                    <table class="commercial-table">
                        <tr>
                            <th rowspan="2">Rincian Transaksi</th>
                            <th rowspan="2">Uraian Layanan</th>
                            <th colspan="2">Jumlah Transaksi</th>
                            <th rowspan="2">Value added Tax (VAT)</th>
                            <th rowspan="2">Nilai (Exc. VAT)</th>
                            <th rowspan="2">Total Pajak</th>
                        </tr>
                        <tr>
                            <th>(Exc. VAT)</th>
                            <th>(Incl. VAT)</th>
                        </tr>
                        
                        <tr>
                            <td rowspan="4" class="text-center">Rincian Transaksi</td>
                            <td class="text-left">Tiket Pesawat</td>
                            <td class="text-right">Rp 106.412.071</td>
                            <td class="text-right">Rp 106.412.071</td>
                            <td class="text-center">0%</td>
                            <td class="text-right">Rp 106.412.071</td>
                            <td class="text-right">0</td>
                        </tr>
                        
                        <tr>
                            <td class="text-left">Pemesanan Hotel</td>
                            <td class="text-right">0</td>
                            <td class="text-right">0</td>
                            <td class="text-center">0%</td>
                            <td class="text-right">0</td>
                            <td class="text-right">0</td>
                        </tr>
                        
                        <tr>
                            <td class="text-left">Tiket Kereta Api</td>
                            <td class="text-right">0</td>
                            <td class="text-right">0</td>
                            <td class="text-center">0%</td>
                            <td class="text-right">0</td>
                            <td class="text-right">0</td>
                        </tr>
                        
                        <tr>
                            <td class="text-left">Manajemen fee 3,5%</td>
                            <td class="text-right">Rp 3.869.386</td>
                            <td class="text-right">Rp 4.334.018</td>
                            <td class="text-center">12%</td>
                            <td class="text-right">Rp 3.869.386</td>
                            <td class="text-right">Rp 464.326</td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" class="bold text-left">Nilai Total (Exc. VAT)</td>
                            <td colspan="5" class="bold text-right">Rp 110.281.457</td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" class="bold text-left">Total Nilai yang dibebankan Pajak</td>
                            <td colspan="5" class="bold text-right">Rp 3.869.386</td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" class="bold text-left">VAT @ 12%</td>
                            <td colspan="5" class="bold text-right">Rp 464.326</td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" class="bold text-left">Grand Total (Incl. VAT)</td>
                            <td colspan="5" class="bold text-right">Rp 110.745.783</td>
                        </tr>
                    </table>

                    <!-- TABEL GABUNGAN DESKRIPSI DAN NILAI -->
                    <div style="padding: 10pt;">
                        <table class="combined-table">
                            <thead>
                                <tr>
                                    <th style="width: 60%; text-align: center;">Deskripsi</th>
                                    <th style="width: 40%; text-align: center;">Nilai (Rp)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-left">
                                        <div class="deskripsi-content">Nilai Total Layanan Tiket Pesawat dan Pemesanan Hotel dan Tiket Kereta Api (A)</div>
                                        <span class="keterangan">Keterangan : Nilai tersebut tidak terkena pajak karena komponen nilai Layanan sudah termasuk pajak</span>
                                    </td>
                                    <td class="text-right">
                                        Rp 106.412.071
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="deskripsi-content">Manajemen Fee (B)</div>
                                        <span class="keterangan">Keterangan : Nilai tersebut belum termasuk pajak</span>
                                    </td>
                                    <td class="text-right">
                                        Rp 3.869.386 <span class="nilai-keterangan">(belum termasuk pajak)</span>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="deskripsi-content">PPN atas Manajemen Fee (C)</div>
                                        <span class="keterangan">Keterangan : Total Pajak atas Manajemen Fee</span>
                                    </td>
                                    <td class="text-right">
                                        Rp 464.326
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left">
                                        <div class="deskripsi-content">Grand Total (Exc. VAT) (A) + (B)</div>
                                        <span class="keterangan">Keterangan : Nilai tersebut belum termasuk Pajak</span>
                                    </td>
                                    <td class="text-right">
                                        Rp 110.281.457
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-left bold">
                                        <div class="deskripsi-content">Grand Total (Incl. VAT) (A) + (B) + (C)</div>
                                        <span class="keterangan">Keterangan : Nilai sudah termasuk Pajak</span>
                                    </td>
                                    <td class="text-right bold">
                                        Rp 110.745.783
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </table>

        <div class="section-break"></div>

        <!-- TABEL BARU UNTUK KETENTUAN PEMBAYARAN DAN PAJAK -->
        <table class="main-table">
            <tr>
                <th class="col-no">No</th>
                <th class="col-ketentuan">Ketentuan</th>
                <th class="col-deskripsi">Deskripsi</th>
            </tr>
            
            <!-- ROW 1: PEMBAYARAN -->
            <tr>
                <td class="col-no text-center vertical-middle">3</td>
                <td class="col-ketentuan vertical-middle">Pembayaran</td>
                <td class="col-deskripsi vertical-middle">
                    Pembayaran tagihan sebagaimana dimaksud dalam poin (2) pada tabel ini wajib dilakukan oleh PIHAK PERTAMA kepada PIHAK KEDUA selambat-lambatnya 45 Hari Kalender setelah tagihan dan dokumen penagihan dari PIHAK KEDUA dinyatakan lengkap oleh PIHAK PERTAMA melalui transfer ke rekening:<br>
                    <strong>Bank : Bank BCA No. Rekening : 0123036473</strong><br>
                    <strong>Atas Nama : PT Anta Express Tour & Travel Service Cabang Bank : Gajah Mada</strong>
                </td>
            </tr>
            
            <!-- ROW 2: PAJAK -->
            <tr>
                <td class="col-no text-center vertical-middle">4</td>
                <td class="col-ketentuan vertical-middle">Pajak</td>
                <td class="col-deskripsi vertical-middle">
                    <p>1. Segala Pajak dan Bea yang timbul akibat pelaksanaan Pekerjaan dalam Perjanjian, menjadi tanggungan oleh masing-masing PIHAK sesuai ketentuan peraturan perpajakan yang berlaku di Indonesia.</p>
                    <p>2. Apabila di kemudian hari ditemukan pelaksanaan kewajiban perpajakan yang tidak sesuai dengan ketentuan sebagaimana pada ayat 1 Pasal ini, maka masing-masing PIHAK diwajibkan dan bersedia menanggung segala biaya/resiko yang timbul termasuk dan tidak terbatas pada hutang pajak beserta sanksi-sanksi perpajakan yang berlaku di Indonesia.</p>
                </td>
            </tr>
        </table>

        <!-- TANDA TANGAN YANG DIPERBESAR TAPI PROPORSIONAL -->
        <div class="signature-area">
            <p class="closing-paragraph">
                Demikian <span class="bold">BA Rekonsiliasi</span> ini dibuat dan ditandatangani oleh 
                <span class="bold">PARA PIHAK</span> dalam 2 (dua) rangkap, bermeterai cukup, dan 
                masing-masing <span class="bold">PIHAK</span> akan memperoleh salah satu di antaranya 
                sebagai asli dan masing-masing rangkap mempunyai kekuatan hukum yang sama.
            </p>
            
            <table style="width: 100%;">
                <tr>
                    <td class="signature-box-1">
                        <div class="bold">PT INDONESIA COMNETS PLUS</div>
                        <div class="signature-line"></div>
                        <div class="signature-name">ARIF BIJAK BESTARI</div>
                        <div class="signature-position-1">VICE PRESIDENT PELAYANAN APLIKASI</div>
                    </td>
                    <td class="signature-box-2">
                        <div class="bold">PT ANTA EXPRESS TOUR & TRAVEL SERVICE</div>
                        <div class="signature-line"></div>
                        <div class="signature-name">PURNAMA DEWI</div>
                        <div class="signature-position-2">MANAGER FINANCE</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <!-- SECTION BREAK UNTUK LAMPIRAN 1 -->
    <div class="section-break"></div>

    <!-- HALAMAN LAMPIRAN 1: RINCIAN TRANSAKSI TIKET PESAWAT -->
    <div class="lampiran-header">
        <div class="lampiran-subtitle">RINCIAN TRANSAKSI TIKET PESAWAT</div>
        <div>PT INDONESIA COMNETS PLUS</div>
        <div>PERIODE JULI 2025</div>
    </div>

    <table class="lampiran-table">
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 15%">Traveler Name</th>
                <th style="width: 10%">Description</th>
                <th style="width: 12%">Airline Name</th>
                <th style="width: 10%">Departure Date</th>
                <th style="width: 10%">Return Date</th>
                <th style="width: 10%">Total Fare</th>
                <th style="width: 10%">Travel Services</th>
                <th style="width: 8%">VAT</th>
                <th style="width: 10%">Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td class="text-left">WASKITO ARIYANTO, MR</td>
                <td>BTH-CGK</td>
                <td>CITILINK</td>
                <td>02/07/2025</td>
                <td>02/07/2025</td>
                <td class="text-right">1.601.890,00</td>
                <td class="text-right">56.066,00</td>
                <td class="text-right">6.167,26</td>
                <td class="text-right">1.664.123,26</td>
            </tr>
            <tr>
                <td>2</td>
                <td class="text-left">SANTO RAMDANI, MR</td>
                <td>HLP-PDG</td>
                <td>BATIK AIR</td>
                <td>09/07/2025</td>
                <td>09/07/2025</td>
                <td class="text-right">1.621.328,00</td>
                <td class="text-right">56.746,00</td>
                <td class="text-right">6.242,06</td>
                <td class="text-right">1.684.316,06</td>
            </tr>
            <tr>
                <td>3</td>
                <td class="text-left">SANTO RAMDANI, MR</td>
                <td>PDG-CGK</td>
                <td>GARUDA INDONESIA</td>
                <td>12/07/2025</td>
                <td>12/07/2025</td>
                <td class="text-right">1.976.234,00</td>
                <td class="text-right">69.168,00</td>
                <td class="text-right">7.608,48</td>
                <td class="text-right">2.053.010,48</td>
            </tr>
            <tr>
                <td>4</td>
                <td class="text-left">TINA RUMONDANG S, MRS</td>
                <td>HLP-PDG</td>
                <td>BATIK AIR</td>
                <td>09/07/2025</td>
                <td>09/07/2025</td>
                <td class="text-right">1.621.328,00</td>
                <td class="text-right">56.746,00</td>
                <td class="text-right">6.242,06</td>
                <td class="text-right">1.684.316,06</td>
            </tr>
            <tr class="bold">
                <td colspan="6" class="text-right">TOTAL</td>
                <td class="text-right">6.820.780,00</td>
                <td class="text-right">238.726,00</td>
                <td class="text-right">26.259,86</td>
                <td class="text-right">7.085.765,86</td>
            </tr>
        </tbody>
    </table>

    <!-- SECTION BREAK UNTUK LAMPIRAN 2 -->

    <!-- HALAMAN LAMPIRAN 2: RINCIAN TRANSAKSI PEMESANAN HOTEL -->
    <div class="lampiran-header">
        <div class="lampiran-subtitle">RINCIAN TRANSAKSI PEMESANAN HOTEL</div>
        <div>PT INDONESIA COMNETS PLUS</div>
        <div>PERIODE JULI 2025</div>
    </div>

    <table class="lampiran-table">
        <thead>
            <tr>
                <th style="width: 5%">No</th>
                <th style="width: 20%">Traveler Name</th>
                <th style="width: 15%">Description</th>
                <th style="width: 12%">Departure Date</th>
                <th style="width: 12%">Return Date</th>
                <th style="width: 12%">Total Fare</th>
                <th style="width: 12%">Travel Services</th>
                <th style="width: 6%">VAT</th>
                <th style="width: 12%">Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="9" class="text-center">Tidak ada data transaksi pemesanan hotel pada periode ini</td>
            </tr>
            <tr class="bold">
                <td colspan="5" class="text-right">TOTAL</td>
                <td class="text-right">0,00</td>
                <td class="text-right">0,00</td>
                <td class="text-right">0,00</td>
                <td class="text-right">0,00</td>
            </tr>
        </tbody>
    </table>

    <!-- SECTION BREAK UNTUK LAMPIRAN 3 -->
    <div class="section-break"></div>

    <!-- HALAMAN LAMPIRAN 3: RINGKASAN TOTAL TRANSAKSI CO-TRAVEL -->
    <div class="lampiran-header">
        <div class="lampiran-subtitle">RINGKASAN TOTAL TRANSAKSI CO-TRAVEL</div>
        <div>PT INDONESIA COMNETS PLUS</div>
        <div>PERIODE JULI 2025</div>
    </div>

    <table class="lampiran-table">
        <thead>
            <tr>
                <th style="width: 40%">Jenis Layanan</th>
                <th style="width: 20%">Nilai Transaksi (Exclude VAT)</th>
                <th style="width: 20%">VAT</th>
                <th style="width: 20%">Nilai VAT</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-left">Tiket Pesawat</td>
                <td class="text-right">7.059.506,00</td>
                <td class="text-right">0%</td>
                <td class="text-right">0,00</td>
            </tr>
            <tr>
                <td class="text-left">Pemesanan Hotel</td>
                <td class="text-right">0,00</td>
                <td class="text-right">0%</td>
                <td class="text-right">0,00</td>
            </tr>
            <tr>
                <td class="text-left">Tiket Kereta Api</td>
                <td class="text-right">0,00</td>
                <td class="text-right">0%</td>
                <td class="text-right">0,00</td>
            </tr>
            <tr class="bold">
                <td class="text-left">GRAND TOTAL</td>
                <td class="text-right">7.059.506,00</td>
                <td class="text-right">-</td>
                <td class="text-right">0,00</td>
            </tr>
        </tbody>
    </table>
</body>
</html>