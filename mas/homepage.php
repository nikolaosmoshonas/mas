<?php
//Header Import
include "header/header.php";

?>
<!--CSS Import-->
<link href="css/homepage_css.css" type="text/css" rel="stylesheet">

<?php 
//Nvigation Import
include "navs/home_nav.php" 
?>

<body>


<!--Titel für die Startseite-->

  <div id="home" class="container text-center">
    <div class="cover-container d-flex w-100 h-100 p-3 mx-auto flex-column">
      <main role="main" class="inner cover">
        <h1 class="cover-heading">Material Ausliehe System - Flying Teachers</h1>
        <p class="lead">Willkommen beim Ausleihe System von den Flying Teachers</p>
        <br>
        <p class="lead">
          <a href="http://flyingteachers.ch" class="btn btn-lg">Zur Flying Teachers Webseite</a>
        </p>
      </main>
    </div>

<!-- Karussell (Bild-Diashow)-->
    <div id="carouselID" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#carouselID" data-slide-to="0" class="active"></li>
        <li data-target="#carouselID" data-slide-to="1"></li>
        <li data-target="#carouselID" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img class="d-block w-100" src="" alt="First slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="" alt="Second slide">
        </div>
        <div class="carousel-item">
          <img class="d-block w-100" src="" alt="Third slide">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselID" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Vorherige</span>
      </a>
      <a class="carousel-control-next" href="#carouselID" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Nächste</span>
      </a>
    </div>

  </div>
</body>

<!--Seitenfuss-->
<footer class="footer">
  <div class="container">
    <span class="text-muted">Flying Teachers GmbH - 2020</span>
  </div>
</footer>

<!--Script-->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>