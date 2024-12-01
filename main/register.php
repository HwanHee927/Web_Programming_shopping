<?php
// 데이터베이스 연결 설정
$servername = "localhost";
$username = "root";  
$password = "1234";      
$dbname = "user_registration";

// 데이터베이스 연결 생성
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 폼 데이터 받기
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];

    // 데이터 삽입 쿼리
    $sql = "INSERT INTO user (username, password, name, phone) VALUES ('$username', '$password', '$name', '$phone')";

    if ($conn->query($sql) === TRUE) {
        header("Location: login_success.html");
        exit();
    } else {
        echo "오류: " . $sql . "<br>" . $conn->error;
    }
}

// 연결 종료
$conn->close();
?>
