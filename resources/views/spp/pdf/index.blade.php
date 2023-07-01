<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak SPP - {{ $spp->kode_spp }}</title>
    <style>
        @page { size: A4; }

       body{
           font-size: 9pt;
       }

       .header{
           width: 100%;
           height: 40px;
       }

       .header .logo{
           float: left;
       }

       .header .address{
           float: left;
           margin-left: 10px;
           margin-top: -25px;
           width: 300px;
           font-size: 9pt;
       }

       .header .supplier{
           float: right;
           margin-top: -25px;
           font-size: 9pt;
       }

       .header .logo img{
           width:90px; 
           height:60px;
       }

       .header .supplier {
           width: 250px;
       }

       .header .supplier .sup{
           margin-bottom: -10px;
       }

       .header .supplier .from{
           margin-left: 54px;
       }

       .header .supplier .addr{
           height: auto;
           margin-left: 55px;
       }

       .content{
           width: 100%;
           height: auto;
       }
       
       .content .judul{
           text-align: center;
       }

       .content .subjudul{
           text-align: center;
           margin-top: -15px;
       }

       .content .periode{
           text-align: center;
           margin-top: 5px;
       }

       .content .tabel-keuangan{
           font-size: 12pt;
           width: 100%;
       }

       .content .tabel-keuangan .type{
           text-align: left;
       }

       .content .tabel-keuangan .total-pengeluaran{
           text-align: center;
       }

       .content .tabel-keuangan .total-pendapatan{
           text-align: center;
       }

        .table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .table th, td {
            border: 1px solid #000;
            padding: 8px;
        }
        
        .table th {
            background-color: #f2f2f2;
        }

        .footer-nota{
            width: 100px;
            float: right;
            margin-top: 100px;
        }

       .footer-nota .attention{
           width: 100%;
           margin-top: 2px;
           font-size: 10px
       }

       .footer-nota .user{
           width: 400px;
           bottom: 50px;
           text-align: center;
       }
       .footer-nota .user .penerima{
           margin-top: -20px;
           width: 90px;
           height: 40px;
           font-size: 10px;
           float: left;
       }

       .footer-nota .user .users{
           width: 200px;
           float: right;
           margin-top: 60px;
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
            <p>Kode SPP : {{$spp->kode_spp}}</p>
            <p>Tertanggal : {{date('d F Y', strtotime($spp->tanggal))}}</p>
            <p>Pukul : {{date('H:i:s', strtotime($spp->created_at))}}</p>
        </div>
    </div>
    <hr style="margin-top: 25px;">
    <div class="content">
        <h3 class="judul">Surat Perintah Potong</h3>
        <p class="subjudul">Kode {{$spp->kode_spp}}</p>
    </div>
    <div>
        <p>Berikut ini adalah Surat Perintah Potong yang akan dikerjakan dengan catatan yang berada pada kolom <strong>keterangan</strong></p>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Lot | Ukuran</th>
                <th>Jenis Kain | Warna</th>
                <th>Quantity</th>
                <th>Hasil Potongan</th>
                <th>Karyawan</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dataSpp as $dt)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{$dt->kode_lot}} | {{$dt->ukuran}}</td>
                    <td>{{$dt->jenis}}</td>
                    <td>{{$dt->quantity}}</td>
                    <td>{{$dt->hasil_potongan}}</td>
                    <td>{{$dt->karyawan}}</td>
                    <td>{{$dt->note}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
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