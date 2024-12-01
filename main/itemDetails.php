<?php
session_start();
include 'db_connection.php';

// URL 파라미터에서 상품 ID 가져오기
$product_id = $_GET['id']; // itemDetails.php?id=상품ID

$query = "SELECT * FROM products WHERE id = '$product_id'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    
    // 상품 정보를 세션에 저장
    $_SESSION['selectname'] = $row['name'];
    $_SESSION['selectdescription'] = $row['description'];
    $_SESSION['selectprice'] = $row['price'];
    echo "<pre>";
    print_r($_SESSION); // 세션 값 출력
    echo "</pre>";
    
} else {
    echo "상품 정보를 찾을 수 없습니다.";
}

?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>상품 상세정보</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Noto Sans KR', sans-serif;
    }
    </style>
    <script>
    // 장바구니 담기 클릭 시 알림을 표시하는 함수
    function addToCart() {

        if (confirm("상품이 장바구니에 등록되었습니다! 장바구니로 이동하시겠습니까?")) {
            // 장바구니로 이동
            window.location.href = "itemPayment.html"; // 원하는 장바구니 페이지 URL로 변경
        } else {}
    }
    </script>
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
    <main class="container mx-auto mt-8">
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="flex justify-center mb-6">
                <img src="../image/item_computer.png" alt="Product Image" class="w-1/2 rounded-lg">
            </div>
            <h2 class="text-center text-2xl font-bold mb-6">상품 상세정보</h2>
            <div class="overflow-x-auto">
                <!--DB의 상품 정보 테이블의 Column에 맞출 것-->
                <table class="min-w-full bg-white border border-gray-300">
                    <tbody>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">제조사</td>
                            <td class="px-4 py-2">STCOM (제조사 웹사이트 바로가기)</td>
                            <td class="px-4 py-2 font-bold">등록년월</td>
                            <td class="px-4 py-2">2023년 09월</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">칩셋 제조사</td>
                            <td class="px-4 py-2">NVIDIA</td>
                            <td class="px-4 py-2 font-bold">제품 시리즈</td>
                            <td class="px-4 py-2">지포스 RTX 20</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">NVIDIA 칩셋</td>
                            <td class="px-4 py-2">RTX 2060 SUPER</td>
                            <td class="px-4 py-2 font-bold">베이스클럭</td>
                            <td class="px-4 py-2">1470MHz</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">부스트클럭</td>
                            <td class="px-4 py-2">1650MHz</td>
                            <td class="px-4 py-2 font-bold">쿠다 프로세서</td>
                            <td class="px-4 py-2">2176개</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">스트림 프로세서</td>
                            <td class="px-4 py-2">2176개</td>
                            <td class="px-4 py-2 font-bold">인터페이스</td>
                            <td class="px-4 py-2">PCIe3.0x16</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">메모리 종류</td>
                            <td class="px-4 py-2">GDDR6(DDR6)</td>
                            <td class="px-4 py-2 font-bold">메모리 클럭</td>
                            <td class="px-4 py-2">14000MHz</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">메모리 용량</td>
                            <td class="px-4 py-2">8GB</td>
                            <td class="px-4 py-2 font-bold">메모리 버스</td>
                            <td class="px-4 py-2">256-bit</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">DVI</td>
                            <td class="px-4 py-2">1개</td>
                            <td class="px-4 py-2 font-bold">HDMI</td>
                            <td class="px-4 py-2">1개</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">DisplayPort</td>
                            <td class="px-4 py-2">1개</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">색 지원</td>
                            <td class="px-4 py-2">○</td>
                            <td class="px-4 py-2 font-bold">HDR 지원</td>
                            <td class="px-4 py-2">○</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">전력 관련</td>
                            <td class="px-4 py-2">정격파워 550W 이상</td>
                            <td class="px-4 py-2 font-bold">전력 포트</td>
                            <td class="px-4 py-2">8핀 x1</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">냉각방식</td>
                            <td class="px-4 py-2">쿨링팬</td>
                            <td class="px-4 py-2 font-bold">쿨러형태</td>
                            <td class="px-4 py-2">○</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">제품 길이</td>
                            <td class="px-4 py-2">212mm</td>
                            <td class="px-4 py-2 font-bold">로켓</td>
                            <td class="px-4 py-2">45mm</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">부가기능</td>
                            <td class="px-4 py-2">○</td>
                            <td class="px-4 py-2 font-bold">볼트레이트</td>
                            <td class="px-4 py-2">○</td>
                        </tr>
                        <tr class="border-b">
                            <td class="px-4 py-2 font-bold">적용상품기준</td>
                            <td class="px-4 py-2">R-R-STO-RTX2060SR (인증)</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-center mt-6 space-x-4">
            <!--장바구니 담기 버튼 클릭 시 장바구니 DB에 저장할 것 -->
            <form action="add_to_cart.php" method="post">
                <button class="bg-white px-6 py-2 rounded shadow" onclick="addToCart()">장바구니 담기</button>
            </form>
            <!-- 구매하기 버튼 클릭 시 결제 DB에 저장할 것-->
            <button class="bg-orange-500 text-white px-6 py-2 rounded shadow">구매하기</button>
        </div>
        <br>
    </main>
</body>

</html>