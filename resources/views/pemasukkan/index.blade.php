@extends('layouts.app')
@section('title', 'Pemasukkan')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Pemasukkan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Pemasukkan</li>
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
                            <div class="card-header bg-primary">
                                <h5 class="card-title">Filter Data</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fromDate">Dari Tanggal</label>
                                            <input type="date" class="form-control" placeholder="Tanggal" id="fromDate" name="fromDate" value="{{$date}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="fromDate">Ke Tanggal</label>
                                            <input type="date" class="form-control" placeholder="Tanggal" id="toDate" name="toDate" value="{{$date}}">
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group text-center align-item-center mt-4">
                                            <button type="button" id="searchData" class="btn btn-primary">Cari Data</button>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-group text-center align-item-center mt-4">
                                            <button type="button" id="clearData" class="btn btn-warning">Show All Data</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Data Pemasukkan</h5>
                                <div class="card-tools">
                                    <a href="{{ route('pemasukkan.insert') }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i> Tambah Data
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="tbl_pemasukkan_wrapper"
                                    class="dataTables_wrapper dt-bootstrap4 table-responsive text-nowrap">
                                    <table id="tbl_pemasukkan" class="table table-bordered table-striped dataTable"
                                        aria-describedby="tbl_pemasukkan" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="5%" style="text-align: center;">ID</th>
                                                <th>Kode Pemasukkan</th>
                                                <th>Total</th>
                                                <th>Tanggal</th>
                                                <th>Status</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- ./card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var Notif = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        })

        function deleteData(id) {
            Swal.fire({
                    title: "Apakah anda yakin hapus data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Tidak",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        @if(Auth::user()->role_id == 1)
                        var _url = "{{ route('pemasukkan.delete', ':id') }}";
                        @else
                        var _url = "{{ route('pemasukkan.delete', ':id') }}";
                        @endif
                        _url = _url.replace(':id', id)
                        var _token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: _url,
                            type: 'DELETE',
                            data: {
                                _token: _token
                            },
                            success: function(res) {
                                Notif.fire({
                                    icon: 'success',
                                    title: res.message,
                                })
                                $("#tbl_pemasukkan").DataTable().destroy();
                                getPerlengkapan();
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    }
                });
        }
    </script>
    <script>
        $(document).ready(function(){
            $('#tbl_pemasukkan').DataTable({
                processing      : true,
                serverSide      : true,
                autoWidth       : true,
                destroy         : true,
                pageLength      : 10,
                "order"         : [[0, "desc"]],
                ajax            : {
                        url         : "{{route('pemasukkan.data')}}",
                        method      : "GET"
                },
                columns         : [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'kode_pemasukan', name: 'kode_pemasukan'},
                    {data: 'total', name: 'total'},
                    {data: 'tanggal', name: 'tanggal'},
                    {data: 'Status', name: 'Status'},
                    {data: 'Action', name: 'Action', orderable:'false', searchable: 'false', sClass:'text-center'}
                ]
            });

            
            let fromDate, toDate, htmlview
            fromDate = $('#fromDate').val()
            toDate = $('#toDate').val()
            $('#fromDate').on('change', function(){
                fromDate = $(this).val()
            })
            $('#toDate').on('change', function(){
                toDate = $(this).val()
            })

            $('#searchData').on('click', function(){
                $('#tbl_pemasukkan').DataTable({
                    processing      : true,
                    serverSide      : true,
                    autoWidth       : true,
                    destroy         : true,
                    pageLength      : 10,
                    "order"         : [[0, "desc"]],
                    ajax            : {
                            url         : "{{route('pemasukkan.searchData')}}",
                            method      : "POST",
                            data: {'fromDate': fromDate, 'toDate': toDate},
                    },
                    columns         : [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'kode_pemasukan', name: 'kode_pemasukan'},
                        {data: 'total', name: 'total'},
                        {data: 'tanggal', name: 'tanggal'},
                        {data: 'Status', name: 'Status'},
                        {data: 'Action', name: 'Action', orderable:'false', searchable: 'false', sClass:'text-center'}
                    ]
                });
                setInterval(function () {
                    $('.datatable').DataTable().ajax.reload();
                }, 10000);
            });

            $('#clearData').on('click', function(){
                $('#fromDate').val('{{$date}}')
                $('#toDate').val('{{$date}}')
                $('#tbl_pemasukkan').DataTable({
                    processing      : true,
                    serverSide      : true,
                    autoWidth       : true,
                    destroy         : true,
                    pageLength      : 10,
                    "order"         : [[0, "desc"]],
                    ajax            : {
                            url         : "{{route('pemasukkan.data')}}",
                            method      : "GET"
                    },
                    columns         : [
                        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                        {data: 'kode_pemasukan', name: 'kode_pemasukan'},
                        {data: 'total', name: 'total'},
                        {data: 'tanggal', name: 'tanggal'},
                        {data: 'Status', name: 'Status'},
                        {data: 'Action', name: 'Action', orderable:'false', searchable: 'false', sClass:'text-center'}
                    ]
                });
            });
        })
    </script>
@endsection