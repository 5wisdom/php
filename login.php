<?php
     $id = $_POST["id"];
     $pass = $_POST["pass"];



    //  $con = mysqli_connect("localhost","owisdom","dhwlgp1208!","owisdom");
    //  mysqli_query($con, "SET NAMES utf8"); //글자안꺠지게 utf8씀
    include "./db_con.php";

    $sql = "select * from members where id='$id'";
    //members라는 테이블 명 중에서 로그인 페이지로 부터 입력한 아이디가 id 필드명에서 일치하는 행의 내용을 가져옴
    $result = mysqli_query($con, $sql); 
    //테이블로 접근하는 시도 과정
    
    $num_match = mysqli_num_rows($result); //어디에있는 행인지를 찾음
    //mysqli_num_rows($result) ==> 몇번쨰에 위치한 데이터 값들인지를 저장

    
    
      //history.go(-1); 뒤로돌아가 -1이기 떄문에 뒤로감

    //history 갹체 : 브라우저가 이동한 기록을 갖고 있음
    //history.go() :  내가 현재 페이지를 기준으로 기록상에 남겨진 것을 토대로 이동할 페이지를 찾음
    //history.go(-1) : 이전 페이지로 이동해라 = history.back();
    //history.go(-2) : 2번 이전 페이지로 이동해라
    if(!$num_match){ //매치되는 값이 없을경우
        echo ("
            <script>
                alert('등록되지 않은 아이디입니다.');
                history.go(-1); 
            </script>
        ");
    }else{ //매치, 일치하는경우
        $row = mysqli_fetch_array($result);
        //  mysqli_fetch_array($result) : 선택된 데이터 값들을 배열방식으로 가져와서 저장
        $db_pass = $row['pass'];
        //배열 데이터로 저장된 항목(필드명) 중에서 pass라는 항목만 저장 
        mysqli_close($con); //mysql 종료

        if($pass != $db_pass){ //아이디는 있지만 비밀번호가 틀린경우
            echo ("
                <script>
                    alert('비밀번호가 다릅니다.')
                    history.go(-1); 
                </script>    
            ");
            exit; //탈출
        }else{ // 비밀번호가 맞은경우
            session_start(); //세션에 등록을 진행(session: 등록  start: 시작)
            $_SESSION["userid"] = $row["id"];
            $_SESSION["username"] = $row["name"];
            $_SESSION["userlevel"] = $row["level"]; //회원등급나눔
            $_SESSION["userpoint"] = $row["point"];
            echo ("
                <script>
                    location.href = 'index.php';
                </script>
            ");
        }
    }    
?>