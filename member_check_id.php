<!-- 윈도우 팝업용 -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <!-- 윈도우 팝업용이여서 지움 -->
    <link rel="stylesheet" href="./css/idChk_pop.css">
</head>
<body>
    <h2>아이디 중복체크</h2>
    <div id="idChk_txt">
<?php
    //url창에 표시
    //중복체크를 클릭했을때
    $id = $_GET["id"];
    //아이디 입력란에 어떠한 값도 입력하지 않은 상태에서 중복체크라는 버튼을 클릭했다는 경우
    if(!$id){ //아이디를 입력안한경우
        echo ("<p>아이디를 입력해주세요.</p>");
    }else{ //아이디를 입력한경우
        /*
        $con = mysqli_connect("localhost","owisdom","dhwlgp1208!","owisdom");
        mysqli_query($con, "SET NAMES utf8"); //글자안꺠지게 utf8씀
        */
        include "./db_con.php";

        $sql = "select * from members where id='$id'"; 
        //데이터베이스의 아이디와 내가 적은 아이디가 같은지 확인!! 있으면 중복이다!!! 라는 문구띄우고 다시 접근

        $result = mysqli_query($con, $sql); //쿼리문에 접근 $con에 접속후 $sql을 가져올거야

        $num_record = mysqli_num_rows($result); //행으로 접근

        //var_dump($num_record); 콘솔로그같은것,배열의 키와 그에 해당하는 값뿐만 아니라 속성까지 표시하는 출력문

        //하나라도 존재한다(0이 아닌경우)면 true, 존재하지 않는다(0인 경우)면 false
        if($num_record){ //0과 1로 나와서 0이면 없음 1이면 있음으로 나옴
            echo "<p>".$id."아이디는 중복됩니다.</p>";
            echo "<p>다른 아이디를 사용해주세요.</p>";
        }else{
            echo "<p>".$id."아이디는 사용 가능합니다.</p>"; 
        }
        mysqli_close($con);
        
    }
?>
    </div>

    <div id="close">
        <img src="./img/close.png" alt="닫기 버튼" onclick="self.close();">
    </div>


    
</body>
</html>