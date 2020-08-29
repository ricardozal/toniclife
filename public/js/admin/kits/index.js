$(document).ready(function () {

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

    var table = $('#table-data').DataTable( {
        "ajax": $('#inp-url-index-content').val(),
        "processing": true,
        "columns": [
            { "data": "name" },
            { "data": "email" },
            {"data": "order.distributor.name"},
            {"data": "order.distributor.tonic_life_id"},
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

                    return "<a href='"+url+"' title='Información' data-toggle='tooltip' class='show-btn' style='color: #2B6699'><span class='fas fa-info-circle'></span></a>";
                },
                "targets": -1
            },
            {
                "data": "id",
                render:function(data)
                {
                    var $inpUrlShowTicket = $('#inp-url-showTicket');
                    if ($inpUrlShowTicket.length === 0) {
                        return '';
                    }

                    var url = $inpUrlShowTicket.val();
                    url = url.replace('FAKE_ID', data);


                    return "<a href='"+url+"' title='Ver ticket' data-toggle='tooltip' class='show-btnT' style='color: #2B6699'><span class='fas fa-ticket-alt'></span></a>";
                },
                "targets": -1
            },
        ],
        "language": {
            "search": "Buscar: ",
            "zeroRecords": "No se encontró ningún registro.",
            "info": "Total de kits: <strong>_TOTAL_</strong>",
            infoEmpty: "Sin datos disponibles",
            emptyTable: "No se ha encontrado ningún registro.",
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> ',
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "Mostrar _MENU_ kits",
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

    $(document).on('click', '.show-btnT', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        modalTools.renderView('modal-upsert', url, true,function () {

        });
    });
});
