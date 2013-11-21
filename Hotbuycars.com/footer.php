<center>

	<?php 

	$contents_obj = new Contents;

	$this_page = basename($_SERVER['REQUEST_URI']);



	if (strpos($this_page, "?") !== false) $this_page = reset(explode("?", $this_page));

	if($this_page=="hotbuycars") $get_ads_bottom = $contents_obj->get_ads("index.php","bottom");

	else $get_ads_bottom = $contents_obj->get_ads($this_page,"bottom");



	foreach($get_ads_bottom as $b_ads) {?>

      <div style = "width:731px; height:91px; margin-top:20px;"><img src = "<?php echo SITE_URL.SITE_ADS_PATH.$b_ads['file_name']; ?>"></div>

     <?php } ?>

</center>

   <!--==============================footer=================================-->

    <footer>

      <div class="container_12">

        <div class="wrapper">

          <div class="grid_12">

            <div class="footer-menu">

              <div class="wrapper">

                <div class="footer-link-box"> <span class="footer-link">HotBuyCars.com &nbsp;&copy; <?php echo date("Y"); ?>&nbsp; &nbsp; &nbsp; <a href="index-2.html" class="decor">Privacy Policy</a></span> </div>

                <ul class="footer-list">

                  <li><a href="findacar.php">Find A Car</a></li>

                  <li><a href="sellacar.php">Sell A Car</a></li>

                  <li><a href="financing.php">Financing</a></li>

                  <li><a href="insurance.php">Insurance</a></li>

                  <li><a href="#">Advertise</a></li>

                  <li><a href="#">Contact Us</a></li>

                </ul>

              </div>

            </div>

            <div class="aligncenter"> <span class="footer-link"><!-- {%FOOTER_LINK} --></span> </div>

          </div>

        </div>

      </div>

    </footer>

    <div class="wrapper">

      <div style = "font-size:10px; line-height:11px;">HotBuyCars.com offers you a great way to buy a used car online or sell used cars online! You can also get a fast cash offer to buy your car. Use our easy car search to "find the best car deals on the web" HotBuyCars.com is powered by DealerEZ which is the easiest, fastest and most cost-effective way to manage your used car dealership and market your cars online!  DealersEZ.com gives you a Free 15 day trial to experience the one-stop dealer management solution to upload your vehicles and create an instant automotive dealer website and online manage and advertise your vehicles to all the top car websites such as Craigslist, AutoTrader and Cars.com where you can find cars for sale in Alabama, Alaska, Arizona, Arkansas, Utah, California, Colorado, Connecticut, Delaware Florida Georgia Hawaii Idaho Illinois Indiana Iowa Kansas Kentucky Louisiana Maine Maryland Massachusetts Michigan Minnesota Mississippi Missouri Montana Nebraska Nevada New Hampshire New Jersey New Mexico New York North Carolina North Dakota Ohio Oklahoma Oregon Pennsylvania Rhode Island South Carolina South Dakota Tennessee Texas Utah Vermont Virginia Washington West Virginia Wisconsin Wyoming. <br>

        <br>

      </div>

    </div>

  </div>

</div>

<?php

$page = basename($_SERVER['REQUEST_URI'],".php");

if($page == "index" || $page ==""){	

?>

<!--<div class="tooltipContent" id="sprytooltip1">This category of cars are pre-owned</div>-->

<?php } ?>

<script defer src="http://server1.opentracker.net/?site=impactsources.com"></script>

<noscript>

</noscript>

<!-- OPENTRACKER HTML END --> 



<script type="text/javascript">

//var sprytooltip1 = new Spry.Widget.Tooltip("sprytooltip1", "#sprytrigger1");

</script>

<div class="modal"><!-- Place at bottom of page --></div>

</body>

</html>