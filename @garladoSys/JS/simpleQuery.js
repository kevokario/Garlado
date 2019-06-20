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
                $('#newOrderList tr button').click(function () {
                    var orderNumber = $(this).parent().parent().children('td:eq(1)').text();
                    openOrder(orderNumber);
                });
            }
    );
}

//this function registers click function to button on new orders table!

function openOrder(str) {
    $.post('AjaxPhp/simpleQuery.php', {
        cat: 'getOrderItems',
        orderNumber: str.trim()
    }, function (data, status) {
//        test(data);
//        var url = "https://maps.google.com/maps?q=quest%20website%20developers&t=&z=13&ie=UTF8&iwloc=&output=embed";
//        var urldest = "https://www.google.com/maps/embed/v1/directions?origin=40.7127837,-74.0059413&destination=42.3600825,-71.05888&key=AIzaSyDzlJ68ZHuGRQ6eFfFtGFwNchJG98CRE-g";
//        $('#openOrdersModal #iframe').attr('src', urldest);

//first array format
//   0-fname 1-lname 2-phone 3-addressdetails 4-addresstype 5-orderitems 6-orderitems 7-orderamount 8-itemcount 9-time 10-date 11-status
//   second array format
        //Format : 0->name 1-> price 2->image 3-> quantity
        var jsonArray = JSON.parse(data);
        var array1 = JSON.parse(jsonArray[0]);
        var array2 = JSON.parse(jsonArray[1]);


        //alert(array1[4]+'\n'+array2[0][0]+' '+array2[0][1]+' '+array2[0][2]+'\n'+array2.length);

//    populate the items
        var items = '';
         var div = $('#openOrdersModal #productDetails');
        for (var a = 0; a < array2.length; a++) {
           var total = (parseInt(array2[a][3])*parseInt(array2[a][1])).toString();

            items+='<div class="col-sm-3">\n\
                        <img src="../productImages/'+array2[a][2]+'" alt="product picture"/>\n\
                        <h5><b>'+array2[a][0]+'</b></h5>\n\
                        <ol>\n\
                            <li>Quantity Ordered :<span>'+array2[a][3]+'</span> </li>\n\
                            <li>Item Price : Ksh <span>'+moneyFormatter(array2[a][1])+'</span></li>\n\
                            <li>Total Price : Ksh <span>'+moneyFormatter(total)+'</span></li>\n\
                        </ol>\n\
                    </div>';
        }
        $(div).html(items); 
        $('#openOrdersModal #iframe').html('<p class="text-center">Welcome to Maps</p>');
        $('#openOrdersModal').modal('show');
    });
}