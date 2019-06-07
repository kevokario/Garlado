$(document).ready(function () {
    $(this).scroll(function () {
        if ($(this).scrollTop() > 70) {
            $('.myShoppingCartContainer').css('margin-top', '156px');
        } else {
            $('.myShoppingCartContainer').css('margin-top', '20px');
        }
    });
 $('.buyMyItems').click(function(){
     buyItems($(this));
 });
 loadShoppingListData();
});