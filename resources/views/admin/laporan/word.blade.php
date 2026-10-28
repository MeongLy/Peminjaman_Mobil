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

        /* ✅ Force Arial di SEMUA elemen, termasuk mso override */
        body,
        body * {
            font-family: Arial, Helvetica, sans-serif !important;
            mso-fareast-font-family: Arial, sans-serif !important;
            mso-bidi-font-family: Arial, sans-serif !important;
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
            vertical-align: top;
            padding: 0;
            font-weight: normal;
            text-align: center;
        }

        .ttd-label {
            margin: 0;
            font-size: 11pt;
            font-weight: normal;
            text-align: center;
        }

        .ttd-label-right {
            text-align: right;
        }

        .ttd-tanggal {
            margin: 0;
            font-weight: normal;
            border-bottom: 1pt dotted #333;
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
            text-align: center;
        }

        .ttd-kepala {
            margin-top: 40pt;
            font-size: 11pt;
            font-weight: normal;
            text-align: center;
        }
    </style>
</head>

<body style="font-family: Arial, sans-serif;">

    {{-- HEADER --}}
    <div class="header">
        <table border="0" cellspacing="0" cellpadding="0" width="100%" class="header-table">
            <tr>
                <td class="logo-cell" width="80" align="center" valign="middle">
                    @php
                    $logoPath = public_path('logo.png');
                    @endphp
                    @if (file_exists($logoPath))
                    <img src="{{ $logoPath }}" alt="Logo" width="135" height="135">
                    @endif
                </td>
                <td class="instansi-cell" align="center" valign="middle" style="font-family: Arial, sans-serif;">
                    <div class="line-1" style="font-family: Arial, sans-serif;">KEMENTERIAN IMIGRASI DAN PEMASYARAKATAN REPUBLIK INDONESIA</div>
                    <div class="line-2" style="font-family: Arial, sans-serif;">DIREKTORAT JENDERAL PEMASYARAKATAN</div>
                    <div class="line-3" style="font-family: Arial, sans-serif;">KANTOR WILAYAH KALIMANTAN TENGAH</div>
                    <div class="line-4" style="font-family: Arial, sans-serif; font-weight: bold;">LEMBAGA PEMASYARAKATAN PEREMPUAN KELAS IIA PALANGKA RAYA</div>
                    <div class="line-5" style="font-family: Arial, sans-serif;">Jalan Cilik Riwut Km. 4,5 Palangka Raya</div>
                    <div class="line-6" style="font-family: Arial, sans-serif;">Laman: lppalangkaraya.kemenkumham.go.id · Pos-el: lpp.palangkaraya@kemenkumham.go.id</div>
                </td>
            </tr>
        </table>
    </div>

    {{-- JUDUL --}}
    <div class="judul" style="font-family: Arial, sans-serif; font-weight: bold;">FORMULIR PEMAKAIAN KENDARAAN DINAS</div>

    {{-- DATA --}}
    <table border="0" cellspacing="0" cellpadding="0" width="100%" class="data-table" style="font-family: Arial, sans-serif;">
        <tr>
            <td class="label" width="170" style="font-family: Arial, sans-serif;">Hari/Tanggal</td>
            <td class="sep" width="10" style="font-family: Arial, sans-serif;">:</td>
            <td class="value" style="font-family: Arial, sans-serif;">{{ $pemakaian->tanggal?->translatedFormat('l, d F Y') }}</td>
        </tr>
        <tr>
            <td class="label" style="font-family: Arial, sans-serif;">Waktu Berangkat</td>
            <td class="sep" style="font-family: Arial, sans-serif;">:</td>
            <td class="value" style="font-family: Arial, sans-serif;">{{ $pemakaian->jam_keluar }}</td>
        </tr>
        <tr>
            <td class="label" style="font-family: Arial, sans-serif;">Waktu Kembali</td>
            <td class="sep" style="font-family: Arial, sans-serif;">:</td>
            <td class="value" style="font-family: Arial, sans-serif;">{{ $pemakaian->jam_kembali }}</td>
        </tr>
        <tr>
            <td class="label" style="font-family: Arial, sans-serif;">Jenis Kendaraan</td>
            <td class="sep" style="font-family: Arial, sans-serif;">:</td>
            <td class="value" style="font-family: Arial, sans-serif;">Mobil {{ $pemakaian->mobil->tipe ?? $pemakaian->mobil->nama ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label" style="font-family: Arial, sans-serif;">No. Kendaraan</td>
            <td class="sep" style="font-family: Arial, sans-serif;">:</td>
            <td class="value" style="font-family: Arial, sans-serif;">{{ $pemakaian->mobil->plat ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label" style="font-family: Arial, sans-serif;">Tujuan</td>
            <td class="sep" style="font-family: Arial, sans-serif;">:</td>
            <td class="value" style="font-family: Arial, sans-serif;">{{ $pemakaian->tujuan }}</td>
        </tr>
        <tr>
            <td class="label" style="font-family: Arial, sans-serif;">Kaur Umum</td>
            <td class="sep" style="font-family: Arial, sans-serif;">:</td>
            <td class="value" style="font-family: Arial, sans-serif;">{{ $pemakaian->pengguna }}</td>
        </tr>
        <tr>
            <td class="label" style="font-family: Arial, sans-serif;">Kondisi Kendaraan Berangkat</td>
            <td class="sep" style="font-family: Arial, sans-serif;">:</td>
            <td class="value no-dots" style="font-family: Arial, sans-serif;">
                <span class="kondisi-list" style="font-family: Arial, sans-serif;">
                    <span class="dot checked"></span> baik /
                    <span class="dot"></span> rusak /
                    <span class="dot"></span> bersih /
                    <span class="dot"></span> kotor
                </span>
            </td>
        </tr>
        <tr>
            <td class="label" style="font-family: Arial, sans-serif;">Kondisi Kendaraan Kembali</td>
            <td class="sep" style="font-family: Arial, sans-serif;">:</td>
            <td class="value no-dots" style="font-family: Arial, sans-serif;">
                <span class="kondisi-list" style="font-family: Arial, sans-serif;">
                    <span class="dot"></span> baik /
                    <span class="dot"></span> rusak /
                    <span class="dot"></span> bersih /
                    <span class="dot"></span> kotor
                </span>
            </td>
        </tr>
    </table>

    {{-- TANDA TANGAN --}}
    <div class="ttd-wrapper" style="font-family: Arial, sans-serif;">
        <table border="0" cellspacing="0" cellpadding="0" width="100%" class="ttd-table" style="font-family: Arial, sans-serif;">
            <tr>
                {{-- Atasan Langsung — semua tengah --}}
                <td width="50%" align="center" valign="top" style="font-family: Arial, sans-serif;">
                    <p class="ttd-label" style="font-family: Arial, sans-serif;">Kasubag TU,</p>
                    <p class="ttd-space-left" style="font-family: Arial, sans-serif;">&nbsp;</p>
                    <p class="ttd-name" style="font-family: Arial, sans-serif;">Cristin Sari</p>
                </td>

                {{-- Peminjam — Palangka Raya tanggal kanan, sisanya tengah --}}
                <td width="50%" align="center" valign="top" style="font-family: Arial, sans-serif;">
                    <p class="ttd-label ttd-label-right" align="right" style="font-family: Arial, sans-serif;">Palangka Raya,
                        <span class="ttd-tanggal" style="font-family: Arial, sans-serif;">{{ $pemakaian->tanggal?->translatedFormat('d F Y') }}</span>
                    </p>
                    <p class="ttd-label" style="font-family: Arial, sans-serif;">Peminjam,</p>
                    <p class="ttd-space" style="font-family: Arial, sans-serif;">&nbsp;</p>
                    <p class="ttd-name" style="font-family: Arial, sans-serif;">{{ $pemakaian->pengguna }}</p>
                </td>
            </tr>
        </table>

        {{-- Kepala — tengah --}}
        <div class="ttd-kepala" style="font-family: Arial, sans-serif;">
            <p class="ttd-label" style="font-family: Arial, sans-serif;">Kepala,</p>
            <p class="ttd-space" style="font-family: Arial, sans-serif;">&nbsp;</p>
            <p class="ttd-name" style="font-family: Arial, sans-serif;">Hani Anggraeni</p>
        </div>
    </div>

</body>

</html>
