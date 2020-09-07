<?php

//Funktion Datenbankverbindung

function connect_to_db()
 {
  include 'config.php';
  $servername = $config['DB_SERVERNAME'];
  $username = $config['DB_USER'];
  $password = $config['DB_PASS'];
  $db = $config['DB_DATABASE'];
  $conn = new mysqli($servername, $username, $password,$db);



if (!$conn) {
  // Verbindung überprüfen
  die("Conn Fail" . mysqli_connect_error());
}else {
  // Verbinden
   return $conn;
}


 }

//Funktion Datenbankverbindung aufheben
function disconnect_from_db($conn)
 {
 $conn -> close();
 
 }
