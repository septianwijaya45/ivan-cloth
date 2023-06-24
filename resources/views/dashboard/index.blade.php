@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
@if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->

            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total SPP Selesai</span>
                            <span class="info-box-number">
                                {{ !empty($totSPP) ? $totSPP : 0 }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total SPK Selesai</span>
                            <span class="info-box-number">
                                {{ !empty($totSPK) ? $totSPK : 0 }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Jahit Selesai</span>
                            <span class="info-box-number">
                                {{ !empty($totJahit) ? $totJahit : 0 }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Total Finishing Selesai</span>
                            <span class="info-box-number">
                                {{ !empty($totFinishing) ? $totFinishing: 0 }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-6">

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Latest SPP (Belum Dikonfirmasi)</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body m-3">
                            <div class="table-responsive">
                                <table class="table m-0" id="dataTable2">
                                    <thead>
                                        <tr>
                                            <th>No<th>
                                            <th>Kode SPP</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($spp as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->kode_spk }}</td>
                                                <td>{{ $data->total }}</td>
                                                <td><span class="badge badge-warning">{{ $data->status }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            @if(Auth::user()->role_id == 1)
                            <a href="{{ route('spp') }}" class="btn btn-sm btn-secondary float-right">View All SPP</a>
                            @endif
                            @if(Auth::user()->role_id == 2)
                            <a href="{{ route('a.spp') }}" class="btn btn-sm btn-secondary float-right">View All SPP</a>
                            @endif
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border">
                            <h3 class="card-title">Latest SPK (Belum Dikonfirmasi)</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body m-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable2">
                                    <thead>
                                        <tr>
                                            <th>No<th>
                                            <th>Kode SPK</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($spk as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->kode_spk }}</td>
                                                <td>{{ $data->total }}</td>
                                                <td><span class="badge badge-warning">{{ $data->status }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            @if(Auth::user()->role_id == 1)
                            <a href="{{ route('spk') }}" class="btn btn-sm btn-secondary float-right">View All SPK</a>
                            @endif
                            @if(Auth::user()->role_id == 2)
                            <a href="{{ route('a.spk') }}" class="btn btn-sm btn-secondary float-right">View All SPK</a>
                            @endif
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-md-6">

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border-transparent">
                            <h3 class="card-title">Latest Jahit (Belum Dikonfirmasi)</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body m-3">
                            <div class="table-responsive">
                                <table class="table m-0" id="dataTable3">
                                    <thead>
                                        <tr>
                                            <th>No<th>
                                            <th>Kode Jahit</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($jahit as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->kode_jahit }}</td>
                                                <td>{{ $data->total }}</td>
                                                <td><span class="badge badge-warning">{{ $data->status }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            @if(Auth::user()->role_id == 1)
                            <a href="{{ route('jahit') }}" class="btn btn-sm btn-secondary float-right">View All Jahit</a>
                            @endif
                            @if(Auth::user()->role_id == 2)
                            <a href="{{ route('a.jahit') }}" class="btn btn-sm btn-secondary float-right">View All Jahit</a>
                            @endif
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-md-6">

                    <!-- TABLE: LATEST ORDERS -->
                    <div class="card">
                        <div class="card-header border">
                            <h3 class="card-title">Latest Finishing (Belum Dikonfirmasi)</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-tool" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body m-3">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="dataTable4">
                                    <thead>
                                        <tr>
                                            <th>No<th>
                                            <th>Kode Finishing</th>
                                            <th>Quantity</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        @foreach($finishing as $data)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ $data->kode_finishing }}</td>
                                                <td>{{ $data->total }}</td>
                                                <td><span class="badge badge-warning">{{ $data->status }}</span></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            @if(Auth::user()->role_id == 1)
                            <a href="{{ route('finishing') }}" class="btn btn-sm btn-secondary float-right">View All Finishing</a>
                            @endif
                            @if(Auth::user()->role_id == 2)
                            <a href="{{ route('a.finishing') }}" class="btn btn-sm btn-secondary float-right">View All Finishing</a>
                            @endif
                        </div>
                        <!-- /.card-footer -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!--/. container-fluid -->
    </section>
@else
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Info boxes -->

            <div class="row">
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-cog"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">SPP Terkonfirmasi</span>
                            <span class="info-box-number">
                                {{ !empty($totSPP) ? $totSPP : 0 }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">SPK Terkonfirmasi</span>
                            <span class="info-box-number">
                                {{ !empty($totSPK) ? $totSPK : 0 }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->

                <!-- fix for small devices only -->
                <div class="clearfix hidden-md-up"></div>

                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Jahit Terkonfirmasi</span>
                            <span class="info-box-number">
                                {{ !empty($totJahit) ? $totJahit : 0 }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-12 col-sm-6 col-md-3">
                    <div class="info-box mb-3">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Finishing Terkonfirmasi</span>
                            <span class="info-box-number">
                                {{ !empty($totFinishing) ? $totFinishing: 0 }}
                            </span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div>
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
@endif
<!-- /.content -->
@endsection

@section('script')
<script>
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

    $("#dataTable").DataTable(dtTableOption)
    $("#dataTable2").DataTable(dtTableOption)
    $("#dataTable3").DataTable(dtTableOption)
    $("#dataTable4").DataTable(dtTableOption)
</script>
@endsection
