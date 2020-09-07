<?php
session_start();
if (!isset($_SESSION['admin'])) {
  // code...
  header("Location: ../admin/login_admin.php");
  exit;
}

include "../db_connection.php";
include '../functions/alert.php';
$conn = connect_to_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $check_mail = $_POST['email'];
  if (filter_var($check_mail, FILTER_VALIDATE_EMAIL)) {



    $stmt = $conn->prepare("SELECT * FROM benutzer WHERE email = ?");
    $stmt->bind_param("s", $_POST['email']);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;

    if ($count == 0) {

      if ($_POST['password'] == $_POST['password2']) {
        // Datenbankverbindung erstellen
        $conn = connect_to_db();

        //
        $stmt2 = $conn->prepare("INSERT INTO benutzer (vorname, nachname, email, passwort) VALUES (?,?,?,?)");
        $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $stmt2->bind_param("ssss", $_POST['prename'], $_POST['surname'], $_POST['email'], $hash);
        $stmt2->execute();
        header("Location: manage_user.php");
        success_alert("Benutzer erfolgreich hinzugefügt");
      }else {
        danger_alert("Bitte wiederholen Sie das Passwort");
      }
    }else{
      danger_alert("Email existiert bereits");
    }
    disconnect_from_db($conn);
  }else {
    danger_alert("Email ist nicht korrekt!");
  }

}
?>
<?php include "../header/header.php" ?>
<div class="container">
  <?php include "../navs/admin_nav.php"; ?>


  <br>
  <br>

  <h1 style="opacity:0.5;">Add New User</h1>
  <br>

  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autocomplete="on">
    <div class="form-group">
      <label>Vorname</label>
      <input type="text" name="prename" class="form-control" placeholder="Vorname" required>
    </div>
    <div class="form-group">
      <label>Nachname</label>
      <input type="text" name="surname" class="form-control" placeholder="Nachname" required>
    </div>
    <div class="form-group">
      <label>Email</label>
      <input type="text" name="email" class="form-control" placeholder="Email" autocomplete="off" required>
    </div>
    <div class="form-group">
      <label>Passwort</label>
      <input type="password" name="password" class="form-control" placeholder="Passwort" onPaste="return false" required>
    </div>
    <div class="form-group">
      <label>Passwort</label>
      <input type="password" name="password2" class="form-control" placeholder="Passwort wiederholen" onPaste="return false" required>
    </div>

    <button type="submit" name="create" class="btn btn-primary">Benutzer hinzufügen</button>

  </form>

</div>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
