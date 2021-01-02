<?php
//최초가지고 오는 도메인 주소는 get으로 가져온다
    $send_id = $_GET["send_id"];
    $rv_id = $_POST["rv_id"]; 
    /*name="rv_id" message_response_form.php에는 존재하지 않는 값 -> <input type ="hidden" name="rv_id" value="<?=user_id?>"> : 보이지는 않지만 데이터값을 갖고 있음 -> 데이터를 뽑아올 수 있음 (쉽게말해서 공간을 차지하지 않고 파일이 숨겨져 있다고 생각하기) */
    $subject = $_POST["subject"];
    $content = $_POST["content"];
    $regist_day = date("Y-m-d (H:i)");

    /*
    $con = mysqli_connect("localhost","owisdom","dhwlgp1208!","owisdom");
    mysqli_query($con, "SET NAMES utf8"); //글자안꺠지게 utf8씀
    */
    include "./db_con.php";


    //#1. members라는 테이블로부터 받는사람이 현재 회원으로 등록되어있는가 유무를 확인
    $sql = "select * from members where id='$rv_id'";
    $result = mysqli_query($con, $sql); //멤버 테이블에서 sql문
    $num_record = mysqli_num_rows($result);

    if($num_record){ //받는사람이 존재한다면
        // 위에 $sql 있어도 또 써도됨 재할당 개념
        $sql = "insert into message (send_id, rv_id, subject, content, regist_day) values('$send_id','$rv_id', '$subject', '$content','$regist_day')";
        mysqli_query($con, $sql);
    }else{ //받는 사람이 존재하지 않는다면
        echo ("
            <script>
                alert('받는사람(아이디)이 없습니다. 다시 한 번 작성해주시기 바랍니다');
                history.go(-1);
            </script>
        ");
        exit; //조건문 탈출 return같은것
    }
    mysqli_close($con); //DB 연결 종료


    //메세지 발신함 목록으로 이동 
    echo ("
        <script>
            location.href = 'message_box.php?mode=send';
        </script>
    ");






?>