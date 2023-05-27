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
                        <h1 class="m-0">Tambah Surat Perintah Potong</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">Surat Perintah Potong</li>
                            <li class="breadcrumb-item active">Tambah SPP</li>
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
                                <h5 class="card-title">Form Tambah SPP</h5>
                                <div class="card-tools">
                                    @if (Auth::user()->role_id == 1)
                                        <a href="{{ route('jahit') }}" class="btn btn-warning btn-sm">Kembali</a>
                                    @endif
                                    @if (Auth::user()->role_id == 3)
                                        <a href="{{ route('w.jahit') }}" class="btn btn-warning btn-sm">Kembali</a>
                                    @endif
                                </div>
                            </div>
                            <form action="#" method="POST" enctype="multipart/form-data" id="formSPP">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="kode_jahit">Kode Jahit</label>
                                            <div class="col-md-14 row">
                                                <div class="col-md-12">
                                                    <input type="text" name="kode_jahit" id="kode_jahit"
                                                        class="form-control" value="{{ kodeJahit() }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="tanggal">Tanggal</label>
                                            <div class="col-md-12">
                                                <input type="date" name="tanggal" id="tanggal" class="form-control"
                                                    value="{{ $date }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ukuran">Kode SPK</label>
                                            <div class="col-md-12">
                                                <select name="kode_spk" id="kode_spk" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih
                                                        SPK</option>
                                                    @foreach($spk as $spk)
                                                        <option value="{{$spk->kode_spk}}">{{$spk->kode_spk}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label for="ukuran">Artikel SPK</label>
                                            <div class="col-md-12">
                                                <select name="artikel" id="artikel" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih
                                                        Artikel SPK</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ukuran">Quantity Artikel SPK</label>
                                            <div class="col-md-12">
                                                <input type="number" name="quantity_spk" id="quantity_spk" class="form-control" placeholder="Quantity Artikel SPK" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="ukuran">Satuan</label>
                                            <select name="satuan" id="satuan" class="form-control satuan">
                                                <option value="" selected disabled class="text-center">Satuan</option>
                                                <option value="PCS">PCS</option>
                                                <option value="Kodi">Kodi</option>
                                                <option value="Lusin">Lusin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <label for="hasil">Hasil</label>
                                            <div class="col-md-12">
                                                <input type="number" name="hasil" id="hasil" class="form-control"
                                                    placeholder="Hasil" value="0">
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="karyawan_1">Karyawan Potong 1</label>
                                            <div class="col-md-12">
                                                <select name="karyawan_1" id="karyawan_1" class="form-control">
                                                    <option value="" selected class="text-center">Pilih Karyawan 1
                                                    </option>
                                                    @foreach ($karyawan as $dtKaryawan)
                                                        <option value="{{ $dtKaryawan->uuid }}-{{ $dtKaryawan->nama }}">
                                                            {{ $dtKaryawan->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="karyawan_2">Karyawan Potong 2</label>
                                            <div class="col-md-12">
                                                <select name="karyawan_2" id="karyawan_2" class="form-control">
                                                    <option value="" selected class="text-center">Pilih Karyawan 2
                                                    </option>
                                                    @foreach ($karyawan as $dtKaryawan)
                                                        <option value="{{ $dtKaryawan->uuid }}-{{ $dtKaryawan->nama }}">
                                                            {{ $dtKaryawan->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="gaji">Gaji</label>
                                            <div class="col-md-12">
                                                <select name="gaji" id="gaji" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih
                                                        Gaji</option>
                                                    @foreach ($gaji as $dtGaji)
                                                        <option value="{{ $dtGaji->gaji }}">{{ $dtGaji->gaji }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="button" id="btn-tambah"
                                        class="btn btn-success float-right">Tambahkan</button>
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
                                                    <th>Kode Jahit</th>
                                                    <th>Tanggal</th>
                                                    <th>Karyawan</th>
                                                    <th>Hasil Jahit</th>
                                                    <th>Satuan</th>
                                                    <th>Gaji</th>
                                                    <th width="10%">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                        <div class="col-lg-12">
                                            <label for="note">Notes</label>
                                            <textarea name="note" id="note" cols="30" rows="2" placeholder="Keterangan"
                                                class="form-control"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-2 offset-md-9">
                                        <button type="button" id="btn-save-data" type="button"
                                            class="btn btn-success btn-block">
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
        $("#kode_spk, #artikel, #karyawan_1, #karyawan_2, #gaji, #satuan")
                .select2({
                    theme: 'classic',
                    width: '100%',
                });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $("#tab_kp").DataTable({
            "paging": false,
            "lengthChange": false,
            "searching": false,
            "ordering": false,
            "info": false,
            "autoWidth": true,
            "responsive": true,
            "stateSave": true
        });

        $(document).on('change', '#kode_spk', function(e) {
            e.preventDefault();
            let data = $('#kode_spk').val();
            $.ajax({
                @if (Auth::user()->role_id == 1)
                    url: "{{ url('Jahit/getArtikelFromSPK') }}/" + data,
                @endif
                @if (Auth::user()->role_id == 3)
                    url: "{{ url('warehouse/Jahit/getArtikelFromSPK') }}/" + data,
                @endif
                method: "GET",
                success: function(res) {
                    let htmlView = '<option value="" selected disabled class="text-center">Pilih Artikel SPK</option>';

                    $.each(res, function(i, data) {
                        htmlView += '<option value="'+data.id+','+data.id_potongan+'" class="text-center">'+data.nama+' </option>'
                    })

                    $('#artikel').html(htmlView)
                }
            })
        })

        $(document).on('change', '#artikel', function(e) {
            e.preventDefault();
            let data = $('#artikel').val();
            $.ajax({
                @if (Auth::user()->role_id == 1)
                    url: "{{ url('Jahit/getQuantityArtikel') }}/" + data,
                @endif
                @if (Auth::user()->role_id == 3)
                    url: "{{ url('warehouse/Jahit/getQuantityArtikel') }}/" + data,
                @endif
                method: "GET",
                success: function(res) {
                    $('#quantity_spk').val(res.quantity);
                    $('#hasil').val(res.quantity);
                }
            })
        })
    </script>
    <script>
        $(document).ready(function(){
            var data = [];

            $('#btn-tambah').on('click', function(){
                let karyawan = [];
                let k_id = [];
                let kode_jahit = $('#kode_jahit').val();
                let satuan = $('#satuan').val();
                let jumlah_jahit = $('#hasil').val();
                let k1 = $('#karyawan_1').val();
                let k2 = $('#karyawan_2').val();
                let namak1 = (k1 != null) ? k1.split('-')[1] : ''
                let namak2 = (k2 != null) ? k2.split('-')[1] : ''
                let u1 = (k1 != null) ? k1.split('-')[0] : ''
                let u2 = (k2 != null) ? k2.split('-')[0] : ''
                let gaji = $('#gaji').val();
                let artikel = $('#artikel').val();
                let tanggal = $('#tanggal').val();

                (namak1 !== '' && namak2 !== '') ? karyawan.push(namak1, namak2): karyawan.push(namak1)
                (u1 !== '' && u2 !== '') ? k_id.push(u1, u2): karyawan.push(u1)

                try {
                    if (kode_jahit !== null && kode_jahit !== '' && satuan !== '' && satuan !== null && k1 !== null && k1 !== '' && gaji !== null && gaji !== '' && k1 !== k2) {
                        data.push({
                            uuid: uuid(),
                            kode_jahit: kode_jahit,
                            artikel: artikel,
                            satuan: satuan,
                            tanggal: tanggal,
                            jumlah_jahit: jumlah_jahit,
                            k1: k1,
                            k2: k2,
                            u1: u1,
                            u2: u2,
                            karyawan: karyawan,
                            k_id: k_id,
                            gaji: gaji
                        })

                        dataInsert(data);
                        clearForm()

                        Swal.fire(
                            'Berhasil!',
                            'Berhasil Menambahkan Data!',
                            'success'
                        )
                    }else{
                        if (k1 === k2 && k1 !== null && k2 !== null) {
                            Swal.fire(
                                'GAGAL!',
                                'Karyawan 1 dan Karyawan 2 Tidak Boleh Sama!',
                                'error'
                            )
                        } else {
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
                        'Error: ' + error,
                        'success'
                    )
                }
            })

            function dataInsert(datas) {
                extensionList = $('#tabel_insert').DataTable({
                    data: datas,
                    columns: [{
                            data: 'kode_jahit',
                            name: 'kode_jahit'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'karyawan',
                            name: 'karyawan'
                        },
                        {
                            data: 'jumlah_jahit',
                            name: 'jumlah_jahit',
                        },
                        {
                            data: 'satuan',
                            name: 'satuan',
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
                            render: function(data, type, row) {
                                let btn =
                                    `<button type="button" class="btn btn-sm btn-warning" id="edit-data" data-uuid="` +
                                    data + `"><i class="fa fa-edit"></i></button>`
                                btn = btn +
                                    `<button type="button" class="btn btn-sm btn-danger remove-data" data-uuid="` +
                                    data + `"><i class="fa fa-trash"></i></button>`
                                return btn
                            }
                        },
                    ],
                    paging: false,
                    bDestroy: true,
                    order: [],
                })
            }

            function clearForm() {
                $('[name="kode_spk"]').val('').trigger('change.select2');
                $('[name="artikel" ]').val('').trigger('change.select2');
                $('[name="quantity_spk"]').val('');
                $('[name="satuan"]').val('').trigger('change.select2');
                $('[name="hasil"]').val('');
                $('[name="karyawan_1"]').val('').trigger('change.select2');
                $('[name="karyawan_2"]').val('').trigger('change.select2');
                $('[name="gaji"]').val('').trigger('change.select2');
            }
        });
    </script>
@endsection
