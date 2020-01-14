<?php
//pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']); ?>

<div id="navBar">
    <ul id="topNav">
        <li><a href="index.php" <?php if ($currentPage == 'index.php'){echo 'id="activePage"';} ?> class="homeBtn"><span><h1>home</h1></span></a></li>
        <li><a href="portfolio.php" <?php if ($currentPage == 'portfolio.php'){echo 'id="activePage"';}elseif($currentPage == 'project_details.php'){echo 'id="activePage"';} ?>class="portfolioBtn"><span><h1>portfolio</h1></span></a></li>
        <li><a href="about.php" <?php if ($currentPage == 'about.php'){echo 'id="activePage"';} ?>class="aboutBtn"><span><h1>about</h1></span></a></li>
        <li><a href="blog.php" <?php if ($currentPage == 'blog.php'){echo 'id="activePage"';} ?>class="blogBtn"><span><h1>blog</h1></span></a></li>
        <li><a href="contact.php" <?php if ($currentPage == 'contact.php'){echo 'id="activePage"';} ?>class="contactBtn"><span><h1>contact</h1></span></a></li>
    </ul>
</div>

<script type="text/javascript">
 
    $(function() {
        $('ul#topNav').lavaLamp();
         $('ul#footerNav').lavaLamp();
    });
</script>