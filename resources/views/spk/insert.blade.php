@extends('layouts.app')
@section('title', 'Surat Perintah Kerja')

@section('content')
    <style>
        .middleText {
            vertical-align: middle;
            text-align: center;
        }
    </style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Surat Perintah Kerja</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item">Surat Perintah Kerja</li>
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
                                    @if (Auth::user()->role_id == 1)
                                        <a href="{{ route('spk') }}" class="btn btn-warning btn-sm">Kembali</a>
                                    @endif
                                    @if (Auth::user()->role_id == 3)
                                        <a href="{{ route('w.spk') }}" class="btn btn-warning btn-sm">Kembali</a>
                                    @endif
                                </div>
                            </div>
                            <form action="#" method="POST" enctype="multipart/form-data" id="formSPK">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6 row align-items-start">
                                            <div class="col-md-6">
                                                <label for="kode_spp">Kode SPK</label>
                                                <div class="col-md-14 row">
                                                    <div class="col-md-12">
                                                        <input type="text" name="kode_spk" id="kode_spk"
                                                            class="form-control" value="{{ kodeSPK() }}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="artikel">Artikel</label>
                                                <div class="col-md-14 row">
                                                    <div class="col-md-12">
                                                        <input type="text" name="artikel" id="artikel"
                                                            class="form-control" value="" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="tanggal">Tanggal</label>
                                                <div class="col-md-12">
                                                    <input type="date" name="tanggal" id="tanggal" class="form-control"
                                                        value="{{ $date }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="ukuran">Model / Ukuran</label>
                                                <div class="col-md-12">
                                                    <select name="ukuran" id="ukuran" class="form-control">
                                                        <option value="" selected disabled class="text-center">Pilih
                                                            Ukuran</option>
                                                        @foreach ($ukuran as $data)
                                                            <option value="{{ $data->kode_ukuran }}" class="text-center">
                                                                {{ $data->kode_ukuran }} ({{ $data->ukuran }})</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-md-12">
                                                <label for="">Tambahkan Gambar <span class="text-mute">*max
                                                        2MB</span></label>
                                                <input type="file" name="gambar[]" id="gambar"
                                                    placeholder="Tambahkan Gambar" class="form-control" multiple>
                                            </div>
                                            <br>
                                            <div class="col-md-12">
                                                <div class="card collapsed-card">
                                                    <div class="card-header bg-primary">
                                                        <h3 class="card-title">Preview Gambar</h3>

                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool"
                                                                data-card-widget="collapse">
                                                                <i class="fas fa-plus"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body" style="display: none;">
                                                        <div class="row">
                                                            <div class="upload-img container-fluid p-0">
                                                                <!-- image here -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="">
                                        <div id="form_kain_potongan"
                                            class="dataTables_wrapper dt-bootstrap4 table-responsive text-nowrap">
                                            <table class="table table-hover table-bordered dataTable" id="tab_kp"
                                                style="width: 100%;">
                                                <thead>
                                                    <tr>
                                                        <th width='15%'> Kain Potongan </th>
                                                        <th width='13%'> Sisa Stok</th>
                                                        <th width='10%'> Quantity</th>
                                                        <th width='10%'> Satuan</th>
                                                        <th width='15%'> Karyawan 1</th>
                                                        <th width='15%'> Karyawan 2</th>
                                                        <th width='13%'> Gaji</th>
                                                        <th width="3%"></th>
                                                    </tr>
                                                </thead>
                                                <tbody id="form_tbody">
                                                    <tr id="kp_row_0">
                                                        <td>
                                                            <select name="kp_id[]" class="form-control kp_id">
                                                                <option value="" selected disabled
                                                                    class="text-center">
                                                                    Kain Potongan
                                                                </option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="sisa_stok[]"
                                                                class="form-control sisa_stok" placeholder="Stok"
                                                                readonly>
                                                        </td>
                                                        <td>
                                                            <input type="number" name="kain_potongan_dipakai[]"
                                                                class="form-control kain_potongan_dipakai"
                                                                placeholder="Quantity Kain Potongan" value="0">
                                                        </td>
                                                        <td>
                                                            <select name="satuan[]" class="form-control satuan">
                                                                <option value="" selected disabled
                                                                    class="text-center">
                                                                    Satuan</option>
                                                                <option value="PCS">PCS</option>
                                                                <option value="Kodi">Kodi</option>
                                                                <option value="Lusin">Lusin</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="karyawan_1[]" class="form-control karyawan_1">
                                                                <option value="" disabled selected
                                                                    class="text-center">
                                                                    Karyawan
                                                                    1
                                                                </option>
                                                                @foreach ($karyawan as $dtKaryawan)
                                                                    <option
                                                                        value="{{ $dtKaryawan->uuid }}-{{ $dtKaryawan->nama }}">
                                                                        {{ $dtKaryawan->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="karyawan_2[]" class="form-control karyawan_2">
                                                                <option value="" disabled selected
                                                                    class="text-center">
                                                                    Karyawan
                                                                    2
                                                                </option>
                                                                @foreach ($karyawan as $dtKaryawan)
                                                                    <option
                                                                        value="{{ $dtKaryawan->uuid }}-{{ $dtKaryawan->nama }}">
                                                                        {{ $dtKaryawan->nama }}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select name="gaji[]" class="form-control gaji">
                                                                <option value="" selected disabled
                                                                    class="text-center">
                                                                    Gaji</option>
                                                                @foreach ($gaji as $dtGaji)
                                                                    <option value="{{ $dtGaji->gaji }}">
                                                                        {{ $dtGaji->gaji }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>

                                                        <td>
                                                            <!-- placeholder for remove button -->
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button class="btn btn-info text-center container-fluid" id="add_kain_potongan">Tambah
                                        Kain Potongan</button>
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
                                                        <th>Tanggal</th>
                                                        <th>Artikel</th>
                                                        <th>Ukuran</th>
                                                        <th>Jenis Kain</th>
                                                        <th>Warna</th>
                                                        <th>Quantity | Satuan</th>
                                                        <th>Karyawan</th>
                                                        <th>Gaji</th>
                                                        <th width="10%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody style=" vertical-align: middle;">
                                                </tbody>
                                            </table>
                                        </div>
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

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header bg-primary">
                                <h3 class="card-title">Gambar Per Artikel</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body" style="display: block;">
                                <div class="row upload-img2 ">

                                </div>
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
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                        'content')
                }
            });

            function refreshS2main() {
                $("#ukuran, [name*='kp_id[]'],[name*='satuan[]'], [name*='karyawan_1[]'], [name*='karyawan_2[]'], [name*='gaji[]']")
                    .select2({
                        theme: 'classic',
                        width: '100%',
                    })
            }

            $("#tab_kp").DataTable({
                "paging": false,
                "lengthChange": false,
                "searching": false,
                "ordering": false,
                "info": false,
                "autoWidth": true,
                "responsive": true,
                "stateSave": true
            })

            refreshS2main()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var kp_html = $('#form_kain_potongan').html();
            $(document).on('click', '#add_kain_potongan', function(e) {
                e.preventDefault()

                var iRow = $('#form_tbody tr:last', tab_kp).index() + 1;
                var add_kp_row = `<tr id="kp_row_` + iRow + `">
                                    <td>
                                        <select name="kp_id[]" class="form-control kp_id">
                                            <option value="" selected disabled class="text-center">
                                                Kain Potongan
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="number" name="sisa_stok[]" class="form-control sisa_stok" placeholder="Stok"
                                            readonly>
                                    </td>
                                    <td>
                                        <input type="number" name="kain_potongan_dipakai[]" class="form-control kain_potongan_dipakai"
                                            placeholder="Quantity Kain Potongan" value="0">
                                    </td>
                                    <td>
                                        <select name="satuan[]" class="form-control satuan">
                                            <option value="" selected disabled class="text-center">
                                                Satuan</option>
                                            <option value="PCS">PCS</option>
                                            <option value="Kodi">Kodi</option>
                                            <option value="Lusin">Lusin</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="karyawan_1[]" class="form-control karyawan_1">
                                            <option value="" disabled selected class="text-center">
                                                Karyawan
                                                1
                                            </option>
                                            @foreach ($karyawan as $dtKaryawan)
                                                <option value="{{ $dtKaryawan->uuid }}-{{ $dtKaryawan->nama }}">
                                                    {{ $dtKaryawan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="karyawan_2[]" class="form-control karyawan_2">
                                            <option value="" disabled selected class="text-center">
                                                Karyawan
                                                2
                                            </option>
                                            @foreach ($karyawan as $dtKaryawan)
                                                <option value="{{ $dtKaryawan->uuid }}-{{ $dtKaryawan->nama }}">
                                                    {{ $dtKaryawan->nama }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="gaji[]" class="form-control gaji">
                                            <option value="" selected disabled class="text-center">
                                                Gaji</option>
                                            @foreach ($gaji as $dtGaji)
                                                <option value="{{ $dtGaji->gaji }}">
                                                    {{ $dtGaji->gaji }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>

                                    <td>
                                        <a class='btn btn-danger btn-sm del-row pull-right'>
                                            <i class='fas fa-times'></i></a>
                                    </td>
                                </tr>`
                $('#form_tbody', tab_kp).append(add_kp_row)
                getUkuranLastRow($('#ukuran').val())
                refreshS2main()
            })

            $(document).on('click', '.del-row', function(e) {
                e.preventDefault()

                $(this).closest('tr').remove()
            })

            function getUkuranLastRow(data) {
                $('#add_kain_potongan').hide()
                $.ajax({
                    @if (Auth::user()->role_id == 1)
                        url: "{{ url('surat-perintah-kerja/artikel') }}/" + data,
                    @endif
                    @if (Auth::user()->role_id == 3)
                        url: "{{ url('warehouse/surat-perintah-kerja/artikel') }}/" + data,
                    @endif
                    // url: "{{ url('surat-perintah-potong/data-spp') }}?spp='"+data+"'",
                    method: "GET",
                    success: function(res) {

                        let htmlView =
                            '<option value="" selected disabled class="text-center">Kain Potongan</option>'

                        $.each(res.kp, function(i, data) {
                            htmlView += '<option value="' + data.id + '|' + data.jenis_kain +
                                '|' + data.warna + '" class="text-center"> ' + data
                                .jenis_kain + ' | ' + data.warna + ' </option>'
                        })

                        $('td [name*="kp_id[]"]:last').html(htmlView)
                        $('#add_kain_potongan').show()
                    }
                })
            }

            $(document).on('change', '#ukuran', function(e) {
                e.preventDefault();
                let data = $('#ukuran').val();
                $.ajax({
                    @if (Auth::user()->role_id == 1)
                        url: "{{ url('surat-perintah-kerja/artikel') }}/" + data,
                    @endif
                    @if (Auth::user()->role_id == 3)
                        url: "{{ url('warehouse/surat-perintah-kerja/artikel') }}/" + data,
                    @endif
                    // url: "{{ url('surat-perintah-potong/data-spp') }}?spp='"+data+"'",
                    method: "GET",
                    success: function(res) {

                        $('#artikel').val(res.artikel);

                        let htmlView =
                            '<option value="" selected disabled class="text-center">Kain Potongan</option>'

                        $.each(res.kp, function(i, data) {
                            htmlView += '<option value="' + data.id + '|' + data
                                .jenis_kain +
                                '|' + data.warna + '" class="text-center"> ' + data
                                .jenis_kain + ' | ' + data.warna + ' </option>'
                        })

                        $('td [name*="kp_id[]"]').html(htmlView)
                    }
                })
            })

            $(document).on('change', '.kp_id', function() {
                let kp_id = $(this).val();
                let $this = $(this).closest('tr')
                $.ajax({
                    @if (Auth::user()->role_id == 1)
                        url: "{{ url('surat-perintah-kerja/hasil-potongan') }}/" + kp_id,
                    @endif
                    @if (Auth::user()->role_id == 3)
                        url: "{{ url('warehouse/surat-perintah-kerja/hasil-potongan') }}/" + kp_id,
                    @endif
                    method: "GET",
                    success: function(res) {
                        $this.find('td .sisa_stok').val(res.stok)
                    }
                })
            })

            $('#gambar').change(event => {
                if (event.target.files) {
                    let filesAmount = event.target.files.length;
                    let image = event.target.files;
                    $('.upload-img').html("");


                    var validMimeTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif',
                        'image/svg+xml'
                    ];
                    for (let i = 0; i < filesAmount; i++) {
                        if (validMimeTypes.indexOf(event.target.files[i].type) === -1) {
                            Swal.fire(
                                'Gagal!',
                                'Gambar Harus Berformat JPEG, PNG, JPG dan GIF!',
                                'error'
                            )
                            $('#gambar').val('');
                        } else {
                            let reader = new FileReader();

                            reader.onload = function(event) {
                                let html = `
                                <div class = "uploaded-img p-0">
                                    <img src = "${event.target.result}" width="100%" class="p-0">
                                </div>
                            `;
                                $(".upload-img").append(html);
                            }
                            reader.readAsDataURL(event.target.files[i]);

                            $('.upload-info-value').text(filesAmount);
                            $('.upload-img').css('padding', "0px");
                        }
                    }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
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
            var dataImage = [];

            // Simpan
            $('#btn-tambah').on('click', function() {
                let karyawan = [];
                let spk_data = [];
                let kode_spk = $('#kode_spk').val();
                let artikel = $('#artikel').val();
                let ukuran = $('#ukuran').val();
                let tanggal = $('#tanggal').val();
                let kp_id = $('[name*="kp_id[]"]')
                    .map(function() {
                        return $(this).val();
                    }).get();
                // let warnaUkuran = warna + " | " + ukuran;

                let satuan = $('[name*="satuan[]"]')
                    .map(function() {
                        return $(this).val();
                    }).get();
                let kain_potongan_dipakai = $('[name*="kain_potongan_dipakai[]"]')
                    .map(function() {
                        return $(this).val();
                    }).get();
                // let hasilSatuan = hasil + " | " + satuan;
                let k1 = $('[name*="karyawan_1[]"]')
                    .map(function() {
                        return $(this).val();
                    }).get();
                let k2 = $('[name*="karyawan_2[]"]')
                    .map(function() {
                        return $(this).val();
                    }).get();
                let gaji = $('[name*="gaji[]"]')
                    .map(function() {
                        return $(this).val();
                    }).get();



                try {
                    if (kp_id !== null && kp_id !== '' && satuan !== null && satuan !== '' && ukuran !==
                        null && ukuran !== '' && kode_spk !== null && kode_spk !== '' && k1 !== null &&
                        k1 !== '' && gaji !== null && gaji !== '' && k1 !== k2) {
                        let uuidmake = uuid();

                        for (let i = 0; i < kp_id.length; i++) {

                            if (k2 == '') {
                                var karyawan_dt = [k1[i].split('-')[0]]
                                var nm_karyawan_dt = [k1[i].split('-')[1]]
                            } else {
                                var karyawan_dt = [k1[i].split('-')[0], k2[i].split('-')[0]]
                                var nm_karyawan_dt = [k1[i].split('-')[1], k2[i].split('-')[1]]
                            }

                            data.push({
                                "uuid": uuidmake,
                                "kode_spk": kode_spk,
                                "artikel": artikel,
                                "ukuran": ukuran,
                                "tanggal": tanggal,
                                "kp_id": kp_id[i].split('|')[0],
                                "jenis_kain": kp_id[i].split('|')[1],
                                "warna": kp_id[i].split('|')[2],
                                "quantity": kain_potongan_dipakai[i],
                                "satuan": satuan[i],
                                "quantity_satuan": kain_potongan_dipakai[i] + '|' + satuan[i],
                                "karyawan": karyawan_dt,
                                "nama_karyawan": nm_karyawan_dt,
                                "gaji": gaji[i]
                            })
                        }

                        let gambarInput = document.getElementById("gambar");
                        let gambar = gambarInput.files;

                        if (gambar.length !== 0) {
                            saveGambar();
                        }

                        dataInsert(data);
                        clearForm();
                        getGambar()

                        Swal.fire(
                            'Berhasil!',
                            'Berhasil Menambahkan Data!',
                            'success'
                        )
                    } else {
                        if (k1 !== null && k2 !== null) {
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
                        'error'
                    )
                }
            })

            function dataInsert(datas) {
                extensionList = $('#tabel_insert').DataTable({
                    data: datas,
                    columnDefs: [{
                        targets: '_all',
                        className: 'middleText'
                    }],
                    columns: [{
                            data: 'kode_spk',
                            name: 'kode_spk'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'artikel',
                            name: 'artikel'
                        },
                        {
                            data: 'ukuran',
                            name: 'ukuran'
                        },
                        {
                            data: 'jenis_kain',
                            name: 'jenis_kain',
                        },
                        {
                            data: 'warna',
                            name: 'warna',
                        },
                        {
                            data: 'quantity_satuan',
                            name: 'quantity_satuan',
                        },
                        {
                            data: 'nama_karyawan',
                            name: 'nama_karyawan',
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
                MergeGridCells()
            }

            function MergeGridCells() {
                var dimension_cells = new Array();
                var dimension_col = null;
                var columnCount = $("#tabel_insert tr:first th").length;
                for (dimension_col = 0; dimension_col <= columnCount; dimension_col++) {
                    // first_instance holds the first instance of identical td
                    var first_instance = null;
                    var rowspan = 1;
                    // iterate through rows
                    $("#tabel_insert").find('tr').each(function() {

                        // find the td of the correct column (determined by the dimension_col set above)
                        var dimension_td = $(this).find('td:nth-child(' + dimension_col + ')');

                        if (first_instance === null) {
                            // must be the first row
                            first_instance = dimension_td;
                        } else if (dimension_td.text() === first_instance.text() && dimension_col < 5) {
                            // the current td is identical to the previous
                            // remove the current td
                            // dimension_td.remove();
                            dimension_td.attr('hidden', true);
                            ++rowspan;
                            // increment the rowspan attribute of the first instance
                            first_instance.attr('rowspan', rowspan);
                        } else {
                            // this cell is different from the last
                            first_instance = dimension_td;
                            rowspan = 1;
                        }
                    });
                }
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
                            let findByUuid = data.find(e => e.uuid === uuid);
                            let kode_spk = findByUuid.kode_spk;
                            let artikel = findByUuid.artikel;

                            if (check !== -1) {
                                data.splice(check, 1)
                            }

                            findByUuid = data.find(e => (e.kode_spk === kode_spk && e.artikel ===
                                artikel));
                            let length = findByUuid ? findByUuid.length : 0;

                            if (length === 0) {
                                @if (Auth::user()->role_id == 1)
                                    let _url =
                                        "{{ route('spk.deleteBySPKArtikelGambar', ['kode_spk', 'artikel']) }}";
                                    _url = _url.replace('kode_spk', kode_spk)
                                    _url = _url.replace('artikel', artikel)
                                @endif

                                $.ajax({
                                    url: _url,
                                    method: "DELETE",
                                    success: function(res) {
                                        getGambar()
                                        if (res.code === 200) {
                                            Swal.fire(
                                                'Berhasil!',
                                                'Berhasil Hapus Gambar!',
                                                'success'
                                            )
                                        }
                                        if (res.code === 500) {
                                            console.log(res.error)
                                            Swal.fire(
                                                'Gagal!',
                                                'Server Error!',
                                                'error'
                                            )
                                        }
                                    },
                                    error: function(err) {
                                        console.log(err);
                                        Swal.fire(
                                            'Gagal!',
                                            'Server Error!',
                                            'error'
                                        )
                                    }
                                })
                            }

                            dataInsert(data);
                            getGambar();
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
                $('[name*="kp_id" ]').val('').trigger('change.select2');
                $('[name*="satuan" ]').val('').trigger('change.select2');
                $('[name*="sisa_stok"]').val('');
                $('[name*="ukuran" ]').val('').trigger('change.select2');
                $('[name*="artikel"]').val('');
                $('[name*="kain_potongan_dipakai"]').val('0');
                $('[name*="karyawan_1"]').val('').trigger('change.select2');
                $('[name*="karyawan_2"]').val('').trigger('change.select2');
                $('[name*="gaji"]').val('').trigger('change.select2');
                $('#gambar').val('');
                $('.uploaded-img').remove();
            }

            // edit data table
            $('#tabel_insert').on('click', '#edit-data', function() {
                let uuid = $(this).data('uuid');
                let dt_detail = data.find(dt => dt.uuid === uuid)
                $('#ukuran').val(dt_detail.ukuran).change();
                $('#tanggal').val(dt_detail.tanggal);
                $('#artikel').val(dt_detail.artikel);
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
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                        'content')
                                }
                            });

                            $.ajax({
                                @if (Auth::user()->role_id == 1)
                                    url: "{{ route('spk.store') }}",
                                @endif
                                @if (Auth::user()->role_id == 3)
                                    url: "{{ route('w.spk.store') }}",
                                @endif
                                method: "POST",
                                data: {
                                    'data': data,
                                    'notes': $('#note').val()
                                },
                                success: function(res) {
                                    if (res.code === 200) {
                                        data = [];
                                        $('#btn-tambah').attr('disabled', true);
                                        $('#btn-save-data').attr('disabled', true);

                                        setTimeout(() => {
                                            window.location.href =
                                                "{{ route('spk') }}"
                                        }, 1500);
                                    }
                                    if (res.code === 400) {
                                        Swal.fire(
                                            'Gagal!',
                                            res.message + ' ID: ' + res.ID,
                                            'error'
                                        )
                                    }
                                    if (res.code === 500) {
                                        console.log(res.error)
                                        Swal.fire(
                                            'Gagal!',
                                            'Server Error!',
                                            'error'
                                        )
                                    }
                                },
                                error: function(err) {
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
            function saveGambar() {
                let artikel = $('#artikel').val()
                let kode_spk = $('#kode_spk').val()

                let gambarInput = document.getElementById("gambar");
                let gambar = gambarInput.files;

                let formData = new FormData()
                for (var i = 0; i < gambar.length; i++) {
                    formData.append('gambar[]', gambar[i])
                }
                formData.append('artikel', artikel)
                formData.append('kode_spk', kode_spk)

                $.ajax({
                    @if (Auth::user()->role_id == 1)
                        url: "{{ route('spk.storeGambar') }}",
                    @endif
                    @if (Auth::user()->role_id == 3)
                        url: "{{ route('w.spk.storeGambar') }}",
                    @endif
                    method: "POST",
                    data: formData,
                    processData: false,
                    cache: false,
                    contentType: false,
                    success: function(res) {
                        getGambar()
                        if (res.code === 200) {
                            Swal.fire(
                                'Berhasil!',
                                'Berhasil Simpan Data!',
                                'success'
                            )
                        }
                        if (res.code === 400) {
                            Swal.fire(
                                'Gagal!',
                                res.message + ' LOT: ' + res.kode_lot,
                                'error'
                            )
                        }
                        if (res.code === 500) {
                            console.log(res.error)
                            Swal.fire(
                                'Gagal!',
                                'Server Error!',
                                'error'
                            )
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        Swal.fire(
                            'Gagal!',
                            'Server Error!',
                            'error'
                        )
                    }
                })
            }

            getGambar()
            // get Gambar
            function getGambar() {
                let kode_spk = $('#kode_spk').val()
                let formData = new FormData()
                formData.append('kode_spk', kode_spk)

                $.ajax({
                    @if (Auth::user()->role_id == 1)
                        url: "{{ route('spk.getGambar') }}",
                    @endif
                    @if (Auth::user()->role_id == 3)
                        url: "{{ route('spk.getGambar') }}",
                    @endif
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(res) {
                        let dataImages = res.data;
                        let html = '';
                        $('.uploaded-img').remove();
                        for (let i = 0; i < dataImages.length; i++) {
                            html += `<div class="col-md-4 p-0 uploaded-img">
                                        <div class="col-md-6">
                                            <p>Artikel: <span>` + dataImages[i].artikel + `</span></p>
                                            <img src="{{ url('/img/gambar') }}/` + dataImages[i].nama_foto + `"
                                            width="300" class="text-center">
                                        </div>
                                </div>`;
                        }
                        $(".upload-img2").append(html);
                    },
                    error: function(err) {
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
    </script>
@endsection
