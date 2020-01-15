//custom funtions for the site
  // Initiating jQuery in according to best practices
  (function($, window, document) {
   $(function() {
      //Temporary message while I work on my site
      $('.dismiss').click(function(){
          localStorage.setItem("Notice", "dismissed");
          $(".updating").hide();
        }
      );

      //Add active stay via js
      $('li.active').removeClass('active');
      $('a[href="' + location.pathname + '"]').closest('li').addClass('active');

   });
  }(window.jQuery, window, document));
