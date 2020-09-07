<?php
session_start();

include "../db_connection.php";
include "../functions/input_validate.php";
include "../functions/alert.php";
$conn = connect_to_db();

if (!isset($_SESSION['admin'])) {
  // code...
  header("Location: login_admin.php");
  exit;
}

if (isset($_POST['update'])) {
  // code...
  $id = $_POST['id'];
  $categorie = validate_input($_POST['categorie']);
  
    $conn = connect_to_db();
  
    $stmt = $conn->prepare("UPDATE kategorien SET kategorie=? WHERE kat_id=?");
    $stmt->bind_param("si", $categorie, $id);
    $stmt->execute();
  //mysqli_query($conn, "UPDATE benutzer SET vorname='$prename', nachname='$surname', email='$email' WHERE benutzer_id='$id'");
  header("Location: manage_categorie.php");
 
  
}
 ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>