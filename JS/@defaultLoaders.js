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

    $('.hero__search__form input').keyup(function () {
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
        // var st = $(this).scrollTop();
        // if (st > 70) {
        //     $(".logo .myProductMenu").hide();
        // }
    });




    //Search Function
    /************************************************************/
    $('.hero__search__form form').submit(function (e) {
        e.preventDefault();
        searchItemsClicked($('.hero__search__form input').val());
    });
    $('.genPMenu').html('<i class="fa fa-pulse fa-refresh text-center"></i>');



    //loadDefault Datas
    /************************************************************/
    getNavLinks();
    loadMajorGroupData();
    loadMajorGroup1Data();
    loadMostBoughtData();
    // getCart();




});
