@extends('layouts.app')
@section('title', 'Aset')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Master Aset</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Aset</li>
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
                                <h5 class="card-title">Data Aset</h5>

                                <div class="card-tools">
                                    <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#modalAddAset">
                                        <i class="fas fa-plus"></i> Tambah Data
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="tbl_aset_wrapper"
                                    class="dataTables_wrapper dt-bootstrap4 table-responsive text-nowrap">
                                    <table id="tbl_aset" class="table table-bordered table-striped dataTable"
                                        aria-describedby="tbl_aset" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="5%" style="text-align: center;">ID</th>
                                                <th>Nama Aset</th>
                                                <th>Kode Aset</th>
                                                <th>Total Stok</th>
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

    <!-- The Modal -->
    <div class="modal fade" id="modalAddAset" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Aset</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formAddAset" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <label for="nama">Nama Aset</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nama Aset" name="nama" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="kode">Kode Aset</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" name="kode" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 mt-3">
                                <label for="total_stok">Total Stok</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" name="total_stok" class="form-control" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="status">Status Aset</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="status" class="form-control">
                                            <option value="Dipakai">Dipakai</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
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

    <div class="modal fade" id="modalEditAset" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Perlengkapan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formEditAset" data-id=""
                        class="needs-validation" novalidate>
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="nama">Nama Aset</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nama Aset" name="nama"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="kode">Kode Aset</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Kode Aset" name="kode"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 mt-3">
                                <label for="total_stok">Total Stok</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" name="total_stok" class="form-control" value="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="status">Status Aset</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="status" class="form-control">
                                            <option value="Dipakai">Dipakai</option>
                                            <option value="Rusak">Rusak</option>
                                        </select>
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

        getAset()

        function getAset() {
            var htmlview
            $.ajax({
                @if(Auth::user()->role_id == 1)
                url: "{{ route('aset.data') }}",
                @else
                url: "{{ route('a.aset.data') }}",
                @endif
                type: 'GET',
                success: function(res) {
                    $('tbody').html('')
                    $.each(res, function(i, data) {

                        var status = data.status
                        if (status == 'Dipakai') {
                            status =
                                '<span class="btn btn-success btn-sm container-fluid"> Dipakai </span>'
                        } else {
                            status =
                                '<span class="btn btn-danger btn-sm container-fluid"> Rusak </span>'
                        }

                        htmlview += `<tr>
                        <td style="text-align: center;">` + data.id + `</td>
                        <td>` + data.nama + `</td>
                        <td>` + data.kode + `</td>
                        <td>` + data.total_stok + `</td>
                        <td>` + status + `</td>
                        <td>
                          <button class="btn btn-info btn-sm" title="Edit Data!" onClick="detailAset('` + data
                            .uuid + `')"> <i class="fas fa-pencil-alt"></i>
                          </button>
                          <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="deleteAset('` +
                            data.uuid + `')"> <i class="fas fa-trash"></i>
                          </button>
                        </td>
                       </tr>`
                    });

                    $('tbody').html(htmlview)
                    $("#tbl_aset").DataTable(dtTableOption).buttons().container().appendTo(
                        '#tbl_aset_wrapper .col-md-6:eq(0)')
                }
            })
        }

        function addAset() {
            $.ajax({
                @if(Auth::user()->role_id == 1)
                url: "{{ route('aset.add') }}",
                @else
                url: "{{ route('a.aset.add') }}",
                @endif
                type: "POST",
                data: $('#formAddAset').serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.code == 200) {
                        $('#formAddAset').trigger('reset')
                        $('#modalAddAset').modal('hide')

                        Notif.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        $("#tbl_aset").DataTable().destroy();
                        getAset()
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan Data Aset',
                    });

                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formAddAset').find('[name="' + i + '"]');
                        el.addClass('is-invalid');
                        el.after('<div class="invalid-feedback">' + error[0] + '</div>');
                    });
                }
            })
        }

        function detailAset(id) {
            @if(Auth::user()->role_id == 1)
            var _url = "{{ route('aset.detail', ':id') }}"
            @else
            var _url = "{{ route('a.aset.detail', ':id') }}"
            @endif
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'GET',
                success: function(res) {
                    $('#modalEditAset').modal('show')
                    $('#formEditAset').attr("data-id", id)
                    $.each(res, function(i, data) {
                        var el = $('#formEditAset').find('[name="' + i + '"]');
                        el.val(data);
                    })
                }
            })
        }

        function updateAset() {
            var id = $('#formEditAset').data('id')
            @if(Auth::user()->role_id == 1)
            var _url = "{{ route('aset.update', ':id') }}"
            @else
            var _url = "{{ route('a.aset.update', ':id') }}"
            @endif
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'PUT',
                data: $('#formEditAset').serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.code == 200) {
                        $('#formEditAset').trigger('reset')
                        $('#modalEditAset').modal('hide')

                        Notif.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        $("#tbl_aset").DataTable().destroy();
                        getAset()
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan Data Aset',
                    });

                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formEditAset').find('[name="' + i + '"]');
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
            addAset()
        })

        $('#simpanData').on('click', function(e) {
            e.preventDefault()
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            updateAset()
        })

        function deleteAset(id) {
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
                        var _url = "{{ route('aset.delete', ':id') }}";
                        @else
                        var _url = "{{ route('a.aset.delete', ':id') }}";
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
                                $("#tbl_aset").DataTable().destroy();
                                getAset();
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
