<html xmlns:o="urn:schemas-microsoft-com:office:office"
    xmlns:w="urn:schemas-microsoft-com:office:word"
    xmlns="http://www.w3.org/TR/REC-html40">

<head>
    <meta charset="UTF-8">
    <title>Formulir Pemakaian Kendaraan Dinas</title>
    <!--[if gte mso 9]>
    <xml>
        <w:WordDocument>
            <w:View>Print</w:View>
            <w:Zoom>100</w:Zoom>
        </w:WordDocument>
    </xml>
    <![endif]-->
    <style>
        @page {
            size: A4 portrait;
            margin: 1.5cm 2cm;
        }

        /* ✅ Paksa font Arial di SEMUA elemen (override Word default) */
        body,
        body * {
            font-family: Arial, Helvetica, sans-serif !important;
            color: #000;
        }

        body {
            font-size: 12pt;
        }

        .header {
            width: 100%;
            border-bottom: 2px solid #000;
            padding-bottom: 8px;
            margin-bottom: 20px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: middle;
            padding: 0;
        }

        .logo-cell {
            width: 80px;
            text-align: center;
        }

        .logo-cell img {
            width: 135px;
            height: 135px;
        }

        .instansi-cell {
            text-align: center;
            line-height: 1.3;
        }

        .instansi-cell .line-1 {
            font-size: 9pt;
            font-weight: normal;
        }

        .instansi-cell .line-2,
        .instansi-cell .line-3 {
            font-size: 9pt;
            font-weight: normal;
        }

        .instansi-cell .line-4 {
            font-size: 10pt;
            font-weight: bold;
        }

        .instansi-cell .line-5,
        .instansi-cell .line-6 {
            font-size: 8pt;
        }

        .judul {
            text-align: center;
            font-size: 12pt;
            font-weight: bold;
            margin-bottom: 20pt;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11pt;
        }

        /* ✅ Semua cell: font-weight normal (bukan bold) */
        .data-table td {
            padding: 5pt 0;
            vertical-align: bottom;
            font-weight: normal;
        }

        .data-table td.label {
            width: 170pt;
            font-weight: normal;
        }

        .data-table td.sep {
            width: 10pt;
            font-weight: normal;
        }

        /* ✅ Dotted lebih halus: 1pt (bukan 1.5pt) */
        .data-table td.value {
            border-bottom: 1pt dotted #333;
            padding: 10pt 0;
            padding-bottom: 3pt;
            font-weight: normal;
        }

        .data-table td.value.no-dots {
            border-bottom: none;
        }

        .kondisi-list {
            font-size: 11pt;
            font-weight: normal;
        }

        .kondisi-list .dot {
            display: inline-block;
            width: 9pt;
            height: 9pt;
            border: 1pt solid #000;
            border-radius: 50%;
            vertical-align: middle;
            margin-right: 3pt;
        }

        .kondisi-list .dot.checked {
            background-color: #000;
        }

        /* ---------- Tanda Tangan ---------- */
        .ttd-wrapper {
            margin-top: 40pt;
        }

        .ttd-table {
            width: 100%;
            border-collapse: collapse;
        }

        .ttd-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 0;
            font-weight: normal;
        }

        .ttd-space {
            height: 60pt;
        }

        .ttd-space-left {
            height: 90pt;
        }

        .ttd-name {
            margin: 0;
            font-size: 12pt;
            font-weight: normal;
        }

        .ttd-dots {
            letter-spacing: 2pt;
            font-size: 11pt;
            color: #333;
            margin-top: 2pt;
        }

        .ttd-kepala {
            margin-top: 40pt;
            font-size: 11pt;
            font-weight: normal;
            text-align: center;
        }
    </style>
</head>

