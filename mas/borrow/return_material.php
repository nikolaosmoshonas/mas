<?php 

include "../db_connection.php";

if (isset($_GET['value'])) {
    $id = $_GET['value'];

    $conn = connect_to_db();
    $date = date("Y-m-d");
    
    $stmt = $conn->prepare("UPDATE ausleihe SET zurueckgebracht_am = ? WHERE ausleihe_id = ?");
    $stmt->bind_param("si", $date, $id);
    $stmt->execute();
    
   header("Location: active_borrowed_material.php");

}

?>