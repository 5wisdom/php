<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쪽지보내기 양식</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/message.css">
</head>
<body>
    <header>
        <?php include "header.php";?>
    </header>

    <!-- header에 섹션이 등록되어 있으므로 밑에 작성한다 -->
<?php
    if(!$userid){
        echo("
            <script>
                alert('로그인 후 이용 바랍니다');
                location.href='./login_form.php';
            </script>
        ");
        exit;
       
    }
?>    

    <section>
        <div id="main_img_bar" class="subpage">
            <div class="main_img_cont">
                <div class="frame">
                    <div class="main_img_text">
                        <div class="main_img_title">
                            <h3>100% Free <span>Online Courses</span></h3>
                            <h1>GET Tomorrow's Skills Today!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="message_box">
            <h2 id="write_title">쪽지 보내기</h2>
            <ul class="top_buttons">
                <li><a href="message_box.php?mode=rv">수신함</a></li>
                <li><a href="message_box.php?mode=send">발신함</a></li>
            </ul>
            <form name="message_form" action="message_insert.php?send_id=<?=$userid?>" method="post">
                <div id="write_msg">
                    <ul>
                        <li>
                            <div class="label">
                                <label for="id">보내는 사람</label>
                            </div>
                            <div class="input">
                                <p><?=$userid?></p>
                            </div>
                        </li>
                        <li>
                            <div class="label">
                                <label for="rv_id">받는 사람(아이디)</label>
                            </div>
                            <div class="input">
                                <input type="text" name="rv_id">
                            </div>
                        </li>
                        <li>
                            <div class="label">
                                <label for="subject">제목</label>
                            </div>
                            <div class="input">
                                <input type="text" name="subject">
                            </div>
                        </li>
                        <li>
                            <div class="label">
                                <label for="content">내용</label>
                            </div>
                            <div class="input">
                                <textarea rows="" cols="" name="content"></textarea>
                            </div>
                        </li>
                    </ul>
                    <button class="send_btn" type="button" onclick="check_input();">보내기</button>
                </div>
            </form>
        </div>
    </section>
    <footer>
        <?php include "footer.php";?>
    </footer>

    


    <script src="./js/message.js"></script>

</body>
</html>