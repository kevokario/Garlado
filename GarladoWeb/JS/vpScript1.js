function loadBreadCrumb(str, typo) {
    var d = $('.crumbDiv .breadcrumb');
    d.html(' <li><i class="fa fa-pulse fa-refresh"></i></li>');
    $.post('Core/preloader.php',
            {
                cat: 'fetchCrumbData',
                queryName: str.trim(),
                queryType: typo.trim()
            },
            function (data, success) {
                d.html(' <li><i class="fa fa-home"></i> : Home</li>' + data);
            }
    );
}

function loadTreeData(str, typo) {
    var h3 = $('#navDiv .directory .tree .majorHeading');
    var tree_data = $('#navDiv .directory .tree .tree-data');
    h3.html('<i class="fa fa-pulse fa-refresh"></i>');
    tree_data.html('<i class="fa fa-pulse fa-refresh"></i>');
    $.post('Core/preloader.php',
            {
                cat: 'loadTreeData',
                queryName: str.trim(),
                queryType: typo.trim()
            },
            function (data, success) {
                h3.html(data.substring(data.indexOf('~') + 1, data.indexOf('_')));
                tree_data.html(data.substring(data.indexOf('_') + 1, data.indexOf('#')));
            }
    );

}
function loadBrandData(str, typo) {
    var container_brand = $('#navDiv .directory .brandYo .minData');
    container_brand.html('<i class="fa fa-pulse fa-refresh"></i>');
    $.post('Core/preloader.php',
            {
                cat: 'loadBrandData',
                queryName: str.trim(),
                queryType: typo.trim()
            },
            function (data, status) {
                container_brand.html(data);
            }
    );
}
/*
 function loadFeatures(str, typo) {
 var container_features = $('#navDiv #contentFeatures');
 $.post('Core/preloader.php',
 {
 cat: 'loadFeatures',
 queryName: str.trim(),
 queryType: typo.trim()
 },
 function (data, status) {
 var type = data.substring(data.indexOf('~') + 1, data.indexOf('!'));
 if (type === 'it') {
 //present
 $('#navDiv #contentFeatures .ramgroup .minData').html(data.substring(data.indexOf('!') + 1, data.indexOf('@')));
 $('#navDiv #contentFeatures .romgroup .minData').html(data.substring(data.indexOf('@') + 1, data.indexOf('#')));
 $('#navDiv #contentFeatures .sizegroup .minData').html(data.substring(data.indexOf('#') + 1, data.indexOf('_')));
 $('#navDiv #contentFeatures .osgroup .minData').html(data.substring(data.indexOf('_') + 1, data.indexOf('%')));
 $('#navDiv #contentFeatures .procgroup .minData').html(data.substring(data.indexOf('%') + 1, data.indexOf('^')));
 } else {
 container_features.css('display', 'none');
 }
 }
 );
 }
 */
