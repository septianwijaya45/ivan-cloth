@extends('layouts.app')
@section('title', 'Ukuran')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Master Ukuran</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Ukuran</li>
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
                                <h5 class="card-title">Data Ukuran</h5>

                                <div class="card-tools">
                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#modalAddUkuran">
                                        <i class="fas fa-plus"></i> Tambah Data
                                    </button>
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
                                                <th width="15%">Kode Ukuran</th>
                                                <th>Ukuran</th>
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

    <!-- The Modal -->
    <div class="modal fade" id="modalAddUkuran" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Ukuran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formAddUkuran" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="kode_ukuran">Kode ukuran</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Kode ukuran Ukuran (ex: L, XL)"
                                            name="kode_ukuran" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="ukuran">Ukuran</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Ukuran Kain (ex: Large, Extra Large)"
                                            name="ukuran" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer container-fluid mt-4">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="button" id="tambahData" class="btn btn-primary">Tambah Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditUkuran" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Ukuran</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formEditUkuran" data-id=""
                        class="needs-validation" novalidate>
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="kode_ukuran">Kode ukuran</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Kode ukuran Ukuran (ex: L, XL)"
                                            name="kode_ukuran" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="ukuran">Ukuran</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Ukuran Kain (ex: Large, Extra Large)"
                                            name="ukuran" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer container-fluid mt-4">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="button" id="simpanData" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->
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
                // {
                //     text: "<i class='fas fa-cog' title='Coloum Visible Option'></i>",
                //     className: "btn btn-outline-info",
                //     extend: 'colvis'
                // }
            ]
        };

        var Notif = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        })

        getUkuran()

        function getUkuran() {
            var htmlview
            $.ajax({
                @if (Auth::user()->role_id == 1)
                    url: "{{ route('ukuran.data') }}",
                @else
                    url: "{{ route('a.ukuran.data') }}",
                @endif
                type: 'GET',
                success: function(res) {
                    $('tbody').html('')
                    $.each(res, function(i, data) {
                        htmlview += `<tr>
                            <td style="text-align: center;">` + data.id + `</td>
                            <td>` + data.kode_ukuran + `</td>
                            <td>` + data.ukuran + `</td>
                            <td>
                            <button class="btn btn-info btn-sm" title="Edit Data!" onClick="detailUkuran('` + data
                            .uuid + `')"> <i class="fas fa-pencil-alt"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="deleteUkuran('` + data
                            .uuid + `')"> <i class="fas fa-trash"></i>
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

        function addUkuran() {
            $.ajax({
                @if (Auth::user()->role_id == 1)
                    url: "{{ route('ukuran.add') }}",
                @else
                    url: "{{ route('a.ukuran.add') }}",
                @endif
                type: "POST",
                data: $('#formAddUkuran').serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.code == 200) {
                        $('#formAddUkuran').trigger('reset')
                        $('#modalAddUkuran').modal('hide')

                        Notif.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        $("#tbl_ukuran").DataTable().destroy();
                        getUkuran()
                    }

                    if (res.code == 500) {
                        Notif.fire({
                            icon: 'error',
                            title: 'Gagal Menyimpan Data Gaji',
                            text: 'Server Error!'
                        });

                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan Data Ukuran',
                    });

                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formAddUkuran').find('[name="' + i + '"]');
                        el.addClass('is-invalid');
                        el.after('<div class="invalid-feedback">' + error[0] + '</div>');
                    });
                }
            })
        }

        function detailUkuran(id) {
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('ukuran.edit', ':id') }}"
            @else
                var _url = "{{ route('a.ukuran.edit', ':id') }}"
            @endif
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'GET',
                success: function(res) {
                    $('#modalEditUkuran').modal('show')
                    $('#formEditUkuran').attr("data-id", id)
                    $.each(res, function(i, data) {
                        var el = $('#formEditUkuran').find('[name="' + i + '"]');
                        el.val(data);
                    })
                }
            })
        }

        function updateUkuran() {
            var id = $('#formEditUkuran').data('id')

            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('ukuran.update', ':id') }}"
            @else
                var _url = "{{ route('a.ukuran.update', ':id') }}"
            @endif
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'PUT',
                data: $('#formEditUkuran').serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.code == 200) {
                        $('#formEditUkuran').trigger('reset')
                        $('#modalEditUkuran').modal('hide')

                        Notif.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        $("#tbl_ukuran").DataTable().destroy();
                        getUkuran()
                    }

                    if (res.code == 500) {
                        Notif.fire({
                            icon: 'error',
                            title: 'Gagal Menyimpan Data Gaji',
                            text: 'Server Error!'
                        });

                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan Data Ukuran',
                    });

                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formEditUkuran').find('[name="' + i + '"]');
                        el.addClass('is-invalid');
                        el.after('<div class="invalid-feedback">' + error[0] + '</div>');
                    });
                }
            })
        }

        $('#tambahData').on('click', function(e) {
            e.preventDefault()
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            addUkuran()
        })

        $('#simpanData').on('click', function(e) {
            e.preventDefault()
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            updateUkuran()
        })

        function deleteUkuran(id) {
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
                            var _url = "{{ route('ukuran.delete', ':id') }}";
                        @else
                            var _url = "{{ route('a.ukuran.delete', ':id') }}";
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
                                $("#tbl_ukuran").DataTable().destroy();
                                getUkuran();

                                if (res.code == 500) {
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
    </script>
@endsection
