@extends('layouts.app')
@section('title', 'Surat Perintah Potong')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Surat Perintah Potong</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item">Surat Perintah Potong</li>
                            <li class="breadcrumb-item active">Tambah SPP</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Info boxes -->

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Form Tambah SPP</h5>
                                <div class="card-tools">
                                    <button class="btn btn-warning btn-sm" onclick="cancelSPP()">Kembali</button>
                                </div>
                            </div>
                            <form action="#" method="POST" enctype="multipart/form-data" id="formSPP">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="kode_spp">Kode SPP</label>
                                            <div class="col-md-14 row">
                                                <div class="col-md-12">
                                                    <input type="text" name="kode_spp" id="kode_spp" class="form-control" value="{{kodeSPP()}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ukuran">Model / Ukuran</label>
                                            <div class="col-md-12">
                                                <select name="ukuran" id="ukuran" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih Ukuran</option>
                                                    @foreach($ukuran as $dtUkuran)
                                                        <option value="{{$dtUkuran->ukuran}}">{{$dtUkuran->ukuran}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="tanggal">Tanggal</label>
                                            <div class="col-md-12">
                                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{$date}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="tanggal">Kode Lot</label>
                                            <div class="col-md-12">
                                                <select name="kode_lot" id="kode_lot" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih Kode Lot</option>
                                                    @foreach($kainroll as $dtRoll)
                                                        <option value="{{$dtRoll->uuid}}">{{$dtRoll->kode_lot}} | {{$dtRoll->warna}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="warna">Warna</label>
                                            <div class="col-md-12">
                                                <input type="text" name="warna" id="warna" class="form-control" placeholder="Warna Lot" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="berat">Berat</label>
                                            <div class="col-md-12">
                                                <input type="number" name="berat" id="berat" class="form-control"  placeholder="Berat">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="hasil">Hasil</label>
                                            <div class="col-md-12">
                                                <input type="number" name="hasil" id="hasil" class="form-control" placeholder="Hasil">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="karyawan_1">Karyawan Potong 1</label>
                                            <div class="col-md-12">
                                                <select name="karyawan_1" id="karyawan_1" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih Karyawan 1</option>
                                                    @foreach($karyawan as $dtKaryawan)
                                                        <option value="{{$dtKaryawan->uuid}}">{{$dtKaryawan->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="karyawan_2">Karyawan Potong 2</label>
                                            <div class="col-md-12">
                                                <select name="karyawan_2" id="karyawan_2" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih Karyawan 2</option>
                                                    @foreach($karyawan as $dtKaryawan)
                                                        <option value="{{$dtKaryawan->uuid}}">{{$dtKaryawan->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="gaji">Gaji</label>
                                            <div class="col-md-12">
                                                <select name="gaji" id="gaji" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih Gaji</option>
                                                    @foreach($gaji as $dtGaji)
                                                        <option value="{{$dtGaji->gaji}}">{{$dtGaji->gaji}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" id="btn-tambah" class="btn btn-success float-right">Tambahkan</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Data Insert Surat Perintah Potong</h5>
                            </div>
                            
                            <div class="card-body">
                                <div id="tbl_ukuran_wrapper"
                                    class="dataTables_wrapper dt-bootstrap4 table-responsive text-nowrap">
                                    <table id="tabel_insert" class="table table-bordered table-striped dataTable"
                                        aria-describedby="tbl_ukuran" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>Kode SPP</th>
                                                <th>ukuran</th>
                                                <th>tanggal</th>
                                                <th>kode_lot</th>
                                                <th>warna</th>
                                                <th>berat</th>
                                                <th>hasil</th>
                                                <th>karyawan</th>
                                                <th>gaji</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#ukuran, #kode_lot, #karyawan_1, #karyawan_2, #gaji").select2({
                theme: 'classic',
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            
            $('#kode_lot').on('change', function(e){
                e.preventDefault();
                let data = $(this).val();
                $.ajax({
                    url: "{{ url('kain-roll') }}/"+data,
                    method: "GET",
                    success: function(res){
                        $('#warna').val(res.warna)
                        $('#berat').val(res.berat)
                    }
                })
            });
        });
    </script>
    <script>
        $(document).ready(function(){
            var dtTableOption = {
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": true,
                "responsive": true,
                "stateSave": true
            };

            var data = [];

            // Simpan
            $('#btn-tambah').on('click', function(){
                let karyawan = [];
                let kode_spp    = $('#kode_spp').val();
                let ukuran      = $('#ukuran').val();
                let tanggal     = $('#tanggal').val();
                let kode_lot    = $('#kode_lot').val();
                let warna       = $('#warna').val();
                let berat       = $('#berat').val();
                let hasil       = $('#hasil').val();
                let k1          = $('#karyawan_1').val();
                let k2          = $('#karyawan_2').val();
                karyawan.push(k1, k2);
                let gaji        = $('#gaji').val();

                data.push({
                    kode_spp        : kode_spp,
                    ukuran          : ukuran,
                    tanggal         : tanggal,
                    kode_lot        : kode_lot,
                    warna           : warna,
                    berat           : berat,
                    hasil           : hasil,
                    karyawan        : karyawan,
                    gaji            : gaji
                })

                dataInsert(data);
            })
            
            function dataInsert(datas) {
                extensionList = $('#tabel_insert').DataTable({
                    data: datas,
                    columns: [
                        {
                            data: 'kode_spp',
                            name: 'kode_spp'
                        },
                        {
                            data: 'ukuran',
                            name: 'ukuran'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'kode_lot',
                            name: 'kode_lot'
                        },
                        {
                            data: 'warna',
                            name: 'warna',
                        },
                        {
                            data: 'berat',
                            name: 'berat',
                        },
                        {
                            data: 'hasil',
                            name: 'hasil',
                        },
                        {
                            data: 'karyawan',
                            name: 'karyawan',
                        },
                        {
                            data: 'gaji',
                            name: 'gaji',
                        },
                        {
                            data: 'kode_spp',
                            name: 'kode_spp',
                            orderable: false,
                            searchable: false,
                            render: function (data, type, row) {
                                let btn = '<button type="button" class="btn btn-sm btn-danger remove-extension" data-guid="'+kode_spp+'"><i class="fa fa-trash"></i></button>'
                                return btn
                            }
                        },
                    ],
                    paging: false,
                    bDestroy: true,
                    order: [],
                })
            }
        });
    </script>
@endsection
