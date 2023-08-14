<?php
function connect() {
    $server = "localhost:3306";
    $user = "root";
    $pass = "";
    $db = "Data";

    $conn = mysqli_connect($server, $user, $pass, $db);
    if (!$conn) {
        die();
    }

    return $conn;
}