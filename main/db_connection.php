<?php
// db_connection.php
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "user_registration";


$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// 연결 오류 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>