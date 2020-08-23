$(document).ready(function () {

    $("#tree").jHTree({
        callType: 'url',
        url: $('#inp-url-index-content').val(),
        zoomer: false,
        nodeDropComplete: function (event, data) {
        },
        doneLoaded: function () {
            $('.fa-3x').addClass('d-none');
            $('#tree').removeClass('d-none');
        }
    });

});
