function loadShoppingListData() {
    var tbody = $('#myShoppingListItems');
    var listPrice = $('#myShoppingListPrice');
    tbody.html('<tr><td colspan="5"><i class="fa fa-pulse fa-refresh"></i></td></tr>');
    listPrice.html('<i class="fa fa-refresh fa-pulse"></i>');

    $.post(
            'Core/preloader.php',
            {
                cat: 'loadShoppingListData'
            },
            function (data, status) {
                if (data.length > 2) {
                    var jsonData = JSON.parse(data);
                    var totalPrice = 0;
                    var js = '';
                    for (var i = 0; i < jsonData.length; i++) {
                        totalPrice = totalPrice + (parseInt(jsonData[i][1]));
                        js += '<tr><td>' + (i + 1) + '</td> <td>' + jsonData[i][0] + '</td> <td>' + jsonData[i][2] + '</td><td>' + parseInt(jsonData[i][1]) / parseInt(jsonData[i][2]) + '</td><td><button class="btn btn-sm btn-danger" onclick="removeFromCart1(this.value,this)" value="' + i + '"><i class="fa fa-trash-o"></i></button></td></tr>';
                    }
                    tbody.html(js);
                    $.post('Core/preloader.php', {
                        cat: 'moneyFormat',
                        money: totalPrice
                    },
                            function (data1, success) {
                                $(listPrice).html('KSH ' + data1);
                            });

                } else {
                    tbody.html('<tr><td colspan="5"><h4>Your Cart is empty! Please add products</h4></td></tr>');
                    listPrice.html('KSH 0');
                }

            }
    );

}
function removeFromCart1(str, btn) {
    var tbody = $('#myShoppingListItems');
    var listPrice = $('#myShoppingListPrice');
    $(btn).children('i').removeClass('fa fa-trash-o');
    $(btn).children('i').addClass('fa fa-pulse fa-refresh');
    $.post('Core/preloader.php',
            {
                cat: 'removeFromCartInterface',
                index: str.trim()
            },
            function (data, status) {
                if (data.length > 2) {
                    var jsonData = JSON.parse(data);
                    var totalPrice = 0;
                    var js = '';
                    for (var i = 0; i < jsonData.length; i++) {
                        totalPrice = totalPrice + (parseInt(jsonData[i][1]));
                        js += '<tr><td>' + (i + 1) + '</td> <td>' + jsonData[i][0] + '</td> <td>' + jsonData[i][2] + '</td><td>' + parseInt(jsonData[i][1]) / parseInt(jsonData[i][2]) + '</td><td><button class="btn btn-sm btn-danger" onclick="removeFromCart1(this.value,this)" value="' + i + '"><i class="fa fa-trash-o"></i></button></td></tr>';
                    }
                    tbody.html(js);
                    $.post('Core/preloader.php', {
                        cat: 'moneyFormat',
                        money: totalPrice
                    },
                            function (data1, success) {
                                listPrice.html('KSH ' + data1);
                            });

                } else {
                    tbody.html('<tr><td colspan="5"><h4>Your Cart is empty! Please add products</h4></td></tr>');
                    listPrice.html('KSH 0');
                }
            }
    );
}

function buyItems(btn) {
    var txt = '<h4 style="font-weight:bold;margin-bottom : 7px">You are not logged in yet!</h4><p class="text-justify">Click here to <a href="GarladoAuth">login</a><p>';
    var txt1 = 'Done!';
    $(btn).children('i').removeClass('fa fa-money');
    $(btn).children('i').addClass('fa fa-pulse fa-refresh');
    $.post(
            'Core/preloader.php',
            {
                cat: 'checkUserLoggedIn'
            },
            function (data, success) {
                $(btn).children('i').removeClass('fa fa-pulse fa-refresh');
                $(btn).children('i').addClass('fa fa-money');
                if (data === 'no') {
                    //user has not logged in. case 1 : no account &not logged in, case 2 : has account, not logged in
                    test(txt);
                } else {
                    //user has an account here. Proceed to start the buying process
                    document.location.href='myOrder';
                }
            }
    );

}