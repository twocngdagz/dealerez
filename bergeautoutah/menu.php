<nav>
    <ul id="nav-menu">
        <li<?php echo $page=='index'?" class=active":""; ?>><a href="index.php">Home</a></li>
        <li<?php echo $page=='listings'||$page=='listing_detail'?" class=active":""; ?>><a href="listings.php">Inventory</a></li>
        <li<?php echo $page=='about'||$page=='consignment'||$page=='trade_appraisal'?" class=active":""; ?>><a href="about.php" class="sub_menu">About</a>
            <ul>
                <li><a href="about.php">About Us</a></li>
                <li><a href="consignment.php">Your Trade-In</a></li>
                <li><a href="trade_appraisal.php">Your Credit</a></li>
            </ul>
        </li>
        <li<?php echo $page=='finance'?" class=active":""; ?>><a href="finance.php">Finance</a></li>
        <li<?php echo $page=='blog'||$page=='blog_detail'||$page=='about'||$page=='contactus'?" class=active":""; ?>><a href="contactus.php">Contact</a>
            <ul>
                <li><a href="blog.php">Blog</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contactus.php">Contact Us</a></li>
            </ul>
        </li>
    </ul>
</nav>