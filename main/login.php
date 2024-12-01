<?php

session_start();
// MySQL 데이터베이스 연결 정보
$servername = "localhost";
$username = "root";   
$password = "1234";   
$dbname = "user_registration";     

// POST로 전달된 데이터 가져오기
$user_input = $_POST['username'];
$user_password = $_POST['password'];

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $dbname, 3307);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL 쿼리 
$stmt = $conn->prepare("SELECT * FROM user WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $user_input, $user_password);

// 쿼리 실행
$stmt->execute();
$result = $stmt->get_result();

// 결과 확인
if ($result->num_rows > 0) {
    // 로그인 성공
    $row = $result->fetch_assoc(); // 사용자 정보 가져오기
    $_SESSION['username'] = $row['username']; // 세션에 사용자 이름 저장
    header("Location: itemSearch.php");  // 로그인 성공 후 itemSearch 페이지로 리다이렉트
    exit();
} else {
    echo "로그인 실패";
}

// 연결 종료
$stmt->close();
$conn->close();
?>