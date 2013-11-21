<!DOCTYPE html>
<html lang="en">
<head>
<title>Hotbuycars</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/styles.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/_err.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="js/superfish.js" type="text/javascript"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="js/jquery.carouFredSel-6.2.0-packed.js"></script>
<script type="text/javascript" src="js/jquery.jcarousel.js" ></script>
<script type="text/javascript" src="js/jquery.simplyscroll.js"></script>
<script type="text/javascript" src="js/jquery.jqtransform.js" ></script>
<link rel="stylesheet" href="css/jquery.simplyscroll.css" media="all" type="text/css">
<script type="text/javascript" src="js/jquery.ad-gallery.js"></script>
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="css/jquery.ad-gallery_indx.css">
<link href="SpryAssets/SpryTooltip.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/global.js"> </script>
<script src="js/common.js" type="text/javascript"></script>


<script src="js/jquery.msgBox.js" type="text/javascript"></script>
<link href="css/msgBoxLight.css" rel="stylesheet" type="text/css">

<!--[if lt IE 8]>
        <div style=' clear: both; text-align:center; position: relative;'>
            <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx?ocid=ie6_countdown_bannercode"><img src="http://storage.ie6countdown.com/assets/100/images/banners/warning_bar_0000_us.jpg" border="0"  alt="" /></a>
        </div>
	<![endif]-->
<!--[if lt IE 9]>
   		<script type="text/javascript" src="js/html5.js"></script>
        <link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
	<![endif]-->
