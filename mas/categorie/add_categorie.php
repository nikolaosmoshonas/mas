<?php
session_start();
if (!isset($_SESSION['admin'])) {
  // code...
  header("Location: ../homepage.php");
  exit;
}

include "../db_connection.php";
include '../functions/alert.php';
include "../functions/input_validate.php";

$conn = connect_to_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $categorie = validate_input($_POST['categorie']);

        $stmt = $conn->prepare("INSERT INTO kategorien (kategorie) VALUES (?)");
        $stmt->bind_param("s", $categorie);
        $stmt->execute();

        header("Location: manage_categorie.php");

}
?>

<?php include "../header/header.php"; ?>

<div class="container">
  <?php
  if (isset($_SESSION['admin'])) {
    // code...
    include "../navs/admin_nav.php";
  }

   ?>

  <br>
  <br>

  <h1 style="opacity:0.5;">Kategorie hinzufügen</h1>
  <br>

  <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="on">
    <div class="form-group">
      <label>Kategorie</label>
      <input type="text" name="categorie" class="form-control" placeholder="Kategorie" required>
    </div>

      <button type="submit" name="create" class="btn btn-primary">Kategorie hinzufügen</button>

  </form>

</div>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
