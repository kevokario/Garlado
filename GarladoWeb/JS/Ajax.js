function test(str) {
    $('#popUp .modal-body').html(str);
    $('#popUp').modal('show');
}
function loadData(str) {
    $('#closeMenu').show();
    var majorCat = str.substring(0, str.indexOf('<i class="'));
    $('#genCdata').show();
    // $('#genCdata').html('<i class="fa fa-pulse fa-refresh"></i>');
    $.post('Core/preloader.php',
            {
                cat: 'loadDataOnMajors',
                major: majorCat.trim()
            }
    , function (data, status) {
        if (status === 'success') {
            $('#genCdata').html(data);
        } else {
            $('Internet Connection Lost!');
        }
    });
}
function loadCart() {
    $('.myDiv .opt2 .optContent').fadeIn(300);
    var titleDiv = $('.myDiv .opt2 .optContent .contentData .dataTitle');
    var bodyDiv = $('.myDiv .opt2 .optContent .contentData .Data');
    var titleHome = $('.myNav .Etc  .myShpCart h4').html();
    var formHome = $('.myNav .Etc  .myShpCart div').html();
    titleDiv.html(titleHome);
    bodyDiv.html(formHome);
}
function loadHelp() {
    $('.myDiv .opt2 .optContent').fadeIn(300);
    var titleDiv = $('.myDiv .opt2 .optContent .contentData .dataTitle');
    var bodyDiv = $('.myDiv .opt2 .optContent .contentData .Data');
}
function loadLogin() {
    $('.myDiv .opt2 .optContent').fadeIn(300);
    var titleDiv = $('.myDiv .opt2 .optContent .contentData .dataTitle');
    var bodyDiv = $('.myDiv .opt2 .optContent .contentData .Data');

    var titleHome = $('.myNav .Etc .login h4').html();
    var formHome = $('.myNav .Etc .login form').html();
    titleDiv.html(titleHome);
    bodyDiv.html(formHome);
}

function unLoadData() {
    $('#genCdata').hide();
    $('#closeMenu').hide();

}

function searchItem() {
    var data = $('.searchBar .search').val();
    if (data.length === 0) {
        $('#searchResult').css('display', 'none');
    } else {
        $.post('Core/preloader.php',
                {
                    cat: 'searchItem',
                    productName: data.trim()
                }
        , function (datadb, status) {
            if (status === 'success') {
                $('#searchResult').show();
                $('#searchResult').html(datadb);
                if ($('#searchResult').html() === '') {
                    $('#searchResult').hide();
                }
//                alert(data);
            } else {
//            alert('You have an error!');
            }
        });
    }
}

function filProduct(str) {
//    test(str+'\n'+typeof(st) );
//    $('.searchBar .search').val();
    $('.searchBar .search').val(str);
}
function filPClicked(str) {
    $('.searchBar .search').val(str);
    $('#searchResult').hide();
}

function searchItemsClicked(str) {
    test(str + 'Detected!');
}

