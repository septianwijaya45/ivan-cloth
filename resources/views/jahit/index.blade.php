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
                                        <input type="text" placeholder="Kode Aset" name="kode_jahit" class="form-control"
                                            readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <label for="jumlah_jahit">Quantity</label>
                                <div class="col-md-14 row">
                                    <div class="col-md-12">
                                        <input type="number" placeholder="quantity" name="jumlah_jahit"
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

        var Notif = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        })

        getJahit()

        function getJahit() {
            var htmlview
            $.ajax({
                @if (Auth::user()->role_id == 1)
                    url: "{{ route('jahit.data') }}",
                @endif
                @if (Auth::user()->role_id == 3)
                    url: "{{ route('w.jahit.data') }}",
                @endif
                type: 'GET',
                success: function(res) {
                    let no = 0;
                    $('tbody').html('')
                    $.each(res, function(i, data) {
                        htmlview += `<tr>
                        <td style="text-align: center;">` + (no = no + 1) + `</td>
                        <td>` + data.kode_jahit + `</td>
                        <td>` + data.tanggal + `</td>
                        <td>` + data.kode_spk + ` ( Artikel : ` + data.artikel + ` ) <br>
                            ` + data.kode_lot + ` ( ` + data.jenis_kain + ` - ` + data.warna + ` ) <br>
                            Ukuran Potong : ` + data.ukuran + ` 
                        </td>
                        <td> ` + data.jml_jahit + ` </td>
                                `;
                        if (data.status == 'Belum Menentukan Karyawan') {
                            htmlview +=
                                ` <td>
                                    <button class = "btn btn-secondary btn-sm" title = "Tentukan Karyawan!"
                                        onClick="addKaryawanJahit('` + data.kode_jahit + `')">
                                        Belum Menentukan Karyawan 
                                    </button>
                                    </td>
                                    `;
                        }
                        if (data.status == 'Belum Konfirmasi') {
                            htmlview +=
                                `<td>
                                        <button class="btn btn-danger btn-sm" title="Confirm Data!" onClick="confirmJahit('` +
                                data
                                .kode_jahit + `')"> Belum Konfirmasi </button></td>
                                    `;
                        }
                        if (data.status == 'Sedang Dikerjakan') {
                            htmlview +=
                                `<td>
                                        <button class="btn btn-warning btn-sm" title="Finish Data!" onClick="finishedJahit('` +
                                data
                                .kode_jahit + `')"> Sedang Dikerjakan </button></td>
                                    `;
                        }
                        if (data.status == 'Selesai Dikerjakan') {
                            htmlview += `<td>
                                        <span class="bg-success p-2">Selesai Dikerjakan</span></td>
                                    `;
                        }
                        htmlview +=
                            `<td>
                                  <button class="btn btn-info btn-sm" title="Data Karyawan Jahit!">
                                    <i class="fas fa-user-alt"></i>
                                  </button>
                                  <button class="btn btn-danger btn-sm" title="Delete Data!" 
                                  onClick="deleteJahit('` + data.kode_jahit + `')"> <i class="fas fa-trash"></i>
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
                        @if (Auth::user()->role_id == 3)
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
                        @if (Auth::user()->role_id == 1)
                            var _url = "{{ route('jahit.confirm', 'kode_jahit') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
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

                                if (res.code == 500) {
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
                        @if (Auth::user()->role_id == 1)
                            var _url = "{{ route('jahit.finished', 'kode_jahit') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
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

                                if (res.code == 500) {
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

        function updateKaryawanJahit() {
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

                        $("#tbl_aset").DataTable().destroy();
                        getJahit()
                    }
                },
                error: function(err) {
                    Notif.fire({
                        icon: 'error',
                        title: 'Gagal Menambahkan Karyawan Jahit',
                    });
                    console.log($('#formAddKaryawan').serialize());
                    $.each(err.responseJSON.errors, function(i, error) {
                        var el = $('#formAddKaryawan').find('[name="' + i + '"]');
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
            updateKaryawanJahit()
        })
    </script>
@endsection
