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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    if (!empty($_POST['cart_ids'])) {
        $cart_ids_to_delete = $_POST['cart_ids']; // 선택된 상품들의 cart_id
        $cart_ids = implode(',', $cart_ids_to_delete); // 배열을 콤마로 구분된 문자열로 변환
        $delete_query = "DELETE FROM cart WHERE id IN ($cart_ids)";
        if ($conn->query($delete_query)) {
            header("Location: itemPayment.php"); // 삭제 후 페이지 새로고침
            exit;
        } else {
            echo "삭제 오류: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>장바구니</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Noto Sans KR', sans-serif;
    }
    </style>
</head>

<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center p-5">
            <button class="bg-transparent text-orange-500 border-none px-4 py-2 rounded">
                <a href="itemSearch.php">
                    <img src="../image/logo.png" alt="Logo" class="h-10"> <!-- 웹 로고-->
                </a>
            </button>
            <nav class="flex space-x-4">
                <a href="#"
                    class="text-gray-700 hover:text-orange-500 text-2xl font-bold transition-transform duration-200 hover:scale-110">데스크톱</a>
                <a href="#"
                    class="text-gray-700 hover:text-orange-500 text-2xl font-bold transition-transform duration-200 hover:scale-110">노트북</a>
                <a href="#"
                    class="text-gray-700 hover:text-orange-500 text-2xl font-bold transition-transform duration-200 hover:scale-110">CPU</a>
                <a href="#"
                    class="text-gray-700 hover:text-orange-500 text-2xl font-bold transition-transform duration-200 hover:scale-110">그래픽카드</a>
                <a href="#"
                    class="text-gray-700 hover:text-orange-500 text-2xl font-bold transition-transform duration-200 hover:scale-110">HDD/SSD</a>
                <a href="#"
                    class="text-gray-700 hover:text-orange-500 text-2xl font-bold transition-transform duration-200 hover:scale-110">쿨러</a>
                <a href="#"
                    class="text-gray-700 hover:text-orange-500 text-2xl font-bold transition-transform duration-200 hover:scale-110">케이스</a>
                <a href="#"
                    class="text-gray-700 hover:text-orange-500 text-2xl font-bold transition-transform duration-200 hover:scale-110">파워</a>
                <a href="#"
                    class="text-gray-700 hover:text-orange-500 text-2xl font-bold transition-transform duration-200 hover:scale-110">주변기기</a>
            </nav>
            <?php
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo "<h1>환영합니다, $username 님!</h1>";
            } else {
                ?>
            <a href="login_form.html">
                <button class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-400">로그인</button>
            </a>
            <?php
            }
            ?>
        </div>
    </header>

    <main class="container mx-auto mt-8 px-6">
        <h1 class="text-2xl font-bold text-center mb-6">장바구니</h1>
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <form method="POST" action="">
                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="w-1/12 px-4 py-2 border-b">선택</th>
                            <th class="w-4/12 px-4 py-2 border-b">상품/옵션 정보</th>
                            <th class="w-1/12 px-4 py-2 border-b">수량</th>
                            <th class="w-2/12 px-4 py-2 border-b">상품금액</th>
                            <th class="w-2/12 px-4 py-2 border-b">할인/적립</th>
                            <th class="w-2/12 px-4 py-2 border-b">합계금액</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // 장바구니 항목 출력
                        $result->data_seek(0); // 커서를 처음으로 되돌려서 반복문이 제대로 돌아가게 함
                        while ($row = $result->fetch_assoc()):
                        ?>
                        <tr class="border-b">
                            <td class="px-4 py-2 text-center">
                                <input type="checkbox" name="cart_ids[]" value="<?= $row['id'] ?>" checked>
                            </td>
                            <td class="px-4 py-2 flex items-center">
                                <img src="../image/<?= $row['product_category'] ?>.png" alt="Product Image"
                                    class="mr-4 max-w-[100px] border border-gray-300 p-2 rounded">
                                <div>
                                    <div class="font-bold"><?= $row['product_name'] ?></div>
                                </div>
                            </td>
                            <td class="px-4 py-2 text-center">1개</td>
                            <td class="px-4 py-2 text-center"><?= number_format($row['product_price']) ?>원</td>
                            <td class="px-4 py-2 text-center">-</td>
                            <td class="px-4 py-2 text-center"><?= number_format($row['product_price']) ?>원</td>
                        </tr>
                        <?php endwhile; ?>
                        <tr class="border-b">
                            <td class="px-4 py-2 text-center" colspan="6">
                                <div class="text-center font-bold text-gray-700">
                                    배송비: <?= number_format($shipping_fee) ?>원
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                    <div class="flex justify-between items-center mt-4 px-6">
                        <!-- 상품 삭제하기 버튼 -->
                        <button type="submit" name="delete" class="bg-gray-200 text-gray-700 px-6 py-2 rounded">상품 삭제하기</button>
                        <!-- 상품 금액 표시 -->
                        <div class="text-lg font-bold text-right px-4">선택한 상품금액: <?= number_format($total_price) ?>원</div>
                        <div>
                            <!-- 상품 주문 버튼 -->
                            <a href="itemPaymentSuccess.php">
                                <button type="button" class="bg-orange-500 text-white px-6 py-2 rounded border-none">
                                    상품 주문하기
                                </button>
                            </a>
                        </div>
                    </div>
                <br>
            </form>
        </div>
        <br>
    </main>
</body>

</html>