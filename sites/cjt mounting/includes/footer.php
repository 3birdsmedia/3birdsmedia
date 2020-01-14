<?php
//pulls out the meta data of the serever giving out the file name.
$currentPage = basename($_SERVER['SCRIPT_NAME']); ?>
<ul id="social">
	      <li id="fb"><a href="http://www.facebook.com/pages/CJT-Mounting/137061943023148" target="_blank"><span>Facebook</span></a></li>
	      <li id="tw"><a href="http://twitter.com/CJT_Mounting" target="_blank"><span>Twitter</span></a></li>
	      <li id="vi"><a href="http://vimeo.com/user6208668" target="_blank"><span>Vimeo</span></a></li>
	      <li id="yt"><a href="http://www.youtube.com/user/yescjt" target="_blank"><span>YouTube</span></a></li>
</ul>

<div id="footerNav">
    <ul>
                             <li><a href="index.php" id="fhomeBtn" <?php if ($currentPage == 'index.php'){echo 'class="activePage"';} ?>><span><h4>Home</h4></span></a></li>
<span class='spacer'>|</span><li><a href="news.php" id="newsBtn" <?php if ($currentPage == 'news.php'){echo 'class="activePage"';} ?>><span><h4>News</h4></span></a></li>
<span class='spacer'>|</span><li><a href="products.php" id="productBtn" <?php if ($currentPage == 'products.php'){echo 'class="activePage"';} ?>><span><h4>Products</h4></span></a></li>
<span class='spacer'>|</span><li><a href="showroom.php" id="showroomBtn"<?php if ($currentPage == 'showroom.php'){echo 'class="activePage"';} ?>><span><h4>Showroom</h4></span></a></li>
<span class='spacer'>|</span><li><a href="resources.php" id="resourcesBtn"<?php if ($currentPage == 'resources.php'){echo 'class="activePage"';} ?>><span><h4>Resources / Support</h4></span></a></li>
<span class='spacer'>|</span><li><a href="Price_List.pdf" target="_blank" id="pricelistBtn"<?php if ($currentPage == 'pricelist.php'){echo 'class="activePage"';} ?>><span><h4>Price list</h4></span></a></li>
<span class='spacer'>|</span><li><a href="contact.php" id="contactBtn"<?php if ($currentPage == 'contact.php'){echo 'class="activePage"';} ?>><span><h4>Contact Us</h4></span></a></li>
    </ul>
</div>

<p>CJT &copy; ALL RIGHTS RESERVED, <?php setCopyright("2000") ?> WEB DESIGN AND DEVELOPMENT: <a href='http://www.designpros-inc.com' target="_blank">DESIGN PROS-INC</a></p>
