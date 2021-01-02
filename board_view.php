<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 상세보기</title>
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
            <h2 id="board_title">게시판 > 상세보기</h2>
<?php 
/*board_modify_form.php?num=<?=$num?>&page=<?=$page?>*/
//url에서 정보 GET으로 뽑아옴
    $num = $_GET["num"];
    $page = $_GET["page"];

    include "./db_con.php";

    $sql = "select * from board where num='$num'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    $id = $row["id"];
    $name = $row["name"];
    $subject = $row["subject"];
    $content = $row["content"];
    $regist_day = $row["regist_day"];
    $hit = $row["hit"];
    $file_name = $row["file_name"];
    $file_type = $row["file_type"]; //ex)image/png
    $file_copied = $row["file_copied"]; //ex)2020_09_09_10_15_09.png

    $new_hit = $hit + 1;
    $sql = "update board set hit=$new_hit where num='$num'";
    mysqli_query($con, $sql);
?>

            <ul id="view_content">
                <li>
                    <span><b>제목 : </b> <?=$subject?></span> <!--각 내용에 대한 제목  -->
                    <span> <?=$name?>&nbsp;│&nbsp;<?=$regist_day?></span> <!-- 작성자 │ 등록일 --> 
                    <!-- modify에서 DB에 원천적으로 변경시켜줌 -->
                </li>
                <li>

<?php           
                    if($file_name){
                        $real_name = $file_copied;
                        $file_path = "./data/".$real_name;
                        $file_size = filesize($file_path);
                        
                        echo "<div>첨부파일 : $file_name ($file_size Byte) <a href='board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>다운로드</a></div>";
                     }
?>
 
                    <p><?=$content?></p> <!-- 내용 -->
                </li>
            </ul>

            <ul class="buttons">
               <li><button type="button" onclick="location.href='board_list.php?page=<?=$page?>'">목록</button></li>

<?php
    //세션의 $userid 값 -> 로그인
    //$id 값은 작성된 게심물의 $num 기준으로 가져온 id 값
    if($userid == $id){ //로그인도하고 전에 쓴 아이디와 동일해야 권한가질수있음
?>    
                <li><button type="button" onclick="location.href='board_modify_form.php?num=<?=$num?>&page=<?=$page?>'">수정</button></li>
                <li><button type="button" onclick="location.href='board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
<?php  
    }
    if($userid){ //로그인만하면 쓸수있음
?>                
                <li><button type="button" onclick="location.href='board_form.php'">작성하기</button></li>

<?php  
}
?>    
            </ul>
        </div>    
    </section>

    <footer>
    <?php include "footer.php";?>
    </footer>
    
</body>
</html>