<?php session_start();
include_once("includes.php");

$num=isset($_REQUEST['num'])?$_REQUEST['num']:'';
$search_method=isset($_REQUEST['search_method'])?$_REQUEST['search_method']:'';


$listing_object=new Listing;
$user_object=new User;

$data_array['listnum']=$listnum;

	  $listing_detail=$listing_object->get_listing_detail($num);
	  $user_id=$listing_detail['user_id'];
	  $user_detail=$user_object->get_user_detail($user_id);
	  $header_id = $user_object->get_header_detail($user_detail['header_id']);
$zip=$user_detail['zip'];
$address=$user_detail['address'];
$city=$user_detail['city'];
$state=$user_detail['state'];
 
$google_address			 = " $address, $city, $state $zip";	
$title="Hot Buys Cars Print Brochure ".$google_address;
?>

<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $listing_detail['title'];?></title>
<meta name="keywords" content="<?php echo WEBSITE_META_TAGS;?>" />
<meta name="description"  content="<?php echo WEBSITE_META_DESCRIPTION;?>" />


<style type="text/css">
body
{
font:Arial;
}
<!--
.style3 {font-size: 18px}
.style6 {color:#000000; font-size:14px; }
.style7 {font-size: 16px; font-weight: bold;}
.style8 {font-size: 12px}
.style19 {
	color: #000000;
	font-size: 24px;
}
.style9 {
	color: #000000;
	font-size: 20px;
}
.style10 {
	color: #BE783B;
	font-weight: bold;
}
.style11 {color: #BE783B}
.style12 {
	font-size: 20px;
	font-style: italic;
}
-->
</style>


<?php include_once($includepath."ajax_contents.js.php");?>
<script type="text/javascript">
	window.print();
</script>
</head>
<body>

<?php
if(count($listing_detail)>0 and is_array($listing_detail))
{
?>
<table width="650" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <td colspan="3"><?php 
				
					if($header_id)
					{
						$header_image_url= SITE_URL.USER_HEADER_IMAGES.$header_id['header_image'];
					}
					else
					{
					$header_image_url=SITE_URL."images/logo.png";
					}
				?><img src="<?php echo $header_image_url;?>" width="650" height="134" alt=""></td>
  </tr>
  <tr>
    <td colspan="3"   height="8px"></td>
  </tr>
  <tr>
    <td >&nbsp;</td>
     <td align="center" colspan="2"><span class="style19 style3"><?php echo $listing_detail["title"];?></span></td>
  </tr>
  <tr>
    <td width="210" height="400px" valign="top" align="center"><table width="150" border="0" align="center" cellpadding="2" cellspacing="5" >
  <tr>
    <td width="172" align="left" class="style6"><img src="<?php echo SITE_URL.SITE_LAYOUT_IMAGES."realtor_print_borcher_image.jpg"; ?>" alt="Real Estate"></td>
  </tr>
  <tr>
    <td align="left" class="style6"><center class="style7">
      <h2><?php echo display_amount($listing_detail['price']);?></h2>
      </center></td>
  </tr>
 
 
 
 <tr>
    <td align="left" class="style6" ><center class="style3">HIGHLIGHTS
    </center></td>
  </tr>
 
 <tr>
    <td align="left" class="style6"><center><hr style="color:#E5DECE; width:70px;"></center></td>
  </tr>
 
 
 <tr>
    <td align="left" class="style6">Year: <?php echo $listing_detail['year'];?></td>
  </tr>
  <tr>
    <td align="left" class="style6">Make: <?php echo $listing_detail['make'];?></td>
  </tr>
  <tr>
    <td align="left" class="style6">Moldel: <?php echo $listing_detail['model'];?></td>
  </tr>
   <tr>
    <td align="left" class="style6">Body Style: <?php echo $listing_detail['body_style'];?></td>
  </tr>
  <tr>
    <td align="left" class="style6">Engine: <?php echo $listing_detail['engine'];?></td>
  </tr>
  <tr>
    <td align="left" class="style6">Trans: <?php echo $listing_detail['trans'];?></td>
  </tr>
  <tr>
    <td align="left" class="style6">Fuel: <?php echo $listing_detail['fuel'];?></td>
  </tr>
  
  <tr>
    <td align="left" class="style6">Miles/Km: <?php echo $listing_detail['miles'];?></td>
  </tr>
  <tr>
    <td align="left" class="style6">Vin: <?php echo $listing_detail['vin'];?></td>
  </tr>
  <tr>
    <td align="left" class="style6">Stock #: <?php echo $listing_detail['stock_no'];?></td>
  </tr>
 
 <tr>
    <td align="left" class="style6">&nbsp;</td>
  </tr>
 
 <tr>
    <td align="left" class="style6" valign="top"> 
      <div align="left">
        <?php
		
										$profile_image_url='';
										
										
/*											if($user_detail['profile_info']['profile_image'])
											{
												$profile_image_url=$user_detail['profile_info']['profile_image']['thumbUrlPath'];
											}
											else
											{
												$profile_image_url=SITE_URL."web/theme/images/no_photo.jpg";
											
											}		
*/	?>										
										
								
        <!--<img src="<?php echo $profile_image_url;?>" alt="Realtor" width="93" height="130"  >--></div></td>
  </tr>
 

 
 
  
</table> </td>
    <td width="3" valign="top">&nbsp;</td>
    <td width="498" valign="top"><table width="460" border="0" cellspacing="1" cellpadding="1">
 
  <tr>
    <td>  <?php
							
			$image_location=SITE_URL.SITE_LISTING_THUM_PATH.$listing_detail['images_array'][0]['image_name'];
			$image_count=0;
			$image_count=count($listing_detail['images_array']);
							 
			if(!empty($listing_detail['images_array'])): 
			foreach($$listing_detail['images_array'] as $images):
				$img = SITE_URL.SITE_LISTING_THUM_PATH.$newimages_list['image_name'];
				$profile_image_url = $img; 
			endforeach; 
			else:
				$profile_image_url = "images/lp_fl_no_image.jpg";
			endif;
							?>
    <img src="<?php echo $image_location;?>"  width="450" height="320" align="left"></td>
  </tr>
  <tr>
    <td>  <?php
							$a=0;
							$table_data_array=array();
							$image_url ="";
							if($image_count>0)
							{
								$b=0;
								foreach($listing_detail['images_array'] as $record)
								{
								
									if($image_count>1)
									{
										if($a>0 and $a<4)
										{
											$image_url= SITE_URL.SITE_LISTING_THUM_PATH.$record['image_name'];
											$table_data_array[$b]="<img src='".$image_url."' width='150px' height='120' >";
											$b++;
																			
										}
										
									}
									else
									{
										 $image_url= SITE_URL.SITE_LISTING_THUM_PATH.$record['image_name'];
										 $table_data_array[$b]="<img src='".$image_url."' width='150px' height='120' >";
									}
									$a++;
								}
								
							}
							
							function make_table_custum($tbl,$style){
								echo "<table style='$style'>";
								echo "<tr>";
								foreach($tbl as $newtbl){
									echo "<td>".$newtbl."</td>";
								}
								echo "</tr>";
								echo "</table>";	
							}
							$style=' width="450" align="left"';
							echo make_table_custum($table_data_array,$style);
		 ?> </td>
  </tr>
  <tr>
    <td height="6px"></td>
  </tr>
  <tr>
    <td><center><span class="style9 style3"><?php echo $google_address;?></span>
    </center></td>
  </tr>
  <tr>
    <td align="center" valign="top"> <table width="420" border="0" cellspacing="1" cellpadding="1">
      
       <tr>
    <td height="6px" colspan="2"></td>
  </tr>
      <tr>
        <td valign="top"><span class="txt style8"><strong>Description:</strong></span></td>
        <td>&nbsp;</td>
        <td valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="3" valign="top">
        <p class="txt style8"> <?php echo $listing_detail["description"]; ?></p>
        </td>
       </tr>
     
    </table></td>
  </tr>
</table>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><p><em>Please  give us a call to arrange a test drive: <?php echo show_toll_free_new($user_detail['profile_info']['local'],$user_detail['profile_info']['toll_free'],$user_detail['profile_info']['toll_free_ext'],$user_detail['profile_info']['extention']);?></span><strong>      </strong></p></td>
  </tr>
  <tr>
    <td colspan="3" valign="top"><table width="100%" border="0" cellspacing="1" cellpadding="1">
  <tr>
    <?php
    $is_http='';
										$website_link='';
										$is_http=strpos(strtolower($user_detail['profile_info']['own_website']),"http://");
										if(!$is_http and $user_detail['profile_info']['own_website']!='')
										{
											//$website_link="http://";
										}
										$website_link.=$user_detail['profile_info']['own_website'];
	?><td width="83%" valign="top">
    <?php if($website_link!='' and $is_user_exist)
										
	{
	?>
    <p><em>For more info and listings visit my website:</em><span class="style11"><?php echo $website_link;?></span> </p>  <?php
    }
	?></td>
    <td width="17%">&nbsp;</td>
  </tr>
  <tr>
    <td valign="top">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table></td>
  </tr>
</table>
<div align="center">
  <?php
}
else
{
?>

  <span class="style3">No Data Found</span>
<?php
}
?>
</div>
</body>
</html>
