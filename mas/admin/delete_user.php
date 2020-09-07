<?php 

include "../db_connection.php";

if (isset($_POST['submit'])) {
    
    $conn = connect_to_db();
    $id = $_POST['btn_delete'];
    $stmt = $conn->prepare("DELETE FROM benutzer WHERE benutzer_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: manage_user.php");
}

?>
