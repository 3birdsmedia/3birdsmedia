<?php
//pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']); ?>

<div id="navBar">
    <ul id="centerNav">
        <li><a href="index.php" <?php if ($currentPage == 'index.php'){echo 'id="activePage"';} ?> class="homeBtn"><span><h1>HOME</h1></span></a></li>
        <li><a href="design.php" <?php if ($currentPage == 'design.php'){echo 'id="activePage"';} ?>class="designBtn"><span><h1>DESIGN</h1></span></a></li>
        <li><a href="photo.php" <?php if ($currentPage == 'photo.php'){echo 'id="activePage"';} ?>class="photoBtn"><span><h1>PHOTOGRAPHY</h1></span></a></li>
        <li><a href="bio.php" <?php if ($currentPage == 'bio.php'){echo 'id="activePage"';} ?>class="bioBtn"><span><h1>BIO</h1></span></a></li>
        <li><a href="contact.php" <?php if ($currentPage == 'contact.php'){echo 'id="activePage"';} ?>class="contactBtn"><span><h1>CONTACT</h1></span></a></li>
    </ul>
</div>
