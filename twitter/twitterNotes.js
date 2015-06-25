$(document).ready(function(){
	countExt = 1;
	//setInterval(function(){
	//countExt = 1;
    $("h2").click(function(e){
	e.preventDefault();
		
	  	$.ajax({
            url:"twitterIndex.php",
            type:"post",
            data: {'action': 'update'},
			dataType: "json",
            success: function(response){
				tweetsHandler(response,countExt);	
			},
            complete: function(jqXHR, textStatus) {
				//$("body").html(textStatus);
            },
            error: function(jqXHR, textStatus, errorThrown) {
            }
		});
	});//,40000); //36 seconds
            
            
       
});

function tweetsHandler(response,countExt){
	var contentPackageCount = 0;
	var dt = new Date();
	var showChar = 40;
	var countExt_aux = countExt;
	var current_month = ["January","February","March","April","May","June","July","August","September","October","November","December"][dt.getMonth()];
	var current_day = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"][dt.getDay()];
	//listing last tweets from response in prepending order
	for (var i = countExt; i < 26+countExt; i = i + 1){
		//contentPackageCount = contentPackageCount + 1;
		
		var string = response[i].text;
		var c = string.substr(0,showChar);
		var h = string.substr(showChar-1,string.length - showChar);
		
		
		//var partStrings = response[i].text.split(' ');
		//$(".feeds").prepend("<div id="+i+" class=\"tweet\"  style=\"display:none\">"+partStrings[0]+" "+partStrings[1]+" "+partStrings[2]+" "+partStrings[3]+" "+partStrings[4]+"...</div>");
		tmp = "<div id="+i+" class = \"tweet\">"+c+"...<span id=hide"+i+" class = \"moreContent\">" + h + "</span></div>";
		$(".feeds").prepend(tmp);
		//$(".feeds").find("#"+i).slideDown('slow'); 
		
		
		
		$("#"+i).css("border-bottom-style","solid");
		$("#"+i).css("border-bottom-color","#B8B8E6");
		$("#"+i).css("border-bottom-width","thin");
		
		
		$(".feeds").prepend("<div id=screen_name"+i+">@"+response[i].user.screen_name+"</div>");
		$("#screen_name"+i).append("<div id=moment"+i+">"+dt.getHours()+":"+dt.getMinutes()+"</div>");
		$("#moment"+i).css("float","right");
		$("#moment"+i).css("text-align","right");
		$("#moment"+i).css("font-color","grey");
	
		
		$(".feeds").prepend("<div id=time"+i+"> "+current_day+", "+current_month+" "+dt.getDate()+", "+dt.getFullYear()+"</div>");
		$("#time"+i).css("border-bottom-style","solid");
		$("#time"+i).css("border-bottom-color","#47A3FF");
		
		
	
		/*$('.feeds').on('click', '.tweet', function(e) {
			e.preventDefault();
  			$('#'+i).slideDown('slow');	
		});*/
		
		
		if(response[i].text == null)
		{
			break;
		}
		countExt = countExt + 1;
		//$(".feeds").append("contentPackageCount = "+contentPackageCount+" ");
	}
	
	
}