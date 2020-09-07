<?php
session_start();
include '../db_connection.php';
include '../functions/alert.php';
include '../header/header.php';


if (!isset($_SESSION['admin'])) {
  // code...
  header("Location: ../homepage.php");
  exit;
}

$conn = connect_to_db();
// Check connection
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  die();
}

$stmt = $conn->prepare("SELECT * from kategorien");
$stmt->execute();
$res_data = $stmt->get_result();
$counter = 1;


 ?>

<div class="container">

<?php
if (isset($_SESSION['admin'])) {
  // code...
  include '../navs/admin_nav.php';
}
?>

<br><br>

<a href="add_categorie.php"><button type="button" name="addCategorie" class="btn btn-success">Neuen Kategorie hinzufügen</button></a>

<br>
<br>
<table class="table table-borderless table-responsive-md">
  <thead>
    <tr>
      <th>ID</th>
      <th>Kategorie</th>
      <th>Bearbeiten</th>
      <th>Löschen</th>
    </tr>
  </thead>
  <?php

  while ($row = $res_data->fetch_array()) {
    ?>
    <tbody>
      <tr>
        <td><?php echo $counter++; ?></td>
        <td><?php echo $row['kategorie']; ?></td>
        <td>
                <a href="update_categorie.php?edit=<?php echo $row['kat_id']; ?>" class="edit_btn warning"><button class="btn btn-warning">Bearbeiten</button></a>
              </td>
        <td>
          <form action="delete_categorie.php" method="post">
            <input type="hidden" value="<?php echo $row['kat_id']; ?>" name="btn_delete">
                <button name="submit" class="btn btn-danger">Löschen</button>
          </form>
        </td>
      </tr>

    </tbody>
  <?php } ?>
</table>

</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
