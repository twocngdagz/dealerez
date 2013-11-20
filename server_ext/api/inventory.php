<?php session_start();
include_once("includes.php");
include_once("user_info.php");
include_once("header.php");

?>

<?php


$make = isset($_REQUEST['make'])? $_REQUEST['make']:false;
$num = isset($_REQUEST['num'])? $_REQUEST['num']:false;
$price_from = isset($_REQUEST['price_from'])? $_REQUEST['price_from']:false;
$price_to = isset($_REQUEST['price_to'])? $_REQUEST['price_to']:false;
show_calender_iframe();
?>
<style type="text/css">

.clientArea { 
 color: #000000;
 font-family: Verdana, Arial, Helvetica, sans-serif;
 font-size: 10pt;
 margin: 0px;
 overflow: auto;
 padding: 1px;
 scrollbar-face-color:#484745;
 scrollbar-highlight-color: #000000;
 scrollbar-3dlight-color: #000000;
 scrollbar-darkshadow-color: #000000;
 scrollbar-shadow-color: #000000;
 scrollbar-arrow-color: #ffffff;
 scrollbar-track-color: #000000;
}

</style>
<link href="web/theme/css/stylesheet.css" type="text/css" rel="stylesheet">
<link href="web/theme/css/custom_style.css" type="text/css" rel="stylesheet">
<link href="web/theme/css/style_2.css" rel="stylesheet" type="text/css" />
<style type="text/css">





