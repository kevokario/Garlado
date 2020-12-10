function loadBreadCrumb(str, typo) {
    var d = $('.crumbDiv .breadcrumb');
    d.html(' <li><i class="fa fa-spinner fa-spin"></i></li>');
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
    var h3 = $('#treeData h4, #page-title');
    var tree_data = $('#treeData ul');
    h3.html('<i class="fa fa-spinner fa-spin"></i>');
    tree_data.html('<i class="fa fa-spinner fa-spin"></i>');
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
    var container_brand = $('#brandData');
    container_brand.html('<i class="fa fa-spinner fa-spin"></i>');
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

 <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="img/product/product-2.jpg">
                    <ul class="product__item__pic__hover">
                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6><a href="#">Crab Pool Security</a></h6>
                    <h5>$30.00</h5>
                </div>
            </div>
        </div>
 */
function loadProducts(str, typo) {
    var div = $('#row-products');
    var before = '';
    for (var a = 0; a < 3; a++) {
        before += `<div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="product__item">
                            <div class="product__item__pic set-bg" data-setbg="img/loader.gif">
                            </div>
                            <div class="product__item__text">
                            </div>
                        </div>
                    </div>`;
    }
    div.html(before);
    $.post('Core/preloader.php',
            {
                cat: 'loadProducts',
                queryName: str.trim(),
                queryType: typo.trim()
            },
            function (data, status) {
                populateProducts(data);
            }
    );
}
function loadPagination(str, typo) {
    var pagination = $('.product__pagination');
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
    var pagination = $('.product__pagination');
    var sortMethod = $('#sortFilter select').val().trim();
    var pdivholder = $('.dataDiv .contentDiv .productDiv .col-sm-12');
    btn.html('<i class="fa fa-spinner fa-spin"></i>');
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
   var i_html = i.html();
    i.html('<i class="fa fa-spinner fa-spin"></i>');
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
                var data = JSON.parse(data);
                populateProducts(data[0]);
                $('.product__pagination').html(JSON.parse(data[1]));
                i.html(i_html);
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
        var pagination = $('.product__pagination');
        var paginationLastItem = $('.product__pagination a:eq(3)').html();
        loadNextMenu(paginationLastItem, pagination);
    } else if (str.indexOf('<i class="fa fa-chevron-left"></i>') !== -1) {
        var pagination = $('.product__pagination');
        var paginationLastItem = $('.product__pagination a:eq(1)').html();
        loadPrevMenu(paginationLastItem, pagination);
    } else {
        loadPage(str, div);
    }
}

function loadPage(str, div) {
    var q = getUrlParameterKario('q');
    var t = getUrlParameterKario('t');
    var brand = checkSelectedBrandOption();
    var priceFrom = $('.price-range-wrap .price-input input:eq(0)').val();
    var priceTo = $('.price-range-wrap .price-input input:eq(1)').val();
    var filter = $('#sortFilter select').val();
    //div.html('<i class="fa fa-spinner fa-spin"></i>');
    div.innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
    var pdivholder = $('#row-products');
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
                populateProducts(data);
    });
//test(priceFrom+'<br>'+priceTo+'<br>'+filter+'<br>Brand: '+brand);
}

function loadNextMenu(paginationLastItem, pagination) {
    var q = getUrlParameterKario('q');
    var t = getUrlParameterKario('t');
    var brand = checkSelectedBrandOption();
    var priceFrom = $('.price-range-wrap .price-input input:eq(0)').val();
    var priceTo = $('.price-range-wrap .price-input input:eq(1)').val();
    var filter = $('#sortFilter select').val();
    $('.product__pagination a:eq(4)').html('<i class="fa fa-spinner fa-spin"></i>');
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
    $('.product__pagination a:eq(0)').html('<i class="fa fa-spinner fa-spin"></i>');
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
    var pdivholder = $('#row-products');
    var brandName = div.children('span:eq(0)').text();
    //change this to a spinnnig thing
    div.children('span:eq(0)').html('<i class="fa fa-spinner fa-spin"></i>');

    //get the price and pagination of this thing
    //price
    var priceFrom = $('.price-range-wrap .price-input input:eq(0)').val();
    var priceTo = $('.price-range-wrap .price-input input:eq(1)').val();
    var sortOrder = $('#sortFilter select').val();

    var pagination = $('.product__pagination');

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
                $('.set-bg').each(function () {
                    var bg = $(this).data('setbg');
                    $(this).css('background', 'linear-gradient(rgba(0,0,0,.03), rgba(0,0,0,0.03)),url(' + bg + ')');
                    // $(this).css({});
            
                });
            }
    );

}

//**********function check selected brand**********
function checkSelectedBrandOption() {
    var theDiv = $('#brandData');
    var name = theDiv.find('input:checked').parent().parent().children('span:eq(0)').text();
    return name;
}

//*********Buy now button clicked***********
function buyProduct(str,btn){
    var pname = $(btn).attr('value');
    var quantity = 1;
    addToCartInterface2(pname,quantity,btn);
    document.location.href='shopping-cart.php';
}

//***** FUNCTION POPULATE THE PRODUCT DIV********/
function populateProducts(data){
    var dd = '';
    var data = JSON.parse(data);
    for(var a = 0; a < data.length;a++){

        dd+=`
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="`+data[a].image+`">
                    
                        <ul class="product__item__pic__hover">
                            <li><a href="#" value="`+data[a].name+`" onclick="buyProduct('',this)"><i class="fa fa-money"></i></a></li>
                            <li><a href="#" value="`+data[a].name+`" onclick="addToCart('',this)"><i class="fa fa-shopping-cart"></i></a></li>
                        </ul>
                </div>
                <div class="product__item__text">
                    <h6><a href="product.php?name=`+data[a].name+`">`+data[a].name+`</a></h6>
                    <h5>Ksh `+data[a].price+`</h5>
                </div>
            </div>
        </div>
        `;
    }
    $('#row-products').html(dd);
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background', 'linear-gradient(rgba(0,0,0,.03), rgba(0,0,0,0.03)),url(' + bg + ')');
        // $(this).css({});

    });
}