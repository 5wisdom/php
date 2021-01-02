<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 및 사이트 구성하기</title>
    <!-- 회원가입 -> 로그인 -> 로그아웃 -->
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/main.css">
    <!-- php로 가야해서 ./로 쓴다 -->
</head>
<body>
    <!-- php는 utf-8을 utf-8 with BOM으로 변경해서 사용한다 (에러나기 떄문에) -->
    <header>
        <?php include "./header.php";?>
    </header>
    <section>
        <?php include "./main.php";?>
    </section>
    <footer>
        <?php include "./footer.php";?>
    </footer>

    
</body>
</html>