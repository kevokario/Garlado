$(document).ready(function () {

    $(document).scroll(function () {
        var st = $(this).scrollTop();
        if (st > 70) {
            $(".logo .myProductMenu").hide();
        }
    });

    $('.dataDiv #navDiv .contentMiniGroup h3').click(function () {
        var maindiv = $(this).parent();
        if (maindiv.children('.minData').css('height') === '200px') {
            $(this).children(' .caret').css({'transform': 'rotate(90deg)'});
            maindiv.children('.minData').css('height', '0');
        } else {
            $(this).children(' .caret').css({'transform': 'rotate(0deg)'});
            maindiv.children('.minData').css('height', '200px');
        }
    });
//   --------------------START gets passed url parameters-----------------------
    var getUrlParameter = function getUrlParameter(sParam) {
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
//   --------------------END gets passed url parameters-------------------------
    var optionOpener = 'closed';
    $('#optionOpener').click(function () {
        if (optionOpener === 'closed') {
            $('#navDiv').css({'height': '75%', 'width': '45%'});
            optionOpener = 'opened';
        } else {
            $('#navDiv').css({'height': '0', 'width': '0', 'overflow': 'hidden'});
            optionOpener = 'closed';
        }
    });
    $('.dataDiv .contentDiv .productDiv .col-sm-3').mouseenter(function () {
        $(this).children('.col-sm-12').css('visibility', 'visible');
    });
    $('.dataDiv .contentDiv .productDiv .col-sm-3').mouseleave(function () {
        $(this).children(' .col-sm-12').css('visibility', 'hidden');
    });

    //*********************FUNCTIONS HERE***********************

    var q = getUrlParameter('q');
    var t = getUrlParameter('t');
    $('.dataDiv .contentDiv .majorHeading').text(q);
    loadBreadCrumb(q, t);
    loadTreeData(q, t);
    loadBrandData(q, t);
/*  loadFeatures(q, t);   */
    loadProducts(q, t);
    loadPagination(q, t);

    //********MINI SEARCH FUNTION*********
    $('#filterPrice').click(function () {
        var from = $('#priceFrom').val();
        var to = $('#priceTo').val();
        if (from.length === 0 || to.length === 0) {
            $('#popUp .modal-body').html('<i class="fa fa-warning"></i> Please set <strong>Price</strong> ranges for effecive sorting.');
            $('#popUp').modal('show');
        } else {
            priceFilter(from, to, $(this), q, t);
        }
    });
    //*********FILTER COMBO***************
    $('#sortFilter select').change(function () {
        var i = $('#sortFilter .input-group-addon');
        var from = $('#priceFrom').val();
        var to = $('#priceTo').val();
        var filterName = $(this).val();
        sortFilter(from, to, q, t, filterName, i);
    });
});