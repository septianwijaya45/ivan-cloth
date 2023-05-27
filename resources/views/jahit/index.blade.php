@extends('layouts.app')
@section('title', 'Jahit')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Surat Jahit</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Surat Jahit</li>
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
                                <h5 class="card-title">Data Surat Jahit</h5>

                                <div class="card-tools">
                                    @if(Auth::user()->role_id == 1)
                                    <a href="{{ route('jahit.insert') }}" class="btn btn-success btn-sm">Tambah Data</a>
                                    @endif
                                    @if(Auth::user()->role_id == 3)
                                    <a href="{{ route('w.jahit.insert') }}" class="btn btn-success btn-sm">Tambah Data</a>
                                    @endif
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="tbl_ukuran_wrapper"
                                    class="dataTables_wrapper dt-bootstrap4 table-responsive text-nowrap">
                                    <table id="tbl_ukuran" class="table table-bordered table-striped dataTable"
                                        aria-describedby="tbl_ukuran" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="5%" style="text-align: center;">ID</th>
                                                <th>Kode Jahit</th>
                                                <th>Total Perintah Jahit</th>
                                                <th>Tanggal</th>
                                                <th>Status Surat</th>
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

        var dtTableOption = {
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "stateSave": true,
            "buttons": [{
                    text: "<i class='fas fa-copy' title='Copy Table to Clipboard'></i>",
                    className: "btn btn-outline-secondary",
                    extend: 'copy'
                },
                {
                    text: "<i class='fas fa-file-excel' title='Download File Excel'></i>",
                    className: "btn btn-outline-success",
                    extend: 'excel'
                },
                {
                    text: "<i class='fas fa-file-pdf' title='Download File PDF'></i>",
                    className: "btn btn-outline-danger",
                    extend: 'pdf'
                },
                {
                    text: "<i class='fas fa-print' title='Print Table'></i>",
                    className: "btn btn-outline-primary",
                    extend: 'print'
                },
            ]
        };

        var Notif = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        })

        getSPK()

        function getSPK() {
            var htmlview
            $.ajax({
                @if(Auth::user()->role_id == 1)
                url: "{{ route('jahit.data') }}",
                @endif
                @if(Auth::user()->role_id == 3)
                url: "{{ route('w.jahit.data') }}",
                @endif
                type: 'GET',
                success: function(res) {
                    let no = 0;
                    $('tbody').html('')
                    $.each(res, function(i, data) {
                        htmlview += `<tr>
                        <td style="text-align: center;">` + (no = no+1) + `</td>
                        <td>` + data.kode_jahit + `</td>
                        <td>` + data.total + `</td>
                        <td>` + data.tanggal + `</td>
                        `;
                        if(data.status == 'Belum Konfirmasi'){
                            htmlview += `<td>
                                <button class="btn btn-danger btn-sm" title="Confirm Data!" onClick="confirmJahit('` + data
                                .kode_jahit + `')"> Belum Konfirmasi </button></td>
                            `;
                        }
                        if(data.status == 'Sedang Dikerjakan'){
                            htmlview += `<td>
                                <button class="btn btn-warning btn-sm" title="Finish Data!" onClick="finishedJahit('` + data
                                .kode_jahit + `')"> Sedang Dikerjakan </button></td>
                            `;
                        }
                        if(data.status == 'Selesai Dikerjakan'){
                            htmlview += `<td>
                                <span class="bg-success p-2">Selesai Dikerjakan</span></td>
                            `;
                        }
                        htmlview +=`<td>
                          <a class="btn btn-info btn-sm" title="Edit Data!" href="surat-perintah-kain/edit-data/`+data.uuid+`"> <i class="fas fa-pencil-alt"></i>
                          </a>
                          <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="deleteJahit('` + data
                            .kode_jahit + `')"> <i class="fas fa-trash"></i>
                          </button>
                        </td>
                       </tr>`
                    });

                    $('tbody').html(htmlview)
                    $("#tbl_ukuran").DataTable(dtTableOption).buttons().container().appendTo(
                        '#tbl_ukuran_wrapper .col-md-6:eq(0)')
                }
            })
        }

        function deleteSPK(kode_jahit) {
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
                        var _url = "{{ route('jahit.delete', 'kode_jahit') }}";
                        @endif
                        @if(Auth::user()->role_id == 3)
                        var _url = "{{ route('w.jahit.delete', 'kode_jahit') }}";
                        @endif
                        _url = _url.replace('kode_jahit', kode_jahit)
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
                                $("#tbl_ukuran").DataTable().destroy();
                                getSPK();

                                if(res.code == 500){
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Menyimpan Data Gaji',
                                        text: 'Server Error!'
                                    });
                                    
                                }
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    }
                });
        }

        function confirmSPK(kode_jahit) {
            Swal.fire({
                    title: "Apakah anda yakin konfirmasi data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Konfirmasi!",
                    cancelButtonText: "Tidak",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        @if(Auth::user()->role_id == 1)
                        var _url = "{{ route('jahit.confirm', 'kode_jahit') }}";
                        @endif
                        @if(Auth::user()->role_id == 3)
                        var _url = "{{ route('w.jahit.confirm', 'kode_jahit') }}";
                        @endif
                        _url = _url.replace('kode_jahit', kode_jahit)
                        var _token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: _url,
                            type: 'PUT',
                            data: {
                                _token: _token
                            },
                            success: function(res) {
                                Notif.fire({
                                    icon: 'success',
                                    title: res.message,
                                })
                                $("#tbl_ukuran").DataTable().destroy();
                                getSPK();

                                if(res.code == 500){
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Konfirmasi Data SPK',
                                        text: 'Server Error!'
                                    });
                                    
                                }
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    }
                });
        }

        function finishedSPK(kode_jahit) {
            Swal.fire({
                    title: "Apakah anda yakin konfirmasi selesai data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Konfirmasi!",
                    cancelButtonText: "Tidak",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        @if(Auth::user()->role_id == 1)
                        var _url = "{{ route('jahit.finished', 'kode_jahit') }}";
                        @endif
                        @if(Auth::user()->role_id == 3)
                        var _url = "{{ route('w.jahit.finished', 'kode_jahit') }}";
                        @endif
                        _url = _url.replace('kode_jahit', kode_jahit)
                        var _token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: _url,
                            type: 'PUT',
                            data: {
                                _token: _token
                            },
                            success: function(res) {
                                Notif.fire({
                                    icon: 'success',
                                    title: res.message,
                                })
                                $("#tbl_ukuran").DataTable().destroy();
                                getSPK();

                                if(res.code == 500){
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Konfirmasi Selesai Data SPK',
                                        text: 'Server Error!'
                                    });
                                    
                                }
                            },
                            error: function(err) {
                                console.log(err);
                            }
                        })
                    }
                });
        }
    </script>
@endsection