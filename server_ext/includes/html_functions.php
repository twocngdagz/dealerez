<?php
function get_items_html($category_obj,$restaurant_category=false,$restaurant_fooditem=false,$restaurant_food_subitem=false)
{

	ob_start();
	
	$style="style=display:none;";
		
	if($restaurant_category)
	{
		foreach($restaurant_category as $data)
		{
	
			if($data->name==$category_obj->name)
			{
			$style="";
			}
		}		
	}
	
	?>

<table  width="100%" id="<?php echo $category_obj->name;?>" <?php echo $style;?>  >
  <?php
	$count=0;
	foreach($category_obj->item as $item_data)
	{
		$count++;
		
		$checked="";
		$style2="style=display:none;";
	if($restaurant_fooditem)
	{
	//print_array($restaurant_fooditem);
		foreach($restaurant_fooditem as $data)
		{
			if($data->name==$item_data->name)
			{
			$checked="checked=checked";
			$style2="";
			}
		}
			
	}
	
	?>
  <tr>
    <td width="100%"><input type="checkbox" value="<?php echo $item_data->item_id;?>" name="r_item[]"  onclick="show_sub_item(this,'<?php echo $category_obj->name."_00_".$item_data->item_id;?>');" style="cursor:pointer;" <?php echo $checked;?>>
      &nbsp;<?php echo $item_data->name;?>
      <table  width="100%" id="<?php echo $category_obj->name."_00_".$item_data->item_id;?>" <?php echo $style2;?>  >
        <?php
	
	foreach($item_data->subitem as $subitem_data)
	{
		$checked2="";
			
		if($restaurant_food_subitem)
		{
			foreach($restaurant_food_subitem as $data)
			{
				
				if($data->name==$subitem_data->name)
				{
				$checked2="checked=checked";
				}
			}
				
		}
		
	?>
        <tr>
          <td width="100%">&nbsp;
            <input type="checkbox" value="<?php echo $subitem_data->subitem_id;?>" name="r_sub_item[]"  onclick="show_city_part_table(this,'<?php echo $subitem_data->name;?>');" style="cursor:pointer;" <?php echo $checked2;?>>
            &nbsp;<?php echo $subitem_data->name;?> </td>
        </tr>
        <?php
	}
	
	
?>
      </table></td>
  </tr>
  <?php
}

?>
</table>
<?php
$contetns=ob_get_contents();
ob_end_clean();
return  $contetns;
}


function get_cities_html($state_name,$restaurant_state=false,$restaurant_cities=false,$restaurant_city_parts=false)
{
	ob_start();
	$cities=array();
	
	$cities=get_cities($state_name);
	$style="style=display:none;";
	
	if($restaurant_state)
	{
		foreach($restaurant_state as $data)
		{
		
			if($data==$state_name)
			{
			$style="";
			}
		}
			
	}
	
	?>
<table  width="100%" id="<?php echo $state_name;?>"  <?php echo $style;?>>
  <?php
	
	foreach($cities as $city_data)
	{
		$checked="";
		$style2="style=display:none;";
		
		if($restaurant_cities)
		{
			foreach($restaurant_cities as $data)
			{	
				if($city_data['name']==$data)
				{
					$checked="checked=checked";
					$style2="";
					
				}
			}
		}			
	?>
  <tr>
    <td width="100%"><input type="checkbox" value="<?php echo $city_data['name'];?>" name="city[]"  onclick="show_city_part_table(this,'<?php echo $city_data['name'];?>');" <?php echo $checked;?> style="cursor:pointer;">
      &nbsp;<?php echo $city_data['name'];?>
      <table  width="100%" id="<?php echo $city_data['name'];?>" <?php echo $style2;?> >
        <?php
	$city_parts=array();
	
	$city_parts=get_city_parts($city_data['name']);
	foreach($city_parts as $city_part_data)
	{
		$checked="checked=checked";
		$style2=""	;			
		if($restaurant_city_parts)
		{
			foreach($restaurant_city_parts as $data)
			{		
							
				if($city_part_data['name']==$data)
				{
					$checked2="checked=checked";
					
					
				}
			}
		}	
		
	?>
        <tr>
          <td width="100%;">&nbsp;
            <input type="checkbox" value="<?php echo $city_part_data['name'];?>" <?php echo $checked2;?> name="city_part[]" style="cursor:pointer;">
            &nbsp;<?php echo $city_part_data['name'];?> </td>
        </tr>
        <?php
	}
?>
      </table></td>
  </tr>
  <?php
	}
?>
</table>
<?php

$contetns=ob_get_contents();
ob_end_clean();
return  $contetns;
}


