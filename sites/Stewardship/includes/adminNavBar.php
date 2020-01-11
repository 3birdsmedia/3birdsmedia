<?php
//pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']); ?>

<div id="navBar">
    <ul id="centerNav">
        <li><a href="logout.php" <?php if ($currentPage == 'logout.php'){echo 'id="activePage"';} ?>class="logoutBtn"><span><h1>logOUT</h1></span></a></li>
   </ul>
</div>
