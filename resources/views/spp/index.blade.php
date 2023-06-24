@extends('layouts.app')
@section('title', 'Surat Perintah Potong')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Surat Perintah Potong</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Surat Perintah Potong</li>
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
                                <h5 class="card-title">Data Surat Perintah Potong</h5>

                                <div class="card-tools">
                                    @if (Auth::user()->role_id == 1)
                                        <a href="{{ route('spp.insert') }}" class="btn btn-success btn-sm">Tambah Data</a>
                                    @endif
                                    @if (Auth::user()->role_id == 3)
                                        <a href="{{ route('w.spp.insert') }}" class="btn btn-success btn-sm">Tambah Data</a>
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
                                                <th>Kode SPP</th>
                                                <th>Total Perintah Potongan</th>
                                                <th>Tanggal</th>
                                                <th width="10%">Status</th>
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Detail SPP (Potong)</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body bg-light">
                    <div class="row">
                        <div class="col-lg-12">
                            <h3 id="kode_spp_detail">Kode SPP : </h3>
                        </div>
                        <div class="col-lg-12">
                            <table id="tbl_detail" class="table table-bordered table-striped dataTable"
                                aria-describedby="tbl_detail" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Ukuran Potong</th>
                                        <th>Kode Lot</th>
                                        <th>Warna</th>
                                        <th>Quantity</th>
                                        <th>Hasil</th>
                                        <th>Karyawan</th>
                                        <th>Gaji</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="note">Notes</label>
                            <textarea name="note" id="note_detail" cols="30" rows="2" placeholder="Keterangan" class="form-control"
                                readonly></textarea>
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
            timer: 2000,
            timerProgressBar: true,
        })

        getSPP()

        function getSPP() {
            var htmlview
            $.ajax({
                @if (Auth::user()->role_id == 1)
                    url: "{{ route('spp.data') }}",
                @endif
                @if (Auth::user()->role_id == 3)
                    url: "{{ route('w.spp.data') }}",
                @endif
                type: 'GET',
                success: function(res) {
                    let no = 0;
                    $('#tbl_ukuran tbody').html('')
                    $.each(res, function(i, data) {
                        htmlview += `<tr>
                        <td style="text-align: center;">` + (no = no + 1) + `</td>
                        <td>` + data.kode_spp + `</td>
                        <td>` + data.total + `</td>
                        <td>` + data.tanggal + `</td>`;
                        if (data.status == 'Belum Konfirmasi') {
                            @if(Auth::user()->role_id == 3)
                                htmlview += `<td>
                                    <span class="bg-danger p-2">Belum Dikonfirmasi</span></td>
                                `;
                            @else
                                htmlview += `<td>
                                    <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="confirmSPP('` +
                                    data
                                    .kode_spp + `')"> Belum Konfirmasi </button></td>
                                `;
                            @endif
                        }
                        if (data.status == 'Sedang Dikerjakan') {
                            @if(Auth::user()->role_id == 3)
                                htmlview += `<td>
                                    <span class="bg-warning p-2">Sedang Dikerjakan</span></td>
                                `;
                            @else
                                htmlview += `<td>
                                    <button class="btn btn-warning btn-sm" title="Delete Data!" onClick="finishedSPP('` +
                                    data
                                    .kode_spp + `')"> Sedang Dikerjakan </button></td>
                                `;
                            @endif
                        }
                        if (data.status == 'Selesai Dikerjakan') {
                            htmlview += `<td>
                                <span class="bg-success p-2">Selesai Dikerjakan</span></td>
                            `;
                        }
                        @if(Auth::user()->role_id == 1)
                        htmlview += `<td>
                          <button class="btn btn-secondary btn-sm" title="Detail Data!" 
                          onClick="detailSPP('` + data.kode_spp + `')"> <i class="fas fa-eye"></i>
                          </button>
                          <a class="btn btn-info btn-sm" title="Edit Data!" href="surat-perintah-potong/edit-data/` +
                            data.uuid +
                            `"> <i class="fas fa-pencil-alt"></i>
                          </a>
                          <a class="btn btn-warning btn-sm" title="Print Data!" href="surat-perintah-potong/print-data/` +
                            data.uuid + `"> <i class="fas fa-print"></i>
                          </a>
                          <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="deleteSPP('` + data
                            .kode_spp + `')"> <i class="fas fa-trash"></i>
                          </button>
                        </td>
                       </tr>`
                       @endif
                        @if(Auth::user()->role_id == 3)
                        htmlview += `<td>
                          <a class="btn btn-warning btn-sm" title="Print Data!" href="surat-perintah-potong/print-data/` +
                            data.uuid + `"> <i class="fas fa-print"></i>
                          </a>
                        </td>
                       </tr>`
                       @endif
                    });

                    $('#tbl_ukuran tbody').html(htmlview)
                    $("#tbl_ukuran").DataTable(dtTableOption).buttons().container().appendTo(
                        '#tbl_ukuran_wrapper .col-md-6:eq(0)')
                }
            })
        }

        function detailSPP(kode_spp) {
            var htmlview
            @if (Auth::user()->role_id == 1)
                var _url = "{{ route('spp.detail', ':kode_spp') }}"
            @endif
            @if (Auth::user()->role_id == 3)
                var _url = "{{ route('w.spp.detail', ':kode_spp') }}"
            @endif
            _url = _url.replace(':kode_spp', kode_spp)
            $.ajax({
                url: _url,
                type: 'GET',
                success: function(res) {
                    $('#modalDetail').modal('show');
                    console.log(res);
                    $('#tbl_detail tbody').html('')
                    $.each(res, function(i, data) {
                        data.karyawan = data.karyawan.replace(/[\[\]"]/g, '');
                        htmlview += `<tr>
                        <td>` + data.tanggal + `</td>
                        <td>` + data.ukuran + `</td>
                        <td>` + data.nama_lot + `</td>
                        <td>` + data.warna + `</td>
                        <td class="text-right">` + data.quantity + `</td>
                        <td class="text-right">` + data.hasil + `</td>
                        <td>` + data.karyawan.replace(',', '<br>') + `</td>
                        <td>` + data.gaji + `</td>
                        </tr>`;

                        $('#kode_spp_detail').html(`Kode SPP : ` + data.kode_spp)
                        $('#note_detail').val(data.note)
                    });

                    $('#tbl_detail tbody').html(htmlview)
                }
            })
        }

        function deleteSPP(kode_spp) {
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
                            var _url = "{{ route('spp.delete', ':kode_spp') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
                            var _url = "{{ route('w.spp.delete', ':kode_spp') }}";
                        @endif
                        _url = _url.replace(':kode_spp', kode_spp)
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
                                getSPP();

                                if (res.code == 500) {
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Menghapus Data SPP!',
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

        function confirmSPP(kode_spp) {
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
                            var _url = "{{ route('spp.confirm', ':kode_spp') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
                            var _url = "{{ route('w.spp.confirm', ':kode_spp') }}";
                        @endif
                        _url = _url.replace(':kode_spp', kode_spp)
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
                                getSPP();

                                if (res.code == 500) {
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Konfirmasi Data SPP',
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

        function finishedSPP(kode_spp) {
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
                            var _url = "{{ route('spp.finished', ':kode_spp') }}";
                        @endif
                        @if (Auth::user()->role_id == 3)
                            var _url = "{{ route('w.spp.finished', ':kode_spp') }}";
                        @endif
                        _url = _url.replace(':kode_spp', kode_spp)
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
                                getSPP();

                                if (res.code == 500) {
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Konfirmasi Selesai Data SPP',
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
