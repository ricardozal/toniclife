$(document).ready(function () {

    $(document).on('click', '.local-inventory', function () {

        $('#modal-menu-inv').modal('show');

    });

    $(document).on('click', '.select-branch', function ()
    {
        var data = $('#fk_id_branch').val();

        if(data === '0')
        {
            $('#modal-menu-inv').modal('hide');
            Swal.fire({
                icon: 'error',
                title: 'Ups...',
                text: 'Debe elegir una sucursal para poder avanzar'
            })
        }else{
            var $inpUrl= $('#inp-url-inventory-local');
            if ($inpUrl.length === 0) {
                return '';
            }

            var url = $inpUrl.val();
            url = url.replace('FAKE_ID', data);

            window.location.href = url;
        }



    });

});
