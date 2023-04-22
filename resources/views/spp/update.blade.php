@extends('layouts.app')
@section('title', 'Surat Perintah Potong')
<?php 
    // dd(json_encode($spp_all));
?>

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Surat Perintah Potong</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item">Surat Perintah Potong</li>
                            <li class="breadcrumb-item active">Edit SPP</li>
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
                                <h5 class="card-title">Form Edit SPP</h5>
                                <div class="card-tools">
                                    <button class="btn btn-warning btn-sm" onclick="cancelSPP()">Kembali</button>
                                </div>
                            </div>
                            <form action="#" method="POST" enctype="multipart/form-data" id="formSPP">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <input type="text" name="id" id="id-data" value="" class="form-control" hidden readonly>
                                            <label for="kode_spp">Kode SPP</label>
                                            <div class="col-md-14 row">
                                                <div class="col-md-12">
                                                    <input type="text" name="kode_spp" id="kode_spp" class="form-control" value="{{$spp->kode_spp}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ukuran">Model / Ukuran</label>
                                            <div class="col-md-12">
                                                <select name="ukuran" id="ukuran" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih Ukuran</option>
                                                    @foreach($ukuran as $dtUkuran)
                                                        <option value="{{$dtUkuran->ukuran}}">{{$dtUkuran->ukuran}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="tanggal">Tanggal</label>
                                            <div class="col-md-12">
                                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{$spp->tanggal}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="tanggal">Kode Lot</label>
                                            <div class="col-md-12">
                                                <select name="kode_lot" id="kode_lot" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih Kode Lot</option>
                                                    @foreach($kainroll as $dtRoll)
                                                        <option value="{{$dtRoll->uuid}}~{{$dtRoll->kode_lot}}">{{$dtRoll->kode_lot}} | {{$dtRoll->warna}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="warna">Warna</label>
                                            <div class="col-md-12">
                                                <input type="text" name="warna" id="warna" class="form-control" placeholder="Warna Lot" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="berat">Berat Sisa</label>
                                            <div class="col-md-12">
                                                <input type="number" name="berat_data" id="berat_data" class="form-control"  placeholder="Berat Sisa Di LOT" disabled>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <label for="berat">Berat</label>
                                            <div class="col-md-12">
                                                <input type="number" name="berat" id="berat" class="form-control"  placeholder="Berat">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="hasil">Hasil</label>
                                            <div class="col-md-12">
                                                <input type="number" name="hasil" id="hasil" class="form-control" placeholder="Hasil" value="0">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="karyawan_1">Karyawan Potong 1</label>
                                            <div class="col-md-12">
                                                <select name="karyawan_1" id="karyawan_1" class="form-control">
                                                    <option value="" selected  class="text-center">Pilih Karyawan 1</option>
                                                    @foreach($karyawan as $dtKaryawan)
                                                        <option value="{{$dtKaryawan->uuid}}-{{$dtKaryawan->nama}}">{{$dtKaryawan->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="karyawan_2">Karyawan Potong 2</label>
                                            <div class="col-md-12">
                                                <select name="karyawan_2" id="karyawan_2" class="form-control">
                                                    <option value="" selected  class="text-center">Pilih Karyawan 2</option>
                                                    @foreach($karyawan as $dtKaryawan)
                                                        <option value="{{$dtKaryawan->uuid}}-{{$dtKaryawan->nama}}">{{$dtKaryawan->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="gaji">Gaji</label>
                                            <div class="col-md-12">
                                                <select name="gaji" id="gaji" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih Gaji</option>
                                                    @foreach($gaji as $dtGaji)
                                                        <option value="{{$dtGaji->gaji}}">{{$dtGaji->gaji}}</option>
                                                    @endforeach
                                                </select>
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
                                <h5 class="card-title">Data Insert Surat Perintah Potong</h5>
                            </div>
                            
                            <div class="card-body">
                                <form action="" id="form-data-insert">
                                    <div id="tbl_ukuran_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 table-responsive text-nowrap">
                                        <table id="tabel_insert" class="table table-bordered table-striped dataTable"
                                            aria-describedby="tbl_ukuran" style="width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>Kode SPP</th>
                                                    <th>Ukuran</th>
                                                    <th>Tanggal</th>
                                                    <th>Kode Lot</th>
                                                    <th>Warna</th>
                                                    <th>Berat</th>
                                                    <th>Hasil</th>
                                                    <th>Karyawan</th>
                                                    <th>Gaji</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <div class="col-lg-12">
                                            <label for="note">Notes</label>
                                            <textarea name="note" id="note" cols="30" rows="2" placeholder="Keterangan" class="form-control">{{$spp->note}}</textarea>
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
        
        
        <!-- edit form -->
        <div class="modal fade" id="modalEditSPP" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
            <div class="modal-dialog-scrollable modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Data SPP</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body bg-light">
                        <form enctype="multipart/form-data" autocomplete="off" id="formEditUkuran" data-id=""
                            class="needs-validation" novalidate>
                            @method('PUT')
                            @csrf
                            <input type="hidden" name="uuid" id="uuidMap">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="berat">Berat</label>
                                    <div class="col-md-14 row">
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Berat Kain" name="berat" id="beratMap"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="hasil">Hasil</label>
                                    <div class="col-md-14 row">
                                        <div class="col-md-12">
                                            <input type="text" placeholder="Hasil Kain" name="hasil"
                                                class="form-control" id="hasilMap">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer container-fluid mt-4">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                    <button type="button" id="simpanUbahData" class="btn btn-primary">Simpan Data</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $("#ukuran, #kode_lot, #karyawan_1, #karyawan_2, #gaji").select2({
                theme: 'classic',
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            
            $('#kode_lot').on('change', function(e){
                e.preventDefault();
                let dt = $(this).val();
                dt = dt.split('~')[0];
                $.ajax({
                    url: "{{ url('kain-roll') }}/"+dt,
                    method: "GET",
                    success: function(res){
                        $('#warna').val(res.warna)
                        $('#berat_data').val(res.berat)
                    }
                })
            });
        });
    </script>
    <script>
        $(document).ready(function(){
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

            var data = @json($spp_all);
            // var data = {{json_encode($spp_all)}};
            dataInsert(data);

            // Simpan
            $('#btn-tambah').on('click', function(){
                let karyawan = [];
                let kode_spp    = $('#kode_spp').val();
                let id    = $('#id-data').val();
                let ukuran      = $('#ukuran').val();
                let tanggal     = $('#tanggal').val();
                let kode_lot    = $('#kode_lot').val();
                let uuid_lot    = (kode_lot != null) ? kode_lot.split('~')[0] : '';
                let nama_lot    = (kode_lot != null) ? kode_lot.split('~')[1] : '';
                let warna       = $('#warna').val();
                let berat       = $('#berat').val();
                let hasil       = $('#hasil').val();
                let k1          = $('#karyawan_1').val();
                let k2          = $('#karyawan_2').val();
                let namak1      = (k1 != null) ? k1.split('-')[1] : ''
                let namak2      = (k2 != null) ? k2.split('-')[1] : ''
                let u1      = (k1 != null) ? k1.split('-')[0] : ''
                let u2      = (k2 != null) ? k2.split('-')[0] : ''
                let gaji        = $('#gaji').val();
                (namak1 !== '' && namak2 !== '') ? karyawan.push(namak1, namak2) : karyawan.push(namak1)

                try {
                    if(ukuran !== null && ukuran !== '' && kode_lot !== null && kode_lot !== '' && k1 !== null && k1 !== '' && gaji !== null && gaji !== '' && k1 !== k2){
                        data.push({
                            uuid            : uuid(),
                            kode_spp        : kode_spp,
                            ukuran          : ukuran,
                            tanggal         : tanggal,
                            kode_lot        : kode_lot,
                            nama_lot        : nama_lot,
                            warna           : warna,
                            berat           : berat,
                            hasil           : hasil,
                            k1              : k1,
                            k2              : k2,
                            u1              : u1,
                            u2              : u2,
                            karyawan        : karyawan,
                            gaji            : gaji,
                            id              : id
                        })
                        console.log(data);
    
                        dataInsert(data);
                        clearForm()
    
                        Swal.fire(
                            'Berhasil!',
                            'Berhasil Menambahkan Data!',
                            'success'
                        )
                    }else{
                        if(k1 === k2 && k1 !== null && k2 !== null){
                            Swal.fire(
                                'GAGAL!',
                                'Karyawan 1 dan Karyawan 2 Tidak Boleh Sama!',
                                'error'
                            )
                        }else{
                            Swal.fire(
                                'GAGAL!',
                                'Form Ada Yang Kosong!',
                                'error'
                            )
                        }
                    }
                } catch (error) {
                    Swal.fire(
                        'Gagal!',
                        'Error: '+error,
                        'success'
                    )
                }
            })
            
            function dataInsert(datas) {
                extensionList = $('#tabel_insert').DataTable({
                    data: datas,
                    columns: [
                        {
                            data: 'kode_spp',
                            name: 'kode_spp'
                        },
                        {
                            data: 'ukuran',
                            name: 'ukuran'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'nama_lot',
                            name: 'nama_lot'
                        },
                        {
                            data: 'warna',
                            name: 'warna',
                        },
                        {
                            data: 'berat',
                            name: 'berat',
                        },
                        {
                            data: 'hasil',
                            name: 'hasil',
                        },
                        {
                            data: 'karyawan',
                            name: 'karyawan',
                            render: function(data){
                                if(data.includes('[')){
                                    data = data.replace('[', '')
                                    data = data.replace('"', '')
                                    data = data.replace('"', '')
                                    data = data.replace(', ', ',')
                                    data = data.replace('"', '')
                                    data = data.replace('"', '')
                                    data = data.replace(']', '')
                                    return data
                                }else{
                                    return data
                                }
                            }
                        },
                        {
                            data: 'gaji',
                            name: 'gaji',
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
                        check = data.findIndex(e => e['uuid'] === uuid)
                        console.log(check)
                        if(check !== -1){
                            data.splice(check, 1)
                        }
                        dataInsert(data);
                        Swal.fire(
                            'Berhasil!',
                            'Berhasil Hapus Data!',
                            'warning'
                        )
                    }
                });
            })

            // clear input
            function clearForm(){
                $('[name="ukuran"]').val('').trigger('change.select2');
                $('[name="kode_lot" ]').val('').trigger('change.select2');
                $('[name="warna"]').val('');
                $('[name="berat"]').val('');
                $('[name="hasil"]').val('0');
                $('[name="karyawan_1"]').val('').trigger('change.select2');
                $('[name="karyawan_2"]').val('').trigger('change.select2');
                $('[name="gaji"]').val('').trigger('change.select2');
            }
            
            // edit data table
            $('#tabel_insert').on('click', '#edit-data', function(){
                let uuid = $(this).data('uuid');
                let dt_detail = data.find(dt => dt.uuid === uuid)
                $('#id-data').val(dt_detail.id);
                $('#ukuran').val(dt_detail.ukuran).change();
                $('#tanggal').val(dt_detail.tanggal);
                $('#warna').val(dt_detail.warna);
                $('#berat').val(dt_detail.berat);
                $('#hasil').val(dt_detail.hasil);
                $('#gaji').val(dt_detail.gaji).change();
                console.log(dt_detail.id);
                
                try {
                    let karyawan =JSON.parse(dt_detail.karyawan)
                    let k_id =JSON.parse(dt_detail.karyawan_id)
                    // console.log(k_id)
                    $('#karyawan_1').val(k_id[0]+'-'+karyawan[0]).change();
                    $('#karyawan_2').val(k_id[1]+'-'+karyawan[1]).change();
                    $('#kode_lot').val(dt_detail.uuid+'~'+dt_detail.nama_lot).change();
                } catch (error) {                
                    $('#kode_lot').val(dt_detail.kode_lot).change();
                    $('#karyawan_1').val(dt_detail.k1).change();
                    $('#karyawan_2').val(dt_detail.k2).change();
                }

                let check = data.findIndex(e => e['uuid'] === uuid)
                if(check !== -1){
                    data.splice(check, 1)
                }
                dataInsert(data);
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
                        $.ajax({
                            url         : "{{route('spp.update')}}",
                            method      : "POST",
                            data        : {'data': data, 'notes': $('#note').val()},
                            success     : function(res){
                                if(res.code === 200){
                                    Swal.fire(
                                        'Berhasil!',
                                        'Berhasil Simpan Data!',
                                        'success'
                                    )
                                    data = [];
                                    setTimeout(() => {
                                        window.location.href = "{{route('spp')}}"
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
                                    console.log(res.error)
                                    Swal.fire(
                                        'Gagal!',
                                        'Server Error!',
                                        'error'
                                    )
                                }
                            },
                            error       : function(err){
                                console.log(err);
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

        });
    </script>
@endsection
