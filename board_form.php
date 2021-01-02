<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판 작성</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/board.css">
</head>
<body>
    <header>
        <?php include "header.php";?>
    </header>

<?php
    //비회원은 로그인 안해서 접근조차 못했기 때문에 alert창이 무의미해져서 주석처리했음
    // if(!$userid){
    //     echo("
    //         <script>
    //             alert('로그인 후 이용 바랍니다.');
    //             location.href='./login_form.php';
    //         </script>
    //     ");
    // }
?>    

    <section>
        <div id="main_img_bar" class="subpage">
            <div class="main_img_cont">
                <div class="frame">
                    <div class="main_img_text">
                        <div class="main_img_title">
                            <h3>100% Free <span>Online Course</span></h3>
                            <h1>GET Tomorrow's Skills Today!</h1>
                        </div>                    
                    </div>
                </div>
            </div>
        </div>
        <div id="board_box">
            <h2 id="board_title">게시판 > 작성</h2>
            <!-- 
            enctype="multipart/form-data" -용량 큰파일이나 이미지 첨부파일 전송

            데이터를 전송하는 방식에는 get방식과 post방식 + enctype 속성의 multipart(호환)/form-data get 방식은 URL 창에 폼 데이터가 노출. 입력내용에 대한 길이제한 있음(256~4096byte까지만 데이터를 전송 가능)
            
            post방식은 URL 창에 폼 데이터가 노출되지 않음. 입려 내용에 대한 길이 제한은 없음. 보낼수 있는 데이터의 양은 한계 반드시 존재. 이를 보완하고자 큰용량의 파일이나 데이터를 전송했을때 문제가 발생하지 않도록 폼데이터의 속성을 enctype으로 변경하면 큰 데이터 전송간에 문제가 발생하지 않음. (이미지 파일은 pixel당 4byte를 담고 있음. 대표적인 케이스로 색상값이 4byte/pixel)
             -->
             <!-- 
            action속성은 전송(<input type="submit">)이라는 버튼을 눌렀다면 이벤트가 발생하는데, submit() 이벤트가 발생 -> 데이터값을 전송하기 시작 -> action에 들어가 있는 속성값으로 전송(DB로 연동과 함께 목적(생성, 수정)에 따른 데이터베이스 작업을 진행) -> UI에 따른 페이지 이동

            form 태그 내부에서 직접적인 <input type = "button" value="전송하기"> 또는 <button>전송하기</button>-> 스크립트에서 검사를 진행한후, 전송을 진행하도록 구성
            -->
            <form name="board_form" action="board_insert.php" method="post" enctype="multipart/form-data">
                <ul id="board_form">
                    <li>
                        <div class="label">
                            <label>이름 : </label>
                        </div>
                        <div class="input">
                            <p><?=$username?></p>
                        </div>
                    </li>
                    <li>
                        <div class="label">
                            <label for="subject">제목 : </label>
                        </div>
                        <div class="input">
                            <input type="text" name="subject">
                        </div>
                    </li>
                    <li>
                        <div class="label">
                            <label for="content">내용 : </label>
                        </div>
                        <div class="input">
                            <textarea name="content"></textarea>
                        </div>
                    </li>
                    <li>
                        <div class="label">
                            <label for="upfile">첨부파일 : </label>
                        </div>
                        <div class="input">
                            <input class="upload" type="file" name="upfile">
                        </div>
                    </li>
                </ul>
                <ul class="buttons">
                    <li><button type="button" onclick="check_input();">완료</button></li>
                    <li><button type="button" onclick="location.href='board_list.php'">목록보기</button></li>
                </ul>

            </form>
        </div>

    </section>

    <footer>
        <?php include "footer.php";?>
    </footer>

    <script src="./js/board.js"></script>
    
</body>
</html>
