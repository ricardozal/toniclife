$(document).ready(function () {

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

    var table = $('#table-data').DataTable({
        "ajax": $('#inp-url-index-content').val(),
        "processing": true,
        "columns": [
            {"data": "distributor.name"},
            {"data": "payment_method.name"},
            { "data": "format_date" },
            {
                "data": null,
                render:function(data)
                {
                    return formatterMoney.format(data.total_price);
                },
            },
            { "data": "status.name" },
            {
                "data": null,
                render:function(data, type, row )
                {
                    return data.fk_id_shipping_address !== null ? data.shipping_address.FullAddress : 'Recoger en sucursal';
                },
            },
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
        ],
        "language": {
            "search": "Buscar: ",
            "zeroRecords": "No se encontró ningún registro.",
            "info": "Total de ordenes de compra: <strong>_TOTAL_</strong>",
            infoEmpty: "Sin datos disponibles",
            emptyTable: "No se ha encontrado ningún registro.",
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> ',
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "Mostrar _MENU_order",
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

    const formatterMoney = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    });

});
