<?php
//pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']);
function goHome(){
  if(basename($_SERVER['SCRIPT_NAME']) == 'index.php'){
    return '#home';
  }else{
    return 'index.php';
  }
}
?>


   <nav class="navbar navbar-toggleable-md">
      <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto col-12">
          <li class="nav-item col-12 hidden-lg-up">
            <a class="nav-link brand" href="<?php echo goHome(); ?>"><span class="rev-logo-header">BANDED <strong>GLORY</strong></span></a>
          </li>
          <li class="nav-item col-lg-4 col-sm-12 left">
            <a class="nav-link" href="products.php">Products</a>
          </li>
          <li class="nav-item col-4 hidden-md-down">
            <a class="nav-link brand" href="<?php echo goHome(); ?>"><span class="logo-header">Banded Glory</span></a>
          </li>
          <li class="nav-item col-lg-4 col-sm-12 right">
            <a class="nav-link" href="about.php">About Us</a>
          </li>
        </ul>
      </div>
    </nav>
