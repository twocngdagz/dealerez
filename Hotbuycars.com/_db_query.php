<?php  session_start();
include("includes.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Query</title>
<script src="js/jquery-1.8.2.min.js" type="text/javascript"></script>
<script>
$(function() {
	
	
	$('#query_form').on('submit', function(e) {
		
		var query = $('#query').val();
		console.log(query);
		
		e.preventDefault();
		$('.result').html('loading.. .'); // display a loading 
		$.post("_dbajax.php",{submitquery:query })
			.done( function(data) {
				$('.result').html(data);
		});
	});
});
</script>
<style>
table {
	border-collapse: collapse;
	color: #5A6A7F;
	margin: 10px 0 0 30px;	
	padding: 0;
}
tr td, tr th {
    border-bottom: 1px solid #5A6A7F;
    font-size: 10.5pt;
    line-height: 1.5em;
    padding: 0.6em 0.9em;
}
</style>

</head>

<body>
<form name="query_form" id="query_form" method="post">
<label>Enter Query</label>
<br />
<textarea cols="45" rows="2" name="query" id="query" disabled="disabled">SELECT * FROM listing group by body_style</textarea>
<br />
<input type="submit" name="submit" />

</form>

<div class="result"></div>
</body>
</html>
