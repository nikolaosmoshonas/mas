<?php 

session_start();
if (!isset($_SESSION['user'])) {
  // code...
  header("Location: login_user.php");
  exit;
}


include "../db_connection.php";
include '../functions/alert.php';
include "../functions/getData.php";

$conn = connect_to_db();

$stmt = $conn->prepare("SELECT * FROM benutzer WHERE email = ?");
$stmt->bind_param("s", $_SESSION['user']);
$stmt->execute();
$result = $stmt->get_result();

$row = $result->fetch_array();

?>



<?php include "../header/header.php"; ?>
<div class="container">
<?php include "../navs/user_nav.php"; ?>

<link rel="stylesheet" href="../css/user_home.css">

<br>
<br>

<h3>Du bist Eingelogged als: <?php echo $row['vorname'] ?> <?php echo $row['nachname'] ?></h3>


<div id="card" class="card" style="width: 30rem;">
  <div class="card-header">
    Informationen
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">Vorname: <br> <?php echo $row['vorname'] ?></li>
    <li class="list-group-item"><p>Nachname: <br> <?php echo $row['nachname'] ?></p></li>
    <li class="list-group-item"><p>Email: <br> <?php echo $row['email'] ?></p></li>
  </ul>
</div>

</div>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
  </html>
</div>
