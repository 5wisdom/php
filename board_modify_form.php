<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 수정하기</title>
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/board.css">
</head>
<body>  
    <header>
        <?php include "./header.php";?>
    </header>
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
            <h2 id="board_title">게시판 > 수정</h2>

<?php
    /*board_modify_form.php?num=<?=$num?>&page=<?=$page?>*/ //게시판목록에서가져옴
    $num = $_GET["num"];
    $page = $_GET["page"];

    include "./db_con.php";
    
    $sql = "select * from board where num='$num'";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $name = $row["name"];
    $subject = $row["subject"];
    $content = $row["content"];
    $file_name = $row["file_name"] //실제파일이름
?>
            

            <form name="board_form" action="board_modify.php?num=<?=$num?>&page=<?=$page?>" method="post" enctype="multipart/form-data">
                <ul id="board_form">
                    <li>
                        <div class="label">
                            <label>이름 : </label>
                        </div>
                        <div class="input">
                            <p><?=$name?></p>
                        </div>
                    </li>
                    <li>
                        <div class="label">
                            <label for="subject">제목 : </label>
                        </div>
                        <div class="input">
                            <input type="text" name="subject" value="<?=$subject?>">
                        </div>
                    </li>
                    <li>
                        <div class="label">
                            <label for="content">내용 : </label>
                        </div>
                        <div class="input">
                            <textarea name="content"><?=$content?></textarea>
                        </div>
                    </li>
                    <li>
                        <div class="label">
                            <label for="upfile">첨부파일 : </label>
                        </div>
                        <div class="input">
                            <p><?=$file_name?></p>
                            <!-- <input class="upload" type="file" name="upfile"> -->
                        </div>
                    </li>
                </ul>
                <ul class="buttons">
                    <li><button type="button" onclick="check_input();">수정하기</button></li>
                    <li><button type="button" onclick="location.href='board_list.php'">목록보기</button></li>
                </ul>
        </div>    
    </section>

    <footer>
        <?php include "./footer.php";?>
    </footer>    


    <script src="./js/board.js"></script>
</body>
</html>