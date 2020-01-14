//custom funtions for the site
$('.dismiss').click(function(){
    localStorage.setItem("Notice", "dismissed");
    $(".updating").hide();
  }
);
$(document).ready(function() {
  $('li.active').removeClass('active');
  $('a[href="' + location.pathname + '"]').closest('li').addClass('active');
});

$(".cd-gallery ul li").click(function(){
  //console.log($(this).data("load"));
  var project = $(this).data("load");
  $('#project-desc').bPopup({
    speed: 1000,
    transition: 'slideIn',
    transitionClose: 'slideBack',
    contentContainer:'.content',
    loadUrl: 'projects/'+project+'.html' //Uses jQuery.load()
  },
  function() {
      var bPopup = $('#project-desc').bPopup();   setTimeout(function(){
        bPopup.reposition(1000);
      }, 500);
  });
});
