$(document).ready(function () {

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
    const fileInpId = 'inp-pdf';
    const fileInpMsgId = 'lbl-pdf';

    var table = $('#table-data').DataTable( {
        "ajax": $('#inp-url-index-content').val(),
        "processing": true,
        "columns": [
            { "data": "name" },
            { "data": "type" },
            {
                "data": null,
                render:function(data, type, row )
                {
                    const icon = data.type === 'pdf' ? 'far fa-file-pdf' : 'fas fa-external-link-alt';

                    const url = data.url !== null ? (data.type === 'pdf' ? data.absolute_url : data.url) : '#';
                    const blank = data.url !== null ? 'target=\'_blank\'' : '';

                    return "<a href='"+url+"' "+blank+" style='color: #2B6699'><span class='"+icon+"''></span></a>";
                },
                "targets": -1
            },
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

                    return "<a href='"+url+"' title='Modificar' data-toggle='tooltip' class='update-btn' style='color: #2B6699'><span class='fas fa-exchange-alt'></span></a>";
                },
                "targets": -1
            },
        ],
        "language": {
            "search": "Buscar: ",
            "zeroRecords": "No se encontró ningún registro.",
            "info": "Total de enlaces: <strong>_TOTAL_</strong>",
            infoEmpty: "Sin datos disponibles",
            emptyTable: "No se ha encontrado ningún registro.",
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> ',
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "Mostrar _MENU_ enlaces",
            "infoFiltered": "(filtrado de _MAX_ registros totales)"
        },
        "ordering": false
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

    //Input File
    $(document).on('change', '#' + fileInpId, function () {
        let msg = $('#' + fileInpId).val().substr(12);
        console.log(msg);
        $('#' + fileInpMsgId).text(msg);
    });

});
