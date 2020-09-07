<?php

include "../db_connection.php";
include "../header/header.php";
$conn = connect_to_db();

if (isset($_GET['value'])) {
    $id = $_GET['value'];
    $update = true;
    $stmt = $conn->prepare("SELECT * FROM material m, kategorien k WHERE material_id=$id AND m.kat_id = k.kat_id");
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $sqlstmt = $result->fetch_array();
        $isbn = $sqlstmt['isbn'];
        $buchtitel = $sqlstmt['buchtitel'];
        $sprache = $sqlstmt['sprache'];
        $kategorie = $sqlstmt['kategorie'];
        $jahr = $sqlstmt['jahr'];
    }
}

$conn1 = connect_to_db();

$stmt = $conn1->prepare("SELECT lehrer_id ,vorname, nachname from lehrer");
$stmt->execute();
$reslut = $stmt->get_result();
$row = $reslut->num_rows;
?>

<div style="margin-top: 30px" class="container">



    <form  action="borrow_confirm.php" method="post">
        <h4>Buch:</h4>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <div class="form-group">
            <label>ISBN</label>
            <input class="form-control" name="isbn" type="text" value="<?php echo $isbn; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Buchtitel</label>
            <input class="form-control" name="buchtitel" type="text" value="<?php echo $buchtitel; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Sprache</label>
            <input class="form-control" name="sprache" type="text" value="<?php echo $sprache; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Kategorie</label>
            <input class="form-control" name="kategorie" type="text" value="<?php echo $kategorie; ?>" readonly>
        </div>
        <div class="form-group">
            <label>Jahr</label>
            <input class="form-control" name="jahr" type="text" value="<?php echo $jahr; ?>" readonly>
        </div>

        <hr>
        <h4>Für die Lehrpersohn:</h4>
        <div class="form-group">
            <label for="inputState">Lehrpersohn</label><br>
            <select id="katID" name="lehrer" class="selectpicker" data-show-subtext="true" data-live-search="true" required>
                <option label=" "></option>
                <?php
                while ($row = $reslut->fetch_array()) { ?>

                    <option value='<?php echo $row['lehrer_id'] ?>'><?php echo $row['vorname'] ?></option>
                    
                <?php }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Datum der Ausleihe</label>
            <input class="form-control" name="ausleihe_datum" type="date" required>
        </div>
        <button type="submit" name="book" class="btn btn-primary">Ausleihe buchen</button>

    </form>
</div>

<link href="https://netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>

</body>

</html>