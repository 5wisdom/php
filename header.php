<script src="https://kit.fontawesome.com/f551587874.js" crossorigin="anonymous"></script>
<!-- 폰트어썸 스크립트 -->

<?php //로그아웃만들려고
    session_start(); //세션확인
    //isset($_SESSION["userid"]) : userid라는 세션 항목에 등록 여부를 판단(true/false)
    if(isset($_SESSION["userid"])){ //(등록되어있어? 없어?)
        $userid = $_SESSION["userid"]; //세션 항목중에서 userid라는 곳의 값을  $userid라는 곳에 저장
    }else{ 
        $userid = ""; //없다면 값을 비워놓겠다 
    }

    if(isset($_SESSION["username"])){
        $username = $_SESSION["username"];
    }else{
        $username = "";
    }

    if(isset($_SESSION["userlevel"])){
        $userlevel = $_SESSION["userlevel"];
    }else{
        $userlevel = "";
    }

    if(isset($_SESSION["userpoint"])){
        $userpoint = $_SESSION["userpoint"];
    }else{
        $userpoint = "";
    }
?>


    <div id="top">
        <div class="frame">
            <div class="top_info">
                <p><i class="fas fa-phone-alt"></i> 24/7 support: +011 322 44 56</p>
            </div>
            <ul id="top_menu">

<?php
    //li가 php 밖에 있지만 if,else문으로 묶여져 있다, 수정하기 편하기 위해 이렇게 작성한다
    //로그인이 되지 않은 상태에서 보여줄 메뉴
    if(!$userid){
?>            
                <li><a href="./member_form.php">회원 가입</a></li>
                <li><a href="./login_form.php">로그인</a></li>
<?php
    //로그인이 된 상태에서 보여줄 메뉴(세션 등록 완료)
    //로그인에 성공했을떄
    }else{
        $logged = $username."(".$userid.")님[LV:".$userlevel.", po:".$userpoint."]"; 
?>        
                <li><?php echo $logged ?></li>
                <li><a href="logout.php">로그아웃</a></li>
                <li><a href="member_modify_form.php">정보수정</a></li>
<?php
    }
    if($userlevel == 1){
?> 
                <li><a href="admin.php">관리자</a></li>
<?php     
    }
?>               


            </ul>
        </div>
    </div>
    <nav>
        <div class="frame">
            <div class="logo">
                <a href="./index.php"><img src="./img/lm-s.png" alt="로고"></a>
            </div>
            <div id="menu_bar">
                <ul>
                    <li><a href="./message_form.php">쪽지 보내기</a></li>
                    <li><a href="./board_list.php">게시판</a></li>
                </ul>
            </div>
        </div>
    </nav>