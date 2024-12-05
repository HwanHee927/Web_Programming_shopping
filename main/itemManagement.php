<?php
include 'db_connection.php';
session_start();

// 로그인 상태 확인
if (!isset($_SESSION['username'])) {
    echo "로그인 상태가 아닙니다.";
    exit;
}

$user_id = $_SESSION['username']; // 세션에서 사용자 ID 가져오기

// 버튼 클릭 시 실행되는 코드
if (isset($_POST['dataReset'])) {
    // 사용자의 장바구니 레코드 삭제
    $delete_query = "DELETE FROM cart WHERE user_id = '$user_id'";
    if ($conn->query($delete_query) === TRUE) {
        // 삭제 성공 후 itemManagement.php로 리다이렉트
        header("Location: itemSearch.php");
        exit;
    } else {
        echo "장바구니 삭제 오류: " . $conn->error;
    }
}
?>
