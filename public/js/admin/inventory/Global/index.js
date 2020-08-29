$(document).ready(function () {

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

    var table = $('#table-data').DataTable( {
        "ajax": $('#inp-url-index-content').val(),
        "processing": true,
        "columns": [
            { "data": "code" },
            { "data": "product_name" },
            { "data": "country_name" },
            { "data": "TOTAL" },
            {
                "data": "fk_id_product",
                render:function(data)
                {
                    var $inpUrlShow = $('#inp-url-show');
                    if ($inpUrlShow.length === 0) {
                        return '';
                    }

                    var url = $inpUrlShow.val();
                    url = url.replace('FAKE_ID', data);

                    return "<a href='"+url+"' title='Ver detalles' data-toggle='tooltip' class='show-btn' style='color: #2B6699'><span class='fas fa-info-circle'></span></a>";
                },
                "targets": -1
            },
            {
                "data": "fk_id_product",
                render:function(data)
                {
                    var $inpUrlShowMovements = $('#inp-url-showMovements');
                    if ($inpUrlShowMovements.length === 0) {
                        return '';
                    }

                    var url = $inpUrlShowMovements.val();
                    url = url.replace('FAKE_ID', data);


                    return "<a href='"+url+"' title='Ver movimientos' data-toggle='tooltip' class='show-btnMov' style='color: #2B6699'><span class='fas fa-truck-moving'></span></a>";
                },
                "targets": -1
            },
            {
                "data": "fk_id_product",
                render:function(data)
                {
                    var $inpUrlShowbranchToBranch = $('#inp-url-branchToBranch');
                    if ($inpUrlShowbranchToBranch.length === 0) {
                        return '';
                    }

                    var url = $inpUrlShowbranchToBranch.val();
                    url = url.replace('FAKE_ID', data);


                    return "<a href='"+url+"' title='Realizar movimiento' data-toggle='tooltip' class='insert-btn' style='color: #2B6699'><span class='fas fa-store'></span></a>";
                },
                "targets": -1
            },

        ],
        "language": {
            "search": "Buscar: ",
            "zeroRecords": "No se encontró ningún registro.",
            "info": "Total de productos en inventario: <strong>_TOTAL_</strong>",
            infoEmpty: "Sin datos disponibles",
            emptyTable: "No se ha encontrado ningún registro.",
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> ',
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "Mostrar _MENU_ productos",
            "infoFiltered": "(filtrado de _MAX_ registros totales)"
        },
        "ordering": false

    });

    $(document).on('click', '.show-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        modalTools.renderView('modal-upsert', url, true,function () {

        });
    });

    $(document).on('click', '.insert-btn', function (e) {
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