function loadMajorGroupData() {
    $('.topCatDiv .panel .panel-heading h3 span a').text('See More...');
    $('.topCatDiv .panel .panel-body').html(' <div class="col-sm-3"><i class="fa fa-pulse fa-refresh"></i></div>\n\
<div class="col-sm-3"><i class="fa fa-pulse fa-refresh"></i></div>\n\
<div class="col-sm-3"><i class="fa fa-pulse fa-refresh"></i></div><div class="col-sm-3">\n\
<i class="fa fa-pulse fa-refresh"></i></div><div class="col-sm-3"><i class="fa fa-pulse fa-refresh"></i></div>\n\
<div class="col-sm-3"><i class="fa fa-pulse fa-refresh"></i></div><div class="col-sm-3"><i class="fa fa-pulse fa-refresh"></i>\n\
</div><div class="col-sm-3">\n\
<i class="fa fa-pulse fa-refresh"></i></div> ');
    //get the data to place in the divs first

    $.post('Core/preloader.php',
            {
                cat: 'loadMajorGroupData'
            },
            function (data, status) {
                $('.topCatDiv .panel .panel-body').html(data);
//                test(data);
            }
    );
    //get the data for the link should be like <a href="">See more</a>
}
function loadMostBoughtData() {
    var d1 = $('.mostBoughtDiv .panel .panel-body .col-sm-5 .carousel .carousel-inner');
    var d2 = $('.mostBoughtDiv .panel .panel-body .col-sm-7');
    $.post('Core/preloader.php',
            {
                cat: 'loadMostBoughtData'
            },
            function (data, status) {
                d1.html(data.substring(data.indexOf('~') + 1, data.indexOf('!')));
                d2.html(data.substring(data.indexOf('!') + 1, data.indexOf('|')));
            }
    );
}
function loadMajorGroup1Data() {
    var he31 = $('.color1 .panel .panel-heading h3');
    var car1 = $('.color1 .panel .panel-body .col-sm-5 .carousel .carousel-inner');
    var ite1 = $('.color1 .panel .panel-body .col-sm-7');

    var he32 = $('.color2 .panel .panel-heading h3');
    var car2 = $('.color2 .panel .panel-body .col-sm-5 .carousel .carousel-inner');
    var ite2 = $('.color2 .panel .panel-body .col-sm-7');

    var he33 = $('.color3 .panel .panel-heading h3');
    var car3 = $('.color3 .panel .panel-body .col-sm-5 .carousel .carousel-inner');
    var ite3 = $('.color3 .panel .panel-body .col-sm-7');

    var data1 = '';
    var data2 = '';
    var data3 = '';

    $.post('Core/preloader.php',
            {
                cat: 'loadMajorGroup1Data'
            },
            function (data, status) {
//             he3.html(data.substring(data.indexOf('|')+1,data.indexOf('*')));
//             car.html(data.substring(data.indexOf('~')+1,data.indexOf('!')));
//             ite.html(data.substring(data.indexOf('!')+1,data.indexOf('|')));

                data1 = data.substring(data.indexOf('[') + 1, data.indexOf(']'));
                data2 = data.substring(data.indexOf(']') + 1, data.indexOf('{'));
                data3 = data.substring(data.indexOf('{') + 1, data.indexOf('}'));

                he31.html(data1.substring(data1.indexOf('|') + 1, data1.indexOf('*')));
                car1.html(data1.substring(data1.indexOf('~') + 1, data1.indexOf('!')));
                ite1.html(data1.substring(data1.indexOf('!') + 1, data1.indexOf('|')));

                he32.html(data2.substring(data2.indexOf('|') + 1, data2.indexOf('*')));
                car2.html(data2.substring(data2.indexOf('~') + 1, data2.indexOf('!')));
                ite2.html(data2.substring(data2.indexOf('!') + 1, data2.indexOf('|')));

                he33.html(data3.substring(data3.indexOf('|') + 1, data3.indexOf('*')));
                car3.html(data3.substring(data3.indexOf('~') + 1, data3.indexOf('!')));
                ite3.html(data3.substring(data3.indexOf('!') + 1, data3.indexOf('|')));

            }
    );
}
//***************GET THE ITEM IN CART ACTION********************

function getCart() {
    var visibleCart = $('#cartData');
    $.post('Core/preloader.php',
            {
                cat: 'getCartDataInterface'

            },
            function (data, status) {
                if (data.length > 0) {
                    var jsonData = JSON.parse(data);
                    var js = '';
                    for (i = 0; i < jsonData.length; i++) {
                        js += '<tr><td>' + jsonData[i][0] + '</td><td>' + jsonData[i][2] + '</td><td>' + jsonData[i][1] + '</td><td><button onclick="removeFromCart(this.value,this)" value="' + i + '" class="btn btn-sm btn-danger"> <i class="fa fa-trash-o"></i></button></td><tr>';
                    }
                    visibleCart.html(js);
                } else {

                }
            }
    );
}

