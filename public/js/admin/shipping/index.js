$(document).ready(function () {

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

    var table = $('#table-data').DataTable( {
        "ajax": $('#inp-url-index-content').val(),
        "processing": true,
        "columns": [
            { "data": "branch.name" },
            {"data": "branch.address.FullAddress"},
            {"data": "shipping_address.FullAddress"},
            {"data": "created_at"},
            {
                "data": "id",
                render:function(data)
                {
                    var $inpUrlUpdate = $('#inp-url-update');
                    if ($inpUrlUpdate.length === 0) {
                        return '';
                    }

                    var url = $inpUrlUpdate.val();
                    url = url.replace('FAKE_ID', data);

                    var $inpUrlDelete = $('#inp-url-delete');
                    if ($inpUrlDelete.length === 0) {
                        return '';
                    }

                    var url2 = $inpUrlDelete.val();
                    url2 = url2.replace('FAKE_ID', data);

                    return "<a href='"+url+"' title='Editar' data-toggle='tooltip' class='update-btn' style='color: #2B6699'><span class='far fa-edit'></span></a>" +
                        "&nbsp;&nbsp;&nbsp;<a href='"+url2+"' title='Eliminar' data-toggle='tooltip' class='delete-btn' style='color: #2B6699'><span class='fas fa-trash'></span></a>";
                },
                "targets": -1
            },
            {
                "data": null,
                render:function(data, type, row )
                {
                    var $inpUrlShow = $('#inp-url-active');
                    if ($inpUrlShow.length === 0) {
                        return '';
                    }

                    var url = $inpUrlShow.val();
                    url = url.replace('FAKE_ID', data.id);
                    var active = data.active ? 'on' : 'off';
                    return "<a href='"+url+"' class='active-btn' style='color: #2B6699'><span class='fas fa-toggle-"+active+"''></span></a>";
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
});
