@extends('layouts.app')
@section('title', 'Kain Potongan')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Master Kain Potongan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Kain Potongan</li>
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
                                <h5 class="card-title">Data Kain Potongan</h5>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="tbl_kain_potongan_wrapper"
                                    class="dataTables_wrapper dt-bootstrap4 table-responsive text-nowrap">
                                    <table id="tbl_kain_potongan" class="table table-bordered table-striped dataTable"
                                        aria-describedby="tbl_kain_potongan" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="5%" style="text-align: center;">ID</th>
                                                <th>Kain Potongan</th>
                                                <th>Quantity</th>
                                                <th>Warna</th>
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
    <div class="modal fade" id="modalAddKainPotongan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Kain Potongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formAddKainPotongan" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label for="kain_roll_id">Kain Roll</label>
                                <select name="kain_roll_id" id="kain_roll_id" class="form-control">
                                    <option value="" selected disabled class="text-center">Pilih Kain Roll</option>
                                    @foreach ($kain_roll as $dt)
                                        <option value="{{$dt->id}}">{{$dt->kode_lot}} | {{$dt->jenis_kain}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="ukurang">Ukuran</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Ukuran" name="ukuran"
                                            class="form-control" step=".01">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="stok">Stok</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Stok" name="stok"
                                            class="form-control" step=".01">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer container-fluid mt-4">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="button" id="tambahData" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalEditKainPotongan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Kain Potongan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formEditKainPotongan" data-id=""
                        class="needs-validation" novalidate>
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="kain_roll_id">Kain Roll</label>
                                <select name="kain_roll_id" id="kain_roll_id" class="form-control" @readonly(true)>
                                    <option value="" selected disabled class="text-center">Pilih Kain Roll</option>
                                    @foreach ($kain_roll as $dt)
                                        <option value="{{$dt->id}}">{{$dt->kode_lot}} | {{$dt->jenis_kain}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="ukurang">Ukuran</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="ukuran" id="ukuran" class="form-control" @readonly(true)>
                                            <option value="" selected>===== Pilih Ukuran ======</option>
                                            @foreach ($ukuran as $dt)
                                                <option value="{{$dt->ukuran}}">{{$dt->ukuran}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="stok">Stok</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Stok" name="stok"
                                            class="form-control" step=".01">
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

        getKainPotongan()

        function getKainPotongan() {
            var htmlview
            $.ajax({
                @if(Auth::user()->role_id == 1)
                url: "{{ route('kain_potongan.data') }}",
                @endif
                @if(Auth::user()->role_id == 3)
                url: "{{ route('w.kain_potongan.data') }}",
                @endif
                type: 'GET',
                success: function(res) {
                    $('tbody').html('')
                    $.each(res, function(i, data) {
                        htmlview += `<tr>
                        <td style="text-align: center;">` + data.id + `</td>
                        <td>` + data.kain_roll + `</td>
                        <td>` + data.stok + `</td>
                        <td>` + data.warna + `</td>
                        <td>
                          <button class="btn btn-info btn-sm" title="Edit Data!" onClick="detailKainPotongan('` + data
                            .uuid + `')"> <i class="fas fa-pencil-alt"></i>
                          </button>
                          <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="deleteKainPotongan('` + data
                            .uuid + `')"> <i class="fas fa-trash"></i>
                          </button>
                        </td>
                       </tr>`
                    });

                    $('tbody').html(htmlview)
                    $("#tbl_kain_potongan").DataTable(dtTableOption).buttons().container().appendTo(
                        '#tbl_kain_potongan_wrapper .col-md-6:eq(0)')
                }
            })
        }

        function addKainPotongan() {
            $.ajax({
                @if(Auth::user()->role_id == 1)
                url: "{{ route('kain_potongan.add') }}",
                @endif
                @if(Auth::user()->role_id == 3)
                url: "{{ route('w.kain_potongan.add') }}",
                @endif
                type: "POST",
                data: $('#formAddKainPotongan').serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.code == 200) {
                        $('#formAddKainPotongan').trigger('reset')
                        $('#modalAddKainPotongan').modal('hide')

                        Notif.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        $("#tbl_kain_potongan").DataTable().destroy();
                        getKainPotongan()
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan Data Kain Potongan',
                    });

                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formAddKainPotongan').find('[name="' + i + '"]');
                        el.addClass('is-invalid');
                        el.after('<div class="invalid-feedback">' + error[0] + '</div>');
                    });
                }
            })
        }

        function detailKainPotongan(id) {
            @if(Auth::user()->role_id == 1)
            var _url = "{{ route('kain_potongan.detail', ':id') }}"
            @endif
            @if(Auth::user()->role_id == 3)
            var _url = "{{ route('w.kain_potongan.detail', ':id') }}"
            @endif
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'GET',
                success: function(res) {
                    $('#modalEditKainPotongan').modal('show')
                    $('#formEditKainPotongan').attr("data-id", id)
                    $.each(res, function(i, data) {
                        var el = $('#formEditKainPotongan').find('[name="' + i + '"]');
                        el.val(data);
                    })
                }
            })
        }

        function updateKainPotongan() {
            var id = $('#formEditKainPotongan').data('id')
            
            @if(Auth::user()->role_id == 1)
            var _url = "{{ route('kain_potongan.update', ':id') }}"
            @endif
            @if(Auth::user()->role_id == 3)
            var _url = "{{ route('w.kain_potongan.update', ':id') }}"
            @endif
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'PUT',
                data: $('#formEditKainPotongan').serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.code == 200) {
                        $('#formEditKainPotongan').trigger('reset')
                        $('#modalEditKainPotongan').modal('hide')

                        Notif.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        $("#tbl_kain_potongan").DataTable().destroy();
                        getKainPotongan()
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan Data Kain Potongan',
                    });

                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formEditKainPotongan').find('[name="' + i + '"]');
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
            addKainPotongan()
        })

        $('#simpanData').on('click', function(e) {
            e.preventDefault()
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            updateKainPotongan()
        })

        function deleteKainPotongan(id) {
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
                        var _url = "{{ route('kain_potongan.delete', ':id') }}";
                        @endif
                        @if(Auth::user()->role_id == 3)
                        var _url = "{{ route('w.kain_potongan.delete', ':id') }}";
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
                                $("#tbl_kain_potongan").DataTable().destroy();
                                getKainPotongan();
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
