$(document).ready(function () {
    // this function loads new orders and places them here
    checkOrder();
    //  Option manage client
    $('#mynav .dropdown:eq(0) ul li:eq(1) a').click(function () {
        LoadClients();
    });
});

function checkOrder() {
    var spin = '<i class="fa fa-pulse fa-refresh"></i>';
    $('#mynav .myOrderBadge').html(spin);
    $.post('AjaxPhp/simpleQuery.php',
            {
                cat: 'checkOrder'
            },
            function (data, status) {
                $('#mynav .myOrderBadge').html(data);
            });
}

function LoadClients() {
    $.get('widgets/@manageOrders.html', function (data, status) {
        $('#mainDivDboard').html(data);
        //asign click listeners here also
        /*
         *1.  New Orders Click Registration 
         */
        $('#orderManagement li:eq(0) a').click(function () {
            loadNewOrders();
        });
        $('#orderManagement li:eq(1),#orderManagement li:eq(1) a').click(function () {
            loadPendingOrders();
        });
        $('#orderManagement li:eq(2),#orderManagement li:eq(2) a').click(function () {
            loadClosedOrders();
        });
    });


}

function loadNewOrders() {
    $.get('widgets/Orders/newOrders.html', function (data, status) {
        $('#holder').html(data);
    });
}

function loadPendingOrders() {
    $.get('widgets/Orders/pendingOrders.html', function (data, status) {
        $('#holder').html(data);
    });
}

function loadClosedOrders() {
    $.get('widgets/Orders/closedOrders.html', function (data, status) {
        $('#holder').html(data);
    });
}