<?php  session_start();
include_once("includes.php");
$lid = $_GET['listing_id'];

$listing_obj = new Listing();
$user_object = new User();
$img_no=isset($_GET['img_no'])?$_GET['img_no']:false;

$listing_detail = $listing_obj->get_listing_images($lid); 
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hotbuyers</title>
<link rel="stylesheet" href="http://www.dealerez.com/sandbox/web/theme/css/image-slideshow_detail.css" type="text/css">
<script type="text/javascript" src="http://www.dealerez.com/sandbox/web/theme/jscript/image-slideshow.js"></script>
</head>
<script language="Javascript">
   function PopupPic() {
  var sPicURL=document.getElementById('large_image_preview').src;
     window.open( "print_image.php?image_url="+sPicURL, "",  
     "resizable=1,HEIGHT=320,WIDTH=450");
   }
   </script>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
   <td width="5">&nbsp;</td>
    <td width="490"> 
	<?php
	$image_location=$listing_detail[0]['image_name'];
	?>       
 <div id="dhtmlgoodies_slideshow">
	<div id="previewPane"><img src="<?php echo SITE_URL.SITE_LISTING_LARGE_PATH.$image_location;?>"  width="485" height="360" align="left" id="large_image_preview"><span id="waitMessage"><img src="http://www.dealerez.com/sandbox/web/theme/images/loading.gif"></span></div>
    
	<div id="galleryContainer">
		<div id="theImages">
        
         <?php

		$var_count=0;
		
		foreach($listing_detail as $record)
		{
		 $image_location=$record;
		 $large_image_location=$record;
		 $var_count++;
		?>
        
        <a href="#" onClick="" onMouseOver="showPreview('<?php echo SITE_URL.SITE_LISTING_IMAGES_PATH.$large_image_location['image_name'];?>','<?php echo $var_count;?>','preview_<?php echo $var_count;?>');return false"><img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$image_location['image_name'];?>" width="60" height="50" id="preview_<?php echo $var_count;?>" class="preview_img_normal" onMouseOut="reset_preivew_class('preview_<?php echo $var_count;?>','preview_img_normal')"></a>
        <?php
			if($var_count==$img_no) {
				?>
				<script language="javascript">
				
				showPreview('<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$large_image_location['image_name'];?>','<?php echo $var_count;?>','preview_<?php echo $var_count;?>');
				
				</script>
				<?php
			}
		}
		?>				
				<!-- End image captions -->
				<div id="slideEnd"></div>
		</div>
	</div>
</div> </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
</body></html>


