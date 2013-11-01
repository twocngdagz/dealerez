<?php  
session_start();
include("includes.php");
$listing_obj = new Listing;

$preowned 	  = $listing_obj->getall_listing(0,12,"created_date","DESC","is_certified_used = 0 and user_id = 349");
$newcars  	  = $listing_obj->getall_listing(0,12,"created_date","DESC","condition_ = 'New' and user_id = 349");

include_once("header.php"); ?>
    <div class="container_1">
    	    <?php include_once("menu.inc.php"); ?>
            <div class="container_2">   
            	  <div id="sitemap">
                  	<h2>Sitemap</h2>
					<div class="separator"></div>
                    <article>
                    	<section>
                        	<h3>Sitemap</h3>
                            <ul>
                                <li><a href="index.php">Home</a></li>
                                <li><a href="listings.php">Inventory</a></li>
                                <li><a href="about.php">About</a></li>
                                <li><a href="finance.php">Finance</a></li>
                                <li><a href="contactus.php">Contact</a></li>
                            </ul>
                        </section>
                        <section>
                        	<h3>Pre-Owned Inventory</h3>
                            <ul>
                            <?php foreach($preowned as $newpreowned) { ?>
                            	 <li><a href="listing_detail.php?lid=<?php echo $newpreowned['listing_id']; ?>"><?php echo $newpreowned['year']." ".$newpreowned['make']." ".$newpreowned['model'];?></a></li>
                            <?php } ?>
                            </ul>
                        </section>
                        <section>
                        	<h3>New Inventory</h3>
                            <ul>
                            <?php foreach($newcars as $newcarsnew) { ?>
                            	 <li><a href="listing_detail.php?lid=<?php echo $newcarsnew['listing_id']; ?>"><?php echo $newcarsnew['year']." ".$newcarsnew['make']." ".$newcarsnew['model'];?></a></li>
                            <?php } ?>
                            </ul>
                        </section>        
                    </article>
                    
                  </div>  
<?php include_once("footer-information.php"); ?> 					
<?php include_once("footer.php"); ?> 