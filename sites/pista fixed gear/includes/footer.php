    <div id="inner-footer">
	    <div id="fnavBar">
    <ul>
        <li><a href="index.php" <?php if ($currentPage == 'index.php'){echo 'id="activePage"';} ?> class="homeBtn"><span>HOME</span></a></li>
        <li><a href="items.php" <?php if ($currentPage == 'items.php' || $currentPage == 'item_detail.php'){echo 'id="activePage"';} ?>class="shopBtn"><span>SHOP</span></a></li>
        <li><a href="news.php" <?php if ($currentPage == 'news.php'){echo 'id="activePage"';} ?>class="newsBtn"><span>NEWS</span></a></li>
        <li><a href="about.php" <?php if ($currentPage == 'about.php'){echo 'id="activePage"';} ?>class="newsBtn"><span>ABOUT</span></a></li>
        <li><a href="contact.php" <?php if ($currentPage == 'contact.php'){echo 'id="activePage"';} ?>class="contactBtn"><span>CONTACT</span></a></li>
    </ul>
	    </div>
        <div id="footer-logo"><h3>PISTA FIXED GEAR</h3></div>	
	<span id="copyright"><h3> &copy; <?php setCopyright(2008)?> </h3></span>
    </div>
</div>
<!--Slides-->

