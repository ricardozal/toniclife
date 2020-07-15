$(document).ready(function () {

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

    var table = $('#table-data').DataTable( {
        "ajax": $('#inp-url-index-content').val(),
        "processing": true,
        "columns": [
            { "data": "branch.name" },
            {"data": "distributor.name"},
            {"data": "id"},
            {"data": "created_at"},
            {"data": "status.name"},
            {
                "data": "id",
                render:function(data)
                {
                    var $inpUrlShow = $('#inp-url-show');
                    if ($inpUrlShow.length === 0) {
                        return '';
                    }

                    var url = $inpUrlShow.val();
                    url = url.replace('FAKE_ID', data);

                    return "<a href='"+url+"' title='Ver ticket' data-toggle='tooltip' class='show-btn' style='color: #2B6699'><span class='far fa-eye'></span></a>";
                },
                "targets": -1
            },
            {
                "data": "id",
                render:function(data)
                {
                    var $inpUrlShowUpdateStatus = $('#inp-url-status');
                    if ($inpUrlShowUpdateStatus.length === 0) {
                        return '';
                    }

                    var url = $inpUrlShowUpdateStatus.val();
                    url = url.replace('FAKE_ID', data);

                    return "<a href='"+url+"' title='Cambiar status' data-toggle='tooltip' class='update-btn' style='color: #2B6699'><span class='fas fa-exchange-alt'></span></a>";
                },
                "targets": -1
            },
        ],
        "language": {
            "search": "Buscar: ",
            "zeroRecords": "No se encontró ningún registro.",
            "info": "Total de sucursales: <strong>_TOTAL_</strong>",
            infoEmpty: "Sin datos disponibles",
            emptyTable: "No se ha encontrado ningún registro.",
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> ',
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "Mostrar _MENU_ usuarios"
        },
        "ordering": false
    });

    $(document).on('click', '.show-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        modalTools.renderView('modal-upsert', url, true,function () {

        });
    });

    $(document).on('click', '.update-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        modalTools.renderView('modal-upsert', url, true,function () {
            formTools.useAjaxOnSubmit('form-upsert', function () {
                $('#modal-upsert').modal('hide');
                table.ajax.reload();
            });
        });
    });
});
