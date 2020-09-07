<?php

//Funktion Meldung Risiko
function danger_alert($msg) {
    echo "<div class='container'>";
    echo "<div class='alert alert-danger' role='alert'>";
    echo $msg;
    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
}

//Funktion Meldung Erfolg
function success_alert($msg) {
    echo "<div class='container'>";
    echo "<div class='alert alert-success' role='alert'>";
    echo $msg;
    echo "<button type='button' class='close' data-dismiss='alert' aria-label='Close'>";
    echo "<span aria-hidden='true'>&times;</span>";
    echo "</button>";
    echo "</div>";
    echo "</div>";
}
 ?>