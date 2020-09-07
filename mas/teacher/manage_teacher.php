<?php
session_start();
include '../db_connection.php';
include '../functions/alert.php';



if (!(isset($_SESSION['admin']) || (isset($_SESSION['user'])))) {
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

$stmt = $conn->prepare("SELECT * FROM lehrer");
$stmt->execute();
$res_data = $stmt->get_result();
$counter = 1;


 ?>

<?php include '../header/header.php'; ?>

<div class="container">

<?php
if (isset($_SESSION['admin'])) {
  // code...
  include '../navs/admin_nav.php';
}else {
  include "../navs/user_nav.php";
}
?>

<br><br>

<a href="add_teacher.php"><button type="button" name="addTeacher" class="btn btn-success">Neuen Lehrer hinzufügen</button></a>

<br>
<br>
<table class="table table-borderless table-responsive-md">
  <thead>
    <tr>
      <th>ID</th>
      <th>Vorname</th>
      <th>Nachname</th>
      <th>Email</th>
      <th>Telephon</th>
      <th>Erstellt am</th>
      <th>Bearbeiten</th>
      <?php if (isset($_SESSION['admin'])) {?>
        <th>Löschen</th>
    <?php } ?>
    </tr>
  </thead>
  <?php

  while ($row = $res_data->fetch_array()) {
    ?>
    <tbody>
      <tr>
        <td><?php echo $counter++; ?></td>
        <td><?php echo $row['vorname']; ?></td>
        <td><?php echo $row['nachname']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['telephon']; ?></td>
        <td><?php echo $row['erstellt']; ?></td>
        <td>
          <a href="update_teacher.php?edit=<?php echo $row['lehrer_id']; ?>" class="edit_btn warning"><button class="btn btn-warning">Bearbeiten</button></a>
        </td>
        <td>
          <?php if (isset($_SESSION['admin'])) {?>
          <form action="delete_teacher.php" method="post">
            <input type="hidden" value="<?php echo $row['lehrer_id']; ?>" name="btn_delete">
                <button name="submit" class="btn btn-danger">Löschen</button>
            <?php } ?>

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
