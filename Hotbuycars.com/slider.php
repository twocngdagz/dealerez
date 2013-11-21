<?php  session_start();

include("includes.php");


$listing_obj = new Listing;
$listingByState = $listing_obj->getall_listing(1,10,"created_date","DESC","state = 'Utah'");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
/*----------------------- Home page Slider Css ------------------------------*/


body { margin: 0px; padding: 0px; }
#slideshow { list-style: none; color: #fff }
#slideshow span { display: none }
#wrapper { width: 702px; margin: 0px auto; display: none }
#wrapper * { margin: 0; padding: 0 }
#fullsize { position: relative; width: 702px; height: 344px; background: #000 }
#fullsize img { width: 702px !important; height: 344px !important; }
#information { position: absolute; bottom: 0; width: 702px; height: 0; background: #000; color: #fff; overflow: hidden; z-index: 200; opacity: .7; filter: alpha(opacity=70); line-height:30px}
#information h3 { padding: 4px 8px 3px; font-size: 16px; font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
#information p { padding: 0 8px 8px; font-family: Arial, Helvetica, sans-serif; font-size: 16px; text-align: left; color: #FFF; font-weight: bold }
#information p span { color: #f23342; padding-left: 10px; }
#information p span a { width: 96px; height: 30px; background: url(images/learn_more_btn.jpg) }
#information1 p img { width: 96px !important; height: 30px !important; float: right !important; margin-bottom:5px !important; }
#image { width: 702px }
#image img { position: absolute; z-index: 25; width: auto; height: 145% !important; margin-top: -100px; }
.imgnav { position: absolute; width: 0%; height: 306px; cursor: pointer; z-index: 150 }
#imgprev { left: 0; }
#imgnext { right: 0; }
#imglink { position: absolute; height: 306px; width: 0%; z-index: 100; opacity: .4; filter: alpha(opacity=40); }
.linkhover { background: url(images/link.gif) center center no-repeat }
#thumbnails { margin-top: 2px; padding: 8px; border: 1px solid #c1c1c1; height: 81px }
#thumbnails img { width: 127px; height: 84px;  }
#slideleft { float: left; width: 0px; height: 0px; }
#slideleft:hover { }
#slideright { float: right; width: 0px; height: 0px; }
#slideright:hover { }
#slidearea { float: left; position: relative; width: 683px; margin-left: 0px; height: 81px; overflow: hidden  }
#slider { position: absolute; left: 0; height: 81px }
#slider img { cursor: pointer; border: 0px solid #666; margin: 0px; padding-right: 7px;}
</style>
</head>

<body>
<ul id="slideshow">
<?php 
foreach($listingByState as $newdata) {
	
	$lid = $newdata['listing_id'];
	$name = $newdata['year']." ".$newdata['make']." ".$newdata['model'];
	$price = "$".number_format($newdata['price']);
	
	
	 foreach($newdata['image_name'] as $list_image => $image_name_usedcars) {
?>
  <li>
    <h3></h3>
    <span><?php echo SITE_URL."sandbox/web/uploads/listing/".$image_name_usedcars['image_name']; ?></span>
    <p><?php echo $name; ?><span><?php echo $price; ?></span> 
    
    
    <span style=" float:right; background:url(images/learn_more_btn.jpg) no-repeat right top; width:96px; height:30px;">
    <a href="listingdetail.php?lid=<?php echo $lid; ?>" style="width:96px; height:30px; display:block" target="_blank"></a></span></p>
    
    <img src="" alt="" />
 </li>
<?php
	 }
}
?>
</ul>
<div id="wrapper">
  <div id="fullsize">
    <div id="imgprev" class="imgnav" title="Previous Image"></div>
    <div id="imglink"></div>
    <div id="imgnext" class="imgnav" title="Next Image"></div>
    <div id="image"></div>
    <div id="information">
      <h3></h3>
      <p></p>
    </div>
  </div>
  <div id="thumbnails">
    <div id="slideleft" title="Slide Left"></div>
    <div id="slidearea">
      <div id="slider"></div>
    </div>
    <div id="slideright" title="Slide Right"></div>
  </div>
</div>
</body>
<script type="text/javascript" src="js/compressed.js"></script>
<script type="text/javascript">
	$('slideshow').style.display='none';
	$('wrapper').style.display='block';
	var slideshow=new TINY.slideshow("slideshow");
	window.onload=function(){
		slideshow.auto=true;
		slideshow.speed=5;
		slideshow.link="linkhover";
		slideshow.info="information";
		slideshow.thumbs="slider";
		slideshow.left="slideleft";
		slideshow.right="slideright";
		slideshow.scrollSpeed=4;
		slideshow.spacing=5;
		slideshow.active="#fff";
		slideshow.init("slideshow","image","imgprev","imgnext","imglink");
	}
</script>
</html>
