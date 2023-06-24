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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
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
                                <h5 class="card-title">Filter Status Data Surat Jahit</h5>
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
                                <h5 class="card-title">Data Surat Jahit</h5>
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
                                                <th>Tanggal</th>
                                                <th>Detail Kain Sablon</th>
                                                <th>Quantity</th>
                                                <th>Karyawan</th>
                                                <th>Gaji</th>
                                                <th>Status Surat</th>
                                                @if(Auth::user()->role_id == 1 && Auth::user()->role_id == 2)
                                                <th width="5%">Aksi</th>
                                                @endif
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Karyawan Jahit</h5>
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
                                <label for="kode_jahit">Kode Jahit</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Kode Jahit" name="kode_jahit"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="jumlah_jahit">Quantity</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Quantity" name="jumlah_jahit"
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Karyawan Jahit</h5>
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
                                <label for="kode_jahit">Kode Jahit</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Kode Jahit" name="kode_jahit"
                                            class="form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="jumlah_jahit">Quantity</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Quantity" name="jumlah_jahit"
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

        status_jahit = 'Belum Menentukan Karyawan'
        getJahit(status_jahit);

        $('#filter_data div button').on('click', function(e) {
            e.preventDefault()
            status_jahit = $(this).data('status')
            $('#filter_data').find('div button').removeClass('active');
            $(this).addClass('active');
            getJahit(status_jahit)
        })

        function getJahit(status) {
            var htmlview = ''
            var _url
            @if (Auth::user()->role_id == 1)
                _url = "{{ route('jahit.data', ':status') }}",
            @endif
            @if (Auth::user()->role_id == 3)
                _url = "{{ route('w.jahit.data', ':status') }}",
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
                        <td>` + data.kode_jahit + `</td>
                        <td>` + data.tanggal + `</td>
                        <td>` + data.kode_spk + ` ( Artikel : ` + data.artikel + ` ) <br>
                            ` + data.kode_lot + ` ( ` + data.jenis_kain + ` - ` + data.warna + ` ) <br>
                            Ukuran Potong : ` + data.ukuran + ` 
                        </td>
                        <td class="text-right"> ` + data.jml_jahit + ` </td>
                        <td> ` + data.karyawan.replace(',', '<br>') + ` </td>
                        <td class="text-right"> ` + data.gaji + `</td>`;
                        if (data.status == 'Belum Menentukan Karyawan') {
                            @if(Auth::user()->role_id == 3)
                                htmlview += `<td>
                                    <span class="bg-secondary p-2">Belum Menentukan Karyawan</span></td>
                                `;
                            @else
                                htmlview +=
                                    ` <td>
                                        <button class = "btn btn-secondary btn-sm container-fluid" title = "Tentukan Karyawan!"
                                            onClick="addKaryawanJahit('` + data.kode_jahit + `')">
                                            Belum Menentukan Karyawan 
                                        </button>
                                        </td>
                                        `;
                            @endif
                        }
                        if (data.status == 'Belum Konfirmasi') {
                            @if(Auth::user()->role_id == 3)
                                htmlview += `<td>
                                    <span class="bg-danger p-2">Belum Konfirmasi</span></td>
                                `;
                            @else
                                htmlview +=
                                    `<td>
                                            <button class="btn btn-danger btn-sm container-fluid" title="Confirm Data!" 
                                            onClick="confirmJahit('` + data.kode_jahit + `')"> Belum Konfirmasi </button></td>
                                        `;
                            @endif
                        }
                        if (data.status == 'Sedang Dikerjakan') {
                            @if(Auth::user()->role_id == 3)
                                htmlview += `<td>
                                    <span class="bg-warning p-2">Sedang Dikerjakan</span></td>
                                `;
                            @else
                                htmlview +=
                                    `<td>
                                        <button class="btn btn-warning btn-sm container-fluid" title="Finish Data!" 
                                        onClick="finishedJahit('` + data.kode_jahit + `')"> Sedang Dikerjakan </button></td>
                                        `;
                            @endif
                        }
                        if (data.status == 'Selesai Dikerjakan') {
                            htmlview += `<td>
                                        <span class="bg-success p-2 container-fluid">Selesai Dikerjakan</span></td>
                                    `;
                        }
                        if (data.status == 'Belum Menentukan Karyawan') {
                            @if(Auth::user()->role_id == 1)
                                htmlview +=
                                    `<td class="text-right">
                                    <button class="btn btn-danger btn-sm" title="Delete Data!" 
                                    onClick="deleteJahit('` + data.kode_jahit + `')"> <i class="fas fa-trash"></i>
                                    </button>
                                    </td>
                                </tr>`
                            @endif
                        } else {
                            @if(Auth::user()->role_id == 1)
                                htmlview +=
                                    `<td class="text-right">
                                    <button class="btn btn-info btn-sm" title="Edit Karyawan Jahit!" 
                                    onClick="editKaryawanJahit('` + data.kode_jahit + `')">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                    <button class="btn btn-danger btn-sm" title="Delete Data!" 
                                    onClick="deleteJahit('` + data.kode_jahit + `')"> <i class="fas fa-trash"></i>
                                    </button>
                                    </td>
                                </tr>`
                            @endif
                        }
                    });
                    $("#tbl_ukuran").DataTable(dtTableOption).destroy()
                    $('tbody').html(htmlview)
                    $("#tbl_ukuran").DataTable(dtTableOption).buttons().container().appendTo(
                        '#tbl_ukuran_wrapper .col-md-6:eq(0)')
                }
            })

        }

        function deleteJahit(kode_jahit) {
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
                            var _url = "{{ route('jahit.delete', 'kode_jahit') }}";
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
                                getJahit(status_jahit)

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

        function confirmJahit(kode_jahit) {
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
                            var _url = "{{ route('jahit.confirm', 'kode_jahit') }}";
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
                                getJahit(status_jahit)

                                if (res.code == 500) {
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Konfirmasi Data Jahit',
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

        function finishedJahit(kode_jahit) {
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
                            var _url = "{{ route('jahit.finished', 'kode_jahit') }}";
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
                                getJahit(status_jahit)

                                if (res.code == 500) {
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Konfirmasi Selesai Data Jahit',
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

        function addKaryawanJahit(kode_jahit) {
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('jahit.detailKaryawan', ':kode_jahit') }}"
            @endif
            _url = _url.replace(':kode_jahit', kode_jahit)

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

        function editKaryawanJahit(kode_jahit) {
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('jahit.detailKaryawan', ':kode_jahit') }}"
            @endif
            _url = _url.replace(':kode_jahit', kode_jahit)

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

        function insertKaryawanJahit() {
            var id = $('#formAddKaryawan').data('id')
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('jahit.addKaryawan', ':id') }}"
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

                        getJahit(status_jahit)
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menambahkan Karyawan Jahit',
                    });
                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formAddKaryawan').find('[name="' + i + '"]');
                        el.addClass('is-invalid');
                        el.after('<div class="invalid-feedback">' + error[0] + '</div>');
                    });
                }
            })
        }

        function updateKaryawanJahit() {
            var id = $('#formEditKaryawan').data('id')
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('jahit.updateKaryawan', ':id') }}"
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

                        getJahit(status_jahit)
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Ubah Karyawan Jahit',
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
            insertKaryawanJahit()
        })
        $('#editData').on('click', function(e) {
            e.preventDefault()
            $('.is-invalid').removeClass('is-invalid');
            $('.invalid-feedback').remove();
            updateKaryawanJahit()
        })
    </script>
@endsection
