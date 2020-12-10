function loadBreadCrumb(name) {
    var crumb = $('.topPart .breadcrumb');
    $('.titleDiv h1 small').html('<i class="fa fa-pulse fa-refresh"></i>');
    crumb.html('<i class="fa fa-pulse fa-refresh"></i>');
    $.post('Core/preloader.php',
            {
                cat: 'pdBreadCrumb',
                name: name
            },
            function (data, status) {
                crumb.html(data);
                $('.titleDiv h1 small').html(name);
            }
    );
}
function loadImageDivData(name) {
    var imagediv = $('#main-description .product__details__pic__item');

    var marketPrice = $('.product__details__text  table tbody tr:eq(0) td:eq(2) span');
    var ourPrice = $('.product__details__text table tbody tr:eq(1) td:eq(2) span');
    var payablePrice = $('.product__details__text table tbody tr:eq(2) td:eq(2) span');

     marketPrice.html('<i class="fa fa-spinner fa-spin"></i>');
        ourPrice.html('<i class="fa fa-spinner fa-spin"></i>');
    payablePrice.html('<i class="fa fa-spinner fa-spin"></i>');

    $.post('Core/preloader.php',
            {
                cat: 'pdloadImageDivData',
                name: name
            },
            function (data, status) {
                var img = data.substring(data.indexOf('~') + 1, data.indexOf('!'));
                var imagUrl =  '<img class="product__details__pic__item--large" src="./productImages/' + img + '" alt="' + name + '">'; 
                imagediv.html(imagUrl);
                marketPrice.html(data.substring(data.indexOf('|') + 1, data.indexOf('_')));
                ourPrice.html(data.substring(data.indexOf('!') + 1, data.indexOf('|')));
                $('.product__details__text h3').html(name);
                $('.product__details__price').html('Ksh '+data.substring(data.indexOf('!') + 1, data.indexOf('|')));
                payablePrice.html(data.substring(data.indexOf('!') + 1, data.indexOf('|')));

                $('.product__details__pic__slider img').on('click', function () {

                    var imgurl = $(this).data('imgbigurl');
                    var bigImg = $('.product__details__pic__item--large').attr('src');
                    if (imgurl != bigImg) {
                        $('.product__details__pic__item--large').attr({
                            src: imgurl
                        });
                    }
                });
            }
    );
}

function loadFeaturesPd(name) {
    var list1 = $('.descriptionDiv ul .col-sm-6:eq(0)');
    var list2 = $('.descriptionDiv ul .col-sm-6:eq(1)');
    var pr = '<li><i class="fa fa-refresh fa-pulse"></i></li>';
    for (var a = 0; a < 1; a++) {
        pr += pr;
    }
    list1.html(pr);
    list2.html(pr);
    $.post(
            'Core/preloader.php', {
                cat: 'loadFeaturesPd',
                name: name
            },
            function (data, status) {
                var fb1s = data.substring(data.indexOf('{') + 1, data.indexOf('}'));
                var fb2s = data.substring(data.indexOf('}') + 1, data.indexOf('['));
                var fb1 = data.substring(data.indexOf('[') + 1, data.indexOf(']'));
                var fb2 = data.substring(data.indexOf(']') + 1, data.indexOf('|'));
                if (fb1s === '1' && fb2s === '1') {
                    list1.html(fb1);
                    list2.html(fb2);
                } else if (fb1s === '0' && fb2s === '1') {
                    list1.html(fb2);
                    list2.html('');
                } else if (fb1s === '1' && fb2s === '0') {
                    list1.html(fb1);
                    list2.html('');
                } else {
                    list1.html('<p style="margin:40px">.</p>');
                    list2.html('');
                }

            });
}

function loadMorePicDivData(name) {
    var div = $('#main-description .product__details__pic__slider');
    $.post('Core/preloader.php',
            {
                cat: 'loadMorePicDivData', name: name
            },
            function (data, success) {
                div.html(data);
                $(".product__details__pic__slider").owlCarousel({
                    loop: true,
                    margin: 20,
                    // items: 4,
                    dots: true,
                    smartSpeed: 1200,
                    autoHeight: false,
                    autoplay: true
                });

                $('.product__details__pic__slider img').on('click', function () {

                    var imgurl = $(this).data('imgbigurl');
                    var bigImg = $('.product__details__pic__item--large').attr('src');
                    if (imgurl != bigImg) {
                        $('.product__details__pic__item--large').attr({
                            src: imgurl
                        });
                    }
                });
            }
    );
}
function loadMoreProductsDivDatapD() {
    var div = $('.otherProducts .row:eq(1)');
    $.post('Core/preloader.php', {
        cat: 'loadMoreProductsDivDatapD'
    }, function (data, status) {
        div.html(data);
        $('.set-bg').each(function () {
            var bg = $(this).data('setbg');
            $(this).css('background', 'linear-gradient(rgba(0,0,0,.03), rgba(0,0,0,0.03)),url(' + bg + ')');
            // $(this).css({});
    
        });
    });
}

