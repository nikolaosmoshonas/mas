<?php
session_start();

include "../db_connection.php";

if (!isset($_SESSION['admin'])) {
  // code...
  header("Location: login_admin.php");
  exit;
}

if (isset($_GET['pageno'])) {
  $pageno = $_GET['pageno'];
} else {
  $pageno = 1;
}
$no_of_records_per_page = 5;
$offset = ($pageno-1) * $no_of_records_per_page;

$conn = connect_to_db();
// Check connection
if (mysqli_connect_errno()){
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  die();
}

$total_pages_sql = "SELECT COUNT(*) FROM material";
$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);

$sql = "SELECT * FROM material m, kategorien k WHERE m.kat_id = k.kat_id LIMIT $offset, $no_of_records_per_page";
$res_data = mysqli_query($conn,$sql);
$counter = 1;


?>
<?php include "../header/header.php"; ?>

<div class="container">

      <?php include "../navs/admin_nav.php"; ?>
      <br>
      <br>
      <a href="add_new_material.php"><button type="button" name="addUser" class="btn btn-success">Material hinzufügen</button></a>
      <br>
      <br>
    <input class="form-control" id="myInput" type="text" placeholder="Search..">
    <br>
    <div class="table-responsive-md">
      <table class="table-sm">
        <thead>
          <tr>
            <th>ID</th>
            <th>ISBN</th>
            <th>Buchtitel</th>
            <th>Sprache</th>
            <th>Kategorie</th>
            <th>Author</th>
            <th>Jahr</th>
            <th>Erstellt am</th>
            <th>Bearbeiten</th>
            <th>Löschen</th>
          </tr>
        </thead>
        <?php

        while ($row = mysqli_fetch_assoc($res_data)) {
          ?>
          <tbody>
            <tr>
              <td><?php echo $counter++; ?></td>
              <td><?php echo $row['isbn']; ?></td>
              <td><?php echo $row['buchtitel']; ?></td>
              <td><?php echo $row['sprache']; ?></td>
              <td><?php echo $row['kategorie']; ?></td>
              <td><?php echo $row['author']; ?></td>
              <td><?php echo $row['jahr']; ?></td>
              <td><?php echo $row['erstellt']; ?></td>
              <td>
                <a href="update_material.php?edit=<?php echo $row['material_id']; ?>" class="edit_btn warning"><button class="btn btn-warning">Bearbeiten</button></a>
              </td>
              <td>
                <form action="delete_material.php" method="post">
                  <input type="hidden" value="<?php echo $row['material_id']; ?>" name="btn_delete">
                  <button name="submit" class="btn btn-danger">Löschen</button>
                </form>
              </td>
            </tr>

          </tbody>
        <?php } ?>
      </table>
    </div>
    <hr>
      <ul class="pagination">
        <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
        <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
          <a class="page-link"href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a>
        </li>

        <?php

        //$pagLink = "";
        for ($i=1; $i<=$total_pages; $i++) {
          /* if ($i==$pageno) {
          $pagLink .= "<li class='page-item active'><a class='page-link' href='?pageno="
          .$i."'>".$i."</a></li>";
        }
        else  {
        $pagLink .= "<li class='page-item'><a class='page-link' href='?pageno=".$i."'>
        ".$i."</a></li>";
      }*/
      $active = "<li class='page-item active'><a class='page-link' href='?pageno=".$i."'>".$i."</a></li>";
      $notactive = "<li class='page-item'><a class='page-link' href='?pageno=".$i."'>".$i."</a></li>";
      echo $i==$pageno ? $active : $notactive;
    }
    //echo $pagLink;


    ?>

    <li class="page-item <?php echo $pageno >= $total_pages ? 'disabled' : null ?>">
      <a class="page-link" href="<?php echo $pageno >= $total_pages ? '#' : '?pageno='.($pageno + 1)?>">Next</a>
    </li>
    <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
    </ul>

  </div>






<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
