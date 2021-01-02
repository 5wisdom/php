<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>메시지 목록 리스트></title>
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
            <h2>

<?php
    if(isset($_GET["page"])){//페이지 넘버가 있다면
        $page = $_GET["page"]; //사용자에 의해서 하단의 넘버를 클릭했을때 
    }else{
        $page = 1; //메인화면으로부터 쪽지 보내기 후 리스트로 진입했을 때 
    }

    $mode = $_GET["mode"]; //url정보창으로부터 mode=value값"을 가져와서 저장
    if($mode == "send"){
        echo "발신함 > 목록보기";
    }else{
        echo "수신함 > 목록보기";
    }
?>            

            </h2>
            <div id="message_list">
                <ul id="message">
                    <li>
                        <span class="field_1">번호</span>
                        <span class="field_2">제목</span>
                        <span class="field_3">
<?php
// 발신함이 열린 상태라면 "받는 사람"
// 수신함이 열린 상태라면 "보낸 사람"
                        if($mode == "send"){
                            echo "받는 사람";
                        }else{
                            echo "보낸 사람";
                        }
?>
                        </span>
                        <span class="field_4">등록일</span>
                    </li>
<?php
    //여러가지 항목이 있을 수 있다는 조건이 필요한데, 반복을 적용하여 내부에 각 데이터를 넣을 예정
    /*
    $con = mysqli_connect("localhost","owisdom","dhwlgp1208!","owisdom");
    mysqli_query($con, "SET NAMES utf8"); //글자안꺠지게 utf8씀
    */
    include "./db_con.php";

    if($mode == "send"){ //발신함에서 db접근
        $sql = "select * from message where send_id='$userid' order by num desc";//최신순받아옴
    }else{ //수신함에서 접근
        $sql = "select * from message where rv_id='$userid' order by num desc";
    }

    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result); //해당하는 항목의 전체 글 목록에 대한 데이터를 가져옴
    //var_dump($total_record) ==> int(1)
    $scale = 10; //각 페이지 별로 몇개까지 보여줄가에 대한 값

    //데이터의 양에 따른 전체 페이지수 계산
    if($total_record % $scale == 0){
        $total_page = $total_record/$scale;//100/10 =10개의 페이지가 나옴 
    }else{
        $total_page = floor($total_record/$scale) + 1; //102/10 =11개의 페이지가 나옴, floor:절삭
    }

    //첫번째 페이지($page = 1)에서는 100개의 데이터가 있다고 가정하면 
    //0번 데이터로부터 9번까지의 데이터를 가져옴

    //표시할 페이지($page)마다 시작하는 데이터의 번호를 가져옴 
    $start = ($page - 1) * $scale; 
    //1번 페이지일 경우, (1-1) * 10 ===> 0~
    //2번 페이지일 경우, (2-1) * 10 ===> 10~
    //3번 페이지일 경우, (3-1) * 10 ===> 20~

    $number = $total_record - $start; //게시글 내용 중에서 전체 게시글 내용으로 부터 하나씩 감소하면서 게시글에 대한 번호(넘버링)를 붙여준다.
    //100 - 0 = 100
    //100 - 10 = 90 
    
    //$i = 0이라는 초기값을 기준으로 $i<10 + $i<전체개수; $i 하나씩 증가
    //$i<$total_record 전체개수가 있는것만 가져옴-+

    for($i = $start; $i < $start + $scale && $i < $total_record; $i++){ //0,10민만까지 for문 돌림
    
        mysqli_data_seek($result, $i); //내가찾고자하는 자료에서 $i
        //mysqli_data_seek(최종 데이터값들, 레코드 순번);
        //갖고 올 데이터 레코드로 위치 이동

        $row = mysqli_fetch_array($result);
        //하나의 데이터 레코드를 가져옴

        $num = $row["num"]; //번호
        $subject = $row["subject"]; //제목
        if($mode == "send"){ //발신함이라면, 보낸함이라면
            $msg_id = $row["rv_id"]; //누구한테 보냈는지를 쓴다 (받는사람아이디)
        }else{
            $msg_id = $row["send_id"]; //수신함이라면 누가 보냈는지를 쓴다 (보낸사람아이디)
        }
        $regist_day = $row["regist_day"]; //등록한날

        $result2 = mysqli_query($con, "select name from members where id='$msg_id'");//보낸사람이나 받는사람이냐를 따짐
        //각페이지로부터 아이디가 일치하는 상대방의 name을 받아오려는 목적으로 작성
        $record = mysqli_fetch_array($result2);
        $msg_name = $record["name"];
        
?>
<!-- for문 돌려서 필요한거 만큼 가져옴 -->
                    <li>
                        <span class="field_1"><?=$number?></span>
                        <!-- 발신함/수신함 구분 + 몇번에 대한 테이터를 보여줄지에 대한 정보값을 갖고있음(message_view.php) : 제목, 내용, 등록일, 받는사람 또는 보낸사람-->
                        <span class="field_2">
                            <a href="message_view.php?mode=<?=$mode?>&num=<?=$num?>">  
                                <?=$subject?>
                            </a>
                        </span><!-- 주제를 클릭했을때 정보를 가져와 -->
                        <span class="field_3"><?=$msg_name?> (<?=$msg_id?>)</span>
                        <span class="field_4"><?=$regist_day?></span>
                    </li>

<?php //여기서 닫히므로 잘보자
    $number--; //번호순번 위에서부터 하나씩 빠짐 10, 9, 8, 7, 6, 5, 4, 3, 2, 1
    }
    mysqli_close($con);
?>

                </ul>
                <ul id="page_num">
                
<?php
    //게시글의 양이 두번째 페이지가 나와야 할 경우

    //이전페이지로 이동파트
    if($total_page >= 2 && $page >=2){
        $new_page = $page - 1;
        echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>◀ 이전</a></li>";
    }else{
        echo "<li>&nbsp;</li>";
    }


   //게시글에 대한 페이지 넘버를 부여
    for($i=1; $i<=$total_page; $i++){
        if($page == $i){ //현재 보여지는 페이지에 대한 표기(링크 불필요)
           echo "<li><span class='cur_page'> $i </span></li>";
       }else{
             echo "<li><a href='message_box.php?mode=$mode&page=$i'> $i </a></li>"; //$i에 꺽쇠가 붙으면 앞뒤 떼주기 문자인식때문에
       }
   }

   //다음페이지로 이동파트
   //만약 현재 페이지의 번호가 2번인데, 전체 페이지의 개수가 2개 밖에 없다면 다음에 대한 버튼은 의미가 없음(다음이라는 버튼을 클릭시 넘어갈 페이지가 없음)
   if($total_page >= 2 && $page != $total_page){
    $new_page = $page + 1;
        echo "<li><a href='message_box.php?mode=$mode&page=$new_page'>다음 ▶</a></li>";
    }else{
        echo "<li>&nbsp;</li>";
    }
?>
                </ul>


                <!-- 페이지 연동(발신함, 수신함, 작성하기) -->

                <ul class="msg_link">
                    <li><button type="button" onclick="location.href='message_box.php?mode=rv'">수신함</button></li>
                    <li><button type="button" onclick="location.href='message_box.php?mode=send'">발신함</button></li>
                    <li><button type="button" onclick="location.href='message_form.php'">쪽지보내기</button></li>
                </ul>
               


            </div>  
        </div>
    
    </section>

    <footer>
        <?php include "footer.php";?>
    </footer>
    
</body>
</html>
