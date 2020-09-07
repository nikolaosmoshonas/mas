<?php
session_start();
if (!isset($_SESSION['admin'])) {
  // code...
  header("Location: ../admin/login_admin.php");
  exit;
}

include '../db_connection.php';
include '../functions/alert.php';
include '../functions/input_validate.php';

$conn = connect_to_db();

$stmt = $conn->prepare("SELECT kat_id ,kategorie from kategorien");
$stmt->execute();
$reslut = $stmt->get_result();
$row = $reslut->num_rows;


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // code...
  
  $conn = connect_to_db();

  $kategorie = $_POST['kategorie'];
  $isbn = validate_input($_POST['isbn']);
  $booktitle = validate_input($_POST['buchtitel']);
  $language = validate_input($_POST['sprache']);
  $author = validate_input($_POST['author']);
  $year = validate_input($_POST['jahr']);

  if (isNumber($isbn)) {
    $stmt2 = $conn->prepare("INSERT INTO material (isbn, buchtitel, sprache, kat_id, author, jahr) VALUES (?,?,?,?,?,?)");
    $stmt2->bind_param("ssssss", $isbn, $booktitle, $language, $kategorie, $author, $year);
    $stmt2->execute();
    header("Location: manage_material.php");
  } else {
    danger_alert("ISBN überprüfen!");
  }
}

?>

<?php   include '../header/header.php'; ?>

<div class="container">

  <?php include '../navs/admin_nav.php'; ?>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div class="form-group">
      <label>ISBN</label>
      <input type="number" name="isbn" class="form-control" placeholder="ISBN 10 oder 13 Zeichen lang" required>
    </div>
    <div class="form-group">
      <label>Buchtitel</label>
      <input type="text" name="buchtitel" class="form-control" placeholder="Buchtitel" required>
    </div>
    <div class="form-group">
      <label>Sprache</label>
      <input type="text" name="sprache" class="form-control" placeholder="Sprache" required>
    </div>
    <div class="form-group">
      <label for="inputState">Kategorie</label><br>
      <select id="katID" name="kategorie" class="selectpicker" data-show-subtext="true" data-live-search="true">
        <option label=" "></option>
        <?php
        while ($row = $reslut->fetch_array()) { ?>

          <option data-subtext='<?php $row['kat_id'] ?>'><?php echo $row['kat_id'] ?></option>

        <?php }
        ?>
      </select>
    </div>
    <div class="form-group">
      <label>Author</label>
      <input type="text" name="author" class="form-control" placeholder="Author" required>
    </div>
    <div class="form-group">
      <label>Jahr</label>
      <input type="date" name="jahr" class="form-control" placeholder="Jahr" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary">Buch hinzufügen</button>

  </form>


  <link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

  </body>

  </html>