function get_postal_codes_html($state_name,$restaurant_state=false,$restaurant_postal_codes=false)
{

	ob_start();
	$postal_codes=array();
	
	$postal_codes=get_postal_codes($state_name);
	
	$style="style=display:none;";
		
	if($restaurant_state)
	{
		foreach($restaurant_state as $data)
		{
			if($data==$state_name)
			{
				$style="";
			}
		}
			
	}
	?>
<table  width="100%" id="postal_<?php echo $state_name;?>"  <?php echo $style;?>>
  <tr>
    <td><?php
	
    foreach($postal_codes as $postal_code_data)
	{		
		$checked="";
		if($restaurant_postal_codes)
		{
			foreach($restaurant_postal_codes as $data)
			{
				if($postal_code_data['postal_code']==$data)
				{
					$checked="checked=checked";
								
				}
			}
		}		
	?>
      &nbsp;
      <input type="checkbox" value="<?php echo $postal_code_data['postal_code'];?>"  name="postal_code[]" style="cursor:pointer;" <?php echo $checked;?> >
      &nbsp;<?php echo $postal_code_data['postal_code'];?>
      <?php
	}
?>
    </td>
  </tr>
</table>
<?php
  
  $contetns=ob_get_contents();
ob_end_clean();
return  $contetns;
}


