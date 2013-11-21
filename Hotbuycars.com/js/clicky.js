$(function() {
	
	$('body').find('div').first().css("height","0");
	$('.carsoption').hide();
	
	var thisUrl =  $(window.parent.location).attr('href');
	
	$('.colmask div.top_title').html("");
	$('.colmask div.top_title').html("Your State Here");
	$('<br/> <img src="../images/down.png" alt="arrow" width="50" height="50"/>').insertAfter('.colmask div.top_title');
	$('ul li a').click( function() {
	//alert(thisUrl);
	var region = $(this).text();	
	
	if(thisUrl == "http://www.hotbuycars.com/searchcars.php" || thisUrl == "http://hotbuycars.com/searchcars.php") {
		var url = 'http://www.hotbuycars.com/listings.php?carlistings=1&region='+region;
		window.open(url, '_blank');
		}
	else{		
		var url = 'http://hotbuycars.com/dealers-list.php?region='+region;
		window.open(url, '_blank');	
		}
		
	});

});