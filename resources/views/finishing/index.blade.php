@extends('layouts.app')
@section('title', 'Finishing')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Surat Finishing</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Surat Finishing</li>
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
                                <h5 class="card-title">Filter Status Data Surat Finishing</h5>
                            </div>
                            <div class="card-body row g-2" id="filter_data">
                                <div class="col-lg-3">
                                    <button class="btn btn-outline-secondary container-fluid active"
                                        data-status="Belum Menentukan Karyawan">
                                        Belum Menentukan Karyawan
                                    </button>
                                </div>
                                <div class="col-lg-3">
                                    <button class="btn btn-outline-danger container-fluid" data-status="Belum Konfirmasi">
                                        Belum Konfirmasi
                                    </button>
                                </div>
                                <div class="col-lg-3">
                                    <button class="btn btn-outline-warning container-fluid" data-status="Sedang Dikerjakan">
                                        Sedang Dikerjakan
                                    </button>
                                </div>
                                <div class="col-lg-3">
                                    <button class="btn btn-outline-success container-fluid"
                                        data-status="Selesai Dikerjakan">
                                        Selesai Dikerjakan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Data Surat Finishing</h5>
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
                                                <th>Kode Finishing</th>
                                                <th>Tanggal</th>
                                                <th>Detail Kain Jahit</th>
                                                <th>Quantity</th>
                                                <th>Karyawan</th>
                                                <th>Gaji</th>
                                                <th>Status Surat</th>
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

    <div class="modal fade" id="modalAddKaryawan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Karyawan Finishing</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <form enctype="multipart/form-data" autocomplete="off" id="formAddKaryawan" data-id=""
                        class="needs-validation" novalidate>
                        @method('PUT')
                        @csrf
                        <input type="hidden" name="id">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="kode_finishing">Kode Finishing</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Kode Finishing" name="kode_finishing"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="jumlah_finishing">Quantity</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Quantity" name="jumlah_finishing"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="Karyawan1">Karyawan 1</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="karyawan1" class="form-control">
                                            <option value="" disabled selected class="text-center">
                                                Karyawan 1
                                            </option>
                                            @foreach ($karyawan as $dtKaryawan)
                                                <option value="{{ $dtKaryawan->uuid }}">
                                                    {{ $dtKaryawan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="Karyawan2">Karyawan 2</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="karyawan2" class="form-control">
                                            <option value="" disabled selected class="text-center">
                                                Karyawan 2
                                            </option>
                                            @foreach ($karyawan as $dtKaryawan)
                                                <option value="{{ $dtKaryawan->uuid }}">
                                                    {{ $dtKaryawan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="gaji">Gaji</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="gaji" class="form-control">
                                            <option value="" selected disabled class="text-center">Gaji</option>
                                            @foreach ($gaji as $dtGaji)
                                                <option value="{{ $dtGaji->gaji }}">
                                                    {{ $dtGaji->gaji }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="note">Notes</label>
                                <textarea name="note" id="note" cols="30" rows="2" placeholder="Keterangan"
                                    class="form-control"></textarea>
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

    <div class="modal fade" id="modalEditKaryawan" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Karyawan Finishing</h5>
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
                            <div class="col-md-12">
                                <label for="kode_finishing">Kode Finishing</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Kode Finishing" name="kode_finishing"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="jumlah_finishing">Quantity</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Quantity" name="jumlah_finishing"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="Karyawan1">Karyawan 1</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="karyawan1" class="form-control">
                                            <option value="" disabled selected class="text-center">
                                                Karyawan 1
                                            </option>
                                            @foreach ($karyawan as $dtKaryawan)
                                                <option value="{{ $dtKaryawan->uuid }}">
                                                    {{ $dtKaryawan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="Karyawan2">Karyawan 2</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="karyawan2" class="form-control">
                                            <option value="" disabled selected class="text-center">
                                                Karyawan 2
                                            </option>
                                            @foreach ($karyawan as $dtKaryawan)
                                                <option value="{{ $dtKaryawan->uuid }}">
                                                    {{ $dtKaryawan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="gaji">Gaji</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <select name="gaji" class="form-control">
                                            <option value="" selected disabled class="text-center">Gaji</option>
                                            @foreach ($gaji as $dtGaji)
                                                <option value="{{ $dtGaji->gaji }}">
                                                    {{ $dtGaji->gaji }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="note">Notes</label>
                                <textarea name="note" id="note" cols="30" rows="2" placeholder="Keterangan"
                                    class="form-control"></textarea>
                            </div>
                            <div class="modal-footer container-fluid mt-4">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                <button type="button" id="editData" class="btn btn-primary">Simpan Data</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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

        status_finishing = 'Belum Menentukan Karyawan'
        getFinishing(status_finishing);

        $('#filter_data div button').on('click', function(e) {
            e.preventDefault()
            status_finishing = $(this).data('status')
            $('#filter_data').find('div button').removeClass('active');
            $(this).addClass('active');
            getFinishing(status_finishing)
        })

        function getFinishing(status) {
            var htmlview = ''
            var _url
            @if (Auth::user()->role_id == 1)
                _url = "{{ route('finishing.data', ':status') }}",
            @endif
            @if (Auth::user()->role_id == 3)
                _url = "{{ route('w.finishing.data', ':status') }}",
            @endif
            _url = _url.replace(':status', status)

            $.ajax({
                url: _url,
                type: 'GET',
                success: function(res) {
                    let no = 0;
                    $('tbody').html('')
                    $.each(res, function(i, data) {
                        if (data.karyawan == null) {
                            data.karyawan = '-';
                        } else {
                            data.karyawan = data.karyawan.replace(/[\[\]"]/g, '');
                        }
                        htmlview += `<tr>
                        <td style="text-align: center;">` + (no = no + 1) + `</td>
                        <td>` + data.kode_finishing + `</td>
                        <td>` + data.tanggal + `</td>
                        <td>` + data.kode_jahit + ` ( Artikel : ` + data.artikel + ` ) <br>
                            ` + data.kode_lot + ` ( ` + data.jenis_kain + ` - ` + data.warna + ` ) <br>
                            Ukuran Potong : ` + data.ukuran + ` 
                        </td>
                        <td class="text-right"> ` + data.jml_finishing + ` </td>
                        <td> ` + data.karyawan.replace(',', '<br>') + ` </td>
                        <td class="text-right"> ` + data.gaji + `</td>`;
                        if (data.status == 'Belum Menentukan Karyawan') {
                            htmlview +=
                                ` <td>
                                    <button class = "btn btn-secondary btn-sm container-fluid" title = "Tentukan Karyawan!"
                                        onClick="addKaryawanFinishing('` + data.kode_finishing + `')">
                                        Belum Menentukan Karyawan 
                                    </button>
                                    </td>
                                    `;
                        }
                        if (data.status == 'Belum Konfirmasi') {
                            htmlview +=
                                `<td>
                                        <button class="btn btn-danger btn-sm container-fluid" title="Confirm Data!" 
                                        onClick="confirmFinishing('` + data.kode_finishing + `')"> Belum Konfirmasi </button></td>
                                    `;
                        }
                        if (data.status == 'Sedang Dikerjakan') {
                            htmlview +=
                                `<td>
                                    <button class="btn btn-warning btn-sm container-fluid" title="Finish Data!" 
                                    onClick="finishedFinishing('` + data.kode_finishing + `')"> Sedang Dikerjakan </button></td>
                                    `;
                        }
                        if (data.status == 'Selesai Dikerjakan') {
                            htmlview += `<td>
                                        <span class="bg-success p-2 container-fluid">Selesai Dikerjakan</span></td>
                                    `;
                        }
                        if (data.status == 'Belum Menentukan Karyawan') {
                            htmlview +=
                                `<td class="text-right">
                                  <button class="btn btn-danger btn-sm" title="Delete Data!" 
                                  onClick="deleteFinishing('` + data.kode_finishing + `')"> <i class="fas fa-trash"></i>
                                  </button>
                                </td>
                               </tr>`
                        } else {
                            htmlview +=
                                `<td class="text-right">
                                  <button class="btn btn-info btn-sm" title="Edit Karyawan Finishing!" 
                                  onClick="editKaryawanFinishing('` + data.kode_finishing + `')">
                                    <i class="fas fa-pencil-alt"></i>
                                  </button>
                                  <button class="btn btn-danger btn-sm" title="Delete Data!" 
                                  onClick="deleteFinishing('` + data.kode_finishing + `')"> <i class="fas fa-trash"></i>
                                  </button>
                                </td>
                               </tr>`
                        }
                    });
                    $("#tbl_ukuran").DataTable(dtTableOption).destroy()
                    $('tbody').html(htmlview)
                    $("#tbl_ukuran").DataTable(dtTableOption).buttons().container().appendTo(
                        '#tbl_ukuran_wrapper .col-md-6:eq(0)')
                }
            })

        }

        function deleteFinishing(kode_finishing) {
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
                            var _url = "{{ route('finishing.delete', 'kode_finishing') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
                            var _url = "{{ route('w.finishing.delete', 'kode_finishing') }}";
                        @endif
                        _url = _url.replace('kode_finishing', kode_finishing)
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
                                getFinishing(status_finishing)

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

        function confirmFinishing(kode_finishing) {
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
                            var _url = "{{ route('finishing.confirm', 'kode_finishing') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
                            var _url = "{{ route('w.finishing.confirm', 'kode_finishing') }}";
                        @endif
                        _url = _url.replace('kode_finishing', kode_finishing)
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
                                getFinishing(status_finishing)

                                if (res.code == 500) {
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Konfirmasi Data Finishing',
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

        function finishedFinishing(kode_finishing) {
            Swal.fire({
                    title: "Apakah anda yakin konfirmasi selesai data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Konfirmasi!",
                    cancelButtonText: "Tidak",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        @if (Auth::user()->role_id == 1)
                            var _url = "{{ route('finishing.finished', 'kode_finishing') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
                            var _url = "{{ route('w.finishing.finished', 'kode_finishing') }}";
                        @endif
                        _url = _url.replace('kode_finishing', kode_finishing)
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
                                getFinishing(status_finishing)

                                if (res.code == 500) {
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Konfirmasi Selesai Data Finishing',
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

        function addKaryawanFinishing(kode_finishing) {
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('finishing.detailKaryawan', ':kode_finishing') }}"
            @endif
            _url = _url.replace(':kode_finishing', kode_finishing)

            $.ajax({
                url: _url,
                type: 'GET',
                success: function(res) {
                    $('#modalAddKaryawan').modal('show')
                    $('#formAddKaryawan').attr("data-id", res.id)
                    $.each(res, function(i, data) {
                        var el = $('#formAddKaryawan').find('[name="' + i + '"]');
                        el.val(data);
                    })
                }
            })
        }

        function editKaryawanFinishing(kode_finishing) {
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('finishing.detailKaryawan', ':kode_finishing') }}"
            @endif
            _url = _url.replace(':kode_finishing', kode_finishing)

            $.ajax({
                url: _url,
                type: 'GET',
                success: function(res) {
                    $('#modalEditKaryawan').modal('show')
                    $('#formEditKaryawan').attr("data-id", res.id)
                    $.each(res, function(i, data) {
                        var el = $('#formEditKaryawan').find('[name="' + i + '"]');
                        if ($('#formEditKaryawan').find('select[name="' + i + '"]').length > 0) {
                            el = $('#formEditKaryawan').find('select[name="' + i + '"]');
                            el.val(data).trigger('change');
                        } else {
                            el.val(data);
                        }
                    })
                }
            })
        }

        function insertKaryawanFinishing() {
            var id = $('#formAddKaryawan').data('id')
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('finishing.addKaryawan', ':id') }}"
            @endif
            _url = _url.replace(':id', id)

            $.ajax({
                url: _url,
                type: 'PUT',
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

                        getFinishing(status_finishing)
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menambahkan Karyawan Finishing',
                    });
                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formAddKaryawan').find('[name="' + i + '"]');
                        el.addClass('is-invalid');
                        el.after('<div class="invalid-feedback">' + error[0] + '</div>');
                    });
                }
            })
        }

        function updateKaryawanFinishing() {
            var id = $('#formEditKaryawan').data('id')
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('finishing.updateKaryawan', ':id') }}"
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

                        getFinishing(status_finishing)
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Ubah Karyawan Finishing',
                    });
                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formEditKaryawan').find('[name="' + i + '"]');
                        el.addClass('is-invalid');
                        el.after('<div class="invalid-feedback">' + error[0] + '</div>');
                    });
                }
            })
        }

        $('#simpanData').on('click', function(e) {
            e.preventDefault()
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            insertKaryawanFinishing()
        })
        $('#editData').on('click', function(e) {
            e.preventDefault()
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            updateKaryawanFinishing()
        })
    </script>
@endsection