function loadProducts(str, typo) {
    var div = $('.dataDiv .contentDiv .productDiv .col-sm-12');
    var before = '';
    for (var a = 0; a < 7; a++) {
        before += '<div class="col-sm-3 text-center"><i class="fa fa-pulse fa-refresh"></i></div>';
    }
    div.html(before);
    $.post('Core/preloader.php',
            {
                cat: 'loadProducts',
                queryName: str.trim(),
                queryType: typo.trim()
            },
            function (data, status) {
//                test(data+status);
                div.html(data);
            }
    );
}
function loadPagination(str, typo) {
    var pagination = $('#filterDiv .pagination');
    $.post('Core/preloader.php',
            {
                cat: 'loadPagination',
                queryName: str.trim(),
                queryType: typo.trim()
            },
            function (data, status) {
                pagination.html(data);
            });
}
//this function sorts out products within the provided price range
function priceFilter(from, to, btn, str, typo) {
    var pagination = $('#filterDiv .pagination');
    var sortMethod = $('#sortFilter select').val().trim();
    var pdivholder = $('.dataDiv .contentDiv .productDiv .col-sm-12');
    btn.html('<i class="fa fa-pulse fa-refresh"></i>');
    $.post(
            'Core/preloader.php',
            {
                cat: 'priceFilter',
                queryName: str.trim(),
                queryType: typo.trim(),
                fromPrice: from,
                toPrice: to,
                sortMethod: sortMethod
            },
            function (data, status) {
                pdivholder.html(data.substring(data.indexOf('{') + 1, data.indexOf('}')));
                pagination.html(data.substring(data.indexOf('}') + 1, data.indexOf('~')));
                btn.html('Go');
            }
    );
}
function  sortFilter(from, to, str, typo, filterName, i) {
    var pdivholder = $('.dataDiv .contentDiv .productDiv .col-sm-12');
//    var pagination = 
    i.html('<i class="fa fa-pulse fa-refresh"></i>');
    var pr = 'set';
    if (from.length === 0 || to.length === 0) {
        pr = 'unset';
    }
    $.post(
            'Core/preloader.php',
            {
                cat: 'sortFilter',
                queryName: str.trim(),
                queryType: typo.trim(),
                fromPrice: from,
                toPrice: to,
                filterName: filterName,
                pr: pr
            },
            function (data, status) {
                pdivholder.html(data);
                i.html('<i class="fa fa-filter"></i>');
            }
    );
}
//   --------------------START gets passed url parameters-----------------------
var getUrlParameterKario = function getUrlParameter(sParam) {
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

//**********PAGINATION CLICKED**************
function pagerClicked(str, div) {
    
    if (str === '<i class="fa fa-chevron-right"></i>') {
        var pagination = $('#filterDiv .pagination');
        var paginationLastItem = $('#filterDiv .pagination li:eq(3) a').html();
        loadNextMenu(paginationLastItem, pagination);
    } else if (str.indexOf('<i class="fa fa-chevron-left"></i>') !== -1) {
        var pagination = $('#filterDiv .pagination');
        var paginationLastItem = $('#filterDiv .pagination li:eq(1) a').html();
        loadPrevMenu(paginationLastItem, pagination);
    } else {
        loadPage(str, div);
    }
}

function loadPage(str, div) {
    var q = getUrlParameterKario('q');
    var t = getUrlParameterKario('t');
    var brand = checkSelectedBrandOption();
    var priceFrom = $('#priceFrom').val();
    var priceTo = $('#priceTo').val();
    var filter = $('#sortFilter select').val();
    //div.html('<i class="fa fa-pulse fa-refresh"></i>');
    div.innerHTML = '<i class="fa fa-pulse fa-refresh"></i>';
    var pdivholder = $('.dataDiv .contentDiv .productDiv .col-sm-12');
//    test('I am being executed with the following data<br>'+ q +'<br>'+ t +'<br> '+brand+' <br> '+priceFrom+' <br>'+ priceTo+' <br> '+filter);
    //send this data to the server to get results
    $.post('Core/preloader.php',
            {
                cat: 'pagerClicked',
                queryName: q.trim(),
                queryType: t.trim(),
                data: str.trim(),
                priceFrom: priceFrom,
                priceTo: priceTo,
                filter: filter,
                brand:brand

            }, function (data, status) {
        div.innerHTML = str;
//        test(data);
        pdivholder.html(data);
    });
//test(priceFrom+'<br>'+priceTo+'<br>'+filter+'<br>Brand: '+brand);
}

function loadNextMenu(paginationLastItem, pagination) {
    var q = getUrlParameterKario('q');
    var t = getUrlParameterKario('t');
    var brand = checkSelectedBrandOption();
    var priceFrom = $('#priceFrom').val();
    var priceTo = $('#priceTo').val();
    var filter = $('#sortFilter select').val();
    $('#filterDiv .pagination li:eq(4) a').html('<i class="fa fa-pulse fa-refresh"></i>');
    $.post('Core/preloader.php', {
        cat: 'loadNextMenu',
        queryName: q.trim(),
        queryType: t.trim(),
        lastItem: paginationLastItem,
        brand:brand.trim(),
        priceFrom:priceFrom,
        priceTo:priceTo

    }, function (data, status) {
        pagination.html(data);
    });
//    test(priceFrom+'<br>'+priceTo+'<br>'+filter);
}
function loadPrevMenu(paginationLastItem, pagination) {
    var q = getUrlParameterKario('q');
    var t = getUrlParameterKario('t');
    var brand = checkSelectedBrandOption();
    var priceFrom = $('#priceFrom').val();
    var priceTo = $('#priceTo').val();
    $('#filterDiv .pagination li:eq(0) a').html('<i class="fa fa-pulse fa-refresh"></i>');
    $.post('Core/preloader.php', {
        cat: 'loadPrevMenu',
        queryName: q.trim(),
        queryType: t.trim(),
        lastItem: paginationLastItem,
        brand:brand.trim(),
        priceFrom:priceFrom,
        priceTo:priceTo

    }, function (data, status) {
        pagination.html(data);
    });
}

function brandClicked(div) {
    var q = getUrlParameterKario('q');
    var t = getUrlParameterKario('t');
    var pdivholder = $('.dataDiv .contentDiv .productDiv .col-sm-12');
    var brandName = div.children('span:eq(0)').text();
    //change this to a spinnnig thing
    div.children('span:eq(0)').html('<i class="fa fa-pulse fa-refresh"></i>');

    //get the price and pagination of this thing
    //price
    var priceFrom = $('#priceFrom').val();
    var priceTo = $('#priceTo').val();

    var sortOrder = $('#sortFilter select').val();
    var pagination = $('#searchDiv .pagination');

    $.post('Core/preloader.php',
            {
                cat: 'brandClicked',
                queryName: q.trim(),
                queryType: t.trim(),
                priceFrom: priceFrom,
                priceTo: priceTo,
                sortOrder: sortOrder,
                brandName: brandName
            },
            function (data, status) {
                div.children('span:eq(0)').html(brandName);
                pdivholder.html(data.substring(data.indexOf('{') + 1, data.indexOf('}')));
                pagination.html(data.substring(data.indexOf('}') + 1, data.indexOf('~')));
            }
    );

}

//**********function check selected brand**********
function checkSelectedBrandOption() {
    var theDiv = $('#navDiv .directory .contentMiniGroup .minData');
    var name = theDiv.find('input:checked').parent().parent().children('span:eq(0)').text();
    return name;
}

//*********Buy now button clicked***********
function buyProduct(str,btn){
    var pname = str;
    var quantity = 1;
    addToCartInterface2(pname,quantity,btn);
    document.location.href='myShoppingCart';
}