$(document).ready(function () {

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

    var table = $('#table-data').DataTable( {
        "ajax": $('#inp-url-index-contentTableMovements').val(),
        "processing": true,
        "columns": [
            {
                "data": "type",
                render:function(data)
                {
                    return data ? 'Positivo' : 'Negativo';
                }
            },
            { "data": "comment" },
            { "data": "quantity" },
            {
                "data": "user",
                render:function(data)
                {
                    return data !== null ? data.name : 'Sistema';
                }
            },
            { "data": "created_at" },
        ],
        "language": {
            "search": "Buscar: ",
            "zeroRecords": "No se encontró ningún registro.",
            "info": "Total de movimientos: <strong>_TOTAL_</strong>",
            infoEmpty: "Sin datos disponibles",
            emptyTable: "No se ha encontrado ningún registro.",
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> ',
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "Mostrar _MENU_ movimientos"
        },
        "ordering": false

    });

});
