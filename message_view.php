<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>쪽지 상세보기화면</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/message.css">
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
                            <h3>100% Free <span>Online Courses</span></h3>
                            <h1>GET Tomorrow's Skills Today!</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        <div id="message_box">
            <h2 class="title">
<?php
    /* message_view.php?mode=<?=$mode?>&num=<?=$num?> */
    $mode = $_GET["mode"];  //저기에서 mode만 받아옴
    $num = $_GET["num"]; //저기에서 num만 받아옴

    include "db_con.php";// $con등록
    
    $sql = "select * from message where num='$num'";
    $result = mysqli_query($con, $sql);


    $row = mysqli_fetch_array($result);
    $send_id = $row["send_id"];
    $rv_id = $row["rv_id"];
    $regist_day = $row["regist_day"];
    $subject = $row["subject"];
    $content = $row["content"];

    //댓글에 대한 상대방에게 접속을 시도 (크로스로 상대방에게 무언가를 전달)
    if($mode == "send"){  //발신함이라면 받는사람에 대한 이름 정보가 필요
        $result2 = mysqli_query($con, "select name from members where id='$rv_id'");
    }else{ //수신함이라면, 보낸사람에 대한 이름 정보가 필요
        $result2 = mysqli_query($con, "select name from members where id='$send_id'");
    }
    $record = mysqli_fetch_array($result2);
    $msg_name = $record["name"];

    if($mode == "send"){
        echo "발신함 > 상세내용";
    }else{
        echo "수신함 > 상세내용";
    }
?>
            </h2>
            <!-- 제목, 보낸사람 또는 받는사람, 작성일, 내용 -->
            <ul id="message_view">
                <li>
                    <span>제목</span> : <?=$subject?>
                </li>
                <li>
                    <span>
<?php
    if($mode == "send"){
        echo "받은사람";
    }else{
        echo "보낸사람";
    }
?>

                    </span> : <?=$msg_name?>
                </li>
                <li><p><?=$content?></p></li>
                <li><span>작성일</span> : <?=$regist_day?></li>
            </ul>

            <!-- 페이지 연동(발신함, 수신함, 답변함, 삭제기능) -->
            <ul class="msg_link">
                <li><button type="button" onclick="location.href='message_box.php?mode=rv'">수신함</button></li>
                <li><button type="button" onclick="location.href='message_box.php?mode=send'">발신함</button></li>
<?php
    //내가 나에게 답장 보내기라는 물리적 UI 버튼은 사라지도록 구성. 수신함에서만 답장을 보낼 수 있도록 구성
    if($mode != "send"){
?>
                <li><button type="button" onclick="location.href='message_response_form.php?num=<?=$num?>'">답장 보내기</button></li><!--message table 접근-->
<?php
    }
?>
                <li><button type="button" onclick="location.href='message_delete.php?mode=<?=$mode?>&num=<?=$num?>'">삭제</button></li><!--message table 접근-->
            </ul>
        </div>
    </section>
    <footer>
        <?php include "footer.php";?>
    </footer>
    
</body>
</html>

  
