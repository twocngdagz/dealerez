<link rel="stylesheet" href="<?php echo SITE_URL.SITE_CSS_URL;?>pagination_style.css" type="text/css">
<?php
	include_once("includes.php");
	
	$user_id = $_GET['uid'];
	$RESULT_PER_PAGE = PROFILE_LISTINGS_PER_PAGE; //will change according to preferences.

	$listObj = new Listing;
	
	$counter_listing = count($listObj->get_user_listing($user_id));

	
	$getDetails = $listObj->get_user_listing($user_id,0, $counter_listing);
	
	

	$adjacents = 0;


	$total_pages = $counter_listing;
	
	$targetpage = "dealerprofile.php"; 
	$limit = $RESULT_PER_PAGE; 								
	$page = isset($_GET['page'])?$_GET['page']:'';
	
	if($page) 
		$start = ($page - 1) * $limit; 			//first item to display on this page
	else
		$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
	
	$result = $listObj->get_user_listing($user_id,$start, $limit);

	/* Setup page vars for display. */
	if ($page == 0) $page = 1;					//if no page var is given, default to 1.
	$prev = $page - 1;							//previous page is page - 1
	$next = $page + 1;							//next page is page + 1
	$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
	$lpm1 = $lastpage - 1;						//last page minus 1
	

	$pagination = "";
	if($lastpage > 1)
	{	
		$pagination .= "<div class=\"pagination\">";
		//previous button
		if ($page > 1) 
			$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=$prev\">&laquo; Prev |</a>";
		else
			$pagination.= "<span class=\"disabled\">&laquo; Prev |</span>";	
		
		//pages	
		if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=$counter\">$counter</a>";					
			}
		}
		elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
		{
			//close to beginning; only hide later pages
			if($page < 1 + ($adjacents * 2))		
			{
				for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=$lastpage\">$lastpage</a>";		
			}
			//in middle; hide some front and some back
			elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
			{
				$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=$counter\">$counter</a>";					
				}
				$pagination.= "...";
				$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=$lpm1\">$lpm1</a>";
				$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=$lastpage\">$lastpage</a>";		
			}
			//close to end; only hide early pages
			else
			{
				$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=1\">1</a>";
				$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=2\">2</a>";
				$pagination.= "...";
				for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page)
						$pagination.= "<span class=\"current\">$counter</span>";
					else
						$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=$counter\">$counter</a>";					
				}
			}
		}
		
		//next button
		if ($page < $counter - 1) 
			$pagination.= "<a href=\"$targetpage?uid=$user_id&amp;page=$next\">| Next &raquo</a>";
		else
			$pagination.= "<span class=\"disabled\">| Next &raquo;</span>";
		$pagination.= "</div>\n";		
	}
		
		//DECLARE
		  $counter =0;
		  $counter1=0;
		  //print_r($result);
		  foreach($result as $row): $counter++;  $counter1++;
		 
		  ?> 	 
		  <?php if($counter <= 1): ?>
		  <div class="wrapper img-indent-bot1">
		  <?php endif; ?>
  
								  <div class="tab-col tab-col-indent1">
										<div class="p2"> 
                                        <a href="listingdetail.php?lid=<?php echo $row['listing_id'];?>">
                                        <?php  if(empty($row['image_name'])):?>
                                            <img src="images/lp_fl_no_image.jpg"/>
                                        <?php endif; ?>
                                        
										<?php  foreach($row['image_name'] as $list_image => $value): ?>
											
                                            <img src="<?php echo SITE_URL.SITE_LISTING_THUM_PATH.$value['image_name']; ?>" alt="<?php echo $value['image_name']; ?>" /> 
                                          
                                        <?php endforeach; ?>
                                        </a>
                                        </div>
										<span class="block mb5"><a href="listingdetail.php?lid=<?php echo $row['listing_id'];?>" class="link-2"><?php echo $row['title'];?></a></span> <span class="block text-1">Mileage: <strong class="color-3"><?php echo number_format($row['miles']); ?> ml.</strong></span> <span class="block text-1">Price: <strong class="color-5">$<?php echo number_format($row['price']); ?></strong></span>
								  </div>

		   <?php if($counter >= 4): $counter = 0; ?>
		   </div>
		   <?php endif; ?>
  		   <?php endforeach; ?>
           
		   <?php if($counter1 % 4 <> 0):?>
		   </div>
           <?php endif; ?>
			

<?=$pagination?>