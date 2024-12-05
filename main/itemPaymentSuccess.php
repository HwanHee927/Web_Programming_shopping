<?php
include 'db_connection.php';
session_start();

$user_id = $_SESSION['username'];

if (!$user_id) {
    echo "로그인 상태가 아닙니다.";
    exit;
}

// 기본 쿼리 설정
$query = "SELECT * FROM cart WHERE user_id = '$user_id'";
$result = $conn->query($query);

if (!$result) {
    echo "쿼리 실행 오류: " . mysqli_error($conn); // 오류 메시지 출력
    exit;  // 오류 발생 시 종료
}

// 배송비 설정
$shipping_fee = 2500; // 배송비 고정 2500원

$total_price = 0;
while ($row = $result->fetch_assoc()) {
    $total_price += $row['product_price']; // 각 상품의 가격 합산
}

// 상품 삭제 처리 (선택한 상품을 삭제할 경우)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dataReset'])) {
    // 장바구니 삭제 처리
    $delete_query = "DELETE FROM cart WHERE user_id = '$user_id'"; // 해당 사용자 ID에 대한 장바구니 레코드 삭제
    if ($conn->query($delete_query) === TRUE) {
        // 삭제 후 itemSearch.php로 리다이렉트
        header("Location: itemSearch.php");
        exit;
    } else {
        echo "장바구니 삭제 오류: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>결제 완료</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Noto Sans KR', sans-serif;
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center max-w-sm">
        <div class="flex justify-center mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <p class="text-xl font-bold mb-6">결제가 완료되었습니다.</p>
        
        <!-- 삭제 후 이동을 위한 form -->
        <form method="POST">
            <button name="dataReset" class="px-6 py-2 bg-orange-500 text-white rounded-lg text-lg hover:bg-orange-400">
                쇼핑하기
            </button>
        </form>
    </div>
</body>
</html>
