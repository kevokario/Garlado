$(document).ready(function () {
    $(document).scroll(function () {
        if ($(this).scrollTop() > 70) {
            $('.topPart').css('margin-top', '140px');
        } else {
            $('.topPart').css('margin-top', '15px');
        }
    });
    /*------------------------------------------------------------------*/
    var getUrlsKario = function getUrlParameter(sParam) {
        var sPageURL = window.location.search.substring(1),
                sURLVariables = sPageURL.split('&'),
                sParameterName,
                i;

        for (i = 0; i < sURLVariables.length; i++) {
            sParameterName = sURLVariables[i].split('=');

            if (sParameterName[0] === sParam) {
                return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
            }
        }
    };
    /*------------------------------------------------------------------*/
    var pname = getUrlsKario('name').trim();
    //load bread crumbs
    loadBreadCrumb(pname);
    loadImageDivData(pname);
    loadFeaturesPd(pname);
    loadMorePicDivData(pname);
    loadMoreProductsDivDatapD();

    //*********Click the button minus in  quantity************
    $('.imageBuyDiv .col-sm-5 table tr:eq(2) td:eq(2) .input-group .input-group-btn:eq(0) button').click(function () {
        var input = parseInt($('.imageBuyDiv input').val().trim());
        var pay = '';
        var payDiv = $('.imageBuyDiv table tr:eq(3) td:eq(2) span');
        var ourPrice = parseInt($('.imageBuyDiv table tr:eq(1) td:eq(2) span').text().trim());
        if (input <=1) {
            input = 1;
        } else {
            input -= 1;
        }
        pay = ourPrice * input;
        payDiv.text(pay);
        $('.imageBuyDiv input').val(input);

    });
    //*********Click the button plus in  quantity************
    $('.imageBuyDiv .col-sm-5 table tr:eq(2) td:eq(2) .input-group .input-group-btn:eq(1) button').click(function () {
        var input = parseInt($('.imageBuyDiv input').val().trim());
        var pay = '';
        var payDiv = $('.imageBuyDiv table tr:eq(3) td:eq(2) span');
        var ourPrice = parseInt($('.imageBuyDiv table tr:eq(1) td:eq(2) span').text().trim());
        if (input <= 0) {
            input = 1;
        } else {
            input += 1;
        }
        pay = ourPrice * input;
        payDiv.text(pay);
        $('.imageBuyDiv input').val(input);
    });

    //**************** CLICK THE ADD TO CART BUTTON *********************
    $('.imageBuyDiv .col-sm-5 table tr:eq(4) td button:eq(0)').click(function () {
        var quantity = parseInt($('.imageBuyDiv input').val().trim());
        if (quantity <= 0) {
            test("Please provide a valid number of products");
        } else {
            addToCartInterface1(pname,quantity,$(this));
        }
    });
    //************************ CLICK THE BUY BUTTON ************************
     $('.imageBuyDiv .col-sm-5 table tr:eq(4) td button:eq(1)').click(function () {
           var quantity = parseInt($('.imageBuyDiv input').val().trim());
        if (quantity <= 0) {
            test("Please provide a valid number of products");
        } else {
            addToCartInterface1(pname,quantity,$(this));
        }
         document.location.href='myShoppingCart';
     });

});


/*
 * 
 addToCartInterface1(pname,quantity,buton);
 document.location.href='myShoppingCart';
 
 * 
 */