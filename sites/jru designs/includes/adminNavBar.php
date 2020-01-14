<?php
//pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']); ?>

<div id="navBar">
    <ul id="topNav">
     <!--   <li><a href="updateHome.php" <?php if ($currentPage == 'updateHome.php' ){echo 'id="activePage"';} ?> class="adminHomeBtn"><span><h1>Home Page</h1></span></a></li>
        <li><a href="updateAbout.php" <?php if ($currentPage == 'updateAbout.php'){echo 'id="activePage"';} ?>class="aboutBtn"><span><h1>About Page</h1></span></a></li>
        <li><a href="updateProjects.php" <?php if ($currentPage == 'updateProjects.php'){echo 'id="activePage"';} ?>class="projectsBtn"><span><h1>Projects Page</h1></span></a></li>
        <li><a href="../includes/logout.php" <?php if ($currentPage == 'logout.php'){echo 'id="activePage"';} ?>class="logoutBtn"><span><h1>logout</h1></span></a></li>
-->   </ul>
</div>
