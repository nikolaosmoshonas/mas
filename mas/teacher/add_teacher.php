<?php
session_start();

if (!(isset($_SESSION['admin']) || (isset($_SESSION['user'])))) {
  // code...
  header("Location: ../homepage.php");
  exit;
}

include '../functions/alert.php';
include "../functions/input_validate.php";
include "../db_connection.php";

$conn1 = connect_to_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  $check_mail = $_POST['email'];

  if (isMail($check_mail)) {

    $stmt = $conn1->prepare("SELECT * FROM lehrer WHERE email = ?");
    $stmt->bind_param("s", $check_mail);
    $stmt->execute();
    $stmt->store_result();
    $count = $stmt->num_rows;

    if ($count == 0) {
            // code...
        $prename = validate_input($_POST['prename']);
        $surname = validate_input($_POST['surname']);
        $email = validate_input($_POST['email']);
        $telephone = validate_input($_POST['telephone']);

        $stmt2 = $conn1->prepare("INSERT INTO lehrer (vorname, nachname, email, telephon) VALUES (?,?,?,?)");
        $stmt2->bind_param("ssss", $prename, $surname, $email, $telephone);
        $stmt2->execute();
        header('Location: manage_teacher.php');
        
    }else{
      danger_alert("Email existiert bereits");
    }
    disconnect_from_db($conn1);
  }else {
    danger_alert("Email ist nicht korrekt!");
  }


}
?>


<?php include "../header/header.php"; ?>
<div class="container">
  <?php
  if (isset($_SESSION['admin'])) {
    // code...
    include "../navs/admin_nav.php";
  }else {
    include "../navs/user_nav.php";
  }

   ?>

  <br>
  <br>

  <h1 style="opacity:0.5;">Lehrer hinzufügen</h1>
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
      <label>Telephon</label>
      <input title="Telefonnummer" type="tel" name="telephone" pattern="0(2[1-246-7]|3[1-4]|4[13-4]|5[25-6]|6[1-2]|7[15-68-9]|8[17]|91)[0-9]{7}" class="form-control" placeholder="Telephonnummer" required>
    </div>
      <button type="submit" name="create" class="btn btn-primary">Lehrer hinzufügen</button>

  </form>

</div>



<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
