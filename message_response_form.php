<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쪽지 답장 보내기</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/message.css">
</head>
<body>
    <!-- [쪽지 보내기 항목]
    get방식으로 가져오는 항목 (url 의 정보값을 기준으로)
 - mode : send/rv
 - num : message 테이블로부터 값을 전달받기 위해서 가져온다.

    post방식으로 가져오는 항목 (name이라는 속성을 통하여 받아온 value 값들)
 - 사용자의 작성에 의한 입력값
 - 기존의 입력값 형태를 갖춘 모든 데이터
 -->
    <header>
        <?php include "./header.php";?>
    </header>    
    <!-- 보내는 사람, 받는 사람, 제목, 내용 + 보내기 버튼 -->
    <section>
        <div id="main_img_bar" class="subpage">
            <div class="main_img_cont">
                <div class="frame">
                    <div class="main_img_text">
                        <div class="main_img_title">
                            <h3>100% Free <span>Online Courses</span></h3>
                            <h1>Get Tomorrow's Skills Today!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="message_box">
            <h2 id="write_title">쪽지 답장 보내기</h2>

<?php
    $num = $_GET["num"];

    include "db_con.php"; //db접속

    $sql = "select * from message where num = '$num'";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result); //$result가져와줘
    $send_id = $row["send_id"];
    $rv_id = $row["rv_id"];
    $subject = $row["subject"];
    $content = $row["content"];

    //답글 제목의 좌측에 "RE :" 표기
    //내용 >>로 구분
    $subject = "RE : ".$subject;
    $content = "\n\n\n-----------------------------------\n>> ".$content;
    
    $result2 = mysqli_query($con, "select name from members where id='$send_id'");
    $record = mysqli_fetch_array($result2); //해당하는 id가져옴
    $send_name = $record["name"]; //배열에서 name만 가져옴


?>            
            
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
                                <p><?=$send_name?>(<?=$send_id?>)</p>
                                <input type="hidden" name="rv_id" value="<?=$send_id?>">"> <!-- hidden으로 감춰져있어서 보이지 않는데 rv_id를 뽑아 insert에 넣기위해 name을 지정해주는 것 -->
                            </div>
                        </li>
                        <li>
                            <div class="label">
                                <label for="subject">제목</label>
                            </div>
                            <div class="input">
                                <input type="text" name="subject" value="<?=$subject?>">
                            </div>
                        </li>
                        <li>
                            <div class="label">
                                <label for="content">내용</label>
                            </div>
                            <div class="input">
                                <textarea rows="" cols="" name="content"><?=$content?></textarea>
                            </div> <!-- content는 안에가 글자여서 value가 필요없어서 name쓴다 -->
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