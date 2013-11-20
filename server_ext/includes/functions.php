<?php 
function display_message() {
	if(isset($_SESSION['msg_eror']))
	{
		$errors	=	array();
		$numarray	=	array();
		$strarray	=	array();
		$string ="";
		$string2 ="";
		if(is_array($_SESSION['msg_eror'])) {
			foreach($_SESSION['msg_eror'] as $msgvalue) {
				$strarray[]	=	$msgvalue;
			}
			$string.=	implode("<br>",$strarray);
		} else {
			$string.=	$_SESSION['msg_eror'];
		}

		unset($_SESSION['msg_eror']);
		
		return '<div class="notification-error">
				  <a href="#" class="close" onClick="$(this).parent().fadeTo(400, 0, function() { $(this).slideUp(400); }); return false;">x</a>
				  <p style="margin:16px 0 0 123px;">'.$string.'</p>
			  </div>';
	}
	else if(isset($_SESSION['msg_alert'])) {
		$errors	=	array();
		$numarray	=	array();
		$strarray	=	array();
		$string ="";
		$string2 ="";
		if(is_array($_SESSION['msg_alert'])) {
			foreach($_SESSION['msg_alert'] as $msgvalue) {
				$strarray[]	=	$msgvalue;
			}
			$string	.=	implode("<br>",$strarray);
		} else {
			$string	.=	$_SESSION['msg_alert'];
		}

		unset($_SESSION['msg_alert']);
		
		return '<div class="notification-success">
				  <a href="#" class="close" onClick="$(this).parent().fadeTo(400, 0, function() { $(this).slideUp(400); }); return false;">x</a>
				  <p style="margin:16px 0 0 134px;">'.$string.'</p>
			  </div>';
	} else {
		return "";
	}	
}

function display_message_signup() {
	if(isset($_SESSION['msg_eror']))
	{
		$errors	=	array();
		$numarray	=	array();
		$strarray	=	array();
		$string ="";
		$string2 ="";
		if(is_array($_SESSION['msg_eror']))
		{
			foreach($_SESSION['msg_eror'] as $msgvalue)
			{
					$strarray[]	=	$msgvalue;
			}
			$string.=	implode("<br>",$strarray);
		}
		else
		{
			$string.=	$_SESSION['msg_eror'];
		}

		unset($_SESSION['msg_eror']);
		
		return '<div class="notification-error">
				  <a href="#" class="close" onClick="$(this).parent().fadeTo(400, 0, function() { $(this).slideUp(400); }); return false;">x</a>
				  <p style="margin:16px 0 0 123px;">'.$string.'</p>
			  </div>';
		
	} else if(isset($_SESSION['msg_alert'])) {
		
		$errors	=	array();
		$numarray	=	array();
		$strarray	=	array();
		$string ="";
		$string2 ="";
		if(is_array($_SESSION['msg_alert']))
		{
			foreach($_SESSION['msg_alert'] as $msgvalue)
			{
					$strarray[]	=	$msgvalue;
			}
			$string	.=	implode("<br>",$strarray);
		}
		else
		{
			$string	.=	$_SESSION['msg_alert'];
		}

		unset($_SESSION['msg_alert']);
		
		return '<div class="notification-success">
				  <a href="#" class="close" onClick="$(this).parent().fadeTo(400, 0, function() { $(this).slideUp(400); }); return false;">x</a>
				  <p style="margin:16px 0 0 134px;">'.$string.'</p>
			  </div>';
	} else {
		return "";
	}	
}


function display_message_login()
{


	if(isset($_SESSION['msg_eror']))
	{
		$errors	=	array();
		$numarray	=	array();
		$strarray	=	array();
		$string ="";
		$string2 ="";
		if(is_array($_SESSION['msg_eror']))
		{
			foreach($_SESSION['msg_eror'] as $msgvalue)
			{
					$strarray[]	=	$msgvalue;
			}
			$string.=	implode("</td><td align='left'>",$strarray);
		}
		else
		{
			$string.=	$_SESSION['msg_eror'];
		}

		unset($_SESSION['msg_eror']);
		return "<table cellspacing='0' cellpadding='0'  width='80%' style='color:#990000; font-size:9px;' ><tr><td  align='left' >$string</td></tr></table>";
		
		
		
	}
	else 
	if(isset($_SESSION['msg_alert']))
	{
		$errors	=	array();
		$numarray	=	array();
		$strarray	=	array();
		$string ="";
		$string2 ="";
		if(is_array($_SESSION['msg_alert']))
		{
			foreach($_SESSION['msg_alert'] as $msgvalue)
			{
					$strarray[]	=	$msgvalue;
			}
			$string	.=	implode("<br>",$strarray);
		}
		else
		{
			$string	.=	$_SESSION['msg_alert'];
		}

		unset($_SESSION['msg_alert']);
		return "<table cellspacing='3' cellpadding='0'  width='85%' style='border: 1px solid rgb(204, 204, 204); background-color:#006633; color:#F1F1F1;' ><tr><td width='10%'><img src='images/tick_icon.jpg'  /></td><td width='90%' align='left' ><span CLASS='msg_eror'>$string</span ></td></tr></table>";
	}
	else
	{
		return "";
	}	
}
function display_sql_error()
{
	if(isset($_SESSION['mysql_eror']))
	{
		$errors	=	array();
		$numarray	=	array();
		$strarray	=	array();
		$string ="";
		$string2 ="";
		if(is_array($_SESSION['mysql_eror']))
		{
			foreach($_SESSION['mysql_eror'] as $msgvalue)
			{
					$strarray[]	=	$msgvalue;
			}
			$string	.=	implode("<br>",$strarray);
		}
		else
		{
			$string	.=	$_SESSION['mysql_eror'];
		}

		unset($_SESSION['mysql_eror']);
		return $string;
	}
	else
	{
		return "";
	}	
}
function mysql_query_string($string)
{
	$enabled = true;
	$htmlspecialchars = false; # Convert special characters to HTML entities 
	/****************************************************************
	The translations performed are: 

	'&' (ampersand) becomes '&amp;' 
	'"' (double quote) becomes '&quot;' when ENT_NOQUOTES is not set. 
	''' (single quote) becomes '&#039;' only when ENT_QUOTES is set. 
	'<' (less than) becomes '&lt;' 
	'>' (greater than) becomes '&gt;' 

	*****************************************************************/
	
	if($htmlspecialchars)
	{
		# Convert special characters to HTML entities 
		$string = htmlspecialchars($string, ENT_QUOTES);
	}
	else
	{
		/****************************************************************
		'"' (double quote) becomes '&quot;' 
		''' (single quote) becomes '&#039;' 
		****************************************************************/
		//$string = str_replace('"',"&quot;",$string);
		//$string = str_replace("'","&#039;",$string);
	}
	if($enabled and gettype($string) == "string")
	{
		# Escapes special characters in a string for use in a SQL statement
		return mysql_real_escape_string(trim($string));
	}
	elseif($enabled and gettype($string) == "array")
	{
		$ary_to_return = array();
		foreach($string as $str)
		{
				$ary_to_return[]=mysql_real_escape_string(trim($str));
		}
		return $ary_to_return;
	}
	else
	{
		return trim($string);
	}
}
function generate_pagination($rsCount,$limit,$page,$PageLink)
{	
	
	

	$pagination_array=array();
	$totalrows =$rsCount;
	$limit=isset($limit)?$limit:RESULT_PER_PAGE;
	
	$limitvalue = ($page - 1) * $limit;			
	ob_start();
	if($page > 1){
	  $pageprev = $page-1;
	  echo("<span  onclick=get_search_contents_bylink('".$PageLink."&page=$pageprev') style='cursor:pointer;color:#FFFFFF '>&nbsp;prev</span>");
	}			                                                            
	$numofpages = ceil($totalrows / $limit);
	for($i = 1; $i <= $numofpages; $i++)
	{
		if($i > $page-10 and $i < $page+10)
		{
			if($page == $i)
				echo('<span  style="cursor:pointer;color:#535756 ">&nbsp;' . $i . '</span>');
			else
				echo("<span onclick=get_search_contents_bylink('".$PageLink."&page=$i') style='cursor:pointer;color:#FFFFFF '>&nbsp;" . $i . "</span>");
		}
	}
	
	$numofpages = ceil($totalrows / $limit);
	if($page < $numofpages)
	{
		$pagenext = ($page + 1);
	echo ("<span  onclick=get_search_contents_bylink('".$PageLink."&page=$pagenext') style='cursor:pointer;color:#FFFFFF'>&nbsp;Next</span");
	}else
	{
		$pagenext=1;
	}
	
	
	$total_displaying = $totalrows;
	$starting = ($total_displaying > 0) ? $limitvalue+1 : 0;
	$ending = $limitvalue+$limit;
	
	$pagination = ob_get_contents();
	ob_end_clean();
	
	
	$pagination_array['paging']=$pagination;
	$pagination_array['limitvalue']=$limitvalue;
	$pagination_array['limit']=$limit;
	$pagination_array['totalrows']=$totalrows;
	$pagination_array['starting']=$starting;
	$pagination_array['ending']=$ending;
		
	
	return $pagination_array;
	
	
	

}

