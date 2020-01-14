<?php
//pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']); ?>

<div id="navBar">
    <ul id="centerNav">
        <li><a href="index.php" <?php if ($currentPage == 'index.php'){echo 'id="activePage"';} ?> class="homeBtn"><span><h1>hoME</h1></span></a></li>
        <li><a href="about.php" <?php if ($currentPage == 'about.php'){echo 'id="activePage"';} ?>class="aboutBtn"><span><h1>abOUT</h1></span></a></li>
        <li><a href="riders.php" <?php if ($currentPage == 'riders.php'){echo 'id="activePage"';} ?>class="ridersBtn"><span><h1>theRIDErs</h1></span></a></li>
        <li><a href="contact.php" <?php if ($currentPage == 'contact.php'){echo 'id="activePage"';} ?>class="contactBtn"><span><h1>contACT</h1></span></a></li>
   </ul>
</div>
