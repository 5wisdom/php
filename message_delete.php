<!-- 삭제기능-->
<!-- 발신함을 갖고 있는 상세페이지에서 삭제를 진행했다면 발신함 리스트로 페이지를 보여줌  -->
<!-- 수신함을 갖고 있는 상세페이지에서 삭제를 진행했다면 수신함 리스트로 페이지를 보여줌-->
<?php
    $mode = $_GET["mode"];
    $num = $_GET["num"];

    include "db_con.php";

    $sql = "delete from message where num='$num'";
    //$num에 해당하는 데이터를 삭제
    mysqli_query($con, $sql);
    mysqli_close($con); //db연결종료

    if($mode == "send"){ //삭제를 진행한 곳이 발신함이라면, 발신함리스트 또는 목록으로 이동진행
        $target_url = "message_box.php?mode=send";
    }else{ //삭제를 진행한 곳이 수신함이라면 , 수신함리스트 또는 목록으로 이동진행
        $target_url = "message_box.php?mode=rv";
    }

    //삭제를 진행했기 때문에 페이지를 리스트 페이지로 이동시킨다.
    echo ("
        <script>
            location.href='$target_url';
        </script>
    ");
    //$target_url : 단순한 문자열로 가져오는 것이 아닌, php문구의 변수로부터 값을 가져와서 스크립트와 연동을 시킴

?>