//***************ADD THE ITEM TO CART ACTION********************
function addToCart(name, btn) {
    var visibleCart = $('#cartData');
    $(btn).children('i').removeClass('fa fa-cart-plus');
    $(btn).children('i').addClass('fa fa-pulse fa-refresh');
    $.post('Core/preloader.php',
            {
                cat: 'addToCartInterface',
                name: name
            },
            function (data, status) {
                var jsonData = JSON.parse(data);
                var js = '';
                for (i = 0; i < jsonData.length; i++) {
                    js += '<tr><td>' + jsonData[i][0] + '</td><td>' + jsonData[i][2] + '</td><td>' + jsonData[i][1] + '</td><td><button onclick="removeFromCart(this.value,this)" value="' + i + '" class="btn btn-sm btn-danger"> <i class="fa fa-trash-o"></i></button></td><tr>';
                }
                visibleCart.html(js);
                loadCart();
                $(btn).children('i').removeClass('fa fa-pulse fa-refresh');
                $(btn).children('i').addClass('fa fa-cart-plus');
            }
    );
}

//******************THIS FUNCTION HANDLES THE DELETE ACTION***********************
function removeFromCart(str, btn) {
    var visibleCart = $('#cartData');
    $(btn).children('i').removeClass('fa fa-trash-o');
    $(btn).children('i').addClass('fa fa-pulse fa-refresh');
    $.post('Core/preloader.php',
            {
                cat: 'removeFromCartInterface',
                index: str.trim()
            },
            function (data, status) {
                var jsonData = JSON.parse(data);
                var js = '';
                for (i = 0; i < jsonData.length; i++) {
                    js += '<tr><td>' + jsonData[i][0] + '</td><td>' + jsonData[i][2] + '</td><td>' + jsonData[i][1] + '</td><td><button onclick="removeFromCart(this.value,this)" value="' + i + '" class="btn btn-sm btn-danger"> <i class="fa fa-trash-o"></i></button></td><tr>';
                }
                visibleCart.html(js);
                loadCart();
                $(btn).children('i').removeClass('fa fa-pulse fa-refresh');
                $(btn).children('i').addClass('fa fa-trash-o');
            }
    );
}
function addToCartInterface1(name, quantity, btn) {
    var i = $(btn).children('i');
    i.removeClass('fa-cart-plus');
    i.addClass('fa-pulse fa-refresh');
    $.post('Core/preloader.php',
            {
                cat: 'addToCartInterface1',
                name: name,
                quantity: quantity
            },
            function (data, status) {
                i.removeClass('fa-pulse fa-refresh');
                i.addClass('fa-cart-plus');
                getCart();
                loadCart();
            }
    );
}
function addToCartInterface2(name, quantity, btn) {
    var i = $(btn).children('i');
    i.removeClass('fa-money');
    i.addClass('fa-pulse fa-refresh');
    $.post('Core/preloader.php',
            {
                cat: 'addToCartInterface1',
                name: name,
                quantity: quantity
            },
            function (data, status) {
                i.removeClass('fa-pulse fa-refresh');
                i.addClass('fa-money');
                getCart();
                loadCart();
            }
    );
}


// GENERIC VALIDATIONS 
/*********************************/

