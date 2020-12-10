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
    var data = $('.hero__search__form input').val();
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
    $('.hero__search__form input').val(str);
}
function filPClicked(str) {
    $('.hero__search__form input').val(str);
    $('#searchResult').hide();
}

function searchItemsClicked(str) {
    document.location.href='shop.php?t=search&q='+str;
}
/*
  ---------------------
  this function is responsible
  for fetching all tems b group from
  the server and rendering them
  as links on the client side
  ---------------------

*/
function getNavLinks(){
  $.post("Core/preloader.php",
          {
              cat: "loadMajors"
          },
          function (data, status) {
              if (status === 'success') {
                var json = JSON.parse(data);
                $('#categories_menu');
                var uls = '';
                //populate the large nav option
                for(var a = 0; a<json.length;a++){
                  uls+='<li><a href="shop.php?q='+json[a][0]+'&t=m12">'+json[a][0]+'</a>';
                    if(json[a][1].length>0){
                      uls+=`<div class="hero__categories__details">
                              <div class="hero_sublinks">`;
                      for (var b = 0; b < json[a][1].length; b++) {
                          uls+=`
                                  <ul>
                                      <h6><a href="shop.php?q=`+json[a][1][b][0]+`&t=c12">`+json[a][1][b][0]+`</a></h6>`;
                                      if(json[a][1][b][1].length>0){
                                        for (var c = 0; c < json[a][1][b][1].length; c++) {
                                          uls+='<li><a href="shop.php?q='+json[a][1][b][1][c]+'&t=m23">'+json[a][1][b][1][c]+'</a></li>';
                                        }
                                      }
                            uls+=`</ul>`;
                      }
                      uls+=`</div>
                      </div>`;
                    }
                  uls+='</li>';
                }

                var uls_m = '';
                // populate the mobile menu
                for(var a = 0; a<json.length;a++){
                  uls_m+='<li><a href="shop.php?q='+json[a][0]+'&t=m12">'+json[a][0]+'</a>';
                    if(json[a][1].length>0){

                      for (var b = 0; b < json[a][1].length; b++) {
                          uls_m+=`
                                  <ul class="header__menu__dropdown">
                                      <h6><a href="shop.php?q=`+json[a][1][b][0]+`&t=c12">`+json[a][1][b][0]+`</a></h6>`;
                                      if(json[a][1][b][1].length>0){
                                        for (var c = 0; c < json[a][1][b][1].length; c++) {
                                          uls_m+='<li><a href="shop.php?q='+json[a][1][b][1][c]+'&t=m23">'+json[a][1][b][1][c]+'</a></li>';
                                        }
                                      }
                            uls_m+=`</ul>`;
                      }

                    }
                  uls_m+='</li>';
                }
                  $('#categories_menu').html(uls);
                  $('#categories_menu_mobile nav').html(uls_m);
                  $(".mobile-menu").slicknav({
                      prependTo: '#mobile-menu-wrap',
                      allowParentLinks: true
                  });
              } else {
                  alert('No network');
              }
          }
  );
}

function loadMajorGroupData() {
    $.post('Core/preloader.php',
            {
                cat: 'loadMajorGroupData'
            },
             (data, status) =>{
                var json = JSON.parse(data);
                var items = '';
                for(var a = 0; a < json.length; a++){
                  items+=`
                  <div class="col-lg-3">
                      <div class="categories__item set-bg" data-setbg="`+json[a].pic+`">
                          <h5><a href="`+json[a].url+`">`+json[a].name+`</a></h5>
                      </div>
                  </div>
                  `;
                }
                  $('#categories_section').html(items);
                $('.set-bg').each(function () {
                    var bg = $(this).data('setbg');
                    $(this).css('background', 'linear-gradient(rgba(0,0,0,.05), rgba(0,0,0,0.05)),url(' + bg + ')');
                });
                $(".categories__slider").owlCarousel({
                    loop: true,
                    margin: 0,
                    items: 4,
                    dots: false,
                    nav: true,
                    navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
                    animateOut: 'fadeOut',
                    animateIn: 'fadeIn',
                    smartSpeed: 1200,
                    autoHeight: false,
                    autoplay: true,
                    responsive: {

                        0: {
                            items: 1,
                        },

                        480: {
                            items: 2,
                        },

                        768: {
                            items: 3,
                        },

                        992: {
                            items: 4,
                        }
                    }
                });

            }
    );
}

