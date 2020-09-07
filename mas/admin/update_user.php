<?php

include "../db_connection.php";

$conn = connect_to_db();

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $update = true;
  $stmt = $conn->prepare("SELECT * FROM benutzer WHERE benutzer_id=?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $result = $stmt->get_result();

  //$stmt = mysqli_query($conn, "SELECT * FROM benutzer WHERE benutzer_id=$id");

  if ($result->num_rows == 1 ) {
    $sqlstmt = $result->fetch_array();
    $prename = $sqlstmt['vorname'];
    $surname = $sqlstmt['nachname'];
    $email = $sqlstmt['email'];
  }


}
?>

<?php include "../header/header.php"; ?>

<div style="margin-top: 30px" class="container">



<form class="" action="confirm_update_user.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
  <div class="form-group">
    <label>Prename</label>
    <input type="text" name="prename" value="<?php echo $prename; ?>"  class="form-control" placeholder="Vorname" required>
  </div>
  <div class="form-group">
    <label>Nachname</label>
    <input type="text" name="surname" value="<?php echo $surname; ?>"  class="form-control" placeholder="Nachname" required>
  </div>
  <div class="form-group">
    <label>Email</label>
    <input type="text" name="email" value="<?php echo $email; ?>"  class="form-control" placeholder="Email" required>
  </div>

  <button type="submit" name="update" class="btn btn-primary">Ändern</button>

</form>
</div>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
