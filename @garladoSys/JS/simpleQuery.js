$(document).ready(function () {
// this function loads new orders and places them here
    checkOrder($('#mynav .myOrderBadge-new'));
    //  Option manage client
    $('#mynav .dropdown:eq(0) ul li:eq(1) a').click(function () {
        LoadClients();
    });
});
function checkOrder(span) {
    var spin = '<i class="fa fa-pulse fa-refresh"></i>';
    $(span).html(spin);
    $.post('AjaxPhp/simpleQuery.php',
            {
                cat: 'checkOrder'
            },
            function (data, status) {
                $(span).html(data);
            });
}
function checkOrderPending(span) {
    var spin = '<i class="fa fa-pulse fa-refresh"></i>';
    $(span).html(spin);
    $.post('AjaxPhp/simpleQuery.php',
            {
                cat: 'checkOrderPending'
            },
            function (data, status) {
                $(span).html(data);
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
        checkOrder($('.OrderDivTitle .myOrderBadge-new'));
        checkOrderPending($('.OrderDivTitle .myOrderBadge-pending'));
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
    $('#openOrdersModal ul li h3 span').text(str);
    $.post('AjaxPhp/simpleQuery.php', {
        cat: 'getOrderItems',
        orderNumber: str.trim()
    }, function (data, status) {
//        test(data);
        var url = "https://maps.google.com/maps?q=quest%20website%20developers&t=&z=13&ie=UTF8&iwloc=&output=embed";
//        var urldest = "https://www.google.com/maps/embed/v1/directions?origin=40.7127837,-74.0059413&destination=42.3600825,-71.05888&key=AIzaSyAqVaMhQ8J6dOXmnEzdCFaSNwH853STe7I";
        $('#openOrdersModal #iframe').attr('src', url);

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
            var total = (parseInt(array2[a][3]) * parseInt(array2[a][1])).toString();

            items += '<div class="col-sm-3">\n\
                        <img src="../productImages/' + array2[a][2] + '" alt="product picture"/>\n\
                        <h5><b>' + array2[a][0] + '</b></h5>\n\
                        <ol>\n\
                            <li>Quantity Ordered :<span>' + array2[a][3] + '</span> </li>\n\
                            <li>Item Price : Ksh <span>' + moneyFormatter(array2[a][1]) + '</span></li>\n\
                            <li>Total Price : Ksh <span>' + moneyFormatter(total) + '</span></li>\n\
                        </ol>\n\
                    </div>';
        }
        $(div).html(items);

//        populate the contact info
        var divClientForm = ('#ClientDetails form ');

        $('#ClientDetails form .fancy:eq(0)').text(array1[0]);
        $('#ClientDetails form .fancy:eq(1)').text(array1[1]);
        $('#ClientDetails form .fancy:eq(2)').text(array1[2]);
        $('#ClientDetails form .fancy:eq(3)').html('<b class="text-capitalize">' + array1[4] + '</b> Mode of Delivery');
        $('#ClientDetails form .fancy:eq(4)').text(array1[10]);
        $('#ClientDetails form .fancy:eq(5)').text(array1[11]);
        $('#ClientDetails form .fancy:eq(6)').text(array1[12]);
        $('#ClientDetails form .fancy:eq(7)').text('---under construction---');
        $('#ClientDetails form .fancy:eq(8)').text(array1[3]);

        $('#openOrdersModal .summary li:eq(0) b span').text(array1[7]);
        $('#openOrdersModal .summary li:eq(1) b span').text(array1[8]);
        $('#openOrdersModal .summary li:eq(2) b span').text(array1[13]);
        $('#openOrdersModal .summary li:eq(3) b span').text(moneyFormatter(array1[6]));


        $('#ClientAction form .fancy:eq(0)').text(array1[0] + ' ' + array1[1]);
        $('#ClientAction form .fancy:eq(1)').text(moneyFormatter(array1[6]));
        $('#ClientAction form .fancy:eq(2)').text(array1[2]);
        $('#ClientAction form .fancy:eq(3)').html('<b class="text-capitalize">' + str + '</b>');
        $('#ClientAction form .fancy:eq(4)').text('---under construction---');
        $('#ClientAction form button').click(function () {
            ActionClicked($(this));
        });

        var url = "https://maps.google.com/maps?q=" + encodeURIComponent(array1[12]) + "&t=&z=13&ie=UTF8&iwloc=&output=embed";
//        var urldest = "https://www.google.com/maps/embed/v1/directions?origin=40.7127837,-74.0059413&destination=42.3600825,-71.05888&key=AIzaSyAqVaMhQ8J6dOXmnEzdCFaSNwH853STe7I";
        $('#openOrdersModal #iframe').attr('src', url);
        $('#openOrdersModal #iframe').html('<p class="text-center">Welcome to Maps</p>');
        $('#openOrdersModal').modal('show');
    });
}

//this is the action that is performed on clicking the action submit button
//-------------------------------------------------
function ActionClicked(btn) {
    var form = $('#ClientAction form');
    var input = document.forms['ClientAction']['options'].checked;
//    if(input.checked){
//        alert('w');
//    }
// change the status to pending, dismiss this modal, show a message update Success! Reload the newOrders. page
    $(btn).children('i').removeClass('fa-star-o').addClass('fa-pulse fa-refresh').wait(2000).removeClass('fa-pulse fa-refresh').addClass('fa-star-o');
}