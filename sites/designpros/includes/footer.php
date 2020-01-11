<div id="modules">
    <div class="module" id="social">
        <a href="blog.php"><img src="images/dpb.jpg" /></a>
        <a href="http://www.linkedin.com/pub/mike-shepherd/2/10/18b" target="_blank"><img src="images/linkedin.jpg" /></a>
        <a href="http://www.facebook.com/pages/Design-Pros/115906858469600" target="_blank"><img src="images/facebook.jpg" /></a>
        <a href="estimate.php" class="estimate"><img src="images/estimate.jpg" /></a>
        
    </div>
    
    <div class="module" id="testimonial">
        <h4>What people are saying...<br /></h4>
        <?php
    $conn = dbConnect('query');
    
    $sql = "SELECT testim_body FROM testimonials
            ORDER by RAND() LIMIT 1";
    
    //submit the SQL query to the database and get the result
    $result = $conn->query($sql) or die(mysqli_error());
    $row = $result->fetch_assoc();
    $text = $row['testim_body'];


    echo '<p>"'.truncText($text).'</p>';
?>    
</div>

    <div class="module" id="addspace">
           <a href="http://www.thebak.com" target="_blank"><img src="images/adds/the_bake_add.gif" /></a>
      </div>
</div>
    <div id="footerNavBar">
        <ul>
            <li><a  href="index.php" id="homeBtn" <?php if ($currentPage == 'index.php'){echo 'class="active"';} ?>><span><h3>HOME</h3></span></a></li>
            <span class='navSpacer'> | </span><li><a  href="services.php" id="servicesBtn" <?php if ($currentPage == 'services.php'){echo 'class="active"';} ?>><span><h3>SERVICES</h3></span></a></li>
            <span class='navSpacer'> | </span><li><a  href="our_work.php" id="workBtn" <?php if ($currentPage == 'our_work.php'){echo 'class="active"';} ?>><span><h3>OUR WORK</h3></span></a></li>
            <span class='navSpacer'> | </span><li><a  href="contact.php" id="contBtn" <?php if ($currentPage == 'contact.php'){echo 'class="active"';} ?>><span><h3>CONTACT</h3></span></a></li>
            <span class='navSpacer'> | </span><li><a  href="about.php" id="aboutBtn" <?php if ($currentPage == 'about.php'){echo 'class="active"';} ?>><span><h3>ABOUT US</h3></span></a></li>
            <span class='navSpacer'> | </span><li><a  href="testimonials.php" id="testiBtn" <?php if ($currentPage == 'testimonials.php'){echo 'class="active"';} ?>><span><h3>TESTIMONIALS</h3></span></a></li>
        </ul>
    </div>

    <div id="infooter">
        <span><p>Copyright &copy; <?php setCopyright('2007'); ?> Design Pros, Inc. All Right Reserved | 2730 S. Harbor Blvd., Suite B | Santa Ana, CA 92704 | Office: 714.850.8833 | Fax: 714.850.1633

<br />Website Design and Interactivity: Design Pros, Inc.</p></span>   
    </div>
