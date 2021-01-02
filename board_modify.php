<?php
    /*board_modify_form.php?num=<?=$num?>&page=<?=$page?>*/
    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    include "./db_con.php";

    $sql = "update board set subject='$subject', content='$content' where num='$num'";
    mysqli_query($con, $sql);
    mysqli_close($con);

    echo ("
        <script>
             location.href = 'board_list.php?page=$page';
        </script>     
    ");


?>