<script>
$(function() {
	<!--$("#box-make div.jqTransformSelectWrapper ul li a").click(function(){    --> 
   <!-- var value= $("#box-make div.jqTransformSelectWrapper span").text()-->
   $('#make').change( function(){
 		  var value = $(this).val();
		  $.ajax({
		  type: 'POST',
		  data: ({ajax_make : value}),
		  url: 'ajax_control.php',
		  success: function(data) {
			   var opt = jQuery.parseJSON(data);
			   var pre_select = '<option value="anymodel">Any Model</option>';
				var select = '<span class="name-input1">Model:</span><select name="model" id="model">'+pre_select;
				for(var i = 0; i < opt.length; i++){
					select += '<option value="'+ opt[i]['model_name'] +'"> '+ opt[i]['model_name'] +'</option>';
				}
				select += '</select>';
				$('#box-model').html(select);
				$('#region,#type,#make,#model').jqTransSelect();			

			  }
        });
});   
	$('#make_new').change( function(){
 		  var value = $(this).val();
		  $.ajax({
		  type: 'POST',
		  data: ({ajax_make : value}),
		  url: 'ajax_control.php',
		  success: function(data) {
			   var opt = jQuery.parseJSON(data);
			   var pre_select = '<option value="anymodel">Any Model</option>';
				var select = '<span class="name-input1">Model:</span><select name="model_new" id="model_new">'+pre_select;
				for(var i = 0; i < opt.length; i++){
					select += '<option value="'+ opt[i]['model_name'] +'"> '+ opt[i]['model_name'] +'</option>';
				}
				select += '</select>';
				$('#box-model_new').html(select);
				$('#region,#type_new,#make_new,#model_new').jqTransSelect();		

			  }
        });
});   
	$('#make_pop').change( function(){
 		  var value = $(this).val();
		  $.ajax({
		  type: 'POST',
		  data: ({ajax_make : value}),
		  url: 'ajax_control.php',
		  success: function(data) {
			   var opt = jQuery.parseJSON(data);
			   var pre_select = '<option value="anymodel">Any Model</option>';
				var select = '<select name="model_tab" id="model_tab" class="mm_frm">'+pre_select;
				for(var i = 0; i < opt.length; i++){
					select += '<option value="'+ opt[i]['model_name'] +'"> '+ opt[i]['model_name'] +'</option>';
				}
				select += '</select>';
				$('#box-model_pop').html(select);
				
			  }
        });
});   
	$('#make_tab').change( function(){
			  var value = $(this).val();
			  $.ajax({
			  type: 'POST',
			  data: ({ajax_make : value}),
			  url: 'ajax_control.php',
			  success: function(data) {
				   var opt = jQuery.parseJSON(data);
				   var pre_select = '<option value="anymodel">Any Model</option>';
					var select = '<select name="model_tab" id="model_tab" class="mm_frm">'+pre_select;
					for(var i = 0; i < opt.length; i++){
						select += '<option value="'+ opt[i]['model_name'] +'"> '+ opt[i]['model_name'] +'</option>';
					}
					select += '</select>';
					$('#box-model_tab').html(select);
					
				  }
			});
	});
	//<<<<</-------------SCROLL JQUERY
	$('li a img').click( function() {
		var body_style = $(this).attr("alt");	
	
            $.ajax({
                type: 'POST',
                data: ({body_style : body_style}),
                url: 'ajax_control.php',
                success: function(data) {
                     $('.tab_container-1').html(data);
					 $("html, body").animate({ scrollTop: 570 });
					 $('ul li').removeClass("active");
					 $('ul li:first-child').addClass("active");;

          }
        });
		
	});
	$('.box-form-button input[type=checkbox]').removeClass('jqTransformHidden');
	//<<<<</-------------MODAL JQUERY LOADING
	  $("body").on({
	  ajaxStart: function() { 
		  $(this).addClass("loading"); 
	  },
	  ajaxStop: function() { 
		  $(this).removeClass("loading"); 
	  }    
	});
	//<<<<</-------------FUNCTION GET $_GETS
	function get_query(){
			var url = location.href;
			var qs = url.substring(url.indexOf('?') + 1).split('&');
			for(var i = 0, result = {}; i < qs.length; i++){
				qs[i] = qs[i].split('=');
				result[qs[i][0]] = decodeURIComponent(qs[i][1]);
			}
			return result;
		}
		
	$('span a').click( function() {
		var listing = $(this).text();
		var $_GET = get_query();
		
		//alert($_GET['tab'] + $_GET['listing-page']);
		
		
	});
	//$('.colmask div.top_title').html("Click on your city or region to find Dealers nearest you");
	
});
  
</script>
<link rel="stylesheet" href="js/colorbox/colorbox.css" />
<script src="js/colorbox/jquery.colorbox.js"></script>
</head>
<body id="page1">
<div class="main-bg">
  <div class="top-line">
    <div class="main">
      <div class="container_12">
        <div class="wrapper">
          <div class="grid_12">
            <ul class="top-menu">
              <li><a href="#">VISIT OUR OTHER HOTBUY SITES ... </a></li>
              <li><a href="#">HotBuyTrucks</a></li>
              <li><a href="#">HotBuyRV</a></li>
              <li class="third"><a href="#">HotBuyBoats</a></li>
              <li class="four"><a href="#">HotBuyMotorsports</a></li>
              <li class="five"><a href="#">HotBuyHome</a></li>
              <li><a href="#"></a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="main"> 
    <!--==============================header=================================-->
    <header>
      <div class="wrapper indent-bot">
        <div class="right-box">
          <div class="header-search">
            <div class="wrapper header-search-ind">
              <ul class="top-links">
              <li class="first"><a href="#">Login</a></li>
              <li class="third"><a href="#">Tweet Us</a></li>
              <li class="second"><a href="#">Like Us</a></li>
            </ul>
            </div>
          </div>
          <div class="wrapper">
            <div class="fright"> <a href="approved.php" class="header-but"><span></span>You're Approved!</a></a> <a href="getapproved.php" class="header-but1"><span></span>Get Approved!</a></a> </div>

<div class="header-search"> 
           <form name="header-search" id="header-search" method="get" action="search-inventory.php">
                <fieldset>
                  <div class="wrapper1"> <a class="search-button" href="#" onClick="document.getElementById('header-search').submit()"></a>
                    <label><span>
                      <input name="search" id="search" value="Keyword Search Inventory" onBlur="if(this.value=='') this.value='Keyword Search Inventory'" onFocus="if(this.value =='Keyword Search Inventory' ) this.value=''" />
                      </span></label>
                  </div>
                </fieldset>
              </form>
              </div>

              
          </div>
        </div>
        <h1><a href="index.php">car sale</a></h1>
      </div>