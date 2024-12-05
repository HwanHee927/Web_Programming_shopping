<?php
include 'db_connection.php';
session_start();

// 기본 쿼리 설정
$query = "SELECT * FROM products";

// 조건이 있을 경우 Prepared Statement 사용
if (isset($_SESSION['productdescription'])) {
    $stmt = $conn->prepare($query . " WHERE description = ?");
    $stmt->bind_param("s", $_SESSION['productdescription']);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($query);
}
?>

<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>상품검색 결과</title>
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
            // 세션 시작

            // 세션에서 사용자 이름 가져오기
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
        <?php
            if (isset($_SESSION['productdescription'])) {
                $productdescription = $_SESSION['productdescription'];
                echo "<h1 class='text-2xl font-bold text-center mb-6'>$productdescription 와 관련된 검색결과</h1>";
            } else {
                echo "<h1 class='text-2xl font-bold text-center mb-6'>검색 결과가 없습니다.</h1>";
            }
            ?>

        <?php
        if ($result->num_rows > 0) {
            // 데이터를 반복 출력
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class='bg-white shadow-md rounded-lg p-6 mb-6'>
                    <div class='flex'>
                        <img src="../image/<?= $row['description'] ?>.png" alt="Product Image"
                            class='w-24 h-24 object-cover rounded'>
                        <div class='ml-4'>
                            <h2 class='text-lg font-bold'><?php echo $row['name']; ?></h2>
                            <p class='text-gray-600'><?php echo $row['description']; ?></p>
                            <p class='text-blue-500 mt-2'><?php echo number_format($row['price']); ?>원</p>
                            <a href='itemDetails.php?id=<?php echo $row['id']; ?>&bigImage=<?php echo $row['description']; ?>'>
                                <button class='mt-4 px-6 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-400'>
                                    자세히 보기
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p class='text-center'>검색 결과가 없습니다.</p>";
        }
        ?>

        <div class="flex justify-center space-x-2 mt-8">
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-orange-400">1</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-orange-400">2</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-orange-400">3</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-orange-400">4</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-orange-400">5</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-orange-400">6</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-orange-400">7</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-orange-400">8</button>
            <button class="px-3 py-1 border border-gray-300 rounded hover:bg-orange-400">9</button>
            <!-- 현재 페이지의 위치를 색으로 표시-->
        </div>
        <br>
    </main>
</body>

</html>