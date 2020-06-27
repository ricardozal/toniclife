$(document).ready(function () {

    // let tree = {
    //     1: {
    //         2: '',
    //         3: {
    //             6: '',
    //             7: '',
    //         },
    //         4: '',
    //         5: ''
    //     },
    // };
    // //
    // // let treeParams = {
    // //     1: {trad: 'Card 1'},
    // //     2: {trad: 'Card 2'},
    // //     3: {trad: 'Card 3'},
    // //     4: {trad: 'Card 4'},
    // //     5: {trad: 'Card 5'},
    // //     6: {trad: 'Card 6'},
    // //     7: {trad: 'Card 7'},
    // // };
    //
    //
    //
    $.ajax({
        type: "POST",
        url: $('#inp-url-index-content').val(),
        data: {_token: $('#inp-url-csrf').val()},
        success: function(data)
        {

            console.log(data)
        },error: function (data) {
            console.log(data);
        }
    });


});
