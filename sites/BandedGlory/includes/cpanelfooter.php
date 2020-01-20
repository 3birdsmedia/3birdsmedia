    <div id="inner-footer">
	    <div id="fnavBar">
    <ul>
        <li><a href="../index.php" <?php if ($currentPage == 'index.php'){echo 'id="activePage"';} ?> class="homeBtn"><span>Home</span></a></li>
        <li><a href="../products.php" <?php if ($currentPage == 'products.php' || $currentPage == 'products_details.php'){echo 'id="activePage"';} ?>class="shopBtn"><span>Products</span></a></li>
       	<li><a href="../about_prod.php" <?php if ($currentPage == 'about_prod.php' || $currentPage == 'about_prod.php'){echo 'id="activePage"';} ?>class="aboutProdBtn"><span>About Our Products</span></a></li>
       	<li><a href="../resources.php" <?php if ($currentPage == 'resources.php'){echo 'id="activePage"';} ?>class="resourcesBtn"><span>Resources</span></a></li>
       	<li><a href="../distributors.php" <?php if ($currentPage == 'distributors.php'){echo 'id="activePage"';} ?>class="clearBtn"><span>Distributors</span></a></li>
        <li><a href="../faqs.php" <?php if ($currentPage == 'faqs.php'){echo 'id="activePage"';} ?>class="faqBtn"><span>Faqs</span></a></li>
        <li><a href="../contact_us.php" <?php if ($currentPage == 'contact_us.php'){echo 'id="activePage"';} ?>class="contactBtn"><span>Contact Us</span></a></li>
    </ul>
	    </div>
        <div id="footer-logo"><h3>Banded Glory, LLC</h3></div>
	<span id="copyright"><h3> &copy; <?php setCopyright(2008)?> </h3></span>
    </div>
</div>
<!--Slides-->

