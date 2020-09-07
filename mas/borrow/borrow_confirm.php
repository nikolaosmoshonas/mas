<?php 

include "../db_connection.php";



if (isset($_POST['book'])) {
    # code...
    $conn = connect_to_db();
    $material_id = $_POST['id'];
    $teacher_id = $_POST['lehrer'];
    $borrowed_on = $_POST['ausleihe_datum'];
    

    $stmt2 = $conn->prepare("INSERT INTO ausleihe (lehrer_id, material_id, geliehen_am) VALUES (?, ?, ?)");
    $stmt2->bind_param("sss",$teacher_id, $material_id, $borrowed_on);
    $stmt2->execute();
    
    header("Location: material_to_borrow.php");
}

?>