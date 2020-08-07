$(document).ready(function () {

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

    var table = $('#table-data').DataTable( {
        "ajax": $('#inp-url-index-content').val(),
        "processing": true,
        "columns": [
            { "data": "branch.name" },
            {"data": "branch.address.FullAddress"},
            {"data": "shipping_address.FullAddress"},
            {"data": "id"},
            {"data": "created_at"},
            {"data": "guide_number.guide_number_data"},
            {"data": "status.name"},
            {
                "data": "id",
                render:function(data)
                {
                    var $inpUrl = $('#inp-url-shipping');
                    if ($inpUrl.length === 0) {
                        return '';
                    }

                    var url = $inpUrl.val();
                    url = url.replace('FAKE_ID', data);

                    var $inpUrlShow = $('#inp-url-show');
                    if ($inpUrlShow.length === 0) {
                        return '';
                    }

                    var urlTicket = $inpUrlShow.val();
                    urlTicket = urlTicket.replace('FAKE_ID', data);

                    return "<a href='"+url+"' title='Número de Guía' data-toggle='tooltip' class='guide-number-btn' style='color: #2B6699'><span class='fas fa-shipping-fast'></span></a>&nbsp;&nbsp;&nbsp;"+
                           "<a href='"+urlTicket+"' title='Ver ticket' data-toggle='tooltip' class='show-btn' style='color: #2B6699'><span class='far fa-eye'></span></a>";
                },
                "targets": -1
            },
        ],
        "language": {
            "search": "Buscar: ",
            "zeroRecords": "No se encontró ningún registro.",
            "info": "Total de envíos: <strong>_TOTAL_</strong>",
            infoEmpty: "Sin datos disponibles",
            emptyTable: "No se ha encontrado ningún registro.",
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> ',
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "Mostrar _MENU_ envíos"
        },
        "ordering": false
    });

    $(document).on('click', '.guide-number-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        modalTools.renderView('modal-upsert', url, true,function () {
            formTools.useAjaxOnSubmit('form-upsert', function () {
                $('#modal-upsert').modal('hide');
                table.ajax.reload();
            });
        });
    });

    $(document).on('click', '.show-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        modalTools.renderView('modal-upsert', url, true,function () {

        });
    });

});
