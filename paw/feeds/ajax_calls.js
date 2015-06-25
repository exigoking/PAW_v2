$(document).ready(function(){
	countExt = 1;
	countFB = 0;
	countGM = 0;
	setInterval(function(){
	//countExt = 1;
   // $("h2").click(function(e){
	//e.preventDefault();
		
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
		$.ajax({
            url:"http://localhost/facebook/getting_data.php",
            type:"post",
            data: {'action': 'update'},
			dataType: "json",
            success: function(response){
				facebookHandler(response,countFB);	
			},
            complete: function(jqXHR, textStatus) {
				//$("body").html(textStatus);
            },
            error: function(jqXHR, textStatus, errorThrown) {
            }
		});
		/*$.ajax({
            url:"gmail_inbox_get.php",
            type:"post",
            data: {'action': 'update'},
			dataType: "json",
            success: function(response){
				gmailHandler(response,countExt);
			},
            complete: function(jqXHR, textStatus) {
				$("body").html(textStatus);
            },
            error: function(jqXHR, textStatus, errorThrown) {
				//$("body").html(textStatus);
            }
		});*/
	},40000); //36 seconds
            
            
       
});

function tweetsHandler(response,countExt){
	var contentPackageCount = 0;
	var dt = new Date();
	var showChar = 45;
	var countExt_aux = countExt;
	var current_month = ["January","February","March","April","May","June","July","August","September","October","November","December"][dt.getMonth()];
	var current_day = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"][dt.getDay()];
	//listing last tweets from response in prepending order
	if(response == null){
		;
	}
	else{
	for (var i = countExt; i < 26+countExt; i = i + 1){
		//contentPackageCount = contentPackageCount + 1;
		
		var string = response[i].text;
		var c = string.substr(0,showChar);
		var h = string.substr(showChar,string.length - showChar);
		
	
		//var partStrings = response[i].text.split(' ');
		//$(".feeds").prepend("<div id="+i+" class=\"tweet\"  style=\"display:none\">"+partStrings[0]+" "+partStrings[1]+" "+partStrings[2]+" "+partStrings[3]+" "+partStrings[4]+"...</div>");
		tmp = "<div id="+i+" class='tweet'><div class='newTweet'><input type='image' src='./pics/twitter_icon.png' class='twitter_icon' />"+c+"<span id=hide"+i+" class = \"moreContent\" style=\"display:none\">" + h + "</span></div></div>";
		$(".feeds").prepend(tmp);
		//$(".feeds").find("#"+i).slideDown('slow'); 
		//$(".moreContent").hide("slow");
		$(".newTweet").find(".twitter_icon").click(function(){
				//$(".tweet:not(this)").hide('slow');
				$(this).siblings(".moreContent").toggle("slow");
				$(selected) = $(this).find(".moreContent");
				$(isVisible) = $(selected).is(":visible");
				if($(isVisible)){
					$(selected).hide('slow');
				}
				else{
					$(selected).toggle('slow');
				}
		});
		
		
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
	
}

function facebookHandler(response,countFB){
	var contentPackageCount = 0;
	var dt = new Date();
	var showChar = 45;
	var countFB_aux = countFB;
	var current_month = ["January","February","March","April","May","June","July","August","September","October","November","December"][dt.getMonth()];
	var current_day = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"][dt.getDay()];
	if(response == null){
		;
	}
	else{
	for (var i = countFB; i < 26+countFB; i = i + 1){
		//contentPackageCount = contentPackageCount + 1;
		
		var string = response[i].message;
		var c = string.substr(0,showChar);
		var h = string.substr(showChar,string.length - showChar);
		
		
		//var partStrings = response[i].text.split(' ');
		//$(".feeds").prepend("<div id="+i+" class=\"tweet\"  style=\"display:none\">"+partStrings[0]+" "+partStrings[1]+" "+partStrings[2]+" "+partStrings[3]+" "+partStrings[4]+"...</div>");
		tmp = "<div id="+i+" class='tweet'><div class='newTweet'><input type='image' src='./pics/facebook_icon.png' class='twitter_icon' />"+c+"<span id=hide"+i+" class = \"moreContent\" style=\"display:none\">" + h + "</span></div></div>";
		$(".feeds").prepend(tmp);
		//$(".feeds").find("#"+i).slideDown('slow'); 
		//$(".moreContent").hide("slow");
		$(".newTweet").find(".twitter_icon").click(function(){
				//$(".tweet:not(this)").hide('slow');
				$(this).siblings(".moreContent").toggle("slow");
				$(selected) = $(this).find(".moreContent");
				$(isVisible) = $(selected).is(":visible");
				if($(isVisible)){
					$(selected).hide('slow');
				}
				else{
					$(selected).toggle('slow');
				}
		});
		
		
		$("#"+i).css("border-bottom-style","solid");
		$("#"+i).css("border-bottom-color","#B8B8E6");
		$("#"+i).css("border-bottom-width","thin");
		
		
		$(".feeds").prepend("<div id=screen_name"+i+">@"+response[i].sender_name+"</div>");
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
		
		
		if(response[i].message == null)
		{
			break;
		}
		countFB = countFB + 1;
		//$(".feeds").append("contentPackageCount = "+contentPackageCount+" ");
	}
	}
	
	
	
}

function gmailHandler(response,countGM){
	var contentPackageCount = 0;
	var dt = new Date();
	var showChar = 70;
	var countGM_aux = countGM;
	var current_month = ["January","February","March","April","May","June","July","August","September","October","November","December"][dt.getMonth()];
	var current_day = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"][dt.getDay()];
	//listing last tweets from response in prepending order
	//if(response == null){
	//	;
	//}
	//else{
	for (var i = countGM; i < 26+countGM; i = i + 1){
		//contentPackageCount = contentPackageCount + 1;
		
		var string = response[i].sender;
		var c = string.substr(0,showChar);
		var h = string.substr(showChar,string.length - showChar);
		
	
		//var partStrings = response[i].text.split(' ');
		//$(".feeds").prepend("<div id="+i+" class=\"tweet\"  style=\"display:none\">"+partStrings[0]+" "+partStrings[1]+" "+partStrings[2]+" "+partStrings[3]+" "+partStrings[4]+"...</div>");
		tmp = "<div id="+i+" class='tweet'><div class='newTweet'><input type='image' src='./pics/gmail_icon.png' class='twitter_icon' />"+c+"<span id=hide"+i+" class = \"moreContent\" style=\"display:none\">" + h + "</span></div></div>";
		$(".feeds").prepend(tmp);
		//$(".feeds").find("#"+i).slideDown('slow'); 
		//$(".moreContent").hide("slow");
		$(".newTweet").find(".twitter_icon").click(function(){
				//$(".tweet:not(this)").hide('slow');
				$(this).siblings(".moreContent").toggle("slow");
				$(selected) = $(this).find(".moreContent");
				$(isVisible) = $(selected).is(":visible");
				if($(isVisible)){
					$(selected).hide('slow');
				}
				else{
					$(selected).toggle('slow');
				}
		});
		
		
		$("#"+i).css("border-bottom-style","solid");
		$("#"+i).css("border-bottom-color","#B8B8E6");
		$("#"+i).css("border-bottom-width","thin");
		
		
		$(".feeds").prepend("<div id=screen_name"+i+">@"+response[i].sender+"</div>");
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
		
		
		if(response[i].sender == null)
		{
			break;
		}
		countGM = countGM + 1;
		//$(".feeds").append("contentPackageCount = "+contentPackageCount+" ");
	}
	//}
	
}