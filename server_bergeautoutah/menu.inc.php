<nav>
    <ul id="nav-menu">
        <li<?php echo $page=='index'||$page=='dixiemotors'?" class=active":""; ?>><a href="index.php">Home</a></li>
        <li<?php echo $page=='listings'||$page=='listing_detail'?" class=active":""; ?>><a href="listings.php">Inventory</a></li>
        <li<?php echo $page=='about'?" class=active":""; ?>><a href="about.php" class="sub_menu">About</a></li>
        <li<?php echo $page=='finance'?" class=active":""; ?>><a href="finance.php">Finance</a></li>
        <li<?php echo $page=='contactus'?" class=active":""; ?>><a href="contactus.php">Contact</a></li>
    </ul>
</nav>