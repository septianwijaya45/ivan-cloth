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
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
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
                                    <a href="{{ route('spk.insert') }}" class="btn btn-success btn-sm">Tambah Data</a>
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
                                                <th>Total Perintah Potongan</th>
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
                url: "{{ route('spk.data') }}",
                type: 'GET',
                success: function(res) {
                    let no = 0;
                    $('tbody').html('')
                    $.each(res, function(i, data) {
                        htmlview += `<tr>
                        <td style="text-align: center;">` + (no = no+1) + `</td>
                        <td>` + data.kode_spk + `</td>
                        <td>` + data.total + `</td>
                        <td>` + data.tanggal + `</td>
                        `;
                        if(data.status == 'Belum Konfirmasi'){
                            htmlview += `<td>
                                <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="confirmSPP('` + data
                                .kode_spk + `')"> Belum Konfirmasi </button></td>
                            `;
                        }
                        if(data.status == 'Sedang Dikerjakan'){
                            htmlview += `<td>
                                <button class="btn btn-warning btn-sm" title="Delete Data!" onClick="finishedSPP('` + data
                                .kode_spk + `')"> Sedang Dikerjakan </button></td>
                            `;
                        }
                        if(data.status == 'Selesai Dikerjakan'){
                            htmlview += `<td>
                                <span class="bg-success p-2">Selesai Dikerjakan</span></td>
                            `;
                        }
                        htmlview +=`<td>
                          <a class="btn btn-info btn-sm" title="Edit Data!" href="surat-perintah-potong/edit-data/`+data.uuid+`"> <i class="fas fa-pencil-alt"></i>
                          </a>
                          <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="deleteSPP('` + data
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
                        var _url = "{{ route('spp.delete', 'kode_spp') }}";
                        _url = _url.replace('kode_spp', kode_spp)
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