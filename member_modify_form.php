<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원정보수정</title>
    <link rel="stylesheet" href="./css/common.css"><!-- header 꾸며주려고 -->
    <link rel="stylesheet" href="./css/member.css">
</head>
<body>
    <!-- 회원정보수정(아이디만 제외) -->
    <!-- 데이터베이스에서는 update로 수정 -->

    <header>
        <?php include "header.php";?>
    </header>
    <section>
        <div id="main_img_bar" class="subpage">
            <div class="main_img_cont">
                <div class="frame">
                    <div class="main_img_text">
                        <div class="main_img_title">
                            <h3>100% Free <span>Online Course</span></h3>
                            <h1>GET Tomorrow's Skills Today!</h1>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>

<?php
    /*
    $con = mysqli_connect("localhost","owisdom","dhwlgp1208!","owisdom");
    mysqli_query($con, "SET NAMES utf8"); //글자안꺠지게 utf8씀
    */
    include "./db_con.php";

    $sql = "select * from members where id='$userid'"; //하나의 해당하는 데이터 줄을 선택
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result); //모든 데이터를 배열화 해서 가져옴

    //데이터베이스로부터 아이디가 일치하는 항목을 각 필드명에 따라 저장(필요한 부분만 뺌)
    $pass = $row["pass"];
    $name = $row["name"];

    //jihye9099@naver.com
    //좌측 박스에는  jihye9099,우측박스에는 naver.com
    //explode("특정문자", 문자열을 갖고있는 대상 또는 변수명)
    $email = explode("@", $row["email"]); //@빼고 양쪽으로 갈라짐(특정문자를 기준으로 분리시켜 배열로저장, split과 비슷) ["jihye9099","naver.com"]
    $email1 = $email[0]; //["jihye9099"]
    $email2 = $email[1]; //["naver.com"]

    mysqli_close($con);
 
?>        
        
        <div id="main_content">
            <div id="join_box"><!-- php 없이도 데이터베이스 가져올수 있음-->
                <form name="member_form" action="member_modify.php?id=<?=$userid?>" method="post">
                    <h2>회원정보수정</h2>
                    <div class="form id">
                        <div class="label">
                            <label for="">아이디</label> <!-- 절대수정안됨 고정값! -->
                        </div>
                        <div class="input">
                            <input type="text" name="id" value="<?=$userid?>" readonly> <!-- 읽기전용 -->
                        </div>
                    </div>
                    <div class="form">
                        <div class="label">
                            <label for="pass">비밀번호</label>
                        </div>
                        <div class="input">
                            <input type="password" name="pass" value="<?=$pass?>">
                        </div>
                    </div>

                    <div class="form">
                        <div class="label">
                            <label for="pass_confirm">비밀번호 확인</label>    
                        </div>
                        <div class="input">
                            <input type="password" name="pass_confirm" value="<?=$pass?>">    
                        </div>                        
                    </div>

                    <div class="form">
                        <div class="label">
                            <label for="name">이름</label>
                        </div>
                        <div class="input">
                            <input type="text" name="name"value="<?=$name?>">
                        </div>
                    </div>

                    <div class="form email">
                        <div class="label">
                            <label for="email1">이메일</label>
                        </div>
                        <div class="input">
                            <input type="email" name="email1" value="<?=$email1?>">@<input type="email" name="email2" value="<?=$email2?>">
                        </div>
                    </div>

                    <hr>

                    <div class="buttons">
                        <img src="./img/button_save.gif" alt="수정하기" onclick="check_input();">
                        <img src="./img/button_reset.gif" alt="취소하기" onclick="reset_form();">
                    </div>
                </form>
            </div>
        </div>
    </section>    





    <script src="./js/member_form.js"></script>

</body>
</html>