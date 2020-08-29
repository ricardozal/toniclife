$(document).ready(function () {

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

    var table = $('#table-data').DataTable( {
        "ajax": $('#inp-url-index-content').val(),
        "processing": true,
        "columns": [
            { "data": "branch.name" },
            {"data": "distributor.name"},
            {"data": "id"},
            {"data": "format_date"},
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
                "data": null,
                render:function(data, type, row )
                {
                    var $inpUrlShowUpdateStatus = $('#inp-url-deliver');
                    if ($inpUrlShowUpdateStatus.length === 0) {
                        return '';
                    }

                    var url = $inpUrlShowUpdateStatus.val();
                    url = url.replace('FAKE_ID', data.id);

                    var ret = "<a href='"+url+"' title='Entregar' data-toggle='tooltip' class='deliver-btn' style='color: #2B6699'><span class='fas fa-box-open'></span></a>";
                    var check = "<span title='Entregado' data-toggle='tooltip' style='color: #2B6699'><i class='fas fa-check'></i></span>";
                    return data.fk_id_order_status !== 3 ? ret : check;
                },
                "targets": -1
            },
        ],
        "language": {
            "search": "Buscar: ",
            "zeroRecords": "No se encontró ningún registro.",
            "info": "Total de entregas: <strong>_TOTAL_</strong>",
            infoEmpty: "Sin datos disponibles",
            emptyTable: "No se ha encontrado ningún registro.",
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> ',
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "Mostrar _MENU_ entregas",
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

    $(document).on('click', '.deliver-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        var $this = $(this);

        $.ajax({
            url: url,
            beforeSend: function(){
                $this.children().removeClass('fa-toggle-on');
                $this.children().removeClass('fa-toggle-off');
                $this.children().removeClass('fas');
                $this.children().addClass('fa');
                $this.children().addClass('fa-spinner');
                $this.children().addClass('fa-spin');
            },
            success: function (response) {
                if(response.success)
                {
                    Swal.fire(
                        'Produtos entregados',
                        'Los productos han sido entregados al distribuidor',
                        'success'
                    );
                    table.ajax.reload();
                } else {
                    Swal.fire(
                        'Algo salió mal',
                        response.message,
                        'error'
                    );
                }
            },
            error: function () {
                Swal.fire(
                    'Algo salió mal',
                    'Inténtelo de nuevo más tarde',
                    'error'
                );
            }
        });

    });


});
