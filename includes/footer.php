<footer>
    <div class="row">
        <div class="col-md-4">
            <a class="navbar-brand" href="index.php">3birdsmedia</a>
        </div>

        <div class="col-md-3 text-center copyright">
            <p>3BirdsMedia - Copyright &copy;
            <?php setCopyright(2011); ?></p>
        </div>

        <div class="col-md-5 d-flex justify-content-center">

            <ul class="nav navbar-nav flex-row align-items-center">
              <li class=""><a href="portfolio.php">Portfolio</a></li>
              <li class=""><a href="about.php">About</a></li>
              <li class=""><a href="about.php">Resume</a></li>
              <li class=""><a href="testimonials.php">Testimonials</a></li>
              <li class=""><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
</footer>
    <!-- Bootstrap core JavaScript
    ================================================== -->
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/3be302b384.js" crossorigin="anonymous"></script>
    <script src="js/site.js"></script>
    <script type="text/javascript">
      // Activate Carousel
      $("#hp-car").carousel();
      //Set localstorage variable
      let notice = localStorage.Notice;
           if(notice){
              $(".updating").hide();
           }else{
              $(".updating").show();
           }

    </script><noscript></noscript>
