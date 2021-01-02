<?php
    //board_view.php?num=15&page=1
    //지금나의 url창

    $num = $_GET["num"];
    $page = $_GET["page"];

    include "./db_con.php";

    //만약 게시글을 삭제할 경우, 첨부파일도 삭제처리
    $sql = "select * from board where num = '$num'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);

    //data라는 디렉토리(폴더)에서 실제로 저장된 파일명을 지칭
    $copied_name = $row["file_copied"]; //2020_09_10_17_50_49.jpg
    if($copied_name){
        $file_path = "./data/".$copied_name; //경로까지 연결한 파일명
        unlink($file_path); //delete a file : 서버에 위치한 파일 삭제
    }

    //본인이 보고 있던 게시글을 삭제(from DB board)
    $sql2 = "delete from board where num = '$num'";
    mysqli_query($con, $sql2);
    mysqli_close($con);

    echo("
        <script>
            location.href = 'board_list.php?page=$page';
        </script>
    ");

?>