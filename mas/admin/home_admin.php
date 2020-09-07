<?php

session_start();
if (!isset($_SESSION['admin'])) {
  // code...
  header("Location: login_admin.php");
  exit;
}

include "../header/header.php";
include "../db_connection.php";
include '../functions/alert.php';
include "../functions/getData.php";

function countUsers()
{

  $connection = connect_to_db();
  $stmt = $connection->prepare("SELECT benutzer_id FROM benutzer");
  $stmt->execute();
  $stmt->store_result();
  $benutzer = $stmt->num_rows;

  return $benutzer;
}

function countMaterial()
{
  $connection = connect_to_db();
  $stmt = $connection->prepare("SELECT material_id FROM material");
  $stmt->execute();
  $stmt->store_result();
  $material = $stmt->num_rows;

  return $material;
}

?>


<div class="container">

  <?php include "../navs/admin_nav.php"; ?>

  <link rel="stylesheet" href="../css/admin_home.css">

  <div class="container">
    <div style="margin-top: 50px;">

      <div class="row">
        <div class="col">
          <div class="card">
            <div id="userSpecs" class="card-header">
              Hostname
            </div>
            <div class="card-body">
              <h5 class="card-title"><?php echo getHost() ?></h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div id="ip" class="card-header">
              Interne IPv4 Adresse
            </div>
            <div class="card-body">
              <h5 class="card-title">
                <?php echo getLocalIP() ?>
              </h5>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <div class="card">
            <div id="ip" class="card-header">
              Externe IPv4 Adresse
            </div>
            <div class="card-body">
              <h5 class="card-title">
                <?php echo getPuplicIP() ?>
              </h5>
            </div>
          </div>
        </div>
      </div>
      <br>
      <div class="row">
        <div class="col">
          <div class="card">
            <div id="activeUsers" class="card-header">
              Aktive Benutzer
            </div>
            <div class="card-body">
              <h5 class="card-title">
                <?php echo countUsers() ?>
              </h5>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card">
            <div id="allMaterial" class="card-header">
              Alle Materialien
            </div>
            <div class="card-body">
              <h5 class="card-title">
                <?php echo countMaterial() ?>
              </h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>

  </html>
</div>