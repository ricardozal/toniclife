$(document).ready(function () {

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });

    var table = $('#table-data').DataTable( {
        "ajax": $('#inp-url-index-content').val(),
        "processing": true,
        "columns": [
            { "data": "code" },
            { "data": "name" },
            { "data": "pivot.stock" },
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

        ],
        "language": {
            "search": "Buscar: ",
            "zeroRecords": "No se encontró ningún registro.",
            "info": "Total de inventario: <strong>_TOTAL_</strong>",
            infoEmpty: "Sin datos disponibles",
            emptyTable: "No se ha encontrado ningún registro.",
            processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i> ',
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "lengthMenu": "Mostrar _MENU_ productos"
        },
        "ordering": false

    });

    $(document).on('click', '#create-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        modalTools.renderView('modal-upsert', url, true,function () {
            makeAutocompleteProducts();
            formTools.useAjaxOnSubmit('form-upsert', function () {
                $('#modal-upsert').modal('hide');
                table.ajax.reload();
            });
        });
    });

    $(document).on('click', '.update-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        modalTools.renderView('modal-update', url, true,function () {
            formTools.useAjaxOnSubmit('form-update', function () {
                $('#modal-update').modal('hide');
                table.ajax.reload();
            });
        });
    });

    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        Swal.fire({
            title: '¿Estás seguro de eliminar permanentemente?',
            text: "No podrá revertir esta acción!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, Borrarlo!'
        }).then((result) => {
            if (result.value) {

                $.get( url, function( response ) {
                    if(response.success)
                    {
                        table.ajax.reload();
                        Swal.fire(
                            'stock eliminado!',
                            'Ha eliminado el stock del producto.',
                            'success'
                        );
                    }
                });

            }
        })
    });

    function makeAutocompleteProducts(){

        var $inpItem = $('#name');
        var url = $('#inp-url-product-search').val();

        $inpItem.autocomplete({
            serviceUrl: url,
            onSelect: function (suggestion) {
                $('#fk_id_product').val(suggestion.id);
                $inpItem.val(suggestion.value);
            }
        });
    }



});
