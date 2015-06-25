// This function toggles messages on and off when clicked on the subject of the email
/*$(function () {
//info is the subject,date,from fields
$togglers = $(".toggler").children().hide();
//this.parent selects the parent division of the span element
//and searches for "selected" division which contains our message
$(".toggler").parent().text().click(function() {
   // $(".smart-green").hide();
    $(".toggler:not(this)").children().hide("slow");
   $selected = $(this).children();
   $isShowing = $selected.is(":visible");

    if($isShowing)
  {
      $selected.hide("slow");
  }
  else
  {
   $toggle = $selected.toggle("slow");
  }

});

});*/


$(function () {
//info is the subject,date,from fields
$(".atoggler").children().hide();

$(".btoggler").children().hide();
//this.parent selects the parent division of the span element
//and searches for "selected" division which contains our message
$("#switch_reg").click(function() {
   // $(".smart-green").hide();
    $(".btoggler").children().hide("slow");
   $selected = $(".atoggler").children();
   $isShowing = $selected.is(":visible");

    if($isShowing)
  {
      $selected.hide("slow");
  }
  else
  {
   $selected.slideDown("slow");
  }

});

$("#switch_sign").click(function() {
   // $(".smart-green").hide();
    $(".atoggler").children().hide("slow");
   $selected = $(".btoggler").children();
   $isShowing = $selected.is(":visible");

    if($isShowing)
  {
      $selected.hide("slow");
  }
  else
  {
   $selected.slideDown("slow");
  }

});

});