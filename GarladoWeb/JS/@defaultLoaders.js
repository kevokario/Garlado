$(document).ready(function () {
    //    The Toggle menus logic
    /************************************************************/
    $(".logo h2 .myLog").click(function () {
        $(".logo .myProductMenu").toggle();
    });
    $(".Etc .myAcbtn").click(function () {
        $(".Etc .login").toggle();
    });
    $('.Etc .myCart').click(function () {
        $('.Etc  .myShpCart').toggle();
    });

    $('.searchBar .search').keyup(function () {
        searchItem();
    });
    $('#blockDiv2').mouseenter(function () {
        $('#genCdata').css('display', 'inline-block');
    });
    $('#genCdata').mouseover(function () {
        $('#blockDiv2').css('display', 'block');
    });
    $('#closeMenu').click(function () {
        unLoadData();
    });
//    $('.customerLoginForm').click(function(){
//        alert('Welcome');
//    });
    $(document).scroll(function () {
        var st = $(this).scrollTop();
        if (st > 70) {
            $(".logo .myProductMenu").hide();
        }
    });


//    The hovering button logic
    /************************************************************/
    var rotState = 'not';
    var showcustomerLogin = 'false';
    $('#main').click(function () {
        $('#main i').css('transform', 'rotate(135deg)');
        if (rotState === 'not') {
            if (showcustomerLogin === 'true') {
                $('#menuDiv').css('height', '270px');
            } else {

                $('#menuDiv').css('height', '206px');
            }
            rotState = 'else';
        } else {
            $('#main i').css('transform', 'rotate(0deg)');
            $('.myDiv .opt2 .optContent')
                    .fadeOut(300, function () {
                        $('#menuDiv').css('height', '0');
                    });

            rotState = 'not';
        }
    });
    $('.myDiv .opt2 .close').click(function () {
        $('.myDiv .opt2 .optContent')
                .fadeOut(300);
    });
    //m1 : Login Action
    $('.m1').click(function () {
        loadLogin();
    });
    //m2 : cart Action
    $('.m2').click(function () {
        loadCart();
    });
    //m3 : help action
    $('.m3').click(function () {
        loadHelp();
    });

    //Search Function
    /************************************************************/
    $('.searchBar button').click(function () {
        searchItemsClicked($('.searchBar .search').val());
    });
    $('.genPMenu').html('<i class="fa fa-pulse fa-refresh text-center"></i>');
    $.post("Core/preloader",
            {
                cat: "loadMajors"
            },
            function (data, status) {
                if (status === 'success') {
                    $('.genPMenu').html(data);
                } else {
                    $('.genPMenu').html('No Internet Connection!');
                }
            }
    );

    //loadDefault Datas
    /************************************************************/
    loadMajorGroupData();
    loadMostBoughtData();
    loadMajorGroup1Data();
    getCart();




});

