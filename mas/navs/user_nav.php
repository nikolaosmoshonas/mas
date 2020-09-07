<link href="navstyle.css" type="text/css" rel="stylesheet">

<nav id="nav" class="navbar navbar-expand-lg navbar-dark bg-dark">
  <b class="navbar-brand" href="#">Admin Section</b>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav mr-auto">
      <a class="nav-item nav-link active" href="">Home<span class="sr-only">(current)</span></a>
      <a class="nav-item nav-link" href="../teacher/manage_teacher.php">Lehrer</a>
      <a class="nav-item nav-link" href="../borrow/material_to_borrow.php">Material Ausleihen</a>
      <a class="nav-item nav-link" href="../borrow/active_borrowed_material.php">Aktive Ausleihen</a>
    </div>
  </div>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav ml-auto">
      <a class="nav-item nav-link" href="../log_out.php">Log out</a>
      <a class="nav-item nav-link disabled" id="time">Disabled</a>
    </div>
  </div>
</nav>

<script>
var myVar = setInterval(myTimer ,1000);
function myTimer() {
  var d = new Date();
  document.getElementById("time").innerHTML = d.toLocaleTimeString();
}
</script>