.style7 {color: #D96B00}

.style31

{

color:#EEEEEE;

font-size: 15px;

font-weight:bold;

}

.style33 {font-size: 13px}

.style42 {font-family: Arial, Helvetica, sans-serif}

.style43 {color:#F40809;
font-family:Arial,Helvetica,sans-serif; }

.style53 {color: #CC9900}
.style56 {
font-family:Arial,Helvetica,sans-serif;
font-size:11px;
}
.style57 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.style59 {color: #D6D6D6}

.style47 {
color:#F40809;
font-family:Arial,Helvetica,sans-serif;
}
</style>
<?php
show_calender_iframe();
?>
 <script type="text/javascript" src="<?php echo SITE_JSCRIPT_PATH;?>validation.js"></script>

<table width="100%"  style="background:url(images/contents-bg.jpg); margin-top:0px; padding-top:0px;" >
  <tr>
    <td width="100%"  style="padding-top:0px;"><table width="100%" border="0" >
        <tr>
          <td width="305" class="side_bar_top2" valign="top"><table width="305" border="0" cellspacing="0" cellpadding="0">
              
              <tr>
                <td colspan="3" height="5">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" align="center" height="5"><span class="style31"><em>SHOP BY PRICE:</em></span></td>
              </tr>
			   <tr>
                <td colspan="3" align="center" >
				
				<table width="300px" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
                <td width="50%"   valign="top"><table width="100%" height="96" border="0" cellpadding="0" cellspacing="0" >
                    <tr>
                      <td width="12" class="page_medium_text style42">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                      <td width="124" valign="middle" class="page_medium_text style33 style42"><label class="arrow_image">></label>
                        &nbsp;<span class="span_price"  style="cursor:pointer;" onclick="get_listing('get_listing','','15000','19999');">$15,000 - $19,999</span></td>
                      <td width="10" class="page_medium_text style42" >&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="page_medium_text style42">&nbsp;</td>
                      <td valign="middle" class="page_medium_text style42"><label class="arrow_image">></label>
                        &nbsp;<span class="span_price" onclick="get_listing('get_listing','','10000','14999');">$10,000 - $14,999</span></td>
                      <td class="page_medium_text style42">&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="page_medium_text style42">&nbsp;</td>
                      <td valign="middle" class="page_medium_text style42"><label class="arrow_image">></label>
                        &nbsp;<span class="span_price" onclick="get_listing('get_listing','','5000','9999');">$5,000 - $9,999</span></td>
                      <td class="page_medium_text style42">&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="page_medium_text style42">&nbsp;</td>
                      <td valign="middle" class="page_medium_text style42"><label class="arrow_image">></label>
                        &nbsp;<span class="span_price" onclick="get_listing('get_listing','','500','4999');">$500 - $4,999</span></td>
                      <td class="page_medium_text style42">&nbsp;</td>
                    </tr>
                  </table></td>
                <td width="2%" >&nbsp;</td>
                <td width="48%"  valign="top"><table width="105%" height="98" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="10" class="page_medium_text style42">&nbsp;</td>
                      <td width="127" valign="middle" class="page_medium_text style42"><label class="arrow_image">></label>
                        <span class="span_price" onclick="get_listing('get_listing','','35000','');">$35,000 & UP</span></td>
                      <td width="4" class="style43" >&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="page_medium_text style42">&nbsp;</td>
                      <td valign="middle" class="page_medium_text style42"><label class="arrow_image">></label>
                        &nbsp;<span class="span_price" onclick="get_listing('get_listing','','30000','34999');">$30,000 - $34,999</span></td>
                      <td class="style43">&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="page_medium_text style42">&nbsp;</td>
                      <td valign="middle" class="page_medium_text style42"><label class="arrow_image">></label>
                        &nbsp;<span class="span_price" onclick="get_listing('get_listing','','25000','29999');">$25,000 - $29,999</span></td>
                      <td class="style43">&nbsp;</td>
                    </tr>
                    <tr>
                      <td height="19" class="page_medium_text style42">&nbsp;</td>
                      <td valign="middle" class="page_medium_text style42"><label class="arrow_image">></label>
                        &nbsp;<span class="span_price" onclick="get_listing('get_listing','','20000','34999');">$20,000 - $34,999</span></td>
                      <td class="style43">&nbsp;</td>
                    </tr>
                  </table></td>
              </tr>
</table></td>
              </tr>
              
              <tr>
                <td colspan="3" height="5">&nbsp;</td>
              </tr>
              <tr>
                <td colspan="3" align="center" ><form id="makes_form" name="makes_form" style="width:100%"><span class="style31"><em>SHOP BY MAKE:</em></span>
				
				<select style ="width:100px; font-size:12px;   background-color:#0A0A0A; color:#FFFFFF"  name="make" id="combox_makes" onchange="reload_page('combox_makes');">
				  <option selected="selected" >Select</option>
				  <option  value="">Any Make</option>
				  				   
				   <option value="AC Cars">AC Cars</option>
				   				   
				   <option value="Acura">Acura</option>
				    
				   			   				   
				   <option value="Alfa Romeo">Alfa Romeo</option>
				   				   
				   <option value="AMC">AMC</option>
				   				   
				   <option value="Aston Martin">Aston Martin</option>
				   				   
				   <option value="Audi">Audi</option>
				   				   
				   <option value="Austin">Austin</option>
				   				   
				   <option value="Bentley">Bentley</option>
				   				   
				   <option value="BMW">BMW</option>
				   				   
				   <option value="Borgward">Borgward</option>
				   				   
				   <option value="Bradley">Bradley</option>
				   				   
				   <option value="Bricklin">Bricklin</option>
				   				   
				   <option value="Buick">Buick</option>
				   				   
				   <option value="Cadillac">Cadillac</option>
				  				   				   
				   <option value="Checker">Checker</option>
				   				   
				   <option value="Chevrolet">Chevrolet</option>
				   				   
				   <option value="Chrysler">Chrysler</option>
				   				   
				 
				   				   
				   <option value="Daewoo">Daewoo</option>
				   				   
				   <option value="Daihatsu">Daihatsu</option>
				   				   
				   <option value="Damon">Damon</option>
				   				   
				   <option value="Datsun">Datsun</option>
				   				   
				   <option value="Davidson">Davidson</option>
				   				   
				   <option value="Delorean">Delorean</option>
				   				   
				   <option value="DeSoto">DeSoto</option>
				   				   
				   <option value="Dodge">Dodge</option>
				   				   
				  				   
				   <option value="Eagle">Eagle</option>
				   				   
				 
				   				   
				   <option value="Ferrari">Ferrari</option>
				   				   
				   <option value="Fiat">Fiat</option>
				   				   
				  
				   				   
				   <option value="Ford">Ford</option>
				   				   
				 
				   				   
				 
				   				   
				   <option value="Geo">Geo</option>
				   				   
				   <option value="GMC">GMC</option>
				   				   
				   
				   				   
				 
				   				   
				  
				   				   
				  
				   				   
				   <option value="Hino">Hino</option>
				   				   
				  
				   				   
				   <option value="Honda">Honda</option>
				   				   
				   <option value="Hudson">Hudson</option>
				   				   
				   <option value="Hummer">Hummer</option>
				   				   
				   <option value="Hyundai">Hyundai</option>
				   				   
				   <option value="Infiniti">Infiniti</option>
				   				   
				 
				   				   
				   <option value="Isuzu">Isuzu</option>
				   				   
				  
				   				   
				   <option value="Jaguar">Jaguar</option>
				   				   
				  
				   				   
				   <option value="Jeep">Jeep</option>
				   				   
				   <option value="Jensen">Jensen</option>
				   				   
				  
				   				   
				  
				   				   
				   <option value="Kia">Kia</option>
				   				   
				   			   				   
				   <option value="Lamborghini">Lamborghini</option>
				   				   
				   <option value="Land Rover">Land Rover</option>
				   				   
				   <option value="Lexus">Lexus</option>
				   				   
				   <option value="Lincoln">Lincoln</option>
				   				   
				   <option value="Lotus">Lotus</option>
				   				   
				
				   				   
				   <option value="Maserati">Maserati</option>
				   				   
				   <option value="Mazda">Mazda</option>
				   				   
				   <option value="Mercedes-Benz">Mercedes-Benz</option>
				   				   
				   <option value="Mercury">Mercury</option>
				   				   
				   <option value="MG">MG</option>
				   				   
				   <option value="MINI">MINI</option>
				   				   
				   <option value="Mitsubishi">Mitsubishi</option>
				   				   
				   <option value="Nash">Nash</option>
				   				   
				   <option value="Nissan">Nissan</option>
				   				   
				   <option value="Oldsmobile">Oldsmobile</option>
				   				   
				   <option value="Opel">Opel</option>
				   				   
				   <option value="Other">Other</option>
				   				   
				   <option value="Packard">Packard</option>
				   				   
				  
				   				   
				   <option value="Peugeot">Peugeot</option>
				   				   
				  
				   				   
				  
				   				   
				   <option value="Plymouth">Plymouth</option>
				   				   
				   
				   				   
				   <option value="Pontiac">Pontiac</option>
				   				   
				   <option value="Porsche">Porsche</option>
				   				   
				 			   
				   <option value="Rolls Royce">Rolls Royce</option>
				   				   
				   <option value="Saab">Saab</option>
				   				   
				   <option value="Saturn">Saturn</option>
				   				   
				   <option value="Scion">Scion</option>
				   				   
				   <option value="Smart">Smart</option>
				   				   
				   <option value="Sterling">Sterling</option>
				   				   
				   <option value="Studebaker">Studebaker</option>
				   				   
				   <option value="Subaru">Subaru</option>
				   				   
				   <option value="Suzuki">Suzuki</option>
				   				   
				  
				   				   
				   <option value="Toyota">Toyota</option>
				   				   
				   <option value="Triumph">Triumph</option>
				   				   
				  			   
				
				   				   
				   <option value="Volkswagen">Volkswagen</option>
				   				   
				   <option value="Volvo">Volvo</option>
				   </select>
					<?php /*?> <?php
				   $obj= new Listing();
					$makes_data=$obj->get_all_makes("get_makes");
					
					if($makes_data["error"]=='')
					{
						$tot_count=count($makes_data);
					}
					else
					{
						$tot_count=0;	
					}
					
					?><?php */?>
					
                   <?php /*?><select  style ="width:100px; font-size:12px;   background-color:#0A0A0A; color:#FFFFFF"  name="make" id="combox_makes" onchange="reload_page('combox_makes');">
				  
				  <option value="" selected="selected" >Any Make</option>
				  <?php
				   
				   if(count($makes_data)>0)
				   {
				   	foreach($makes_data as $makes)
					{	$selected='';
						if($makes['make']==$make)
						{
						$selected='selected="selected"';
						}
				   ?>
				   
				   <option value="<?php echo $makes['make'];?>" <?php echo $selected;?> ><?php echo $makes['make'];?></option>
				   <?php
				  	}
				  }
				   ?>
				   
				   
				   
				   </select><?php */?>
				   
				   </form>                </td>
              </tr>
              
			  <tr>
<td colspan="3" bgcolor="#000000" id="search_contents_div"><center>
<div style="width:100%; display:none"  id="loading_detail_div" >
  <center>
    <img src="images/loading.gif"   align="middle"/>
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
		
		<?php
		if($make)
		{
		 ?>
		<script>
		get_listing("get_listing",'<?php echo $make;?>','','');
		</script>
		<?php
		}
		else if($price_from or $price_to)
		{
		?>
		<script>
		get_listing("get_listing",'','<?php echo $price_from;?>','<?php echo $price_to;?>','','');
		</script>
		<?php
		
		}
		else if($num)
		{
		?>
		<script>
		get_listing("get_listing",'','','','<?php echo $num;?>','get_listing_detail');
		</script>
		<?php
		
		}
		
		
		?>	   </td></tr>
            </table>
          </td>
          <td width="660" valign="top" style="padding-left:8px; background-color:#000000; margin-bottom:0px;" id="listing_detail_div" >	  
		  <div style="width:100%; padding:0px 0px 0px 0px; vertical-align:top; margin-bottom:0px; margin-top:0px;" align="left" id="div_listing_detail" >
		  
		  </div>
		  <div style="width:100%; min-height:400px;" id="div_feature_listing">
		  <table width="100%">
		  <tr><th align="center" style="text-align:center"> <span class="style3"><em>FEATURED VEHICLES:</em></span>
		  
		  </th></tr>
		  <tr><td align="center" >
		  <?php 
					$listing_data=$listing_object->get_feature_listing($user_detail['user_id']);
					$tot_count=count($listing_data);
					
					if($tot_count<=0)
					{
						$listing_data=$listing_object->get_user_listing($user_detail['user_id']);
					}
					$tot_count=count($listing_data);
					
					if($tot_count>0)
					{
					$contents=array();
					$a=0;
					
					foreach($listing_data as $record)
					{ob_start();
					?>
					
				<table width="100%" border="0" cellspacing="3" cellpadding="3" style="margin-left:10px; margin-right:10px;">
                        
                        <tr>
                          <td  height="5"></td>
                        </tr>
                        <tr>
                          <td align="center"><span class="span_title text_color"><?php echo $record['year'];?>&nbsp;<?php echo substr($record['title'],0,25);?></span></td>
                        </tr>
                        <tr>
                          <td  height="5"></td>
                        </tr>
                        <tr>
                          <td align="center">
                           <?php
						  if($record['image_1']=="")
						  {
						  	$image_location=SITE_LAYOUT_IMAGES."coming_soon.gif";
						  }
						  else
						  {
						 	 $image_location=SITE_LISTING_THUM_PATH.$record['image_1'];
						  }
						  ?>
                          
                          <img src="<?php echo $image_location;?>" border="0" style="cursor:pointer" onclick="get_listing_detail('get_detail','<?php echo $record["listing_id"];?>','','');" width="122" height="92"/></td>
                        </tr>
                        <tr>
                          <td  height="5"></td>
                        </tr>
                        <tr>
                          <td align="center"><span class="price_color">$<?php echo number_format($record['price']);?></span></td>
                        </tr>
                      </table>
					  
					  <?php
					  $contents[$a]=ob_get_contents();
					  ob_end_clean();
					  $a++;
					  }
					  
					  echo make_table_orignal($contents,2);
		  			}
					else
					{
					?>
                    
                    <table width="100%" border="0" cellspacing="3" cellpadding="3">
                        
                        <tr>
                          <td  height="5"></td>
                        </tr>
                        <tr>
                          <td align="center"><span class="span_title">Coming Soon</span></td>
                        </tr>
                        <tr>
                          <td  height="5"></td>
                        </tr>
                        <tr>
                          <td align="center"><img src="<?php echo SITE_LAYOUT_IMAGES?>coming_soon.gif" border="0" /></td>
                        </tr>
                        <tr>
                          <td  height="5"></td>
                        </tr>
                        <tr>
                          <td align="center">&nbsp;</td>
                        </tr>
                      </table>
                    
                    <?php
					}										
					
				?>
				
			</td></tr></table>
			</div>
		  </td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td class="bottom_bar_bottom" align="center" ><table width="100%" border="0" cellspacing="0" cellpadding="0">



            <tr>



              <td width="50%" align="center">



			  <?php



			  include_once("links.php");



			  ?>



			  </td>



              <td width="50%" valign="top">



			  <?php include("testimonials.php");?>



			  </td>



            </tr>



          </table></td>
  </tr>
</table>
<?php

include_once("footer.php");

?>
</table>

