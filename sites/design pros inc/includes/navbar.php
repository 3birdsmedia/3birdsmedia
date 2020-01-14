<?php
//pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']); ?>

<div id="navBar">
    <ul class="sf-menu">
        <li id="homeBtn" ><a  href="index.php" id="homeBtn" <?php if ($currentPage == 'index.php'){echo 'class="active"';} ?>><span><h3>HOME</h3></span></a></li>
        <li><a  href="services.php" id="servicesBtn" <?php if ($currentPage == 'services.php'){echo 'class="active"';} ?>><span><h3>SERVICES</h3></span></a>
         </li>
        <li><a  href="our_work.php" id="workBtn" <?php if ($currentPage == 'our_work.php'){echo 'class="active"';} ?>><span><h3>OUR WORK</h3></span></a>
        </li>
        <li><a  href="contact.php" id="contBtn" <?php if ($currentPage == 'contact.php'){echo 'class="active"';} ?>><span><h3>CONTACT</h3></span></a></li>
        <li><a  href="about.php" id="aboutBtn" <?php if ($currentPage == 'about.php'){echo 'class="active"';} ?>><span><h3>ABOUT US</h3></span></a></li>
        <li><a  href="testimonials.php" id="testiBtn" <?php if ($currentPage == 'testimonials.php'){echo 'class="active"';} ?>><span><h3>TESTIMONIALS</h3></span></a></li>
    </ul>
</div>
