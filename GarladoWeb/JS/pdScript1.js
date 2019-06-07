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
    var imagediv = $('.imageBuyDiv .col-sm-7');

    var marketPrice = $('.imageBuyDiv .col-sm-5 table tbody tr:eq(0) td:eq(2) span');
    var ourPrice = $('.imageBuyDiv .col-sm-5 table tbody tr:eq(1) td:eq(2) span');
    var payablePrice = $('.imageBuyDiv .col-sm-5 table tbody tr:eq(3) td:eq(2) span');

    marketPrice.html('<i class="fa fa-pulse fa-refresh"></i>');
    ourPrice.html('<i class="fa fa-pulse fa-refresh"></i>');
    payablePrice.html('<i class="fa fa-pulse fa-refresh"></i>');

    $.post('Core/preloader.php',
            {
                cat: 'pdloadImageDivData',
                name: name
            },
            function (data, status) {
                var img = data.substring(data.indexOf('~') + 1, data.indexOf('!'));
                var imagUrl = '<img src="../productImages/' + img + '" alt="' + name + '"/>';
                imagediv.html(imagUrl);
                marketPrice.html(data.substring(data.indexOf('|') + 1, data.indexOf('_')));
                ourPrice.html(data.substring(data.indexOf('!') + 1, data.indexOf('|')));
                payablePrice.html(data.substring(data.indexOf('!') + 1, data.indexOf('|')));
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
    var div = $('.morePicDiv .row');
    var before = '<div class="col-sm-4"><i class="fa fa-pulse fa-refresh"></i></div>';
    for (var a = 0; a < 4; a++) {
        before = before + '<div class="col-sm-4"><i class="fa fa-pulse fa-refresh"></i></div>';
    }
    div.html(before);
    $.post('Core/preloader.php',
            {
                cat: 'loadMorePicDivData', name: name
            },
            function (data, success) {
                div.html(data);
            }
    );
}
function loadMoreProductsDivDatapD() {
    var div = $('.otherProducts .row');
    var before = '<div class="col-sm-3"><i class="fa fa-pulse fa-refresh"></i></div>';
    for (var a = 0; a < 7; a++) {
        before = before + '<div class="col-sm-3"><i class="fa fa-pulse fa-refresh"></i></div>';
    }
    div.html(before);
    $.post('Core/preloader.php', {
        cat: 'loadMoreProductsDivDatapD'
    }, function (data, status) {
        div.html(data);
    });
}

