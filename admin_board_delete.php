<?php

    if(isset($_POST["unit"])){
        $num_unit = count($_POST["unit"]); //몇개를 선택하고 삭제버튼을 클릭했는지 개수를 파악하여 저장
    }else{
        echo("
            <script>
                alert('삭제할 게시글을 선택하세요!');
                history.go(-1);
            </script>
        ");
    }

    var_dump($num_unit); //내가 선택한 갯수 ex)int(4)

    include "./db_con.php";

    
   
    
    for($i=0;$i<$num_unit;$i++){
        $num = $_POST["unit"][$i]; //value 값을 받아서 저장
        var_dump($num);

        $sql = "select * from board where num = '$num'";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result);

        //#1. data라는 폴더 내부의 첨부파일을 삭제
        $file_copied = $row["file_copied"]; //저장 과정상 data 폴더 내부에는 저장된 이름이 다름

        if($file_copied){ //첨부파일이 존재한다면 
            $file_path = "./data/".$file_copied; //경로를 결합하여 저장
            unlink($file_path); //파일삭제
        }

        //#2. board 테이블 내부의 선택한 항목에 대한 행 삭제
        $sql = "delete from board where num='$num'";
        mysqli_query($con, $sql);
    }
    mysqli_close($con);

    echo ("
        <script>
            location.href='./admin.php';
        </script>
    ");
?>