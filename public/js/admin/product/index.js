$(document).ready(function () {

    $("body").tooltip({ selector: '[data-toggle=tooltip]' });
    const fileInpId = 'inp-image';
    const fileInpMsgId = 'lbl-image';

    var table = $('#table-data').DataTable( {
        "ajax": $('#inp-url-index-content').val(),
        "processing": true,
        "columns": [
            { "data": "code" },
            { "data": "name" },
            {
                "data": null,
                render:function(data)
                {
                    return formatterMoney.format(data.distributor_price);
                },
            },
            {
                "data": null,
                render:function(data)
                {
                    var tax = (data.country.tax_percentage*0.01)*data.distributor_price;
                    return formatterMoney.format(tax);
                },
            },
            { "data": "points" },
            { "data": "country.name" },
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

                    var $inpUrlImage = $('#inp-url-image');
                    if ($inpUrlImage.length === 0) {
                        return '';
                    }

                    var urlImg = $inpUrlImage.val();
                    urlImg = urlImg.replace('FAKE_ID', data);

                    return "<a href='"+url+"' title='Editar' data-toggle='tooltip' class='update-btn' style='color: #2B6699'><span class='far fa-edit'></span></a>" +
                           "&nbsp;&nbsp;&nbsp;<a href='"+urlImg+"' title='Ver foto del producto' data-toggle='tooltip' class='watch-image-btn' style='color: #2B6699'><span class='fas fa-image'></span></a>";
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
            "info": "Total de productos: <strong>_TOTAL_</strong>",
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

    $(document).on('click', '#create-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        modalTools.renderView('modal-upsert', url, true,function () {
            formTools.useAjaxOnSubmit('form-upsert', function () {
                $('#modal-upsert').modal('hide');
                table.ajax.reload();
            });
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

    $(document).on('click', '.watch-image-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        modalTools.renderView('modal-upsert', url, true,function () {

        });
    });

    $(document).on('click', '.active-btn', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        var option = $(this).children().hasClass('fa-toggle-on') ? 'desactivar' : 'activar';
        var optionContra = !$(this).children().hasClass('fa-toggle-on') ? 'desactivar' : 'activar';
        var preValue = $(this).children().hasClass('fa-toggle-on');
        var $this = $(this);

        Swal.fire({
            title: '¿Desea '+option+' al producto?',
            text: 'Podrá '+optionContra+' en cualquier momento',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: option,
            cancelButtonText: 'cancelar'
        }).then((result) => {
            if (result.value) {

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
                                preValue ? 'Desactivado' : 'Activado',
                                'El producto fue '+(preValue ? 'desactivado' : 'activado')+'.',
                                'success'
                            );
                        }
                    },
                    complete: function () {
                        $this.children().removeClass('fa');
                        $this.children().removeClass('fa-spinner');
                        $this.children().removeClass('fa-spin');
                        if (preValue){
                            $this.children().addClass('fas');
                            $this.children().addClass('fa-toggle-off');
                        } else{
                            $this.children().addClass('fas');
                            $this.children().addClass('fa-toggle-on');
                        }
                    }
                });

            }
        })
    });

    //Input File
    $(document).on('change', '#' + fileInpId, function () {
        let msg = $('#' + fileInpId).val().substr(12);
        console.log(msg);
        $('#' + fileInpMsgId).text(msg);
    });

    const formatterMoney = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'USD',
        minimumFractionDigits: 2
    });

});
