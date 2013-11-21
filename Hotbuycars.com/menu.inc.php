<?php

$current_page = basename($_SERVER['REQUEST_URI'],".php");

?>

<div class="menu-indent">

  <div class="grid_12">

    <nav>

      <ul class="menu">

        <li class="first"><a href="index.php" class="<?php if($current_page=="index" || $current_page=="") { ?>current <?php } ?>"><span></span>Home</a></li>

        <li><a href="searchcars.php" class="<?php if($current_page=="searchcars") { ?>current <?php } ?>"><span></span>Find Local Cars</a></li> 

        <li><a href="getcarquote.php" class="<?php if(($current_page=="getcarquote")) { ?>current <?php } ?>"><span></span>Get A Quote</a>

            <!--<ul>

              <li><a href="getquote_newcar.php">New Car Quote</a></li>

              <li><a href="getquote_usedcar.php">Used Car Quote</a></li>

            </ul>-->

        </li>

        <li><a href="sellacar.php" class="<?php if($current_page=="sellacar") { ?>current <?php } ?>"><span></span>Sell Your Car</a>

        	 <ul>

              <li><a href="sellacar.php">Get Fast Offer </a></li>

              <li><a href="#">Consign Your Car</a></li>

            </ul>

        </li>

        <li><a href="insurance.php" class="<?php if($current_page=="insurance") { ?>current <?php } ?>"><span></span>Get Insurance</a></li>

        <li><a href="getapproved.php" class="<?php if($current_page=="getapproved") { ?>current <?php } ?>"><span></span>Get Financed</a>

       		<ul>

              <li><a href="financing.php">Fair to Great Credit</a></li>

              <li><a href="approved.php">Bad or No Credit</a></li>

            </ul>

        </li>

        <li class="last"><a href="search-dealer.php" class="<?php if($current_page=="search-dealer") { ?>current <?php } ?>" ><span></span>Dealers</a>

          <ul>

            <li><a href="search-dealer.php">Find A Dealer </a></li>

            <li><a href="search-dealer.php">List Your Cars </a></li>

            <li class="last"><a href="dealer-services.php">Advertise Here</a></li>



          </ul>

        </li>

      </ul>

      <div class="clear"></div>

    </nav>

  </div>

  <div class="clear"></div>

</div>