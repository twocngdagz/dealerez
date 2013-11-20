<?php  session_start();
	include_once("includes.php");
	$user_id=$_SESSION['user_id'];
	$includepath="ext/includes/";
	$apipath	="ext/api/";
	include_once($includepath."connection.inc.php");
	include_once($includepath."constants.php");
	include_once($includepath."functions.php");
	include_once($includepath."html_functions.php");
	include_once($apipath."user.class.php");
	include_once($apipath."listing.class.php");


$page = isset($_REQUEST['page'])? $_REQUEST['page']:1;
$action = isset($_REQUEST['action'])? $_REQUEST['action']:false;
$make = isset($_REQUEST['make'])? $_REQUEST['make']:false;
$price_from = isset($_REQUEST['price_from'])? $_REQUEST['price_from']:false;
$price_to = isset($_REQUEST['price_to'])? $_REQUEST['price_to']:false;
$listing_id = isset($_REQUEST['listing_id'])? $_REQUEST['listing_id']:false;


$cur_page=$page;

$listing_object= new Listing();
$listing_data=$listing_object->get_user_custum_listing($user_id,RESULT_PER_PAGE,$page,$make,$price_from,$price_to,$listing_id);

if(count($listing_data)>0)
{
	$tot_count=count($listing_data);
	if(!$tot_count>0)
	{
		$tot_count=0;
	}
}
else
{
	$tot_count=0;	
}
ob_start();

?>


<div style="width:100%; display:none"  id="loading_detail_div" >
  <center>
    <img src="<?php echo SITE_LAYOUT_IMAGES;?>/loading.gif"   align="middle"/>
  </center>
  <center>
   <font size=2 color="#FFFFFF"> <b>Searching  Vehicle Detail</b></font>
  </center>
</div>

<div style="width:100%; display:none"  id="loading_div" >
  <center>
    <img src="<?php echo SITE_LAYOUT_IMAGES;?>/loading.gif"   align="middle"/>
  </center>
  <center>
   <font size=2 color="#FFFFFF"> <b>Searching  Vehicle</b></font>
  </center>
</div>
</center>
<div align="center" style="color:#FFFFFF"> <br>
  <b><font size="3" ><span class="style47">Search Results</span></font><span class="style48"> <font size="3" >=</font></span><span class="style50">
  <?= $tot_count ?>
 </span><font size="3"><span class="style50">listings</span></font></b><br>
  <?php

 if ($tot_count > 0)
 {
	$url=ereg_replace('&page=[0-9]+', '', $_SERVER['REQUEST_URI']);
	$pagination=generate_pagination($tot_count,RESULT_PER_PAGE,$cur_page,$url);
?>
  <div align=center><font size=2 color="#FFFFFF">
    <table  border="0" cellpadding="1" cellspacing="3">
      <tr>
        <td width="95%" align="center" style=" font-size:13px;background-color:#202423;" ><?php echo $pagination['paging']; ?></td>
      </tr>
    </table>
    </font></div>
  <?php }

?>
  <?php if ($tot_count > 0) : ?>
  <table  border="0" cellpadding="1" cellspacing="3">
    <tr>
      <td width="95%" align="center" style=" font-size:13px;background-color:#202423;" ><span style="font-family: Arial, Helvetica, sans-serif"><font size=2 color="#FFFFFF" style="background-color:#202423"  > Showing listings
        <?= RESULT_PER_PAGE * ($cur_page - 1) + 1 ?>
        -
        <?= (RESULT_PER_PAGE * ($cur_page - 1) + RESULT_PER_PAGE <= $tot_count) ? RESULT_PER_PAGE * ($cur_page - 1) + RESULT_PER_PAGE : $tot_count ?>
        </font></span></td>
    </tr>
  </table>
  <?php endif ?>
</div>
<br>
<hr color="#FFFFFF" size="2" />
<div  style="width:100%; height:479px; overflow:scroll; background-color:#202423" class="clientArea">
  <?php
  if($listing_data["error"]=='')
  {
  	 if($tot_count>0)
	 {
		  foreach($listing_data as $detail)
		  {
		 
	  ?>
  <table width="100%" border="0" cellpadding="0" cellspacing="1" style="font-weight:bold; font-size:12px; color:#535756 ">
    <tr>
      <td width="114"  rowspan="5" >
      <?php if(count($listing_data)>0)
						  {
						  ?>
                         
                          <?php
						  if($detail['image_1']=="")
						  {
						  	$image_location=SITE_LAYOUT_IMAGES."coming_soon.gif";
						  }
						  else
						  {
						 	 $image_location=SITE_LISTING_THUM_PATH.$detail['image_1'];
						  }
					}
						  ?>
      <img src="<?php echo $image_location; ?>" width="100px;"  height="80px"    style="cursor:pointer" onclick="get_listing_detail('get_detail','<?php echo $detail["listing_id"];?>','','');"/> </td>
    </tr>
    <tr>
      <td width="208" style="color:#C39F15"><span class="price_color">$<?php echo number_format($detail["price"]); ?></span></td>
    </tr>
    <tr>
      <td ><span class="span_title text_color"><?php echo $detail["title"]; ?></span></td>
    </tr>
    <tr>
      <td ><?php echo $detail["make"]; ?></td>
    </tr>
    <tr>
      <td><a onclick="get_listing_detail('get_detail','<?php echo $detail["listing_id"];?>','','');" style="font-weight: bold; font-size: 12px; color:#2B80FF; cursor:pointer;"><u>View</u> </a></td>
    </tr>
    <tr>
      <td><span class="style45"><?php echo $listing_data["error"]; ?></span></td>
    </tr>
  </table>
  <hr  style="color:#CCCCCC"/>
  <?php
			}
	}
	else
	{
	?>
  <center>
    <span class="style45">No Listing Found</span>
  </center>
  <?php
	}
}
	else
	{
	?>
  <table width="100%" border="0" cellpadding="0" cellspacing="1" style="font-weight:bold; font-size:12px; color:#535756 ">
    <tr>
      <td><center><span class="style45"><?php echo $listing_data["error"]; ?></span></center></td>
    </tr>
  </table>
  <?php
	}
	?>
</div>
<?php
$body=ob_get_contents();
ob_end_clean();
echo $body;
?>
