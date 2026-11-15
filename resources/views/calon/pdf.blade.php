<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Surat Pendaftaran - {{ $calon->nama }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 18mm 22mm 15mm 22mm;
        }
        * {
            box-sizing: border-box;
        }
        body {
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            font-size: 11pt;
            color: #000;
            background: #f1f5f9;
            margin: 0;
            padding: 20px 0;
            line-height: 1.35;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }
        .page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto;
            background: #fff;
            padding: 18mm 22mm 15mm 22mm;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        .no-print-bar {
            width: 210mm;
            margin: 0 auto 15px auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .btn-print {
            background-color: #0d6efd;
            color: #fff;
            border: none;
            padding: 8px 18px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 0 2px 4px rgba(0,0,0,0.15);
        }
        .btn-print:hover {
            background-color: #0b5ed7;
        }
        .header {
            line-height: 1.25;
            margin-bottom: 25px;
        }
        .header .org-name {
            font-size: 11pt;
            letter-spacing: 0.3px;
        }
        .header .sub-org {
            font-size: 11pt;
            letter-spacing: 0.3px;
            border-bottom: 1.5px solid #000;
            display: inline-block;
            padding-bottom: 1px;
        }
        .title-section {
            text-align: center;
            margin-bottom: 22px;
        }
        .title-section .title {
            font-size: 13pt;
            font-weight: bold;
            letter-spacing: 0.5px;
        }
        .title-section .nomor {
            font-size: 11pt;
            font-weight: bold;
            margin-top: 3px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11pt;
        }
        .data-table td {
            padding: 2.2px 0;
            vertical-align: top;
        }
        .col-no {
            width: 24px;
            text-align: left;
        }
        .col-label {
            width: 255px;
        }
        .col-sub {
            padding-left: 20px !important;
        }
        .col-colon {
            width: 16px;
            text-align: left;
        }
        .col-val {
            text-align: left;
        }
        .col-history {
            padding-left: 20px !important;
            padding-top: 4px !important;
            line-height: 1.5;
        }
        .date-row {
            text-align: right;
            margin-top: 25px;
            margin-bottom: 15px;
            font-size: 11pt;
        }
        .signature-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 8px;
        }
        .sig-col {
            flex: 1;
        }
        .sig-left {
            text-align: left;
        }
        .sig-center {
            display: flex;
            justify-content: center;
        }
        .sig-right {
            text-align: center;
            line-height: 1.3;
        }
        .sig-space {
            height: 65px;
        }
        .sig-name {
            font-weight: normal;
        }
        .sig-nrp {
            font-weight: normal;
        }
        .photo-box {
            width: 2.8cm;
            height: 3.8cm;
            border: 1px solid #000;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            font-size: 10pt;
            line-height: 1.4;
            margin: 0 auto;
        }
        .footer-notes {
            margin-top: 28px;
            font-size: 9.5pt;
            line-height: 1.35;
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
            }
            .page {
                width: 100%;
                min-height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
            }
            .no-print {
                display: none !important;
            }
        }
    </style>
