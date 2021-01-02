<?php
    $id = $_GET["id"]; //도메인(id)으로부터 가져와서 값을 저장
    $pass = $_POST["pass"]; //입력상자로부터 수정된 내용의 값을 저장
    $name = $_POST["name"];
    $email1 = $_POST["email1"];
    $email2 = $_POST["email2"];

    $email = $email1."@".$email2;

    /*
    $con = mysqli_connect("localhost","owisdom","dhwlgp1208!","owisdom");
    mysqli_query($con, "SET NAMES utf8"); //글자안꺠지게 utf8씀
    */
    include "./db_con.php";

    $sql = "update members set pass='$pass', name='$name', email='$email'";
    $sql .= "where id='$id'";


    //members 라는 테이블에 양식으로부터 받아온 값들을 업데이트
    mysqli_query($con, $sql);
  

    //세션을 재 등록 -> index.php로 진행되었을때 header.php에 session 정보를 받아와서 등록시키는 기능으로 전달할 예정
    //회원정보수정시 메인화면에서 바로 적용되게하기

    //재할달이라서 $sql써도 괜찮다
    $sql2 = "select * from members where id='$id'"; //해당하는 테이블 영역의 아이디가 동일한 것만 선택
    $result = mysqli_query($con, $sql2);
    $row = mysqli_fetch_array($result); //id,name,pass,email,


    var_dump($row["name"]);

    //board에서도 name 값을 변경해줌
     $sql3_update = "update board set name='$name' where id='$id'";
    mysqli_query($con, $sql3_update);

    //로그인 상태와 비로그인 상태 (타인이 게시글을 본 입장) 원 데이터 베이스의 테이블에는 name 필드 데이터들이 변경되지 않은 상태 -> 아이디를 기준으로 각  데이터 값들 중에서 name 항목만 변경된 내용으로 전달

    //message에서도 name값을 변경해줌
    
   

    //업데이트후 다시 세션에 접근해서 수정된 내용 반영
    session_start();
    $_SESSION["username"] = $row["name"];
    $_SESSION["userlevel"] = $row["level"];
    $_SESSION["userpoint"] = $row["point"];


    mysqli_close($con);

    echo "
        <script>
            location.href = 'index.php';
        </script>
    ";

?>