<body>

    {{-- HEADER --}}
    <div class="header">
        <table class="header-table">
            <tr>
                <td class="logo-cell">
                    @php
                    $logoPath = public_path('logo.png');
                    @endphp
                    @if (file_exists($logoPath))
                    <img src="{{ $logoPath }}" alt="Logo">
                    @endif
                </td>
                <td class="instansi-cell">
                    <div class="line-1">KEMENTERIAN IMIGRASI DAN PEMASYARAKATAN REPUBLIK INDONESIA</div>
                    <div class="line-2">DIREKTORAT JENDERAL PEMASYARAKATAN</div>
                    <div class="line-3">KANTOR WILAYAH KALIMANTAN TENGAH</div>
                    <div class="line-4">LEMBAGA PEMASYARAKATAN PEREMPUAN KELAS IIA PALANGKA RAYA</div>
                    <div class="line-5">Jalan Cilik Riwut Km. 4,5 Palangka Raya</div>
                    <div class="line-6">Laman: lppalangkaraya.kemenkumham.go.id · Pos-el: lpp.palangkaraya@kemenkumham.go.id</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- JUDUL --}}
    <div class="judul">FORMULIR PEMAKAIAN KENDARAAN DINAS</div>

    {{-- DATA --}}
    <table class="data-table">
        <tr>
            <td class="label">Hari/Tanggal</td>
            <td class="sep">:</td>
            <td class="value">{{ $pemakaian->tanggal?->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Waktu Berangkat</td>
            <td class="sep">:</td>
            <td class="value">{{ $pemakaian->jam_keluar }}</td>
        </tr>
        <tr>
            <td class="label">Waktu Kembali</td>
            <td class="sep">:</td>
            <td class="value">{{ $pemakaian->jam_kembali }}</td>
        </tr>
        <tr>
            <td class="label">Jenis Kendaraan</td>
            <td class="sep">:</td>
            <td class="value">Mobil {{ $pemakaian->mobil->tipe ?? $pemakaian->mobil->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">No. Kendaraan</td>
            <td class="sep">:</td>
            <td class="value">{{ $pemakaian->mobil->plat ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Tujuan</td>
            <td class="sep">:</td>
            <td class="value">{{ $pemakaian->tujuan }}</td>
        </tr>
        <tr>
            <td class="label">Kaur Umum</td>
            <td class="sep">:</td>
            <td class="value">{{ $pemakaian->pengguna }}</td>
        </tr>
        <tr>
            <td class="label">Kondisi Kendaraan Berangkat</td>
            <td class="sep">:</td>
            <td class="value no-dots">
                <span class="kondisi-list">
                    <span><span class="dot checked"></span> baik</span> /
                    <span><span class="dot"></span> rusak</span> /
                    <span><span class="dot"></span> bersih</span> /
                    <span><span class="dot"></span> kotor</span>
                </span>
            </td>
        </tr>
        <tr>
            <td class="label">Kondisi Kendaraan Kembali</td>
            <td class="sep">:</td>
            <td class="value no-dots">
                <span class="kondisi-list">
                    <span><span class="dot"></span> baik</span> /
                    <span><span class="dot"></span> rusak</span> /
                    <span><span class="dot"></span> bersih</span> /
                    <span><span class="dot"></span> kotor</span>
                </span>
            </td>
        </tr>
    </table>

    {{-- TANDA TANGAN --}}
    <div class="ttd-wrapper">
        <table class="ttd-table">
            <tr>
                <td>
                    <p>Kasubag TU,</p>
                    <div class="ttd-space ttd-space-left"></div>
                    <p class="ttd-name">Cristin Sari</p>
                </td>
                <td>
                    <p>Palangka Raya, {{ $pemakaian->tanggal?->translatedFormat('d F Y') }}</p>
                    <p>Peminjam,</p>
                    <div class="ttd-space"></div>
                    <p class="ttd-name">{{ $pemakaian->pengguna }}</p>
                </td>
            </tr>
        </table>

        <div class="ttd-kepala">
            <p>Kepala,</p>
            <div class="ttd-space"></div>
            <p class="ttd-name">Hani Anggraeni</p>
        </div>
    </div>

</body>

</html>
