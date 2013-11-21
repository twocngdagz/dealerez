<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script type="text/javascript" src="js/jquery-1.8.2.min.js"></script>
<script>
$(function() {
	<!--$("#box-make div.jqTransformSelectWrapper ul li a").click(function(){    --> 
   <!-- var value= $("#box-make div.jqTransformSelectWrapper span").text()-->
   
 		  var value = "Acura";
		  $.ajax({
		  type: 'POST',
		  data: ({ajax_make : value}),
		  url: 'ajax_control.php',
		  success: function(data) {
				var opt = jQuery.parseJSON(data);
				
				 var result = "<ul>"
                   for(var i = 0; i < opt.length; i++){
					result += '<li>'+ opt[i]['model_name'] +'</li>';
					}
                    result = result + "</ul>"
				$('#box-model').html(result);
			  }
        });
 
});   
</script>
</head>

<body>

<div id ="box-model"></div>
</body>
</html>