function generate_pagination_sql($sql,$limit,$page,$PageLink)
{
	
	$pagination_array=array();
	
	$sqlCount = $sql;	
	$rsCount = mysql_query($sqlCount);
	$totalrows = mysql_num_rows($rsCount);
	$limit=isset($limit)?$limit:RESULT_PER_PAGE;
	
	$limitvalue = ($page - 1) * $limit;			
	ob_start();
	if($page > 1){
	  $pageprev = $page-1;
	  echo("&nbsp;<a  class='pagination_txt'  href='?page=$pageprev' style='color:#FFFFFF'>Prev</a>");
	}			                                                            
	$numofpages = ceil($totalrows / $limit);
	for($i = 1; $i <= $numofpages; $i++)
	{
		if($i > $page-10 and $i < $page+10)
		{
			if($page == $i)
				echo("&nbsp;<span href='#' class='pagination_txt_selected'>".$i."</span>");
			else
				echo("&nbsp;<a class='pagination_txt' href=".$PageLink."?page=$i style='color:#FFFFFF'>$i</a>");
		}
	}
	
	$numofpages = ceil($totalrows / $limit);
	if($page < $numofpages)
	{
		$pagenext = ($page + 1);
	echo ("&nbsp;<a class='pagination_txt'  href=".$PageLink."?page=$pagenext style='color:#FFFFFF'>Next</a>");
	}else
	{
		$pagenext=1;
	}
	
	$sql.=	" LIMIT $limitvalue, $limit";
	$result = mysql_query($sql) or die($sql.mysql_error());
	$total_displaying = mysql_num_rows($result);
	$starting = ($total_displaying > 0) ? $limitvalue : 0;
	$ending = $limitvalue+$total_displaying;
	
	$pagination = ob_get_contents();
	ob_end_clean();
	
	
	$pagination_array['paging']=$pagination;
	$pagination_array['limitvalue']=$limitvalue;
	$pagination_array['limit']=$limit;
	$pagination_array['totalrows']=$totalrows;
	$pagination_array['starting']=$starting;
	$pagination_array['ending']=$ending;
		
	
	return $pagination_array;
	
	
	
	



}


function generate_pagination_sql_correct($sql,$limit,$page,$PageLink,$PageArg=false)
{
	
	$pagination_array=array();
	
	$sqlCount = $sql;	
	$rsCount = mysql_query($sqlCount);
	$totalrows = mysql_num_rows($rsCount);
	$limit=isset($limit)?$limit:RESULT_PER_PAGE;
	
	$limitvalue = ($page - 1) * $limit;			
	ob_start();
	if($page > 1){
	  $pageprev = $page-1;
	  echo("&nbsp;<a  class='pagination_txt'  href='?page=$pageprev&$PageArg' style='color:#FFFFFF'>Prev</a>");
	}			                                                            
	$numofpages = ceil($totalrows / $limit);
	for($i = 1; $i <= $numofpages; $i++)
	{
		if($i > $page-10 and $i < $page+10)
		{
			if($page == $i)
				echo("&nbsp;<span href='#' class='pagination_txt_selected'>".$i."</span>");
			else
				echo("&nbsp;<a class='pagination_txt' href=".$PageLink."?page=$i&$PageArg style='color:#FFFFFF'>$i</a>");
		}
	}
	
	$numofpages = ceil($totalrows / $limit);
	if($page < $numofpages)
	{
		$pagenext = ($page + 1);
	echo ("&nbsp;<a class='pagination_txt'  href=".$PageLink."?page=$pagenext&$PageArg style='color:#FFFFFF'>Next</a>");
	}else
	{
		$pagenext=1;
	}
	
	$sql.=	" LIMIT $limitvalue, $limit";
	$result = mysql_query($sql) or die($sql.mysql_error());
	$total_displaying = mysql_num_rows($result);
	$starting = ($total_displaying > 0) ? $limitvalue : 0;
	$ending = $limitvalue+$total_displaying;
	
	$pagination = ob_get_contents();
	ob_end_clean();
	
	
	$pagination_array['paging']=$pagination;
	$pagination_array['limitvalue']=$limitvalue;
	$pagination_array['limit']=$limit;
	$pagination_array['totalrows']=$totalrows;
	$pagination_array['starting']=$starting;
	$pagination_array['ending']=$ending;
		
	
	return $pagination_array;
	
	
	
	



}



