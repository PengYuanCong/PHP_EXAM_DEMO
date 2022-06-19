<?php

$servername = "localhost";
$username = "id19070483_fooduser";
$password = "123456Aabbcc~";
$database = "id19070483_foodmap";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>