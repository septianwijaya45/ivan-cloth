@extends('layouts.app')
@section('title', 'Surat Perintah Kain')


@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Surat Perintah Kain</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                            <li class="breadcrumb-item">Surat Perintah Kain</li>
                            <li class="breadcrumb-item active">Tambah SPK</li>
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
                                <h5 class="card-title">Form Tambah SPK</h5>
                                <div class="card-tools">
                                    <a href="{{ route('spk') }}" class="btn btn-warning btn-sm">Kembali</a>
                                </div>
                            </div>
                            <form action="#" method="POST" enctype="multipart/form-data" id="formSPP">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="kode_spp">Kode SPK</label>
                                            <div class="col-md-14 row">
                                                <div class="col-md-12">
                                                    <input type="text" name="kode_spk" id="kode_spk" class="form-control" value="{{kodeSPK()}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="artikel">Artikel</label>
                                            <div class="col-md-14 row">
                                                <div class="col-md-12">
                                                    <input type="text" name="artikel" id="artikel" class="form-control" value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="tanggal">Kode SPP</label>
                                            <div class="col-md-12">
                                                <select name="kode_spk" id="kode_spp" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih Kode SPP</option>
                                                    @foreach($spp as $dtSpp)
                                                        <option value="{{$dtSpp->kode_spp}}">{{$dtSpp->kode_spp}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="ukuran">Model / Ukuran</label>
                                            <div class="col-md-12">
                                                <select name="ukuran" id="ukuran" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih Ukuran</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="tanggal">Tanggal</label>
                                            <div class="col-md-12">
                                                <input type="date" name="tanggal" id="tanggal" class="form-control" value="{{$date}}">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="warna">Warna</label>
                                            <div class="col-md-12">
                                                <select name="warna" id="warna" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih Warna</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="hasil_kain_potongan">Hasil Potongan</label>
                                            <div class="col-md-12">
                                                <input type="number" name="hasil_kain_potongan" id="hasil_kain_potongan" class="form-control"  placeholder="Hasil Potongan" readonly>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="sisa_stok">Sisa Stok</label>
                                            <div class="col-md-12">
                                                <input type="number" name="sisa_stok" id="sisa_stok" class="form-control" placeholder="Sisa Stok" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="satuan">Satuan</label>
                                            <div class="col-md-12">
                                                <select name="satuan" id="satuan" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih Satuan</option>
                                                    <option value="PCS">PCS</option>
                                                    <option value="Kodi">Kodi</option>
                                                    <option value="Lusin">Lusin</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="hasil">Kain Potongan Dipakai</label>
                                            <div class="col-md-12">
                                                <input type="number" name="kain_potongan_dipakai" id="kain_potongan_dipakai" class="form-control" placeholder="Kain Potongan Dipakai" value="0">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="hasil">Hasil</label>
                                            <div class="col-md-12">
                                                <input type="number" name="hasil" id="hasil" class="form-control" placeholder="Hasil" value="0">
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
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <label for="karyawan_1">Karyawan Sablon 1</label>
                                            <div class="col-md-12">
                                                <select name="karyawan_1" id="karyawan_1" class="form-control">
                                                    <option value="" selected  class="text-center">Pilih Karyawan 1</option>
                                                    @foreach($karyawan as $dtKaryawan)
                                                        <option value="{{$dtKaryawan->uuid}}-{{$dtKaryawan->nama}}">{{$dtKaryawan->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <label for="karyawan_2">Karyawan Sablon 2</label>
                                            <div class="col-md-12">
                                                <select name="karyawan_2" id="karyawan_2" class="form-control">
                                                    <option value="" selected  class="text-center">Pilih Karyawan 2</option>
                                                    @foreach($karyawan as $dtKaryawan)
                                                        <option value="{{$dtKaryawan->uuid}}-{{$dtKaryawan->nama}}">{{$dtKaryawan->nama}}</option>
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
                                <h5 class="card-title">Data Insert Surat Perintah Kain</h5>
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
                                                        <th>Kode SPK</th>
                                                        <th>Artikel</th>
                                                        <th>Tanggal</th>
                                                        <th>Kode SPP</th>
                                                        <th>Warna | Model/Ukuran</th>
                                                        <th>Kain Potongan Dipakai</th>
                                                        <th>Hasil | Satuan</th>
                                                        <th>Karyawan</th>
                                                        <th>Gaji</th>
                                                        <th width="10%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-lg-12">
                                            <label for="note">Notes</label>
                                            <textarea name="note" id="note" cols="30" rows="2" placeholder="Keterangan" class="form-control"></textarea>
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
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Tambahkan Gambar Surat Perintah Kain</h5>
                            </div>
                            
                            <div class="card-body">
                                <form action="" method="POST" id="form-data-gambar">
                                    <div id="tbl_ukuran_wrapper"
                                        class="dataTables_wrapper dt-bootstrap4 table-responsive text-nowrap">
                                        <div class="col-lg-12">
                                            <label for="">Tambahkan Gambar</label>
                                            <input type="file" name="gambar[]" id="gambar" placeholder="Tambahkan Gambar" class="form-control" multiple>
                                        </div>
                                        <br>
                                        <div class="col-lg-12">
                                            <div class="card collapsed-card">
                                                <div class="card-header bg-primary">
                                                    <h3 class="card-title">Preview Gambar</h3>

                                                    <div class="card-tools">
                                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body" style="display: none;">
                                                    <div class="row">
                                                        <div class = "upload-img">
                                                            <!-- image here -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2 offset-md-9">
                                        <button type="button" id="btn-save-gambar" type="button" class="btn btn-success btn-block"> 
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
            $("#ukuran, #kode_spp, #warna, #karyawan_1, #karyawan_2, #gaji, #satuan").select2({
                theme: 'classic',
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            
            $('#kode_spp').on('change', function(e){
                e.preventDefault();
                let data = $(this).val();
                $.ajax({
                    url: "{{ url('surat-perintah-potong/data') }}/"+data,
                    // url: "{{ url('surat-perintah-potong/data-spp') }}?spp='"+data+"'",
                    method: "GET",
                    success: function(res){
                        $('#ukuran').empty();
                        $('#warna').empty();
                        $('#ukuran').append('<option value="" selected disabled class="text-center">Pilih Ukuran</option>');
                        $('#warna').append('<option value="" selected disabled class="text-center">Pilih Warna</option>');
                        res.forEach(element => {
                            let ukuran = '<option value="'+element["ukuran"]+'">'+element["ukuran"]+'</option>'
                            let warna = '<option value="'+element["warna"]+'">'+element["warna"]+'</option>'
                            $('#ukuran').append(ukuran);
                            $('#warna').append(warna);
                        })
                    }
                })
            });

            $('#ukuran').on('change', function(e){
                e.preventDefault();
                let data = $(this).val();
                $.ajax({
                    url: "{{ url('surat-perintah-kain/artikel') }}/"+data,
                    // url: "{{ url('surat-perintah-potong/data-spp') }}?spp='"+data+"'",
                    method: "GET",
                    success: function(res){
                        $('#artikel').val(res);
                    }
                })
            })

            $('#warna, #kode_spp, #ukuran').on('change', function(){
                let kode_spp = $('#kode_spp').val();
                let ukuran = $('#ukuran').val();
                let warna = $('#warna').val();
                $.ajax({
                    url: "{{ url('surat-perintah-kain/hasil-potongan') }}/"+kode_spp+"/"+ukuran+"/"+warna,
                    method: "GET",
                    success: function(res){
                        $('#hasil_kain_potongan').val(res.spp.hasilspp);
                        $('#sisa_stok').val(res.hasil.stok)
                    }
                })
            })

            $('#gambar').change(event => {
                if(event.target.files){
                    let filesAmount = event.target.files.length;
                    $('.upload-img').html("");

                    for(let i = 0; i < filesAmount; i++){
                        let reader = new FileReader();
                        reader.onload = function(event){
                            let html = `
                                <div class = "uploaded-img">
                                    <img src = "${event.target.result}" width="600" class="text-center">
                                </div>
                            `;
                            $(".upload-img").append(html);
                        }
                        reader.readAsDataURL(event.target.files[i]);
                    }

                    $('.upload-info-value').text(filesAmount);
                    $('.upload-img').css('padding', "20px");
                }
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

            var data = [];

            // Simpan
            $('#btn-tambah').on('click', function(){
                let karyawan = [];
                let k_id    = [];
                let kode_spk    = $('#kode_spk').val();
                let artikel     = $('#artikel').val();
                let kode_spp    = $('#kode_spp').val();
                let ukuran      = $('#ukuran').val();
                let tanggal     = $('#tanggal').val();
                let warna       = $('#warna').val();
                let warnaUkuran = warna+" | "+ukuran;
                let satuan      = $('#satuan').val();
                let kain_potongan_dipakai = $('#kain_potongan_dipakai').val();
                let hasil       = $('#hasil').val();
                let hasilSatuan = hasil+" | "+satuan;
                let k1          = $('#karyawan_1').val();
                let k2          = $('#karyawan_2').val();
                let namak1      = (k1 != null) ? k1.split('-')[1] : ''
                let namak2      = (k2 != null) ? k2.split('-')[1] : ''
                let u1      = (k1 != null) ? k1.split('-')[0] : ''
                let u2      = (k2 != null) ? k2.split('-')[0] : ''
                let gaji        = $('#gaji').val();
                (namak1 !== '' && namak2 !== '') ? karyawan.push(namak1, namak2) : karyawan.push(namak1)

                try {
                    if(warna !== null && warna !== '' && satuan !== null && satuan !== '' && ukuran !== null && ukuran !== '' && kode_spk !== null && kode_spk !== '' && k1 !== null && k1 !== '' && gaji !== null && gaji !== '' && k1 !== k2){
                        data.push({
                            uuid            : uuid(),
                            kode_spk        : kode_spk,
                            artikel         : artikel,
                            kode_spp        : kode_spp,
                            ukuran          : ukuran,
                            tanggal         : tanggal,
                            warna           : warna,
                            satuan          : satuan,
                            kain_potongan_dipakai : kain_potongan_dipakai,
                            hasil           : hasil,
                            k1              : k1,
                            k2              : k2,
                            u1              : u1,
                            u2              : u2,
                            karyawan        : karyawan,
                            gaji            : gaji,
                            warnaUkuran     : warnaUkuran,
                            hasilSatuan     : hasilSatuan
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
                            data: 'kode_spk',
                            name: 'kode_spk'
                        },
                        {
                            data: 'artikel',
                            name: 'artikel'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'kode_spp',
                            name: 'kode_spp'
                        },
                        {
                            data: 'warnaUkuran',
                            name: 'warnaUkuran',
                        },
                        {
                            data: 'kain_potongan_dipakai',
                            name: 'kain_potongan_dipakai',
                        },
                        {
                            data: 'hasilSatuan',
                            name: 'hasilSatuan',
                        },
                        {
                            data: 'karyawan',
                            name: 'karyawan',
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
                $('#kode_spp').val('').trigger('change.select2');
                $('[name="ukuran" ]').val('').trigger('change.select2');
                $('[name="warna" ]').val('').trigger('change.select2');
                $('[name="satuan" ]').val('').trigger('change.select2');
                $('[name="hasil_kain_potongan"]').val('');
                $('[name="sisa_stok"]').val('');
                $('[name="kain_potongan_dipakai"]').val('0');
                $('[name="hasil"]').val('0');
                $('[name="hasil"]').val('0');
                $('[name="karyawan_1"]').val('').trigger('change.select2');
                $('[name="karyawan_2"]').val('').trigger('change.select2');
                $('[name="gaji"]').val('').trigger('change.select2');
            }
            
            // edit data table
            $('#tabel_insert').on('click', '#edit-data', function(){
                let uuid = $(this).data('uuid');
                let dt_detail = data.find(dt => dt.uuid === uuid)
                console.log(dt_detail);
                $('#ukuran').val(dt_detail.ukuran).change();
                $('#tanggal').val(dt_detail.tanggal);
                $('#kode_lot').val(dt_detail.kode_lot).change();
                $('#warna').val(dt_detail.warna);
                $('#berat').val(dt_detail.berat);
                $('#hasil').val(dt_detail.hasil);
                $('#gaji').val(dt_detail.gaji).change();
                $('#karyawan_1').val(dt_detail.k1).change();
                $('#karyawan_2').val(dt_detail.k2).change();

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
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url         : "{{route('spk.store')}}",
                            method      : "POST",
                            data        : {'data': data, 'notes': $('#note').val()},
                            success     : function(res){
                                if(res.code === 200){
                                    Swal.fire(
                                        'Berhasil!',
                                        'Berhasil Simpan Data! Silahkan Upload Gambar!',
                                        'success'
                                    )
                                    data = [];
                                    $('#btn-tambah').attr('disabled', true);
                                    $('#btn-save-data').attr('disabled', true);
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

            // simpan gambar
            $('#btn-save-gambar').on('click', function(e){
                Swal.fire({
                    title: "Apakah anda yakin untuk simpan semua data ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonText: "Ya, Simpan!",
                    cancelButtonText: "Tidak",
                })
                .then((result) => {
                    if(result.isConfirmed){
                        e.preventDefault();
                        let kode_spk = $('#kode_spk').val()
                        let form = document.getElementById('form-data-gambar');
                        let formData = new FormData(form)
                        const totalGambar = $('#gambar')[0].files.length;
                        let gambar = $('#gambar')[0];
                        
                        for(let i = 0; i < totalGambar; i++){
                            formData.append('gambar'+i, gambar.files[i])
                        }
                        formData.append('totalGambar', totalGambar)
                        formData.append('kode_spk', kode_spk)

                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });

                        $.ajax({
                            url         : "{{route('spk.storeGambar')}}",
                            method      : "POST",
                            data        : formData,
                            processData: false,
                            cache: false,
                            contentType: false,
                            success     : function(res){
                                if(res.code === 200){
                                    Swal.fire(
                                        'Berhasil!',
                                        'Berhasil Simpan Data! Silahkan Upload Gambar!',
                                        'success'
                                    )
                                    
                                    setTimeout(() => {
                                        window.location.href = "{{route('spk')}}"
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
                })
            })
        });
    </script>
@endsection
