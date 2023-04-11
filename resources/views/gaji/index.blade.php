@extends('layouts.app')
@section('title', 'Gaji')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Master Gaji</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item active">Gaji</li>
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
                                <h5 class="card-title">Data Gaji</h5>

                                <div class="card-tools">
                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#modalAddGaji">
                                        <i class="fas fa-plus"></i> Tambah Data
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="tbl_gaji_wrapper"
                                    class="dataTables_wrapper dt-bootstrap4 table-responsive text-nowrap">
                                    <table id="tbl_gaji" class="table table-bordered table-striped dataTable"
                                        aria-describedby="tbl_gaji" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="5%" style="text-align: center;">ID</th>
                                                <th>Gaji</th>
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
    <div class="modal fade" id="modalAddGaji" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Gaji</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formAddGaji" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <label for="gaji">Gaji</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Gaji (ex: 2000)" name="gaji"
                                            class="form-control">
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

    <div class="modal fade" id="modalEditGaji" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Gaji</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formEditGaji" data-id=""
                        class="needs-validation" novalidate>
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="gaji">Gaji</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Gaji (ex: 2000)" name="gaji"
                                            class="form-control">
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

        getGaji()

        function getGaji() {
            var htmlview
            $.ajax({
                url: "{{ route('gaji.data') }}",
                type: 'GET',
                success: function(res) {
                    $('tbody').html('')
                    $.each(res, function(i, data) {
                        htmlview += `<tr>
                        <td style="text-align: center;">` + data.id + `</td>
                        <td>` + data.gaji + `</td>
                        <td>
                          <button class="btn btn-info btn-sm" title="Edit Data!" onClick="detailGaji('` + data
                            .uuid + `')"> <i class="fas fa-pencil-alt"></i>
                          </button>
                          <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="deleteGaji('` + data
                            .uuid + `')"> <i class="fas fa-trash"></i>
                          </button>
                        </td>
                       </tr>`
                    });

                    $('tbody').html(htmlview)
                    $("#tbl_gaji").DataTable(dtTableOption).buttons().container().appendTo(
                        '#tbl_gaji_wrapper .col-md-6:eq(0)')
                }
            })
        }

        function addGaji() {
            $.ajax({
                url: "{{ route('gaji.add') }}",
                type: "POST",
                data: $('#formAddGaji').serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.code == 200) {
                        $('#formAddGaji').trigger('reset')
                        $('#modalAddGaji').modal('hide')

                        Notif.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        $("#tbl_gaji").DataTable().destroy();
                        getGaji()
                    }

                    if(res.code == 500){
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
                        title: 'Gagal Menyimpan Data Gaji',
                    });

                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formAddGaji').find('[name="' + i + '"]');
                        el.addClass('is-invalid');
                        el.after('<div class="invalid-feedback">' + error[0] + '</div>');
                    });
                }
            })
        }

        function detailGaji(id) {
            var _url = "{{ route('gaji.edit', ':id') }}"
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'GET',
                success: function(res) {
                    $('#modalEditGaji').modal('show')
                    $('#formEditGaji').attr("data-id", id)
                    $.each(res, function(i, data) {
                        var el = $('#formEditGaji').find('[name="' + i + '"]');
                        el.val(data);
                    })
                }
            })
        }

        function updateGaji() {
            var id = $('#formEditGaji').data('id')
            var _url = "{{ route('gaji.update', ':id') }}"
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'PUT',
                data: $('#formEditGaji').serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.code == 200) {
                        $('#formEditGaji').trigger('reset')
                        $('#modalEditGaji').modal('hide')

                        Notif.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        $("#tbl_gaji").DataTable().destroy();
                        getGaji()
                    }

                    if(res.code == 500){
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
                        title: 'Gagal Menyimpan Data Gaji',
                    });

                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formEditGaji').find('[name="' + i + '"]');
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
            addGaji()
        })

        $('#simpanData').on('click', function(e) {
            e.preventDefault()
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            updateGaji()
        })

        function deleteGaji(id) {
            Swal.fire({
                    title: "Apakah anda yakin hapus data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Tidak",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        var _url = "{{ route('gaji.delete', ':id') }}";
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
                                $("#tbl_gaji").DataTable().destroy();
                                getGaji();

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
    </script>
@endsection
