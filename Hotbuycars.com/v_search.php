<?php  session_start();
include("includes.php");
$listing_obj = new Listing;
?>
<!DOCTYPE html >
<html lang="en">
<head>
<title>Hotbuycars</title>
<meta charset="utf-8">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script type="text/javascript">
	$(function() {
		$('#make_pop').change( function(){
		var value = $(this).val();
		  $.ajax({
		  type: 'POST',
		  data: ({ajax_make : value}),
		  url: 'ajax_control.php',
		  success: function(data) {
			   var opt = jQuery.parseJSON(data);
			   var pre_select = '<option value="anymodel">Any Model</option>';
				var select = '<select name="model_pop" id="model_pop" class="mm_frm">'+pre_select;
				for(var i = 0; i < opt.length; i++){
					select += '<option value="'+ opt[i]['model_name'] +'"> '+ opt[i]['model_name'] +'</option>';
				}
				select += '</select>';
				$('#box-model_pop').html(select);
				
			  }
        });
 		 
	});
});
</script>
<link rel="stylesheet" href="js/colorbox/colorbox.css" />
</head>
<body>
<div class="tabs-1-padd" style="width:690px; height:570px; overflow:hidden; float:left; background:url(images/popup_middle_border.jpg) repeat-y center top; ">
<div style=" position:absolute; margin-left:-21px; margin-top:-34px"><img src="images/popup_top_border.png" width="732" height="23" alt="" /></div>
  <form action="listings.php" name="searchby" id ="searchby" method="get">
  <div class="tab_search_top">
    <div><span>Search</span></div>
    <input name="searchby[]" checked="checked" type="checkbox" value="New">
    <div>New</div>
    <input name="searchby[]" checked="checked" type="checkbox" value="Used">
    <div>Used</div>
    <input name="searchby[]" type="checkbox" value="preowned">
    <div>Certified Pre-Owned <span id="sprytrigger2"><img src="images/info_icon.jpg" width="11" height="12" alt="" style="margin-top:5px;" title="This category of cars are pre-owned"/></span></div>
  </div>
  <div class="clear"></div>
  <div class="left_sec">
    <div class="title">Make</div>
    <div class="clear"></div>
    <div>
      <select name="make_pop" class="mm_frm" id="make_pop">
        <option value="anymake" selected="selected">Any Make</option>
         <?php
        $dispMake = $listing_obj->get_all_makes();
        foreach($dispMake as $arrmake){
                if($_GET['make'] == $arrmake['make_name']){ ?>
                    <option value="<?php echo $arrmake['make_name']; ?>" selected="selected"><?php echo $arrmake['make_name']; ?></option>
                <?php 
                }
                else
                    echo "<option value='".$arrmake['make_name']."'>". $arrmake['make_name']."</option>";
        }
        ?>
      </select>
    </div>
    <div class="clear"></div>
    <div class="title">Model</div>
    <div class="clear"></div>
    <div id = "box-model_pop">
       <select name="model_pop" class="mm_frm" id="model_pop">
        <option value="anymodel">Any Model</option>
       
      </select>
    </div>
    <div class="clear"></div>
    <div class="title">Year</div>
    <div>
      <select name="year" class="yp_frm">
              <option value="any">Any</option>
              <?php
             for($i=2010;$i<=2013;$i++):
                      if($_GET['max'] == $i){ ?>
                          <option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
                      <?php 
                      }
                      else
                          echo "<option value='".$i."'>". $i."</option>";
              endfor;
              ?>
      </select>
      <div class="newer">Or Newer</div>
    </div>
    <div class="clear"></div>
    <div class="title" style="padding-top:10px;">Price From</div>
    <div>
      <select name="pricefrom" class="yp_frm">
              <option value="any" selected="selected">Any</option>
              <option value="0">0</option>
              <option value="500">500</option>
              <option value="1000">1000</option>
      </select>
    </div>
    <div class="clear"></div>
    <div class="to">To</div>
    <div>
       <select name="priceto" class="yp_frm">
              <option value="any" selected="selected">Any</option>
              <option value="5000">5000</option>
              <option value="10000">10000</option>
              <option value="15000">15000</option>
              <option value="50000">50000</option>
       </select>
    </div>
    <div class="clear"></div>
    <div class="title">Fuel Type</div>
    <div class="clear"></div>
    <div style="margin-top:-10px; text-align:left; float:left">
      <input name="fueltype[]" type="checkbox" value="Gasoline">
      Gasoline
      <div class="clear"></div>
      <input name="fueltype[]" type="checkbox" value="Diesel">
      Diesel
      <div class="clear"></div>
      <input name="fueltype[]" type="checkbox" value="Hybrid">
      Hybrid
      <div class="clear"></div>
      <input name="fueltype[]" type="checkbox" value="Electric">
      Electric
      <div class="clear"></div>
      <input name="fueltype[]" type="checkbox" value="Flexible_Fuel">
      Flexible Fuel
      <div class="clear"></div>
      <input name="fueltype[]" type="checkbox" value="Natural_Gas">
      Natural Gas </div>
  </div>
  <div class="right_sec">
    <div class="title" style="padding-bottom:5px">Type</div>
    <div class="clear"></div>
    <div class="v_type_bx">
      <div class="chkbx">
        <input name="type[]" type="checkbox" value="SUV">
      </div>
      <div class="v_type_image"><img src="images/suv_v.jpg" alt=""></div>
      <div class="v_type_g_name">SUV</div>
    </div>
    <div class="v_type_bx">
      <div class="chkbx">
        <input name="type[]" type="checkbox" value="Wagon">
      </div>
      <div class="v_type_image"><img src="images/weagon_v.jpg" alt=""></div>
      <div class="v_type_g_name">Wagon</div>
    </div>
    <div class="v_type_bx">
      <div class="chkbx">
        <input name="type[]" type="checkbox" value="Coupe">
      </div>
      <div class="v_type_image"><img src="images/coupe_v.jpg" alt=""></div>
      <div class="v_type_g_name">Coupe</div>
    </div>
    <div class="v_type_bx no_l_m">
      <div class="chkbx">
        <input name="type[]" type="checkbox" value="Sedan">
      </div>
      <div class="v_type_image"><img src="images/sedan_v.jpg" alt=""></div>
      <div class="v_type_g_name">Sedan</div>
    </div>
    <div class="clear"></div>
    <div class="v_type_bx">
      <div class="chkbx">
        <input name="type[]" type="checkbox" value="Pickup">
      </div>
      <div class="v_type_image"><img src="images/pickup_v.jpg" alt=""></div>
      <div class="v_type_g_name">Pickup</div>
    </div>
    <div class="v_type_bx">
      <div class="chkbx">
        <input name="type[]" type="checkbox" value="Van/Minivan">
      </div>
      <div class="v_type_image"><img src="images/minvan_v.jpg" alt=""></div>
      <div class="v_type_g_name">Van/Minivan</div>
    </div>
    <div class="v_type_bx">
      <div class="chkbx">
        <input name="type[]" type="checkbox" value="Convertible">
      </div>
      <div class="v_type_image"><img src="images/convertible_v.jpg" alt=""></div>
      <div class="v_type_g_name">Convertible</div>
    </div>
    <div class="v_type_bx  no_l_m">
      <div class="chkbx">
        <input name="type[]" type="checkbox" value="Hatchback">
      </div>
      <div class="v_type_image"><img src="images/hatchback_v.jpg" alt=""></div>
      <div class="v_type_g_name">Hatchback</div>
    </div>
    <div class="v_type_bx">
      <div class="chkbx">
        <input name="type[]" type="checkbox" value="Commercial">
      </div>
      <div class="v_type_image"><img src="images/commercial_v.jpg" alt=""></div>
      <div class="v_type_g_name">Commercial</div>
    </div>
    <div class="left_bx">
      <div class="title2">Color</div>
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Beige">
      Beige
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Black">
      Black
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Blue">
      Blue
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Brown">
      Brown
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Burgundy">
      Burgundy </div>
    <div class="center_bx">
      <div class="title2">&nbsp;</div>
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Charcoal">
      Charcoal
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Gold">
      Gold
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Gray">
      Gray
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Green">
      Green
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Offwhite">
      Offwhite </div>
    <div class="right_bx">
      <div class="title2">&nbsp;</div>
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Orange">
      Orange
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Pink">
      Pink
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Purple">
      Purple
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Red">
      Red
      <div class="clear"></div>
      <input name="color[]" type="checkbox" value="Silver">
      Silver </div>
    <div class="clear"></div>
    <div class="left_bx">
      <div class="title2">Engine</div>
      <div class="clear"></div>
      <input name="engine[]" type="checkbox" value="3 cylinder">
      3 cylinder
      <div class="clear"></div>
      <input name="engine[]" type="checkbox" value="4 cylinder">
      4 cylinder
      <div class="clear"></div>
      <input name="engine[]" type="checkbox" value="5 cylinder">
      5 cylinder
      <div class="clear"></div>
      <input name="engine[]" type="checkbox" value="6 cylinder">
      6 cylinder
      <div class="clear"></div>
      <input name="engine[]" type="checkbox" value="8 cylinder">
      8 cylinder
      <div class="clear"></div>
      <input name="engine[]" type="checkbox" value="10 cylinder">
      10 cylinder </div>
    <div class="center_bx">
      <div class="title2">Drive</div>
      <div class="clear"></div>
      <input name="drive[]" type="checkbox" value="Two-Wheel">
      Two-Wheel
      <div class="clear"></div>
      <input name="drive[]" type="checkbox" value="Four-Wheel">
      Four-Wheel
      <div class="clear"></div>
      <input name="drive[]" type="checkbox" value="All-Wheel">
      All-Wheel
      <div class="clear"></div>
      <div class="title2" style="padding-top:17px;">Other</div>
      <div class="clear"></div>
      <input name="is_3rd_row" type="checkbox" value="1">
      3rd Row Seats </div>
    <div class="right_bx">
      <div class="title2">Transmission</div>
      <div class="clear"></div>
      <input name="transmission[]" type="checkbox" value="Automatic">
      Automatic
      <div class="clear"></div>
      <input name="transmission[]" type="checkbox" value="Manual">
      Manual
      <div class="clear"></div>
      <div class="title2" style="padding-top:20px">&nbsp;</div>
      <div class="clear"></div>
      <input name="is_luxury" type="checkbox" value="1">
      Only Luxury Models </div>
    <div class="clear"></div>
    <div class="bottom_search">
      <div class="fleft">Within</div>
      <div class="fleft">
        <select name="miles">
          <option value="anymiles" selected="selected">Any Miles</option>
          <option value="500">500</option>
          <option value="1000">1000</option>
          <option value="2000">2000</option>
          <option value="5000">5000</option>
          <option value="10000">10000</option>
          <option value="50000">50000</option>
        </select>
      </div>
      <div class="fleft">of Zip/PC Code* </div>
      <div class="fleft">
        <input name="zip" type="text">
        <input name="event" type="hidden" value="searchtab">
      </div>
      <div class="fleft" style="margin-top:-20px; margin-left:15px;">
        <input type="submit" name="submit-search" style="background-image:url('images/go_tab_btn.jpg');width:48px;height:49px;background-color:transparent;border:none;cursor:pointer;" value=""/>
	</div>
   </div>
                    <div class="clear"></div>
</div>
</form>
</div>
<div class="clear"></div>
<div style="margin-left:9px;"><img src="images/popup_bottom_border.png" width="732" height="23" alt="" /></div>   
<div class="tooltipContent" id="sprytooltip1" style="visibility:hidden">Tooltip content goes here.</div>

</body>
</html>
      
