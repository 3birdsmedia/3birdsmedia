<?php
include('includes/functions.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
<meta name="description" content="This is the portfolio site for Marco Segura, the man behind 3BirdsMedia" />
<meta name="author" content="Marco Segura">
<meta name="keywords" content="orange county, design, graphic, development, 3birdsmedia, 3 birds media, marco segura, HTML, CSS, PHP, JS, MySQL, branding, logo" />
<title>3BirdsMedia - Design and Development Services</title>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link href="css/print.css" rel="stylesheet" type="text/css" media="print" />
<link href='https://fonts.googleapis.com/css?family=Lato:400,700,300' rel='stylesheet' type='text/css'>
<link href="css/style.css" rel="stylesheet" type="text/css"  media="screen" />

</head>


<body>
  <div class="wrapper">
  <?php
    include('includes/header.php')
  ?>


<main>
  <section id="portfolio" class="sec-parallax">
              <h1 class="title">A few things I've worked on</h1>
  </section>
  <section class="portfolio-wrapper container loading d-flex flex-column">
  </section>

  </main>
  <?php
   include('includes/footer.php')
  ?>
  </div>
 </body>
</html>

    <script type="text/javascript">
      $(function(){
        $.getJSON("projects/projects.json", function (projects) {

          let projectsList = projects.projects;
          let projectHolder = [];
          $.each(projectsList, function(index){
            //console.log(projectsList[index].id);
            project =  '<div class="project row d-flex flex-column justify-content-center">';
            project += '<div class="thumb align-self-center"><img class="w-100 circle" src="images/portfolio/thumbs/'+projectsList[index].thumb.toLowerCase()+'" alt="'+projectsList[index].name+'"/></div>';
            project += '<h2 class="secondary-title align-self-center">'+projectsList[index].name+'</h3>';
            project += '<div class="p-body lead"></div>';
            project += '<button class="toggle fas fa-expand-alt" value="expand" data-index="'+projectsList[index].id+'"></button>';
            project += '</div>';

            projectHolder.push(project);
          });

          $('.portfolio-wrapper').removeClass('loading').append(projectHolder).hide().fadeIn(2000);

          //console.log(projectsList[0].name);
        })
        .done(function() {
            $('.toggle').click(function(){

              let dataHolder = [];
              var index = this.dataset.index;
              let dad = $(this).parent();

              if(this.value == 'expand'){
                dad.addClass('expanded');
                $(this).removeClass('fa-expand-alt').addClass('fa-compress-alt');
                $.getJSON("projects/projects.json", function (data) {
                    dataHolder = '<div class="gallery d-flex flex-row justify-content-center">';

                    if(data.projects[index].images !== '' || typeof data.projects[index].images !== 'undefined'){
                      $.each(data.projects[index].images, function(i){
                          console.log(data.projects[index].images[i]);
                          dataHolder += '<img src="images/portfolio/'+data.projects[index].path+'/'+data.projects[index].images[i]+'"/>';
                      });
                    };
                    dataHolder += '</div>';
                    dataHolder += data.projects[index].description;
                    dataHolder += '<div class="row">';
                    dataHolder += '<div class="col-4">';
                    dataHolder += '<h3>languages</h3>';
                    $.each(data.projects[index].highlights[0].languages, function(i){
                        dataHolder += '<span class="badge badge-pill badge-primary p-2 mr-2">'+data.projects[index].highlights[0].languages[i]+'</span>';
                    })
                    dataHolder += '</div>';
                    dataHolder += '<div class="col-4">';
                    dataHolder += '<h3>frameworks</h3>';
                    $.each(data.projects[index].highlights[0].frameworks, function(i){
                        dataHolder += '<span class="badge badge-pill badge-primary p-2 mr-2">'+data.projects[index].highlights[0].frameworks[i]+'</span>';
                    })
                    dataHolder += '</div>';
                    dataHolder += '<div class="col-4">';
                    dataHolder += '<h3>skills</h3>';
                    $.each(data.projects[index].highlights[0].skills, function(i){
                        dataHolder += '<span class="badge badge-pill badge-primary p-2 mr-2">'+data.projects[index].highlights[0].skills[i]+'</span>';
                    })
                    dataHolder += '</div>';

                }).done(function(){
                    dad.children('.expanded .p-body').append(dataHolder).hide().fadeIn(1000);
                })
                this.value = 'collapse';
              }else{
                dad.children('.expanded .p-body').fadeOut(500, function(){$(this).html('')});
                dad.removeClass('expanded');
                $(this).removeClass('fa-compress-alt').addClass('fa-expand-alt');
                this.value = 'expand';
              }
            });
        });


      })



    </script>
    <noscript>If you dont have javascript enabled the slideshow, sorting, pop-up, etc, won't work</noscript>

 </body>
</html>
