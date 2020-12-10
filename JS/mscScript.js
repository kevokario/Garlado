$(document).ready(function () {
  $('#checkout').click(function(e){
      e.preventDefault();
      buyItems($(this));
  });
 $('.buyMyItems').click(function(){
     buyItems($(this));
 });
 loadShoppingListData();
 $('select').niceSelect();

});