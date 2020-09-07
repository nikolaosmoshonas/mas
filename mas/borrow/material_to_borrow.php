<?php
session_start();
if (!(isset($_SESSION['admin']) || (isset($_SESSION['user'])))) {
  // code...
  header("Location: ../homepage.php");
  exit;
}
include '../db_connection.php';


$conn = connect_to_db();

$stmt = $conn->prepare("SELECT * FROM material m, kategorien k WHERE m.kat_id = k.kat_id");
$stmt->execute();
$result = $stmt->get_result();

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
<br>
<br>


    <table  class="table table-borderless table-responsive-md">
        <thead>
            <tr>
                <th>Material_ID</th>
                <th>ISBN</th>
                <th>Buchtitel</th>
                <th>Sprache</th>
                <th>Kategorie</th>
                <th>Author</th>
                <th>Jahr</th>

            </tr>
        </thead>
        <?php

        while ($row = $result->fetch_array()) {
        ?>
            <tbody>
                <tr>
                    <td><?php echo $row['material_id']; ?></td>
                    <td><?php echo $row['isbn']; ?></td>
                    <td><?php echo $row['buchtitel']; ?></td>
                    <td><?php echo $row['sprache']; ?></td>
                    <td><?php echo $row['kategorie']; ?></td>
                    <td><?php echo $row['author']; ?></td>
                    <td><?php echo $row['jahr']; ?></td>


                    <td>
                        <a href="borrow_material.php?value=<?php echo $row['material_id']; ?>" class="edit_btn warning"><button class="btn btn-warning">Ausleihen</button></a>
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