<?php
//pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']); ?>

<div id="login">
<?php
	if (isset($_SESSION['loggedin'])) {
		echo	'<h3><a href="../logout.php" title="Login">LOGOUT</a>&nbsp; |</h3>';
	}else{
		echo '<h3><a href="ndex.php" title="Login">LOGIN</a>&nbsp;&nbsp;&nbsp;&nbsp; |</h3>';
	}
?>
<span id="fb"><a href="#" title="Facebook"></a></span>
</div>

<div id="navBar">
    <ul>
        <li><a href="../index.php" <?php if ($currentPage == 'index.php'){echo 'id="activePage"';} ?> class="homeBtn"><span>Home</span></a></li>
        <li><a href="../products.php" <?php if ($currentPage == 'products.php' || $currentPage == 'products_details.php'){echo 'id="activePage"';} ?>class="shopBtn"><span>Products</span></a></li>
       	<li><a href="../about_prod.php" <?php if ($currentPage == 'about_prod.php' || $currentPage == 'about_prod.php'){echo 'id="activePage"';} ?>class="aboutProdBtn"><span>About Our Products</span></a></li>
       	<li><a href="../resources.php" <?php if ($currentPage == 'resources.php'){echo 'id="activePage"';} ?>class="resourcesBtn"><span>Resources</span></a></li>
       	<li><a href="../clearance.php" <?php if ($currentPage == 'clearance.php'){echo 'id="activePage"';} ?>class="clearBtn"><span>Clearance</span></a></li>        
        <li><a href="../faqs.php" <?php if ($currentPage == 'faqs.php'){echo 'id="activePage"';} ?>class="faqBtn"><span>Faqs</span></a></li>
        <li><a href="../contact_us.php" <?php if ($currentPage == 'contact_us.php'){echo 'id="activePage"';} ?>class="contactBtn"><span>Contact Us</span></a></li>
    </ul>
</div>
