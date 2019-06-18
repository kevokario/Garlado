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
loader($('#mainDivDboard'));
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
loader($('#holder'));
        $.get('widgets/Orders/newOrders.html', function (data, status) {
        $('#holder').html(data);
                loadOrders();
        });
        }

function loadPendingOrders() {
loader($('#holder'));
        $.get('widgets/Orders/pendingOrders.html', function (data, status) {
        $('#holder').html(data);
        });
        }

function loadClosedOrders() {
loader($('#holder'));
        $.get('widgets/Orders/closedOrders.html', function (data, status) {
        $('#holder').html(data);
        });
        }

function loader(div) {
$(div).html('<p class="text-center" style="margin-bottom:0; margin: 10px"><i class="fa fa-pulse fa-refresh"></i></p>');
        }
;
        function loadOrders() {
        loader($('#newOrderList'));
                $.post('AjaxPhp/simpleQuery.php',
                {
                cat: 'loadNewOrders'
                },
                        function (data, status) {
                        $('#newOrderList').html(data);
                                $('#newOrderList tr button').click(function(){
                        var orderNumber = $(this).parent().parent().children('td:eq(1)').text();
                                openOrder(orderNumber);
                        });
                        }
                );
                }

//this function registers click function to button on new orders table!

function openOrder(str){
$.post('AjaxPhp/simpleQuery.php', {
cat:'getOrderItems',
        orderNumber:str.trim()
}, function(data, status){
//        test(data);
var url = "https://maps.google.com/maps?q=quest%20website%20developers&t=&z=13&ie=UTF8&iwloc=&output=embed";
        var urldest = "https://www.google.com/maps/embed/v1/directions?origin=40.7127837,-74.0059413&destination=42.3600825,-71.05888&key=AIzaSyDzlJ68ZHuGRQ6eFfFtGFwNchJG98CRE-g";
        $('#openOrdersModal #iframe').attr('src', urldest);
        $('#openOrdersModal').modal('show');
});
        }