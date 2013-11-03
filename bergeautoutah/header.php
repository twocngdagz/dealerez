<?php 
ob_start();
if(!isset($_GET['debug'])) {
	//error_reporting(2);
//	ini_set('display_errors',1);
//	ini_set('display_startup_errors',1);
//	error_reporting(-1);

	define('DEBUG_MODE',false);

} else {

	define('DEBUG_MODE',true);	

}
	$page = basename($_SERVER['PHP_SELF'],".php");
?>
<!doctype html>
<html>
<head>
<meta charset="iso-8859-1" />
<title>Berge Auto | Used Car Dealer in Orem, UT | Pre Owned Lexus, Toyota, Honda, Acura, Mazda, Nissan</title>
<meta name="keywords" content="Berge Auto, New, User, Cars ,Orem, UT,84057" />
<meta name="description" content="Visit Berge Auto for a variety of used cars,New Cars  serving Orem, Utah" />
<meta name="author" content="Berge Auto" />
<meta name="expires" content="never" />
<meta name="distribution" content="global" />
<meta name="robots" content="index, follow" />
<meta name="google-site-verification" content="ssHL6lISH7fEMv54-GayxnFlkokyKAZPG-zjmGG4SGE" />

<meta name="msvalidate.01" content="" />
<meta name="og:title" content="Berge Auto | Used Car Dealer in Orem, UT | Pre Owned Lexus, Toyota, Honda, Acura, Mazda, Nissan, Orem, UT," />
<meta name="og:type" content="website" />
<meta name="og:url" content="http://www.bergeautosutah.com/" />
<meta name="og:description" content="Visit Berge Auto for a variety of used cars,New Cars  serving Orem, Utah" />
<meta name="locale" content="en_US" />

<link href="css/reset.css" rel="stylesheet" type="text/css">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<link href="css/dxmotors.css" rel="stylesheet" type="text/css">
<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script src="js/jquery.ad-gallery.js" type="text/javascript" ></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.2.2.js"></script>
<script src="js/jquery.validate.js"></script>

<link rel="stylesheet" type="text/css" href="css/<?php echo $page=='index'||$page=='dixiemotors'?"jquery.ad-gallery-index.css":"jquery.ad-gallery.css"; ?>">
<link rel="stylesheet" type="text/css" href="css/slider.css">
<link rel="shortcut icon" href="mini-car-icon_03.ico">

<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />
<script src="js/jquery.slides.min.js"></script>
<script>
$(function() {
	
	// index.php
      $('#slides').slidesjs({
        width: 940,
        height: 290,
        play: {
          active: true,
          auto: true,
          interval: 4000,
          swap: true
        }
      });
	
	var slider = $('.image-slider-gallery').adGallery();
	
    var galleries = $('.ad-gallery').adGallery();
    
	$('#qs').on('mouseover', function() {
		console.log("leo gwapo!");
	});
	
	$('.indeximg').on('click', function() {
		var link_ = $(this).parent('a')
			.attr("href");
			window.open(link_, '_parent');	
	});
	
	var x = $('#close');
	var $this = $(this);
	
	$('#close').on('mouseover', function() {
		$this.css("opacity","0.5");
	});
	x.on('click', function() {
		$('#quicksearch-wrapper').fadeOut();
	});
	
	$('#qs').on("click", function() {
		$('#quicksearch-wrapper').fadeToggle();
	});
	
	// listing_detail.php
	$('.fancybox').fancybox();
	
	var thumbs = $('a.aThumbs');
	
	thumbs.on('mouseover', function(e) {
				e.preventDefault();
				
				var href = $(this).data('img'),
					alt  = $(this).find('img').attr('alt'),
			       _link = $(this).attr('href');

					 $('#img-large').attr({"src":href});				  
				
			});
	thumbs.on('click', function(e) {
				e.preventDefault();
				
				var href = $(this).data('img');
				
				$('#img-large').attr("src",href);

			});
				
	$('a.showToggle').on('click', function(e) {
		e.preventDefault();
		$('p.none').slideToggle();
			$this = $(this);
			
			if($this.text() =="Show More >>" ) {
				$this.text("<< Show Less");	
			}
			else {
				$this.text("Show More >>");	
			}
	});
	//phone
	
	$('#contactphone').mask("(999) 999-9999"); 
	$('#phone').mask("(999) 999-9999");
	$('.phone').mask("(999) 999-9999"); 
	
	//listings
	$('.view-more a').on('click', function(e) {
		e.preventDefault();
		var view = $(this).parents("section.refine-search").find("dd.none");
		
		view.slideToggle();
			$this = $(this);
			
			if($this.text() =="View More" ) {
				$this.text("View Less");	
			}
			else {
				$this.text("View More");	
			}
	});
});
</script>

</head>
<body>
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-44190913-1']);
  _gaq.push(['_setDomainName', 'bergeautoutah.com']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

<div class="<?php echo $page=='index'?"wrapper":"wrapper-1"; ?>">
    <header>
    	<h1><a href="http://www.bergeautoutah.com/"><img src="img/logo-dixie.png" alt="bergeauto" /></a></h1>
        <div class="company-details">
        	<p class="phone-number">801-224-1555</p>
            <p class="streer-add">199 E. 800 N.</p>
            <p class="state-add">Orem, Utah</p>
        </div>
    </header>