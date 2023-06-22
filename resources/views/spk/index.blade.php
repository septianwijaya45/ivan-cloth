@extends('layouts.app')
@section('title', 'Surat Perintah Kerja')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Surat Perintah Kerja</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Surat Perintah Kerja</li>
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
                                <h5 class="card-title">Data Surat Perintah Kerja</h5>

                                <div class="card-tools">
                                    @if (Auth::user()->role_id == 1)
                                        <a href="{{ route('spk.insert') }}" class="btn btn-success btn-sm">Tambah Data</a>
                                    @endif
                                    @if (Auth::user()->role_id == 3)
                                        <a href="{{ route('w.spk.insert') }}" class="btn btn-success btn-sm">Tambah Data</a>
                                    @endif
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
                                                <th>Kode SPK</th>
                                                <th>Total Perintah Sablon</th>
                                                <th>Tanggal</th>
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

    <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Detail SPK (Sablon)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 id="kode_spk_detail">Kode SPK : </h4>
                        </div>
                        <div class="col-lg-12">
                            <table id="tbl_detail" class="table table-bordered table-striped dataTable"
                                aria-describedby="tbl_detail" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Ukuran</th>
                                        <th class="text-center">Jenis Kain | Warna</th>
                                        <th>Quantity</th>
                                        <th>Karyawan</th>
                                        <th>Gaji</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-lg-6 mt-2">
                            <label for="note">Notes</label>
                            <textarea name="note" id="note_detail" cols="30" rows="5" placeholder="Notes" class="form-control"
                                readonly></textarea>
                        </div>

                        <div class="col-lg-6 mt-2" id="gambar_spk">

                        </div>
                    </div>
                </div>
                <div class="modal-footer container-fluid mt-4">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                </div>
            </div>
        </div>
    </div>
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
            timer: 5000,
            timerProgressBar: true,
        })

        getSPK()

        function getSPK() {
            var htmlview
            $.ajax({
                @if (Auth::user()->role_id == 1)
                    url: "{{ route('spk.data') }}",
                @endif
                @if (Auth::user()->role_id == 3)
                    url: "{{ route('w.spk.data') }}",
                @endif
                type: 'GET',
                success: function(res) {
                    let no = 0;
                    $('tbody').html('')
                    $.each(res, function(i, data) {
                        htmlview += `<tr>
                        <td style="text-align: center;">` + (no = no + 1) + `</td>
                        <td>` + data.kode_spk + `</td>
                        <td>` + data.total + `</td>
                        <td>` + data.tanggal + `</td>
                        `;
                        if (data.status == 'Belum Konfirmasi') {
                            htmlview += `<td>
                                <button class="btn btn-danger btn-sm" title="Confirm Data!" onClick="confirmSPK('` +
                                data
                                .kode_spk + `')"> Belum Konfirmasi </button></td>
                            `;
                        }
                        if (data.status == 'Sedang Dikerjakan') {
                            htmlview += `<td>
                                <button class="btn btn-warning btn-sm" title="Finish Data!" onClick="finishedSPK('` +
                                data
                                .kode_spk + `')"> Sedang Dikerjakan </button></td>
                            `;
                        }
                        if (data.status == 'Selesai Dikerjakan') {
                            htmlview += `<td>
                                <span class="bg-success p-2">Selesai Dikerjakan</span></td>
                            `;
                        }
                        htmlview += `
                        <td>
                          <button class="btn btn-secondary btn-sm" title="Detail Data!" 
                          onClick="detailSPK('` + data.uuid + `')"> <i class="fas fa-eye"></i>
                          </button>
                          <a class="btn btn-info btn-sm" title="Edit Data!" href="surat-perintah-kerja/edit-data/` +
                            data.uuid +
                            `"> <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a class="btn btn-warning btn-sm" title="Print Data!" href="surat-perintah-kerja/print-data/` +
                            data.uuid + `"> <i class="fas fa-print"></i>
                          </a>
                          <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="deleteSPK('` + data
                            .kode_spk + `')"> <i class="fas fa-trash"></i>
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

        function detailSPK(uuid) {
            var htmlview
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('spk.detail', 'uuid') }}"
            @endif
            @if (Auth::user()->role_id == 3)
                var _url = "{{ route('w.spk.detail', 'uuid') }}"
            @endif
            _url = _url.replace('uuid', uuid)
            $.ajax({
                url: _url,
                type: 'GET',
                success: function(res) {
                    $('#modalDetail').modal('show');
                    $('#tbl_detail tbody').html('')
                    $('#kode_spk_detail').html('')
                    $('#note_detail').val('')
                    $('#gambar_spk').html('')

                    $.each(res.spkDetail, function(i, data) {
                        data.karyawan = data.karyawan.replace(/[\[\]"]/g, '');
                        htmlview += `<tr>
                    <td>` + data.tanggal + `</td>
                    <td>` + data.ukuran + `</td>
                    <td class="text-center">` + data.nama_kain_roll + `</td>
                    <td class="text-right">` + data.quantity + ` ` + data.satuan + `</td>
                    <td>` + data.karyawan.replace(',', '<br>') + `</td>
                    <td class="text-right">` + data.gaji + `</td>
                    </tr>`;
                    });

                    $('#kode_spk_detail').html(`Kode SPK : ` + res.spk.kode_spk + `<br>( Ukuran : ` + res.spk
                        .ukuran +
                        ` | Artikel : ` + res.spk.artikel + ` )`)
                    $('#note_detail').val(res.spk.note)
                    if (res.gambarSpk != '') {
                        $('#gambar_spk').html(
                            `<div class="col-lg-12">
                                <label>Gambar Film Sablon</label>
                                <img src="{{ url('/img/gambar') }}/` + res.gambarSpk[0].nama_foto + `"width="100%" class="text-center img-thumbnail">
                            </div>`
                        )
                    }

                    $('#tbl_detail tbody').html(htmlview)
                }
            })
        }

        function deleteSPK(kode_spk) {
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
                            var _url = "{{ route('spk.delete', 'kode_spk') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
                            var _url = "{{ route('w.spk.delete', 'kode_spk') }}";
                        @endif
                        _url = _url.replace('kode_spk', kode_spk)
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

        function confirmSPK(kode_spk) {
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
                            var _url = "{{ route('spk.confirm', 'kode_spk') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
                            var _url = "{{ route('w.spk.confirm', 'kode_spk') }}";
                        @endif
                        _url = _url.replace('kode_spk', kode_spk)
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

        function finishedSPK(kode_spk) {
            Swal.fire({
                    title: "Apakah anda yakin konfirmasi selesai data ini? <br> Surat Jahit akan dibuat otomatis!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Konfirmasi!",
                    cancelButtonText: "Tidak",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        @if (Auth::user()->role_id == 1)
                            var _url = "{{ route('spk.finished', 'kode_spk') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
                            var _url = "{{ route('w.spk.finished', 'kode_spk') }}";
                        @endif
                        _url = _url.replace('kode_spk', kode_spk)
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
    </script>
@endsection
