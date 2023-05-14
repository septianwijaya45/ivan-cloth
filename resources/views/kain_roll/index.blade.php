@extends('layouts.app')
@section('title', 'Kain Roll')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Master Kain Roll</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Kain Roll</li>
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
                                <h5 class="card-title">Data Kain Roll</h5>

                                <div class="card-tools">
                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#modalAddKainRoll">
                                        <i class="fas fa-plus"></i> Tambah Data
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="tbl_kain_roll_wrapper"
                                    class="dataTables_wrapper dt-bootstrap4 table-responsive text-nowrap">
                                    <table id="tbl_kain_roll" class="table table-bordered table-striped dataTable"
                                        aria-describedby="tbl_kain_roll" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="5%" style="text-align: center;">ID</th>
                                                <th>Kode LOT</th>
                                                <th>Jenis Kain</th>
                                                <th>Warna</th>
                                                <th>Stok Roll</th>
                                                <th>Berat /roll</th>
                                                <th>Total Berat</th>
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
    <div class="modal fade" id="modalAddKainRoll" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Kain Roll</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formAddKainRoll" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <label for="kode_lot">Kode LOT</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="LOT-0001" name="kode_lot" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="jenis_kain">Jenis Kain</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Katun, Linen, Denim, dll" name="jenis_kain"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="warna">Warna</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Warna kain." name="warna" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="stok_roll">Stok Roll</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Stok Kain Roll" name="stok_roll"
                                            class="form-control" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="berat">Berat (per Kg)</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Berat kain" name="berat" class="form-control"
                                            step=".01" min="1">
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

    <div class="modal fade" id="modalEditKainRoll" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Kain Roll</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formEditKainRoll" data-id=""
                        class="needs-validation" novalidate>
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-3">
                                <label for="kode_lot">Kode LOT</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="LOT-0001" name="kode_lot"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <label for="jenis_kain">Jenis Kain</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Katun, Linen, Denim, dll" name="jenis_kain"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="warna">Warna</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Warna kain." name="warna"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="stok_roll">Stok Roll</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Stok Kain Roll" name="stok_roll"
                                            class="form-control" min="0">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-2">
                                <label for="berat">Berat (per Kg)</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Berat kain" name="berat"
                                            class="form-control" step=".01" min="1">
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

        getKainRoll()

        function getKainRoll() {
            var htmlview
            $.ajax({
                @if (Auth::user()->role_id == 1)
                    url: "{{ route('kain_roll.data') }}",
                @endif
                @if (Auth::user()->role_id == 3)
                    url: "{{ route('w.kain_roll.data') }}",
                @endif
                type: 'GET',
                success: function(res) {
                    $('tbody').html('')
                    $.each(res, function(i, data) {
                        htmlview += `<tr>
                        <td style="text-align: center;">` + data.id + `</td>
                        <td>` + data.kode_lot + `</td>
                        <td>` + data.jenis_kain + `</td>
                        <td>` + data.warna + `</td>
                        <td style='text-align: right;'>` + data.stok_roll + `</td>
                        <td style='text-align: right;'>` + data.berat + ` kg</td>
                        <td style='text-align: right;'>` + (data.stok_roll * data.berat) + ` kg</td>
                        <td>
                          <button class="btn btn-info btn-sm" title="Edit Data!" onClick="detailKainRoll('` + data
                            .uuid + `')"> <i class="fas fa-pencil-alt"></i>
                          </button>
                          <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="deleteKainRoll('` + data
                            .uuid + `')"> <i class="fas fa-trash"></i>
                          </button>
                        </td>
                       </tr>`
                    });

                    $('tbody').html(htmlview)
                    $("#tbl_kain_roll").DataTable(dtTableOption).buttons().container().appendTo(
                        '#tbl_kain_roll_wrapper .col-md-6:eq(0)')
                }
            })
        }

        function addKainRoll() {
            $.ajax({
                @if (Auth::user()->role_id == 1)
                    url: "{{ route('kain_roll.add') }}",
                @endif
                @if (Auth::user()->role_id == 3)
                    url: "{{ route('w.kain_roll.add') }}",
                @endif
                type: "POST",
                data: $('#formAddKainRoll').serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.code == 200) {
                        $('#formAddKainRoll').trigger('reset')
                        $('#modalAddKainRoll').modal('hide')

                        Notif.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        $("#tbl_kain_roll").DataTable().destroy();
                        getKainRoll()
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan Data Kain Roll',
                    });

                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formAddKainRoll').find('[name="' + i + '"]');
                        el.addClass('is-invalid');
                        el.after('<div class="invalid-feedback">' + error[0] + '</div>');
                    });
                }
            })
        }

        function detailKainRoll(id) {
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('kain_roll.detail', ':id') }}"
            @endif
            @if (Auth::user()->role_id == 3)
                var _url = "{{ route('w.kain_roll.detail', ':id') }}"
            @endif
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'GET',
                success: function(res) {
                    $('#modalEditKainRoll').modal('show')
                    $('#formEditKainRoll').attr("data-id", id)
                    $.each(res, function(i, data) {
                        var el = $('#formEditKainRoll').find('[name="' + i + '"]');
                        el.val(data);
                    })
                }
            })
        }

        function updateKainRoll() {
            var id = $('#formEditKainRoll').data('id')
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('kain_roll.update', ':id') }}"
            @endif
            @if (Auth::user()->role_id == 3)
                var _url = "{{ route('w.kain_roll.update', ':id') }}"
            @endif
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'PUT',
                data: $('#formEditKainRoll').serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.code == 200) {
                        $('#formEditKainRoll').trigger('reset')
                        $('#modalEditKainRoll').modal('hide')

                        Notif.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        $("#tbl_kain_roll").DataTable().destroy();
                        getKainRoll()
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan Data Kain Roll',
                    });

                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formEditKainRoll').find('[name="' + i + '"]');
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
            addKainRoll()
        })

        $('#simpanData').on('click', function(e) {
            e.preventDefault()
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            updateKainRoll()
        })

        function deleteKainRoll(id) {
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
                            var _url = "{{ route('kain_roll.delete', ':id') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
                            var _url = "{{ route('w.kain_roll.delete', ':id') }}";
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
                                $("#tbl_kain_roll").DataTable().destroy();
                                getKainRoll();
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