function make_table_orignal($data,$columns=1)
{


	#################### REQUIRED INPUT ####################
	/*
	1. REQUIRED
	$data should be an array, and array key must be 
	an integer starting with 0 and must contain 
	further iteration in sequence. For example
	
	$data[0] = "any value";
	$data[1] = "any value";
	$data[2] = "any value";
	$data[3] = "any value";
	
	2. REQUIRED
	$columns must be a variable
	$columns must have integer value greater than 0
	*/
	#################### REQUIRED INPUT ####################

	$no_of_cells = count($data);
	$no_of_rows = ceil($no_of_cells/$columns);
	$no_of_total_cells = $columns*$no_of_rows;
	$extra_cells = $no_of_total_cells-$no_of_cells;
	

	#################### SUMMARY FOR DEBUGGING ####################
	#	echo "Number of columns: $columns<br>";
	#	echo "Number of rows: $no_of_rows<br>";
	#	echo "Number of data Cells: $no_of_cells<br>";
	#	echo "Number of Extra Cells: $extra_cells<br>";
	#	echo "Number of Total Cells: $no_of_total_cells<br>";
	#################### SUMMARY FOR DEBUGGING ####################
	
	$key = 0;	# THIS VARIABLE WILL BE INCREMENTED ON EARCH CELL

	$HTML = "<table class=\"make_table\" cellspacing=\"0\" cellpadding=\"0\"  >";
	for($i=0;$i<$no_of_rows;$i++)	# THIS LOOP WILL GENERATE TABLE ROWS
	{
		$HTML .= "<tr>";	# START TABLE ROW
		
		for($j=0;$j<$columns;$j++)	# THIS LOOP WILL GENERATE TABLE CELLS
		{
			if(isset($data[$key]))	# IF DATA CELL EXISTS
			{
				$HTML .= "<td class=\"make_table_td\">";	# START TABLE CELL
				$HTML .= $data[$key];
				$HTML .= "</td>";	# END TABLE CELL
			}
			else
			{
				$HTML .= "<td class=\"make_table_td\">";	# START TABLE CELL
				$HTML .= "&nbsp;";	# $data[$key];
				$HTML .= "</td>";	# END TABLE CELL			
			}
			$key++;
		}
		
		$HTML .= "</tr>";	# END TABLE ROW
		
		
	}
	$HTML .= "</table>";
	
	
	#echo $HTML;
	
	
	return $HTML;
}
function make_table($data,$columns=1)
{
	#################### REQUIRED INPUT ####################
	/*
	1. REQUIRED
	$data should be an array, and array key must be 
	an integer starting with 0 and must contain 
	further iteration in sequence. For example
	
	$data[0] = "any value";
	$data[1] = "any value";
	$data[2] = "any value";
	$data[3] = "any value";
	
	2. REQUIRED
	$columns must be a variable
	$columns must have integer value greater than 0
	*/
	#################### REQUIRED INPUT ####################

	$no_of_cells = count($data);
	$no_of_rows = ceil($no_of_cells/$columns);
	$no_of_total_cells = $columns*$no_of_rows;
	$extra_cells = $no_of_total_cells-$no_of_cells;
	
	#################### SUMMARY FOR DEBUGGING ####################
	#	echo "Number of columns: $columns<br>";
	#	echo "Number of rows: $no_of_rows<br>";
	#	echo "Number of data Cells: $no_of_cells<br>";
	#	echo "Number of Extra Cells: $extra_cells<br>";
	#	echo "Number of Total Cells: $no_of_total_cells<br>";
	#################### SUMMARY FOR DEBUGGING ####################
	
	$key = 0;	# THIS VARIABLE WILL BE INCREMENTED ON EARCH CELL

	$HTML = "<table class=\"make_table\">";
	$count=0;
	for($i=0;$i<$no_of_rows;$i++)	# THIS LOOP WILL GENERATE TABLE ROWS
	{	
		$HTML .= "<tr>";	# START TABLE ROW
		
		for($j=0;$j<$columns;$j++)	# THIS LOOP WILL GENERATE TABLE CELLS
		{
			if(isset($data[$key]))	# IF DATA CELL EXISTS
			{
				$count++;
				$HTML .= "<td class=\"make_table_td\" valign=\"top\" align=\"left\">";	# START TABLE CELL
				$HTML .='<img id="photo_'.$count.'" src="'.$data[$key].'"   onMouseOver="return showPic(this)" style="cursor:pointer;" onclick="show_large_photo(this)" width="89" border="0" height="67">';
				
				$HTML .= "</td>";	# END TABLE CELL
				
			}
			else
			{
				$HTML .= "<td class=\"make_table_td\">";	# START TABLE CELL
				$HTML .= "&nbsp;";	# $data[$key];
				$HTML .= "</td>";	# END TABLE CELL			
			}
			$key++;
		}
		
		$HTML .= "</tr>";	# END TABLE ROW
	}
	$HTML .= "</table>";
	
	
	#echo $HTML;
	return $HTML;
}

function make_table_makes($data,$columns=1)
{
	#################### REQUIRED INPUT ####################
	/*
	1. REQUIRED
	$data should be an array, and array key must be 
	an integer starting with 0 and must contain 
	further iteration in sequence. For example
	
	$data[0] = "any value";
	$data[1] = "any value";
	$data[2] = "any value";
	$data[3] = "any value";
	
	2. REQUIRED
	$columns must be a variable
	$columns must have integer value greater than 0
	*/
	#################### REQUIRED INPUT ####################

	$no_of_cells = count($data);
	$no_of_rows = ceil($no_of_cells/$columns);
	$no_of_total_cells = $columns*$no_of_rows;
	$extra_cells = $no_of_total_cells-$no_of_cells;
	
	#################### SUMMARY FOR DEBUGGING ####################
	#	echo "Number of columns: $columns<br>";
	#	echo "Number of rows: $no_of_rows<br>";
	#	echo "Number of data Cells: $no_of_cells<br>";
	#	echo "Number of Extra Cells: $extra_cells<br>";
	#	echo "Number of Total Cells: $no_of_total_cells<br>";
	#################### SUMMARY FOR DEBUGGING ####################
	
	$key = 0;	# THIS VARIABLE WILL BE INCREMENTED ON EARCH CELL

	$HTML = "<table width=\"100%\" border=\"0\" cellspacing=\"1\" cellpadding=\"0\" id=\"tabke_makes\"><tr>
                    <td width=\"5%\">&nbsp;</td>
                    <td width=\"31%\">&nbsp;</td>
                    <td width=\"32%\">&nbsp;</td>
                    <td width=\"32%\">&nbsp;</td>
                  </tr>";
	$count=0;
	for($i=0;$i<$no_of_rows;$i++)	# THIS LOOP WILL GENERATE TABLE ROWS
	{	
		$HTML .= "<tr class=\"text_style\"><td>&nbsp;</td>";	# START TABLE ROW
		
		for($j=0;$j<$columns;$j++)	# THIS LOOP WILL GENERATE TABLE CELLS
		{
			if(isset($data[$key]))	# IF DATA CELL EXISTS
			{
				$count++;
				$HTML .= "<td >";	# START TABLE CELL
				$HTML .=$data[$key]['make'];
				
				$HTML .= "</td>";	# END TABLE CELL
				
			}
			else
			{
				$HTML .= "<td class=\"make_table_td\">";	# START TABLE CELL
				$HTML .= "&nbsp;";	# $data[$key];
				$HTML .= "</td>";	# END TABLE CELL			
			}
			$key++;
		}
		
		$HTML .= "</tr>";	# END TABLE ROW
	}
	$HTML .= "</table>";
	
	
	#echo $HTML;
	return $HTML;
}
function show_calender($input_name,$input_id,$form_name,$input_value=false,$input_size=false)
{

if(!$input_size)
{
$input_size=11;
}

			echo"<input class='form_input' id='".$input_id."' name='".$input_name."' value='".$input_value."' style='color: #999999;width: 100px;' />";

echo "&nbsp; <a href='#' id='btn_calendar' onclick='if(self.gfPop)gfPop.fPopCalendar(document.".$form_name.".".$input_name.");return false;' ><img name='popcal' align='absmiddle' src='../calender/calendar.jpg' width='17' height='18' border='0' alt='Calendar'></a>";

}


