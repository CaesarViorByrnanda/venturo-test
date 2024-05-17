<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
$servername = "localhost";
$username = "root";
$password = "";
$database = "sm_sija";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function query1($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error dalam menjalankan query: " . mysqli_error($conn));
    }

    $rows = [];
    while ($data = mysqli_fetch_assoc($result)) {
        $rows[] = $data;
    }

    return $rows;
}
//echo "Connected successfully";
//mysqli_close($conn);