function generate_order_html($order_id,$user_type=false)
{
/////////////// Language Variables //////////////////////
include_once(ROOT_PATH.LANGUAGE_PATH.$_SESSION['language']."language.php");
/////////////////////// END ////////////////////////////
	ob_start();
	
	$order_detail=array();
	
	$order_obj=new Order($order_id);
	
	if($order_obj->user_id!=0)
	{
		$user_object=new User($order_obj->user_id);
	}
	else
	{
		$guest_object=new Guest($order_obj->guest_id);
	}
	$restaurant_object=new Restaurant($order_obj->restaurant_id);
	$order_detail=$order_obj->Get_order_detail($order_id);
	

?>
<style >
.GridTable
{
	background-color:#9EB9C6;
	margin-left:5px;
	
}



.GridBlankRow
{
	height: 17px;
	background: url(<?php echo SITE_URL.SITE_LAYOUT_IMAGES;?>th.gif) repeat-x left top;
}

.GridSubHead
{  
	font-family: Arial; 
	font-size: 11px; 
	font-weight: bold; 
	color: #333333; 
	background-color: #FFFFFF;
	text-align:center;
}

.GridHead
{  
	font-family: Arial; 
	font-size: 11px; 
	font-weight: normal; 
	color: #3333FF;
	background-color: #FFFFFF;
	text-align:left;
	
}

.GridRowHead
{  
	font-family: Arial; 
	font-size: 11px; 
	font-weight: normal; 
	color: #000000; 
	background-color: #F9F9F9;
	text-align:center;
	
}

</style>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   
   <tr>
    <td  align="center"><b><?php echo STR_ORDER; ?> <?php echo STR_NUMBER; ?>. <?php echo $order_obj->order_id; ?> <?php echo STR_AT; ?> <?php echo $restaurant_object->name; ?> <?php echo STR_ON; ?> <?php echo show_date($order_obj->order_date)." ".$order_obj->order_time ?> <?php echo STR_AT; ?> http://www.homedeliver.de</b></td>
  </tr>
  
  <tr>
    <td  align="center"><h3><?php echo STR_ORDER." ".STR_DETAIL; ?></h3></td>
  </tr>
  <tr>
    <td  align="center"><b><?php echo STR_TEXT_41; ?></b></td>
  </tr>
  <tr>
    <td  align="center" class="heading12">&nbsp;</td>
  </tr>
  <tr>
    <td width="100%" align="center"><?php if($order_obj->user_id!=0)
{
?>
      <table width="80%" cellpadding="3" cellspacing="1" class="GridTable">
        <tr>
          <th colspan="2" class="GridBlankRow"></th>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:center" colspan="2"><h2><?php echo STR_BASIC_INFORMATION; ?></h2></td>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_ORDERS." ".STR_REFERENCE_NO; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $order_obj->order_id; ?></td>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_ORDER." ".STR_DATE."/".STR_TIME; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo show_date($order_obj->order_date)."/".$order_obj->order_time; ?></td>
        </tr>
        
        <?php if($order_obj->coupon_number!="") {?>
        <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_DISCOUNT_COUPON_NO; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $order_obj->coupon_number; ?></td>
        </tr>
        <?php 
} 
?>
        <tr>
          <td class="GridSubHead" style="text-align:center" colspan="2"><h2><?php echo STR_CUSTOMER_INFORMATION; ?></h2></td>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_USER_IP; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $order_obj->user_ip; ?></td>
        </tr>
        
		<?php if($user_object->state!="") { ?>
		<tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_COMPANY_NAME; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $user_object->state; ?></td>
        </tr>
		
		<?php }?>
		<tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_CUSTOMER_NAME; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $user_object->name; ?></td>
        </tr>
        
		<tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_TEXT_STREET_AND_NO; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $user_object->address." ".$user_object->house_number; ?><?php if($user_object->address_part!="") { ?>&nbsp;<?php echo "(".$user_object->address_part.")"; ?><?php }?></td>
        </tr>
       
	   <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_POSTAL_CODE." / ".STR_CITY ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $user_object->postal_code." / ".$user_object->city; ?></td>
        </tr>
	    <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_CONTACT; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $user_object->phone." / ".$user_object->email; ?></td>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:center" colspan="2"><h2><?php echo STR_RESTAURANT." ".STR_INFORMATION; ?></h2></td>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_NAME." / ".STR_ADDRESS; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $restaurant_object->name.",".$restaurant_object->address."-".$restaurant_object->postal_code." ".$restaurant_object->city; ?></td>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_PHONE." / ".STR_FAX; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $restaurant_object->phone." / ".$restaurant_object->fax; ?></td>
        </tr>
        </table>
      <?php }
					else
					{ ?>
      <table width="80%" cellpadding="3" cellspacing="1" class="GridTable">
        <tr>
          <th colspan="2" class="GridBlankRow"></th>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:center" colspan="2"><h2><?php echo STR_BASIC_INFORMATION; ?></h2></td>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_ORDERS." ".STR_REFERENCE_NO; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $order_obj->order_id; ?></td>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_ORDER." ".STR_DATE." / ".STR_TIME; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo show_date($order_obj->order_date)." / ".$order_obj->order_time; ?></td>
        </tr>
        
        <tr>
          <td class="GridSubHead" style="text-align:center" colspan="2"><h2><?php echo STR_CUSTOMER_INFORMATION; ?></h2></td>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_USER_IP; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $order_obj->user_ip; ?></td>
        </tr>
<?php if($guest_object->company_name!="") { ?>       
	    <tr>
       <td class="GridSubHead" style="text-align:left"><?php echo STR_COMPANY_NAME; ?></td>
       <td class="GridRowHead" style="text-align:left"><?php echo $guest_object->company_name; ?></td>
        </tr>
	   <?php } ?>
	   
	    <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_CUSTOMER_NAME; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $guest_object->name." ".$guest_object->last_name; ?></td>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_TEXT_STREET_AND_NO; ?></td>
         <td class="GridRowHead" style="text-align:left"><?php echo $guest_object->address." ".$guest_object->house_number; ?><?php if($guest_object->address_part!="") { ?><?php echo "(".$guest_object->address_part.")"; ?><?php } ?></td>
        </tr>
		
		
		
        
		<tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_POSTAL_CODE." / ".STR_CITY; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $guest_object->postal_code." / ".$guest_object->city; ?></td>
        </tr>
		
		<tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_CONTACT; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $guest_object->phone." / ".$guest_object->email; ?></td>
        </tr>
		<?php if($guest_object->telcitycode!="") { ?>
		<tr>
      <td class="GridSubHead" style="text-align:left"><?php echo STR_TEL_CODE; ?></td>
      <td class="GridRowHead" style="text-align:left"><?php echo $guest_object->telcitycode; ?></td>
        </tr>
		
		<?php } ?>
        
        <tr>
          <td class="GridSubHead" style="text-align:center" colspan="2"><h2><?php echo STR_RESTAURANT." ".STR_INFORMATION; ?></h2></td>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_NAME." / ".STR_ADDRESS; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $restaurant_object->name.",".$restaurant_object->address."-".$restaurant_object->postal_code." ".$restaurant_object->city; ?></td>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:left"><?php echo STR_PHONE." / ".STR_FAX; ?></td>
          <td class="GridRowHead" style="text-align:left"><?php echo $restaurant_object->phone." / ".$restaurant_object->fax; ?></td>
        </tr>
        </table>
      <?php } ?>
    </td>
  </tr>
  <tr>
    <td  align="center" class="heading12" width="100%" colspan="2"><table width="90%" cellpadding="3" cellspacing="1">
        <tr>
          <td align="right">&nbsp;</td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td width="100%" align="center"><table width="99%" cellpadding="3" cellspacing="1" class="GridTable">
        <tr>
          <th colspan="7" class="GridBlankRow"></th>
        </tr>
        <tr>
          <td class="GridSubHead" style="text-align:center" colspan="7"><h2><?php echo STR_FOOD_ITEMS_DETAIL; ?></h2></td>
        </tr>
        <tr>
          <td class="GridSubHead"><?php echo STR_S_NO; ?></td>
		  <td class="GridSubHead"><?php echo STR_MENU_ID; ?></td>
		  <td class="GridSubHead"><?php echo STR_FOOD_ITEM_NAME; ?></td>
          <td class="GridSubHead"><?php echo STR_ADDITIONAL_ITEM_NAME; ?></td>
          <td class="GridSubHead"><?php echo STR_QUANTITY; ?></td>
		  <td class="GridSubHead"><?php echo STR_UNIT_PRICE; ?></td>
          <td class="GridSubHead"><?php echo STR_PRICE; ?></td>
        </tr>
        <?php 
		$count=0;
		$total=0.00;
		
		foreach ($order_detail as $row)
		{
		
		$size_detail=$restaurant_object->restaurant_food_item_size($row['item_id'],$order_obj->restaurant_id);
						$size_tilte="";
						if(count($size_detail)>1)
						{
							foreach ($size_detail as $row1) 
							{
								if($row1['size_id']==$row['size_id'])
								{
									$size_tilte=" - ".$row1['size_name'];
								}
							}
							
							
						}
		
		$count++;
		$total=$total+$row['price'];
	
	?>
        <tr>
          <td class="GridRowHead" style="border-bottom:2px solid #666666;"><?php echo $count; ?></td>
		  <?php $sql="select menu_id,price from subitem where sub_id=".$row['sub_id']." AND size_id=".$row['size_id']."";
		  $temp_res=Execute_command($sql);
		  $row2=mysql_fetch_array($temp_res);
		   ?>
		  <td class="GridRowHead" style="border-bottom:2px solid #666666;"><?php echo $row2['menu_id']; ?></td>
          <td class="GridRowHead" style="border-bottom:2px solid #666666;"><?php echo $row['sub_name'].$size_tilte; ?></td>
          <?php if($row['add_id']!="") 
		{
		?>
          <td class="GridRowHead" style="border-bottom:2px solid #666666;"><?php echo $row['add_name']; ?></td>
          <?php }else { ?>
          <td class="GridRowHead" style="border-bottom:2px solid #666666;">&nbsp;</td>
          <?php 
		}
		?>
          <td class="GridRowHead" style="border-bottom:2px solid #666666;"><?php echo $row['quantity']; ?></td>
		  <td class="GridRowHead" style="border-bottom:2px solid #666666;"><?php echo display_amount($row2['price']); ?></td>
          <td class="GridRowHead" style="border-bottom:2px solid #666666;"><?php echo display_amount($row['price']); ?></td>
        </tr>
        <?php 
}
$total=$total+$order_obj->shipping_price;
$total=number_format($total,2);
?>
        <tr>
          <td class="GridSubHead" colspan="6" style="text-align:right"><?php echo STR_DELIVERY_CHARGES; ?></td>
          <td class="GridRowHead"><?php echo display_amount($order_obj->shipping_price); ?></td>
        </tr>
        <tr>
          <td class="GridSubHead" colspan="6" style="text-align:right"><?php echo STR_TOTAL; ?></td>
          <td class="GridRowHead"><?php echo display_amount($order_obj->total); ?></td>
        </tr>
      </table></td>
  </tr>
  
  <?php
		if($user_type=="user" or $user_type=="guest")
		{
		
?>
  <tr>
    <p><strong><?php echo STR_TEXT_21; ?></strong></p>
  </tr>
  
  
  <?php 	}
?>
  <?php
		if($user_type=="user")
		{
		
?>
  <tr>
    <p> <?php echo STR_TEXT_44; ?>.<a href="<?PHP echo SITE_URL;?>restaurant_comments.php?r_id=<?php echo $restaurant_object->r_id;?>&order_id=<?php echo $order_id; ?>&user_id=<?php echo $order_obj->user_id;?>&"  target="_blank"><?php echo STR_CLICK_HERE; ?></a></p>
  </tr>
  
  
  <?php 	}
?>
  <tr>
    <td  align="center"><p><b><?php echo STR_TEXT_42; ?>.</b></p>
      <p> <?php echo STR_TEXT_43; ?>.</p></td>
  </tr>
</table>
<?php
$contents=ob_get_contents();
 ob_end_clean();
 return $contents;
}
?>
