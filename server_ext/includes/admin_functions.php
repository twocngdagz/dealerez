<?php

//FUNCTION WILL UPDATE DEALER LISTIMG IMAGES FROM FEED FILE
function upload_listing_images_feeds($file_link,$max_listing_id,$image_no=false,$result)
{
			
			$thumb_path = ROOT_PATH.SITE_LISTING_THUMB_PATH;
			$large_path = ROOT_PATH.SITE_LISTING_IMAGES_PATH;
			$big_path = ROOT_PATH.SITE_LISTING_BIG_PATH;
			$mobile_path = ROOT_PATH.SITE_LISTING_MOBILE_PATH;
			$origianl_path = ROOT_PATH.SITE_LISTING_ORIGNAL_PATH;
		
			$img_count=0;
			$randum_no=rand();
			
		
			if((!empty($file_link)) )
			{
					
					$userfile_tmp = $file_links;
					
					
					//$userfile_size = filesize($file_link);
					
					
					$filename = basename($file_link);
				
				
					$file_ext = substr($filename, strrpos($filename, '.') + 1);
					
					
					$image_type=$file_ext;
					
					$image_name="vh_".$max_listing_id."_".md5(date("d-m-year h:m:s"))."_".$image_no."_".$randum_no;
					$image_name.=".".$file_ext;
					$origianl_path.=$image_name;
					
					#########ORIGNAL IMAGE COPY################
					
					copy($file_link, $origianl_path);
					
					chmod($origianl_path, 0777);
	
					$width = getWidth($origianl_path);
	
					$height = getHeight($origianl_path);
			
							################THUMB IMAAGE#######
							
					$thumb_path.=$image_name;
					$newImageWidth=SITE_LISTING_THUMB_WIDTH;
					$newImageHeight=SITE_LISTING_THUMB_HEIGHT;
					
					
					$uploaded=resizeImage($thumb_path,$origianl_path,$width,$height,$newImageWidth,$newImageHeight,$image_type);
					
						
			################LARGE IMAAGE#######								
				$newImageWidth=SITE_LISTING_LARGE_WIDTH;
				$newImageHeight=SITE_LISTING_LARGE_HEIGHT;
				$large_path.=$image_name;
					
				$uploaded=resizeImage($large_path,$origianl_path,$width,$height,$newImageWidth,$newImageHeight,$image_type);
				
						
						################BIG IMAAGE#######		
						
				$newImageWidth=SITE_LISTING_BIG_WIDTH;
				$newImageHeight=SITE_LISTING_BIG_HEIGHT;
				$big_path.=$image_name;
				
				
					
					
				$uploaded=resizeImage($big_path,$origianl_path,$width,$height,$newImageWidth,$newImageHeight,$image_type);
				
				
				################Mobile IMAAGE#######	
				$newImageWidth=SITE_LISTING_MOBILE_WIDTH;
				$newImageHeight=SITE_LISTING_MOBILE_HEIGHT;
				$mobile_path.=$image_name;
					
				$uploaded=resizeImage($mobile_path,$origianl_path,$width,$height,$newImageWidth,$newImageHeight,$image_type);
				
				
					
			}
				
				
			
return $image_name;

}


?>