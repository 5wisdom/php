<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/admin.css">
</head>
<body>
    <header>
        <?php include "header.php";?>
    </header>

<?php
    if($userid !== "ojh"){
        echo("
            <script>
                alert('입장 가능한 유효한 관리자가 아닙니다.');
                location.href = './index.php';
            </script>
        ");
    }
    if($userlevel > 1){
        echo("
        <script>
            alert('입장 가능한 유효한 관리자가 아닙니다.');
            location.href = './index.php';
        </script>
    ");
    }

    include "./db_con.php";
    $sql = "select * from members order by num desc"; //내리차순
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);

    $number = $total_record; // 전체 회원수
    
?>
    
    <section>
        <div id="admin_box">
            <h2>관리자 페이지(회원 관리)</h2>  
           
                <ul id="member_list">
                    <li>
                        <span class="field1">번호</span>
                        <span class="field2">아이디</span>
                        <span class="field3">이름</span>
                        <span class="field4">레벨</span> <!-- 수정가능 -->
                        <span class="field5">포인트</span> <!-- 수정 가능 -->
                        <span class="field6">가입일</span>
                        <span class="field7">수정</span>
                        <span class="field8">삭제</span>
                    </li>

<?php
    while($row = mysqli_fetch_array($result)){
        $num = $row["num"];
        $id = $row["id"];
        $name = $row["name"];
        $level = $row["level"];
        $point = $row["point"];
        $regist_day = $row["regist_day"];
?>

                    <li>
                        <form name="member_list" action="./admin_member_modify.php?num=<?=$num?>" method="post">
                            <span class="field1"><?=$number?></span> <!-- 번호 -->
                            <span class="field2"><?=$id?></span><!-- 아이디 -->
                            <span class="field3"><?=$name?></span> <!-- 이름 -->
                            <span class="field4"><input type="text" name="level" value="<?=$level?>"></span> <!-- 레벨 --><!-- 수정가능 -->
                            <span class="field5"><input type="text" name="point" value="<?=$point?>"></span> <!-- 포인트 --><!-- 수정 가능 -->
                            <span class="field6"><?=$regist_day?></span><!-- 가입일 -->
                            <span class="field7"><button type="submit">수정</button></span><!-- 수정 -->
                            <span class="field8"><button type="button" onclick="location.href='./admin_member_delete.php?num=<?=$num?>'">삭제</button></span><!-- 삭제 -->
                        </form>
                    </li>
<?php
        $number--;
    }   
?>

                </ul>
            

            <h2>관리자 페이지(게시글 관리)</h2>
            <form action="./admin_board_delete.php" method="post">
                <ul id="board_list">
                    <li>
                        <span class="board1">선택</span>
                        <span class="board2">번호</span>
                        <span class="board3">이름</span>
                        <span class="board4">제목</span>
                        <span class="board5">첨부파일</span>
                        <span class="board6">작성일</span>
                    </li>
 
<?php /* db_con은 위에 선언된게 있음 */
    $sql = "select * from board order by num desc";
    $result = mysqli_query($con, $sql);
    $total_record = mysqli_num_rows($result);

    $number = $total_record;

    while($row = mysqli_fetch_array($result)){
        $num = $row["num"];
        $name = $row["name"];
        $subject = $row["subject"];
        $file_name = $row["file_name"];
        $regist_day = $row["regist_day"];
        $regist_day = substr($regist_day, 0, 10);
?>                    

                    <li>
                        <!-- name="unit[]"다시의 것을 가지고 올때 []를 붙여 배열데이터 형태로 숫자를 가져옴 -->
                        <span class="board1"><input type="checkbox" name="unit[]" value="<?=$num?>"></span><!-- 선택 -->
                        <span class="board2"><?=$number?></span><!-- 번호 -->
                        <span class="board3"><?=$name?></span><!-- 이름 -->
                        <span class="board4"><?=$subject?></span><!-- 제목 -->
                        <span class="board5"><?=$file_name?></span><!-- 첨부파일 -->
                        <span class="board6"><?=$regist_day?></span><!-- 작성일 -->
                    </li>
<?php
        $number--;
    }   
    mysqli_close($con);
?>                 
                </ul>
                <button type="submit">선택한 항목 삭제</button>
                <!-- form은 submit과 하나 1:1매치 해야함 -->
            </form>

        </div>
    </section>

    <footer>
        <?php include "footer.php";?>
    </footer>
    
</body>
</html>