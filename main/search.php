<?php

session_start();
// MySQL 데이터베이스 연결 정보
$servername = "localhost";
$username = "root";
$password = "1234";
$dbname = "user_registration";

// 검색어 가져오기
$query = isset($_GET['query']) ? $_GET['query'] : '';

// MySQL 연결
$conn = new mysqli($servername, $username, $password, $dbname, 3306);

// 연결 확인
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 검색어에 기반한 SQL 쿼리
$sql = "SELECT * FROM products WHERE description LIKE ? OR description LIKE ?";
$stmt = $conn->prepare($sql);
$search = '%' . $query . '%';
$stmt->bind_param("ss", $search, $search);

// 쿼리 실행
$stmt->execute();
$result = $stmt->get_result();

// description 필드의 모든 고유 값 가져오기
$description_query = "SELECT DISTINCT description FROM products";
$description_result = $conn->query($description_query);


// description 값들을 배열로 저장
$valid_descriptions = [];
if ($description_result->num_rows > 0) {
    while ($desc_row = $description_result->fetch_assoc()) {
        $valid_descriptions[] = $desc_row['description'];
    }
}

// 검색 결과 출력
if (!isset($query) || $query === '') {
    // 버튼이 비어 있으면 실패 페이지로 리다이렉트
    header("Location: itemSearchFail.html");
    exit();
} elseif ($result->num_rows > 0) {
    // 검색 결과가 있을 때
    $row = $result->fetch_assoc();
    $_SESSION['productname'] = $row['name'];
    $_SESSION['productprice'] = $row['price'];
    $_SESSION['productdescription'] = $row['description'];

    if (in_array($row['description'], $valid_descriptions)) {
        header("Location: itemSearch2.php");
        exit();
    } else {
        echo "<h1>검색 결과가 존재하지 않습니다.</h1><ul>";
    }
} else {
    // 검색 결과가 없을 경우
    echo "<h1>검색 결과가 존재하지 않습니다.</h1><ul>";
    header("Location: itemSearchFail.html");
    exit();
}

// 연결 종료
$stmt->close();
$conn->close();
?>