// This function toggles messages on and off when clicked on the subject of the email
$(function () {
//info is the subject,date,from fields

//this.parent selects the parent division of the span element
//and searches for "selected" division which contains our message
//$(".msg").hide();
$(".info").click(function() {
  $(this).find(".selected").toggle("slow");
});

});