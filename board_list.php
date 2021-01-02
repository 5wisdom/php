<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 리스트</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/board.css">
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
        <div id="board_box">
            <h2 id="board_title">게시판 > 리스트</h2>
            <ul id="board_list">
                <li>
                    <span class="field_1">번호</span>
                    <span class="field_2">제목</span>
                    <span class="field_3">작성자</span>
                    <span class="field_4">첨부</span>
                    <span class="field_5">등록일</span>
                    <span class="field_6">조회</span>
                </li>
<?php
    if(isset($_GET["page"])){
        $page = $_GET["page"];
    }else{
        $page = 1;
    }

    include "./db_con.php";

    $sql = "select * from board order by num desc";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result); //전체 글 수

    $scale = 10;

    //전체 페이지수 계산
    if($total_record % $scale == 0){ //10의 배수일 경우
        $total_page = $total_record / $scale;
    }else{
        $total_page = floor($total_record / $scale) + 1;
    }
    //floor() : 내림 / ceil() : 올림 / round() : 반올림

    //표시할 페이지에 따른 첫번째 보여줄 리스트의 시작 번호
    $start = ($page - 1) * $scale; //데이터로부터 받아올 인덱스 값
    $number = $total_record - $start;

    //현재 페이지가 1번일 경우, $start = 0, 
    //for($i = 0;$i < 0 + 10;$i++)

    //현재 페이지가 2번일 경우, $start = 10,
    //for($i =  10; $i < 10+10; $i++)

    //게시글이 2개밖에 존재하지 않는다면, 10번씩이나 반족을 적용할 필요가 없음, 2개만 반복을 시켜주면 됨
    //for($i = 0; $i < 10 && $ i< 2;$i++) => 2회만 반복

    //게시글이 12라면, $total_record => $i < 12 (12회반복)
    //페이지가 1번일경우, for($i = 0;$i < 10 && < 12; $i++) => 1

    //페이지가 2번일 경우, for($i = 10;$i < 10 + 10 && $i < 12; $i++) => 2회반복

    for($i = $start; $i < $start + $scale && $i < $total_record; $i++){
        mysqli_data_seek($result, $i); //가져올 레코드로 위치 이동
        $row = mysqli_fetch_array($result);
        $num = $row["num"];
        $id = $row["id"];
        $name = $row["name"];
        $subject = $row["subject"];
        $regist_day = $row["regist_day"];
        $hit = $row["hit"];

        if($row["file_name"]){ //첨부파일이 존재하는 경우, 대표이미지를 표기
            $file_img = "<img src='./img/file.gif'>";
        }else{ //첨부파일이 없으면 대표이미지 빼고 비워둬!
            $file_img = "";
        }

?>

                <li>
                    <span class="field_1"><?=$number?></span> <!-- 번호 -->
                    <span class="field_2"><a href="board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span> <!-- 제목 (page는 보던데에서 다시 page까지 연결) -->
                    <span class="field_3"><?=$name?></span> <!-- 작성자 -->
                    <span class="field_4"><?=$file_img?></span><!-- 첨부파일 -->
                    <span class="field_5"><?=$regist_day?></span><!-- 등록일 -->
                    <span class="field_6"><?=$hit?></span><!-- 조회 -->
                </li>
<?php
    $number--;
    }
    mysqli_close($con);
?>

            </ul>
            <ul id="page_num">

<?php
    if($total_page >= 2 && $page >= 2){
        $new_page = $page - 1;
        echo "<li><a href='board_list.php?page=$new_page'>◀ 이전</a></li>";
    }else{
        echo "<li>&nbsp;</li>";
    }


    for($i=1;$i<=$total_page;$i++){
        if($page == $i){ // 현재 페이지 번호와 동일한 경우, 현재페이지만표기
            echo "<li><span class='cur_page'> $i </span></li>";
        }else{ //동일하지 않은경우 그 페이지로 감
            echo "<li><a href='board_list.php?page=$i'> $i </a></li>";
        }
    }
    if($total_page >= 2 && $page != $total_page){
        $new_page = $page + 1;
        echo "<li><a href='board_list.php?page=$new_page'>다음 ▶</a></li>";
    }else{
        echo "<li>&nbsp;</li>";
    }
?>

            </ul>
<?php
    if($userid){
?>
            
            <ul class="buttons">
                <li><button onclick="location.href='./board_form.php'">작성하기</button></li>
                <!--만약 로그인이 안된 상태라면 작성하기 버튼은 숨김-->
            </ul>
<?php
    }
?>
        </div>
    </section>

    <footer>
       <?php include "footer.php";?>
    </footer>
    
</body>
</html>