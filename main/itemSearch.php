<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메인페이지</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+KR:wght@400;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Noto Sans KR', sans-serif;
    }

    .custom-spacing {
        letter-spacing: 0.1em;
    }

    .spaced p {
        margin-bottom: 1rem;
        /* 각 p 태그 아래에 1rem 간격을 줌 */
    }
    </style>
</head>

<body class="bg-gray-100">
    <header class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center p-5">
            <button class="bg-transparent text-orange-500 border-none px-4 py-2 rounded">
                <a href="itemSearch.php">
                    <img src="../image/logo.png" alt="Logo" class="h-10">
                </a>
            </button>
            <nav class="flex space-x-4">
                <!--  -->
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
            session_start(); // 세션 시작

            if (isset($_POST['logout'])) {
                // 세션 데이터 삭제
                session_unset();
                // 세션 종료
                session_destroy();
                // 페이지 새로고침
                header("Location: ".$_SERVER['PHP_SELF']);
                exit;
            }

            // 세션에서 사용자 이름 가져오기
            if (isset($_SESSION['username'])) {
                $username = $_SESSION['username'];
                echo "<h1>환영합니다, $username 님!</h1>";
            ?>
                <!-- 장바구니 버튼 (세션이 있을 때만 보이도록) -->
                <a href="itemPayment.php">
                    <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-400">장바구니</button>
                </a>
                
                <!-- 로그아웃 버튼 -->
                <form method="post" style="display: inline;">
                    <button type="submit" name="logout" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-400">로그아웃</button>
                </form>
            <?php
            } else {
            ?>
                <!-- 로그인 버튼 -->
                <a href="login_form.html">
                    <button class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-400">로그인</button>
                </a>
            <?php
            }
            ?>
            
        </div>
    </header>
    <br>
    <main class="container mx-auto mt-8 p-4">
        <h1 class="text-5xl font-bold text-center mb-6">당신이 찾고있는 제품은?</h1>
        <br>
        <br>
        <div class="grid grid-rows-3 grid-cols-6 gap-4">
            <!--  -->
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">삼성</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">LG</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">MSI</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">Lenovo</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">Apple</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">ASUS</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">인텔</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">AMD</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">NVIDIA</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">AMD
                Radeon</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">NVme
                SSD</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">SATA
                HDD</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">미드
                타워</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">RGB
                케이스</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">마우스</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">키보드</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">모니터</button>
            <button
                class="bg-gray-100 px-2 py-2 rounded-full w-full font-bold border-2 border-transparent hover:border-orange-500 transition-transform duration-200 hover:scale-110">스피커</button>
        </div>
        <br>
        <br>
        <div class="mt-8 flex justify-center gap-4">
             <form action="search.php" method="GET" class="flex w-full max-w-3xl">
                <input type="text" name="query" placeholder="검색하실 상품을 입력하시오."
                    class="border border-gray-300 p-4 flex-grow rounded-l text-lg">
            <button type="submit" name="button"
                    class="bg-orange-500 text-white px-6 py-3 rounded-r text-lg hover:bg-orange-400">검색하기</button>
            </form>
        </div>
        <br>
        <hr class="border-t border-gray-300 my-4">
        <br>
        <div class="flex justify-center">
            <table class="table-auto w-full text-left max-w-4xl">
                <thead>
                    <tr>
                        <th class="border-b px-4 py-2 text-sm">Affiliation: 컴퓨터공학과</th>
                        <th class="border-b px-4 py-2 text-sm">Web_Programming</th>
                        <th class="border-b px-4 py-2 text-sm">Division of Roles</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border-b px-4 py-2 text-sm">
                            <p>&nbsp;Professor: 김재호</p>
                            <p>&nbsp;T.L: 20221918_정환희</p>
                            <p>&nbsp;T.M: 20231343_정찬욱</p>
                            <p>&nbsp;T.M: 20181478_조성현</p>
                        </td>
                        <td class="border-b px-4 py-2 text-sm">
                            <p>&nbsp;Subject: 온라인 쇼핑몰</p>
                            <p>&nbsp;function_1: 로그인</p>
                            <p>&nbsp;function_2: 검색</p>
                            <p>&nbsp;function_3: 장바구니</p>
                        </td>
                        <td class="border-b px-4 py-2 text-sm">
                            <p>&nbsp;Front-end: html/css</p>
                            <p>&nbsp;Back-end: xampp(Apache/php/Mysql)</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
</body>

</html>