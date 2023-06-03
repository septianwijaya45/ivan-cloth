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
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
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
                                    @if (Auth::user()->role_id == 1)
                                        <a href="{{ route('spp') }}" class="btn btn-warning btn-sm">Kembali</a>
                                    @endif
                                    @if (Auth::user()->role_id == 3)
                                        <a href="{{ route('w.spp') }}" class="btn btn-warning btn-sm">Kembali</a>
                                    @endif
                                </div>
                            </div>
                            <form action="#" method="POST" enctype="multipart/form-data" id="formSPP">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <input type="text" name="id" id="id-data" value=""
                                                class="form-control" hidden readonly>
                                            <label for="kode_spp">Kode SPP</label>
                                            <div class="col-md-14 row">
                                                <div class="col-md-12">
                                                    <input type="text" name="kode_spp" id="kode_spp"
                                                        class="form-control" value="{{ $spp->kode_spp }}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <label for="tanggal">Tanggal</label>
                                            <div class="col-md-12">
                                                <input type="date" name="tanggal" id="tanggal" class="form-control"
                                                    value="{{ $spp->tanggal }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="ukuran">Model / Ukuran Potong</label>
                                            <div class="col-md-12">
                                                <select name="ukuran" id="ukuran" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih
                                                        Ukuran</option>
                                                    @foreach ($ukuran as $dtUkuran)
                                                        <option value="{{ $dtUkuran->kode_ukuran }}">
                                                            ({{ $dtUkuran->kode_ukuran }})
                                                            {{ $dtUkuran->ukuran }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <hr>
                                            <h4 id="header_form">Form Potongan Kain Roll :</h4>
                                        </div>

                                        <div class="col-lg-3" id="ukuran_kain_potong_visibility">
                                            <label for="ukuran_kain_potong">Ukuran (dari Kain Potongan)</label>
                                            <div class="col-md-12">
                                                <select name="ukuran_kain_potong" id="ukuran_kain_potong"
                                                    class="form-control">
                                                    <option value="" selected disabled class="text-center">Cari
                                                        Ukuran</option>
                                                    @foreach ($ukuran as $dtUkuran)
                                                        <option value="{{ $dtUkuran->kode_ukuran }}">
                                                            ({{ $dtUkuran->kode_ukuran }})
                                                            {{ $dtUkuran->ukuran }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3" id="kode_lot_visibility">
                                            <label for="tanggal">Kode Lot</label>
                                            <div class="col-md-12">
                                                <select name="kode_lot" id="kode_lot" class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih
                                                        Kode
                                                        Lot</option>
                                                    @foreach ($kainroll as $dtRoll)
                                                        <option value="{{ $dtRoll->uuid }}~{{ $dtRoll->kode_lot }}">
                                                            {{ $dtRoll->kode_lot }} | {{ $dtRoll->jenis_kain }} |
                                                            {{ $dtRoll->warna }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3" id="kode_lot_potongan_visibility">
                                            <label for="tanggal">Cari kain potongan</label>
                                            <div class="col-md-12">
                                                <select name="kode_lot_potongan" id="kode_lot_potongan"
                                                    class="form-control">
                                                    <option value="" selected disabled class="text-center">Pilih
                                                        Kain Potongan</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="warna">Warna</label>
                                            <div class="col-md-12" id="warna_visibility">
                                                <input type="text" name="warna" id="warna" class="form-control"
                                                    placeholder="Warna Lot" readonly>
                                            </div>
                                        </div>

                                        <div class="col-lg-3">
                                            <label for="quantity">Quantity</label>
                                            <div class="col-md-12">
                                                <input type="number" name="quantity" id="quantity"
                                                    class="form-control" placeholder="Quantity">
                                            </div>
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
                                                    <th>Kode SPP</th>
                                                    <th>Ukuran Potong SPP</th>
                                                    <th>Tanggal</th>
                                                    <th>Kode Lot</th>
                                                    <th>Warna</th>
                                                    <th>Quantity</th>
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
                                            <textarea name="note" id="note" cols="30" rows="2" placeholder="Keterangan"
                                                class="form-control">{{ $spp->note }}</textarea>
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
        $(document).ready(function() {
            $("#ukuran, #kode_lot, #karyawan_1, #karyawan_2, #gaji, #ukuran_kain_potong, #kode_lot_potongan")
                .select2({
                    theme: 'classic',
                    width: '100%',
                });

            $.fn.dataTable.ext.errMode = 'none';

            $('#ukuran_kain_potong_visibility').hide()
            $('#kode_lot_potongan_visibility').hide()
            $('#ukuran_kain_potong').prop('disabled', 'disabled')

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#dari_kain_potongan').on('click', function() {
                $('#ukuran_kain_potong_visibility').show()
                $('#header_form').html('Form Potong Kain Potongan :')
                $('#kode_lot_visibility').hide()
                $('#kode_lot_potongan_visibility').show()
                $('#ukuran_kain_potong').prop('disabled', false)
                clearForm()
            })

            $('#dari_kain_roll').on('click', function() {
                $('#ukuran_kain_potong_visibility').hide()
                $('#header_form').html('Form Potong Kain Roll :')
                $('#kode_lot_visibility').show()
                $('#kode_lot_potongan_visibility').hide()
                $('#ukuran_kain_potong').prop('disabled', 'disabled')
                clearForm()
            })

            $('#kode_lot').on('change', function(e) {
                e.preventDefault();
                let data = $(this).val();
                if (data != null) {
                    data = data.split('~')[0];
                    $.ajax({
                        @if (Auth::user()->role_id == 1)
                            url: "{{ url('kain-roll') }}/" + data,
                        @endif
                        @if (Auth::user()->role_id == 3)
                            url: "{{ url('w.kain-roll') }}/" + data,
                        @endif
                        method: "GET",
                        success: function(res) {
                            $('#warna').val(res.warna)
                            $('#quantity').val(res.stok_roll)
                        }
                    })
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
                "stateSave": true
            };

            var data = @json($spp_all);
            // var data = {{ json_encode($spp_all) }};
            console.log(data);
            dataInsert(data);

            $('#ukuran_kain_potong').on('change', function(e) {
                e.preventDefault()

                var ukuran = $(this).val();
                var _url = "{{ route('spp.searchKainPotongan', '_ukuran') }}";
                _url = _url.replace('_ukuran', ukuran)
                $.ajax({
                    url: _url,
                    method: "GET",
                    success: function(res) {
                        let htmlView =
                            `<option value="" selected disabled class="text-center text-danger"> Kain Potongan tidak ada! </option>`
                        if (res.length == 0) {
                            Swal.fire(
                                'GAGAL!',
                                'Tidak ada data dengan ukuran ' + ukuran +
                                ' di Stok Kain Potongan!',
                                'error'
                            )
                            $('#ukuran_kain_potong').val('').trigger('change.select2');
                            $('#warna').val('');
                            $('#quantity').val('');
                        } else {
                            htmlView =
                                `<option value="" selected disabled class="text-center text-success"> Kain Potongan ada! </option>`
                            $.each(res, function(i, data) {
                                htmlView += `<option value="` + data.kode_lot + `"> ` +
                                    data.kode_lot + ` | ` + data.jenis_kain + ` | ` +
                                    data.warna + `</option>`
                            })
                        }
                        $('#kode_lot_potongan').html(htmlView)
                    }
                })
            })

            $('#kode_lot_potongan').on('change', function(e) {
                e.preventDefault()

                var ukuran = $('#ukuran_kain_potong').val();
                var kode_lot_p = $(this).val();
                var _url = "{{ route('spp.searchKainPotonganStok', ['_ukuran', '_kode_lot_p']) }}";
                _url = _url.replace('_ukuran', ukuran)
                _url = _url.replace('_kode_lot_p', kode_lot_p)
                $.ajax({
                    url: _url,
                    method: "GET",
                    success: function(res) {
                        if (res.stok == 0) {
                            Swal.fire(
                                'GAGAL!',
                                'Stok Kosong untuk ukuran ' + ukuran + ' dengan kode lot ' +
                                kode_lot_p + ' di Stok Kain Potongan!',
                                'error'
                            )
                            $('#quantity').val(res.stok)
                            $('#warna').val('');
                        } else {
                            $('#quantity').val(res.stok)
                            $('#warna').val(res.warna);
                        }
                    }
                })
            })

            // Simpan
            $('#btn-tambah').on('click', function() {
                let karyawan = [];
                let k_id = [];
                let kode_spp = $('#kode_spp').val();
                let ukuran = $('#ukuran').val();
                let tanggal = $('#tanggal').val();
                let kode_lot = $('#kode_lot').val();
                if (kode_lot == '') {
                    kode_lot = $('#kode_lot_potongan').val();
                }
                let nama_lot = (kode_lot != null) ? kode_lot.split('~')[1] : '';
                if (nama_lot == '') {
                    nama_lot = $('#kode_lot_potongan').val();
                }
                let warna = $('#warna').val();
                let quantity = $('#quantity').val();
                let hasil = $('#hasil').val();
                let k1 = $('#karyawan_1').val();
                let k2 = $('#karyawan_2').val();
                let namak1 = (k1 != null) ? k1.split('-')[1] : ''
                let namak2 = (k2 != null) ? k2.split('-')[1] : ''
                let u1 = (k1 != null) ? k1.split('-')[0] : ''
                let u2 = (k2 != null) ? k2.split('-')[0] : ''
                let gaji = $('#gaji').val();

                let id = $('#id-data').val();
                let uuid_lot = (kode_lot != null) ? kode_lot.split('~')[0] : '';
                (namak1 !== '' && namak2 !== '') ? karyawan.push(namak1, namak2): karyawan.push(namak1)

                try {
                    if (ukuran !== null && ukuran !== '' && k1 !== null && k1 !== '' && gaji !== null &&
                        gaji !== '' && k1 !== k2) {
                        data.push({
                            uuid: uuid(),
                            kode_spp: kode_spp,
                            ukuran: ukuran,
                            tanggal: tanggal,
                            kode_lot: kode_lot,
                            nama_lot: nama_lot,
                            warna: warna,
                            quantity: quantity,
                            hasil: hasil,
                            k1: k1,
                            k2: k2,
                            u1: u1,
                            u2: u2,
                            karyawan: karyawan,
                            gaji: gaji,
                            id: id
                        })

                        dataInsert(data);
                        clearForm()

                        Swal.fire(
                            'Berhasil!',
                            'Berhasil Menambahkan Data!',
                            'success'
                        )
                    } else {
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
                            data: 'quantity',
                            name: 'quantity',
                        },
                        {
                            data: 'hasil',
                            name: 'hasil',
                        },
                        {
                            data: 'karyawan',
                            name: 'karyawan',
                            render: function(data) {
                                if (data.includes('[')) {
                                    data = data.replace('[', '')
                                    data = data.replace('"', '')
                                    data = data.replace('"', '')
                                    data = data.replace(', ', ',')
                                    data = data.replace('"', '')
                                    data = data.replace('"', '')
                                    data = data.replace(']', '')
                                    return data
                                } else {
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

            // Hapus List
            $('#tabel_insert').on('click', '.remove-data', function() {
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
                            if (check !== -1) {
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
            function clearForm() {
                $('[name="ukuran"]').val('').trigger('change.select2');
                $('[name="kode_lot" ]').val('').trigger('change.select2');
                $('[name="warna"]').val('');
                $('[name="quantity"]').val('');
                $('[name="hasil"]').val('0');
                $('[name="karyawan_1"]').val('').trigger('change.select2');
                $('[name="karyawan_2"]').val('').trigger('change.select2');
                $('[name="gaji"]').val('').trigger('change.select2');
                $('[name="kode_lot_potongan"]').val('').trigger('change.select2');
            }

            // edit data table
            $('#tabel_insert').on('click', '#edit-data', function() {
                let uuid = $(this).data('uuid');
                let dt_detail = data.find(dt => dt.uuid === uuid)
                console.log(dt_detail)
                $('#id-data').val(dt_detail.id);
                if (dt_detail.ukuran_kain_potong === null || dt_detail.ukuran_kain_potong === '') {
                    $('#dari_kain_roll').click()

                    $('#ukuran').val(dt_detail.ukuran).change();
                    $('#tanggal').val(dt_detail.tanggal);
                    $('#kode_lot').val(dt_detail.kode_lot).change();
                    $('#warna').val(dt_detail.warna);
                    $('#quantity').val(dt_detail.quantity);
                    $('#hasil').val(dt_detail.hasil);
                    $('#gaji').val(dt_detail.gaji).change();
                    $('#karyawan_1').val(dt_detail.k1).change();
                    $('#karyawan_2').val(dt_detail.k2).change();
                } else {
                    $('#dari_kain_potongan').click()

                    $('#ukuran').val(dt_detail.ukuran).change();
                    $('#tanggal').val(dt_detail.tanggal);
                    $('#kode_lot_potongan').val(dt_detail.nama_lot);
                    $('#warna').val(dt_detail.warna);
                    $('#quantity').val(dt_detail.quantity);
                    $('#hasil').val(dt_detail.hasil);
                    $('#gaji').val(dt_detail.gaji).change();
                    $('#karyawan_1').val(dt_detail.k1).change();
                    $('#karyawan_2').val(dt_detail.k2).change();
                }

                // try {
                //     let karyawan = JSON.parse(dt_detail.karyawan)
                //     let k_id = JSON.parse(dt_detail.karyawan_id)
                //     // console.log(k_id)
                //     $('#karyawan_1').val(k_id[0] + '-' + karyawan[0]).change();
                //     $('#karyawan_2').val(k_id[1] + '-' + karyawan[1]).change();
                // } catch (error) {
                //     $('#karyawan_1').val(dt_detail.k1).change();
                //     $('#karyawan_2').val(dt_detail.k2).change();
                // }

                let check = data.findIndex(e => e['uuid'] === uuid)
                if (check !== -1) {
                    data.splice(check, 1)
                }
                dataInsert(data);
            })


            // simpan di db
            $('#btn-save-data').on('click', function() {
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
                                @if (Auth::user()->role_id == 1)
                                    url: "{{ route('spp.update') }}",
                                @endif
                                @if (Auth::user()->role_id == 3)
                                    url: "{{ route('w.spp.update') }}",
                                @endif
                                method: "POST",
                                data: {
                                    'data': data,
                                    'notes': $('#note').val()
                                },
                                success: function(res) {
                                    if (res.code === 200) {
                                        Swal.fire(
                                            'Berhasil!',
                                            'Berhasil Simpan Data!',
                                            'success'
                                        )
                                        data = [];
                                        setTimeout(() => {
                                            window.location.href =
                                                "{{ route('spp') }}"
                                        }, 1500);
                                    }
                                    if (res.code === 400) {
                                        Swal.fire(
                                            'Gagal!',
                                            res.message + ' LOT: ' + res.kode_lot,
                                            'error'
                                        )
                                    }
                                    if (res.code === 500) {
                                        Swal.fire(
                                            'Gagal!',
                                            'Server Error!',
                                            'error'
                                        )
                                    }
                                },
                                error: function(err) {
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
