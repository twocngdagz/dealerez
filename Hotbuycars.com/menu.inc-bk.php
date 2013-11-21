<?php
$current_page = basename($_SERVER['REQUEST_URI'],".php");
?>
<div class="menu-indent">
  <div class="grid_12">
    <nav>
      <ul class="menu">
        <li class="first"><a href="index.php" class="<?php if($current_page=="index" || $current_page=="") { ?>current <?php } ?>"><span></span>Home</a></li>
        <li><a href="usedcars.php" class="<?php if($current_page=="usedcars") { ?>current <?php } ?>"><span></span>used cars</a></li>
        <li><a href="newcars.php" class="<?php if($current_page=="newcars") { ?>current <?php } ?>"><span></span>new cars</a></li>
        <li><a href="findacar.php" class="<?php if($current_page=="findacar") { ?>current <?php } ?>"><span></span>Find A Car</a></li>
        <li><a href="sellacar.php" class="<?php if($current_page=="sellacar") { ?>current <?php } ?>"><span></span>Sell A Car</a></li>
        <li><a href="financing.php" class="<?php if($current_page=="financing") { ?>current <?php } ?>"><span></span>Financing</a></li>
        <li><a href="insurance.php" class="<?php if($current_page=="insurance") { ?>current <?php } ?>"><span></span>Insurance</a></li>
        <li class="last"><a href="#" ><span></span>Dealers</a>
          <ul>
            <li><a href="dealers.php">Browse All</a>
              <ul style="margin-left:-320px;">
                <li><a href="dealers.php?type=compact">Compact</a></li>
                <li><a href="dealers.php?type=coupe">Coupe</a></li>
                <li><a href="dealers.php?type=convertible">Convertible</a></li>
                <li><a href="dealers.php?type=crossover">Crossover</a></li>
                <li><a href="dealers.php?type=hatchback">Hatchback</a></li>
                <li><a href="dealers.php?type=minivan">MiniVan</a></li>
                <li><a href="dealers.php?type=sedan">Sedan</a></li>
                <li><a href="dealers.php?type=suv">Suv</a></li>
                <li><a href="dealers.php?type=truck">Truck</a></li>
                <li><a href="dealers.php?type=vans">Vans</a></li>
                <li><a href="dealers.php?type=wagon">Wagon</a></li>
                <li><a href="dealers.php?type=it">Industrial Truck</a></li>
              </ul>
            </li>
            <li><a href="search-dealer.php">Search</a></li>
            <li><a href="dealer-services.php">Services</a></li>
            <li><a href="featured-dealers.php">Featured</a></li>
            <li class="last"><a href="dealers-dicker.php">Today's Steals</a></li>
          </ul>
        </li>
      </ul>
      <div class="clear"></div>
    </nav>
  </div>
  <div class="clear"></div>
</div>