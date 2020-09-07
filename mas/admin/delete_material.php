<?php 

include "../db_connection.php";

if (isset($_POST['submit'])) {
    
    $conn = connect_to_db();
    $id = $_POST['btn_delete'];
    $stmt = $conn->prepare("DELETE FROM material WHERE material_id = '$id'");
    $stmt->execute();
    header("Location: manage_material.php");
}

?>