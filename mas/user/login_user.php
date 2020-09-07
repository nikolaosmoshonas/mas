<?php


include '../db_connection.php';
include '../functions/alert.php';
include "../functions/input_validate.php";

$conn1 = connect_to_db();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $email = validate_input($_POST["email"]);
  $passwort = validate_input($_POST["passwort"]);

  $stmt = $conn1->prepare("SELECT * FROM benutzer WHERE email = '$email'");
  $stmt->execute();
  $reslut = $stmt->get_result();
  $row = $reslut->num_rows;
  if ($row == 1) {
    // code...
    $row = $reslut->fetch_array();
    if (password_verify($passwort, $row["passwort"])) {
      // code...
      session_start();
      $_SESSION["user"] = $email;
      header("Location: home_user.php");
    } else {
      danger_alert("Anmeldung fehlgeschlagen");
    }

  }else {
    danger_alert("Anmeldung fehlgeschlagen");
  }

  }


 ?>

<?php include '../header/header.php'; ?>
 <link href="../css/login_style.css" type="text/css" rel="stylesheet">


 <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!--Login Benutzer Bild-->
    <div class="fadeIn first">
      <img style="margin-top:30px" src="../img/login.png" id="icon" alt="User Icon" />
      <br>
      <br>
      <h3 id="login_title">Benutzer Login</h3>
    </div>

    <!-- Login Form -->
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
      <input type="text" name="email" id="login" class="fadeIn second"  placeholder="Email" required>
      <input type="password" name="passwort" id="passwort" class="fadeIn third"  placeholder="Passwort" required>
      <input style="margin-bottom:20px" type="submit" name="submit" class="fadeIn fourth" value="Log In">
    </form>

    <div id="formFooter">
      <a class="underlineHover" href="../homepage.php">Zurück zur Startseite</a>
    </div>

  </div>
</div>


 <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   </body>
 </html>
