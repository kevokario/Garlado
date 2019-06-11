$(document).ready(function(){
    // this function loads new orders and places them here
    checkOrder();
});

function checkOrder(){
    var spin = '<i class="fa fa-pulse fa-refresh"></i>';
    $('#mynav .myOrderBadge').html(spin);
    $.post('AjaxPhp/simpleQuery.php',
    {
        cat:'checkOrder'
    },
    function(data,status){
        $('#mynav .myOrderBadge').html(data);
    });
}