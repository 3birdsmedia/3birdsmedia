<?php
function activeNav($page){
//pulls out the meta data of the serever giving out the file name.
  $currentPage = basename($_SERVER['SCRIPT_NAME']); 
  if ($currentPage == $page.'.php'){ echo 'activePage';} 
} 
?> 


    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo $root;?>admin/admin.php">craz&#601;FIT Cardio Club</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="<?php activeNav('admin');?>"><a href="<?php echo $root;?>admin/admin.php">Control Panel</a></li>
            <li class="<?php activeNav('index');?>"><a href="<?php echo $root;?>index.php">Go Back to the site</a></li>
            <li class=""><a href="<?php echo $root;?>includes/logout.php">LOGOUT</a></li>
            <!--<li class="<?php activeNav('index');?>"><a href="index.php">About/Contact</a></li>
            <li class="<?php activeNav('regimens');?>"><a href="regimens.php">Regimens/Transformations</a></li>
            <li class="<?php activeNav('subscribe');?>"><a href="subscribe.php">Subscriptions</a></li>-->
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>