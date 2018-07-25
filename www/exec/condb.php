<?php
$servername = "localhost";
$username = "root";
$password = "toontoon";
$dbname = "kpi_cockpit";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$cs1 = "SET character_set_results=utf8";
$result = $conn->query($cs1);

$cs2 = "SET character_set_client = utf8";
$result = $conn->query($cs2);

$cs3 = "SET character_set_connection = utf8";
$result = $conn->query($cs3);
?>