//validates username
function validateUserName(input) {
    //get value, Parent container,span &small elements, return some result
    var result = false;

    var data = $(input).val();
    var parentDiv = $(input).parent().parent();
    var span = $(parentDiv).children('span');
    var small = $(parentDiv).children('small');
    var label = $(parentDiv).children('label');
    small.addClass('text-danger');
    if (data.length === 0) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please provide username');
    } else if (data.length > 0 & data.length < 5) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Your username should be atleast 5 letters long!');
    } else {
        parentDiv.removeClass('has-feedback has-error');
        parentDiv.addClass('has-feedback has-success');
        label.removeClass('text-danger');
        label.addClass('text-success');
        span.removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
        span.addClass('form-control-feedback glyphicon glyphicon-ok');
        small.text('');
        result = true;
    }

    parentDiv.addClass('has-feedback has-success');
    span.addClass('form-control-feedback glyphicon glyphicon-ok');
    return result;
}
//validates password
function validateClientPassword(input) {
    //get value, Parent container,span &small elements, return some result
    var result = false;

    var data = $(input).val();
    var parentDiv = $(input).parent().parent();
    var span = $(parentDiv).children('span');
    var small = $(parentDiv).children('small');
    var label = $(parentDiv).children('label');
    small.addClass('text-danger');
    if (data.length === 0) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please provide password');
    } else if (data.length > 0 & data.length < 5) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Your password should be atleast 5 letters long!');
    } else {
        parentDiv.removeClass('has-feedback has-error');
        parentDiv.addClass('has-feedback has-success');
        label.removeClass('text-danger');
        label.addClass('text-success');
        span.removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
        span.addClass('form-control-feedback glyphicon glyphicon-ok');
        small.text('');
        result = true;
    }
    return result;
}
//validates email
function validateClientEmail(input) {
    //get value, Parent container,span &small elements, return some result
    var result = false;

    var data = $(input).val();
    var parentDiv = $(input).parent().parent();
    var span = $(parentDiv).children('span');
    var small = $(parentDiv).children('small');
    var label = $(parentDiv).children('label');
    var atposition = data.indexOf('@');
    var dotposition = data.indexOf(".");
    small.addClass('text-danger');
    if (data.length === 0) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please provide Email');
    } else if (data.length > 0 & data.length < 5) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Your Email should be atleast 5 letters long!');
    } else if (dotposition < 1 || atposition < 1 || (dotposition - atposition) < 2 || (data.length - dotposition) < 3) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Provide a valid email, e.g, garlado@example.com');
    } else {
        parentDiv.removeClass('has-feedback has-error');
        parentDiv.addClass('has-feedback has-success');
        label.removeClass('text-danger');
        label.addClass('text-success');
        span.removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
        span.addClass('form-control-feedback glyphicon glyphicon-ok');
        small.text('');
        result = true;
    }  
    return result;
}
//validates names
function validateClientName(input){
     var result = false;

    var data = $(input).val();
    var parentDiv = $(input).parent().parent();
    var span = $(parentDiv).children('span');
    var small = $(parentDiv).children('small');
    var label = $(parentDiv).children('label');
    small.addClass('text-danger');
    if (data.length === 0) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please provide Your name');
    } else if (data.length > 0 & data.length < 3) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Your name should be atleast 3 letters long!');
    }  else if (/[^a-z A-Z]/.test(data)) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please provide a valid name');
    } 
    
    else {
        parentDiv.removeClass('has-feedback has-error');
        parentDiv.addClass('has-feedback has-success');
        label.removeClass('text-danger');
        label.addClass('text-success');
        span.removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
        span.addClass('form-control-feedback glyphicon glyphicon-ok');
        small.text('');
        result = true;
    }
    return result;
}

//validates numbers
function validateClientPhone(input){
     var result = false;

    var data = $(input).val();
    var parentDiv = $(input).parent().parent();
    var span = $(parentDiv).children('span');
    var small = $(parentDiv).children('small');
    var label = $(parentDiv).children('label');
    small.addClass('text-danger');
    if (data.length === 0) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please provide Your phone number');
    } else if (data.length > 0 && data.length !==10) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Your phone number should contain 10 digits only!');
    }  else if (/[^0-9]/.test(data)) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please provide only digits');
    } 
    
    else {
        parentDiv.removeClass('has-feedback has-error');
        parentDiv.addClass('has-feedback has-success');
        label.removeClass('text-danger');
        label.addClass('text-success');
        span.removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
        span.addClass('form-control-feedback glyphicon glyphicon-ok');
        small.text('');
        result = true;
    }
    return result;
}