function show_calender_iframe()
{

	echo "<iframe width=132px; height=142px; name='gToday:contrast:agenda.js' id='gToday:contrast:agenda.js' src='../calender/ipopeng.htm' scrolling='no' frameborder='0' style='visibility:visible; z-index:999; position:absolute; top:-500px; left:-500px;'>
			</iframe>";	
}


function get_user_ip()
{
	$user_ip=0;
	if ($_SERVER['HTTP_X_FORWARD_FOR'])
	{
		$user_ip=$_SERVER['HTTP_X_FORWARD_FOR'];
	}
	else
	{
		$user_ip=$_SERVER['REMOTE_ADDR'];
	} 
return $user_ip;

}

function print_array($data_array)
{
echo "<pre>";

print_r($data_array);
echo "</pre>";
}


function display_makes_count($make_name,$make_array)
{
	$make_count=0;
	if(count($make_array)>0)
	{
		foreach($make_array as $array)
		{
			if($array['make']==$make_name)
			{
				$make_count=$array['count'];
			}
		
		}
	}
	return $make_count;
	
}

function get_feature_listing($limit)
{
$listing_data=array();
//$obj= new Listing();
//$listing_data=$obj->get_feature("get_featured",$limit,1);
return $listing_data;
}

function Execute_command($sql){

try{
	$result=mysql_query($sql);
	
	if(!$result)
	{
		$result=$sql.mysql_error();
	}


}
catch(Exeption $e){
return $e;
}
return $result;
}
//FUNCTION USE TO REDIRECT PAGES 
function redirect_page($page_link)
{

?>
<script language="javascript">
window.location.href="<?php echo $page_link;?>";
</script>
<?php


}
//FUNCTION WILL CHEK EITHER FILE EXTENTION IS COORECT OR FALSE
function check_imge_file_extention($file_ext)
{



if($file_ext=="jpg" or $file_ext=='JPG' or $file_ext=="jpeg" or $file_ext=='JPEG'  or $file_ext=="png" or $file_ext=='PNG' or $file_ext=="gif" or $file_ext=='GIF')
{


return true;

}
else
{
return false;
}

}


function resizeImage($thumb_image_name,$image,$width,$height,$newImageWidth,$newImageHeight,$image_type)
{
 	$newImage = imagecreatetruecolor($newImageWidth,$newImageHeight);


	if($image_type=='jpg'  or $image_type=='JPG' or $image_type=='JPEG'  or $image_type=='jpeg')
	{
	$source = imagecreatefromjpeg($image);
	}
	else if($image_type=='png' or $image_type=='PNG')
	{
	$source = imagecreatefrompng($image);
	
	}
	else if($image_type=='gif' or $image_type=='GIF')
	{
	$source = imagecreatefromgif($image);
	}
	

	imagecopyresampled($newImage,$source,0,0,0,0,$newImageWidth,$newImageHeight,$width,$height);

	if($image_type=='jpg' or $image_type=='JPG' or $image_type=='JPEG'  or $image_type=='jpeg')
	{
	imagejpeg($newImage,$thumb_image_name,90);
	}
	else if($image_type=='png' or $image_type=='PNG')
	{
	imagepng($newImage,$thumb_image_name);
	
	}
	else if($image_type=='gif' or $image_type=='GIF')
	{
	imagegif($newImage,$thumb_image_name,90);
	}
	
	//chmod($thumb_image_name, 0777);

	return $thumb_image_name;

}

//FUNCTION WILL GET THE IMAGE HEIGHT

function getHeight($image) {

	$sizes = getimagesize($image);

	$height = $sizes[1];

	return $height;

}
//FUNCTION WILL GET THE IMAGE WIDTH
function getWidth($image) {

	$sizes = getimagesize($image);

	$width = $sizes[0];

	return $width;

}

function get_today_date()
{

$today=date("Y-m-d");
return $today;

}


function get_today_time()
{

$time=time();
return $time;

}
function datetime(){
	return date("Y-m-d H:i:s")	;
}
function make_image_array($listing_detail)
{
	$infor_array=array();
	
		$a=0;
		if($listing_detail['image_1']!="")
		{
				$infor_array[$a]=SITE_LISTING_ORIGNAL_PATH.$listing_detail['image_1'];
				$a++;
		}
		
		if($listing_detail['image_2']!="")
		{
				$infor_array[$a]=SITE_LISTING_ORIGNAL_PATH.$listing_detail['image_2'];
				$a++;
		}
		
		if($listing_detail['image_3']!="")
		{
				$infor_array[$a]=SITE_LISTING_ORIGNAL_PATH.$listing_detail['image_3'];
				$a++;
		}
		if($listing_detail['image_4']!="")
		{
				$infor_array[$a]=SITE_LISTING_ORIGNAL_PATH.$listing_detail['image_4'];
				$a++;
		}
		if($listing_detail['image_5']!="")
		{
				$infor_array[$a]=SITE_LISTING_ORIGNAL_PATH.$listing_detail['image_5'];
				$a++;
		}



	return $infor_array;


}





#*********************UBI FUNCTUION STARTS EHRE**************8
function check_email_address($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
?'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
?([A-Za-z0-9]+))$",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}


function display_amount($amount)
{

$amount=SITE_CURRENCY.number_format($amount,2,",",",")."";

return  $amount;
}

function show_date($date_string)
{

 $dateTime = new DateTime($date_string);
 $date_formate=$dateTime->format("l d F,Y");
 return $date_formate;
}
function formatdate($date_string)
{

 $dateTime = new DateTime($date_string);
 $date_formate=$dateTime->format("D d F,Y");
 return $date_formate;
}

function send_email($from,$to,$subject,$body)
{

	$headers = "From: ".$from." \r\n";
	$headers.= "Content-Type: text/html; charset=ISO-8859-1 ";
	$headers .= "MIME-Version: 1.0 ";

try
{
	$result=mail($to,$subject, $body, $headers);
	return $result;
}
catch(Exception $ex)
{
	return false;
}

}




function check_numbers($val)
{

	$val_leg=strlen($val);
	
	if ($val_leg<4) 
	{
		return false;
	}
	else
	{
		return true;
	}
	//if (ereg("^[0-9]{3,16}$",$val))
	//if (ereg("^((\([0-9]{3}\) ?)|([0-9]{3}-))?[0-9]{3}-[0-9]{4}$",$val))
//	{
//		return true;
//	}elseif (ereg("^[0-9]{5,16}$",$val)){
//	return true;
//	}
//	else
//	{
//		return false;
//	}
}

function check_text($val)
{
	//if (ereg("^[0-9]{3,16}$",$val))
	$val=str_replace(" ","",$val);
	if (ereg("^[a-zA-Z0-9_]{3,16}$",$val)) 
	{
		return true;
	}
	else
	{
		return false;
	}
}
function check_string($val)
{
	
	$val_leg=strlen($val);
	
	if ($val_leg<4) 
	{
		return false;
	}
	else
	{
		return true;
	}
}

