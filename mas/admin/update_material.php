<?php

include "../db_connection.php";

$conn = connect_to_db();

if (isset($_GET['edit'])) {
  $id = $_GET['edit'];
  $update = true;
  $stmt = $conn->prepare("SELECT * FROM material WHERE material_id=$id");
  $stmt->execute();
  $result = $stmt->get_result();
  //$stmt = mysqli_query($conn, "SELECT * FROM material WHERE material_id=$id");

  if ($result->num_rows == 1 ) {
    $sqlstmt = $result->fetch_array();
    $isbn = $sqlstmt['isbn'];
    $buchtitel = $sqlstmt['buchtitel'];
    $sprache = $sqlstmt['sprache'];
    $author = $sqlstmt['author'];
    $jahr = $sqlstmt['jahr'];
  }


}

$conn1 = connect_to_db();
$stmt1 = $conn1->prepare("SELECT kat_id ,kategorie from kategorien");
$stmt1 -> execute();
$reslut = $stmt1->get_result();
$row = $reslut->num_rows;


?>

<?php include "../header/header.php"; ?>

<div style="margin-top: 30px" class="container">



<form  action="confirm_update_material.php" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>">
  <div class="form-group">
    <label>ISBN</label>
    <input type="text" name="isbn" value="<?php echo $isbn; ?>"  class="form-control" placeholder="ISBN 10 oder 13 zeichen" required>
  </div>
  <div class="form-group">
    <label>Buchtitel</label>
    <input type="text" name="buchtitel" value="<?php echo $buchtitel; ?>"  class="form-control" placeholder="Buchtitel" required>
  </div>
  <div class="form-group">
    <label>Sprache</label>
    <input type="text" name="sprache" value="<?php echo $sprache; ?>"  class="form-control" placeholder="Sprache" required>
  </div>
  <div class="form-group">
  <label for="inputState">Kategorie</label><br>
  <select id="katID" name="kategorie" class="selectpicker" data-show-subtext="true" data-live-search="true">
  <option label=" "></option>
    <?php
     while ($cat = $reslut->fetch_array()) {?>

         <option data-subtext='<?php $cat['kat_id'] ?>'><?php echo $cat['kat_id']?> | <?php echo $cat['kategorie'] ?></option>

   <?php }
     ?>
  </select>
</div>
  <div class="form-group">
    <label>Author</label>
    <input type="text" name="author" value="<?php echo $author; ?>"  class="form-control" placeholder="Author" required>
  </div>
  <div class="form-group">
    <label>Jahr</label>
    <input type="date" name="jahr" value="<?php echo $jahr; ?>"  class="form-control" placeholder="Jahr" required>
  </div>
  <button type="submit" name="update" class="btn btn-primary">Ändern</button>

</form>
</div>

<link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

</body>
</html>