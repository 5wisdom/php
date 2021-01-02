<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>회원가입</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/member.css">
</head>
<body>
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

        <div id="main_content">
            <div id="join_box">
                <form name="member_form" action="member_insert.php" method="post">
                    <h2>회원가입</h2>
                    <div class="form id">
                        <div class="label">
                            <label for="">아이디</label>
                        </div>
                        <div class="input">
                            <input type="text" name="id">
                        </div>
                        <div class="add_btn">
                            <a href="#"><img src="./img/check_id.gif" alt="" onclick="check_id();"></a>
                        </div>
                    </div>

                    <div class="form">
                        <div class="label">
                            <label for="pass">비밀번호</label>
                        </div>
                        <div class="input">
                            <input type="password" name="pass">
                        </div>
                    </div>

                    <div class="form">
                        <div class="label">
                            <label for="pass_confirm">비밀번호 확인</label>    
                        </div>
                        <div class="input">
                            <input type="password" name="pass_confirm">    
                        </div>                        
                    </div>

                    <div class="form">
                        <div class="label">
                            <label for="name">이름</label>
                        </div>
                        <div class="input">
                            <input type="text" name="name">
                        </div>
                    </div>

                    <div class="form email">
                        <div class="label">
                            <label for="email1">이메일</label>
                        </div>
                        <div class="input">
                            <input type="email" name="email1">@<input type="email" name="email2">
                            <!-- required가 없어서 @가 안에 없어도 괜찮다 -->
                        </div>
                    </div>

                    <hr>

                    <div class="buttons">
                        <img src="./img/button_save.gif" alt="저장하기" onclick="check_input();">
                        <img src="./img/button_reset.gif" alt="취소하기" onclick="reset_form();">
                    </div>
                </form>
            </div>
        </div>
    </section>

    <footer>
        <?php include "footer.php";?>
    </footer>

    <script src="js/member_form.js"></script>
    
</body>
</html>