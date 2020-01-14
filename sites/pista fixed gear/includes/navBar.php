<?php
//pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']); ?>

<div id="navBar">
    <ul>
        <li><a href="index.php" <?php if ($currentPage == 'index.php'){echo 'id="activePage"';} ?> class="homeBtn"><span>HOME</span></a></li>
        <li><a href="items.php" <?php if ($currentPage == 'items.php' || $currentPage == 'item_detail.php'){echo 'id="activePage"';} ?>class="shopBtn"><span>SHOP</span></a></li>
        <li><a href="news.php" <?php if ($currentPage == 'news.php'){echo 'id="activePage"';} ?>class="newsBtn"><span>NEWS</span></a></li>
        <li><a href="about.php" <?php if ($currentPage == 'about.php'){echo 'id="activePage"';} ?>class="newsBtn"><span>ABOUT</span></a></li>
        <li><a href="contact.php" <?php if ($currentPage == 'contact.php'){echo 'id="activePage"';} ?>class="contactBtn"><span>CONTACT</span></a></li>
    </ul>
</div>
