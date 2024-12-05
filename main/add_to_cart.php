<?php
include 'db_connection.php';
session_start();

// 세션에서 데이터 가져오기
$user_id = $_SESSION['username']; // 사용자 ID
$product_name = $_SESSION['selectname']; // 상품명
$product_category = $_SESSION['selectdescription']; // 상품 카테고리
$product_price = $_SESSION['selectprice']; // 상품 가격

// 데이터베이스에 저장
$query = "INSERT INTO cart (user_id, product_name, product_category, product_price)
          VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("sssd", $user_id, $product_name, $product_category, $product_price);
if ($stmt->execute()) {
    header("Location: itemPayment.php");  // 로그인 성공 후 itemSearch 페이지로 리다이렉트
    exit();
} else {
    echo "로그인 실패";
}
$stmt->close();
$conn->close();
?>