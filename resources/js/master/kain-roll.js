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

getKainRoll()

function getKainRoll() {
    var htmlview
    $.ajax({
        url: "{{ route('kain_roll.data') }}",
        type: 'GET',
        success: function(res) {
            $('tbody').html('')
            $.each(res, function(i, data) {
                htmlview += `<tr>
                <td style="text-align: center;">` + data.id + `</td>
                <td>` + data.kode_lot + `</td>
                <td>` + data.jenis_kain + `</td>
                <td style='text-align: right;'>` + data.berat + ` kg</td>
                <td>` + data.warna + `</td>
                <td>
                  <button class="btn btn-info btn-sm" title="Edit Data!" onClick="detailKainRoll('` + data
                    .uuid + `')"> <i class="fas fa-pencil-alt"></i>
                  </button>
                  <button class="btn btn-danger btn-sm" title="Delete Data!" onClick="deleteKainRoll('` + data
                    .uuid + `')"> <i class="fas fa-trash"></i>
                  </button>
                </td>
               </tr>`
            });

            $('tbody').html(htmlview)
            $("#tbl_kain_roll").DataTable(dtTableOption).buttons().container().appendTo(
                '#tbl_kain_roll_wrapper .col-md-6:eq(0)')
        }
    })
}

function addKainRoll() {
    $.ajax({
        url: "{{ route('kain_roll.add') }}",
        type: "POST",
        data: $('#formAddKainRoll').serialize(),
        dataType: 'json',
        success: function(res) {
            if (res.code == 200) {
                $('#formAddKainRoll').trigger('reset')
                $('#modalAddKainRoll').modal('hide')

                Notif.fire({
                    icon: 'success',
                    title: res.message,
                })
                $("#tbl_kain_roll").DataTable().destroy();
                getKainRoll()
            }
        },
        error: function(err) {
            Notif.fire({
                icon: 'error',
                title: 'Gagal Menyimpan Data Kain Roll',
            });

            $.each(err.responseJSON.errors, function(i, error) {
                var el = $('#formAddKainRoll').find('[name="' + i + '"]');
                el.addClass('is-invalid');
                el.after('<div class="invalid-feedback">' + error[0] + '</div>');
            });
        }
    })
}

function detailKainRoll(id) {
    var _url = "{{ route('kain_roll.detail', ':id') }}"
    _url = _url.replace(':id', id)

    $.ajax({
        url: _url,
        type: 'GET',
        success: function(res) {
            $('#modalEditKainRoll').modal('show')
            $('#formEditKainRoll').attr("data-id", id)
            $.each(res, function(i, data) {
                var el = $('#formEditKainRoll').find('[name="' + i + '"]');
                el.val(data);
            })
        }
    })
}

function updateKainRoll() {
    var id = $('#formEditKainRoll').data('id')
    var _url = "{{ route('kain_roll.update', ':id') }}"
    _url = _url.replace(':id', id)

    $.ajax({
        url: _url,
        type: 'PUT',
        data: $('#formEditKainRoll').serialize(),
        dataType: 'json',
        success: function(res) {
            if (res.code == 200) {
                $('#formEditKainRoll').trigger('reset')
                $('#modalEditKainRoll').modal('hide')

                Notif.fire({
                    icon: 'success',
                    title: res.message,
                })
                $("#tbl_kain_roll").DataTable().destroy();
                getKainRoll()
            }
        },
        error: function(err) {
            Notif.fire({
                icon: 'error',
                title: 'Gagal Menyimpan Data Kain Roll',
            });

            $.each(err.responseJSON.errors, function(i, error) {
                var el = $('#formEditKainRoll').find('[name="' + i + '"]');
                el.addClass('is-invalid');
                el.after('<div class="invalid-feedback">' + error[0] + '</div>');
            });
        }
    })
}

$('#tambahData').on('click', function(e) {
    e.preventDefault()
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    addKainRoll()
})

$('#simpanData').on('click', function(e) {
    e.preventDefault()
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    updateKainRoll()
})

function deleteKainRoll(id) {
    Swal.fire({
            title: "Apakah anda yakin hapus data ini?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak",
        })
        .then((result) => {
            if (result.isConfirmed) {
                var _url = "{{ route('kain_roll.delete', ':id') }}";
                _url = _url.replace(':id', id)
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
                        $("#tbl_kain_roll").DataTable().destroy();
                        getKainRoll();
                    },
                    error: function(err) {
                        console.log(err);
                    }
                })
            }
        });
}