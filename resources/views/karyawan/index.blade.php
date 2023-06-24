@extends('layouts.app')
@section('title', 'Karyawan')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Master Karyawan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Karyawan</li>
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
                                <h5 class="card-title">Data Karyawan</h5>

                                <div class="card-tools">
                                    <button class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#modalAddKaryawan">
                                        <i class="fas fa-plus"></i> Tambah Data
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div id="tbl_karyawan_wrapper"
                                    class="dataTables_wrapper dt-bootstrap4 table-responsive text-nowrap">
                                    <table id="tbl_karyawan" class="table table-bordered table-striped dataTable"
                                        aria-describedby="tbl_karyawan" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th width="5%" style="text-align: center;">ID</th>
                                                <th>Nama</th>
                                                <th>JK</th>
                                                <th>NIK</th>
                                                <th>No. Telepon</th>
                                                <th>NPWP</th>
                                                <th>Posisi</th>
                                                <th>Status</th>
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
    <div class="modal fade" id="modalAddKaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Tambah Data Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formAddKaryawan" class="needs-validation"
                        novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <label for="nama">Nama</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nama Karyawan" name="nama"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="L" selected>Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="no_telepon">No Telepon</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nomor Telepon" name="no_telepon"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="nik">NIK</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nomor Induk Karyawan" name="nik"
                                            class="form-control" minlength="16" maxlength="16">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="npwp">NPWP</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="NPWP Karyawan" name="npwp"
                                            class="form-control" minlength="16" maxlength="16">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="posisi">Posisi</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="posisi" class="form-control">
                                            <option value="Direktur" selected>Direktur</option>
                                            <option value="Wakil Direktur">Wakil Direktur</option>
                                            <option value="HRD">HRD</option>
                                            <option value="Manager">Manager</option>
                                            <option value="Supervisor">Supervisor</option>
                                            <option value="Staff Pekerja">Staff Pekerja</option>
                                            <option value="Staff Gudang">Staff Gudang</option>
                                            <option value="Pemotong">Staff Pemotong</option>
                                            <option value="Penjahit">Staff Penjahit</option>
                                            <option value="Sablon">Staff Sablon</option>
                                            <option value="Finishing">Staff Finishing</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="gaji_pokok">Gaji Pokok</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Gaji Pokok Karyawan" name="gaji_pokok"
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

    <div class="modal fade" id="modalEditKaryawan" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Data Karyawan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formEditKaryawan" data-id=""
                        class="needs-validation" novalidate>
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-8">
                                <label for="nama">Nama</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nama Karyawan" name="nama"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="jenis_kelamin" class="form-control">
                                            <option value="L">Laki-laki</option>
                                            <option value="P">Perempuan</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="no_telepon">No Telepon</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nomor Telepon" name="no_telepon"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="nik">NIK</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nomor Induk Karyawan" name="nik"
                                            class="form-control" minlength="16" maxlength="16">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="npwp">NPWP</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="NPWP Karyawan" name="npwp"
                                            class="form-control" minlength="16" maxlength="16">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="posisi">Posisi/Jabatan</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="posisi" class="form-control">
                                            <option value="Direktur" selected>Direktur</option>
                                            <option value="Wakil Direktur">Wakil Direktur</option>
                                            <option value="HRD">HRD</option>
                                            <option value="Manager">Manager</option>
                                            <option value="Supervisor">Supervisor</option>
                                            <option value="Staff Pekerja">Staff Pekerja</option>
                                            <option value="Staff Gudang">Staff Gudang</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 mt-3">
                                <label for="gaji_pokok">Gaji Pokok</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Gaji Pokok Karyawan" name="gaji_pokok"
                                            class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label for="status_karyawan">Status Karyawan</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="status_karyawan" class="form-control">
                                            <option value="Aktif">Aktif</option>
                                            <option value="Tidak Aktif">Tidak Aktif</option>
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

        getKaryawan()

        function getKaryawan() {
            var htmlview
            $.ajax({
                @if(Auth::user()->role_id == 1)
                url: "{{ route('karyawan.data') }}",
                @else
                url: "{{ route('a.karyawan.data') }}",
                @endif
                type: 'GET',
                success: function(res) {
                    $('tbody').html('')
                    $.each(res, function(i, data) {

                        var status = data.status_karyawan
                        if (status == 'Aktif') {
                            status =
                                '<span class="btn btn-success btn-sm container-fluid"> Aktif </span>'
                        } else {
                            status =
                                '<span class="btn btn-danger btn-sm container-fluid"> Tidak Aktif </span>'
                        }

                        htmlview += `<tr>
                        <td style="text-align: center;">` + data.id + `</td>
                        <td>` + data.nama + `</td>
                        <td>` + data.jenis_kelamin + `</td>
                        <td>` + data.nik + `</td>
                        <td>` + data.no_telepon + `</td>
                        <td>` + data.npwp + `</td>
                        <td>` + data.posisi + `</td>
                        <td>` + status + `</td>
                        <td style='text-align:right;'>Rp. ` + data.gaji_pokok.toString().replace(
                                /(\d)(?=(\d{3})+(?!\d))/g, "$1.") + `</td>
                        <td>
                          <button class="btn btn-info btn-sm" title="Edit Data!" onClick="detailKaryawan('` + data
                            .uuid + `')"> <i class="fas fa-pencil-alt"></i>
                          </button>
                          <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="deleteKaryawan('` + data
                            .uuid + `')"> <i class="fas fa-trash"></i>
                          </button>
                        </td>
                       </tr>`
                    });

                    $('tbody').html(htmlview)
                    $("#tbl_karyawan").DataTable(dtTableOption).buttons().container().appendTo(
                        '#tbl_karyawan_wrapper .col-md-6:eq(0)')
                }
            })
        }

        function addKaryawan() {
            $.ajax({
                @if(Auth::user()->role_id == 1)
                url: "{{ route('karyawan.add') }}",
                @else
                url: "{{ route('a.karyawan.add') }}",
                @endif
                type: "POST",
                data: $('#formAddKaryawan').serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.code == 200) {
                        $('#formAddKaryawan').trigger('reset')
                        $('#modalAddKaryawan').modal('hide')

                        Notif.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        $("#tbl_karyawan").DataTable().destroy();
                        getKaryawan()
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan Data Karyawan',
                    });
                    console.log(err);
                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formAddKaryawan').find('[name="' + i + '"]');
                        el.addClass('is-invalid');
                        el.after('<div class="invalid-feedback">' + error[0] + '</div>');
                    });
                }
            })
        }

        function detailKaryawan(id) {
            @if(Auth::user()->role_id == 1)
            var _url = "{{ route('karyawan.detail', ':id') }}"
            @else
            var _url = "{{ route('a.karyawan.detail', ':id') }}"
            @endif
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'GET',
                success: function(res) {
                    $('#modalEditKaryawan').modal('show')
                    $('#formEditKaryawan').attr("data-id", id)
                    $.each(res, function(i, data) {
                        var el = $('#formEditKaryawan').find('[name="' + i + '"]');
                        el.val(data);
                    })
                }
            })
        }

        function updateKaryawan() {
            var id = $('#formEditKaryawan').data('id')
            
            @if(Auth::user()->role_id == 1)
            var _url = "{{ route('karyawan.update', ':id') }}"
            @else
            var _url = "{{ route('a.karyawan.update', ':id') }}"
            @endif
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'PUT',
                data: $('#formEditKaryawan').serialize(),
                dataType: 'json',
                success: function(res) {
                    if (res.code == 200) {
                        $('#formEditKaryawan').trigger('reset')
                        $('#modalEditKaryawan').modal('hide')

                        Notif.fire({
                            icon: 'success',
                            title: res.message,
                        })
                        $("#tbl_karyawan").DataTable().destroy();
                        getKaryawan()
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menyimpan Data Karyawan',
                    });

                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formEditKaryawan').find('[name="' + i + '"]');
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
            addKaryawan()
        })

        $('#simpanData').on('click', function(e) {
            e.preventDefault()
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            updateKaryawan()
        })

        function deleteKaryawan(id) {
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
                        var _url = "{{ route('karyawan.delete', ':id') }}";
                        @else
                        var _url = "{{ route('a.karyawan.delete', ':id') }}";
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
                                $("#tbl_karyawan").DataTable().destroy();
                                getKaryawan();
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
