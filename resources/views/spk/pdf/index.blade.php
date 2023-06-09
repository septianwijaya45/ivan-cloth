<?php
use App\Models\FileSPK;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak SPK - {{ $spk->kode_spk }}</title>
    <style>
        @page {
            size: A4;
        }

        body {
            font-size: 9pt;
        }

        .header {
            width: 100%;
            height: 40px;
        }

        .header .logo {
            float: left;
        }

        .header .address {
            float: left;
            margin-left: 10px;
            margin-top: -25px;
            width: 300px;
            font-size: 9pt;
        }

        .header .supplier {
            float: right;
            margin-top: -25px;
            font-size: 9pt;
        }

        .header .logo img {
            width: 90px;
            height: 60px;
        }

        .header .supplier {
            width: 250px;
        }

        .header .supplier .sup {
            margin-bottom: -10px;
        }

        .header .supplier .from {
            margin-left: 54px;
        }

        .header .supplier .addr {
            height: auto;
            margin-left: 55px;
        }

        .content {
            width: 100%;
            height: auto;
        }

        .content .judul {
            text-align: center;
        }

        .content .subjudul {
            text-align: center;
            margin-top: -15px;
        }

        .content .periode {
            text-align: center;
            margin-top: 5px;
        }

        .content .tabel-keuangan {
            font-size: 12pt;
            width: 100%;
        }

        .content .tabel-keuangan .type {
            text-align: left;
        }

        .content .tabel-keuangan .total-pengeluaran {
            text-align: center;
        }

        .content .tabel-keuangan .total-pendapatan {
            text-align: center;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        .table th,
        td {
            border: 1px solid #000;
            padding: 2px;
        }

        .table th {
            background-color: #f2f2f2;
        }

        .footer-nota {
            width: 100px;
            float: right;
            margin-top: 100px;
        }

        .footer-nota .attention {
            width: 100%;
            margin-top: 2px;
            font-size: 10px
        }

        .footer-nota .user {
            width: 400px;
            bottom: 50px;
            text-align: center;
        }

        .footer-nota .user .penerima {
            margin-top: -20px;
            width: 90px;
            height: 40px;
            font-size: 10px;
            float: left;
        }

        .footer-nota .user .users {
            width: 200px;
            float: right;
            margin-top: 60px;
        }

        .row-img:before .row-img:after {
            display: table;
            content: " ";
            clear:both;
        }

        .divTable{
            display: table;
            width: 100%;
        }
        .divTableRow {
            display: table-row;
        }
        .divTableHeading {
            background-color: #EEE;
            display: table-header-group;
        }
        .divTableCell, .divTableHead {
            border: 1px solid #999999;
            display: table-cell;
            padding: 3px 10px;
        }
        .divTableHeading {
            background-color: #EEE;
            display: table-header-group;
            font-weight: bold;
        }
        .divTableFoot {
            background-color: #EEE;
            display: table-footer-group;
            font-weight: bold;
        }
        .divTableBody {
            display: table-row-group;
        }
        .div-border {
             border-style: groove;
             margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="header">
        {{-- <div class="logo">
            <img src="{{public_path().'/backend/images/logo/logoC.png'}}" alt="">
        </div> --}}
        <div class="address">
            <h4>Ivan Cloth's</h4>
            <p>Jl. Surabaya
                <br> Kab. Kediri - Jawa Timur Indonesia
                <br> Phone : 0813-XXXX-XXXX
            </p>
        </div>
        <div class="supplier">
            <p>Kode SPP : {{ $spk->kode_spk }}</p>
            <p>Tertanggal : {{ date('d F Y', strtotime($spk->tanggal)) }}</p>
            <p>Pukul : {{ date('H:i:s', strtotime($spk->created_at)) }}</p>
        </div>
    </div>
    <hr style="margin-top: 25px;">
    <div class="content">
        <h3 class="judul">Surat Perintah Kerja</h3>
        <p class="subjudul">Kode {{ $spk->kode_spk }}</p>
    </div>
    <div>
        <p>Berikut ini adalah Surat Perintah Kerja yang akan dikerjakan berdasarkan artikel dengan catatan yang berada
            pada kolom <strong>keterangan</strong></p>
    </div>

    <?php
    $gambarSPK = FileSPK::where('kode_spk', $spk->kode_spk)
        ->where('artikel', $spk->artikel)
        ->get();
    ?>

    <div class="content">
        <div class="divTable">
            <div class="divTableBody">
                <div class="divTableRow">
                    <div class="divTableCell" style="width: 65%;">
                        <div class="row-img">
                            @foreach ($gambarSPK as $model)
                                <img src="{{ public_path() . '/img/gambar/' . $model->nama_foto }}" alt="" width="130px" style="margin-top: 40px; margin-left: 10px;">
                            @endforeach
                        </div>
                    </div>
                    <div class="divTableCell">
                        <div class="div-border">
                            <p style="font-weight:bold; text-align:center;">Artikel</p>
                            <hr>
                            <p style="text-align: center;">{{ $spk->artikel }}</p>
                        </div>
                        <div class="div-border">
                            <p style="font-weight:bold; text-align:center;">Ukuran</p>
                            <hr>
                            <p style="text-align: center;">{{ $spk->ukuran }}</p>
                        </div>
                        <div class="div-border">
                            <p style="font-weight:bold; text-align:center;">Jenis | Warna</p>
                            <hr>
                            @foreach ($dataSpk as $dt)
                                <ol>
                                    <li>{{ $dt->jenis }} ( {{ $dt->quantity }} {{ $dt->satuan }} )</li>
                                </ol>
                            @endforeach
                        </div>
                        <div class="div-border">
                            <p style="font-weight:bold; text-align:center;">Keterangan</p>
                            <hr>
                            <p style="text-align: center;">{{ !is_null($spk->note) ? $spk->note : 'Tidak Ada Keterangan' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <table class="table">
            <tr>
                <th rowspan="8" colspan="2" style="width: 70%;">
                    @foreach ($gambarSPK as $model)
                        <div class="grid-img">
                            <img src="{{ public_path() . '/img/gambar/' . $model->nama_foto }}" alt=""
                                width="150px">
                            <br>
                        </div>
                    @endforeach
                </th>

                <th style="width: 30%;">Artikel</th>
            </tr>
            <tr class="judul">
                <td>{{ $spk->artikel }}</td>
            </tr>
            <tr>
                <th>Ukuran</th>
            </tr>
            <tr class="judul">
                <td>{{ $spk->ukuran }}</td>
            </tr>
            <tr>
                <th>Jenis | Warna</th>
            </tr>
            <tr>
                <td>
                    @foreach ($dataSpk as $dt)
                        - {{ $dt->jenis }} ( {{ $dt->quantity }} {{ $dt->satuan }} ) <br>
                    @endforeach
                </td>
            </tr>
            <tr>
                <th>Keterangan</th>
            </tr>
            <tr>
                <td>{{ $spk->note }}</td>
            </tr>
        </table> -->
    </div>
    <div>
        <p>Demikian Surat Perintah Potong yang saya sampaikan. Terima Kasih</p>
    </div>

    <div class="footer-nota">
        <div class="user">
            <div class="penerima">
                <h4>Pemilik Ivan Cloth's</h4>
                <br>
                <br>
                <p>Ivan Haryono The</p>
            </div>
        </div>
    </div>
</body>

</html>
