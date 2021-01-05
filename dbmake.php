<?php
    $con = mysqli_connect("localhost", "아이디", "비밀번호", "데이터베이스명");
    // $con = mysqli_connect("localhost", "아이디", "비밀번호", "데이터베이스명", "포트번호(3306 or 3307)-기본3306은 생략가능");->포트번호는 myadmin의 상단파트의 localhost:3306 확인하고 다르면 지정해줘야만 데이터베이스로 연동할 수 있음
    mysqli_query($con, "SET NAMES utf8");
?>