@extends('layouts.app')
@section('title', 'Pemasukkan')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Pemasukkan</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item">Pemasukkan</li>
                            <li class="breadcrumb-item active">Tambah Pemasukkan</li>
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
                                <h5 class="card-title">Form Tambah Pemasukkan</h5>
                                <div class="card-tools">
                                    @if(Auth::user()->role_id == 1)
                                    <a href="{{ route('pemasukkan') }}" class="btn btn-warning btn-sm">Kembali</a>
                                    @endif
                                    @if(Auth::user()->role_id == 3)
                                    <a href="{{ route('w.spk') }}" class="btn btn-warning btn-sm">Kembali</a>
                                    @endif
                                </div>
                            </div>
                            <form action="#" method="POST" enctype="multipart/form-data" id="formSPP">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="kode_pemasukkan">Kode Pemasukkan</label>
                                            <div class="col-md-14 row">
                                                <div class="col-md-12">        
                                                    <input type="text" name="id" id="id-data" value="" class="form-control" hidden readonly>
                                                    <input type="text" name="kode_pemasukkan" id="kode_pemasukkan" class="form-control" value="{{$pemasukkan->kode_pemasukan}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="jenis_penjualan">Jenis Penjualan</label>
                                            <div class="col-md-14 row">
                                                <div class="col-md-12">
                                                    <input type="text" name="jenis_penjualan" id="jenis_penjualan" class="form-control" value="" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label for="tanggal">Tanggal</label>
                                            <div class="col-md-12">
                                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{$pemasukkan->tanggal}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="tanggal">Pemasukkan</label>
                                            <div class="col-md-12">
                                                <textarea name="pemasukkan" id="pemasukkan" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="keterangan">Keterangan</label>
                                            <div class="col-md-12">
                                                <textarea name="keterangan" id="keterangan" cols="30" rows="5" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="total_uang">Pemasukkan</label>
                                                <div class="input-group">
                                                    <div class="input-group-append">
                                                        <div class="btn btn-sm input-group-text">Rp</div>
                                                    </div>
                                                    <input type="text" name="total_uang" class="form-control" id="total_uang" placeholder="Total Pemasukkan" >
                                                </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" id="btn-tambah" class="btn btn-success float-right">Tambahkan</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Data Insert Pemasukkan</h5>
                            </div>
                            
                            <div class="card-body">
                                <form action="" method="POST" id="form-data-insert">
                                    <div id="tbl_ukuran_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 table-responsive text-nowrap">
                                        <div class="col-lg-12">
                                            <table id="tabel_insert" class="table table-bordered table-striped dataTable"
                                                aria-describedby="tbl_ukuran" style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th>Kode Pemasukkan</th>
                                                        <th>Jenis Pemasukkan</th>
                                                        <th>Tanggal</th>
                                                        <th>Pemasukkan</th>
                                                        <th>Keterangan</th>
                                                        <th>Total Uang</th>
                                                        <th width="10%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2 offset-md-9">
                                        <button type="button" id="btn-save-data" type="button" class="btn btn-success btn-block"> 
                                            <i class="fa fa-save" aria-hidden="true"> </i> Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
    $(document).ready(function(){
        var Notif = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
        })

        var dtTableOption = {
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
            "responsive": true,
            "stateSave": true
        };

        var data = @json($pemasukkans);
        dataInsert(data);

        // Simpan
        $('#btn-tambah').on('click', function(){
            let kode_pemasukan = $('#kode_pemasukkan').val()
            let jenis_penjualan = $('#jenis_penjualan').val()
            let tanggal = $('#tanggal').val()
            let pemasukkan = $('#pemasukkan').val()
            let keterangan = $('#keterangan').val()
            let total_uang = $('#total_uang').val()

                try {
                    if(kode_pemasukan !== null && kode_pemasukan !== '' && jenis_penjualan !== null && jenis_penjualan !== '' && tanggal !== null && tanggal !== '' && pemasukkan !== null && pemasukkan !== '' && keterangan !== null && keterangan !== '' && total_uang !== null && total_uang !== ''){
                        data.push({
                            uuid            : uuid(),
                            kode_pemasukan  : kode_pemasukan,
                            jenis_penjualan : jenis_penjualan,
                            tanggal         : tanggal,
                            pemasukkan      : pemasukkan,
                            keterangan      : keterangan,
                            total_uang      : total_uang
                        })
                        console.log(data)
    
                        dataInsert(data);
                        clearForm()
    
                        Swal.fire(
                            'Berhasil!',
                            'Berhasil Menambahkan Data!',
                            'success'
                        )
                    }else{
                        Swal.fire(
                            'GAGAL!',
                            'Form Ada Yang Kosong!',
                            'error'
                        )
                    }
                } catch (error) {
                    Swal.fire(
                        'Gagal!',
                        'Error: '+error,
                        'success'
                    )
                }
        });

        function dataInsert(datas) {
            extensionList = $('#tabel_insert').DataTable({
                data: datas,
                columns: [
                    {
                        data: 'kode_pemasukan',
                        name: 'kode_pemasukan'
                    },
                    {
                        data: 'jenis_penjualan',
                        name: 'jenis_penjualan'
                    },
                    {
                        data: 'tanggal',
                        name: 'tanggal'
                    },
                    {
                        data: 'pemasukkan',
                        name: 'pemasukkan'
                    },
                    {
                        data: 'keterangan',
                        name: 'keterangan',
                    },
                    {
                        data: 'total_uang',
                        name: 'total_uang',
                        render: function(data){
                            return 'Rp '+data
                        }
                    },
                    {
                        data: 'uuid',
                        name: 'uuid',
                        orderable: false,
                        searchable: false,
                        render: function (data, type, row) {
                            let btn = `<button type="button" class="btn btn-sm btn-warning" id="edit-data" data-uuid="`+data+`"><i class="fa fa-edit"></i></button>`
                            btn = btn + `<button type="button" class="btn btn-sm btn-danger remove-data" data-uuid="`+data+`"><i class="fa fa-trash"></i></button>`
                            return btn
                        }
                    },
                ],
                paging: false,
                bDestroy: true,
                order: [],
            })
        }

        // clear input
        function clearForm(){
            $('[name="jenis_penjualan"]').val('')
            $('[name="pemasukkan"]').val('')
            $('[name="keterangan"]').val('')
            $('[name="total_uang"]').val('')
        }

        // edit data table
        $('#tabel_insert').on('click', '#edit-data', function(){
            let uuid = $(this).data('uuid');
            let dt_detail = data.find(dt => dt.uuid === uuid)
            $('#kode_pemasukkan').val(dt_detail.kode_pemasukan);
            $('#jenis_penjualan').val(dt_detail.jenis_penjualan);
            $('#tanggal').val(dt_detail.tanggal);
            $('#pemasukkan').val(dt_detail.pemasukkan);
            $('#keterangan').val(dt_detail.keterangan);
            $('#total_uang').val(dt_detail.total_uang);

            let check = data.findIndex(e => e['uuid'] === uuid)
            if(check !== -1){
                data.splice(check, 1)
            }
            dataInsert(data);
        })

        // Hapus List
        $('#tabel_insert').on('click', '.remove-data', function(){
                let uuid = $(this).data('uuid');
                Swal.fire({
                    title: "Apakah anda yakin hapus data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Hapus!",
                    cancelButtonText: "Tidak",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        var _url = "{{ route('pemasukkan.deleteDetail', 'uuid') }}";
                        _url = _url.replace('uuid', uuid)
                        var _token = $('meta[name="csrf-token"]').attr('content');
                        $.ajax({
                            url: _url,
                            type: 'DELETE',
                            data: {
                                _token: _token
                            },
                            success: function(res) {
                                if(res.code == 200){
                                    check = data.findIndex(e => e['uuid'] === uuid)
                                    if(check !== -1){
                                        data.splice(check, 1)
                                        dataInsert(data);
                                        Notif.fire({
                                            icon: 'success',
                                            title: res.message,
                                        })
                                    }
                                }



                                if(res.code == 500){
                                    check = data.findIndex(e => e['uuid'] === uuid)
                                    if(check !== -1){
                                        data.splice(check, 1)
                                        dataInsert(data);
                                        Swal.fire(
                                            'Berhasil!',
                                            'Berhasil Hapus Data!',
                                            'warning'
                                        )
                                    }else{
                                        Notif.fire({
                                            icon: 'error',
                                            title: 'Gagal Menyimpan Data Gaji',
                                            text: 'Server Error!'
                                        });
                                    }
                                    
                                }
                            },
                            error: function(err) {
                                check = data.findIndex(e => e['uuid'] === uuid)
                                if(check !== -1){
                                    data.splice(check, 1)
                                    dataInsert(data);
                                    Swal.fire(
                                        'Berhasil!',
                                        'Berhasil Hapus Data!',
                                        'warning'
                                    )
                                }else{
                                    Notif.fire({
                                        icon: 'error',
                                        title: 'Gagal Menyimpan Data Gaji',
                                        text: 'Server Error!'
                                    });
                                }
                            }
                        })
                        
                    }
                });
            })


        // simpan di db
        $('#btn-save-data').on('click', function(){
                Swal.fire({
                    title: "Apakah anda yakin untuk simpan semua data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Simpan!",
                    cancelButtonText: "Tidak",
                })
                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            @if(Auth::user()->role_id == 1)
                            url         : "{{route('pemasukkan.update')}}",
                            @endif
                            method      : "POST",
                            data        : {'data': data},
                            success     : function(res){
                                if(res.code === 200){
                                    Swal.fire(
                                        'Berhasil!',
                                        'Berhasil Simpan Data!',
                                        'success'
                                    )
                                    data = [];
                                    $('#btn-tambah').attr('disabled', true);
                                    $('#btn-save-data').attr('disabled', true);

                                    setTimeout(() => {
                                        window.location.href = "{{route('pemasukkan')}}"
                                    }, 1500);
                                }
                                if(res.code === 400){
                                    Swal.fire(
                                        'Gagal!',
                                        res.message+' LOT: '+res.kode_lot,
                                        'error'
                                    )
                                }
                                if(res.code === 500){
                                    Swal.fire(
                                        'Gagal!',
                                        'Server Error!',
                                        'error'
                                    )
                                }
                            },
                            error       : function(err){
                                Swal.fire(
                                    'Gagal!',
                                    'Server Error!',
                                    'error'
                                )
                            }
                        })
                    }
                });
            })
    })
</script>
@endsection