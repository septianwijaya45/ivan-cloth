@extends('layouts.app')
@section('title', 'Film Sablon')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Master Film Sablon</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Film Sablon</li>
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
                                <h5 class="card-title">Data Film Sablon</h5>
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
                                                <th>Kode SPK</th>
                                                <th>Gambar</th>
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

        getFilmSablon()

        function getFilmSablon() {
            var htmlview
            let no = 1;
            $.ajax({
                @if(Auth::user()->role_id == 1)
                    url: "{{ route('filmSablon.Data') }}",
                @endif
                type: 'GET',
                success: function(res) {
                    $('tbody').html('')
                    $.each(res, function(i, data) {
                        let gambar = "<?= asset('img/gambar'); ?>/";
                        htmlview += `<tr>
                        <td style="text-align: center;">` + no++ + `</td>
                        <td>` + data.kode_spk + `</td>
                        <td><img width="20%" src="`+ gambar+data.nama_foto +`" class="img-responsive" style="width: 100%;"></td>
                       </tr>`
                    });

                    $('tbody').html(htmlview)
                    $("#tbl_kain_roll").DataTable(dtTableOption).buttons().container().appendTo(
                        '#tbl_kain_roll_wrapper .col-md-6:eq(0)')
                }
            })
        }
    </script>
@endsection
