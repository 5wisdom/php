<?php
    session_start(); //세션을 열겠다  세션: 웹서버가 잠시 데이터를 가지고 있는 공간(로그인하는동안 가지고 있음) 
    unset($_SESSION["userid"]);
    unset($_SESSION["username"]);
    unset($_SESSION["userlevel"]);
    unset($_SESSION["userpoint"]);
    //세션으로 부터 등록을 삭제 

    echo ("
        <script>
            location.href='index.php';
        </script>
    ");
    //로그아웃했으면 세션으로 돌아가
?>