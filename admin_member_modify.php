<?php
    /*현재 시점에서 url 주소 ./admin_member_modify.php?num=<?=$num?>*/
    $num = $_GET["num"];
    $level = $_POST["level"];
    $point = $_POST["point"];

    include "./db_con.php";

    /* DB crud
    c: create
    r: read
    u: update
    d: delete
    */

    $sql = "update members set level='$level', point='$point' where num='$num'";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo ("
        <script>
            location.href = './admin.php';
        </script>
    ")



?>