function Code_generate()
{
$arr=array();
  //srand(time());
    for ($i=0; $i<4 ; $i++)
    {
      $random = (rand()%9);
      $slot[] = $random;
    }
	$dat=time();
for($j=0;$j<10;$j++)
{
$arr[$j]=substr($dat,$j,1);
}
$no=$slot[0]."".$slot[1]."".$slot[2]."".$slot[3]."".$arr[9]."".$slot[4]."".$arr[0]."".$slot[5]."".$slot[6]."".$slot[7]."".$slot[8]."".$slot[9];
	
	return $no;
	
	
	}

#************UBIFUNCTION END HERE&******************************
function end_user_login($email, $password , $level){
	$sql = "select * from users where email = '$email' AND password = '$password'";
	$result = Execute_command($sql);
if(mysql_num_rows($result)>0){
	$fetch = mysql_fetch_assoc($result);
	if($fetch['is_active']==0){
		return "Not Active";		
		}
	else{
		$_SESSION['USER_LOGIN_EMAIL'] = $fetch['email'];
		$_SESSION['USER_LOGIN_ID'] = $fetch['user_id'];
		$_SESSION['USER_LOGIN_LEVEL'] = $level;
		return "Active";
		}}
else{
	return "not valid";
	
	}	
	
	}

/************ ASAD FUNCTIONS START *****************/

function inventorySortValues(){
	
	$data = array(
		
		"created_date" => "Age"
		,"exterior" => "Color"
		,"make" => "Make"
		,"miles" => "Mileage"
		,"model" => "Model"
		,"price" => "Price"
		,"stock_no" => "Stock Number"
		,"vin" => "VIN"
		,"year" => "Year"
		
		);
		
	return $data;
	
}

