<?php
    /*./admin_member_delete.php?num=<?=$num?>*/
    $num = $_GET["num"];

    include "./db_con.php";
   
    $sql = "delete from members where num='$num'";
    mysqli_query($con, $sql);
    
    mysqli_close($con);

    echo("
        <script>
            location.href = './admin.php';
        </script>
    ")
?>