<?php  session_start();
include("../includes.php");
$listing_obj = new Listing;
?>
<html lang="en">
<head>
<title>Jquery Test</title>
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
<link rel="icon" href="images/favicon.ico" type="image/x-icon">
<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="js/superfish.js" type="text/javascript"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="js/jquery.carouFredSel-6.2.0-packed.js"></script>
<script type="text/javascript" src="js/jquery.jqtransform.js" ></script>
<script type="text/javascript" src="js/jquery.jcarousel.js" ></script>
<script type="text/javascript" src="js/jquery.simplyscroll.js"></script>
<link rel="stylesheet" href="css/jquery.simplyscroll.css" media="all" type="text/css">
<script type="text/javascript" src="js/jquery.ad-gallery.js"></script>
<script src="SpryAssets/SpryTooltip.js" type="text/javascript"></script>
<script src="" type="text/javascript"></script>
<script type="text/javascript" src="js/global.js"> </script>
<link rel="stylesheet" href="js/colorbox/colorbox.css" />
<script src="js/colorbox/jquery.colorbox.js"></script>
<script>
$(function() {
	<!--$("#box-make div.jqTransformSelectWrapper ul li a").click(function(){    --> 
   <!-- var value= $("#box-make div.jqTransformSelectWrapper span").text()-->
   $('#make').change( function(){
 		  var value = $(this).val();
		  $.ajax({
		  type: 'POST',
		  data: ({ajax_make : value}),
		  url: 'ajax_control.php',
		  success: function(data) {
			   var opt = jQuery.parseJSON(data);
				var select = '<span class="name-input1">Model:</span><select name="model" id="model">';
				for(var i = 0; i < opt.length; i++){
					select += '<option value="'+ opt[i]['model_name'] +'"> '+ opt[i]['model_name'] +'</option>';
				}
				select += '</select>';
				$('#box-model').html(select);
				$('#make,#model').jqTransSelect();
				

			  }
        });
});   
		

});
</script>
</head>
<body>
<form method="get" id="search-form-1" name="search-form-1" action="listings.php">
                  <fieldset>
<div class="rowElem select" id="box-make"> <span class="name-input1">Make:</span>
<select name="make" id="make">
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


<div class="clear"></div>
</div>

<div class="rowElem select" id="box-model">
<span class="name-input1">Model:</span>
<select name="model" id="model">
 <option value="anymodel">Any Model</option>
</select>
</div>
<div class="clear"></div>

<div class="rowElem select" id="box-model1">
<span class="name-input1">Model:</span>
<select name="model1" id="model1">
 <option value="anymodel">Any Model</option>
</select>
</div>
<div class="clear"></div>

<input type="submit" value="Submit" name="submit">
</fieldset>

</form>
</body>

</html>