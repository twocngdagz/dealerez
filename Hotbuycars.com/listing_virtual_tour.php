<?php
session_start();
include_once("includes.php");

$num=isset($_REQUEST['num'])?$_REQUEST['num']:false;
$user_type=isset($_REQUEST['user_type'])?$_REQUEST['user_type']:false;
$img_no=isset($_REQUEST['img_no'])?$_REQUEST['img_no']:false;
 
 if($user_type==USER_TYPE_DEALER)
{
	$listing_object= new Listing();
}
else if($user_type==USER_TYPE_REALTOR)
{
	$listing_object= new Home_listing();
}
else if($user_type==USER_MERCHANT_PRODUCT)
{
	$listing_object= new Products();
}
else if($user_type==USER_MERCHANT_SERVICES)
{
	$listing_object= new Services();
}
else
{
	echo "<center>No data available for your request</center>";
	exit;
}
 $listing_detail = $listing_object->get_listing_images($num,false);
 
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $listing_detail['title'];?></title>
<meta name="keywords" content="<?php echo WEBSITE_META_TAGS;?>" />
<meta name="description"  content="<?php echo WEBSITE_META_DESCRIPTION;?>" />


<style>
	
	
#slid_thums a {
display:block;
float:left;
padding:2px;
position:relative;
}
	#slid_thums a:visited
	{
	color:#03649B;
	}
#slid_thums a:link {
color:#03649B;

}
#slid_thums a:hover {
color:#FF0000;


}
.slid_thums_img {

border:2px solid #03649B;
}
.slid_thums_img_hover {

border:2px solid #990033;
}


	</style>
	
<script language="javascript">

function set_item_class(obj_id,className)
{

if (navigator.appName == "Microsoft Internet Explorer") {

document.getElementById(obj_id).setAttribute("className", className);
}
else {
document.getElementById(obj_id).setAttribute("class", className);
} 


}
</script>
<link rel="stylesheet" type="text/css" href="http://www.hotbuysthisweek.com/web/theme/css/slideshow.css" media="screen" />
<link rel="stylesheet" type="text/css" href="http://www.hotbuysthisweek.com/web/theme/css/lightbox.css" media="screen" />
<script type="text/javascript" src="http://www.hotbuysthisweek.com/web/theme/jscript/mootools.js"></script>
<script type="text/javascript" src="http://www.hotbuysthisweek.com/web/theme/jscript//slideshow.js"></script>
<script type="text/javascript" src="http://www.hotbuysthisweek.com/web/theme/jscript//slideshow_002.js"></script>
<script type="text/javascript" src="http://www.hotbuysthisweek.com/web/theme/jscript//slideshow.kenburns.js"></script>
<script type="text/javascript" src="http://www.hotbuysthisweek.com/web/theme/jscript/lightbox.js"></script>
    
    <script type="text/javascript">		
	//<![CDATA[
	  window.addEvent('domready', function(){
	  
	    var data = {
		
		<?php 
		$images_count=count($listing_detail);
		$var_loop=0;
		if($images_count>0)
		{
		 foreach ($listing_detail as $upload)
		 { $var_loop++; ?>
                           
						   '<?php echo SITE_URL.SITE_LISTING_IMAGES_PATH.$upload['image_name'] ?>': { thumbnail: '<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$upload['image_name'] ?>'}
						   
						   <?php if($var_loop<$images_count){  echo ",";}?> 
						   
						   
			 <?php 
			 	
			}
			}
		?>
	          
		
	    };
	   
		
		var myShow = new Slideshow.KenBurns('show', data, { captions: true, controller: true, delay: 5000, duration: 2000, thumbnails: true,height: 340,href:'#',thumbnails: true,linked: false,width: 485 });
	

		
	  });
	//]]>
	</script>
</head>

</head>
<body>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="3"><img src="<?php echo SITE_URL."hotbuycars/images/logo.png";?>" alt="" width="400" height="79" border="0" /></td>
  </tr>
  <tr>
   <td width="5px;">&nbsp;</td>
    <td width="490px" valign="top"> <?php
							 $image_location= SITE_URL.SITE_LISTING_THUM_PATH.$listing_detail['image_name'];
							?>
                            
                            
                             <div  style="width:485; height:360px;" align="left" >
                             <div id="show" class="slideshow" align="left" style="width:485;height:340px;" >
 
 
					 <a rel="lightbox" href="<?php echo $image_location; ?>"  >	   
						    
    <img src="<?php echo $image_location; ?>"  />   
    </a>
  
   
   
   
    <style>
   .slideshow-thumbnails
   {height:65px;
    
   }
   .slideshow
   {
   border:0px #FFFFFF;
   }
   .slideshow-thumbnails img 
   {
     width:60px;
	 height:50px;
 
    
    
   }
   </style>
   </div>
   
    </div>
	
	<div style="width:490;"  id="slid_thums">
	
                    </div>       
                            
                             </td>
    <td valign="top" width="200"><img src="<?php echo SITE_URL."hotbuycars/images/ad2.jpg";?>" width="200px"></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>


</body></html>