//validates code
function validateVerificationCode(input){
     var result = false;

    var data = $(input).val();
    var parentDiv = $(input).parent().parent();
    var span = $(parentDiv).children('span');
    var small = $(parentDiv).children('small');
    var label = $(parentDiv).children('label');
    small.addClass('text-danger');
    if (data.length === 0) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please provide the code sent to you');
    }
    else {
        parentDiv.removeClass('has-feedback has-error');
        parentDiv.addClass('has-feedback has-success');
        label.removeClass('text-danger');
        label.addClass('text-success');
        span.removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
        span.addClass('form-control-feedback glyphicon glyphicon-ok');
        small.text('');
        result = true;
    }
    return result;
}
//country select validation
function validateCountry(input){
     var result = false;

    var data = $(input).val();
    var parentDiv = $(input).parent().parent();
    var span = $(parentDiv).children('span');
    var small = $(parentDiv).children('small');
    var label = $(parentDiv).children('label');
    small.addClass('text-danger');
    if (data === '---Select Country---') {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please select Country');
    }
    else {
        parentDiv.removeClass('has-feedback has-error');
        parentDiv.addClass('has-feedback has-success');
        label.removeClass('text-danger');
        label.addClass('text-success');
        span.removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
        span.addClass('form-control-feedback glyphicon glyphicon-ok');
        small.text('');
        result = true;
    }
    return result;
}
//county select validation
function validateCounty(input){
     var result = false;

    var data = $(input).val();
    var parentDiv = $(input).parent().parent();
    var span = $(parentDiv).children('span');
    var small = $(parentDiv).children('small');
    var label = $(parentDiv).children('label');
    small.addClass('text-danger');
    if (data==='---Select County---') {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please select County');
    }
    else {
        parentDiv.removeClass('has-feedback has-error');
        parentDiv.addClass('has-feedback has-success');
        label.removeClass('text-danger');
        label.addClass('text-success');
        span.removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
        span.addClass('form-control-feedback glyphicon glyphicon-ok');
        small.text('');
        result = true;
    }
    return result;
}
//State select validation
function validateState(input){
     var result = false;

    var data = $(input).val();
    var parentDiv = $(input).parent().parent();
    var span = $(parentDiv).children('span');
    var small = $(parentDiv).children('small');
    var label = $(parentDiv).children('label');
    small.addClass('text-danger');
    if (data==='---Select State---') {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please select State');
    }
    else {
        parentDiv.removeClass('has-feedback has-error');
        parentDiv.addClass('has-feedback has-success');
        label.removeClass('text-danger');
        label.addClass('text-success');
        span.removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
        span.addClass('form-control-feedback glyphicon glyphicon-ok');
        small.text('');
        result = true;
    }
    return result;
}
//validate station select
function validateStation(input){
     var result = false;

    var data = $(input).val();
    var parentDiv = $(input).parent().parent();
    var span = $(parentDiv).children('span');
    var small = $(parentDiv).children('small');
    var label = $(parentDiv).children('label');
    small.addClass('text-danger');
    if (data==='---Select Station---') {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please select a Station');
    }
    else {
        parentDiv.removeClass('has-feedback has-error');
        parentDiv.addClass('has-feedback has-success');
        label.removeClass('text-danger');
        label.addClass('text-success');
        span.removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
        span.addClass('form-control-feedback glyphicon glyphicon-ok');
        small.text('');
        result = true;
    }
    return result;
}

function validateDescription(input){
     var result = false;

    var data = $(input).val();
    var parentDiv = $(input).parent().parent();
    var span = $(parentDiv).children('span');
    var small = $(parentDiv).children('small');
    var label = $(parentDiv).children('label');
    small.addClass('text-danger');
    if (data.length===0 || data.length < 10) {
        parentDiv.removeClass('has-feedback has-success');
        parentDiv.addClass('has-feedback has-error');
        label.removeClass('text-success');
        label.addClass('text-danger');
        span.removeClass('form-control-feedback glyphicon glyphicon-ok');
        span.addClass('form-control-feedback glyphicon glyphicon-warning-sign');
        small.text('Please provide a detailed description for timely delivery');
    }
    else {
        parentDiv.removeClass('has-feedback has-error');
        parentDiv.addClass('has-feedback has-success');
        label.removeClass('text-danger');
        label.addClass('text-success');
        span.removeClass('form-control-feedback glyphicon glyphicon-warning-sign');
        span.addClass('form-control-feedback glyphicon glyphicon-ok');
        small.text('');
        result = true;
    }
    return result;
}