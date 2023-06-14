@extends('layouts.app')
@section('title', 'Barang Jadi')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Barang Jadi</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Barang Jadi</li>
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
                                <h5 class="card-title">Filter Status Data Barang Jadi</h5>
                            </div>
                            <div class="card-body row g-2" id="filter_data">
                                <div class="col-lg-4">
                                    <button class="btn btn-outline-danger container-fluid active"
                                        data-status="Belum Diambil">
                                        Belum Diambil
                                    </button>
                                </div>
                                <div class="col-lg-4">
                                    <button class="btn btn-outline-success container-fluid" data-status="Sudah Diambil">
                                        Sudah Diambil
                                    </button>
                                </div>
                                {{-- <div class="col-lg-4">
                                    <button class="btn btn-outline-success container-fluid"
                                        data-status="Selesai Dikerjakan">
                                        Selesai Dikerjakan
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Data Barang Jadi</h5>
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
                                                <th>Artikel</th>
                                                <th>Tanggal</th>
                                                <th>Detail Barang</th>
                                                <th>Quantity</th>
                                                <th>Status Barang</th>
                                                <th width="5%">Aksi</th>
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
        $("select").select2({
            theme: 'classic',
            width: '100%',
        })

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

        $.fn.dataTable.ext.errMode = 'none';

        var Notif = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        })

        status_barang = 'Belum Diambil'
        getBJadi(status_barang);

        $('#filter_data div button').on('click', function(e) {
            e.preventDefault()
            status_barang = $(this).data('status')
            $('#filter_data').find('div button').removeClass('active');
            $(this).addClass('active');
            getBJadi(status_barang)
        })

        function getBJadi(status) {
            var htmlview = ''
            var _url
            @if (Auth::user()->role_id == 1)
                _url = "{{ route('barang_jadi.data', ':status') }}",
            @endif
            @if (Auth::user()->role_id == 2)
                _url = "{{ route('a.barang_jadi.data', ':status') }}",
            @endif
            @if (Auth::user()->role_id == 3)
                _url = "{{ route('w.barang_jadi.data', ':status') }}",
            @endif
            _url = _url.replace(':status', status)

            $.ajax({
                url: _url,
                type: 'GET',
                success: function(res) {
                    let no = 0;
                    $('tbody').html('')
                    $.each(res, function(i, data) {
                        htmlview += `<tr>
                        <td style="text-align: center;">` + (no = no + 1) + `</td>
                        <td>` + data.artikel + `</td>
                        <td>` + data.tanggal + `</td>
                        <td>` + data.kode_finishing + ` <br>
                            ` + data.kode_lot + ` ( ` + data.jenis_kain + ` - ` + data.warna + ` ) <br>
                            Ukuran Potong : ` + data.ukuran + ` 
                        </td>
                        <td class="text-right"> ` + data.jml_barang + ` </td>`;
                        if (data.status == 'Belum Diambil') {
                            htmlview +=
                                `<td>
                                        <button class="btn btn-danger btn-sm container-fluid" title="Confirm Data!" 
                                        onClick="confirmBJadi('` + data.id + `')"> Belum Diambil </button></td>
                                    `;
                        }
                        if (data.status == 'Sudah Diambil') {
                            htmlview += `<td>
                                        <span class="bg-success p-2 container-fluid">Sudah Diambil</span>
                                        </td>
                                    `;
                        }
                        htmlview +=
                            `<td>
                                  <button class="btn btn-danger btn-sm" title="Delete Data!" 
                                  onClick="deleteBJadi('` + data.id + `')"> <i class="fas fa-trash"></i>
                                  </button>
                                </td>
                               </tr>`

                    });
                    $("#tbl_ukuran").DataTable(dtTableOption).destroy()
                    $('tbody').html(htmlview)
                    $("#tbl_ukuran").DataTable(dtTableOption).buttons().container().appendTo(
                        '#tbl_ukuran_wrapper .col-md-6:eq(0)')
                }
            })

        }

        function deleteBJadi(id) {
            Swal.fire({
                    title: "Apakah anda yakin hapus data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Tidak",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        @if (Auth::user()->role_id == 1)
                            var _url = "{{ route('barang_jadi.delete', 'id') }}";
                        @endif
                        @if (Auth::user()->role_id == 2)
                            var _url = "{{ route('a.barang_jadi.delete', 'id') }}";
                        @endif
                        _url = _url.replace('id', id)
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
                                getBJadi(status_barang)

                                if (res.code == 500) {
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Hapus Data Barang!',
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

        function confirmBJadi(id) {
            Swal.fire({
                    title: "Apakah anda yakin konfirmasi data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Konfirmasi!",
                    cancelButtonText: "Tidak",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        @if (Auth::user()->role_id == 1)
                            var _url = "{{ route('barang_jadi.confirm', 'id') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
                            var _url = "{{ route('w.barang_jadi.confirm', 'id') }}";
                        @endif
                        _url = _url.replace('id', id)
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
                                getBJadi(status_barang)

                                if (res.code == 500) {
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Konfirmasi Data Barang Jadi',
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
