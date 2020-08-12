$(document).ready(function () {

    $("#tree").jHTree({
        callType: 'url',
        url: $('#inp-url-index-content').val(),
        zoomer: false,
        nodeDropComplete: function (event, data) {
            //----- Do Something @ Server side or client side -----------
            //alert("Node ID: " + data.nodeId + " Parent Node ID: " + data.parentNodeId);
            //-----------------------------------------------------------
        }
    });

});
