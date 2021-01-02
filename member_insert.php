<?php
    //회원가입후 데이터베이스에 정보저장
    //myadmin에서 auto_increment가 체크됐는지 꼭 확인하자!! 자동으로 숫자 갱신!!

    //1차 관문 (member_form.js) -> 2차 관문 (member_insert.php)
    $id = $_POST["id"];
    $pass = $_POST["pass"];
    $name = $_POST["name"];
    $email1 = $_POST["email1"];
    $email2 = $_POST["email2"];
    $email = $email1."@".$email2;

    $regist_day = date("Y-m-d (H:i)"); //가입당시의 연월일시분 저장

   
    //$con = mysqli_connect("서버", "데이터베이스 접속id", "데이터베이스 접속pw","데이터베이스의 이름", "포트번호");
    /*
    $con = mysqli_connect("localhost","owisdom","dhwlgp1208!","owisdom");
    mysqli_query($con, "SET NAMES utf8"); //글자안꺠지게 utf8씀
    */

      //에러났을떄잡기
    // if(mysqli_connect_error()){
    //     echo "mysql 에러 : ".mysqli_connect_error();
    // }else{
    //     echo "데이터베이스 접속 성공";
    // }

    include "./db_con.php";

    $sql = "select * from members where id='$id'";
    $result = mysqli_query($con, $sql);
    $num_record = mysqli_num_rows($result); //멤버라는 테이블 내에서 값이 있담면 1 또는 값이 없다면 0


    if($num_record){ 
        //회원아이디가 중복된 상태 = 입력한 값들을 데이터베이스에 전달하면 안됨
        echo ("
            <script>
                alert('동일한 아이디가 있습니다. 아이디를 변경해 주세요.');
                history.go(-1);
            </script>
        ");

    }else{ //회원 아이디가 중복되지 않은 상태 -입력한 값들을 데이터베이스에 전달하면 됨
  
        $sql = "insert into members(id, pass, name, email, regist_day, level, point) values('$id', '$pass', '$name', '$email', '$regist_day', 9, 0)";

        // $sql = "insert into members(id, pass, name, email, regist_day, level, point)";
        // $sql .= "values('$id', '$pass', '$name', '$email', '$regist_day', 9, 0)";

        mysqli_query($con, $sql); //1차적으로 데이터베이스와 접속을 한다. 2차적으로 각 항목으로 접근하여 $sql에 저장된 명령을 실행
    }    

    mysqli_close($con); //접속종료

    echo "
        <script>
            location.href = 'index.php';
        </script>
    ";
    //위의 모든 것이 실행이 완료되면 현재 브라우저 화면을 index.php로 보내라
    

?>




