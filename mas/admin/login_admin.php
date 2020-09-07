<?php
session_start();
//include '../header/header.php';
include '../db_connection.php';
include '../functions/alert.php';
include "../functions/input_validate.php";

//Variable für die Datenbankverbindung
$dbconn = connect_to_db();

//Form überprüfen wenn auf Button geklickt wird
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
  $username = validate_input($_POST["username"]);
  $password = validate_input($_POST["password"]);

// Abfrage
  $stmt = $dbconn->prepare("SELECT * FROM admin WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $reslut = $stmt->get_result();
  $row = $reslut->num_rows;

  //Benutzername und Passwort überprüfen
  if ($row == 1) {
    
    $row = $reslut->fetch_array();
    if (password_verify($password, $row["password"])) {
      
    //Session Admin starten
      
      $_SESSION["admin"] = $username;
      header("Location: home_admin.php");
      /*$link_address1 = 'home_admin.php';
      echo "<a href='".$link_address1."'>Index Page</a>";     */
      
    } else {
      danger_alert("Login fehlgeschlagen");
    }

  }else {
    danger_alert("Login fehlgeschlagen");
  }

  }


 ?>
 <?php include "../header/header.php"; ?>

 <link href="../css/login_style.css" type="text/css" rel="stylesheet">


 <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!--Admin Login Bild-->
    <div class="fadeIn first">
      <img style="margin-top:30px" src="../img/login.png" id="icon" alt="User Icon" />
      <br>
      <br>
      <h3 id="login_title">Admin Login</h3>
    </div>

    <!--Login Form Admin-->
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
      <input type="text" name="username" id="login" class="fadeIn second"  placeholder="username" required>
      <input type="password" name="password" id="password" class="fadeIn third"  placeholder="password" required>
      <input style="margin-bottom:20px" type="submit" name="submit" class="fadeIn fourth" value="Log In">
    </form>

    <!-- Zur Haupseite -->
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