function loadMostBoughtData() {
    var featured__controls_ul = $('#featured__controls');
    $.post('Core/preloader.php',
            {
                cat: 'loadMostBoughtData'
            },
            function (data, status) {
                var json = JSON.parse(data);

                //populate the links feature
                var li = '';
                var cont = '';
                for (var i = 0; i < json.length; i++) {
                  if(i==0){
                    li = '<li class="active" data-filter="*">All</li>';
                  } else {
                    li += '<li  data-filter=".'+json[i].filter+'">'+json[i].name+'</li>';
                  }
                   // populate the rest of the data
                   for (var a = 0; a < json[i].data.length; a++) {
                     cont +=`
                     <div class="col-lg-3 col-md-4 col-sm-6 mix `+json[i].filter+`">
                         <div class="featured__item">
                             <div class="featured__item__pic set-bg" data-setbg="`+json[i].data[a].pic+`">
                                <!-- 
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="`+json[i].data[a].url+`"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="`+json[i].data[a].url+`"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                 -->
                             </div>
                             <div class="featured__item__text">
                                 <h6><a href="product.php?name=`+json[i].data[a].product+`">`+json[i].data[a].product+`</a></h6>
                                 <h5>`+json[i].data[a].price+`</h5>
                             </div>
                         </div>
                     </div>
                     `;
                   }
                }
                $('#featured__controls').html(li);
                $('#featured__filter').html(cont);
                /*------------------
                    Gallery filter
                --------------------*/
                $('.featured__controls li').on('click', function () {
                    $('.featured__controls li').removeClass('active');
                    $(this).addClass('active');
                });
                if ($('.featured__filter').length > 0) {
                    var containerEl = document.querySelector('.featured__filter');
                    var mixer = mixitup(containerEl);
                }
                $('.set-bg').each(function () {
                    var bg = $(this).data('setbg');
                    $(this).css('background', 'linear-gradient(rgba(0,0,0,.03), rgba(0,0,0,0.03)),url(' + bg + ')');
                    // $(this).css({});

                });
                // console.log(data);
            }
    );
}
function loadMajorGroup1Data() {
    var section = $('#product__slider_section');
    var items = ``;
    $.post('Core/preloader.php',
            {
                cat: 'loadMajorGroup1Data'
            },
            function (data, status) {
              var json = JSON.parse(data);
               for (var a = 0; a < json.length; a++) {
                    items+=`<div class="col-lg-4 col-md-6">
                                    <div class="latest-product__text">
                                          <h4>`+json[a].name+`</h4>`;
                    if (json[a].data.length>0) {
                      items +=`<div class="latest-product__slider owl-carousel">
                                  <div class="latest-prdouct__slider__item">`;
                                  var l = 0;
                      for (var b = 0; b < 3; b++) {

                        items+=`<a href="product.php?name=`+json[a].data[b].item_name+`" class="latest-product__item">
                                  <div class="latest-product__item__pic">
                                    <!--<img src="img/latest-product/lp-3.jpg" alt="">-->
                                       <img style='height: 110px !important;
                                                   width: 110px !important;'
                                            src="`+json[a].data[b].item_pic+`" alt="">
                                  </div>
                                  <div class="latest-product__item__text">
                                      <h6>`+json[a].data[b].item_name+`</h6>
                                      <span>`+json[a].data[b].item_price+`</span>
                                  </div>
                              </a>`;
                      }
                      items+=`</div>
                        </div>`;
                    }
                    items+=`</div>
                      </div>
                      `;
               }


                 $('#product__slider_section').html(items);
                 $(".latest-product__slider").owlCarousel({
                     loop: true,
                     margin: 0,
                     items: 1,
                     dots: false,
                     nav: true,
                     navText: ["<span class='fa fa-angle-left'><span/>", "<span class='fa fa-angle-right'><span/>"],
                     smartSpeed: 1200,
                     autoHeight: false,
                     autoplay: true
                 });
                 // $('#product__slider_section .owl-nav').removeClass('disabled')
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
                    $('.cart').html(jsonData.length);
                    var js = '';
                    var dd = 0;
                    for (i = 0; i < jsonData.length; i++) {
                        js += '<tr><td>' + jsonData[i][0] + '</td><td>' + jsonData[i][2] + '</td><td>' + jsonData[i][1] + '</td><td><button onclick="removeFromCart(this.value,this)" value="' + i + '" class="btn btn-sm btn-danger"> <i class="fa fa-trash-o"></i></button></td><tr>';
                        dd+=jsonData[i][1];
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
    var name = $(btn).attr('value');
    $(btn).children('i').removeClass('fa shopping-cart');
    $(btn).children('i').addClass('fa fa-spin fa-spinner');
    $.post('Core/preloader.php',
            {
                cat: 'addToCartInterface',
                name: name
            },
            function (data, status) {
                var jsonData = JSON.parse(data);
                var js = '';
                $('.cart').html(jsonData.length);
                for (i = 0; i < jsonData.length; i++) {
                    js += '<tr><td>' + jsonData[i][0] + '</td><td>' + jsonData[i][2] + '</td><td>' + jsonData[i][1] + '</td><td><button onclick="removeFromCart(this.value,this)" value="' + i + '" class="btn btn-sm btn-danger"> <i class="fa fa-trash-o"></i></button></td><tr>';
                }
                visibleCart.html(js);
                loadCart();
                $(btn).children('i').removeClass('fa fa-spin fa-spinner');
                $(btn).children('i').addClass('fa fa-shopping-cart');
            }
    );
}

//******************THIS FUNCTION HANDLES THE DELETE ACTION***********************
function removeFromCart(str, btn) {
    var visibleCart = $('#cartData');
    $(btn).children('i').removeClass('fa fa-trash-o');
    $(btn).children('i').addClass('fa fa-spin fa-spinner');
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
                $(btn).children('i').removeClass('fa fa-spin fa-spinner');
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
    var small = $(parentDiv).children('small');
    
    small.addClass('text-danger');
    if (data.length === 0) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Please provide username');
    } else if (data.length > 0 & data.length < 5) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Your username should be atleast 5 letters long!');
    } else {
        $(input).removeClass('is-invalid');
        $(input).addClass('is-valid');
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
    var small = $(parentDiv).children('small');
    
    small.addClass('text-danger');
    if (data.length === 0) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Please provide password');
    } else if (data.length > 0 & data.length < 5) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Your password should be atleast 5 letters long!');
    } else {
        $(input).removeClass('is-invalid');
        $(input).addClass('is-valid');
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
    var small = $(parentDiv).children('small');
    
    var atposition = data.indexOf('@');
    var dotposition = data.indexOf(".");
    small.addClass('text-danger');
    if (data.length === 0) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Please provide Email');
    } else if (data.length > 0 & data.length < 5) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Your Email should be atleast 5 letters long!');
    } else if (dotposition < 1 || atposition < 1 || (dotposition - atposition) < 2 || (data.length - dotposition) < 3) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Provide a valid email, e.g, onlineduka@example.com');
    } else {
        $(input).removeClass('is-invalid');
        $(input).addClass('is-valid');
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
    var small = $(parentDiv).children('small');
    
    small.addClass('text-danger');
    if (data.length === 0) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Please provide Your name');
    } else if (data.length > 0 & data.length < 3) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Your name should be atleast 3 letters long!');
    }  else if (/[^a-z A-Z]/.test(data)) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Please provide a valid name');
    }

    else {
        $(input).removeClass('is-invalid');
        $(input).addClass('is-valid');
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
    var small = $(parentDiv).children('small');
    
    small.addClass('text-danger');
    if (data.length === 0) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Please provide Your phone number');
    } else if (data.length > 0 && data.length !==10) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Your phone number should contain 10 digits only!');
    }  else if (/[^0-9]/.test(data)) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Please provide only digits');
    } else if (data.substr(0, 2) !== '07') {
        result = false;
        $(small).html('Please begin your phone numbr with <b>07</b>');
        $(input).removeClass('is-valid').addClass('is-invalid');
    } 

    else {
        $(input).removeClass('is-invalid');
        $(input).addClass('is-valid');
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
    var small = $(parentDiv).children('small');
    
    small.addClass('text-danger');
    if (data.length === 0) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Please provide the code sent to you');
    }
    else {
        $(input).removeClass('is-invalid');
        $(input).addClass('is-valid');
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
    var small = $(parentDiv).children('small');
    
    small.addClass('text-danger');
    if (data === '---Select Country---') {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Please select Country');
    }
    else {
        $(input).removeClass('is-invalid');
        $(input).addClass('is-valid');
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
    var small = $(parentDiv).children('small');
    
    small.addClass('text-danger');
    if (data==='---Select County---') {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Please select County');
    }
    else {
        $(input).removeClass('is-invalid');
        $(input).addClass('is-valid');
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
    var small = $(parentDiv).children('small');
    
    small.addClass('text-danger');
    if (data==='---Select State---') {
        $(input).removeClass('is-invalid');
        $(input).addClass('is-valid');
        small.text('Please select State');
    }
    else {
        $(input).removeClass('is-invalid');
        $(input).addClass('is-valid');
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
    var small = $(parentDiv).children('small');
    
    small.addClass('text-danger');
    if (data==='---Select Station---') {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Please select a Station');
    }
    else {
        $(input).removeClass('is-invalid');
        $(input).addClass('is-valid');
        small.text('');
        result = true;
    }
    return result;
}

function validateDescription(input){
     var result = false;

    var data = $(input).val();
    var parentDiv = $(input).parent().parent();
    var small = $(parentDiv).children('small');
    
    small.addClass('text-danger');
    if (data.length===0 || data.length < 10) {
        $(input).removeClass('is-valid');
        $(input).addClass('is-invalid');
        small.text('Please provide a detailed description for timely delivery');
    }
    else {
        $(input).removeClass('is-invalid');
        $(input).addClass('is-valid');
        small.text('');
        result = true;
    }
    return result;
}

$(document).ready(function(){
    getCart();
});