function dropDownInventorySortValues($selected = ""){
	
	$values = inventorySortValues();
	
	$option = "";
	
	foreach($values as $key => $value){
		
		$option .= '<option value="'.$key.'"';
		
		if($key == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$value.'</option>';
		
	}
	
	return $option;
	
}

/************ ASAD FUNCTIONS END *****************/

function dropDownUSStates($selected = ""){
	
	include_once($apipath."contents.class.php");
	
	$obj = new Contents();
	
	$values = $obj->getStates();
	
	$option = "";
	
	while($row = mysql_fetch_array($values)){
		
		$option .= '<option value="'.$row['state'].'"';
		
		if($row['state'] == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$row['state'].'</option>';
		
	}
	
	return $option;
	
}

function dropDownCountry($selected = ""){
	
	$countries = array(
		
		"United States" => "United States"
		, "Canada"		=> "Canada"
		
		);
	
	$option = "";
	
	foreach($countries as $key => $value){
		
		$option .= '<option value="'.$key.'"';
		
		if($key == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$value.'</option>';
		
	}
	
	return $option;
}

function dropDownCanadianStates($selected = ""){
	
	$canadian_states = array( 
					    "British Columbia" => "British Columbia", 
					    "Ontario" => "Ontario", 
					    "Newfoundland and Labrador"=>"Newfoundland and Labrador", 
					    "Nova Scotia"=>"Nova Scotia", 
					    "Prince Edward Island"=>"Prince Edward Island", 
					    "New Brunswick"=>"New Brunswick", 
					    "Quebec"=>"Quebec", 
					    "Manitoba"=>"Manitoba", 
					    "Saskatchewan"=>"Saskatchewan", 
					    "Alberta"=>"Alberta", 
					    "Northwest Territories"=>"Northwest Territories", 
					    "Nunavut"=>"Nunavut",
					    "Yukon Territory"=>"Yukon Territory"
					    );
	
	
	foreach($canadian_states as $key => $value){
		
		$option .= '<option value="'.$key.'"';
		
		if($key == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$value.'</option>';
		
	}
	
	return $option;
}

function dropDownTimeZone($selected = ""){
	
	$timezones = array(
					    'Pacific/Midway'       => "(GMT-11:00) Midway Island",
					    'US/Samoa'             => "(GMT-11:00) Samoa",
					    'US/Hawaii'            => "(GMT-10:00) Hawaii",
					    'US/Alaska'            => "(GMT-09:00) Alaska",
					    'US/Pacific'           => "(GMT-08:00) Pacific Time (US &amp; Canada)",
					    'America/Tijuana'      => "(GMT-08:00) Tijuana",
					    'US/Arizona'           => "(GMT-07:00) Arizona",
					    'US/Mountain'          => "(GMT-07:00) Mountain Time (US &amp; Canada)",
					    'America/Chihuahua'    => "(GMT-07:00) Chihuahua",
					    'America/Mazatlan'     => "(GMT-07:00) Mazatlan",
					    'America/Mexico_City'  => "(GMT-06:00) Mexico City",
					    'America/Monterrey'    => "(GMT-06:00) Monterrey",
					    'Canada/Saskatchewan'  => "(GMT-06:00) Saskatchewan",
					    'US/Central'           => "(GMT-06:00) Central Time (US &amp; Canada)",
					    'US/Eastern'           => "(GMT-05:00) Eastern Time (US &amp; Canada)",
					    'US/East-Indiana'      => "(GMT-05:00) Indiana (East)",
					    'America/Bogota'       => "(GMT-05:00) Bogota",
					    'America/Lima'         => "(GMT-05:00) Lima",
					    'America/Caracas'      => "(GMT-04:30) Caracas",
					    'Canada/Atlantic'      => "(GMT-04:00) Atlantic Time (Canada)",
					    'America/La_Paz'       => "(GMT-04:00) La Paz",
					    'America/Santiago'     => "(GMT-04:00) Santiago",
					    'Canada/Newfoundland'  => "(GMT-03:30) Newfoundland",
					    'America/Buenos_Aires' => "(GMT-03:00) Buenos Aires",
					    'Greenland'            => "(GMT-03:00) Greenland",
					    'Atlantic/Stanley'     => "(GMT-02:00) Stanley",
					    'Atlantic/Azores'      => "(GMT-01:00) Azores",
					    'Atlantic/Cape_Verde'  => "(GMT-01:00) Cape Verde Is.",
					    'Africa/Casablanca'    => "(GMT) Casablanca",
					    'Europe/Dublin'        => "(GMT) Dublin",
					    'Europe/Lisbon'        => "(GMT) Lisbon",
					    'Europe/London'        => "(GMT) London",
					    'Africa/Monrovia'      => "(GMT) Monrovia",
					    'Europe/Amsterdam'     => "(GMT+01:00) Amsterdam",
					    'Europe/Belgrade'      => "(GMT+01:00) Belgrade",
					    'Europe/Berlin'        => "(GMT+01:00) Berlin",
					    'Europe/Bratislava'    => "(GMT+01:00) Bratislava",
					    'Europe/Brussels'      => "(GMT+01:00) Brussels",
					    'Europe/Budapest'      => "(GMT+01:00) Budapest",
					    'Europe/Copenhagen'    => "(GMT+01:00) Copenhagen",
					    'Europe/Ljubljana'     => "(GMT+01:00) Ljubljana",
					    'Europe/Madrid'        => "(GMT+01:00) Madrid",
					    'Europe/Paris'         => "(GMT+01:00) Paris",
					    'Europe/Prague'        => "(GMT+01:00) Prague",
					    'Europe/Rome'          => "(GMT+01:00) Rome",
					    'Europe/Sarajevo'      => "(GMT+01:00) Sarajevo",
					    'Europe/Skopje'        => "(GMT+01:00) Skopje",
					    'Europe/Stockholm'     => "(GMT+01:00) Stockholm",
					    'Europe/Vienna'        => "(GMT+01:00) Vienna",
					    'Europe/Warsaw'        => "(GMT+01:00) Warsaw",
					    'Europe/Zagreb'        => "(GMT+01:00) Zagreb",
					    'Europe/Athens'        => "(GMT+02:00) Athens",
					    'Europe/Bucharest'     => "(GMT+02:00) Bucharest",
					    'Africa/Cairo'         => "(GMT+02:00) Cairo",
					    'Africa/Harare'        => "(GMT+02:00) Harare",
					    'Europe/Helsinki'      => "(GMT+02:00) Helsinki",
					    'Europe/Istanbul'      => "(GMT+02:00) Istanbul",
					    'Asia/Jerusalem'       => "(GMT+02:00) Jerusalem",
					    'Europe/Kiev'          => "(GMT+02:00) Kyiv",
					    'Europe/Minsk'         => "(GMT+02:00) Minsk",
					    'Europe/Riga'          => "(GMT+02:00) Riga",
					    'Europe/Sofia'         => "(GMT+02:00) Sofia",
					    'Europe/Tallinn'       => "(GMT+02:00) Tallinn",
					    'Europe/Vilnius'       => "(GMT+02:00) Vilnius",
					    'Asia/Baghdad'         => "(GMT+03:00) Baghdad",
					    'Asia/Kuwait'          => "(GMT+03:00) Kuwait",
					    'Africa/Nairobi'       => "(GMT+03:00) Nairobi",
					    'Asia/Riyadh'          => "(GMT+03:00) Riyadh",
					    'Asia/Tehran'          => "(GMT+03:30) Tehran",
					    'Europe/Moscow'        => "(GMT+04:00) Moscow",
					    'Asia/Baku'            => "(GMT+04:00) Baku",
					    'Europe/Volgograd'     => "(GMT+04:00) Volgograd",
					    'Asia/Muscat'          => "(GMT+04:00) Muscat",
					    'Asia/Tbilisi'         => "(GMT+04:00) Tbilisi",
					    'Asia/Yerevan'         => "(GMT+04:00) Yerevan",
					    'Asia/Kabul'           => "(GMT+04:30) Kabul",
					    'Asia/Karachi'         => "(GMT+05:00) Karachi",
					    'Asia/Tashkent'        => "(GMT+05:00) Tashkent",
					    'Asia/Kolkata'         => "(GMT+05:30) Kolkata",
					    'Asia/Kathmandu'       => "(GMT+05:45) Kathmandu",
					    'Asia/Yekaterinburg'   => "(GMT+06:00) Ekaterinburg",
					    'Asia/Almaty'          => "(GMT+06:00) Almaty",
					    'Asia/Dhaka'           => "(GMT+06:00) Dhaka",
					    'Asia/Novosibirsk'     => "(GMT+07:00) Novosibirsk",
					    'Asia/Bangkok'         => "(GMT+07:00) Bangkok",
					    'Asia/Jakarta'         => "(GMT+07:00) Jakarta",
					    'Asia/Krasnoyarsk'     => "(GMT+08:00) Krasnoyarsk",
					    'Asia/Chongqing'       => "(GMT+08:00) Chongqing",
					    'Asia/Hong_Kong'       => "(GMT+08:00) Hong Kong",
					    'Asia/Kuala_Lumpur'    => "(GMT+08:00) Kuala Lumpur",
					    'Australia/Perth'      => "(GMT+08:00) Perth",
					    'Asia/Singapore'       => "(GMT+08:00) Singapore",
					    'Asia/Taipei'          => "(GMT+08:00) Taipei",
					    'Asia/Ulaanbaatar'     => "(GMT+08:00) Ulaan Bataar",
					    'Asia/Urumqi'          => "(GMT+08:00) Urumqi",
					    'Asia/Irkutsk'         => "(GMT+09:00) Irkutsk",
					    'Asia/Seoul'           => "(GMT+09:00) Seoul",
					    'Asia/Tokyo'           => "(GMT+09:00) Tokyo",
					    'Australia/Adelaide'   => "(GMT+09:30) Adelaide",
					    'Australia/Darwin'     => "(GMT+09:30) Darwin",
					    'Asia/Yakutsk'         => "(GMT+10:00) Yakutsk",
					    'Australia/Brisbane'   => "(GMT+10:00) Brisbane",
					    'Australia/Canberra'   => "(GMT+10:00) Canberra",
					    'Pacific/Guam'         => "(GMT+10:00) Guam",
					    'Australia/Hobart'     => "(GMT+10:00) Hobart",
					    'Australia/Melbourne'  => "(GMT+10:00) Melbourne",
					    'Pacific/Port_Moresby' => "(GMT+10:00) Port Moresby",
					    'Australia/Sydney'     => "(GMT+10:00) Sydney",
					    'Asia/Vladivostok'     => "(GMT+11:00) Vladivostok",
					    'Asia/Magadan'         => "(GMT+12:00) Magadan",
					    'Pacific/Auckland'     => "(GMT+12:00) Auckland",
					    'Pacific/Fiji'         => "(GMT+12:00) Fiji",
					);
	
	foreach($timezones as $key => $value){
		
		$option .= '<option value="'.$key.'"';
		
		if($key == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$value.'</option>';
		
	}
	
	return $option;
	
}



	
function dropDownCraiglist($selected = ""){
	
	$values = array(
		
					"SF bay area"
					,"abilene"
					,"akron / canton"
					,"albany"
					,"albany, GA"
					,"albuquerque"
					,"altoona-johnstown"
					,"amarillo"
					,"ames, IA"
					,"anchorage / mat-su"
					,"ann arbor"
					,"annapolis"
					,"appleton-oshkosh-FDL"
					,"asheville"
					,"ashtabula"
					,"athens, GA"
					,"athens, OH"
					,"atlanta"
					,"auburn"
					,"augusta"
					,"austin"
					,"bakersfield"
					,"baltimore"
					,"baton rouge"
					,"battle creek"
					,"beaumont / port arthur"
					,"bellingham"
					,"bemidji"
					,"bend"
					,"billings"
					,"binghamton"
					,"birmingham, AL"
					,"bismarck"
					,"bloomington, IN"
					,"bloomington-normal"
					,"boise"
					,"boone"
					,"boston"
					,"boulder"
					,"bowling green"
					,"bozeman"
					,"brainerd"
					,"brownsville"
					,"brunswick, GA"
					,"buffalo"
					,"butte"
					,"cape cod / islands"
					,"catskills"
					,"cedar rapids"
					,"central NJ"
					,"central louisiana"
					,"central michigan"
					,"champaign urbana"
					,"charleston, SC"
					,"charleston, WV"
					,"charlotte"
					,"charlottesville"
					,"chattanooga"
					,"chautauqua"
					,"chicago"
					,"chico"
					,"chillicothe"
					,"cincinnati, OH"
					,"clarksville, TN"
					,"cleveland"
					,"clovis / portales"
					,"college station"
					,"colorado springs"
					,"columbia / jeff city"
					,"columbia, SC"
					,"columbus"
					,"columbus, GA"
					,"cookeville"
					,"corpus christi"
					,"corvallis/albany"
					,"cumberland valley"
					,"dallas / fort worth"
					,"danville"
					,"dayton / springfield"
					,"daytona beach"
					,"decatur, IL"
					,"deep east texas"
					,"del rio / eagle pass"
					,"delaware"
					,"denver"
					,"des moines"
					,"detroit metro"
					,"dothan, AL"
					,"dubuque"
					,"duluth / superior"
					,"east idaho"
					,"east oregon"
					,"eastern CO"
					,"eastern CT"
					,"eastern NC"
					,"eastern kentucky"
					,"eastern panhandle"
					,"eastern shore"
					,"eau claire"
					,"el paso"
					,"elko"
					,"elmira-corning"
					,"erie, PA"
					,"eugene"
					,"evansville"
					,"fairbanks"
					,"fargo / moorhead"
					,"farmington, NM"
					,"fayetteville"
					,"fayetteville, AR"
					,"finger lakes"
					,"flagstaff / sedona"
					,"flint"
					,"florence / muscle shoals"
					,"florence, SC"
					,"florida keys"
					,"fort collins / north CO"
					,"fort dodge"
					,"fort smith, AR"
					,"fort wayne"
					,"frederick"
					,"fredericksburg"
					,"fresno / madera"
					,"ft myers / SW florida"
					,"gadsden-anniston"
					,"gainesville"
					,"galveston"
					,"glens falls"
					,"gold country"
					,"grand forks"
					,"grand island"
					,"grand rapids"
					,"great falls"
					,"green bay"
					,"greensboro"
					,"greenville / upstate"
					,"gulfport / biloxi"
					,"hampton roads"
					,"hanford-corcoran"
					,"harrisburg"
					,"harrisonburg"
					,"hartford"
					,"hattiesburg"
					,"hawaii"
					,"heartland florida"
					,"helena"
					,"hickory / lenoir"
					,"high rockies"
					,"hilton head"
					,"holland"
					,"houma"
					,"houston"
					,"hudson valley"
					,"humboldt county"
					,"huntington-ashland"
					,"huntsville / decatur"
					,"imperial county"
					,"indianapolis"
					,"inland empire"
					,"iowa city"
					,"ithaca"
					,"jackson, MI"
					,"jackson, MS"
					,"jackson, TN"
					,"jacksonville"
					,"jacksonville, NC"
					,"janesville"
					,"jersey shore"
					,"jonesboro"
					,"joplin"
					,"kalamazoo"
					,"kalispell"
					,"kansas city, MO"
					,"kenai peninsula"
					,"kennewick-pasco-richland"
					,"kenosha-racine"
					,"killeen / temple / ft hood"
					,"kirksville"
					,"klamath falls"
					,"knoxville"
					,"kokomo"
					,"la crosse"
					,"la salle co"
					,"lafayette"
					,"lafayette / west lafayette"
					,"lake charles"
					,"lake of the ozarks"
					,"lakeland"
					,"lancaster, PA"
					,"lansing"
					,"laredo"
					,"las cruces"
					,"las vegas"
					,"lawrence"
					,"lawton"
					,"lehigh valley"
					,"lewiston / clarkston"
					,"lexington, KY"
					,"lima / findlay"
					,"lincoln"
					,"little rock"
					,"logan"
					,"long island"
					,"los angeles"
					,"louisville"
					,"lubbock"
					,"lynchburg"
					,"macon / warner robins"
					,"madison"
					,"maine"
					,"manhattan, KS"
					,"mankato"
					,"mansfield"
					,"mason city"
					,"mattoon-charleston"
					,"mcallen / edinburg"
					,"meadville"
					,"medford-ashland"
					,"memphis, TN"
					,"mendocino county"
					,"merced"
					,"meridian"
					,"milwaukee"
					,"minneapolis / st paul"
					,"missoula"
					,"mobile"
					,"modesto"
					,"mohave county"
					,"monroe"
					,"monroe, LA"
					,"montana (old)"
					,"monterey bay"
					,"montgomery"
					,"morgantown"
					,"moses lake"
					,"muncie / anderson"
					,"muskegon"
					,"myrtle beach"
					,"nashville"
					,"new hampshire"
					,"new haven"
					,"new orleans"
					,"new river valley"
					,"new york city"
					,"north central FL"
					,"north dakota"
					,"north jersey"
					,"north mississippi"
					,"north platte"
					,"northeast SD"
					,"northern WI"
					,"northern michigan"
					,"northern panhandle"
					,"northwest CT"
					,"northwest GA"
					,"northwest KS"
					,"northwest OK"
					,"ocala"
					,"odessa / midland"
					,"ogden-clearfield"
					,"okaloosa / walton"
					,"oklahoma city"
					,"olympic peninsula"
					,"omaha / council bluffs"
					,"oneonta"
					,"orange county"
					,"oregon coast"
					,"orlando"
					,"outer banks"
					,"owensboro"
					,"palm springs, CA"
					,"panama city, FL"
					,"parkersburg-marietta"
					,"pensacola"
					,"peoria"
					,"philadelphia"
					,"phoenix"
					,"pierre / central SD"
					,"pittsburgh"
					,"plattsburgh-adirondacks"
					,"poconos"
					,"port huron"
					,"portland, OR"
					,"potsdam-canton-massena"
					,"prescott"
					,"provo / orem"
					,"pueblo"
					,"pullman / moscow"
					,"quad cities, IA/IL"
					,"raleigh / durham / CH"
					,"rapid city / west SD"
					,"reading"
					,"redding"
					,"reno / tahoe"
					,"rhode island"
					,"richmond"
					,"richmond, IN"
					,"roanoke"
					,"rochester, MN"
					,"rochester, NY"
					,"rockford"
					,"roseburg"
					,"roswell / carlsbad"
					,"sacramento"
					,"saginaw-midland-baycity"
					,"salem, OR"
					,"salina"
					,"salt lake city"
					,"san angelo"
					,"san antonio"
					,"san diego"
					,"san luis obispo"
					,"san marcos"
					,"sandusky"
					,"santa barbara"
					,"santa fe / taos"
					,"santa maria"
					,"sarasota-bradenton"
					,"savannah / hinesville"
					,"scottsbluff / panhandle"
					,"scranton / wilkes-barre"
					,"seattle-tacoma"
					,"sheboygan, WI"
					,"show low"
					,"shreveport"
					,"sierra vista"
					,"sioux city, IA"
					,"sioux falls / SE SD"
					,"siskiyou county"
					,"skagit / island / SJI"
					,"south bend / michiana"
					,"south coast"
					,"south dakota"
					,"south florida"
					,"south jersey"
					,"southeast IA"
					,"southeast KS"
					,"southeast alaska"
					,"southeast missouri"
					,"southern WV"
					,"southern illinois"
					,"southern maryland"
					,"southwest KS"
					,"southwest MN"
					,"southwest MS"
					,"southwest TX"
					,"southwest VA"
					,"southwest michigan"
					,"space coast"
					,"spokane / coeur d'alene"
					,"springfield, IL"
					,"springfield, MO"
					,"st augustine"
					,"st cloud"
					,"st george"
					,"st joseph"
					,"st louis, MO"
					,"state college"
					,"statesboro"
					,"stillwater"
					,"stockton"
					,"susanville"
					,"syracuse"
					,"tallahassee"
					,"tampa bay area"
					,"terre haute"
					,"texarkana"
					,"texoma"
					,"the thumb"
					,"toledo"
					,"topeka"
					,"treasure coast"
					,"tri-cities, TN"
					,"tucson"
					,"tulsa"
					,"tuscaloosa"
					,"tuscarawas co"
					,"twin falls"
					,"twin tiers NY/PA"
					,"tyler / east TX"
					,"upper peninsula"
					,"utica-rome-oneida"
					,"valdosta"
					,"ventura county"
					,"vermont"
					,"victoria, TX"
					,"visalia-tulare"
					,"waco"
					,"washington, DC"
					,"waterloo / cedar falls"
					,"watertown"
					,"wausau"
					,"wenatchee"
					,"west virginia (old)"
					,"western IL"
					,"western KY"
					,"western maryland"
					,"western massachusetts"
					,"western slope"
					,"wichita"
					,"wichita falls"
					,"williamsport"
					,"wilmington, NC"
					,"winchester"
					,"winston-salem"
					,"worcester / central MA"
					,"wyoming"
					,"yakima"
					,"york, PA"
					,"youngstown"
					,"yuba-sutter"
					,"yuma"
					,"zanesville / cambridge"
		
					);
	
	
	foreach($values as $value){
		
		$option .= '<option value="'.$value.'"';
		
		if($value == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$value.'</option>';
		
	}
	
	return $option;
	
}
//LEO FUNCTIONS |ADDED BY LEO 3-6-2013
function loadStates(){
	$result_info=array();
	$sql="select * from tbl_states order by state asc";
	
	$result=Execute_command($sql);

	try	{
			while($record=mysql_fetch_array($result))
				{
					$result_info[]=$record;
				}
		}
		catch(Exception $e)
		{
			$_SESSION['mysql_eror']=$result;
		}
	
	return $result_info;	
}
function imgUrlNotExist($url){
	$url_arr= getimagesize($url);
	if(!is_array($url_arr)){
			return true;
	}
}
function limitStrLen($str,$length=17){
	$new_str = "";
	 if (strlen($str) > $length){
	   $new_str = substr($str, 0, $length) . '...';
	   }
	  else {
	 	 $new_str = $str;
	  }
	 return $new_str;
}
function mres($string) {
	$new_string = mysqli_real_escape_string($string);
	return $new_string;
}
function generateLeadNo() {
	$codex=date("mdy");
	return $codex;
}
function dropDownUserType($selected = ""){
	
	$usertype = array( 
					    "Owner" 	=> "Owner", 
					    "Manager"	=>"Manager",
					    "Demo"	=>"Demo"
					    );

	foreach($usertype as $key => $value){
		
		$option .= '<option value="'.$key.'"';
		
		if($key == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$value.'</option>';
		
	}
	
	return $option;
}
function sortUserAccounts($selected = ""){
	
	$usertype = array( 
					    "name" => "Name", 
					    "user_type"		   => "Type", 
					    "email"	   =>"Email",
						"phone"		   => "Phone",
						"reg_date"		   => "Created Date"
					    );

	foreach($usertype as $key => $value){
		
		$option .= '<option value="'.$key.'"';
		
		if($key == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$value.'</option>';
		
	}
	
	return $option;
}
function dealersortValues(){
	
	$data = array(
		"AddDate" => "Date Added"
		,"first_name" => "First Name"
		,"last_name" => "Last Name"
		,"listing_id" => "Listing"		
		);
		
	return $data;
	
}
function msgbox($alert="") {
	echo "<script>alert('$alert');</script>";
}
function dropDownDealerSortValues($selected = ""){
	
	$values = dealersortValues();
	
	$option = "";
	
	foreach($values as $key => $value){
		
		$option .= '<option value="'.$key.'"';
		
		if($key == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$value.'</option>';
		
	}
	
	return $option;
	
}

function dropDownColors($selected = ""){
	
	include_once($apipath."listing.class.php");
	
	$obj = new Listing();
	
	$values = $obj->getColors();
	
	$option = "";
	
	while($row = mysql_fetch_array($values)){
		
		$option .= '<option value="'.$row['value'].'"';
		
		if($row['value'] == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$row['title'].'</option>';
		
	}
	
	return $option;
	
}

function dropDownModels($selected = "",$make){
	
	include_once($apipath."listing.class.php");
	
	$obj = new Listing();
	
	$values = $obj->getModelByMake($make);
	
	$option = "";
	
	while($row = mysql_fetch_array($values)){
		
		$option .= '<option value="'.$row['value'].'"';
		
		if($row['value'] == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$row['title'].'</option>';
		
	}
	
	return $option;
	
}

function dropDownBodyType($selected = "",$vehicle){
	
	include_once($apipath."listing.class.php");
	
	$obj = new Listing();
	
	$values = $obj->getBodyByVehicle($vehicle);
	
	$option = "";
	
	while($row = mysql_fetch_array($values)){
		
		$option .= '<option value="'.$row['value'].'"';
		
		if($row['value'] == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$row['title'].'</option>';
		
	}
	
	return $option;
	
}

function dropDownDrives($selected = ""){
	
	include_once($apipath."listing.class.php");
	
	$obj = new Listing();
	
	$values = $obj->getDrives();
	
	$option = "";
	
	while($row = mysql_fetch_array($values)){
		
		$option .= '<option value="'.$row['value'].'"';

		
		if($row['value'] == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$row['title'].'</option>';
		
	}
	
	return $option;
	
}

function dropDownEngines($selected = ""){
	
	include_once($apipath."listing.class.php");
	
	$obj = new Listing();
	
	$values = $obj->getEngines();
	
	$option = "";
	
	while($row = mysql_fetch_array($values)){
		
		$option .= '<option value="'.$row['value'].'"';
		
		if($row['value'] == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$row['title'].'</option>';
		
	}
	
	return $option;
	
}

function dropDownFuelTypes($selected = ""){
	
	include_once($apipath."listing.class.php");
	
	$obj = new Listing();
	
	$values = $obj->getFuelTypes();
	
	$option = "";
	
	while($row = mysql_fetch_array($values)){
		
		$option .= '<option value="'.$row['value'].'"';
		
		if($row['value'] == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$row['title'].'</option>';
		
	}
	
	return $option;
}

function dropDownTransmissions($selected = ""){
	
	include_once($apipath."listing.class.php");
	
	$obj = new Listing();
	
	$values = $obj->getTransmissions();
	
	$option = "";
	
	while($row = mysql_fetch_array($values)){
		
		$option .= '<option value="'.$row['value'].'"';
		
		if($row['value'] == $selected){
			
			$option .= ' selected';
			
		}
		
		$option .= '>'.$row['title'].'</option>';
		//$option .= '>'.$selected.'</option>';
		
	}
	
	return $option;
}

/********** ASAD FUNCTIONS END ******/

//END HERE

?>