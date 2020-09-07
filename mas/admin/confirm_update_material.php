<?php
session_start();

include "../db_connection.php";
include "../functions/input_validate.php";
include "../functions/alert.php";

$conn = connect_to_db();

#Überprüfen ob Admin eingeloggt ist
if (!isset($_SESSION['admin'])) {
  // Auf Admin Login umleiten
  header("Location: login_admin.php");
  exit;
}

if (isset($_POST['update'])) {

$id = ($_POST['id']);
$isbn = validate_input($_POST['isbn']);
$book = validate_input($_POST['buchtitel']);
$language = validate_input($_POST['sprache']);
$categorie = validate_input($_POST['kategorie']);
$author = validate_input($_POST['author']);
$year = validate_input($_POST['jahr']);


#ISBN überprüfen
if (isNumber($isbn)) {
  #Query in die Datenbank ausführen
  
  $stmt = $conn->prepare("UPDATE material SET isbn=?, buchtitel=?, sprache=?, kat_id=?, author=?, jahr=? WHERE material_id=?");
  $stmt->bind_param("ssssssi", $isbn, $book, $language, $categorie, $author, $year, $id);
  $stmt->execute();
  
  //mysqli_query($conn, "UPDATE material SET isbn='$isbn', buchtitel='$book', sprache='$language', kategorie='$categorie', author='$author', jahr='$year' WHERE material_id='$id'");
  header("Location: manage_material.php");
}else{
  danger_alert("ISBN überprüfen");
}

 
}
 ?>

<?php include "../header/header.php" ?>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>