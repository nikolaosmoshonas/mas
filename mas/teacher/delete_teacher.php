<?php

include "../db_connection.php";

if (isset($_POST['submit'])) {
  // code...
 $conn1 = connect_to_db();
 $id = $_POST['btn_delete'];
 $stmt = $conn1->prepare("DELETE FROM lehrer WHERE lehrer_id = ?");
 $stmt->bind_param("i", $id);
 $stmt->execute();
 header("Location: manage_teacher.php");

}

 ?>
