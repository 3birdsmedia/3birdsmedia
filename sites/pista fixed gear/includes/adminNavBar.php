<?php
//pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']); ?>

<div id="navBar">
    <ul>
        <li><a href="../index.php" <?php if ($currentPage == 'index.php'){echo 'id="activePage"';} ?> class="homeBtn"><span>Home</span></a></li>
        <div id="visibleNav">
        <li><a href="../details.php" <?php if ($currentPage == 'details.php'){echo 'id="activePage"';} ?>class="shopBtn"><span>Shop</span></a></li>
        <li><a href="../news.php" <?php if ($currentPage == 'news.php'){echo 'id="activePage"';} ?>class="newsBtn"><span>News</span></a></li>
        <li><a href="../about.php" <?php if ($currentPage == 'about.php'){echo 'id="activePage"';} ?>class="aboutBtn"><span>About</span></a></li>
        <li><a href="../contact.php" <?php if ($currentPage == 'contact.php'){echo 'id="activePage"';} ?>class="contactBtn"><span>Contact</span></a></li>
   </div></ul>
</div>