</head>
<body>
    @php
        $pokok = $pokok ?? $calon->pokok ?? \App\Models\Pokok::find($calon->id);
        $pendidikan = $pendidikan ?? $calon->pendidikan ?? \App\Models\Pendidikan::where('calon_id', $calon->id)->first();
        $wali = $wali ?? $calon->wali ?? \App\Models\Wali::where('calon_id', $calon->id)->first();
        $nilai = $nilai ?? $calon->t2020 ?? \App\Models\T2020::where('calon_id', $calon->id)->first();

        // 1. Nomor
        $nomor = $calon->no_online ?: ($pokok->no_online ?? ($pokok->no_animo ?? '-'));

        // 2. Tanggal Lahir Formatted (d/m/Y)
        $tglLahirFormatted = $calon->tgl_lahir ? date('d/m/Y', strtotime($calon->tgl_lahir)) : ($pokok->tgl_lahir ?? '-');

        // 3. Dik Umum, Jurusan, Tahun Lulus
        $dikUmum = $pokok->jenis_sekolah ?? null;
        if (!$dikUmum && $pendidikan) {
            $namaSma = strtoupper($pendidikan->sma ?? '');
            if (str_contains($namaSma, 'SMK')) {
                $dikUmum = 'SMK';
            } elseif (str_contains($namaSma, 'MAN') || str_contains($namaSma, 'MA ')) {
                $dikUmum = 'MA';
            } elseif ($pendidikan->sma) {
                $dikUmum = 'SMA';
            }
        }
        $dikUmum = $dikUmum ?: 'SMA';
        $jurusan = $pendidikan->jur ?? ($pokok->jur ?? '-');
        $tahunLulus = $pendidikan->l_sma ?? ($pokok->th_lulus ?? '-');

        // 4. Nilai Akhir
        $nilaiAkhir = $pendidikan->rata ?? ($nilai->rata_akhir ?? '-');

        // 5. Pekerjaan
        $pekerjaan = $calon->tempat_kerja ?: ($calon->pernah_kerja && $calon->pernah_kerja !== 'Belum' ? $calon->pernah_kerja : '-');

        // 6. Alamat
        $alamat = $calon->alamat;
        if (!$alamat) {
            $parts = [];
            if ($calon->ds) $parts[] = 'Ds ' . $calon->ds;
            if ($calon->kec) $parts[] = 'Kec ' . $calon->kec;
            if ($calon->kab) $parts[] = 'Kab/kota ' . $calon->kab;
            $alamat = implode(' ', $parts);
        }
        if (!$alamat && $pokok) {
            $alamat = $pokok->alamat_c;
        }
        $alamat = $alamat ?: '-';

        // 7. Orang Tua / Wali
        $namaOrtu = $wali->ayah ?? ($wali->wali_ayah ?? ($pokok->ortu1 ?? '-'));
        $alamatOrtu = $wali->o_alamat ?? ($wali->w_alamat ?? ($pokok->alamat_o ?? null));
        if (!$alamatOrtu) {
            $alamatOrtu = $alamat;
        }

        // 8. Kota & Tanggal Cetak
        $kota = $calon->tem_lahir ?: ($pokok->tem_lahir ?? 'Mojokerto');
        $indonesianMonths = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];
        $dateObj = $calon->updated_at ? \Carbon\Carbon::parse($calon->updated_at) : \Carbon\Carbon::now();
        $tanggalCetak = $dateObj->format('j') . ' ' . $indonesianMonths[(int)$dateObj->format('n')] . ' ' . $dateObj->format('Y');

        // 9. Petugas Pendaftaran
        $petugasNama = $petugas->name ?? 'Eko Rudy Ardianto';
        if (!empty($petugas?->nrp)) {
            $petugasNrp = (str_contains($petugas->name, 'Sertu') ? '' : 'Sertu ') . 'NRP ' . $petugas->nrp;
        } else {
            $petugasNrp = 'Sertu NRP 31081739430988';
        }
    @endphp

    <div class="no-print-bar no-print">
        <a href="{{ Auth::check() ? route('calon') : route('calon.form') }}" style="color: #64748b; text-decoration: none; font-size: 14px;">&larr; Kembali</a>
        <button onclick="window.print()" class="btn-print">&#128438; Cetak Dokumen / Simpan PDF</button>
    </div>

    <div class="page">
        <!-- Header -->
        <div class="header">
            <div class="org-name">TENTARA NASIONAL INDONESIA</div>
            <div class="sub-org">MARKAS BESAR ANGKATAN DARAT</div>
        </div>

        <!-- Title -->
        <div class="title-section">
            <div class="title">SURAT PENDAFTARAN</div>
            <div class="nomor">Nomor : {{ $nomor }}</div>
        </div>

        <!-- Data List -->
        <table class="data-table">
            <tr>
                <td class="col-no">1.</td>
                <td class="col-label">Nama Calon</td>
                <td class="col-colon">:</td>
                <td class="col-val">{{ $calon->nama }}</td>
            </tr>
            <tr>
                <td class="col-no">2.</td>
                <td class="col-label">Tempat, Tanggal Lahir</td>
                <td class="col-colon">:</td>
                <td class="col-val">{{ $calon->tem_lahir }}, {{ $tglLahirFormatted }}</td>
            </tr>
            <tr>
                <td class="col-no">3.</td>
                <td class="col-label">Jenis Kelamin</td>
                <td class="col-colon">:</td>
                <td class="col-val">Pria/Wanita * )</td>
            </tr>
            <tr>
                <td class="col-no">4.</td>
                <td class="col-label">Status</td>
                <td class="col-colon">:</td>
                <td class="col-val">Nikah/belum pernah Nikah * )</td>
            </tr>
            <tr>
                <td class="col-no">5.</td>
                <td class="col-label">Suku</td>
                <td class="col-colon">:</td>
                <td class="col-val">{{ $calon->suku ?: ($pokok->suku ?? '-') }}</td>
            </tr>
            <tr>
                <td class="col-no">6.</td>
                <td class="col-label">Agama</td>
                <td class="col-colon">:</td>
                <td class="col-val">{{ $calon->agama ?: ($pokok->agama ?? '-') }}</td>
            </tr>
            <tr>
                <td class="col-no">7.</td>
                <td class="col-label">Tinggi & Berat Badan</td>
                <td class="col-colon">:</td>
                <td class="col-val">
                    <span>{{ $calon->tb ?: ($pokok->tb ?? '-') }} Cm</span>
                    <span style="display: inline-block; width: 45px;"></span>
                    <span>{{ $calon->bb ?: ($pokok->bb ?? '-') }} Kg</span>
                </td>
            </tr>
            <tr>
                <td class="col-no">8.</td>
                <td class="col-label">Pendidikan Tertinggi</td>
                <td class="col-colon">:</td>
                <td class="col-val"></td>
            </tr>
            <tr>
                <td></td>
                <td class="col-sub">a. Dik Umum</td>
                <td class="col-colon">:</td>
                <td class="col-val">{{ $dikUmum }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="col-sub">b. Jurusan</td>
                <td class="col-colon">:</td>
                <td class="col-val">{{ $jurusan }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="col-sub">c. Tahun Lulus</td>
                <td class="col-colon">:</td>
                <td class="col-val">{{ $tahunLulus }}</td>
            </tr>
            <tr>
                <td class="col-no">9.</td>
                <td class="col-label">Nilai Akhir (NA) / Rata-rata NA</td>
                <td class="col-colon">:</td>
                <td class="col-val">{{ $nilaiAkhir }}</td>
            </tr>
            <tr>
                <td class="col-no">10.</td>
                <td class="col-label">Pekerjaan</td>
                <td class="col-colon">:</td>
                <td class="col-val">{{ $pekerjaan }}</td>
            </tr>
            <tr>
                <td class="col-no">11.</td>
                <td class="col-label">Alamat (Kode Pos)</td>
                <td class="col-colon">:</td>
                <td class="col-val">{{ $alamat }}</td>
            </tr>
            <tr>
                <td class="col-no">12.</td>
                <td class="col-label">Orang Tua/Wali *)</td>
                <td class="col-colon"></td>
                <td class="col-val"></td>
            </tr>
            <tr>
                <td></td>
                <td class="col-sub">a. Nama</td>
                <td class="col-colon">:</td>
                <td class="col-val">{{ $namaOrtu }}</td>
            </tr>
            <tr>
                <td></td>
                <td class="col-sub">b. Alamat (Kode Pos)</td>
                <td class="col-colon">:</td>
                <td class="col-val">{{ $alamatOrtu }}</td>
            </tr>
            <tr>
                <td class="col-no">13.</td>
                <td class="col-label">Pernah mendaftar yang ke</td>
                <td class="col-colon">:</td>
                <td class="col-val"></td>
            </tr>
            <tr>
                <td></td>
                <td colspan="3" class="col-history">
                    <div>Tahun &nbsp;&nbsp;&nbsp;&nbsp;.... &nbsp;&nbsp;&nbsp;&nbsp;sampai tingkat &nbsp;&nbsp;&nbsp;&nbsp;....</div>
                    <div>Tahun &nbsp;&nbsp;&nbsp;&nbsp;.... &nbsp;&nbsp;&nbsp;&nbsp;sampai tingkat &nbsp;&nbsp;&nbsp;&nbsp;....</div>
                    <div>Tahun &nbsp;&nbsp;&nbsp;&nbsp;.... &nbsp;&nbsp;&nbsp;&nbsp;sampai tingkat &nbsp;&nbsp;&nbsp;&nbsp;....</div>
                </td>
            </tr>
        </table>

        <!-- Date Row -->
        <div class="date-row">
            {{ $kota }}, {{ $tanggalCetak }}
        </div>

        <!-- Signatures & Photo Box -->
        <div class="signature-row">
            <div class="sig-col sig-left">
                <div>Tanda Tangan Calon,</div>
                <div class="sig-space"></div>
                <div class="sig-name">{{ $calon->nama }}</div>
            </div>
            <div class="sig-col sig-center">
                <div class="photo-box">
                    <div>Foto Calon</div>
                    <div>4 X 6</div>
                </div>
            </div>
            <div class="sig-col sig-right">
                <div>a.n Ketua Panitia</div>
                <div>Petugas Pendaftaran,</div>
                <div class="sig-space"></div>
                <div class="sig-name">{{ $petugasNama }}</div>
                <div class="sig-nrp">{{ $petugasNrp }}</div>
            </div>
        </div>

        <!-- Footer Notes -->
        <div class="footer-notes">
            <div>Tulis dengan huruf cetak</div>
            <div>*) Coret yang tidak perlu</div>
        </div>
    </div>
@if (session('auto_print'))<script>window.addEventListener('load', function () { window.print(); });</script>@endif
</body>
</html>
