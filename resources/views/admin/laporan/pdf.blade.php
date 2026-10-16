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
        body {
            font-family: 'Times New Roman', Arial, serif;
            font-size: 12pt;
            color: #000;
        }

        .header {
            width: 100%;
            border-bottom: 3px double #000;
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
            width: 70px;
            height: 70px;
        }
        .logo-cell .placeholder {
            font-size: 40pt;
            line-height: 70px;
        }
        .instansi-cell {
            text-align: center;
            line-height: 1.3;
        }
        .instansi-cell .line-1 { font-size: 13pt; font-weight: bold; }
        .instansi-cell .line-2,
        .instansi-cell .line-3 { font-size: 12pt; font-weight: bold; }
        .instansi-cell .line-4 { font-size: 13pt; font-weight: bold; margin-top: 3pt; }
        .instansi-cell .line-5,
        .instansi-cell .line-6 { font-size: 9pt; }

        .judul {
            text-align: center;
            font-size: 14pt;
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 20pt;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12pt;
        }
        .data-table td {
            padding: 3pt 0;
            vertical-align: top;
        }
        .data-table td.label { width: 200pt; }
        .data-table td.sep   { width: 15pt; }
        .data-table td.value { font-weight: bold; }

        .kondisi-list { font-size: 11pt; }
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

        .ttd-wrapper { margin-top: 40pt; }
        .ttd-table { width: 100%; border-collapse: collapse; }
        .ttd-table td {
            width: 50%;
            text-align: center;
            vertical-align: top;
            padding: 0;
        }
        .ttd-space { height: 60pt; }
        .ttd-name {
            font-weight: bold;
            text-decoration: underline;
        }

        .ttd-kepala {
            margin-top: 40pt;
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
                    @if (file_exists(public_path('logo.png')))
                        <img src="{{ asset('logo.png') }}" alt="Logo">
                    @else
                        <div class="placeholder">⚖️</div>
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
            <td class="label">Penanggung Jawab</td>
            <td class="sep">:</td>
            <td class="value">{{ $pemakaian->pengguna }}</td>
        </tr>
        <tr>
            <td class="label">Kondisi Kendaraan Berangkat</td>
            <td class="sep">:</td>
            <td class="value">
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
            <td class="value">
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
                    <p>Atasan Langsung,</p>
                    <div class="ttd-space"></div>
                    <p class="ttd-name">....................................................</p>
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
            <p class="ttd-name">....................................................</p>
        </div>
    </div>

</body>
</html>
