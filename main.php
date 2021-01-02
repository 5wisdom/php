        <div id="main_img_bar" class="mainpage">
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

        <div id="main_content">
            <div class="notice">
                <h2>공지사항</h2>
                <ul>
<!-- DB의 board라는 테이블에 등록된 최신글 5개만 가져오기 -->
<?php
    include "./db_con.php";
    $sql = "select * from board order by num desc limit 5"; //큰수부터 5개만뽑아와
    $result = mysqli_query($con, $sql);
    //$row = mysqli_fetch_array($result); //배열가져와
    
    //var_dump($result);
    //object(mysqli_result)#2 (5) { ["current_field"]=> int(0) ["field_count"]=> int(10) ["lengths"]=> array(10)   

    //var_dump($row);
    // { [0]=> int(2) [1]=> int(3) [2]=> int(9) [3]=> int(25) [4]=> int(3) [5]=> int(18) [6]=> int(2) [7]=> int(8) [8]=> int(9) [9]=> int(23) } ["num_rows"]=> int(5) ["type"]=> int(0) } array(20) { [0]=> string(2) "46" ["num"]=> string(2) "46" [1]=> string(3) "cha" ["id"]=> string(3) "cha" [2]=> string(9) "차오루" ["name"]=> string(9) "차오루" [3]=> string(25) "첨부파일올리기 png" ["subject"]=> string(25) "첨부파일올리기 png" [4]=> string(3) "123" ["content"]=> string(3) "123" [5]=> string(18) "2020-09-10 (20:21)" ["regist_day"]=> string(18) "2020-09-10 (20:21)" [6]=> string(2) "53" ["hit"]=> string(2) "53" [7]=> string(8) "sns5.png" ["file_name"]=> string(8) "sns5.png" [8]=> string(9) "image/png" ["file_type"]=> string(9) "image/png" [9]=> string(23) "2020_09_10_20_21_35.png" ["file_copied"]=> string(23) "2020_09_10_20_21_35.png" }

    //맨 처음 DB 내에 아무것도 없을 때
    if(!$result){
        echo "등록된 게시글이 존재하지 않습니다.";
    }else{

        // 배열데이터가 존재하면 반복문을 실행해라 / 중간식이 존재하지 않음
        while($row = mysqli_fetch_array($result)){
            //var_dump($row);
            $num = $row["num"];
            $subject = $row["subject"];
            //문자열의 개수가 60보다 크다면
            if(strLen($subject) > 60){
                $subject = substr($row["subject"], 0, 60)."..."; //제목의글자수제한 + "..."
            //제목길어서 30개까지 차단함 뒤에 ...처리 
            }

            $name = $row["name"];
            //2020-09-10(10:10)-> 2020-09-10 10개쪼개서 가져옴
            $regist_day = substr($row["regist_day"], 0, 10);//원본데이터 , 시작인덱스 ,몇개쪼갤꺼냐

?>
                    <li>
                        <!-- board_view.php?num=48&page=1 (url주소)-->
                        <!-- page는 어차피 최신순이므로 무조건 page=1 이다 -->
                        <span class="field1"><a href="./board_view.php?num=<?=$num?>&page=1"><?=$subject?></a></span> <!-- 제목 -->
                        <span class="field2"><?=$name?></span> <!-- 작성자 -->
                        <span class="field3"><?=$regist_day?></span> <!-- 작성일 -->
                    </li>
<?php
       }
    }
?>                  
                </ul>

            </div>

            <div class="member_rank">
                <h2>파워멤버</h2>
                <ul>
<?php
    $rank = 1;
    $sql = "select * from members order by point desc limit 5";
    $result = mysqli_query($con, $sql);

    //맨 처음 DB 내에 아무것도 없을 때
    if(!$result){
        echo "등록된 회원이 없습니다.";
    }else{
        while($row = mysqli_fetch_array($result)){
            $name = $row["name"];
            $id = $row["id"];
            $point = $row["point"];
?>
                    <li>
                        <span class="mem1"><?=$rank?></span> <!-- 랭크 -->
                        <span class="mem2"><?=$name?></span> <!-- 이름 -->
                        <span class="mem3"><?=$id?></span> <!-- 아이디 -->
                        <span class="mem4"><?=$point?></span> <!-- 포인트 -->
                    </li>
<?php
            $rank++;
        }
    }
?>            
                </ul>

            </div>
        </div>
