<style type="text/css">
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
#image img { position: absolute; z-index: 25; width: auto }
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
  <li>
    <h3></h3>
    <span>photos/1.jpg</span>
    <p>Infinity G35 2005 <span>$15,750</span> <span style=" float:right; background:url(images/learn_more_btn.jpg) no-repeat right top; width:96px; height:30px;"><a href="#" style="width:96px; height:30px; display:block"></a></span></p>
     <a href="#"><img src="photos/1.jpg" alt="" /></a></li>
  <li>
    <h3></h3>
    <span>photos/2.jpg</span>
    <p>Hummer H3 2008 <span>$19,850</span> <span style=" float:right; background:url(images/learn_more_btn.jpg) no-repeat right top; width:96px; height:30px;"><a href="#" style="width:96px; height:30px; display:block"></a></span></p>
     <a href="#"><img src="photos/2.jpg" alt="" /></a></li>
  <li>
    <h3></h3>
    <span>photos/3.jpg</span>
    <p>Mini Cooper Turbo 2006 <span>$14.995</span> <span style=" float:right; background:url(images/learn_more_btn.jpg) no-repeat right top; width:96px; height:30px;"><a href="#" style="width:96px; height:30px; display:block"></a></span></p>
    <a href="#"><img src="photos/3.jpg" alt="" /></a> </li>
  <li>
    <h3></h3>
    <span>photos/4.jpg</span>
    <p>Toyota Tacoma 2005 <span>$$13.700</span> <span style=" float:right; background:url(images/learn_more_btn.jpg) no-repeat right top; width:96px; height:30px;"><a href="#" style="width:96px; height:30px; display:block"></a></span></p>
    <a href="#"><img src="photos/4.jpg" alt="" /></a> </li>
  <li>
    <h3></h3>
    <span>photos/5.jpg</span>
    <p>Nissan Altima Coupe 2008 <span>$12,988</span> <span style=" float:right; background:url(images/learn_more_btn.jpg) no-repeat right top; width:96px; height:30px;"><a href="#" style="width:96px; height:30px; display:block"></a></span></p>
     <a href="#"><img src="photos/5.jpg" alt="" /></a></li>
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

